<?=$head?>
  <body class='login'>
    <?php echo $header_admin; ?>
    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span12 center">
            <div class="row-fluid">
                <div class="span4"></div>
                <div class="span4" id="frmLogin">
                    <div class="well">
                        <h1>Inicio de sesión</h1>
                    </div>    
                    <?php if($this->alinecms->is_Logged() && ! $this->alinecms->is_LoggedAdmin()){ ?>
                    <p><span class="label label-important">No tienes permiso para estar aquí </span> <br/> <span class="label label-important">  Debes de iniciar sesion como administrador.</span></p>
                    <?php }?>
                    <form name="frmLogin" id="frmLogin_" method="post" action="<?php echo base_url('panel/admin'); ?>" class="well">
                        <label><h1><small>Ingrese su email:</small></h1></label>
                        <div class="input-prepend">
                          <span class="add-on"><i class="icon-envelope"></i></span>
                            <input name="email_login" id="frmUsuario" type="text" class="input-xlarge" placeholder="Email">
                        </div>
                        <label><h1><small>Ingrese su contraseña:</small></h1></label>
                        <div class="input-prepend">
                          <span class="add-on"><i class="icon-asterisk"></i></span>
                            <input name="pass_login" id="frmLoginPass" type="password" class="input-xlarge" placeholder="Contraseña">
                        </div><br>
                        <div class="control">
                            <button class="btn btn-primary" name="btnGuardar" onclick="submit"><b>Iniciar sesión</b></button>
                        </div>
                    </form>
                    <?php if($no_existe != ""){ ?>
                        <span class="label label-important"><?=$no_existe?></span>
                        <br/>
                    <?php } ?>
                </div>
                <div class="span4"></div>
            </div>
            <div class="row-fluid">
                <div class="span4"></div>
                <div class="span4">
                    <?php if (validation_errors()): ?>
                    <div class="well">
                        <div class="alert alert-error" style="display:block!important;">
                            <?php echo validation_errors(); ?>
                        </div>
                        <div class="alert alert-block" style="display:block!important;">                        
                            <li>Verifique que este desactivada la función mayúsculas.</li>
                            <li>Verifique que su email y su contraseña sean correctos.</li>  
                        </div>  
                    </div>
                    <?php endif ?>
                </div>
            </div>
        </div><!--/span-->
      </div><!--/row-->
    <?=$footer?>
    </div><!--/.fluid-container-->
    <script type="text/javascript">
        $(document).ready(function(){
            $(".alert").hide();
            <?php if(isset($fail)){ ?>
                var loginfail = true;
            <?php }else{ ?>
                var loginfail = false;
            <?php } ?>             
            if(loginfail == true){
                $("#failLogin").show();
            } 
        });
    </script>
  </body>
</html>
