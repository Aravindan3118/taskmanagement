<?php
/**
 *
 */
class Login extends CI_Controller
{
  public function index($error_msg = NULL)
  {
    $data['error_msg'] = $error_msg;
    $this->load->view('template/header');
    $this->load->view('login/login', $data);
    $this->load->view('template/footer');
  }
  public function login_req()
  {
    // echo "login request<br>";
    $this->load->model('login_model');
    $result = $this->login_model->validate();
    if(! $result){
        // echo "not valide controller block<br>";
        $error_msg = '<font color=red>Invalid username and/or password.</font><br />';
           $this->index($error_msg);
    }else{
        // echo "valid<br>";
        redirect('');
    }
  }



}

 ?>
