<?php
    /**
     *
     */
    class Users_model extends CI_Model
    {
      function fetch_data()
        {

             $this->db->select("*");
             $this->db->from("users");
             // $this->db->where("user_id<>".$_SESSION['user_id']);
             $query = $this->db->get();
             // echo $this->query;
             return $query;
        }
        function fetch_country()
          {

               $this->db->select("*");
               $this->db->from("all_countries");
               // $this->db->where("user_id<>".$_SESSION['user_id']);
               $query = $this->db->get();
               // echo $this->query;
               return $query;
          }
        public function update_data($data, $user_id)
         {
              $this->db->where("user_id", $user_id);
              $this->db->update("users", $data);

         }
         function fetch_single_data($user_id)
      {
           $this->db->where("user_id", $user_id);
           $query = $this->db->get("users");
           return $query;
      }
      function delete_data($user_id){
           $this->db->where("user_id", $user_id);
           $this->db->delete("users");
      }
    }

 ?>
