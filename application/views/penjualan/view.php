<?php
	$this->load->view('header');
    $baseUrl = $this->config->item('base_url');
?>

<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Daftar Penjualan</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-3">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Tanggal Jual
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

                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <?php           
                                if (!empty($penjualan)){
                            ?>
                            <div class="panel-body">
                                <table width="100%" class="table table-striped table-bordered table-hover" id="penjualanTable">
                                    <thead>
                                        <tr>
                                            <th >Tanggal Jual</th>
                                            <th >Total Jual</th>
                                            <th >Total Modal</th>
                                            <th >Total Laba</th>
                                            <th >Lihat</th>
                                            <th >Hapus</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php           
                                            $count = 1;          
                                            foreach($penjualan as $jual){
                                                $total = $jual->Total;
                                                $modal = $jual->Modal;
                                                $laba = $total - $modal;

                                                if($count%2==0) {
                                                    $class = "even";
                                                }
                                                else {
                                                    $class = "odd";
                                                }
                                                echo '<tr class="'.$class.'">';                        
                                                    echo '<td>';
                                                    echo $jual->Tanggal;
                                                    echo "</td>";
                                                    echo '<td>';
                                                    echo number_format($total);
                                                    echo "</td>";
                                                    echo '<td>';
                                                    echo number_format($modal);
                                                    echo "</td>";
                                                    echo '<td>';
                                                    echo number_format($laba);
                                                    echo "</td>";
                                                    echo '<td style="text-align:center">';
                                                    echo '<a href="'.$baseUrl.'penjualan/view/'.$jual->ID.'">';
                                                    echo '<img src="'.$baseUrl.'assets/images/edit.png" alt="edit" height="30" width="30" >';
                                                    echo '</a>';
                                                    echo "</td>"; 
                                                    echo '<td style="text-align:center">';
                                                    echo '<a href="#" onClick="return confirmDelete('.$jual->ID.')">';
                                                    echo '<img src="'.$baseUrl.'assets/images/delete.png" alt="delete" height="30" width="30" >';
                                                    echo '</a>';
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
            <!-- /.container-fluid -->
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
	function confirmDelete(id) {
		var password = prompt("Mohon masukkan password", "");

		if (password != null) {
			$.post("<?= $baseUrl.'user/validate_password/' ?>", {password: password}, function(result){
				if(result == "true") {
					$.post("<?= $baseUrl.'penjualan/remove/' ?>"+id, function(data){
						alert("Sukses. Halaman ini akan di 'refresh'.");
						location.reload();
					});
				}
				else {
					alert("Password tidak sesuai.");
				}
			});
		}
	};
	
    $(document).ready(function() {
        $( "#dateFrom" ).datepicker({dateFormat: "yy-mm-dd", maxDate: new Date, minDate: new Date(2007, 6, 12)});
        $( "#dateTo" ).datepicker({dateFormat: "yy-mm-dd", maxDate: new Date, minDate: new Date(2007, 6, 12)});
    
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
        $('#penjualanTable').DataTable({
            responsive: true
        });
    });
    </script>
<?php
	$this->load->view('footer');
?>