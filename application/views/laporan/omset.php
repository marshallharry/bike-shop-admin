<?php
    $this->load->view('header');
    $baseUrl = $this->config->item('base_url');
?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Laporan Omset</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>

            <div class="row">
                    <div class="col-lg-3">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Pilih Bulan Tahun
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <form id="submitForm" action="" method="post" role="form">
                                        <div class="form-group">
                                            <label>Bulan</label>
                                            <select class="form-control" id="bulan" name="bulan" >
                                                <?php 
                                                    $bulan = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

                                                    $arrlength=count($bulan);

                                                    for($x = 0; $x < $arrlength; $x++)
                                                    {
                                                        $selected = '';
                                                        if($month == $x + 1)
                                                            $selected = 'selected';
                                                        echo '<option value="'.($x + 1).'" '.$selected.' >'.$bulan[$x].'</option>"';
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Tahun</label>
                                            <select class="form-control" id="tahun" name="tahun" >
                                                <?php
                                                $currentYear = date('Y');
                                                for($x = 2013; $x <= $currentYear; $x++)
                                                {
                                                    $selected = '';
                                                        if($year == $x)
                                                            $selected = 'selected';
                                                    echo '<option value="'.$x.'" '.$selected.' >'.$x.'</option>';
                                                }
                                                ?>
                                            </select>
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
                            <table width="100%" class="table" >
                                <thead>
                                    <tr>
                                        <th >Tanggal</th>
                                        <th >Penjualan Kotor</th>
                                        <th >Pembayaran Tunai</th>
                                        <th >Pembayaran Non Tunai</th>
                                        <th >Pengeluaran</th>
                                        <th >Setor/Debit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php           
                                        $count = 1;   
                                        $totalJual = 0;
                                        $totalBayar = 0;
                                        $totalBayarTunai = 0;
                                        $totalBiaya = 0;
                                        $totalSetor = 0;            
                                        foreach($result as $res){
                                            if($count%2 == 0) {
                                                $class = "even";
                                            }
                                            else {
                                                $class = "odd";
                                            }
                                            $jual = $res->Jual;
                                            $bayar = $res->Bayar;
                                            $bayarTunai = $res->Bayar_Tunai;
                                            $biaya = $res->Biaya;
                                            $setor = $res->Setor;

                                            $totalJual += $jual;
                                            $totalSetor += $setor;
                                            $totalBiaya += $biaya;
                                            $totalBayar += $bayar;
                                            $totalBayarTunai += $bayarTunai;

                                            echo '<tr class="'.$class.'">';                        
                                                echo '<td>';
                                                echo $res->Tanggal;
                                                echo "</td>";
                                                echo '<td>';
                                                echo number_format($jual);
                                                echo "</td>";
                                                echo '<td>';
                                                echo number_format($bayarTunai);
                                                echo "</td>";
                                                echo '<td>';
                                                echo number_format($bayar);
                                                echo "</td>";
                                                echo '<td>';
                                                echo number_format($biaya);
                                                echo "</td>";
                                                echo '<td>';
                                                echo number_format($setor);
                                                echo "</td>";
                                            echo "</tr>"; 
                                            $count++;    
                                        }  

                                        $sisaOmset = $totalJual - $totalBayar - $totalBiaya - $totalBayarTunai;

                                        echo '<tr>';
                                            echo '<td>';
                                            echo '<b>Total</b>';
                                            echo '</td>';
                                            echo '<td><b>';
                                            echo number_format($totalJual);
                                            echo '</b></td>';
                                            echo '<td><b>';
                                            echo number_format($totalBayarTunai);
                                            echo '</b></td>';
                                            echo '<td><b>';
                                            echo number_format($totalBayar);
                                            echo '</b></td>';
                                            echo '<td><b>';
                                            echo number_format($totalBiaya);
                                            echo '</b></td>';
                                            echo '<td><b>';
                                            echo number_format($totalSetor);
                                            echo '</b></td>';
                                        echo '</tr>';  
                                        echo '<tr>';   
                                            echo '<td colspan="2" style="text-align:right">';
                                            echo '<b>Sisa Omset :</b>';
                                            echo '</td>';
                                            echo '<td><b>';
                                            echo number_format($sisaOmset);
                                            echo '</b></td>';
                                            echo '<td><b>';
                                            echo number_format($totalSetor);
                                            echo '</b></td>';
                                            echo '<td><b>';
                                            echo number_format($totalSetor - $totalBayar);
                                            echo '</b></td>';
                                        echo '</tr>';            
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

<?php
    $this->load->view('footer');
?>