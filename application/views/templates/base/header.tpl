<!DOCTYPE html>
<html lang="es">
<head>	
	<title>
		{(isset($title))?$title:'Promo Moviit'}
	</title>
	<meta charset="UTF-8">
	<META NAME="Author" CONTENT="Orion System Ltda."> 
		<link rel="stylesheet" type="text/css" href="{$dots}components/font-awesome/css/font-awesome.min.css?v={VERSION}">
		<link rel="stylesheet" type="text/css" href="{$dots}components/bootstrap/css/bootstrap.min.css?v={VERSION}">
		<link rel="stylesheet" type="text/css" href="{$dots}components/theme/css/AdminLTE.min.css?v={VERSION}>">
		<link rel="stylesheet" type="text/css" href="{$dots}components/theme/css/skins/_all-skins.min.css?v={VERSION}>">
		<link rel="stylesheet" type="text/css" href="{$dots}components/alertifyjs/css/alertify.min.css?v={VERSION}>">
		<link rel="stylesheet" type="text/css" href="{$dots}components/alertifyjs/css/themes/bootstrap.min.css?v={VERSION}>">
		<link rel="stylesheet" href="{$dots}components/theme/plugins/daterangepicker/daterangepicker-bs3.css">

		<script type="text/javascript" src="{$dots}components/jquery/jquery.min.js?v={VERSION}"></script>
		<script type="text/javascript" src="{$dots}components/bootstrap/js/bootstrap.min.js?v={VERSION}"></script>		
		<script type="text/javascript" src="{$dots}components/alertifyjs/alertify.min.js?v={VERSION}>"></script>

		<script type="text/javascript" src="{$dots}components/theme/plugins/slimScroll/jquery.slimscroll.min.js?v={VERSION}"></script>
		<script type="text/javascript" src="{$dots}components/theme/plugins/fastclick/fastclick.min.js?v={VERSION}"></script>

		<script type="text/javascript" src="{$dots}components/theme/js/app.min.js?v={VERSION}"></script>
		<script type="text/javascript" src="{$dots}components/theme/js/demo.js?v={VERSION}"></script>
		<script src="{$dots}components/moment/moment.js"></script>
		<script src="{$dots}components/theme/plugins/daterangepicker/daterangepicker.js"></script>
		<script type="text/javascript" src="{$dots}components/gcPlugin.js?v={VERSION}"></script>
		

		{if isset($include_plugin)}
		{foreach $include_plugin as $plugin}
		{if strpos($plugin,'.js')}
		<script type="text/javascript" src="{$dots}components/{$plugin}?v={VERSION}"></script>
		
		{elseif strpos($plugin,'.css')}
		<link rel="stylesheet" type="text/css" href="{$dots}components/{$plugin}?v={VERSION}">					
		{/if}
		{/foreach}
		{/if}

		{if isset($include_fullPath)}
		{foreach $include_fullPath as $fullPath}
		{if strpos($fullPath,'.js')}
		<script type="text/javascript" src="{$dots}{$fullPath}?v={VERSION}"></script>
		
		{elseif strpos($fullPath,'.css')}
		<link rel="stylesheet" type="text/css" href="{$dots}{$fullPath}?v={VERSION}">					
		{/if}
		{/foreach}
		{/if}



		{if isset($include_css)}
		{foreach $include_css as $css}
		<link rel="stylesheet" type="text/css" href="{$dots}static/css/{$css}?v={VERSION}">					
		{/foreach}
		{/if}

		{if isset($include_js)}
		{foreach $include_js as $js}
		<script type="text/javascript" src="{$dots}static/js/{$js}?v={VERSION}"></script>			
		{/foreach}
		{/if}	
	</head>
	<body class="{$body_class}">
		<!-- Site wrapper -->
		<div class="wrapper">

