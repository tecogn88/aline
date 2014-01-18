<?=$head?>
<?php echo ck_includes(); ?>
<body>
<?=$header?>
<div class="wrapper container-fluid">
	<div class="row-fluid">
		<aside class="span2">
			<div class="tabbable tabs-left">
				<ul class="nav nav-tabs">
					<li class=""><a href="<?php echo base_url('panel/usuarios/'); ?>" >Panel<span class='label label-default' style='float:right'><i class='icon-list icon-white'></i></span></a></li>
					<li class="active"><a href="<?php echo base_url('panel/usuarios/nuevo_usuario'); ?>" >Agregar Usuario<span class='label label-default' style='float:right'><i class='icon-plus icon-white'></i></span></a></li>
				</ul>
			</div>
		</aside>	
		<div id="body_content" class="span10">
			<div id="body_content" class="span12 panel_usuarios">
				<form method="POST" action="<?php echo base_url('panel/usuarios/guarda_edicion/'.$usr->id) ?>" name="" id="frmEditUsuario" class="form-horizontal" enctype="multipart/form-data">
				<div class="row-fluid">
					<div class="well">
						<div class="span7">
							<h2><?=$nombre_pagina?> <small> <?=$descripcion_pagina?></small></h2>
						</div>
						<a class="btn btn-danger" href="<?php echo base_url('/panel/usuarios/') ?>" style="float:right;margin-left:10px;">Cancelar edicion<span style='float:right;margin-left:10px;'><i class='icon-ban-circle icon-white'></i></span></a>
						<a href="#" id="btnEditarPass" class="btn btn-inverse btn-medium" style="float:right;margin-left:10px;">Cambiar Contraseña<span style='float:right;margin-left:10px;'><i class='icon-pencil icon-white'></i></span></a>
						<!-- <input style="margin-left:10px; float:right;" class="btn btn-primary" type="submit" name="btnGuardar" value="Guardar"/> -->
						<button style="margin-left:10px;float:right;" class="btn btn-primary" name="btnGuardar" onclick="submit">Guardar<span style='float:right;margin-left:10px;'><i class='icon-ok-sign icon-white'></i></span></button>
					</div>
				</div>
				<div class="row-fluid">
					<fieldset>
					<!--  id de usuario a editar --> 
						<input type="hidden" value="<?=$usr->id?>" name="id" />	
						<div class="row-fluid">
							<div class="span6">
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
												echo "<span class='help-inline'></span>";
											}
										}
									}
									function get_data($campo = ""){
										if( set_value($campo) == "" ){
											//echo $usr->nombre;
										}else{
											//echo set_value($campo);
										}
									}
								?>

								<?php if( isset($pass) && $pass == TRUE){?>
									<div class="alert alert-info">
					 					Usuario creado satisfactoriamente!!
									</div>
								<?php } ?>
							</div>
							<div class="span6">
								<div id="edita_pass">
								    <div class="alert alert-info">
										<div class="control-group <?php get_error('pass'); ?>">
											<label for="pass" class="control-label">Contraseña <em>(*)</em></label>
											<div class="controls">
												<input  name="new_pass" value="" type="password" id="pass" class="input-xlarge clsPass">
												<?php print_error('pass'); ?>
											</div>
										</div>

										<div class="control-group <?php get_error('re_pass'); ?>">
											<label for="idre_pass" class="control-label">Re-Ingrese Contraseña <em>(*)</em></label>
											<div class="controls">
												<input  name="new_re_pass" value="" type="password" id="idre_pass" class="input-xlarge clsPass">
												<?php print_error('re_pass'); ?>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
		<div class="row-fluid">
			<div style="margin-top:-30px;">
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
									<input   name="nombre" value="<?php if( set_value('nombre') == "" ){echo $usr->nombre;}else{echo set_value('nombre');} ?>" type="text" id="idNombre" class="input-xlarge focus">
									<?php print_error('nombre'); ?>
								</div>
							</div>
							<div id="grpIdUsuario" class="control-group <?php get_error('usuario'); ?>">
								<label for="idUsuario" class="control-label">Usuario <em>(*)</em></label>
								<div class="controls">
									<input  name="usuario" value="<?php if( set_value('usuario') == "" ){echo $usr->usuario;}else{echo set_value('usuario');} ?>" type="text" id="idUsuario" class="input-xlarge">
									<?php print_error('usuario'); ?>
								</div>
							</div>
							<div class="control-group <?php get_error('facebook'); ?>">
								<label for="input06" class="control-label">Facebook <em></em></label>
								<div class="controls">
									<input  name="facebook" value="<?php if( set_value('facebook') == "" ){echo $usr->facebook;}else{echo set_value('facebook');} ?>"  type="text" id="input06" class="input-xlarge">
									<input type="hidden" value="<?php echo $usr->facebook ?>">
									<?php print_error('facebook'); ?>
								</div>
							</div>
							<div class="control-group <?php get_error('g_plus'); ?>">
								<label for="input06" class="control-label">Google Plus<em></em></label>
								<div class="controls">
									<input  name="g_plus" value="<?php if( set_value('g_plus') == "" ){echo $usr->g_plus;}else{echo set_value('g_plus');} ?>"  type="text" id="input06" class="input-xlarge">
									<input type="hidden" value="<?php echo $usr->g_plus ?>">
									<?php print_error('g_plus'); ?>
								</div>
							</div>
						</div>
						<div class="span6">
							<div class="control-group <?php get_error('apellidos'); ?>">
								<label for="idApellido" class="control-label">Apellidos <em>(*)</em></label>
								<div class="controls">
									<input name="apellidos" value="<?php if( set_value('apellidos') == "" ){echo $usr->apellidos;}else{echo set_value('apellidos');} ?>" type="text" id="idApellido" class="input-xlarge">
									<?php print_error('apellidos'); ?>
								</div>
							</div>
				     		<div class="control-group <?php get_error('email'); ?>">
								<label for="input06" class="control-label">Email <em>(*)</em></label>
								<div class="controls">
									<input  name="email" value="<?php if( set_value('email') == "" ){echo $usr->email;}else{echo set_value('email');} ?>"  type="text" id="input06" class="input-xlarge">
									<input type="hidden" value="<?php echo $usr->email ?>">
									<?php print_error('email'); ?>
								</div>
							</div>
							<div class="control-group <?php get_error('twitter'); ?>">
								<label for="input06" class="control-label">Twitter <em></em></label>
								<div class="controls">
									<input  name="twitter" value="<?php if( set_value('twitter') == "" ){echo $usr->twitter;}else{echo set_value('twitter');} ?>"  type="text" id="input06" class="input-xlarge">
									<input type="hidden" value="<?php echo $usr->twitter ?>">
									<?php print_error('twitter'); ?>
								</div>
							</div>
							<div class="control-group">
							<?php 
								$_suscriptor = "";
								$_editor = "";
								$_administrador = "";
								if( set_value('perfil') == "" ){
									 
									 switch ($usr->perfil) {
									 	case '3':
									 		$_suscriptor = "selected";
									 		break;
									 	case '2':
									 		$_editor = "selected";
									 		break;
									 	case '1':
									 		$_administrador = "selected";
									 		break;
									 }
									 
								}else{
									$_select_id =  set_value('perfil');
									switch ($_select_id) {
									 	case '3':
									 		$_suscriptor = "selected";
									 		break;
									 	case '2':
									 		$_editor = "selected";
									 		break;
									 	case '1':
									 		$_administrador = 'selected';
									 		break;
									 } // End Switch
								} // End Else 
							?>

							<label for="input06" class="control-label">Seleccione el perfil</label>
							<div class="controls">
								<select class="" name="perfil"s>
									<option <?=$_suscriptor?> 	 value="3">Suscriptor</option>
									<option <?=$_editor?> 		 value="2">Editor</option>
									<option <?=$_administrador?> value="1">Administrador</option>
								</select>
							</div>
							</div>
						</div>
					</div>
					<div class="tab-pane" id="contacto">
						<div class="control-group <?php get_error('descripcion'); ?>">
						<label for="input06" class="control-label">Descripcion</label>
						<div class="controls">
							<textarea  name="descripcion" type="text" id="ckeditor" class="input-xlarge"><?php if( set_value('descripcion') == "" ){echo $usr->descripcion;}else{echo set_value('descripcion');} ?></textarea>
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
							<textarea  name="hobies" type="text" id="ckeditor1" class="input-xlarge"><?php if( set_value('hobies') == "" ){echo $usr->hobies;}else{echo set_value('hobies');} ?></textarea>
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
						    <ul class="thumbnails">
							    <li class="span4">
								    <a href="#" class="thumbnail">
								    	<?php if ($usr->imagen){ ?>
											<img id="imagen" src="<?php echo base_url('assets/media/usuarios/'.$usr->imagen); ?>" width="300px">
										<?php }else{ ?>
											<img src="<?php echo base_url('assets/admin/img/ico/retina/man_64.png'); ?>" width="300px">
										<?php } ?>
								    </a>
							    </li>
							</ul>
						<!-- <a id="add_file" href="#">Agregar otra imagen</a> -->
						<div id="imagen">
							<input name="imagen" type="file" id="imagen"/>
						</div>
						</div>
						<input name="imagen_anterior" type="hidden" value="<?=$usr->imagen?>">
						<!-- Inputs escondidos para guardar contraseña -->
						<input type="hidden" value="<?=$usr->pass?>" name="pass">
						<input type="hidden" value="<?=$usr->pass?>" name="re_pass">
					</div>
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
			$("#edita_pass").hide();
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
					self.val(user);
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

			$(function(){

				$('#btnEditarPass').click(function(e) {
					e.preventDefault();
					$('#edita_pass').toggle('slow', function() {
					 	$(".clsPass").val('');
					 	$("#pass").focus();
					});
				});

			}); 



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
