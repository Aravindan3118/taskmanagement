<!DOCTYPE html>
<?php
// if($this->uri->segment(1) != "login" && $this->uri->segment(1) != "register")
// {
  // if (!$this->session->userdata('user_id')) {
    // redirect('login', 'refresh');
  // }
// }

 ?>
<html lang = "en">

   <head>
      <meta charset = "utf-8">
      <title>CodeIgniter View Example</title>
      <!-- <link rel="stylesheet" href="https://bootswatch.com/4/flatly/bootstrap.min.css"> -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <link rel="stylesheet" href="<?php echo base_url(); ?>css/custom-style.css">
      <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

   </head>

   <body>
     <nav class="navbar navbar-inverse">
 <div class="container-fluid">
   <div class="navbar-header">
     <a class="navbar-brand" href="#">WebSiteName</a>
   </div>
   <ul class="nav navbar-nav">
     <li><a href="<?php echo site_url(); ?>">Home</a></li>
     <li><a href="<?php echo site_url(); ?>test">Test</a></li>
     <li><a href="<?php echo base_url() ?>posts">Posts</a></li>
     <li><a href="<?php echo base_url() ?>tasks">Tasks</a></li>
     <?php if (isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'admin'): ?>
       <li><a href="<?php echo base_url() ?>users">Users</a></li>
     <?php endif; ?>

   </ul>
   <ul class="nav navbar-nav navbar-right">
     <?php if (isset($_SESSION['username'])): ?>
     <li><a href="<?php echo base_url() ?>LogOut">LogOut</a></li>
       <?php else: ?>
     <li><a href="<?php echo base_url() ?>register">Register</a></li>
    <li><a href="<?php echo base_url() ?>login">Login</a></li>
     <?php endif; ?>
   </ul>
 </div>
</nav>
<div class="container">
  <?php
  if (isset($_SESSION['username'])) {
  echo "session Name : ".$_SESSION['username'];
  }

  ?>
