<!-- START PAGE CONTAINER -->
<div class="page-container page-navigation-top-fixed">
    <?php $this->load->view('layout/v_sidebar')?>
    <!-- PAGE CONTENT -->
    <div class="page-content">
        <?php $this->load->view('layout/v_vertical_menu')?>
        <?php $this->load->view('home/v_slider')?>

        <!-- PAGE CONTENT WRAPPER -->
        <div class="page-content-wrap">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                        	<?
                        	foreach ($productList as $product):?>
                            <div class="col-xs-6 col-md-3">
                                <div class="produk">
                                    <a href="<?=base_url('product/detail/'. $product->itemId)?>">
                                        <img src="<?=$product->path?>" alt="<?=$product->nama?>"/>
                                    </a>
                                    <span class="produk-title"><?=$product->nama?></span>                                    
                                    <span class="produk-harga">Rp. <?=number_format($product->harga,0,",",".");?></span>
                                    <span class="cart add-to-cart">Lihat</span>                                    
                                </div>
                            </div>
                            <?endforeach;?>
                        </div>
                    </div>
					<!-- 
                    <ul class="pagination pagination-sm pull-right push-down-20">
                        <li class="disabled"><a href="#">�</a></li>
                        <li class="active"><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">�</a></li>
                    </ul>
                     -->
                </div>
            </div>
        </div>
        <!-- END PAGE CONTENT WRAPPER -->
    </div>
    <!-- END PAGE CONTENT -->
</div>
<!-- END PAGE CONTAINER -->