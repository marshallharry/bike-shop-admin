<?php
	$this->load->view('header');
    $baseUrl = $this->config->item('base_url');

    $status = $header->Status === 'lunas' ? 'LUNAS' : 'BELUM LUNAS';
    $headerid = $header->ID;
    $grandTotal = $header->Total;
?>

<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Detail Pembelian</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-6">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <form id="submitForm" action="<?= $baseUrl ?>pembelian/lunas" method="post" role="form">
                                        <div class="form-group">
                                            <label>Tanggal Beli : <?= $header->Tanggal_Beli ?></label>
                                        </div>
                                        <div class="form-group">
                                            <label>Nama Supplier : <?= $header->Nama_Supplier ?></label>
                                        </div>
                                        <div class="form-group">
                                            <label>Total : <?= number_format($grandTotal) ?></label>
                                        </div>
                                        <div class="form-group">
                                            <label>Jatuh Tempo : <?= $header->Jatuh_Tempo.' hari' ?></label>
                                        </div>
                                        <div class="form-group">
                                            <label>Status : <?= $status ?></label>
                                        </div>
                                        <?php 
                                        if($header->Status === 'lunas') {
                                        ?>
                                            <div class="form-group">
                                                <label>Tanggal Lunas : <?= $header->Tanggal_Lunas ?></label>
                                            </div>
                                            <div class="form-group">
                                                <label>Pembayaran : <?= $header->Tanggal_Lunas === 'tunai'? 'Tunai' : 'Non Tunai' ?></label>
                                            </div>
                                        <?php 
                                        }
                                        else {
                                        ?>
                                            <div class="form-group">
                                                <label>Tanggal Lunas</label>
                                                <input class="form-control" id="txDate" name="txDate" value="<?= date('Y-m-d') ?>" >
                                            </div>
                                            <div class="form-group">
                                                <label>Pilih Pembayaran</label>
                                                <select class="form-control" id="payment" name="payment" >
                                                    <option value="tunai">Tunai</option>
                                                    <option value="non">Non Tunai</option>
                                                </select>
                                            </div>
                                            <input type="hidden" value="<?= $headerid ?>" name="txID" id="txID" />
                                            <button type="submit" class="btn btn-default">Submit</button>
                                        <?php 
                                        }
                                        ?>
                                        <div class="form-group">
                                            <a href="<?= $baseUrl ?>pembelian/retur/<?= $headerid ?>" class="btn btn-default">Retur Barang</a>
                                        </div>
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
                            <div class="panel-heading">
                                Daftar Barang
                            </div>
                            <?php           
                                if (!empty($details)){
                            ?>
                            <div class="panel-body">
                                <table width="100%" class="table" >
                                    <thead>
                                        <tr>
                                            <th >Nama Barang</th>
                                            <th >Harga Modal</th>
                                            <th >Diskon</th>
                                            <th >PPN</th>
                                            <th >Jumlah</th>
                                            <th >Total</th>
                                            <th >Hapus</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php           
                                            $count = 1;          
                                            foreach($details as $detail){
                                                $modal = $detail->Modal_Barang;
                                                $jumlah = $detail->Jumlah;
                                                $diskon = $detail->Diskon;
                                                $ppn = $detail->PPN;
                                                $total = ($modal - $diskon + $ppn) * $jumlah;
                                                $id = $detail->ID;
                                                if($count%2==0) {
                                                    $class = "even";
                                                }
                                                else {
                                                    $class = "odd";
                                                }
                                                echo '<tr class="'.$class.'">';                        
                                                    echo '<td>';
                                                    echo $detail->Nama_Barang;
                                                    echo "</td>";
                                                    echo '<td>';           
                                                    echo number_format($modal);
                                                    echo "</td>";
                                                    echo '<td>';           
                                                    echo number_format($diskon);
                                                    echo "</td>";
                                                    echo '<td>';           
                                                    echo number_format($ppn);
                                                    echo "</td>";
                                                    echo '<td>';
                                                    echo number_format($jumlah);
                                                    echo "</td>";
                                                    echo '<td>';
                                                    echo number_format($total);
                                                    echo "</td>";
                                                    echo '<td>';
                                                    echo '<a href="#" onClick="return confirmDelete('.$id.','.$headerid.')" >';
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
        function confirmDelete(id, headerid) {
            var password = prompt("Mohon masukkan password", "");

            if (password != null) {
                $.post("<?= $baseUrl.'user/validate_password/' ?>", {password: password}, function(result){
                    if(result == "true") {
                        window.location.href = "<?= $baseUrl.'pembelian/remove_detail/' ?>"+headerid+"/"+id
                    }
                    else {
                        alert("Password tidak sesuai.");
                    }
                });
            }
        };

        $(document).ready(function() {
            $( "#txDate" ).datepicker({dateFormat: "yy-mm-dd", maxDate: new Date, minDate: new Date(2007, 6, 12)});
        });
    </script>
<?php
	$this->load->view('footer');
?>