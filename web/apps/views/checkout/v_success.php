<div class="page-container page-navigation-top-fixed">
<?$this->load->view('layout/v_sidebar')?>
    <div class="page-content">
        <?$this->load->view('layout/v_vertical_menu')?>
        <ul class="breadcrumb">
            <li><a href="<?=base_url('home')?>">Home</a></li>
            <li class="active">Transaksi Sukses</li>
        </ul>
        <!-- END BREADCRUMB -->
        <!-- PAGE CONTENT WRAPPER -->
        <div class="page-content-wrap">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-md-4">
                        <h3><?=$transaction['detail'][0]['item_name']?></h3>
                        <div class="produk">
                            <img src="<?=$transaction['detail'][0]['item_img']?>" alt="<?=$transaction['detail'][0]['item_name']?>"/>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <h3>Transaksi Sukses</h3>
                        <p>Transaksi pembelian barang Berhasil, pengiriman barang akan segera diproses .</p>
  			<p>Status pengiriman dapat dilihat di “order status “ dalam  Akun>Laporan Transaksi</p>
 			<p>Waktu penerimaan barang tergantung dari Perusahaan pengiriman Barang</p><hr>
                        <h3>Rp. <?=number_format($totalTransaction,0,",",".");?></h3>
                        <hr>
                        No.Order : <?=$transaction['order_code']?><br>
                        Nama Barang : <?=$transaction['detail'][0]['item_name']?><br>
                        Total: Rp. <?=number_format($totalTransaction,0,",",".");?> <br>
                        Qty : <?=$totalQuantity?><br>
                        <!--   Metode Pengiriman : <br> //-->
                        Alamat Pengiriman : <?=$transaction['delivery_alamat']?><br>
                        RT/RW : <?=$transaction['delivery_rt']?>/<?=$transaction['delivery_rw']?><br>
			Kota : <?=$transaction['delivery_kota']?><br>
			Kodepos : <?=$transaction['delivery_kodepos']?><br>                        
                        No.HP : <?=$transaction['delivery_tlp']?><br>
			Keterangan : <?=$transaction['delivery_ket']?><br>
			Pengiriman melalui: <?=$transaction['delivery_by']?><br>
                    </div>
                    <div class="col-md-8">
                    </div>
                    <div class="col-md-4">
                        <a href="<?=base_url('home')?>" type="submit" class="btn btn-default"><span class="fa fa-chevron-circle-left"></span> Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>