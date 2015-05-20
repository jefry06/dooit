    <div class="mycontainer padt40 padb80">
        <div class="">
            <a href="<?=base_url()?>"><img src="<?=login_assets()?>images/logo-header.png" alt="..."></a>
        </div>
        <div class="row">
            <div class="col-md-6">                
                <?
                if($process->responseCode == 200){
					$status = 'Sukses';
					$style = 'success';
					$message = 'Silahkan cek email Anda, system mengirimkan link untuk aktivasi. Terimakasih';
				}else{
					$status = 'Gagal';
					$style = 'danger';
					$message = $process->responseDescription;
				}
				?>
				<h3 class="title">Pendaftaran <?=$status?></h3>
                <div class="alert alert-<?=$style?>" role="alert"><?php echo $message;?></div>
                <img src="<?=login_assets()?>images/logo50x50.jpg" alt="..">
                <?if($process->responseCode == 200):?>
                <fieldset>
                    <div class="form-group">
                        <label>Email</label>
                        <input name="email" readonly class="form-control" type="text" value="<?php echo $data['email']?>" />
                    </div>
                    <div class="form-group">
                        <label>No Handphone</label>
                        <input name="phone" readonly class="form-control" type="text" value="<?php echo $data['phone']?>" />
                    </div>
                    <div class="form-group">
                        <label>PIN</label>
                        <input name="pin" readonly class="form-control" type="text" value="<?php echo $data['pin']?>" />
                    </div>
                    <button type="submit" class="btnKirimUlang" data-toggle="modal" data-target="#KirimUlang">Tidak terima Email konfirmasi? KIRIM ULANG DISINI <span class="glyphicon glyphicon-play-circle"></span> </button>
                </fieldset>
				<?endif;?>
                <!-- MODAL Kirim Ulang -->
                <div class="modal fade" id="KirimUlang" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <img src="<?=login_assets()?>images/logo-1.png"/>
                            </div>
                            <div class="modal-body text-center">
                                Email Aktivasi sudah dikirim ulang. Silahkan cek email Anda, system mengirimkan link untuk aktivasi. Terimakasih
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-5">
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