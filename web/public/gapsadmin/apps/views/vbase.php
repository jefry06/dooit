<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Plus Card</title>
		<meta name="description" content="description">
		<meta name="author" content="DevOOPS">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="<?php echo template_uri();?>plugins/bootstrap/bootstrap.css" rel="stylesheet">
		<link href="<?php echo template_uri();?>plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet">
		<link href="<?php echo template_uri();?>css/font-awesome.css" rel="stylesheet">
		<link href='<?php echo template_uri();?>css/font.css' rel='stylesheet' type='text/css'>
		<link href="<?php echo template_uri();?>plugins/fancybox/jquery.fancybox.css" rel="stylesheet">
		<link href="<?php echo template_uri();?>plugins/fullcalendar/fullcalendar.css" rel="stylesheet">
		<link href="<?php echo template_uri();?>plugins/xcharts/xcharts.min.css" rel="stylesheet">
		<link href="<?php echo template_uri();?>plugins/select2/select2.css" rel="stylesheet">
		<link href="<?php echo template_uri();?>plugins/datatables/datatables.css" rel="stylesheet">		
		<link href="<?php echo template_uri();?>css/style.css" rel="stylesheet">
		<link href="<?php echo template_uri();?>css/spectrum.css" rel="stylesheet">
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
				<script src="<?php echo template_uri();?>js/html5shiv.js"></script>
				<script src="<?php echo template_uri();?>js/respond.min.js"></script>
		<![endif]-->
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="<?php echo template_uri();?>js/jquery.js"></script>
		<script src="<?php echo template_uri();?>plugins/jquery/jquery-2.1.0.min.js"></script>
		<script src="<?php echo template_uri();?>plugins/jquery-ui/jquery-ui.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="<?php echo template_uri();?>plugins/bootstrap/bootstrap.min.js"></script>
		<script src="<?php echo template_uri();?>plugins/select2/select2.js"></script>
		<script src="<?php echo template_uri();?>plugins/justified-gallery/jquery.justifiedgallery.min.js"></script>
		<script src="<?php echo template_uri();?>plugins/tinymce/tinymce.min.js"></script>
		<script src="<?php echo template_uri();?>plugins/tinymce/jquery.tinymce.min.js"></script>
		<script src="<?php echo template_uri();?>plugins/datatables/jquery.dataTables.min.js"></script>
		<script src="<?php echo template_uri();?>js/spectrum.js"></script>
		
		<!-- All functions for this theme + document.ready processing -->
		<script src="<?php echo template_uri();?>js/devoops.js"></script>
		  <script type="text/javascript">
		  $(document).ready(function(){
		    $('#alert').click(function(event) {
		    	$('#alert').hide();
		    });

		  });
		  </script>

	</head>
<body>
<!--Start Header-->
<?php echo $header;?>
<!--End Header-->
<!--Start Container-->
<div id="main" class="container-fluid">

	<div class="row">

		<!--Start Navigation-->
		<?php echo $navigation;?>
		<!--End Navigation-->
		<!--Start Content-->
		<div id="content" class="col-xs-12 col-sm-10">
		<?php $this->load->view('template/vmessage') ?>
<!-- 			<div class="preloader">
				<img src="<?php echo template_uri();?>img/devoops_getdata.gif" class="devoops-getdata" alt="preloader"/>
			</div>
			<div id="ajax-content"></div> -->
			<?php echo $content;?>
		</div>
		<!--End Content-->
	</div>
</div>
<!--End Container-->
  <script type="text/javascript">
  $(document).ready(function(){
    var o = $('#alert');
    o.fadeIn();
    o.click(function(){ hideError(); });
    setTimeout("hideError()",3000);
  });

  function hideError(){ $("#alert").fadeOut(); }
  </script>
</body>
</html>
