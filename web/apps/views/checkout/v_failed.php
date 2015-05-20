<div class="page-container page-navigation-top-fixed">
<?$this->load->view('layout/v_sidebar')?>
    <div class="page-content">
        <?$this->load->view('layout/v_vertical_menu')?>
        <ul class="breadcrumb">
            <li><a href="<?=base_url('home')?>">Home</a></li>
            <li class="active">Transaksi Gagal</li>
        </ul>
        <!-- END BREADCRUMB -->
        <!-- PAGE CONTENT WRAPPER -->
        <div class="page-content-wrap">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-md-4">
                        <div class="produk">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <h3>Transaksi Gagal</h3>
                        <p><?=$message?></p><hr>
                
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>