<?php $this->load->view('/public/helper/head_1.php'); ?>
<meta name="title" content="<?php echo $pagina->m_titulo; ?>">
<meta name="description" content="<?php echo $pagina->m_descripcion; ?>">
</head>
<body>
<?php $this->load->view('/public/helper/logo.php'); ?>
<?php if ($menu_top) { $this->load->view('/public/helper/menus/menu_top.php'); } ?>
<?php if ($menu_nav == TRUE) { $this->load->view('/public/helper/menus/menu_nav.php'); } ?> 
<div class="container">
    <div class="row">
        <div class="span12 titulos">
            <h2 class="principal"><span><?=$pagina->titulo;?></span></h2>
        </div>  
    </div>
    <?php  $inicio = '/'; $base1 = '/portafolio/';?>
    <p class="breadcrums">
        <a href="<?php echo base_url(''.$inicio); ?>">Inicio</a> / Portafolio</a>
    </p>
    <div class="row">
        <div class="span3">
            <ul id="art_portafolio">
                <?php if(!$articulos_ed){ ?>
                No se encontraron artículos.
                <?php }else{ ?>
                <?php foreach ($articulos_ed as $item): ?>
                <?php $active = ""; $mhref = "";
                    if($mhref == 'http://www.grupolighting.com.mx/newpage/paginas/proyectos/'.$item->slug){
                $active = "active";
                }?>
                <li class="portafolio">
                    <a href="<?php echo base_url('/paginas/proyectos/'.$item->slug); ?>"><?php echo $item->titulo; ?></a>
                </li> 
                <?php endforeach ?><?php } ?>
            </ul>   
        </div>  
        <div class="span9">
            <h2 class="noborder">Proyectos</h2> 
            <?=$pagina->contenido;?>
        </div>
    </div>
</div>  
<div id="banners-hor">
<?php //$this->load->view('/public/helper/banners'); ?>
</div>
</div>
<div id="footer-wrapper">
  
    </div>      
    <!-- Le footer && Javascript files -->
    <!-- ******************************************* -->
    <!-- Le head.php  ==> location: application/views/public/helper/footer.php -->
    
    <?php if ($menu_footer == TRUE) { $this->load->view('/public/helper/menus/menu_footer.php'); } ?>
    <?php $this->load->view('public/helper/footer.php'); ?>
    <!-- ******************************************* -->
    <script type="text/javascript">
        $('#myCarousel').carousel();
        //$('.dropdown-toggle').dropdown();
      </script>
 
    </body>
</html>
