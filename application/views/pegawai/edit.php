<?php
    $this->load->view('header');
    $url = $this->uri->segment(3);
    $baseUrl = $this->config->item('base_url');
    $res = $result[0];
    $totalMasuk = $totalMasuk == null ? 0 : $totalMasuk;
    $totalHutang = $totalHutang == null ? 0 : $totalHutang;
    $totalGaji = ($totalMasuk * $res->Gaji) - $totalHutangLunas;
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
                <div class="col-lg-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Total Masuk Periode
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <form id="totalAbsenForm" action="<?= $baseUrl ?>pegawai/edit/<?= $url ?>" method="post" role="form">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Dari</label>
                                            <input class="form-control" id="dateFromAbsen" name="dateFromAbsen" value="<?= $dateFromAbsen ?>" >
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Total Masuk</label>
                                            <input class="form-control" value="<?= $totalMasuk ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Total Gaji</label>
                                            <input class="form-control" value="<?= number_format($totalGaji) ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Sampai</label>
                                            <input class="form-control" id="dateToAbsen" name="dateToAbsen" value="<?= $dateToAbsen ?>" >
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Total Hutang Belum Lunas</label>
                                            <input class="form-control" value="<?= number_format($totalHutang) ?>" disabled>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-default">Submit</button>
                            </form>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Tambah Hutang Barang
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <form id="hutangBarangForm" action="<?= $baseUrl ?>pegawai/add_hutang_barang/<?= $url ?>" method="post" role="form">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Nama</label>
                                            <input class="form-control" type="hidden" id="txIDBaru" name="txIDBaru" />
                                            <input class="form-control" type="text" id="txNamaBaru" name="txNamaBaru" autocomplete="off" />
                                            <ul class="dropdown-menu txtnama" style="margin-left:15px;margin-right:0px;" role="menu" aria-labelledby="dropdownMenu"  id="dropdown_barang"></ul>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Harga Modal</label>
                                            <input class="form-control" type="text" id="txModalBaru" name="txModalBaru" />
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Tanggal</label>
                                            <input class="form-control" id="tanggal_hutang_barang" name="tanggal_hutang_barang" value="<?= $tanggalHutang ?>" >
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Jumlah</label>
                                            <input class="form-control" type="text" id="txJumlahBaru" name="txJumlahBaru" />
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Harga Jual</label>
                                            <input class="form-control" type="text" id="txJualBaru" name="txJualBaru" />
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label></label>
                                            <button type="submit" class="btn btn-default">Submit</button>
                                            <button type="reset" class="btn btn-default">Reset</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
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
                            Daftar Absensi
                        </div>
						<div class="panel-body">
							<div class="col-lg-3">
								<form id="absenListForm" action="" method="post" role="form">
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
						<div class="panel-body">
							<div class="col-lg-3">
								<form id="getHutangForm" action="" method="post" role="form">
									<div class="form-group">
										<label>Tampilkan</label>
										<select class="form-control" id="filterHutang" name="filterHutang" >
                                            <option value="" <?= $filterHutang == "" ? "selected" : "" ?> >Semua</option>
											<option value="belum" <?= $filterHutang == "belum" ? "selected" : "" ?> >Belum Lunas</option>
											<option value="lunas" <?= $filterHutang == "lunas" ? "selected" : "" ?> >Sudah Lunas</option>
                                        </select>
									</div>
									<button type="submit" class="btn btn-default">Submit</button>
								</form>
							</div>
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
                                        $total = 0;              
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

                                                    $total += $hut->Sisa;
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
                                        //echo "<tr>";
                                            //echo '<td colspan="6">';
                                            //echo "<b>Total Sisa Hutang</b>";
                                            //echo "</td>";
                                            //echo "<td>";
                                            //echo number_format($total);
                                            //echo "</td>";
                                        //echo "</tr>";                   
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
                            Daftar Hutang Barang
                        </div>
						<div class="panel-body">
							<div class="col-lg-3">
								<form id="getHutangForm" action="" method="post" role="form">
									<div class="form-group">
										<label>Tampilkan</label>
										<select class="form-control" id="filterHutangBarang" name="filterHutangBarang" >
                                            <option value="" <?= $filterHutangBarang == "" ? "selected" : "" ?> >Semua</option>
											<option value="belum" <?= $filterHutangBarang == "belum" ? "selected" : "" ?> >Belum Lunas</option>
											<option value="lunas" <?= $filterHutangBarang == "lunas" ? "selected" : "" ?> >Sudah Lunas</option>
                                        </select>
									</div>
									<button type="submit" class="btn btn-default">Submit</button>
								</form>
							</div>
						</div>
                        <!-- /.panel-heading -->
                        <?php           
                            if (!empty($hutangBarang)){
                        ?>
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-hutang">
                                <thead>
                                    <tr>
                                        <th >Tanggal</th>
                                        <th >Status</th>
                                        <th >Nama Barang</th>
                                        <th >Jumlah</th>
                                        <th >Harga Modal</th>
                                        <th >Harga Jual</th>
                                        <th >Hapus</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php           
                                        $count = 1;               
                                        foreach($hutangBarang as $hut){
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
                                                }
                                                else {
                                                    echo '<a href="'.$baseUrl.'pegawai/lunas_hutang_barang/'.$url.'/'.$id.'" >';
                                                    echo 'Belum Lunas (Klik untuk melunasi)';
                                                    echo '</a>';
                                                }
                                                echo "</td>";
                                                echo '<td>';
                                                echo $hut->Nama_Barang;
                                                echo "</td>";
                                                echo '<td>';
                                                echo number_format($hut->Jumlah);
                                                echo "</td>";
                                                echo '<td>';
                                                echo number_format($hut->Modal);
                                                echo "</td>";
                                                echo '<td>';
                                                echo number_format($hut->Harga);
                                                echo "</td>";
                                                echo '<td style="text-align:center">';
                                                
                                                if($hut->Status === 'lunas') {
                                                    echo '-';
                                                }
                                                else {
                                                    echo '<a href="#" onClick="return confirmDeleteHutangBarang('.$url.','.$id.')" >';
                                                    echo '<img src="'.$baseUrl.'assets/images/delete.png" alt="delete" height="30" width="30" >';
                                                    echo '</a>';
                                                }
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

    function confirmDeleteHutangBarang(url, id) {
		var password = prompt("Mohon masukkan password", "");

		if (password != null) {
			$.post("<?= $baseUrl.'user/validate_password/' ?>", {password: password}, function(result){
				if(result == "true") {
                    window.location.href = "<?= $baseUrl.'pegawai/remove_hutang_barang/' ?>"+url+"/"+id
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
        $( "#tanggal_hutang_barang" ).datepicker({dateFormat: "yy-mm-dd", maxDate: new Date, minDate: new Date(2007, 6, 12)});
		$( "#dateFrom" ).datepicker({dateFormat: "yy-mm-dd", maxDate: new Date, minDate: new Date(2007, 6, 12)});
        $( "#dateTo" ).datepicker({dateFormat: "yy-mm-dd", maxDate: new Date, minDate: new Date(2007, 6, 12)});
		$( "#dateFromAbsen" ).datepicker({dateFormat: "yy-mm-dd", maxDate: new Date, minDate: new Date(2007, 6, 12)});
        $( "#dateToAbsen" ).datepicker({dateFormat: "yy-mm-dd", maxDate: new Date, minDate: new Date(2007, 6, 12)});
    
        $("#absenListForm").validate({
            rules: {                
                dateFrom: {
                    date: true
                },
                dateTo: {
                    date: true
                }
            }
        });
		$("#totalAbsenForm").validate({
            rules: {                
                dateFromAbsen: {
                    date: true,
                    required: true
                },
                dateToAbsen: {
                    date: true,
                    required: true
                }
            }
        });
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
        $("#hutangBarangForm").validate({
            rules: {                
                tanggal_hutang_barang: {
                    date: true,
                    required: true
                },
                txNamaBaru: {
                    required: true
                },
                txJumlahBaru: {
                    required: true,
                    number: true
                },
                txJualBaru: {
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
    
        $(window).click(function() {
            $('#dropdown_barang').hide();
        });

        $("#txNamaBaru").keyup(function () {
            const keyword = $("#txNamaBaru").val();
            if (keyword !== "") {
                $.ajax({
                    type: "POST",
                    url: "<?= $baseUrl ?>barang/auto_complete",
                    data: {
                        keyword: keyword
                    },
                    dataType: "json",
                    success: function (data) {
                        $('#dropdown_barang').empty();
                        if (data.length > 0) {
                            $('#dropdown_barang').show();
                            $('#txNamaBaru').attr("data-toggle", "dropdown");
                        }
                        else if (data.length == 0) {
                            $('#dropdown_barang').hide();
                            $('#txNamaBaru').attr("data-toggle", "");
                        }
                        $.each(data, function (key,value) {
                            if (data.length >= 0) {
                                text = value['Nama'] + ' - Rp ' + value['Modal'];
                                $('#dropdown_barang').append('<li role="displayCountries" ><a data-nama="' + value['Nama'] + '" data-id="' + value['ID'] + '" data-modal="' + value['Modal'] + '" role="menuitem dropdown_barangli" class="dropdownlivalue">' + text + '</a></li>');
                            }
                        });
                    }
                });
            } else {
                $('#dropdown_barang').hide();
            }
        });

        $('ul.txtnama').on('click', 'li a', function () {
            $('#txNamaBaru').val($(this).data('nama'));
            $('#txModalBaru').val($(this).data('modal'));
            $('#txIDBaru').val($(this).data('id'));
        });
    });
    </script>
<?php
    $this->load->view('footer');
?>