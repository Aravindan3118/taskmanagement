<?php

class posts extends Auth
{
  public function index(){
       $this->load->view('template/header');
       $this->load->view('posts/posts');
       $this->load->view('template/footer');
  }
  public function form_validation()
  {


       $this->load->library('form_validation');
       $this->form_validation->set_rules("name_field","Name","required");

       if($this->form_validation->run())
       {
         //echo "if";
            //true
            //loading model
            $this->load->model("main_model");
            $data = array(
                 "name"  =>$this->input->post("name_field")

            );

            if($this->input->post("insert"))
            {
              echo "insert";
              //calling method in model class
                 $this->main_model->insert_data($data);

                 redirect(base_url() . "posts/inserted");
            }
       }
       else
       {
         echo "else";
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
