<?php
    $this->load->view('header');
    $baseUrl = $this->config->item('base_url');

    $grandModal = 0;
    $grandJual = 0;
    $grandLaba = 0;
?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Laporan Penjualan Harian</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>

            <div class="row">
                    <div class="col-lg-3">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Tanggal
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <form id="submitForm" action="" method="post" role="form">
                                        <div class="form-group">
                                            <input class="form-control" id="datePicked" name="datePicked" value="<?= !empty($datePicked)? $datePicked : "" ?>">
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
                        <!-- /.panel-heading -->
                        <?php           
                            if (!empty($result)){
                        ?>
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th >Nama Barang</th>
                                        <th >Jumlah</th>
                                        <th >Harga Modal</th>
                                        <th >Harga Jual</th>
                                        <th >Total Modal</th>
                                        <th >Total Jual</th>
                                        <th >Total Laba</th>
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
                                            $jual = $res->Harga;
                                            $modal = $res->Modal;
                                            $jumlah = $res->Jumlah;
                                            
                                            $totalModal = $modal * $jumlah;
                                            $totalJual = $jual * $jumlah;
                                            $totalLaba = $totalJual - $totalModal;

                                            $grandModal += $totalModal;
                                            $grandJual += $totalJual;
                                            $grandLaba += $totalLaba;

                                            if($totalLaba > 0) {
                                                $span = '<span style="color:blue">';
                                            }
                                            else {
                                                $span = '<span style="color:red">';
                                            }

                                            echo '<tr class="'.$class.'">';                        
                                                echo '<td>';
                                                echo $res->Nama_Barang;
                                                echo "</td>";
                                                echo '<td>';
                                                echo number_format($jumlah);
                                                echo "</td>";
                                                echo '<td>';
                                                echo number_format($modal);
                                                echo "</td>";
                                                echo '<td>';
                                                echo number_format($jual);
                                                echo "</td>";
                                                echo '<td>';
                                                echo number_format($totalModal);
                                                echo "</td>";
                                                echo '<td>';
                                                echo number_format($totalJual);
                                                echo "</td>";
                                                echo '<td>';
                                                echo $span;
                                                echo number_format($totalLaba);
                                                echo '</span>';
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

            <div class="row">
                <div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <span style="font-weight:bold">Grand Total Modal : <?= number_format($grandModal) ?></span>
                        </div>
                        <!-- /.panel-heading -->
                    </div>
                    <!-- /.panel -->
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <span style="font-weight:bold">Grand Total Jual : <?= number_format($grandJual) ?></span>
                        </div>
                        <!-- /.panel-heading -->
                    </div>
                    <!-- /.panel -->
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <span style="font-weight:bold">Grand Total Laba : <?= number_format($grandLaba) ?></span>
                        </div>
                        <!-- /.panel-heading -->
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
    <script src="<?php echo base_url(); ?>assets/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/datatables-responsive/dataTables.responsive.js"></script>
    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script> 
    <script src="<?php echo base_url(); ?>assets/js/jquery-validation-custom.js"></script>
    <script>
    $(document).ready(function() {
        $( "#datePicked" ).datepicker({dateFormat: "yy-mm-dd", maxDate: new Date, minDate: new Date(2007, 6, 12)});
    
        $("#submitForm").validate({
            rules: {                
                datePicked: {
                    date: true
                }
            }
        });
 
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
    </script>
<?php
    $this->load->view('footer');
?>