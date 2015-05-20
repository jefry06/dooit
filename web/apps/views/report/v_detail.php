<div class="page-container page-navigation-top-fixed">
<?$this->load->view('layout/v_sidebar')?>
    <div class="page-content">
        <?$this->load->view('layout/v_vertical_menu')?>
        <ul class="breadcrumb">
            <li><a href="<?=base_url('home')?>">Home</a></li>
            <li class="active">Detail Transaksi</li>
        </ul>
        <!-- END BREADCRUMB -->
        <!-- PAGE CONTENT WRAPPER -->
        <div class="page-content-wrap">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3>Detail Transaksi</h3>
                        </div>
                        <div class="panel-body">
                            <table class="table table-responsive table-bordered">
                                <tr>
                                    <td>Order ID : #<?=$transaction->order_code?></td>
                                    <td>Tanggal : <?=$transaction->order_date?></td>
                                </tr>
                                <tr>
                                    <td>Metode Pembayaran : Saldo Voucher</td>
                                    <td>Metode Pengiriman : <?=$transaction->delivery_by?> </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>Tracking No : <?=$transaction->delivery_tracking_no?></td>
                                </tr>

                            </table>
                            <table class="table table-responsive table-striped">
                                <tr>
                                    <td>Alamat Pengiriman</td>
                                </tr>
                                <tr>
                                    <td><?=$transaction->delivery_nama?><br>
					<?=$transaction->delivery_alamat?><br>
                                        RT/RW : <?=$transaction->delivery_rt?>/<?=$transaction->delivery_rw?><br>
					<?=$transaction->delivery_kota?><br/>
                                        <?=$transaction->delivery_kodepos?> </td>
                                </tr>
                            </table>
                            <table class="table table-responsive table-striped">
                                <tr>
                                    <td>Tanggal</td>
                                    <td>Item Name</td>
                                    <td>Jumlah</td>
				    <td>Size</td>	
                                    <td style="width: 140px">Sub Total</td>
                                </tr>
                                <?foreach ($transaction->detail as $key => $item):?>
                                <tr>
                                    <td><?=$item->create_at?></td>
                                    <td><?=$item->item_name?></td>
                                    <td><?=$item->item_qty?></td>
                                    <td><?=$item->item_size?></td>				   
                                    <td>Rp <?=number_format($item->item_subtotal,0,",",".");?></td>
                                </tr>
                                <?endforeach;?>
                            </table>
                            <!-- 
                            <table class="table table-responsive table-bordered">
                                <tr>
                                    <td>Tanggal :</td>
                                    <td>Status Order : </td>
                                    <td>Keterangan</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </table>
                             -->
                            <button onClick="history.go(-1);return true;" type="submit" class="btn btn-default"><span class="icon-angle-left"></span> Kembali</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END PAGE CONTENT WRAPPER -->
        </div>
        <!-- END PAGE CONTENT -->
    </div>
    <!-- END PAGE CONTAINER -->