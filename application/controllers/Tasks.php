<?php
/**
 *
 */
class Tasks extends Auth
{

  public function index()
  {
    // $this->load->view('ltetemplate/header');
    // $this->load->view('ltetemplate/sidebar');
    // $this->load->view('vlte/lte_view');
    // $this->load->view('ltetemplate/footer');
    $this->all_tasks();
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
  public function create_task($taskid = NULL)
  {

    $this->load->model('task_model');
    $data['fetch_type']=$this->task_model->fetch_type_data();
    $data['fetch_edit_data']=$this->task_model->fetch_edit_data($taskid);
    $data['fetch_file_data']=$this->task_model->fetch_file_data($taskid);
    $this->load->view('ltetemplate/header');
    $this->load->view('ltetemplate/sidebar');
    $this->load->view('vlte/create_task_view',$data);
    $this->load->view('ltetemplate/footer');
  }
  public function downloadfile($filename)
  {
    $this->load->helper('download');
    $filepath = './uploads/'.$filename;
    force_download($filepath, NULL);
  }
  public function created()
  {
    $this->create_task();
  }
  public function delete_file($fileid)
  {
    $this->load->model('task_model');
    $delfile['records']=$this->task_model->delete_file($fileid);
    // echo '<pre>';
    // print_r($delfile['records']);
     // echo $delfile['records']['task_id'];
     $this->create_task($delfile['records']['task_id']);
     // echo $id;
    // $this->create_task(if($this->session->flashdata('task_id')){echo $this->session->flashdata('task_id');});
  }
  public function updated($taskid)
  {
    $this->create_task($taskid);
  }
  public function delete_task($taskid)
  {
    $this->load->model('task_model');
    $data = array(
         "is_deleted"  =>1
       );
    $this->task_model->delete_task($taskid,$data);
    // $del = $this->task_model->delete_task($taskid);

    redirect('tasks/deleted');
  }
  public function deleted()
  {
    $this->all_tasks();
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


                   $mystartdate = strtotime($this->input->post('taskstartdate'));
                   $myenddate = strtotime($this->input->post('taskenddate'));

              if ($mystartdate > $myenddate) {
                $error_message = '<p>Start Date Should be less End Date</p>';
                // echo $error_message;
                $this->session->set_flashdata('date_error',$error_message);
                $this->create_task();
              }
              $fetchname = $this->task_model->fetch_task_name($this->input->post("taskname"));
              if ($fetchname) {
                $error_message = '<p>Task Name Already exist</p>';
                // echo $error_message;
                $this->session->set_flashdata('task_name_error',$error_message);
                $this->create_task();
              }
              if (empty($error_message)) {
                $data = array(
                     "task_name"  =>$this->input->post("taskname"),
                     "task_type"  =>$this->input->post("task_type"),
                     "estimated_hours"  =>$this->input->post("taskestimation"),
                     "end_date"  =>date("Y-m-d", $myenddate),
                     "start_date"  =>date("Y-m-d", $mystartdate),
                     "task_description"  =>$this->input->post("taskdescription"),
                     // "upload_file"  =>$upload_file_name,
                     "created_by"  =>$_SESSION['user_id']

                );
                $insertedid = $this->task_model->insert_task_data($data);
                echo $insertedid;
                // redirect(base_url() . "tasks/created");
                if ($insertedid) {
                  if ($_FILES['fileupload']['name'] != "") {


           // retrieve the number of images uploaded;
           $number_of_files = sizeof($_FILES['fileupload']['tmp_name']);
           // considering that do_upload() accepts single files, we will have to do a small hack so that we can upload multiple files. For this we will have to keep the data of uploaded files in a variable, and redo the $_FILE.
           $files = $_FILES['fileupload'];
           $errors = array();

           // first make sure that there is no error in uploading the files
           for($i=0;$i<$number_of_files;$i++)
           {
             if($_FILES['fileupload']['error'][$i] != 0) $errors[$i][] = 'Couldn\'t upload file '.$_FILES['fileupload']['name'][$i];
           }
           if(sizeof($errors)==0)
           {
             $this->load->library('upload');
             $config['upload_path']          = './uploads/';
             $config['allowed_types'] = 'gif|jpg|png|bmp|jpeg|pdf|doc|docx|ppt|pptx|xls';
             for ($i = 0; $i < $number_of_files; $i++) {
               $_FILES['uploadedimage']['name'] = $files['name'][$i];
               $_FILES['uploadedimage']['type'] = $files['type'][$i];
               $_FILES['uploadedimage']['tmp_name'] = $files['tmp_name'][$i];
               $_FILES['uploadedimage']['error'] = $files['error'][$i];
               $_FILES['uploadedimage']['size'] = $files['size'][$i];
               //now we initialize the upload library
               $this->upload->initialize($config);
               // we retrieve the number of files that were uploaded
               if ($this->upload->do_upload('uploadedimage'))
               {
                 $data['uploads'][$i] = $this->upload->data();
                 echo "uploaded<br>";
                 echo $this->upload->data('file_name')."<br>";
                 // $insertfile = $this->task_model->insert_file($insertedid , );
                 $data = array(
                      "task_id"  =>$insertedid,
                      'file_name' => $this->upload->data('file_name')
                    );
                 $this->task_model->insert_file($data);
               }
               else
               {
                 $data['upload_errors'][$i] = $this->upload->display_errors();
                 echo "upload error";
                 echo "error".$this->upload->display_errors()."<br>";
               }

             }

           }



            }
                }
                redirect(base_url() . "tasks/created");
              }


              }
              if($this->input->post("update_task"))
              {
                // if ($_FILES['fileupload']['name'] != "") {
                //   $config['upload_path']          = './uploads/';
                //   $config['allowed_types'] = 'gif|jpg|png|bmp|jpeg|pdf|doc|docx|ppt|pptx|xls';
                //   $config['max_size']             = 10000;
                //   $this->load->library('upload', $config);
                //
                //      if ( ! $this->upload->do_upload('fileupload'))
                //      {
                //
                //              $error = array('error' => $this->upload->display_errors());
                //              $upload_file_name = NULL ;
                //              $error_message = $error['error'];
                //             $this->session->set_flashdata('error',$error['error']);
                //             // $this->create_task($this->input->post('hideentaskid'));
                //             $tkid = $this->input->post('hideentaskid');
                //             redirect('tasks/create_task/'.$tkid);
                //
                //         }
                //      else
                //      {
                //              $upload_file_name = $this->upload->data('file_name');
                //      }
                // }


                        $mystartdate = strtotime($this->input->post('taskstartdate'));
                        $myenddate = strtotime($this->input->post('taskenddate'));

                   if ($mystartdate > $myenddate) {
                     $error_message = '<p>Start Date Should be less End Dates</p>';
                     $this->session->set_flashdata('date_error',$error_message);
                     $tkid = $this->input->post('hideentaskid');
                     redirect('tasks/create_task/'.$tkid);


                   }
                   $fetchname = $this->task_model->fetch_task_name($this->input->post("taskname"));
                   if (empty($error_message)) {
                     $data = array(
                          "task_name"  =>$this->input->post("taskname"),
                          "task_type"  =>$this->input->post("task_type"),
                          "estimated_hours"  =>$this->input->post("taskestimation"),
                          "end_date"  =>date("Y-m-d", $myenddate),
                          "start_date"  =>date("Y-m-d", $mystartdate),
                          "task_description"  =>$this->input->post("taskdescription"),
                          // "upload_file"  =>$upload_file_name,
                          "created_by"  =>$_SESSION['user_id']
                     );
                     $this->task_model->update_task_data($data , $this->input->post('hideentaskid'));
                     // redirect(base_url() . "tasks/updated/".$this->input->post('hideentaskid'));
                   }
                   if ($_FILES['fileupload']['name'] != "") {


            // retrieve the number of images uploaded;
            $number_of_files = sizeof($_FILES['fileupload']['tmp_name']);
            // considering that do_upload() accepts single files, we will have to do a small hack so that we can upload multiple files. For this we will have to keep the data of uploaded files in a variable, and redo the $_FILE.
            $files = $_FILES['fileupload'];
            $errors = array();

            // first make sure that there is no error in uploading the files
            for($i=0;$i<$number_of_files;$i++)
            {
              if($_FILES['fileupload']['error'][$i] != 0) $errors[$i][] = 'Couldn\'t upload file '.$_FILES['fileupload']['name'][$i];
            }
            if(sizeof($errors)==0)
            {
              $this->load->library('upload');
              $config['upload_path']          = './uploads/';
              $config['allowed_types'] = 'gif|jpg|png|bmp|jpeg|pdf|doc|docx|ppt|pptx|xls';
              for ($i = 0; $i < $number_of_files; $i++) {
                $_FILES['uploadedimage']['name'] = $files['name'][$i];
                $_FILES['uploadedimage']['type'] = $files['type'][$i];
                $_FILES['uploadedimage']['tmp_name'] = $files['tmp_name'][$i];
                $_FILES['uploadedimage']['error'] = $files['error'][$i];
                $_FILES['uploadedimage']['size'] = $files['size'][$i];
                //now we initialize the upload library
                $this->upload->initialize($config);
                // we retrieve the number of files that were uploaded
                if ($this->upload->do_upload('uploadedimage'))
                {
                  $data['uploads'][$i] = $this->upload->data();
                  echo "uploaded<br>";
                  echo $this->upload->data('file_name')."<br>";
                  // $insertfile = $this->task_model->insert_file($insertedid , );
                  $data = array(
                       "task_id"  =>$this->input->post('hideentaskid'),
                       'file_name' => $this->upload->data('file_name')
                     );
                  $this->task_model->insert_file($data);
                }
                else
                {
                  $data['upload_errors'][$i] = $this->upload->display_errors();
                  echo "upload error";
                  echo "error".$this->upload->display_errors()."<br>";
                }

              }

            }



             }
             $tkid = $this->input->post('hideentaskid');
             redirect('tasks/create_task/'.$tkid);

                   }
    }
    else
    {
         $this->create_task();
    }

  }
}



 ?>
