<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
        <li data-target="#carousel-example-generic" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
<?php $sesi=$this->session->get_session('company');?>
<?php if(!empty($sesi['companyParam']['style']->slide1)){?>
        <div class="item active">
            <img src="<?php echo $sesi['companyParam']['com_asset_url'].'/img/'.$sesi['companyParam']['style']->slide1;?>" alt="...">
        </div>
        <div class="item">
            <img src="<?php echo $sesi['companyParam']['com_asset_url'].'/img/'.$sesi['companyParam']['style']->slide2;?>" alt="...">
        </div>
        <div class="item">
            <img src="<?php echo $sesi['companyParam']['com_asset_url'].'/img/'.$sesi['companyParam']['style']->slide3;?>" alt="...">
        </div>
<?php }else{ ?>
        <div class="item active">
            <img src="<?=home_assets()?>img/slider/1.jpg" alt="...">
        </div>
        <div class="item">
            <img src="<?=home_assets()?>img/slider/2.jpg" alt="...">
        </div>
        <div class="item">
            <img src="<?=home_assets()?>img/slider/3.jpg" alt="...">
        </div>
<?php } ?>
    </div>
</div>