<div class="page-container page-navigation-top-fixed">
<?$this->load->view('layout/v_sidebar')?>
    <div class="page-content">
        <?$this->load->view('layout/v_vertical_menu')?>
        <ul class="breadcrumb">
            <li><a href="<?=base_url('home')?>">Home</a></li>
            <li class="active">Laporan Transaksi</li>
        </ul>
        <!-- END BREADCRUMB -->
        <!-- PAGE CONTENT WRAPPER -->
        <div class="page-content-wrap">
            <!-- START DEFAULT DATATABLE -->
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3 class="panel-title">Laporan Transaksi</h3>
                    <ul class="panel-controls">
                        <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                    </ul>
                    <br><br>
                    <table class="table datatable table-responsive table-bordered">
                        <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Order ID</th>
                            <th>Order Status</th>
                            <th>Keterangan</th>
                            <!-- <th>Total</th> //-->
                            <th class="text-center">View</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?foreach ($transactions as $trx):
				if($trx->order_status=='0'){
				   $order_status ="Pending";
				   $desc="Transaksi dalam proses verifikasi";
				}elseif($trx->order_status=='1'){
				   $order_status ="Sukses";
				   $desc="Barang sedang dalam proses pengiriman";				
				}else{
				   $order_status ="Gagal";		
				   $desc="Transaksi dibatalkan";		
				}
			?>
                        <tr>
                            <td><?=$trx->order_date?></td>
                            <td><?=$trx->order_code?></td>
                            <td><?=$order_status?></td>
                            <td><?=$desc?></td>
                            <!-- <td>Rp. 1.000.000</td> //-->
                            <td class="text-center"><a href="<?=base_url('report/detail/'.$trx->order_code)?>"><span class="fa fa-eye"></span></a></td>
                        </tr>
                        <?endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>