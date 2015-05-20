<div class="page-container page-navigation-top-fixed">
<?$this->load->view('layout/v_sidebar')?>
    <div class="page-content">
        <?$this->load->view('layout/v_vertical_menu')?>
        <ul class="breadcrumb">
            <li><a href="<?=base_url('home')?>">Home</a></li>
            <li class="active">Belanjaan</li>
        </ul>
        <!-- END BREADCRUMB -->

        <!-- PAGE CONTENT WRAPPER -->
        <div class="page-content-wrap">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3>Belanjaan</h3>
                    <table class="table table-strip table-bordered table-responsive">
                        <thead>
                        <td>Image</td>
                        <td>Nama Produk</td>
                        <td>Model</td>
                        <td>Ukuran</td>                        
                        <td>Quantity</td>
                        <td style="width: 120px">Harga Satuan</td>
                        <td style="width: 120px">Total</td>
                        </thead>
			<?php error_reporting(E_ERROR);?>
                        <?php foreach($items as $item):?>
                        <tr>
                            <td style="width: 210px">
                                <img width="200px" src="<?=$item->path?>" alt="<?=$item->nama?>">
                            </td>
                            <td><?=$item->nama?></td>
                            <td><?=$item->warna?></td>
                            <td><?=$item->ukuran?></td>                            
                            <td style="max-width: 200px">
                                    <div class="input-group">
                                        <span class="input-group-addon hidden-xs">Qty</span>
                                        <input name="quantity" type="number" class="form-control" value="<?=$item->jumlah?>" onchange="updateQuantity(this, <?=$item->itemId?>)">


                          <span class="input-group-btn">
                                <button class="btn btn-info hidden-xs" data-toggle="tooltip" data-placement="top" title="Update"><span class="fa fa-refresh"></span></button>
                                <button name="removeItem" class="btn btn-danger hidden-xs" data-toggle="tooltip" data-placement="top" title="Buang" onclick="removeFromCart(this, <?=$item->itemId?>)"><span class="glyphicon glyphicon-remove-circle"></span></button>
                          </span>
                                    </div><!-- /input-group -->
                            </td>
                            <td>Rp. <?=number_format($item->harga,0,",",".");?></td>
                            <td>Rp. <?=number_format(($item->harga*$item->jumlah),0,",",".");?></td>
                        </tr>
                        <?php endforeach;?>
                    </table>
                    <div class="col-md-6">
                        <a href="<?=base_url('home')?>" type="submit" class="btn btn-default"><span class="fa fa-chevron-circle-left"></span> Tambah Produk Lainnya</a>
                    </div>
		    <?php if(!empty($items)>0){?>
                    <div class="col-md-6">
                        <a href="<?=base_url('checkout')?>"  style="float: right" type="submit" class="btn btn-default">Selesaikan Belanjaan <span class="fa fa-chevron-circle-right"></span></a>
                    </div>
		    <?php }?>
                </div>
            </div>
            <!-- END PAGE CONTENT WRAPPER -->
        </div>
        <!-- END PAGE CONTENT -->
    </div>
    <!-- END PAGE CONTAINER -->  
</div>