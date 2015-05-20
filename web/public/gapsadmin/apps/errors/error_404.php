<!DOCTYPE HTML>
<html>
<head>
<title>404 - Page Not Found</title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
/* latin */
@font-face {
  font-family: 'Love Ya Like A Sister';
  font-style: normal;
  font-weight: 400;
  src: local('Love Ya Like A Sister Regular'), local('LoveYaLikeASister-Regular'), url(assets/fonts/LzkxWS-af0Br2Sk_YgSJY9N6oT7VVZB_kATuDWj1CMI.woff2) format('woff2');
  unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2212, U+2215, U+E0FF, U+EFFD, U+F000;
}

body{
	font-family: 'Love Ya Like A Sister', cursive;
}
body{
	background:#eaeaea;
}	
.wrap{
	width:100%;
	
}

.logo{
	text-align:center;
	margin-top:40px;
}

.logo img{
	width:250px;}
.logo p{
	color:#272727;
	font-size:26px;
	margin-top:24px;
}	
.logo p span{
	color:lightgreen;
}	
.sub a{
	color:#fff;
	background:#272727;
	text-decoration:none;
	padding:6px 20px;
	font-size:13px;
	font-family: arial, serif;
	font-weight:bold;
	-webkit-border-radius:.3em;
	-moz-border-radius:.3em;
	-border-radius:.3em;
}	
.footer{
	color:black;
	position:absolute;
	right:10px;
	bottom:1px;
}	
.footer a{
	color:rgb(114, 173, 38);
}	
</style>
</head>
<body>
  <div class="wrap">
	 <div class="logo">
			<p>OOPS! - Could not Find it</p>
			<img src="<?php echo ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https:" : "http:").'//'.$_SERVER['HTTP_HOST'].'/gapsadmin/';?>assets/img/404-1.png"/>
			<div class="sub">
			   <p><a href="<?php echo ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https:" : "http:").'//'.$_SERVER['HTTP_HOST'].'/gapsadmin/';?>">Back</a></p>
			</div>
	</div>
 </div>		
</body>