<?php $this->load->view('/public/helper/head.php');
$this->load->view('/public/helper/logo.php');
if ($menu_top) {
	$this->load->view('/public/helper/menus/menu_top.php'); 
}
if($this->configuration->buscador == 1){
	$this->load->view('/public/helper/buscador.php');
}
if ($menu_nav == TRUE) {
	$this->load->view('/public/helper/menus/menu_nav.php'); 
}
$this->load->view('/public/helper/slider.php');
$this->load->view('/public/helper/article.php'); 
if ($menu_footer == TRUE) {
	$this->load->view('/public/helper/menus/menu_footer.php'); 
}
$this->load->view('/public/helper/footer.php'); ?>