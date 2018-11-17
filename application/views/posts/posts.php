<form action="<?php echo base_url(); ?>/posts/form_validation" method="post">
Field 1 = <input type ="text" name="name_field">
<input type='submit' name="insert" value="insert">
<span class="danger" style="background-color:red"><?php echo form_error('name_field'); ?></span>
</form>
