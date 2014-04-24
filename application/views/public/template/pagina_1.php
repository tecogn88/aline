<?php $this->load->view('/public/helper/head_1.php'); ?>
<title><?php echo $pagina->titulo; ?></title>
<meta name="title" content="<?php echo $pagina->m_titulo; ?>">
<meta name="description" content="<?php echo $pagina->m_descripcion; ?>">
</head>
<body>
<?php $this->load->view('/public/helper/logo.php'); ?>
<?php if ($menu_top) { $this->load->view('/public/helper/menus/menu_top.php'); } ?>
<?php if ($menu_nav == TRUE) { $this->load->view('/public/helper/menus/menu_nav.php'); } ?>	
    <div id="home-wrapper" class="span12"> 
	    <div id="contenido-txt">
	    	<h1><?=$pagina->titulo;?></h1>	
	        <?=$pagina->contenido;?>
	    </div>  
	    <div id="banners-hor">
	    	<?=$menu_left?>
	    </div>
	</div>
<?php if ($menu_footer == TRUE) { $this->load->view('/public/helper/menus/menu_footer.php'); } ?>
<?php $this->load->view('public/helper/footer.php'); ?>
</body>
</html>
