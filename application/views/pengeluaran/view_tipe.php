<?php
    $this->load->view('header');
    $baseUrl = $this->config->item('base_url');
?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Jenis Pengeluaran</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Tambah Baru
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <form id="addTipeForm" action="<?= $baseUrl ?>pengeluaran/tipe/insert" method="post" role="form">
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input class="form-control" id="nama" name="nama" >
                                    </div>
                                    <div class="form-group">
                                        <label>Total</label>
                                        <input class="form-control" id="total" name="total" >
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
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Daftar Jenis Pengeluaran
                        </div>
                        <!-- /.panel-heading -->
                        <?php           
                            if (!empty($result)){
                        ?>
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th >Nama</th>
                                        <th >Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php           
                                        $count = 1;               
                                        foreach($result as $res){
                                            if($count%2 == 0) {
                                                $class = "even";
                                            }
                                            else {
                                                $class = "odd";
                                            }
                                            echo '<tr class="'.$class.'">';                        
                                                echo '<td>';
                                                echo '<a href="'.$baseUrl.'pengeluaran/edit_tipe/'.$res->ID.'" >';
                                                echo $res->Nama;
                                                echo '</a>';
                                                echo "</td>";
                                                echo '<td>';
                                                echo number_format($res->Total);
                                                echo "</td>";
                                            echo "</tr>"; 
                                            $count++;    
                                        }                   
                                    ?>  
                                </tbody>
                            </table>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                        <?php           
                            }
                        ?>
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
        </div>
        <!-- /#page-wrapper -->
    </div>

    <script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/metisMenu/metisMenu.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/dist/js/sb-admin-2.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery-validation-1.15.0/dist/jquery.validate.js"></script>  
    <script src="<?php echo base_url(); ?>assets/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/datatables-responsive/dataTables.responsive.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery-validation-custom.js"></script>
    <script>
    $(document).ready(function() {
        $("#addTipeForm").validate({
            rules: {                
                total: {
                    required: true,
                    number: true
                },
                nama: {
                    required: true
                }
            }
        }); 
        $('#dataTables-example').DataTable({
            "responsive": true,
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
        });
    });
    </script>
<?php
    $this->load->view('footer');
?>