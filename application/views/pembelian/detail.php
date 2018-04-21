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
                                        <?php 
                                        }
                                        else {
                                        ?>
                                            <div class="form-group">
                                                <label>Tanggal Lunas</label>
                                                <input class="form-control" id="txDate" name="txDate" value="<?= date('Y-m-d') ?>" >
                                            </div>
                                            <input type="hidden" value="<?= $headerid ?>" name="txID" id="txID" />
                                            <button type="submit" class="btn btn-default">Submit</button>
                                        <?php 
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
                                            <th >Jumlah</th>
                                            <th >Total</th>
                                            <th >Jumlah Retur</th>
                                            <th >Tambah ke Retur</th>
                                            <th >Hapus</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php           
                                            $count = 1;          
                                            foreach($details as $detail){
                                                $modal = $detail->Modal_Barang;
                                                $jumlah = $detail->Jumlah;
                                                $total = $modal * $jumlah;
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
                                                    echo $jumlah;
                                                    echo "</td>";
                                                    echo '<td>';
                                                    echo number_format($total);
                                                    echo "</td>";
                                                    echo '<td>';
                                                    echo '<input data-nama="'.$detail->Nama_Barang.'" data-jumlah="'.$jumlah.'" class="cartForm" type="text" id="txAmount'.$id.'" name="txAmount'.$id.'" />';
                                                    echo "</td>";
                                                    echo '<td style="text-align:center">';
                                                    echo '<button class="cartForm" id="'.$id.'" name="'.$id.'" onclick="addtocart(this);return false;" >>></button>';
                                                    echo "</td>";
                                                    echo '<td style="text-align:center">';
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

                <form id="returForm" action="<?= $baseUrl ?>pembelian/retur" method="post">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Daftar Retur :
                                </div>
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table" id="returCart">
                                            <thead class="tHeader">
                                                <tr>                    
                                                    <th >Nama</th>
                                                    <th >Jumlah</th>
                                                    <th><button onclick="clearCart();return false;" >X</button></th>          
                                                </tr>
                                            </thead>
                                            <tbody id="itemlist">
                                            </tbody>
                                        </table>
                                        <span id="errMsg" name="errMsg" style="color:red">
                                        <?php 
                                            if( !empty($error_msg) )
                                            {
                                                echo $error_msg;
                                            }
                                        ?>
                                        </span>
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
                    <input type="hidden" value="<?= $headerid ?>" name="txID" id="txID" />
                    <input type="hidden" value="<?= $grandTotal ?>" name="txTotal" id="txTotal" />
                </form>
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
    <script>
        function addtocart(ref) { 
            id = ref.id;        
            var txAmount = $('#txAmount'+id);
            nama = txAmount.data('nama');  
             
            var strStock = txAmount.data('jumlah');
            stock = parseInt(strStock);

            amount = parseInt(txAmount.val());     
            
            if (isNaN(amount) || amount < 1 ) 
            {
                alert("Jumlah Retur harus angka dan lebih dari 0.");
            }
            else if (amount > stock) {
                alert("Jumlah Retur tidak boleh melebihi Jumlah.");
            }
            else
            {
                $("#errMsg").text("");

                var parentel = document.getElementById('itemlist'); 
                newrow = document.createElement('tr'); 
                newrow.id = "trCart"+id;

                var amountCart = document.createElement("input");
                amountCart.setAttribute("type", "hidden");
                amountCart.setAttribute("name", "amountCart[]");
                amountCart.setAttribute("value", amount);   

                var idCart = document.createElement("input");
                idCart.setAttribute("type", "hidden");
                idCart.setAttribute("name", "idCart[]");
                idCart.setAttribute("value", id);

                newname = document.createElement('td'); 
                newname.innerHTML = nama; 
                newname.appendChild(idCart);

                var pAmount = document.createElement("p");
                pAmount.innerHTML = amount; 

                newamount = document.createElement('td'); 
                newamount.appendChild(pAmount); 
                newamount.appendChild(amountCart); 

                newbutton = document.createElement('td');
                var btn = document.createElement("BUTTON");        
                var t = document.createTextNode("X");       
                btn.appendChild(t);  
                $(btn).attr('onclick', 'removeCart('+ id +')');
                btn.id = 'remove'+id;                              
                newbutton.appendChild(btn);

                newrow.appendChild(newname); 
                newrow.appendChild(newamount); 
                newrow.appendChild(newbutton); 
                parentel.appendChild(newrow); 

                $('#txAmount'+id).prop("disabled",true);  
                $('#'+id).prop("disabled",true); 
            } 
        };

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

        function removeCart(id)
        {           
            $('#txAmount'+id).prop("disabled",false);  
            $('#'+id).prop("disabled",false);
            $('#trCart'+id).remove();           
        };  

        function clearCart()
        {
            $("#returCart > tbody").empty();
            $('input').removeAttr('disabled', 'disabled');
            $('button').removeAttr('disabled', 'disabled');
        };
    </script>
<?php
	$this->load->view('footer');
?>