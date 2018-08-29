<?php
    $this->load->view('header');
    $baseUrl = $this->config->item('base_url');
?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Penjualan Baru</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>

            <?php 
                if( !empty($error_msg) )
                {
            ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <?= '<span id="errMsg" name="errMsg" style="color:red">'.$error_msg.'</span>' ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                }
            ?>

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Cari/Tambah Barang
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <form>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Nama</label>
                                            <input class="form-control" type="text" id="txNamaBaru" name="txNamaBaru" autocomplete="off" />
                                            <ul class="dropdown-menu txtnama" style="margin-left:15px;margin-right:0px;" role="menu" aria-labelledby="dropdownMenu"  id="dropdown_barang"></ul>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Stok Awal</label>
                                            <input class="form-control" type="text" id="txStokBaru" name="txStokBaru" />
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Harga Modal</label>
                                            <input class="form-control" type="text" id="txModalBaru" name="txModalBaru" />
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

			<form id="checkOutForm" action="<?= $baseUrl ?>penjualan/add" method="post" >
            	<div class="row">
                    <div class="col-lg-8">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Keranjang :
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table" id="shopCart">
                                        <thead class="tHeader">
                                            <tr>                    
                                                <th >Nama</th>
                                                <th >Stok</th>
		                                        <th >Harga Modal</th>
		                                        <th >Jumlah</th>
                                                <th >Harga Jual</th>
                                                <th >Total</th>
                                                <th>
                                                    <center>
                                                        <button onclick="clearCart();return false;" >X</button>
                                                    </center>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody id="itemlist">
                                        </tbody>
                                    </table>
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
                    	<div class="form-group">
                            <label>Tanggal Jual</label>
                            <input type="text" class="form-control" id="txDate" name="txDate" value="<?= $selldate ?>" />
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <button type="submit" class="btn btn-default">Submit</button>
                    </div>
            	</div>

                <div class="row">
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label></label>
                        </div>
                    </div>

                    <div class="col-lg-3">
                    </div>
                </div>
            </form>
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
        var serviceId = 1;

        function addtocartBaru() { 
            id = serviceId;        

            nama = $('#txNamaBaru').val();  
            stockStr = $('#txStokBaru').val(); 
            modalStr = $('#txModalBaru').val(); 
            amountStr = $('#txJumlahBaru').val(); 
            hargaStr = $('#txJualBaru').val();   
            
            if (nama == "" || hargaStr == "") 
            {
                alert("Nama dan Harga Jual harus diisi.");
            }
            else if(isNaN(hargaStr))
            {
                alert("Harga Jual harus berupa angka.");
            }
            else
            {
                if(stockStr != "" && isNaN(stockStr)) {
                    alert("Stok Awal harus berupa angka.");
                }
                else if(modalStr != "" && isNaN(modalStr)) {
                    alert("Harga Modal harus berupa angka.");
                }
                else if(amountStr != "" && isNaN(amountStr)) {
                    alert("Jumlah harus berupa angka.");
                }
                else {

                    if(stockStr == "") {
                        stock = 99999;
                    }
                    else {
                        stock = parseInt(stockStr);
                    }

                    if(modalStr == "") {
                        modal = 0;
                    }
                    else {
                        modal = parseFloat(modalStr);
                    }

                    if(amountStr == "") {
                        amount = 1;
                    }
                    else {
                        amount = parseInt(amountStr);
                    }

                    harga = parseFloat(hargaStr);
                    total = amount * harga;

                    var parentel = document.getElementById('itemlist'); 
                    newrow = document.createElement('tr'); 
                    newrow.id = "trCartBaru"+id;

                    var amountCart = document.createElement("input");
                    amountCart.setAttribute("type", "hidden");
                    amountCart.setAttribute("name", "amountCart[]");
                    amountCart.setAttribute("value", amount);  

                    var modalCart = document.createElement("input");
                    modalCart.setAttribute("type", "hidden");
                    modalCart.setAttribute("name", "modalCart[]");
                    modalCart.setAttribute("value", modal); 

                    var hargaCart = document.createElement("input");
                    hargaCart.setAttribute("type", "hidden");
                    hargaCart.setAttribute("name", "hargaCart[]");
                    hargaCart.setAttribute("value", harga);

                    var nameCart = document.createElement("input");
                    nameCart.setAttribute("type", "hidden");
                    nameCart.setAttribute("name", "nameCart[]");
                    nameCart.setAttribute("value", nama);

                    var stokCart = document.createElement("input");
                    stokCart.setAttribute("type", "hidden");
                    stokCart.setAttribute("name", "stockCart[]");
                    stokCart.setAttribute("value", stock);

                    newname = document.createElement('td'); 
                    newname.innerHTML = nama; 
                    newname.appendChild(nameCart);

                    newmodal = document.createElement('td'); 
                    newmodal.innerHTML = modal;
                    newmodal.appendChild(modalCart); 

                    newamount = document.createElement('td'); 
                    newamount.innerHTML = amount;
                    newamount.appendChild(amountCart); 

                    newHarga = document.createElement('td'); 
                    newHarga.innerHTML = harga; 
                    newHarga.appendChild(hargaCart); 

                    newTotal = document.createElement('td'); 
                    newTotal.innerHTML = total; 

                    newStok = document.createElement('td'); 
                    newStok.innerHTML = stock;
                    newStok.appendChild(stokCart);

                    newbutton = document.createElement('td');
                    center = document.createElement('center');
                    var btn = document.createElement("BUTTON");        
                    var t = document.createTextNode("X");       
                    btn.appendChild(t);  
                    $(btn).attr('onclick', 'removeCartBaru('+ id +')');
                    btn.id = 'remove'+id;                              
                    center.appendChild(btn);
                    newbutton.appendChild(center);

                    newrow.appendChild(newname); 
                    newrow.appendChild(newStok);
                    newrow.appendChild(newmodal); 
                    newrow.appendChild(newamount); 
                    newrow.appendChild(newHarga); 
                    newrow.appendChild(newTotal); 
                    newrow.appendChild(newbutton); 
                    parentel.appendChild(newrow); 

                    $('#txNamaBaru').val('');
                    $('#txModalBaru').val('');
                    $('#txJumlahBaru').val('');
                    $('#txJualBaru').val('');
                    $('#txStokBaru').val('');

                    serviceId++; 
                }
            } 
        };

        function removeCartBaru(id)
        {
            $('#trCartBaru'+id).remove();
        };

        function clearCart()
        {
            $("#shopCart > tbody").empty();
            $('input').removeAttr('disabled', 'disabled');
            $('button').removeAttr('disabled', 'disabled');
        };

        $(document).ready(function() {
            $( "#txDate" ).datepicker({dateFormat: "yy-mm-d", maxDate: new Date, minDate: new Date(2007, 6, 12)});
            
            $("#checkOutForm").validate({
                rules: {                
                    txDate: {
                        required: true,
                        date: true
                    }
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
                                $('#dropdown_barang').append('<li role="displayCountries" ><a data-nama="' + value['Nama'] + '" data-stok="' + value['Jumlah'] + '" data-modal="' + value['Modal'] + '" role="menuitem dropdown_barangli" class="dropdownlivalue">' + text + '</a></li>');
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
                $('#txStokBaru').val($(this).data('stok'));
                $('#txModalBaru').val($(this).data('modal'));
            });
        });
    </script>
<?php
    $this->load->view('footer');
?>
