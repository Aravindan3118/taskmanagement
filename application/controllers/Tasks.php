<?php
/**
 *
 */
class Tasks extends Auth
{

  public function index()
  {
    $this->load->view('ltetemplate/header');
    $this->load->view('ltetemplate/sidebar');
    $this->load->view('vlte/lte_view');
    $this->load->view('ltetemplate/footer');
  }
  public function all_tasks()
  {
    $this->load->model('task_model');
    $data['fetch_all']=$this->task_model->fetch_task();
    $this->load->view('ltetemplate/header');
    $this->load->view('ltetemplate/sidebar');
    $this->load->view('vlte/all_tasks_view',$data);
    $this->load->view('ltetemplate/footer');
  }
  public function create_task($em = NULL)
  {
    if ($em != NULL) {
      $data['error_message'] = $em ;
    }
    else{
      $data['error_message'] = NULL ;
    }
    $this->load->model('task_model');
    $data['fetch_type']=$this->task_model->fetch_type_data();
    $this->load->view('ltetemplate/header');
    $this->load->view('ltetemplate/sidebar');
    $this->load->view('vlte/create_task_view',$data);
    $this->load->view('ltetemplate/footer');
  }
  public function downloadfile($filename)
  {
    // echo $filename;
    $this->load->helper('download');
    // force_download('./uploads'.$filename, NULL);
    // $pth    =   file_get_contents(base_url()."uploads");
    // $nme    =   $filename;
    $filepath = './uploads/'.$filename;
    force_download($filepath, NULL);

  }
  public function created()
  {
    $this->create_task();
  }
  public function task_upload(){

    $this->load->library('form_validation');
    $this->form_validation->set_rules("taskname","Taskname",array('required', 'min_length[5]'));
    $this->form_validation->set_rules("taskdescription","Task Description",array('required'));
    $this->form_validation->set_rules("task_type","Task Type",array('required'));
    $this->form_validation->set_rules("taskestimation","Estimated Hours",array('required','numeric'));
    $this->form_validation->set_rules("taskstartdate","Start Date",array('required'));
    $this->form_validation->set_rules("taskenddate","End Date",array('required'));

    if($this->form_validation->run())
    {
         $this->load->model("task_model");
         if($this->input->post("submit_task"))
         {
           if ($_FILES['fileupload']['name'] != "") {
             // echo "not empty file <br>";
             $config['upload_path']          = './uploads/';
             $config['allowed_types'] = 'gif|jpg|png|bmp|jpeg|pdf|doc|docx|ppt|pptx|xls';
             $config['max_size']             = 10000;
             $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('fileupload'))
                {
                  // echo "not empty file error block <br>";
                        $error = array('error' => $this->upload->display_errors());

                        // $this->load->view('upload_form', $error);
                        // print_r($error);
                        // echo $error['error'];
                        // echo $this->upload->error();
                        $upload_file_name = NULL ;
                        $error_message = $error['error'];
                       $this->create_task($em=$error_message);
                        // $this->create_task();

                   }
                else
                {
                   // echo "not empty file success block<br>";
                        // $data = array('upload_data' => $this->upload->data());
                        $upload_file_name = $this->upload->data('file_name');

                        // $this->load->view('upload_success', $data);
                        // print_r($data);

                }
           }

                   $mystartdate = strtotime($this->input->post('taskstartdate'));
                   $myenddate = strtotime($this->input->post('taskenddate'));

              if ($mystartdate > $myenddate) {
                // echo "date invalid";
                $error_message = 'Start Date Should be less End Date';
                $this->create_task($em=$error_message);
              }
              if (empty($error_message)) {
                $data = array(
                     "task_name"  =>$this->input->post("taskname"),
                     "task_type"  =>$this->input->post("task_type"),
                     "estimated_hours"  =>$this->input->post("taskestimation"),
                     "end_date"  =>date("Y-m-d", $myenddate),
                     "start_date"  =>date("Y-m-d", $mystartdate),
                     "task_description"  =>$this->input->post("taskdescription"),
                     "upload_file"  =>$upload_file_name,
                     "created_by"  =>$_SESSION['user_id']

                );
                $this->task_model->insert_task_data($data);
                redirect(base_url() . "tasks/created");
              }


              }
    }
    else
    {
      // echo "else";
         //false
         $this->create_task();
    }

  }
}



 ?>
