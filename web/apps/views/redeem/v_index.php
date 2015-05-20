    <div class="mycontainer padt40 padb80">
        <div class="">
            <a href="<?=base_url()?>">
				<!-- <img src="<?=login_assets()?>images/logo-header.png" alt="..."> //-->
				<img src="<?asset_logo()?>" alt="<?asset_name()?>">
			</a>
        </div>
        <div class="row">
            <div class="col-md-6">
                <h3 class="title">Pendaftaran Member</h3>
                <form method="post" class="contact-form" action="<?=base_url('redeem/process')?>">
                    <fieldset>
                        <div class="form-group">
                            <label>No Voucher yang Anda masukan</label>
                            <input name="novoucher" readonly class="form-control" type="text" value="<?=$voucher['code']?>"/>
                        </div>
                        <div class="form-group">
                            <label>Nama <?php echo form_error('nama', '<span style="color:#ff0000;font-weight:normal">(', ')</span>'); ?></label>
                            <input name="nama" class="form-control" type="text" placeholder="Masukan nama Anda" value="<?php echo set_value('nama'); ?>"/>
                        </div>
                        <div class="form-group">
                            <label>No Handphone <?php echo form_error('phone', '<span style="color:#ff0000;font-weight:normal">(', ')</span>'); ?></label>
                            <input name="phone" class="form-control" type="text" placeholder="Masukan nomer HP Anda" value="<?php echo set_value('phone'); ?>"/>
                        </div>
                        <div class="form-group">
                            <label>Email <?php echo form_error('email', '<span style="color:#ff0000;font-weight:normal">(', ')</span>'); ?></label>
                            <input name="email" class="form-control" type="text" placeholder="Masukan email Anda" value="<?php echo set_value('email'); ?>"/>
                        </div>
                        <div class="form-group">
                            <label>Address <?php echo form_error('address', '<span style="color:#ff0000;font-weight:normal">(', ')</span>'); ?></label>
                            <input name="address" class="form-control" type="text" placeholder="Masukan Alamat Anda" value="<?php echo set_value('address'); ?>"/>
                        </div>                        
                        <div class="form-group">
                            <label>City <?php echo form_error('city', '<span style="color:#ff0000;font-weight:normal">(', ')</span>'); ?></label>
                            <input name="city" class="form-control" type="text" placeholder="Masukan Kota Anda" value="<?php echo set_value('city'); ?>"/>
                        </div>
                        <div class="form-group">
                            <label>Zip Code <?php echo form_error('zip_code', '<span style="color:#ff0000;font-weight:normal">(', ')</span>'); ?></label>
                            <input name="zip_code" class="form-control" type="text" placeholder="Masukan Kodepos Anda" value="<?php echo set_value('zip_code'); ?>"/>
                        </div>
                        <div class="form-group">
                            <label>PIN <?php echo form_error('pin', '<span style="color:#ff0000;font-weight:normal">(', ')</span>'); ?></label>
                            <input name="pin" class="form-control" type="password" placeholder="Buat PIN Anda" value="<?php echo set_value('pin'); ?>"/>
                        </div>
                        <div class="form-group">
                            <label>Ulangi PIN <?php echo form_error('pin2', '<span style="color:#ff0000;font-weight:normal">(', ')</span>'); ?></label>
                            <input name="pin2" class="form-control" type="password" placeholder="Masukan kembali PIN Anda" />
                        </div>
                        <button type="submit" class="btnRedeem">Redeem <span class="glyphicon glyphicon-play-circle"></span> </button>
                    </fieldset>
                </form>
            </div>
            <div class="col-md-6">
                <h3><a class="icon-mobile-phone"></a> No Handphone</h3>
                <p>No. HP yang Anda daftarkan akan digunakan untuk tujuan Sign in</p>

                <h3><a class="icon-envelope-alt"></a> Email</h3>
                <p>Alamat Email yang didaftarkan untuk "Recover Account Info", apabila Anda
                    lupa Pada Account detail</p>

                <h3><a class="icon-ellipsis-horizontal"></a> PIN</h3>
                <p>Buatlah PIN untuk keamanan dan sangat penting saaat mengakses Akun anda dan untuk memverifikasi pada setiap pemakaian transaksi</p>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    
<div class="informasi">
    <div class="mycontainer">
        <div class="col-md-3">
            <h4>Layanan Pelanggan</h4>
            <span class="glyphicon glyphicon-earphone"></span> 021 12345678
        </div>
        <div class="col-md-3"></div>
        <div class="col-md-3"></div>
        <div class="col-md-3"></div>
        <div class="clearfix"></div>
    </div>
</div>    