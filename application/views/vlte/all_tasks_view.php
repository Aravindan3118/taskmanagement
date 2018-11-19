<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
     <h1>
       Page Header
       <small>Optional description</small>
     </h1>
     <ol class="breadcrumb">
       <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
       <li class="active">Here</li>
     </ol>
   </section>

   <!-- Main content -->
   <section class="content container-fluid">
     <div class="add-task text-right ">
       <a href="<?php site_url(); ?>create_task"><button type="button" class="btn btn-info">Create Task</button></a>
     </div>
     <div class="box">
       <?php if ($this->uri->segment(2) == 'deleted'): ?>
         <div class="alert alert-info alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-info"></i> Task Deleted</h4>
                The Task Has been Delted
              </div>
       <?php endif; ?>
            <div class="box-header">
              <h3 class="box-title">Task List</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Task Name</th>
                  <th>Task Description</th>
                  <th>Task Type</th>
                  <th>Estimated Hours</th>
                  <th>Start Date</th>
                  <th>End Date</th>
                  <th>File</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  <?php foreach ($fetch_all->result() as $row): ?>
                    <tr>
                      <td><?php echo $row->task_name ?></td>
                      <td><?php echo $row->task_description ?></td>
                      <td><?php echo $row->tpn?></td>
                      <td><?php echo $row->estimated_hours ?></td>
                      <td><?php echo $row->start_date ?></td>
                      <td><?php echo $row->end_date ?></td>
                      <td><?php if ($row->upload_file != NULL): ?>
                        <a class="btn btn-success" href="<?php site_url();?>downloadfile/<?php echo $filename = $row->upload_file ?>"><i class="fa fa-save"></i> Download File</a>
                        <?php else: ?>
                          <p>No File for this task</p>
                      <?php endif; ?></td>
                      <td><a class='btn btn-info' href="<?php site_url(); ?>create_task/<?php echo $row->task_id; ?>">Edit</a>
                        <a class='btn btn-danger' href="<?php site_url(); ?>delete_task/<?php echo $row->task_id; ?>">Delete</a>
                      </td>
                    </tr>
                  <?php endforeach; ?>


                </tbody>
                <tfoot>
                <tr>
                  <th>Task Name</th>
                  <th>Task Description</th>
                  <th>Task Type</th>
                  <th>Estimated Hours</th>
                  <th>Start Date</th>
                  <th>End Date</th>
                  <th>File</th>
                  <th>Action</th>
                </tr>
                </tfoot>
              </table>
            </div>
          </div>

   </section>
   <!-- /.content -->
 </div>
