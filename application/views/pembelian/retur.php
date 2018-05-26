<?php
	$this->load->view('header');
    $baseUrl = $this->config->item('base_url');
?>

<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Retur Pembelian</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Daftar Retur
                            </div>
                            <?php           
                                if (!empty($details)){
                            ?>
                            <div class="panel-body">
                                <table width="100%" class="table" >
                                    <thead>
                                        <tr>
                                            <th colspan="3" style="text-align:center">Barang Awal</th>
                                            <th colspan="3" style="text-align:center">Hasil Return</th>
                                        </tr>
                                        <tr>
                                            <th >Nama</th>
                                            <th >Modal</th>
                                            <th >Jumlah</th>
                                            <th >Nama</th>
                                            <th >Modal</th>
                                            <th >Jumlah</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php           
                                            $count = 1;          
                                            foreach($details as $detail){
                                                $modal = $detail->Detail_Modal;
                                                $jumlah = $detail->Detail_Jumlah;
                                                $id = $detail->Detail_ID;
                                                if($count%2==0) {
                                                    $class = "even";
                                                }
                                                else {
                                                    $class = "odd";
                                                }
                                                echo '<tr class="'.$class.'">';                        
                                                    echo '<td>';
                                                    echo $detail->Detail_Nama;
                                                    echo "</td>";
                                                    echo '<td>';           
                                                    echo number_format($modal);
                                                    echo "</td>";
                                                    echo '<td>';
                                                    echo $jumlah;
                                                    echo "</td>";

                                                    if($detail->Retur_ID != null) {
                                                        echo '<td>';
                                                        echo $detail->Retur_Nama;
                                                        echo "</td>";
                                                        echo '<td>';           
                                                        echo number_format($detail->Retur_Modal);
                                                        echo "</td>";
                                                        echo '<td>';
                                                        echo $detail->Retur_Jumlah;
                                                        echo "</td>";
                                                    }
                                                    else {
                                                        echo '<td>';
                                                        echo '-';
                                                        echo "</td>";
                                                        echo '<td>';           
                                                        echo '-';
                                                        echo "</td>";
                                                        echo '<td>';
                                                        echo '-';
                                                        echo "</td>";
                                                    }
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
                    <div class="col-lg-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Barang Awal
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Nama</label>
                                            <select id="selector" class="form-control" onchange="changesSelector();">
                                            <?php               
                                                foreach($details as $detail){
                                                    echo '<option data-id="'.$detail->Detail_ID.'" data-modal="'.$detail->Detail_Modal.'" data-jumlah="'.$detail->Detail_Jumlah.'" data-rid="'.$detail->Retur_ID.'" data-rnama="'.$detail->Retur_Nama.'" data-rmodal="'.$detail->Retur_Modal.'" data-rjumlah="'.$detail->Retur_Jumlah.'">'.$detail->Detail_Nama.'</option>';
                                                }
                                            ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Modal</label>
                                            <input class="form-control" type="text" id="txModalLama" readonly />
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Jumlah</label>
                                            <input class="form-control" type="text" id="txJumlahLama" readonly />
                                        </div>
                                    </div>
                                </div>
                                <!-- /.table-responsive -->
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>

                    <div class="col-lg-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Barang Retur
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">                               
                                <form action="<?= $baseUrl ?>pembelian/submit_retur/<?= $header_id ?>" method="post">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Nama</label>
                                                <input class="form-control" type="hidden" id="txIDLama" name="txIDLama" value="0" />
                                                <input class="form-control" type="hidden" id="txIDBaru" name="txIDBaru" value="0" />
                                                <input class="form-control" type="text" id="txNamaBaru" name="txNamaBaru" autocomplete="off" />
                                                <ul class="dropdown-menu txtnama" style="margin-left:15px;margin-right:0px;" role="menu" aria-labelledby="dropdownMenu"  id="dropdown_barang"></ul>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Modal</label>
                                                <input class="form-control" type="text" id="txModalBaru" name="txModalBaru" />
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Jumlah</label>
                                                <input class="form-control" type="text" id="txJumlahBaru" name="txJumlahBaru" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label></label>
                                                <button type="submit" class="btn btn-default" onclick="addtocartBaru();return false;" >Submit</button>
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
        function changesSelector(){
            var modal = $('#selector option:selected').data('modal');
            var jumlah = $('#selector option:selected').data('jumlah');
            var rid = $('#selector option:selected').data('rid');
            var id = $('#selector option:selected').data('id');
            
            $('#txModalLama').val(modal)
            $('#txJumlahLama').val(jumlah)
            $('#txIDLama').val(id)

            if(rid != null && rid != ""){
                var rmodal = $('#selector option:selected').data('rmodal');
                var rjumlah = $('#selector option:selected').data('rjumlah');
                var rnama = $('#selector option:selected').data('rnama');

                $('#txModalBaru').val(rmodal)
                $('#txJumlahBaru').val(rjumlah)
                $('#txNamaBaru').val(rnama)
                $('#txIDBaru').val(rid)
            }
            else {
                $('#txModalBaru').val('')
                $('#txJumlahBaru').val('')
                $('#txNamaBaru').val('')
                $('#txIDBaru').val(0)
            }
        };

        $(document).ready(function() {
            $("#txNamaBaru").keyup(function () {
                $.ajax({
                    type: "POST",
                    url: "<?= $baseUrl ?>barang/auto_complete",
                    data: {
                        keyword: $("#txNamaBaru").val()
                    },
                    dataType: "json",
                    success: function (data) {
                        if (data.length > 0) {
                            $('#dropdown_barang').empty();
                            $('#txNamaBaru').attr("data-toggle", "dropdown");
                            $('#dropdown_barang').dropdown('toggle');
                        }
                        else if (data.length == 0) {
                            $('#txNamaBaru').attr("data-toggle", "");
                        }
                        $.each(data, function (key,value) {
                            if (data.length >= 0) {
                                text = value['Nama'] + ' - Rp ' + value['Modal'];
                                $('#dropdown_barang').append('<li role="displayCountries" ><a data-nama="' + value['Nama'] + '" data-modal="' + value['Modal'] + '" role="menuitem dropdown_barangli" class="dropdownlivalue">' + text + '</a></li>');
                            }
                        });
                    }
                });
            });

            $('ul.txtnama').on('click', 'li a', function () {
                $('#txNamaBaru').val($(this).data('nama'));
                $('#txModalBaru').val($(this).data('modal'));
            });

            changesSelector();
        });
    </script>
<?php
	$this->load->view('footer');
?>