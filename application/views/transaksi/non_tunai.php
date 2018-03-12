<?php
    $this->load->view('header');
    $baseUrl = $this->config->item('base_url');
?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Keuangan Non Tunai</h1>
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
                                <form id="addForm" action="<?= $baseUrl ?>transaksi/non_tunai/insert" method="post" role="form">
                                    <div class="form-group">
                                        <label>Tanggal</label>
                                        <input class="form-control" id="tanggal" name="tanggal" value="<?= !empty($tanggal)? $tanggal : "" ?>" >
                                    </div>
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select class="form-control" id="status" name="status" >
                                            <option value="Setor/Debit">Setor/Debit</option>
                                            <option value="Tarik/Transfer">Tarik/Transfer</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Jumlah</label>
                                        <input class="form-control" id="jumlah" name="jumlah" >
                                    </div>
                                    <div class="form-group">
                                        <label>Sisa Saldo</label>
                                        <input class="form-control" id="saldo" name="saldo" value="<?= $saldo ?>"
                                        readonly >
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
                                            <label>Dari</label>
                                            <input class="form-control" id="dateFrom" name="dateFrom" value="<?= !empty($dateFrom)? $dateFrom : "" ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Sampai</label>
                                            <input class="form-control" id="dateTo" name="dateTo" value="<?= !empty($dateTo)? $dateTo : "" ?>" >
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
                            Daftar Keuangan Non Tunai
                        </div>
                        <!-- /.panel-heading -->
                        <?php           
                            if (!empty($result)){
                        ?>
                        <div class="panel-body">
                            <table width="100%" class="table">
                                <thead>
                                    <tr>
                                        <th >Tanggal</th>
                                        <th >Status</th>
                                        <th >Jumlah</th>
                                        <th >Sisa Saldo</th>
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
                                                echo $res->Tanggal;
                                                echo "</td>";
                                                echo '<td>';
                                                echo $res->Status;
                                                echo "</td>";
                                                echo '<td>';
                                                echo number_format($res->Jumlah);
                                                echo "</td>";
                                                echo '<td>';
                                                echo number_format($res->Saldo);
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
    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script> 
    <script src="<?php echo base_url(); ?>assets/js/jquery-validation-custom.js"></script>
    <script>
    $(document).ready(function() {
        $( "#dateFrom" ).datepicker({dateFormat: "yy-mm-dd", maxDate: new Date, minDate: new Date(2007, 6, 12)});
        $( "#dateTo" ).datepicker({dateFormat: "yy-mm-dd", maxDate: new Date, minDate: new Date(2007, 6, 12)});
        $( "#tanggal" ).datepicker({dateFormat: "yy-mm-dd", maxDate: new Date, minDate: new Date(2007, 6, 12)});
    
        $("#submitForm").validate({
            rules: {                
                dateFrom: {
                    date: true
                },
                dateTo: {
                    date: true
                }
            }
        });

        $("#addForm").validate({
            rules: {                
                jumlah: {
                    required: true,
                    number: true
                },
                saldo: {
                    required: true,
                    number: true
                },
                tanggal: {
                    required: true,
                    date: true
                }
            }
        }); 
    });
    </script>
<?php
    $this->load->view('footer');
?>