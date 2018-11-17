<?php
class Registration_model extends CI_Model
{

     function insert_user_data($data)
     {

          $this->db->insert("users", $data);
          //echo $this->db->last_query();
          //exit;
     }

}
