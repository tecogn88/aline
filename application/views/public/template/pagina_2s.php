		<div class="exist">
		<?php $this->load->view('/public/helper/head.php'); ?>
		
			<div id="back-wrapper" class="container">
				<div class="row">
					<div class="redes">
					<a class="icons" target="_blank" href="#"><img src="<?php echo base_url('assets/img/icono-fb.png'); ?>"></a>
					<a class="icons" target="_blank" href="#"><img src="<?php echo base_url('assets/img/icono-tw.png'); ?>"></a>
					</div>
				</div>
            	<div class="logo"><a href="<?php echo base_url(); ?>"><img src="http://servernewemage.local/bestquality/assets/img/logo2.png" ></a></div>
            	<nav>
            	<?=$Menu_Principal?>
            	</nav>
                <div id="home-wrapper" class="span12">
                
                <div id="contenido-txt">
                 
                 <h2><?=$pagina->titulo;?></h2>	
                 <form class="contact-info">
 	             	<label>Nombre</label>
					<input type="text">
					<label>Correo Electrónico</label>
					<input type="text">
					<label>Mensaje</label>
					<textarea rows="3"></textarea><br />
					 <button type="button" class="btn">Enviar</button>
 	             </form>
 	             <?=$pagina->contenido;?>

 	            </div>  
               
            </div>
            </div>
			<!-- Le main content -->
			
	<div id="footer-wrapper">
  
    </div>		
	<div id="mapa">
		<iframe width="2000" height="700" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/?ie=UTF8&amp;t=m&amp;ll=22.147821,-100.975213&amp;spn=0.027824,0.085788&amp;z=15&amp;output=embed"></iframe><br /><small><a href="https://maps.google.com/?ie=UTF8&amp;t=m&amp;ll=22.147821,-100.975213&amp;spn=0.027824,0.085788&amp;z=15&amp;source=embed" style="color:#0000FF;text-align:left"></a></small>
	</div>

</div>

	</body>
	
</html>