<div class="table-responsive">
    <?php if($this->uri->segment(2) == "updated")
              {
                  echo '<p class="text-success">Data Updated</p>';
                }
                if($this->uri->segment(3) == "Deleted")
                          {
                              echo '<p class="text-danger">Data Deleted</p>';
                            } ?>
           <table class="table table-bordered">
                <tr>
                     <th>User Id</th>
                     <th>Username</th>
                     <th>Email</th>
                     <th>Phone number</th>
                     <th>Edit</th>
                </tr>
           <?php
           if($fetch_data->num_rows() > 0)
           {
                foreach($fetch_data->result() as $row)
                {
           ?>
                <tr>
                     <td><?php echo $row->user_id; ?></td>
                     <td><?php echo $row->username; ?></td>
                     <td><?php echo $row->user_email; ?></td>
                     <td><?php echo $row->user_mobile; ?></td>
                     <td><a class="btn btn-danger delete_data" id="<?php echo $row->user_id; ?>">Delete</a>
                     <a class="btn btn-info" href="<?php echo base_url(); ?>users/update_data/<?php echo $row->user_id; ?>">Edit</a></td>
                </tr>
           <?php
                }
           }
           else
           {
           ?>
                <tr>
                     <td colspan="5">No Users Found</td>
                </tr>
           <?php
           }
           ?>
           </table>
      </div>
      <script>
     $(document).ready(function(){
          $('.delete_data').click(function(){
               var id = $(this).attr("id");
               if(confirm("Are you sure you want to delete this?"))
               {
                    window.location="<?php echo base_url(); ?>users/delete_data/"+id;
               }
               else
               {
                    return false;
               }
          });
     });
     </script>
