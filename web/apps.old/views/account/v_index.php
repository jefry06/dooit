    <!-- START PAGE CONTAINER -->
<div class="page-container page-navigation-top-fixed">
<?$this->load->view('layout/v_sidebar')?>
    <!-- PAGE CONTENT -->
    <div class="page-content">
        <?$this->load->view('layout/v_vertical_menu')?>
        <!-- START BREADCRUMB -->
        <ul class="breadcrumb">
            <li><a href="<?=base_url('home')?>">Home</a></li>
            <li class="active">Informasi Akun</li>
        </ul>
        <!-- END BREADCRUMB -->

        <!-- PAGE CONTENT WRAPPER -->
        <div class="page-content-wrap">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3>Informasi Akun Anda</h3>
                    <p><?=$message?></p>
                    <form class="form-horizontal" action="<?=base_url('account/update')?>" method="post">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Nama Anda</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-user"></span></span>
                                        <input type="text" name="nama" class="form-control"/>
                                    </div>
                                    <?php echo form_error('nama', '<label class="label_error">Nama <span style="color:#ff0000;font-weight:normal">(', ')</span></label>'); ?>
                                </div>                                
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Email</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-envelope"></span> </span>
                                        <input type="text" name="email" class="form-control" disabled="disabled"/>
                                    </div>
                                    <?php echo form_error('email', '<label class="label_error">Email <span style="color:#ff0000;font-weight:normal">(', ')</span></label>'); ?>
                                    <span class="help-block">Alamat email diatas adalah email Anda aftarkan</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">No Handphone</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-mobile"></span></span>
                                        <input type="text" name="handphone" class="form-control" disabled="disabled"/>
                                    </div>
                                    <?php echo form_error('handphone', '<label class="label_error">Nomor Handphone <span style="color:#ff0000;font-weight:normal">(', ')</span></label>'); ?>
                                    <span class="help-block">No Ini adalah nomer yang aktif di akun Anda</span>
                                </div>
                            </div>
<?php /*
                            <div class="form-group">
                                <label class="col-md-3 control-label">PIN</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-mobile"></span></span>
                                        <input type="password" name="pin" class="form-control"/>
                                    </div>
                                    <?php echo form_error('pin', '<label class="label_error">PIN <span style="color:#ff0000;font-weight:normal">(', ')</span></label>'); ?>
                                </div>
                            </div>
*/ ?>                                                        
                            <div class="form-group">
                                <label class="col-md-3 control-label">Alamat</label>
                                <div class="col-md-9 col-xs-12">
                                    <textarea class="form-control" name="alamat" rows="5"></textarea>
                                </div>
                            </div>
                            <button class="btn btn-default pull-right">Update Data <span class="fa fa-chevron-circle-right"></span> </button>
                        </div>
                     </form>   
                </div>
            </div>            
        </div>
    </div>
    </div>