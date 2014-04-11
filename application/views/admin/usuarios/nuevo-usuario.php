<?=$head?>
<?php echo ck_includes(); ?>
<body>
<?=$header?>
	<div class="wrapper container-fluid">
		<div class="row-fluid">
			<aside class="span2">
				<div class="tabbable tabs-left">
					<ul class="nav nav-tabs">
						<li class=""><a href="<?php echo base_url('panel/usuarios/'); ?>" >Panel <span class='label label-default' style='float:right'><i class='icon-list icon-white'></i></span></a></li>
						<li class="active"><a href="<?php echo base_url('panel/usuarios/nuevo_usuario'); ?>" >Agregar Usuario <span class='label label-default' style='float:right'><i class='icon-plus icon-white'></i></span></a></li>
					</ul>
				</div>
			</aside>
		
<div id="body_content" class="span10">

<div id="body_content" class="span12 panel_usuarios">
	<div class="row-fluid">
	<form method="POST" action="<?php echo base_url('panel/usuarios/crea_usuario') ?>" name="" id="frmAddUsuario" class="form-horizontal" enctype="multipart/form-data">
		<div class="row-fluid">
			<div class="well">
				<div class="span8">
					<h2><?=$nombre_pagina?> <small> <?=$descripcion_pagina?></small></h2>
				</div>
				<a href="<?php echo base_url('panel/usuarios'); ?>"style="margin-left:10px;float:right;" class="btn btn-danger">Cancelar<span style='float:right;margin-left:10px;'><i class='icon-ban-circle icon-white'></i></span></a><!-- 
				<input style="margin-left:10px;float:right;" class="btn btn-primary" type="submit" name="btnGuardar" value="Agregar usuario"/> -->
				<button style="margin-left:10px;float:right;" class="btn btn-primary" name="btnGuardar" onclick="submit">Agregar Usuario<span style='float:right;margin-left:10px;'><i class='icon-plus icon-white'></i></span></button>
			</div>
		</div>
		<fieldset>
		<?php 
			if(isset($pass) && $pass == TRUE){
				$strAlert =  "<div class='alert alert-success'>";
				$strAlert .= "<a class='close' data-dismiss='alert' href='#'>×</a>";
				$strAlert .= "<h4 class='alert-heading'></h4>";
				$strAlert .= "<p>Usuario creado satisfactoriamente, si deseas <a href='" . base_url('panel/usuarios/editarusuario/') .  "' >editar este usuario click aquí</a>?</p>";
				$strAlert .= "</div>";
				//echo $strAlert; 
			}
		?>	

		<?php 

			$flagValida = FALSE;
			$flagUsrFail = FALSE;
			$flagEmailFail = FALSE;
			
			if(isset($pass)){
				global $flagValida;
				$flagValida = TRUE;
			}
			if(isset($usr_fail) && $usr_fail == TRUE){
				global $flagUsrFail;
				$flagUsrFail = TRUE;
			}
			
			if(isset($email_fail) && $email_fail == TRUE){
				global $flagEmailFail;
				$flagEmailFail = TRUE;
			}

			function get_error($nombretxt = ''){
				global $flagValida , $flagUsrFail , $flagEmailFail ;

				if( $nombretxt == "usuario" && $flagUsrFail == TRUE){ echo "error";  return; }
				if( $nombretxt == "email" && $flagEmailFail == TRUE){ echo "error";  return; }
				
				if( $flagValida == TRUE ){
					if( form_error("$nombretxt")  != "" ) {
						echo "error";
						
					}else{
						echo "success";
					}
				}
			}

			function print_error($nombretxt = ''){
				global $flagValida, $flagUsrFail , $flagEmailFail ;
				
				if( $nombretxt == "usuario" && $flagUsrFail == TRUE){ 
					$flagUsrFail = FALSE; echo "<span class='help-inline'>El usuario ya existe, ingresa otro por favor.</span>";  return; 
				}
				if( $nombretxt == "email" && $flagEmailFail == TRUE){ 
					$flagEmailFail = FALSE; echo "<span class='help-inline'>El email ya existe, ingresa otro por favor.</span>"; return; 
				}

				if( $flagValida == TRUE  ){
					if( form_error("$nombretxt")  != "" ) {
						echo form_error("$nombretxt" , "<span class='help-inline'>","</span>");
						
					}else{
						echo "<span class='help-inline'>Woohoo!!</span>";
					}
				}
			}
			
		?>

		<?php if( isset($pass) && $pass == TRUE){?>
			<div class="alert alert-info">
					Usuario creado satisfactoriamente!!
			</div>
		<?php } ?>
		<div>
			<ul class="nav nav-tabs" id="myTab">
			  <li class="active"><a href="#general">General</a></li>
			  <li><a href="#contacto">Adicional</a></li>
			  <li><a href="#imagen_usr">Imagen</a></li>
			</ul>
			<div class="alert alert-tabs">
				<div class="tab-content">
					<div class="tab-pane active" id="general">
						<div class="span6">
							<div class="control-group <?php get_error('nombre'); ?>">
								<label for="idNombre" class="control-label">Nombre <em>(*)</em></label>
								<div class="controls">
									<input   name="nombre" value="<?php echo set_value('nombre'); ?>" type="text" id="idNombre" class="input-xlarge focus">
									<?php print_error('nombre'); ?>
								</div>
							</div>
							<div id="grpIdUsuario" class="control-group <?php get_error('usuario'); ?>">
								<label for="idUsuario" class="control-label">Usuario <em>(*)</em></label>
								<div class="controls">
									<input name="usuario" value="<?php echo set_value('usuario'); ?>" type="text" id="idUsuario" class="input-xlarge">
									<?php print_error('usuario'); ?>
								</div>
							</div>
							<div class="control-group <?php get_error('pass'); ?>">
								<label for="input04" class="control-label">Contraseña <em>(*)</em></label>
								<div class="controls">
									<input  name="pass" value="<?php echo set_value('pass'); ?>" type="password" id="input04" class="input-xlarge">
									<?php print_error('pass'); ?>
								</div>
							</div>
							<div class="control-group <?php get_error('re_pass'); ?>">
								<label for="idre_pass" class="control-label">Re-Ingrese Contraseña <em>(*)</em></label>
								<div class="controls">
									<input  name="re_pass" value="<?php echo set_value('re_pass'); ?>" type="password" id="idre_pass" class="input-xlarge">
									<?php print_error('re_pass'); ?>
								</div>
							</div>						
							<div class="control-group <?php get_error('facebook'); ?>">
								<label for="input06" class="control-label">Facebook <em></em></label>
								<div class="controls">
									<input  name="facebook" value="<?php echo set_value('facebook'); ?>"  type="text" id="input06" class="input-xlarge">
									<?php print_error('facebook'); ?>
								</div>
							</div>
							
						</div>
						<div class="span6">
							<div class="control-group <?php get_error('apellidos'); ?>">
								<label for="idApellido" class="control-label">Apellidos <em>(*)</em></label>
								<div class="controls">
									<input name="apellidos" value="<?php echo set_value('apellidos'); ?>" type="text" id="idApellido" class="input-xlarge">
									<?php print_error('apellidos'); ?>
								</div>
							</div>
							<div class="control-group <?php get_error('email'); ?>">
								<label for="input06" class="control-label">Email <em>(*)</em></label>
								<div class="controls">
									<input  name="email" value="<?php echo set_value('email'); ?>"  type="text" id="input06" class="input-xlarge">
									<?php print_error('email'); ?>
								</div>
							</div>
							<div class="control-group">
								<label for="input06" class="control-label">Seleccione el perfil</label>
								<div class="controls">
									<select class="" style="width:280px;" name="perfil">
										<option value="3">Suscriptor</option>
										<option value="2">Editor</option>
										<option value="1">Administrador</option>
									</select>
								</div>
							</div>
							<div class="control-group <?php get_error('twitter'); ?>">
								<label for="input06" class="control-label">Twitter <em></em></label>
								<div class="controls">
									<input  name="twitter" value="<?php echo set_value('twitter'); ?>"  type="text" id="input06" class="input-xlarge">
									<?php print_error('twitter'); ?>
								</div>
							</div>
							<div class="control-group <?php get_error('g_plus'); ?>">
								<label for="input06" class="control-label">Google Plus <em></em></label>
								<div class="controls">
									<input  name="g_plus" value="<?php echo set_value('g_plus'); ?>"  type="text" id="input06" class="input-xlarge">
									<?php print_error('g_plus'); ?>
								</div>
							</div>	
						</div>
					</div>
					<div class="tab-pane" id="contacto">
						<div class="control-group <?php get_error('descripcion'); ?>">
							<label for="input06" class="control-label">Descripcion</label>
							<div class="controls">
								<textarea  name="descripcion" type="text" id="ckeditor" class="input-xlarge"><?php echo set_value('descripcion'); ?></textarea>
								<?php print_error('descripcion'); ?>
								<?php $ck_config = array(     
									"replace" => "#ckeditor" // selector del objeto a reemplazar     
									, "options" => ck_options()     
								);
								echo jquery_ckeditor($ck_config); ?>
							</div>
						</div>
						<div class="control-group <?php get_error('hobies'); ?>">
							<label for="input06" class="control-label">Gustos y pasatiempos</label>
							<div class="controls">
								<textarea  name="hobies" type="text" id="ckeditor1" class="input-xlarge"><?php echo set_value('hobies'); ?></textarea>
								<?php print_error('hobies'); ?>
								<?php $ck_config = array(     
									"replace" => "#ckeditor1" // selector del objeto a reemplazar     
									, "options" => ck_options()     
								);
								echo jquery_ckeditor($ck_config); ?>
							</div>
						</div>
					</div>
					<div class="tab-pane" id="imagen_usr">
						<label class="control-label">Imagen</label>
						<div class="controls">
							<input type="file" name="imagen">
						</div>
					</div>
				</div>
			</div>
		</div>	
		</fieldset>
	</form>
	</div>
	</div>
</div>

	<!-- Footer -->
	<?php $this->load->view('admin/helper/footer.php'); ?>
	
	</div> 
	<!-- End div class="wrapper container" -->

	<!-- Script solo para esta pagina -->
	<script type="text/javascript">
		$(document).ready(function(){
			$(".usuario").hide();
			$(".alert_re_pass").hide();
			$(".alert_re_pass, .usuario").css('width','68%');
			var valUsuario = ""

			$(function(){
				$("#idUsuario").focus(function(){
					var self = $(this);
					if(self.val() != "") return;
					var nombre = $("#idNombre").val();
					var apellido = $("#idApellido").val();
					if( nombre == "") return;
					if( apellido == "") return;
					nombre = nombre.substring(0,1);
					apellido = apellido.split(" ");
					var user = nombre + apellido[0];
					self.val(user.toLowerCase());
					valUsuario = user;
					$(this).after("<span id='msgUsuario'  class='help-inline'> Este este es solo una sugerencia para el nombre de usuario, es libre de editarlo a su eleccion.</span>");	
					$("#grpIdUsuario").removeClass("error");
					$("#grpIdUsuario").removeClass("success");
					$("#grpIdUsuario").addClass("warning");
				});

				$("#idUsuario").focusout(function(){
					$("#grpIdUsuario").removeClass("warning");
					$("#msgUsuario").remove();	
				});

			});

			$(function(){
				$("#idUsuario").change(function(){
					var self = $(this);
					if(self.val() == "" || self.val() != valUsuario) {
						$(".msgUsuario").fadeOut('slow');	
					}
				});
			});

			$(function(){
			/*
				$('#frmAddUsuario').submit(function(){
					if( checkData == true ){
						$('#frmAddUsuario').submit();
						return true;
					}else{
						return false
					}
				});
			*/
			});

			function checkData(){
				// agregar validacion del lado del cliente
				return true;
			}



		}); // End document ready
	</script>

	<script src="<?php echo base_url('assets/js/bootstrap-tab.js'); ?>"></script>
		<script>
		  $(function () {
		    $('#myTab a:first').tab('show');
		  });
		  $('#myTab a').click(function (e) {
		  e.preventDefault();
		  $(this).tab('show');
		});
		</script>


</body>
</html>
