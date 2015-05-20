<div class="page-container page-navigation-top-fixed">
<?$this->load->view('layout/v_sidebar')?>
    <div class="page-content">
        <?$this->load->view('layout/v_vertical_menu')?>
        <ul class="breadcrumb">
            <li><a href="<?=base_url('home')?>">Home</a></li>
            <li class="active">Redeem Card</li>
        </ul>
          <div class="page-content-wrap">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3>Reedem Card</h3>
                    <p><?=$message;?></p>
                    <div class="block">
                        <form class="form-horizontal" role="form" action="<?=base_url('account/redeem')?>" method="post" name="frmRedeemCard">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Kode Gift Card</label>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-credit-card"></span> </span>
                                            <input type="text" name="voucher" onpaste="return false;" class="mask_credit form-control" value="" id="voucher_redeem_card"/>
                                        </div>
                                        <span class="help-block">Contoh: 9876-5432-1098-76</span>
                                    </div>
                                    <button class="btn btn-default pull-right">Redeem <span class="fa fa-chevron-circle-right"></span> </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>