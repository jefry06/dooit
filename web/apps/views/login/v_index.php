    <div class="loginBox">
        <div class="row">
            <div class="col-md-8">
                <div class="pad20 text-white">
                    <!-- <img src="<?=login_assets()?>images/logo2white.png" alt=".."/> //-->
					<img src="<?asset_logo()?>" alt=".."/>
                    <h2 class="font-light">PLUS CARD PORTAL</h2>
                    Selamat datang, Tukar dan Ambil Hadiahnya disini. Masukan 14 digit Kode Plus Card Anda. Lalu tekan Redeem.
					<br><br>
                	<div data-target="#caraPenggunaan" data-toggle="modal" class="form-group" style="cursor: pointer">
                    	<strong><span class="glyphicon glyphicon-info-sign"></span> Cara Penggunaan</strong>
					</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="pad20 bg222 text-white">
                    <h3 class="font-light"><span class="icon-gift"></span> Aktivasi Plus Card</h3>
                    <form method="post" action="redeem" name="frmRedeem">
                        <label>Masukan Kode Plus Card</label>
                        <div class="input-group">
                            <span class="input-group-addon"><span class="icon-credit-card"></span></span>
                            <input id="codepluscard" onpaste="return false;" autocomplete="off" name="codepluscard"  type="text" class="form-control" placeholder="0000-0000-0000-00" aria-describedby="sizing-addon2">

                            <span style="cursor: pointer;background: #f5f5f5!important;" class="input-group-addon" data-toggle="modal" data-target="#ImgPlusCard"><img src="<?=login_assets()?>images/tandatanya.jpg"/></span>
                        </div><br>


                        <div style="cursor: pointer" class="form-group" data-toggle="modal" data-target="#detailAkun">Lupa detail Akun Anda ?</div>
                        <div style="cursor: pointer" class="form-group" data-toggle="modal" data-target="#loginForm">Sudah punya akun? <strong>LOGIN DISINI</strong></div>
                        <hr>
                        <button type="submit" class="BtnLogin" id="tombolredem">Redeem <span class="glyphicon glyphicon-play-circle"></span> </button>
                        <div class="clearfix"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <!-- LOGIN -->
    <!-- Modal -->
    <div class="modal fade" id="loginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <!-- <img src="<?=login_assets()?>images/logo-1.png"/> //-->
					<img src="<?asset_logo()?>"/>
                </div>
				<div style="padding:15px;display:none;" id="frmLoginError">
					<div style="padding:10px;color:#ffffff;background-color:#d7343c;font-family:'Open sans',sans-serif !important">
					error description
					</div>
					<img src="<?=login_assets()?>images/loading.gif" style="margin-left:50%;display:none;">
				</div>                
                <div class="modal-body">
                    <form method="post" action="login/authenticate" id="frmLogin">
                        <div class="input-group">
                            <span class="input-group-addon" id="sizing-addon2"><span class=" icon-mobile-phone"></span></span>
                            <input name="nohp"  type="text" class="form-control" placeholder="Masukan No HP" aria-describedby="sizing-addon2">
                        </div><br>
                        <div class="input-group">
                            <span class="input-group-addon" id="sizing-addon2">*</span>
                            <input name="pin" type="password" class="form-control" placeholder="Masukan No PIN" aria-describedby="sizing-addon2">
                        </div><br>
                        <div class="form-group">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox"> Ingatkan Saya
                                </label>
                            </div>
                        </div>
                        <button type="submit" class="btnRedeem">Masuk <span class="glyphicon glyphicon-play-circle"></span></button>
                    </form>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- END LOGIN -->

	<!-- MODAL KODE Plus Card -->
	<div class="modal fade" id="caraPenggunaan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">

			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4>Cara Penggunaan</h4>
				</div>
				<div class="modal-body">
					<div class="col-md-6">
						<strong>Belum Memiliki Akun</strong>
						<ol>
							<li>Kunjungi halaman portal PlusCard di <?=base_url()?></li>
							<li>Masukkan Kode PlusCard yang tertera pada kartu dan tekan tombol â€œRedeemâ€�.</li>
							<li>Lakukan Proses Aktivasi Plus Card pada portal PlusCard.</li>
							<li>Login ke dalam portal PlusCard dan Ambil hadiah pilihan Anda.</li>
						</ol>
					</div>
					<div class="col-md-6">
						<strong>Sudah Memiliki Akun</strong>â€¨
						<ol>
							<li>Kunjungi halaman portal Plus Card di <?=base_url()?></li>
							<li>Login ke dalam portal PlusCard dengan Akun Eksisting.â€¨</li>
							<li>Plilh menu â€œRedeem Kartuâ€�, masukkan Kode PlusCard yang tertera pada kartu dan tekan tombol â€œRedeemâ€�.â€¨</li>
							<li>Kembali ke halaman depan PlusCard dan Ambil hadiah pilihan Anda.</li>
						</ol>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>

    <!-- MODAL KODE Plus Card -->
    <div class="modal fade" id="ImgPlusCard" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <img src="<?=login_assets()?>images/card.jpg" alt="..">
                </div>
            </div>
        </div>
    </div>

    <!-- LUPA DETAIL AKUN -->
    <div class="modal fade" id="detailAkun" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <!-- <img src="<?=login_assets()?>images/logo-1.png"/> //-->
					<img src="<?asset_logo()?>"/>
                </div>
                <div class="modal-body text-left">
                    <label>Lupa detail Akun ?</label>
                    <form method="post" action="#" name="frmForgotPassword">
                    	<img id="loadingForgot" style="margin-left:50%;display:none;" src="/assets/login/images/loading.gif">      
                    	<div class="input-group">
                            <span class="input-group-addon" id="sizing-addon2" style="width:30px">Hp</span>
                            <input id="txtHandphone" name="handphone"  type="text" class="form-control" placeholder="Masukan Nomor HP terdaftar" aria-describedby="sizing-addon2">
                        </div>                    
                        <div class="input-group">
                            <span class="input-group-addon" id="sizing-addon2" style="width:42px">@</span>
                            <input id="txtEmail" name="email"  type="text" class="form-control" placeholder="Masukan Email terdaftar" aria-describedby="sizing-addon2">
                        </div><br>
                        <p>Masukan Email yang Anda sudah didaftarkan, Informasi detil akun Anda akan kami kirimkan</p>
                        <button type="submit" class="btnRedeem">Proses <span class="glyphicon glyphicon-play-circle"></span></button>
                    </form>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
<div id="ri-grid" class="ri-grid ri-grid-size-3">
<img class="ri-loading-image" src="<?=login_assets()?>images/loading.gif"/>
    <ul>
    	<? for($i=1; $i<= 54; $i++): ?>
        <li><a href="#"><img src="<?=login_assets()?>images/medium/<?=$i?>.jpg"/></a></li>
        <? endfor; ?>        
    </ul>
</div>
<!-- END GRIDROTATOR -->

