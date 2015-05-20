<div class="page-container page-navigation-top-fixed">
<?$this->load->view('layout/v_sidebar')?>
    <div class="page-content">
        <?$this->load->view('layout/v_vertical_menu')?>
        <ul class="breadcrumb">
            <li><a href="<?=base_url('home')?>">Home</a></li>
            <li class="active">Ganti PIN</li>
        </ul>
        <div class="page-content-wrap">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3>Ganti PIN</h3>
                    <p><?=$message?></p>
                    <div class="col-md-6">
                        <form class="form-horizontal" method="post" action="<?=base_url('pin/update')?>">
                        	<div class="form-group">                        		
                                <label class="col-md-3 control-label">No. HP</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-mobile"></span></span>
                                        <input type="text" name="handphone" class="form-control" value="<?php echo set_value('handphone'); ?>"/>
                                    </div>
                                    <?php echo form_error('handphone', '<label class="label_error">No. HP <span style="color:#ff0000;font-weight:normal">(', ')</span></label>'); ?>
                                </div>
                            </div>
                        	<div class="form-group">
                                <label class="col-md-3 control-label">Pin Lama</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-asterisk"></span></span>
                                        <input type="password" name="pin_lama" class="form-control value="<?php echo set_value('pin_lama'); ?>""/>                                        
                                    </div>
                                    <?php echo form_error('pin_lama', '<label class="label_error">PIN Lama <span style="color:#ff0000;font-weight:normal">(', ')</span></label>'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Pin Baru</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-asterisk"></span> </span>
                                        <input type="password" name="pin_baru" class="form-control value="<?php echo set_value('pin_baru'); ?>""/>
                                    </div>
                                    <?php echo form_error('pin_baru', '<label class="label_error">PIN Baru <span style="color:#ff0000;font-weight:normal">(', ')</span></label>'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Ulangi PIN Baru</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-asterisk"></span></span>
                                        <input type="password" name="pin_baru_konf" class="form-control"/>
                                    </div>
                                    <?php echo form_error('pin_baru_konf', '<label class="label_error">Konfirmasi PIN <span style="color:#ff0000;font-weight:normal">(', ')</span></label>'); ?>
                                </div>
                            </div>
                            <button class="btn btn-default pull-right">Update PIN <span class="fa fa-chevron-circle-right"></span> </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>    