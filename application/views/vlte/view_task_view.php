<div class="content-wrapper">
   <!-- Content Header (Page header) -->
 

   <!-- Main content -->
   <section class="content container-fluid">
     <div class="box">
             <?php foreach ($fetch_edit_data->result() as $row): ?>
               TASK NAME : <?php echo $row->task_name; ?><br>
               TASK Description : <?php echo $row->task_name; ?><br>
               TASK START DATE : <?php echo $row->task_name; ?><br>
               TASK END DATE : <?php echo $row->task_name; ?><br>
               TASK NAME : <?php echo $row->task_name; ?><br>
             <?php endforeach; ?>
          </div>
   </section>
   <!-- /.content -->
 </div>
