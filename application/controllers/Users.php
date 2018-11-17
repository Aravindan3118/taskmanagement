<?php
  /**
   *
   */
  class Users extends Auth
  {

    public function index()
    {

      $this->load->model("users_model");
      $data["fetch_data"] = $this->users_model->fetch_data();
      $this->load->view("template/header");
      $this->load->view("users/users_view", $data);
      $this->load->view("template/footer");
    }
    public function update_data($uid = NULL){
      if ($uid == NULL) {
        $user_id = $this->uri->segment(3);
      }
      else{
        $user_id = $uid;
      }

           $this->load->model("users_model");
           $data["user_data"] = $this->users_model->fetch_single_data($user_id);
           // $data["fetch_data"] = $this->users_model->fetch_data();
           $this->load->view('template/header');
           $this->load->view("users/update_view", $data);
           $this->load->view('template/footer');
      }
      public function updated()
      {
           $this->index();
      }

      public function update_req()
      {
        // echo "ok";
        $this->load->model("users_model");
        $this->load->library('form_validation');
        $this->form_validation->set_rules("username","Username",array('required', 'min_length[5]'));
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        // $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
        // $this->form_validation->set_rules('re_password', 'Password Confirmation', 'trim|required|matches[password]');
        $this->form_validation->set_rules('usermobile', 'Mobile Number', 'trim|required|min_length[8]|numeric');

        if($this->form_validation->run())
        {
          // echo "if";
             //true
             //loading model

             // $this->load->model("users_model");
             $data = array(
                  "username"  =>$this->input->post("username"),
                  "user_email"  =>$this->input->post("email"),
                  "user_mobile"  =>$this->input->post("usermobile")

             );

             if($this->input->post("update"))
                    {
                         $this->users_model->update_data($data, $this->input->post("hidden_id"));
                         redirect(base_url() . "users/updated");
                    }
        }
        else
        {
          // echo "else";
             //false
             $this->update_data($uid = $this->input->post("hidden_id"));
        }
      }

      public function delete_data(){
           $user_id = $this->uri->segment(3);
           $this->load->model("users_model");
           $this->users_model->delete_data($user_id);
           redirect(base_url() . "users/deleted");
      }
      public function deleted()
      {
           $this->index();
      }

    }



 ?>
