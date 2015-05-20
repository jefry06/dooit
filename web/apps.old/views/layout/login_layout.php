<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="webdesign" content="dinartdesign">


    <title><?asset_name()?> | Gift Voucher</title>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,800,800italic,700italic' rel='stylesheet' type='text/css'>
    <!-- Bootstrap -->
    <link href="<?=login_assets()?>css/bootstrap.css" rel="stylesheet">
    <link href="<?=login_assets()?>css/dinartdesign.css" rel="stylesheet">
    <link href="<?=login_assets()?>css/jPushMenu.css" rel="stylesheet">
    <link href="<?=login_assets()?>css/cssmenu/styles.css" rel="stylesheet">
    <link href="<?=login_assets()?>css/gridrotator.css" rel="stylesheet">
    <link href="<?=login_assets()?>css/font_awesome.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript" src="<?=login_assets()?>js/modernizr.custom.26633.js"></script>    
    <noscript>
        <link rel="stylesheet" type="text/css" href="<?=login_assets()?>css/fallback.css" />
    </noscript>
    <!--[if lt IE 9]>
    <link rel="stylesheet" type="text/css" href="<?=login_assets()?>css/fallback.css" />
    <![endif]-->
</head>
<body>
<?$this->load->view($content_view)?>

<footer>
    <div class="container">
        &copy;<?=date('Y')?> Plus Card - All right reserved | PT. Mobile Coin Asia &bull; Kebijakan Privasi &bull; Syarat & Ketentuan
    </div>
</footer>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="<?=login_assets()?>js/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="<?=login_assets()?>js/bootstrap.min.js"></script>
<script src="<?=login_assets()?>js/jPushMenu.js"></script>
<script src="<?=login_assets()?>css/cssmenu/script.js"></script>
<script type="text/javascript" src="<?=login_assets()?>js/jquery.gridrotator.js"></script>
<script type="text/javascript" src="<?=login_assets()?>js/maskinput.js"></script>
<script type="text/javascript" src="<?=login_assets()?>js/easing.min.js"></script>
<script type="text/javascript" src="<?=login_assets()?>js/jquery.form.js"></script>

<script src="<?=login_assets()?>js/custom.js"></script>   
</body>
</html>