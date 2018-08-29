<?php
    $this->load->view('header');
    $baseUrl = $this->config->item('base_url');

    if($lunas == 'lunas') {
        $checked = "checked";
    }
    else {
        $checked = "";
    }
?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Pembelian Baru</h1>
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
                                            <label>Harga Modal</label>
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

			<form id="checkOutForm" action="<?= $baseUrl ?>pembelian/add" method="post">
            	<div class="row">
                    <div class="col-lg-6">
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
		                                        <th >Harga Modal</th>
		                                        <th >Jumlah</th>
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
                            <label>Nama Supplier</label>
                            <input type="text" class="form-control" id="txSupp" name="txSupp" value="<?= $supplier ?>" />
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="form-group">
                            <label>Tanggal Beli</label>
                            <input type="text" class="form-control" id="txDate" name="txDate" value="<?= $buydate ?>" />
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="form-group">
                            <label>Jatuh Tempo</label>
                            <input type="text" class="form-control" id="txTempo" name="txTempo" value="<?= $tempo ?>" />
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="form-group">
                            <input type="checkbox" name="cash" id="cash" value="true" <?= $checked ?>> Cash
                            <button type="submit" class="btn btn-default">Submit</button>
                        </div>
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
            modalStr = $('#txModalBaru').val(); 
            amountStr = $('#txJumlahBaru').val();   
            
            if (nama == "" || amountStr == "" || modalStr == "") 
            {
                alert("Nama, Jumlah, dan Harga Modal harus diisi.");
            }
            else if(isNaN(amountStr) || isNaN(modalStr))
            {
                alert("Jumlah dan Harga Modal harus berupa angka.");
            }
            else
            {
                modal = parseInt(modalStr);
                amount = parseInt(amountStr);

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

                var nameCart = document.createElement("input");
                nameCart.setAttribute("type", "hidden");
                nameCart.setAttribute("name", "nameCart[]");
                nameCart.setAttribute("value", nama);

                newname = document.createElement('td'); 
                newname.innerHTML = nama; 
                newname.appendChild(nameCart);

                var pModal = document.createElement("p");
                pModal.innerHTML = modal;

                newmodal = document.createElement('td'); 
                newmodal.appendChild(pModal); 
                newmodal.appendChild(modalCart); 

                var pAmount = document.createElement("p");
                pAmount.innerHTML = amount; 

                newamount = document.createElement('td'); 
                newamount.appendChild(pAmount); 
                newamount.appendChild(amountCart); 

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
                newrow.appendChild(newmodal); 
                newrow.appendChild(newamount); 
                newrow.appendChild(newbutton); 
                parentel.appendChild(newrow); 

                $('#txNamaBaru').val('');
                $('#txModalBaru').val('');
                $('#txJumlahBaru').val('');

                serviceId++; 
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
                    },
                    txTempo: {
                        number: true
                    },
                    txSupp: {
                    	required: true
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
                                    $('#dropdown_barang').append('<li role="displayCountries" ><a data-nama="' + value['Nama'] + '" data-modal="' + value['Modal'] + '" role="menuitem dropdown_barangli" class="dropdownlivalue">' + text + '</a></li>');
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
            });
        });
    </script>
<?php
    $this->load->view('footer');
?>
