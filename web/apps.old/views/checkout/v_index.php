<div class="page-container page-navigation-top-fixed">
<?$this->load->view('layout/v_sidebar')?>
    <div class="page-content">
        <?$this->load->view('layout/v_vertical_menu')?>
        <ul class="breadcrumb">
            <li><a href="<?=base_url('home')?>">Home</a></li>
            <li class="active">Detail Pengiriman</li>
        </ul>
        <!-- END BREADCRUMB -->

        <!-- PAGE CONTENT WRAPPER -->
        <div class="page-content-wrap">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-md-12">
                        <h3>Detail Pengiriman</h3>
                    </div>
                    <div class="col-md-4">
                        <h3><?=$transaksi['nama']?></h3>
                        <div class="produk">
                            <img src="<?=$transaksi['path']?>" alt="<?=$transaksi['nama']?>"/>
                        </div>
                        <p>
                            Quantity : <?=$transaksi['total_quantity']?> <br>
                            Harga : Rp. <?=number_format($transaksi['total_transaksi'],0,",",".");?><br>
                            <!-- Metode Pengiriman : Kurir <br>  -->

                        </p>
                    </div>
                    <div class="col-md-4">						
                        <h3>Informasi Pengiriman</h3>
                        <form action="<?=base_url('checkout/process')?>" class="contact-form" enctype="multipart/form-data" method="post" name="frmCheckoutProcess">
                            <fieldset>

                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-user"></span></span>
									<input type="hidden" name="pin_submit" id="pin_submit"/>
                                    <input class="form-control" type="text" name="nama" placeholder="Nama"/>
                                </div>
                                <br>
                                <div class="input-group">
                                    <span class="input-group-addon">@</span>
                                    <input class="form-control" type="text" name="email" placeholder="Email"/>
                                </div>
                                <br>
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-mobile-phone"></span> </span>
                                    <input class="form-control" type="text" name="handphone" placeholder="No.HP/Telephone"/>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label>Type Alamat</label>
                                    <select class="form-control" name="type_alamat">
                                        <option value="1">Rumah</option>
                                        <option value="2">Kantor</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <textarea class="form-control" type="text" name="alamat"></textarea>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="input-group">
                                                <span class="input-group-addon">RT</span>
                                                <input type="text" class="form-control" name="rt" aria-label="...">
                                            </div><!-- /input-group -->
                                        </div><!-- /.col-lg-6 -->
                                        <div class="col-lg-6">
                                            <div class="input-group">
                                                <span class="input-group-addon">RW</span>
                                                <input type="text" class="form-control" name="rw" aria-label="...">
                                            </div><!-- /input-group -->
                                        </div><!-- /.col-lg-6 -->
                                    </div><!-- /.row -->
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="input-group">
                                            <span class="input-group-addon">Kota</span>
                                            <input class="form-control" type="text" name="kota" placeholder="Kota"/>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="input-group">
                                            <span class="input-group-addon">Kodepos</span>
                                            <input type="text" class="form-control" name="kodepos" aria-label="...">
                                        </div><!-- /input-group -->
                                    </div><!-- /.col-lg-6 -->
                                </div>                                
                                <br>                                                                
                                <div class="form-group">
                                    <label>Keterangan</label>
                                    <textarea class="form-control" type="text" name="keterangan"></textarea>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Pengiriman</label>
                                    <select class="form-control" name="pengiriman">
                                        <option value="JNE">JNE</option>
                                        <option value="SAP">SAP</option>
                                        <option value="GED">GED</option>
                                    </select>
                                </div>                                
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button type="button" data-toggle="modal" data-target="#modal_small" class="btn btn-default" style="float: right">Proses <span class="fa fa-chevron-circle-right"></span> </button>
                                            <!-- <button type="submit" data-toggle="modal" class="btn btn-default" style="float: right">Proses <span class="fa fa-chevron-circle-right"></span> </button> //-->
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
            <!-- END PAGE CONTENT WRAPPER -->
        </div>
        <!-- END PAGE CONTENT -->
    </div>
    <!-- END PAGE CONTAINER -->

    <div class="modal" id="modal_small" tabindex="-1" role="dialog" aria-labelledby="smallModalHead" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <img src="<?=home_assets()?>img/master/logo.png" alt="logo"/>
                </div>

                <!-- <form id="frmCheckout" class="form-group" action="<?=base_url('checkout/process')?>"> //-->
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Masukan No PIN</label>
                            <div class="input-group">
                                <span class="input-group-addon"><span class="fa fa-asterisk"></span></span>
                                <input type="password" class="form-control" id="txtPin"/>
                            </div>
							<label id="pinResult" style="color:#ff0000;display:none;">PIN yang dimasukkan salah.</label>
							<!-- /input-group -->
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" id="processBtn">Proses</button>
                    </div>

                <!-- </form> //-->
            </div>
        </div>
    </div>
</div>    