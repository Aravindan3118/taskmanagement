<?php

class Login_model extends CI_Model{

    public function validate(){

        // echo "validate model<br>";
        $useremail = $this->security->xss_clean($this->input->post('email'));
        $password = $this->security->xss_clean($this->input->post('password'));
        // echo $useremail."<br>";
        // echo $password."<br>";

        $this->db->where('user_email', $useremail);
        $this->db->where('user_password', $password);

        // Run the query
        $query = $this->db->get('users');
          //echo $this->db->last_query();
        if($query->num_rows() == 1)
        {
          // echo "num of rows<br>";
            // If there is a user, then create session data
            $row = $query->row();
            $data = array(
                    'user_id' => $row->user_id,
                    'username' => $row->username,
                    'user_email' => $row->user_email,
                    'user_password' => $row->user_password,
                    'user_mobile' => $row->user_mobile,
                    'user_type' => $row->user_type,
                    'validated' => true
                    );
            $this->session->set_userdata($data);
            // echo "true part<br>";
            return true;

        }
        // If the previous process did not validate
        // then return false.
        else{
        // echo "false part<br>";
        return false;
      }
    }
}
?>
