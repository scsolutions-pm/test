<div id="content">
    <div id="content-header">
        <div id="breadcrumb"><a href="<?php echo site_url('category'); ?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Interpreter</a> </div>
        <h1>All Interpreter<a class="addnew" href="<?php echo base_url(); ?>interpreter/addEditInterpreter"><button class="btn btn-inverse">Add Interpreter</button></a></h1>
    </div>
    <div class="container-fluid">
        <?php if (!empty($Success)) { ?>
            <div class="alert alert-info alert-block">
                <a class="close" data-dismiss="alert" href="#">×</a>
                <h4 class="alert-heading">Success!</h4>
                <?php echo $Success; ?> 
            </div>
        <?php } ?>  
        <?php if (!empty($Error)) { ?>
            <div class="alert alert-error alert-block">
                <a class="close" data-dismiss="alert" href="#">×</a>
                <h4 class="alert-heading">Error!</h4>
                <?php echo $Error; ?> 
            </div>
        <?php } ?>
        <?php if (validation_errors() != false) { ?>
            <div class="alert alert-error alert-block">
                <a class="close" data-dismiss="alert" href="#">×</a>
                <h4 class="alert-heading" style="margin-bottom: 5px;">Errors!</h4>
                <?php echo validation_errors(); ?>
            </div>
        <?php } ?>
        <hr>
        <div class="row-fluid">
            <div class="span12">       
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                        <h5>All Interpreter</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <table class="table table-bordered data-table" id="usertable">
                            <thead>
                                <tr>
                                    <th>SNO</th>
                                    <th>Title</th>
                                    <!-- <th>Blog Image</th> -->
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                foreach ($interpreter as $row) {
                                    ?>
                                    <tr class="gradeX">
                                        <td class="center"><?php echo $i; ?></td>
                                        <td class="center"><?php echo $row['interpreter_name']; ?></td>
                                       <!--  <td class="center"> <img height="100" width="100" src="<?php echo base_url(); ?>/uploads/blog_img/<?php echo $row['image']; ?>"></td> -->
                                        <td class="center"><?php echo $row['interpreter_description']; ?></td>
                                        <td><a href="<?php echo base_url(); ?>interpreter/addEditInterpreter/<?php echo $row['interpreter_id']; ?>"><button class='btn btn-primary btn-mini'>Edit</button></a>
                                       <!--  <button class='btn btn-danger btn-mini delete_entry' data-col="user_id" data-attr="<?php echo $row['interpreter_id'] ?>" data-atr="users" data-tablename="gm_interpreter">Delete</button> -->
                                        </td>
                                    </tr>
                                    <?php
                                    $i++;
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>