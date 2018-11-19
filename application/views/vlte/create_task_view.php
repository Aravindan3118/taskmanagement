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
      <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Create Task</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <!-- enctype="multipart/form-data" -->
            <!-- <form action="<?php site_url(); ?>task_upload" method="post" class="form-horizontal"> -->

            <?php echo form_open_multipart('tasks/task_upload',array('class' => 'form-horizontal'));?>
            <?php if ($this->uri->segment(2) == 'created'): ?>
              <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Task Created</h4>
                The Task has been successfully created.
              </div>
            <?php endif; ?>
              <div class="box-body">
                <?php if ($this->uri->segment(3) != NULL): ?>
                  <?php if ($this->uri->segment(2) == 'updated'): ?>
                    <div class="alert alert-info alert-dismissible">
                           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                           <h4><i class="icon fa fa-info"></i> Task Updated</h4>
                           The Task Has been Updated
                         </div>
                  <?php endif; ?>
                  <?php foreach ($fetch_edit_data->result() as $row): ?>
                    <div class="form-group">
                  <label for="taskname" class="col-sm-2 control-label">Name</label>

                  <div class="col-sm-10">
                    <input type="text" name='taskname' class="form-control" id="taskname" placeholder="Task Name" value="<?php if (isset($_POST['update_task'])) { echo $_POST['taskname'];
                    }else{echo $row->task_name;}  ?>">
                    <span class='formerror'><?php echo form_error('taskname'); ?></span>
                    <span class="formerror"><?php if($this->session->flashdata('task_name_error')){echo $this->session->flashdata('task_name_error');} ?></span>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Task description</label>
                  <div class="col-sm-10">
                  <textarea name="taskdescription" class="form-control" rows="8" placeholder="Task Description here..."><?php if (isset($_POST['update_task'])) { echo $_POST['taskdescription'];
                  }else{echo $row->task_description;} ?></textarea>
                  <span class='formerror'><?php echo form_error('taskdescription'); ?></span>
                </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Task Type</label>
                  <div class="col-sm-10">
                  <select name="task_type" class="form-control">
                    <?php foreach ($fetch_type ->result() as $rows): ?>
                      <option value="<?php echo $rows->task_type_id ?>"><?php echo $rows->task_type_name; ?></option>
                    <?php endforeach; ?>
                  </select>
                  <span class='formerror'><?php echo form_error('task_type'); ?></span>
                </div>
                </div>
          <div class="form-group">
            <label for="estimatedhour" class="col-sm-2 control-label">Estimated Hours</label>

            <div class="col-sm-10">
              <input type="number" name="taskestimation" class="form-control" id="estimatedhour" placeholder="Estimated Hours" value="<?php if (isset($_POST['update_task'])) { echo $_POST['taskestimation'];
              }else{echo $row->estimated_hours;} ?>">
              <span class='formerror'><?php echo form_error('taskestimation'); ?></span>
            </div>
          </div>
          <div class="form-group">

                <label class="col-sm-2 control-label">Task Start Date</label>
                <div class="col-sm-10">
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" name="taskstartdate" class="form-control pull-right" id="startdatepicker" value="<?php if (isset($_POST['update_task'])) { echo $_POST['taskstartdate'];
                  }else{echo $row->dfstart;} ?>">
                  </div>
                  <span class='formerror'><?php echo form_error('taskstartdate'); ?></span>

              </div>
                <!-- /.input group -->
              </div>
              <div class="form-group">
                    <label class="col-sm-2 control-label">Task End Date</label>
                    <div class="col-sm-10">
                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" name="taskenddate" class="form-control pull-right" id="enddatepicker" value="<?php if (isset($_POST['update_task'])) { echo $_POST['taskenddate'];
                      }else{echo $row->dfend;} ?>">

                    </div>
                    <span class='formerror'><?php echo form_error('taskenddate'); ?></span>
                    <span class="formerror"><?php if($this->session->flashdata('date_error')){echo $this->session->flashdata('date_error');} ?></span>

                   <?php //if ($error_message!= NULL): ?>
                     <!-- <span class='formerror'><?php //echo $error_message; ?><span> -->
                   <?php //endif; ?>
                  </div>
                    <!-- /.input group -->
                  </div>
                  <div class="form-group">
                        <label class="col-sm-2 control-label">Uploaded File</label>
                        <div class="col-sm-10">
                  <!-- <input type="file" name="fileupload" value="fileupload" id="fileupload" size="20"> -->
                  <input type="text" name="hideenfile" hidden value="<?php echo $row->upload_file; ?>">
                  <input type="text" name="hideentaskid" hidden value="<?php echo $row->task_id; ?>">
                  <?php foreach ($fetch_file_data->result() as $file_row): ?>
                    <a href="<?php echo base_url(); ?>uploads/<?php echo $file_row->file_name; ?>"><?php echo $file_row->file_name; ?>&nbsp;&nbsp;&nbsp;</a>
                    <a class="btn btn-danger delete_file" id="<?php echo $file_row->file_id; ?>">Delete</a><br>
                    <?php $this->session->set_flashdata('task_id',$row->task_id); ?>
                  <?php endforeach; ?>

                    <button type="button" id='changefilebtn' class="btn btn-info">Add File</button>
                </div>
              </div>
                  <div class="form-group" id='changefile'>
                        <label class="col-sm-2 control-label">Upload File</label>
                        <div class="col-sm-10">
                  <input type="file" name="fileupload[]" multiple='' value="fileupload" id="fileupload" size="20">
                  <span style="color:green;font-size:18px;">Allowed TYPES: gif, jpg, png, bmp, jpeg, pdf, doc, docx, ppt, pptx, xls</span>
                  <span class="formerror"><?php if($this->session->flashdata('error')){echo $this->session->flashdata('error');} ?></span>

                </div>
              </div>
            <?php endforeach; ?>
            <div class="box-footer">

              <input type="submit" name="update_task"  class="btn btn-info pull-right" value="Update Task"></input>
            </div>
            <?php else: ?>
              <div class="form-group">
            <label for="taskname" class="col-sm-2 control-label">Name</label>

            <div class="col-sm-10">
              <input type="text" name='taskname' class="form-control" id="taskname" placeholder="Task Name" value="<?php if (isset($_POST['submit_task'])) { echo $_POST['taskname'];
              }  ?>">
              <span class='formerror'><?php echo form_error('taskname'); ?></span>
              <span class="formerror"><?php if($this->session->flashdata('task_name_error')){echo $this->session->flashdata('task_name_error');} ?></span>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">Task description</label>
            <div class="col-sm-10">
            <textarea name="taskdescription" class="form-control" rows="8" placeholder="Task Description here..."><?php if (isset($_POST['submit_task'])) { echo $_POST['taskdescription'];
            } ?></textarea>
            <span class='formerror'><?php echo form_error('taskdescription'); ?></span>
          </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">Task Type</label>
            <div class="col-sm-10">
            <select name="task_type" class="form-control">
              <?php foreach ($fetch_type ->result() as $rows): ?>
                <option value="<?php echo $rows->task_type_id ?>"><?php echo $rows->task_type_name; ?></option>
              <?php endforeach; ?>
            </select>
            <span class='formerror'><?php echo form_error('task_type'); ?></span>
          </div>
          </div>
    <div class="form-group">
      <label for="estimatedhour" class="col-sm-2 control-label">Estimated Hours</label>

      <div class="col-sm-10">
        <input type="number" name="taskestimation" class="form-control" id="estimatedhour" placeholder="Estimated Hours" value="<?php if (isset($_POST['submit_task'])) { echo $_POST['taskestimation'];
        }?>">
        <span class='formerror'><?php echo form_error('taskestimation'); ?></span>
      </div>
    </div>
    <div class="form-group">

          <label class="col-sm-2 control-label">Task Start Date</label>
          <div class="col-sm-10">
          <div class="input-group date">
            <div class="input-group-addon">
              <i class="fa fa-calendar"></i>
            </div>
            <input type="text" name="taskstartdate" class="form-control pull-right" id="startdatepicker" value="<?php if (isset($_POST['
            _task'])) { echo $_POST['taskstartdate'];
            }?>">
            </div>
            <span class='formerror'><?php echo form_error('taskstartdate'); ?></span>

        </div>
          <!-- /.input group -->
        </div>
        <div class="form-group">
              <label class="col-sm-2 control-label">Task End Date</label>
              <div class="col-sm-10">
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="text" name="taskenddate" class="form-control pull-right" id="enddatepicker" value="<?php if (isset($_POST['submit_task'])) { echo $_POST['taskenddate'];
                }?>">

              </div>
              <span class='formerror'><?php echo form_error('taskenddate'); ?></span>
              <span class="formerror"><?php if($this->session->flashdata('date_error')){echo $this->session->flashdata('date_error');} ?></span>
            </div>
              <!-- /.input group -->
            </div>
            <div class="form-group">
                  <label class="col-sm-2 control-label">Upload File</label>
                  <div class="col-sm-10">
            <input type="file" multiple="" name="fileupload[]" value="fileupload" id="fileupload" size="20">

            <span style="color:green;font-size:18px;">Allowed TYPES: gif, jpg, png, bmp, jpeg, pdf, doc, docx, ppt, pptx, xls</span>
            <span class="formerror"><?php if($this->session->flashdata('error')){echo $this->session->flashdata('error');} ?></span>

          </div>
        </div>
        <div class="box-footer">

          <input type="submit" name="submit_task"  class="btn btn-info pull-right" value="Create Task"></input>
        </div>
        <?php endif; ?>

              </div>
              <!-- /.box-body -->

              <!-- /.box-footer -->
            </form>
          </div>
    </section>
    <!-- /.content -->
  </div>
