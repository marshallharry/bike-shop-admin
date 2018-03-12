<?php
	$this->load->view('header');
    $baseUrl = $this->config->item('base_url');
?>

<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Atur Profile</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>

                <?php 
                    if( !empty($error_msg) )
                    {
                ?>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <?= '<span id="errMsg" name="errMsg" style="color:red">'.$error_msg.'</span>' ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                    }
                ?>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="panel panel-default">
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <form id="editForm" action="<?= $baseUrl ?>user/update_profile" method="post" role="form">
                                        <div class="form-group">
                                            <label>Username</label>
                                            <input class="form-control" id="username" name="username" value="<?= $user->Username ?>" >
                                        </div>
                                        <div class="form-group">
                                            <label>Password Lama</label>
                                            <input class="form-control" id="password" name="password" type="password" >
                                        </div>
                                        <div class="form-group">
                                            <label>Password Baru</label>
                                            <input class="form-control" id="password_new" name="password_new" type="password" >
                                        </div>
                                        <button type="submit" class="btn btn-default">Submit</button>
                                        <button type="reset" class="btn btn-default">Reset</button>
                                    </form>
                                </div>
                                <!-- /.table-responsive -->
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
    </div>

    <script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/metisMenu/metisMenu.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/dist/js/sb-admin-2.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery-validation-1.15.0/dist/jquery.validate.js"></script>
    <script>
    $(document).ready(function() {
        $("#editForm").validate({
            rules: {                
                username: {
                    required: true
                },
                password: {
                    required: true
                }
            }
        }); 
    });
    </script>
<?php
	$this->load->view('footer');
?>