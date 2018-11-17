

<style media="screen">
body {
background-image: url("<?php echo base_url(); ?>image/signup-bg.jpg");
}
.formerror p{
  color:red;
}
</style>
    <div class="main">

        <section class="signup">
            <!-- <img src="images/signup-bg.jpg" alt=""> -->
            <div class="container">
                <div class="signup-content">
                    <form action="<?php echo site_url(); ?>users/update_req" method="POST" id="signup-form" class="signup-form">
                        <h2 class="form-title">Update account</h2>

                        <?php
                        
                                 if(isset($user_data))
                                 {
                                  foreach($user_data->result() as $row)
                                  {
                               ?>
                        <div class="form-group">
                            <input type="text" class="form-input" name="username" value="<?php echo $row->username; ?>" id="name" placeholder="Your Name"/>
                            <span class="formerror"><?php echo form_error('username'); ?></span>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-input" name="email" id="email" value="<?php echo $row->user_email; ?>" placeholder="Your Email"/>
                            <span class="formerror"><?php echo form_error('email'); ?></span>
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-input" name="usermobile" value="<?php echo $row->user_mobile; ?>" placeholder="Enter your Mobile Number"/>
                            <span class="formerror"><?php echo form_error('usermobile'); ?></span>
                        </div>
                        <div class="form-group">
                             <input type="hidden" name="hidden_id" value="<?php echo $row->user_id; ?>" />
                             <input type="submit" name="update" value="Update" class="btn btn-info" />
                        </div>
                      <?php }} ?>
                    </form>

                </div>
            </div>
        </section>

    </div>
