</div>
  </div><!--container end-->
  <footer style="background-color:#CECECE;padding:0px;">
    <div class="container"> 
      <div class="row-fluid menus-footer">
        <?php if ($menu_footer1 == TRUE) {
          $this->load->view('/public/helper/menus/menu_footer1.php'); 
        } 
        if ($menu_footer2 == TRUE) {
          $this->load->view('/public/helper/menus/menu_footer2.php'); 
        }
        if ($menu_footer3 == TRUE) {
          $this->load->view('/public/helper/menus/menu_footer3.php'); 
        }
        if ($menu_footer4 == TRUE) {
          $this->load->view('/public/helper/menus/menu_footer4.php'); 
        } ?>
      </div>
    </div>
    <div class="container">
      <div class="row-fluid">
        <div class="span6">
          <?php $year = date("Y"); ?>
          <p><?=$this->configuration->titulo?> | Todos los Derechos Reservados <?php echo $year; ?></p>
          <?php if (strlen($this->configuration->direccion) > 2): ?>  
          <p><?=$this->configuration->direccion?></p>
          <?php endif ?>
          <?php if (strlen($this->configuration->telefono) > 2): ?>  
          <p>Tel: <?=$this->configuration->telefono?></p>
          <?php endif ?>
        </div>
        <div class="span6" style="text-align:right;">
          <div id="redes">
            <h3>Social</h3>
            <?php 
            $fb = $this->configuration->facebook; $tw = $this->configuration->twitter; $ytb =$this->configuration->youtube;
            $gg =$this->configuration->google; $lkn =$this->configuration->linked;
            if (strlen($fb) > 2) { ?>
              | <a id="facebook" href="<?=$this->configuration->facebook?>" target="_blank">Fb</a> |
            <?php }
            if (strlen($tw) > 2) { ?>
              <a id="twitter" href="<?=$this->configuration->twitter?>" target="_blank">Tw </a> |
            <?php } 
            if (strlen($ytb) > 2) { ?>
              <a id="youtube" href="<?=$this->configuration->youtube?>" target="_blank">Yt </a> |
            <?php } 
            if (strlen($gg) > 2) { ?>
              <a id="google" href="<?=$this->configuration->google?>" target="_blank">G+ </a> |
            <?php } 
            if (strlen($lkn) > 2) { ?>
              <a id="linked" href="<?=$this->configuration->linked?>" target="_blank">In </a> |
            <?php } ?>
          </div>
        </div>         
      </div>
    </div>
  </footer>
  <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <!-- This .js file, add generic functions. -->
<!-- jquery necesario -->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.2/jquery.min.js"></script>  
<!-- bootstrap -->
<script src="<?php echo base_url('assets/js/bootstrap-carousel.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap-dropdown.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap-transition.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap-modal.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap-min.js'); ?>"></script>
<!-- Script lightbox -->
<script src="<?php echo base_url('assets/js/lightbox/lightbox-2.6.min.js'); ?>"></script>

<script src="<?php echo base_url('assets/js/prefix-free.js'); ?>"></script>

<script type="text/javascript">
$(document).ready(function(){
    $(".link_to").on("click",function(e){
      e.preventDefault();
      console.log("click on link_to")
      var slug = $(this).attr("page");
      $(".modal-body").load( "<?php echo base_url('paginas/get_content_page');?>/"+slug);
      $("#myModalLabel").html(slug.toUpperCase());
      $('#myModal').modal('show');
    });
});
</script>

<script src="<?php echo base_url('assets/js/carousel/jquery.bxslider.min.js'); ?>"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $('.slider5').bxSlider({
      slideWidth: <?=$this->configuration->slider_ancho?>,
      slideHeigth: <?=$this->configuration->slider_alto?>,
      minSlides: 1,
      maxSlides: 1,
      moveSlides: 1,
      slideMargin: 20,
      auto: <?=$this->configuration->auto?>,
      speed: <?=$this->configuration->velocidad?>,
      infiniteLoop: <?=$this->configuration->infinito?>,
      startSlide: <?=$this->configuration->slide_i?>,
      randomStart: <?=$this->configuration->aleatorio?>,
      controls: <?=$this->configuration->controles?>,
      autoControls: false
    });
  });
</script>

<script type="text/javascript">
  $(document).ready(function(){
    $('.slidercarousel').bxSlider({
      slideWidth: 200,
      minSlides: 1,
      maxSlides: 4,
      moveSlides: 1,
      slideMargin: 5,
      auto: true,
      speed: 1500,
      infiniteLoop: true,
      controls: false,
    });
  });
</script>

<script type="text/javascript">
  $(document).ready(function(){
    $('.slidervert1').bxSlider({
      minSlides: 2,
      maxSlides: 2,
      mode: 'horizontal',
      moveSlides: 1,
      slideMargin: 14,
      slideWidth: 200,
      auto: true,
      speed: 1000,
      randomStart: true,
      infiniteLoop: true,
      controls: false,
    });
  });
</script>

<script type="text/javascript">
$(function(){
    $("#buscarBtn").on("click",function(e){
      var buscar = $("input[name='buscar']").val();
      buscar = $.trim(buscar);
        if(buscar == ""){
          e.preventDefault();
        }
    });
});

/*menu activo*/
$(function(){
  $('nav li.active').parents('nav li').addClass('active');
});
</script>

</body>
     
</html>



 
