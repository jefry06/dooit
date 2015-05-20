<!DOCTYPE html>
<html lang="en">
<head>
    <!-- META SECTION -->
    <?$company = $this->session->get_session('company')?>
    <title><?asset_name()?> Voucher Card</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="webdesign" content="dinartdesign">
    <link rel="icon" href="favicon.ico" type="<?=home_assets()?>image/x-icon" />
    <!-- END META SECTION -->

    <!-- CSS INCLUDE -->
    <link rel="stylesheet" type="text/css"  href="<?=home_assets()?>css/pluscard.css"/>
    <!-- EOF CSS INCLUDE -->
    <script type="text/javascript" src="<?=home_assets()?>js/modernizr.custom.26633.js"></script>
    <noscript>
        <link rel="stylesheet" type="text/css" href="<?=home_assets()?>css/fallback.css" />
    </noscript>
</head>
<body>
<?$this->load->view($content_view);?>
<!-- MESSAGE BOX-->
<div class="message-box animated fadeIn" data-sound="alert" id="mb-signout">
    <div class="mb-container">
        <div class="mb-middle">
            <div class="mb-title"><span class="fa fa-sign-out"></span> Log <strong>Out</strong> ?</div>
            <div class="mb-content">
                <p>Are you sure you want to log out?</p>
                <p>Press No if youwant to continue work. Press Yes to logout current user.</p>
            </div>
            <div class="mb-footer">
                <div class="pull-right">
                    <a href="pages-login.html" class="btn btn-success btn-lg">Yes</a>
                    <button class="btn btn-default btn-lg mb-control-close">No</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END MESSAGE BOX-->


<!-- START SCRIPTS -->
<!-- START PLUGINS -->
<script type="text/javascript" src="<?=home_assets()?>js/plugins/jquery/jquery.min.js"></script>
<script type="text/javascript" src="<?=home_assets()?>js/plugins/jquery/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?=home_assets()?>js/plugins/bootstrap/bootstrap.min.js"></script>
<!-- END PLUGINS -->

<!-- THIS PAGE PLUGINS -->
<script type='text/javascript' src='<?=home_assets()?>js/plugins/icheck/icheck.min.js'></script>
<script type='text/javascript' src='<?=home_assets()?>js/plugins/ajaxform.js'></script>
<script type="text/javascript" src="<?=home_assets()?>js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>

<script type='text/javascript' src='<?=home_assets()?>js/plugins/bootstrap/bootstrap-datepicker.js'></script>
<script type='text/javascript' src='<?=home_assets()?>js/plugins/bootstrap/bootstrap-select.js'></script>

<script type='text/javascript' src='<?=home_assets()?>js/plugins/validationengine/languages/jquery.validationEngine-en.js'></script>
<script type='text/javascript' src='<?=home_assets()?>js/plugins/validationengine/jquery.validationEngine.js'></script>

<script type='text/javascript' src='<?=home_assets()?>js/plugins/jquery-validation/jquery.validate.js'></script>
<script type="text/javascript" src="<?=home_assets()?>js/plugins/datatables/jquery.dataTables.min.js"></script>
<script type='text/javascript' src='<?=home_assets()?>js/plugins/maskedinput/jquery.maskedinput.min.js'></script>
<script type='text/javascript' src='<?=home_assets()?>js/easing.min.js'></script>
<!-- END THIS PAGE PLUGINS -->

<!-- START TEMPLATE -->

<script type="text/javascript" src="<?=home_assets()?>js/plugins.js"></script>
<script type="text/javascript" src="<?=home_assets()?>js/actions.js?v=2"></script>
<!-- END TEMPLATE -->

<script type="text/javascript">
    var jvalidate = $("#jvalidate").validate({
        ignore: [],
        rules: {
            login: {
                required: true,
                minlength: 2,
                maxlength: 8
            },
            password: {
                required: true,
                minlength: 5,
                maxlength: 10
            },
            're-password': {
                required: true,
                minlength: 5,
                maxlength: 10,
                equalTo: "#password2"
            },
            age: {
                required: true,
                min: 18,
                max: 100
            },
            email: {
                required: true,
                email: true
            },
            date: {
                required: true,
                date: true
            },
            credit: {
                required: true,
                creditcard: true
            },
            site: {
                required: true,
                url: true
            },
	   nama: {
                required: true
            },
	   handphone: {
                required: true
            },
	   alamat: {
                required: true
            },
	   rt: {
                required: true
            },
	   rw: {
                required: true
            },
	   kota: {
                required: true
            },
	   kodepos: {
                required: true
            },

        }
    });

	$(document).ready(function() { 
		$('form[name=frmDetail]').ajaxForm(function(e) { 
			/*nothing to do*/
			e.preventDefault();
			if($("#codepluscard").val()=='')
			{
				alert("Harap isi Kode Voucher !");
				return false;
			}
			  

		}); 
	
	}); 
</script>

<!-- END SCRIPTS -->
</body>
</html>