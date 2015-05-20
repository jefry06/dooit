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
                    <div class="col-md-4">
                        <h3>Nama Produk</h3>
                        <div class="produk">
                            <img src="<?=home_assets()?>img/produk/produk-detil.jpg" alt="..."/>
                        </div>
                        <!-- AddThis Button BEGIN -->
                        <!--<div class="addthis_toolbox addthis_default_style"><a class="addthis_button_facebook_like" fb:like:layout="button_count"></a> <a class="addthis_button_tweet"></a> <a class="addthis_button_pinterest_pinit"></a> <a class="addthis_counter addthis_pill_style"></a></div>
                        <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-515eeaf54693130e"></script>-->
                        <!-- AddThis Button END -->
                    </div>
                    <div class="col-md-4">
                        <h3>Keterangan Produk</h3>
                        <p>Lorem Ipsum adalah contoh teks atau dummy dalam industri percetakan dan penataan huruf atau typesetting. </p><hr>
                        <h3>Rp. 1.000.000</h3>
                        <div class="form-group">
                            <label class="control-label">Quantity</label>
                            <input type="number" class="form-control" value=""/>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Pilihan Warna</label>
                            <select class="form-control">
                                <option>Warna 1</option>
                                <option>Warna 2</option>
                                <option>Warna 3</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Pengiriman</label>
                            <select class="form-control">
                                <option>Tiki</option>
                                <option>JNE</option>
                                <option>Kurir</option>
                            </select>
                        </div>
                        <hr>
                        <div class="form-group">
                            <button class="btn btn-default add-to-cart">
                                <span class="fa fa-shopping-cart"></span> Add To Cart
                            </button>
                            <button onClick="location.href='detail-pengiriman.php'" class="btn btn-default" style="float: right">Ambil ini <span class="fa fa-chevron-circle-right"></span> </button>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <h3>Produk Lainnya</h3>
                            <div class="col-xs-6 col-md-6">
                                <div class="produk">
                                    <a href="detail-produk.php">
                                        <img src="<?=home_assets()?>img/produk/produk.jpg" alt="..."/>
                                    </a>
                                    <span class="produk-title">Nama Produk</span>
                                    <span class="produk-harga">Rp. 1.000.000</span>
                                    <span class="cart add-to-cart">Ambil</span>
                                </div>
                            </div>
                            <div class="col-xs-6 col-md-6">
                                <div class="produk">
                                    <a href="detail-produk.php">
                                        <img src="<?=home_assets()?>img/produk/produk.jpg" alt="..."/>
                                    </a>
                                    <span class="produk-title">Nama Produk</span>
                                    <span class="produk-harga">Rp. 1.000.000</span>
                                    <span class="cart add-to-cart">Ambil</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>