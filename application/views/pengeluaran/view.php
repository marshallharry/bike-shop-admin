<?php
    $this->load->view('header');
    $baseUrl = $this->config->item('base_url');

    $grand = 0;
?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Pengeluaran</h1>
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
                                <form id="addForm" action="<?= $baseUrl ?>pengeluaran/view/insert" method="post" role="form">
                                    <div class="form-group">
                                        <label>Tanggal</label>
                                        <input class="form-control" id="tanggal" name="tanggal" value="<?= !empty($tanggal)? $tanggal : "" ?>" >
                                    </div>
                                    <div class="form-group">
                                        <label>Pilih Jenis</label>
                                        <select class="form-control" id="pilih" name="pilih" onchange="pilihJenis(this);" >
                                            <option value="-1">Lainnya</option>
                                            <?php           
                                                if (!empty($tipe)){
                                                    foreach($tipe as $t){
                                                        echo '<option value="';
                                                        echo $t->Total;
                                                        echo '">';                                  
                                                        echo $t->Nama;
                                                        echo "</option>";                                               
                                                    }   
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Keterangan</label>
                                        <input class="form-control" id="keterangan" name="keterangan" >
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
                            Daftar Pengeluaran
                        </div>
                        <!-- /.panel-heading -->
                        <?php           
                            if (!empty($result)){
                        ?>
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th >Tanggal</th>
                                        <th >Keterangan</th>
                                        <th >Total</th>
                                        <th >Hapus</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php           
                                        $count = 1;               
                                        foreach($result as $res){
                                            $total = $res->Total;
                                            $grand += $total;

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
                                                echo $res->Keterangan;
                                                echo "</td>";
                                                echo '<td>';
                                                echo number_format($total);
                                                echo "</td>";
                                                echo '<td style="text-align:center">';
                                                echo '<a href="#" onClick="return confirmDelete('.$res->ID.')" >';
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

            <div class="row">
                <div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <span style="font-weight:bold">Total Pengeluaran : <?= number_format($grand) ?></span>
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
	function confirmDelete(id) {
		var password = prompt("Mohon masukkan password", "");

		if (password != null) {
			$.post("<?= $baseUrl.'user/validate_password/' ?>", {password: password}, function(result){
				if(result == "true") {
                    window.location.href = "<?= $baseUrl.'pengeluaran/remove/' ?>"+id
				}
				else {
					alert("Password tidak sesuai.");
				}
			});
		}
	};
	
    function pilihJenis(data)
    {
       var total = parseInt(data.value);
       var keterangan = $('#pilih option:selected').text();

       if(total == -1) {
            $('#keterangan').val('');
            $('#total').val('');
            $('#keterangan').prop("readonly", false);
            $('#total').prop("readonly", false);
       }
       else {
            $('#keterangan').val(keterangan);
            $('#total').val(total);
            $('#keterangan').prop("readonly", true);
            $('#total').prop("readonly", true);
       }
       
    };

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
                total: {
                    required: true,
                    number: true
                },
                keterangan: {
                    required: true
                },
                tanggal: {
                    required: true,
                    date: true
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