<?php
    $this->load->view('header');
    $url = $this->uri->segment(3);
    $baseUrl = $this->config->item('base_url');
    $res = $result[0];
    $totalMasuk = $totalMasuk == null ? 0 : $totalMasuk;
    $totalHutang = $totalHutang == null ? 0 : $totalHutang;
    $totalGaji = ($totalMasuk * $res->Gaji) - $totalHutang;
?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Detail Pegawai</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Ubah Detail Pegawai
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <form id="editForm" action="<?= $baseUrl ?>pegawai/update/<?= $url ?>" method="post" role="form">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input class="form-control" id="nama" name="nama" value="<?= $res->Nama ?>" >
                                    </div>
                                    <div class="form-group">
                                        <label>Nomor Telepon</label>
                                        <input class="form-control" id="telp" name="telp" value="<?= $res->Telp ?>" >
                                    </div>
                                    <div class="form-group">
                                        <label>Gaji per Hari</label>
                                        <input class="form-control" id="gaji" name="gaji" value="<?= $res->Gaji ?>" >
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

                <div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Absen Pegawai
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <form id="absenForm" action="<?= $baseUrl ?>pegawai/absen/<?= $url ?>" method="post" role="form">
                                    <div class="form-group">
                                        <label>Tanggal</label>
                                        <input class="form-control" id="tanggal" name="tanggal" value="<?= $tanggal ?>" >
                                    </div>
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select class="form-control" id="status" name="status" >
                                            <option value="masuk" <?= $status === 'masuk'?'selected':'' ?> >Masuk</option>"
                                            <option value="tidak_masuk" <?= $status === 'tidak_masuk'?'selected':'' ?> >Tidak Masuk</option>"
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Keterangan</label>
                                        <input class="form-control" id="keterangan" name="keterangan" value="<?= $keterangan ?>" >
                                    </div>
                                    <button type="submit" class="btn btn-default">Submit</button>
                                    <button type="reset" class="btn btn-default">Reset</button>
                                    <?php
                                        if( isset($error_msg) && !empty($error_msg) ) {
                                            echo '<span style="color:red" >';
                                            echo $error_msg;
                                            echo '</span>';
                                        } 
                                    ?>
                                </form>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>

                <div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Tambah Hutang
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <form id="hutangForm" action="<?= $baseUrl ?>pegawai/add_hutang/<?= $url ?>" method="post" role="form">
                                    <div class="form-group">
                                        <label>Tanggal</label>
                                        <input class="form-control" id="tanggal_hutang" name="tanggal_hutang" value="<?= $tanggalHutang ?>" >
                                    </div>
                                    <div class="form-group">
                                        <label>Jumlah</label>
                                        <input class="form-control" id="jumlah" name="jumlah"  >
                                    </div>
                                    <div class="form-group">
                                        <label>Keterangan</label>
                                        <input class="form-control" id="keterangan_hutang" name="keterangan_hutang"  >
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
                <div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Total Masuk Bulan Ini : <?= $totalMasuk ?>
                        </div>
                        <!-- /.panel-heading -->
                    </div>
                    <!-- /.panel -->
                </div>

                <div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Total Hutang Belum Lunas : <?= number_format($totalHutang) ?>
                        </div>
                        <!-- /.panel-heading -->
                    </div>
                    <!-- /.panel -->
                </div>

                <div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Total Gaji Bulan Ini : <?= number_format($totalGaji) ?>
                        </div>
                        <!-- /.panel-heading -->
                    </div>
                    <!-- /.panel -->
                </div>
            </div>

            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Daftar Absensi
                        </div>
                        <!-- /.panel-heading -->
                        <?php           
                            if (!empty($absensi)){
                        ?>
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th >Tanggal</th>
                                        <th >Status</th>
                                        <th >Keterangan</th>
                                        <th >Hapus</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php           
                                        $count = 1;               
                                        foreach($absensi as $abs){
                                            if($count%2 == 0) {
                                                $class = "even";
                                            }
                                            else {
                                                $class = "odd";
                                            }
                                            echo '<tr class="'.$class.'">';                        
                                                echo '<td>';
                                                echo $abs->Tanggal;
                                                echo "</td>";
                                                echo '<td>';
                                                echo $abs->Status === 'masuk'? 'Masuk' : 'Tidak Masuk';
                                                echo "</td>";
                                                echo '<td>';
                                                echo $abs->Keterangan;
                                                echo "</td>";
                                                echo "</td>";
                                                echo '<td style="text-align:center">';
                                                echo '<a href="#" onClick="return confirmDeleteAbsen('.$url.','.$abs->ID.')" >';
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
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Daftar Hutang
                        </div>
                        <!-- /.panel-heading -->
                        <?php           
                            if (!empty($hutang)){
                        ?>
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-hutang">
                                <thead>
                                    <tr>
                                        <th >Tanggal</th>
                                        <th >Status</th>
                                        <th >Keterangan</th>
                                        <th >Jumlah</th>
                                        <th >Sisa</th>
                                        <th >Lunasi Sebagian</th>
                                        <th >Hapus</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php           
                                        $count = 1;               
                                        foreach($hutang as $hut){
                                            if($count%2 == 0) {
                                                $class = "even";
                                            }
                                            else {
                                                $class = "odd";
                                            }
                                            $id = $hut->ID;
                                            echo '<tr class="'.$class.'">';                        
                                                echo '<td>';
                                                echo $hut->Tanggal;
                                                echo "</td>";
                                                echo '<td>';
                                                if($hut->Status === 'lunas') {
                                                    echo 'Lunas';
                                                    $disabled = "disabled";
                                                }
                                                else {
                                                    echo '<a href="'.$baseUrl.'pegawai/lunas_hutang/'.$url.'/'.$id.'" >';
                                                    echo 'Belum Lunas (Klik untuk melunasi semua)';
                                                    echo '</a>';
                                                    $disabled = "";
                                                }
                                                echo "</td>";
                                                echo '<td>';
                                                echo $hut->Keterangan;
                                                echo "</td>";
                                                echo '<td>';
                                                echo number_format($hut->Jumlah);
                                                echo "</td>";
                                                echo '<td>';
                                                echo number_format($hut->Sisa);
                                                echo "</td>";
                                                echo '<td style="text-align:center">';
                                                echo '<form class="formLunas" action="'.$baseUrl.'pegawai/lunas_sebagian/'.$url.'/'.$id.'" method="post">';
                                                echo '<input data-val="'.$hut->Sisa.'" type="text" class="txLunas" id="txLunas'.$id.'" name="txLunas'.$id.'" '.$disabled.' />';
                                                echo ' <button type="submit" class="btn btn-default" '.$disabled.' >>></button>';
                                                echo '</form>';
                                                echo "</td>";
                                                echo '<td style="text-align:center">';
                                                echo '<a href="#" onClick="return confirmDeleteHutang('.$url.','.$id.')" >';
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
        <!-- /#page-wrapper -->
    </div>

    <script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/metisMenu/metisMenu.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/dist/js/sb-admin-2.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery-validation-1.15.0/dist/jquery.validate.js"></script> 
    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>  
    <script src="<?php echo base_url(); ?>assets/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/datatables-responsive/dataTables.responsive.js"></script> 
    <script src="<?php echo base_url(); ?>assets/js/jquery-validation-custom.js"></script>
    <script>

	function confirmDeleteAbsen(url, id) {
		var password = prompt("Mohon masukkan password", "");

		if (password != null) {
			$.post("<?= $baseUrl.'user/validate_password/' ?>", {password: password}, function(result){
				if(result == "true") {
                    window.location.href = "<?= $baseUrl.'pegawai/remove_absen/' ?>"+url+"/"+id
				}
				else {
					alert("Password tidak sesuai.");
				}
			});
		}
	};
	
	function confirmDeleteHutang(url, id) {
		var password = prompt("Mohon masukkan password", "");

		if (password != null) {
			$.post("<?= $baseUrl.'user/validate_password/' ?>", {password: password}, function(result){
				if(result == "true") {
                    window.location.href = "<?= $baseUrl.'pegawai/remove_hutang/' ?>"+url+"/"+id
				}
				else {
					alert("Password tidak sesuai.");
				}
			});
		}
	};
	
    function validateLunas(a, b)
    {
        if (isNaN(a) || a < 1 ) 
        {
            alert("Jumlah Lunas Sebagian harus angka dan lebih dari 0.");
            return false;
        }
        else if(a > b)
        {
            alert("Jumlah Lunas Sebagian tidak boleh melebihi Sisa Hutang");
            return false;
        }
        else
        {
            return true;
        }
    };

    $(document).ready(function() {
        $( "#tanggal" ).datepicker({dateFormat: "yy-mm-dd", maxDate: new Date, minDate: new Date(2007, 6, 12)});
        $( "#tanggal_hutang" ).datepicker({dateFormat: "yy-mm-dd", maxDate: new Date, minDate: new Date(2007, 6, 12)});
        $("#editForm").validate({
            rules: {                
                telp: {
                    number: true
                },
                gaji: {
                    required: true,
                    number: true
                },
                nama: {
                    required: true
                }
            }
        }); 
        $("#absenForm").validate({
            rules: {                
                tanggal: {
                    date: true,
                    required: true
                }
            }
        });
        $("#hutangForm").validate({
            rules: {                
                tanggal_hutang: {
                    date: true,
                    required: true
                },
                keterangan_hutang: {
                    required: true
                },
                jumlah: {
                    required: true,
                    number: true
                }
            }
        }); 
        $('#dataTables-example').DataTable({
            "scrollX": true,
            "lengthMenu": [[5, 10, 50, -1], [5, 10, 50, "All"]]
        });
        $('#dataTables-hutang').DataTable({
            "scrollX": true,
            "lengthMenu": [[5, 10, 50, -1], [5, 10, 50, "All"]]
        });

        $( ".formLunas" ).submit(function( event ) {
            var eleinput = $(this).find('.txLunas');
            a = parseFloat(eleinput.val());
            b = parseFloat(eleinput.data('val'));

            res = validateLunas(a, b);
            if(res == false) {
                event.preventDefault();
            }
        });
    });
    </script>
<?php
    $this->load->view('footer');
?>