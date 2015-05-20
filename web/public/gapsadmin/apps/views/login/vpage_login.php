<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Gaps CMS</title>
		<meta name="description" content="description">
		<meta name="author" content="Evgeniya">
		<meta name="keyword" content="keywords">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="<?php echo template_uri();?>plugins/bootstrap/bootstrap.css" rel="stylesheet">
		<link href="<?php echo template_uri();?>css/font-awesome.css" rel="stylesheet">
		<link href='<?php echo template_uri();?>css/font.css' rel='stylesheet' type='text/css'>
		<link href="<?php echo template_uri();?>css/style.css" rel="stylesheet">
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
				<script src="<?php echo template_uri();?>js/html5shiv.js"></script>
				<script src="<?php echo template_uri();?>js/respond.min.js"></script>
		<![endif]-->
	</head>
<body>
<div class="container-fluid">
	<div id="page-login" class="row">
		<div class="col-xs-12 col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
<!-- 			<div class="text-right">
				<a href="page_register.html" class="txt-default">Need an account?</a>
			</div> -->
			<div class="box">
				<div class="box-content">
					<?php $redirect = isset($_GET['redirect']) ? $_GET['redirect'] : base64_encode(base_url('dashboard')) ?>
				 	<form action="<?php echo site_url('log/in').'?redirect='.$redirect ?>" method="POST">
						<div class="text-center">
							<h3 class="page-header">GAPS Login Page</h3>
						</div>
						<?php $this->load->view('template/vmessage') ?>
						<div class="form-group">
							<label class="control-label">Username</label>
							<input type="text" class="form-control" name="username" />
						</div>
						<div class="form-group">
							<label class="control-label">Password</label>
							<input type="password" class="form-control" name="password" />
						</div>
						<div class="text-center">
						<button type="submit" class="btn btn-primary">Submit</button>
							
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="<?php echo template_uri();?>plugins/jquery/jquery-2.1.0.min.js"></script>
  <script type="text/javascript">
  $(document).ready(function(){
    var o = $('.alert');
    o.hide();
    o.fadeIn();
    o.click(function(){ hideError(); });
    setTimeout("hideError()",5000);
    $('#alert').click(function(event) {
    	$('#alert').hide();
    });    
  });
  function hideError(){ $(".alert").fadeOut(); }
  </script> 
</body>
</html>
