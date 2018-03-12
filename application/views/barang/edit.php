<?php
    $this->load->view('header');
    $url = $this->uri->segment(3);
    $baseUrl = $this->config->item('base_url');
?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Detail Barang</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <?php           
                $res = $result[0];
            ?>
            <div class="row">
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Ubah Detail Barang
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <form id="editItemForm" action="<?= $baseUrl ?>barang/update/<?= $url ?>" method="post" role="form">
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input class="form-control" id="nama" name="nama" value="<?= $res->Nama ?>" >
                                    </div>
                                    <div class="form-group">
                                        <label>Harga Modal</label>
                                        <input class="form-control" id="modal" name="modal" value="<?= $res->Modal ?>" >
                                    </div>
                                    <div class="form-group">
                                        <label>Jumlah</label>
                                        <input class="form-control" id="jumlah" name="jumlah" value="<?= $res->Jumlah ?>" >
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
        </div>
        <!-- /#page-wrapper -->
    </div>

    <script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/metisMenu/metisMenu.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/dist/js/sb-admin-2.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery-validation-1.15.0/dist/jquery.validate.js"></script>  
    <script src="<?php echo base_url(); ?>assets/js/jquery-validation-custom.js"></script>
    <script>
    $(document).ready(function() {
        $("#editItemForm").validate({
            rules: {                
                jumlah: {
                    required: true,
                    number: true
                },
                modal: {
                    required: true,
                    number: true
                },
                nama: {
                    required: true
                }
            }
        }); 
    });
    </script>
<?php
    $this->load->view('footer');
?>