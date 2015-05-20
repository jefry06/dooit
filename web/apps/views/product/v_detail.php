<div class="page-container page-navigation-top-fixed">
<?$this->load->view('layout/v_sidebar')?>
    <div class="page-content">
        <?$this->load->view('layout/v_vertical_menu')?>
        <ul class="breadcrumb">
            <li><a href="<?=base_url('home')?>">Home</a></li>
            <li class="active">Detail Produk</li>
        </ul>
        <!-- END BREADCRUMB -->

        <!-- PAGE CONTENT WRAPPER -->
        <div class="page-content-wrap">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-md-12">
                        <button onClick="history.go(-1);return true;" class="btn btn-default">
                            <span class="fa fa-chevron-circle-left"></span> Kembali
                        </button>
                    </div>
                    <FORM name="frmDetail" method="POST">
                    <div class="col-md-4">
                        <h3><?=$productDetail->nama?></h3>
                        <input name="nama" type="hidden" value="<?=$productDetail->nama?>" />
                        <input name="detailItemId" type="hidden" value="" id="detailItemId" />

			 <input name="itemId" type="hidden" value="<?php echo $itemId;?>" id="itemId" />
                        <div class="produk" id="detail-product-image">
                        	<input name="path" type="hidden" value="<?=$productDetail->path?>" />
                            <img src="<?=$productDetail->path?>" alt="<?=$productDetail->nama?>"/>
                        </div>
                            <!-- AddThis Button BEGIN -->
                            <div class="addthis_toolbox addthis_default_style"><a class="addthis_button_facebook_like" fb:like:layout="button_count"></a> <a class="addthis_button_tweet"></a> <a class="addthis_button_pinterest_pinit"></a> <a class="addthis_counter addthis_pill_style"></a></div>
                            <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-515eeaf54693130e"></script>
                            <!-- AddThis Button END -->
                    </div>
                    <div class="col-md-4">
                        <h3>Keterangan Produk</h3>
                        <p><?=$productDetail->keterangan?></p><hr>
                        <input type="hidden" name="harga" value="<?=$productDetail->harga?>" />
                        <h3>Rp. <?=number_format($productDetail->harga,0,",",".");?></h3>
						<!--
                        <div class="form-group">
                            <label class="control-label">Quantity</label>
                            <input type="number" class="form-control" value="" name="jumlah"/>
                        </div>
						//-->	
			<!--					
                        <div class="form-group">
                            <label class="control-label">Pilihan Warna</label>
                            <select class="form-control" name="warna" id="warnaSelection">
                            	<option value="0">Warna</option>
                            	<?php
                            	$warna = array_unique($productDetail->listDetailProduct);
                            	foreach($warna as $item){
                            		echo '<option value="'.$item->warna.'">'. $item->warna .'</option>';                            		
                            	}                                 	
                                ?>
                            </select>
                        </div>
                        //-->
                        <div class="form-group">
                            <label class="control-label">Pilihan Ukuran</label>
                            <select class="form-control" name="ukuran" id="ukuranSelection">
<?php

                                $size = array_unique($productDetail->listDetailProduct);
                                foreach($productDetail->listDetailProduct as $item){				   
                                    echo '<option data-id="'.$item->detailItemId.'" data-unit="'.$item->unit.'" value="'.$item->size.'">'. $item->size .'</option>';                                    
                                } 
?>                            
                            	
                            </select>
                        </div>   
                        <div class="form-group">
                            <label class="control-label">Stok</label>
                            <input value="1" type="hidden" name="jumlah" id="jumlahSelection">			    
			    <input style="width:60px;" name="jumlahstok" id="jumlahstok" type="text" class="form-control" value="<?php echo @$productDetail->listDetailProduct[0]->unit;?>" readonly/>
<?php /*
                            <select class="form-control" name="jumlahstok1"  style="width:60px;" >

                                $qty = array_unique($productDetail->listDetailProduct);
                                foreach($qty as $item){
                                    echo '<option value="'.$item->unit.'">'. $item->unit .'</option>';                                    
                                } 
                               
                            	<!-- <option value="0">0</option> -->
                            </select>
*/ ?>
                        </div>                              
                        <!-- 
                        <div class="form-group">
                            <label class="control-label">Pengiriman</label>
                            <select class="form-control" name="pengiriman">
                                <option value="TIKI">Tiki</option>
                                <option value="SAP">SAP</option>
                                <option value="GED">GED</option>
                            </select>
                        </div>
                         -->
                        </FORM>
						<hr>
                        <div class="form-group">
                        	<!-- 
                            <button class="btn btn-default add-to-cart-2">
                                <span class="fa fa-shopping-cart"></span> Add To Cart
                            </button>
                             -->
                            <button onClick="putToCartAndPay()" class="btn btn-default" style="float: right">Ambil ini <span class="fa fa-chevron-circle-right"></span> </button>
                            <div class="clearfix"></div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="row">
                            <h3>Produk Lainnya</h3>
                            <?
                        	$productList = $this->session->get_session('latestProduct');                        	
                        	$randKey = array_rand($productList, 2);
                        	$productRand = array();
                        	foreach($randKey as $key){
                        		array_push($productRand, $productList[$key]);	
                        	}
                        	
                        	foreach ($productRand as $product):?>                        	                        	
                            <div class="col-xs-6 col-md-6">
                                <div class="produk">
                                    <a href="<?=base_url('product/detail/'.$product->itemId)?>">
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
                </div>
            </div>
        </div>
    </div>
</div>