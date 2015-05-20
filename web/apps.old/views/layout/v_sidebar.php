<!-- START PAGE SIDEBAR -->
<div class="page-sidebar page-sidebar-fixed scroll">
    <!-- START X-NAVIGATION -->
    <ul class="x-navigation">
        <li class="">
            <a href="<?=base_url()?>"><?asset_name()?> PLUS CARD</a>
            <a href="#" class="x-navigation-control"></a>
        </li>
        <li class="xn-profile">
            <a href="#" class="profile-mini">
                <!-- <img src="<?=home_assets()?>img/master/logo-white.png" alt="Logo"/> //-->
				<img src="<?asset_logo()?>" alt="Logo"/>
            </a>
            <div class="profile">
                <div class="profile-image">
                    <!-- <img src="<?=home_assets()?>img/master/logo-white.png" alt="Logo"/> //-->
					<img src="<?asset_logo()?>" alt="Logo"/>
                </div>
                <div class="profile-data">
                	<?php 
                	$user = $this->session->userdata('login');
                	?>
                    <div class="profile-data-name"><?=$user->nama?></div>
                    <div class="profile-data-title">Rp. <?=number_format($user->amountNominal,0,",",".");?></div>
                    <div style="font-size: 10px;color: #666" class="">Aktif Sampai : <?=date('d-m-Y', strtotime($user->activePeriode))?></div>
                </div>
            </div>
        </li>
        <li class="xn-openable">
            <a href="#"><span class="fa fa-files-o"></span> <span class="xn-text">Kategori</span></a>
            <ul>
            	<!-- <li><a href="<?=base_url('product/sort_by/1')?>"><span class="fa fa-angle-right"></span>Terbaru</a></li> //-->
            	<li><a href="<?=base_url('product/sort_by/2')?>"><span class="fa fa-angle-right"></span>Terpopuler</a></li>
            	<?	foreach ($this->session->userdata('productCategory') as $cat):?>
                <li class="xn-openable">
                	<a href="#"><span class="fa fa-ticket"></span><span class="xn-text"><?=$cat->categoryDescription?></span></a>
                	<ul>
                	<? foreach ($cat->listProductGroup as $listProduct):?>
                		<li><a href="<?=base_url('product/group/'.$listProduct->productGroupId)?>"><span class="fa fa-angle-right"></span><?=$listProduct->nama?></a></li>
                	<? endforeach;?>
                	</ul>
                </li>
                <? endforeach ;?>
            </ul>
        </li>
        <li class="xn-openable">
            <a href="#"><span class="fa fa-cogs"></span> <span class="xn-text">Akun</span></a>
            <ul>
                <li><a href="<?=base_url('account')?>"><span class="fa fa-user"></span> Akun Saya</a></li>
                <li><a href="<?=base_url('pin')?>"><span class="fa fa-dot-circle-o"></span> Ganti PIN</a></li>
                <li><a href="<?=base_url('report')?>"><span class="fa fa-square-o"></span> Laporan Transaksi</a></li>
            </ul>
        </li>
        <li>
            <a href="<?=base_url('cart')?>"><span class="fa fa-shopping-cart"></span> <span class="xn-text">Belanjaan</span>
                <div class="pull-right">
                	<?$jumlahItem = ($this->session->userdata('cart') != NULL) ? count($this->session->userdata('cart')) : 0?>                 		
                    <span class="shopping-cart label label-danger" id="jumlahItem"><?=$jumlahItem?> Items</span>
                </div>
            </a>
        </li>
        <li>
            <a href="<?=base_url('account/redeem')?>"><span class="fa fa-credit-card"></span> <span class="xn-text">Redeem Card</span></a>
        </li>

        <li>
            <a href="<?=base_url('logout')?>"><span class="glyphicon glyphicon-log-out"></span> <span class="xn-text">Logout</span></a>
        </li>
    </ul>
    <!-- END X-NAVIGATION -->
</div>
<!-- END PAGE SIDEBAR -->