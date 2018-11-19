<?php

/**
 *
 */
class Register extends CI_Controller
{
  public function index()
  {
    $this->load->model("users_model");
    $data["country"] = $this->users_model->fetch_country();
    $this->load->view('template/header');
    $this->load->view('register/register',$data);
    $this->load->view('template/footer');
  }

  public function register_req()
  {
    echo "ok";
    $this->load->library('form_validation');
    $this->form_validation->set_rules("username","Username",array('required', 'min_length[5]'));
    $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
    $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
    $this->form_validation->set_rules('re_password', 'Password Confirmation', 'trim|required|matches[password]');
    $this->form_validation->set_rules('usermobile', 'Mobile Number', 'trim|required|min_length[10]|numeric');

    if($this->form_validation->run())
    {
      // echo "if";
         //true
         //loading model
         $this->load->model("registration_model");
         $this->load->model("users_model");
         $data = array(
              "username"  =>$this->input->post("username"),
              "user_email"  =>$this->input->post("email"),
              "user_password"  =>$this->input->post("password"),
              "user_mobile"  =>$this->input->post("usermobile")

         );

         if($this->input->post("insertdetails"))
         {
           // echo "insert";
           //calling method in model class
              $this->registration_model->insert_user_data($data);

              redirect(base_url() . "register/inserted");
         }
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
         $this->index();
    }
  }
  public function inserted()
  {
       $this->index();
  }

}
 ?>
