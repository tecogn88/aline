<?=$head?>
<?php echo ck_includes(); ?>
	<body>
		<?=$header?>
		<div class="wrapper container-fluid">
			
				<form action="<?php echo base_url('panel/configuracion'); ?>" method="POST" enctype="multipart/form-data" accept-charset="utf-8">
					<div class="row-fluid">
						<div class="well" id="botones">
							<div class="span4">
								<h2><?=$titulo_pagina?></h2>
							</div>
							<a style="float:right;margin-left:10px;" class="btn btn-danger" href="<?php echo base_url('panel/escritorio/'); ?>">Terminar<span style='float:right;margin-left:10px;'><i class='icon-ban-circle icon-white'></i></span></a>
							<button style="margin-left:10px;float:right;" class="btn btn-primary" name="btnGuardar" onclick="submit">Guardar<span style='float:right;margin-left:10px;'><i class='icon-ok-sign icon-white'></i></span></button>
						</div>
						<?php echo $this->session->flashdata('warning'); ?>
					</div>
					<div>
						<ul class="nav nav-tabs" id="myTab">
						  <li class="active"><a href="#general"><h4>General</h4></a></li>
						  <li><a href="#informacion" id="info_tab"><h4>Información</h4></a></li>
						  <li><a href="#contacto"><h4>Contacto</h4></a></li>
						  <li><a href="#contenido"><h4>Contenido</h4></a></li>
						  <li><a href="#social"><h4>Redes sociales</h4></a></li>
						</ul>
						<div class="alert alert-tabs">
							<div class="tab-content">
							  <div class="tab-pane active" id="general">
							  	<div class="row">
								  	<div class="span4">
									  	<label for="titulo"><h4>Nombre del sitio</h4></label>
										<input type="text" name="titulo" value="<?=$titulo?>" />
								  	</div>
								  	<div class="span4">
										<label for="Logo"><h4>Logotipo</h4></label>
										<input type="hidden" name="nuevo_logo" value="0" id="nuevo_logo">
										<?php $logotipo = "assets/img/" . $logo; ?>
										<div>
											<img src="<?php echo base_url($logotipo); ?>" alt="<?php $titulo ?>" width="120" />
										</div>
										<input type="file" name="logo" value="<?=$logo?>" id="logo" />
								  	</div>
								  	<div class="span4">
										<label><h4>Proporciones de logotipo</h4></label>
										Ancho: <input type="text" pattern="[0-9]{0,5}" title="Solo se permiten números" name="logo_ancho" class="span1 proporcion" value="<?=$logo_ancho?>" id="logo_ancho" />
										Alto: <input type="text" pattern="[0-9]{0,5}" title="Solo se permiten números" name="logo_alto" class="span1 proporcion" value="<?=$logo_alto?>" id="logo_alto" />
										Proporcional: <input type="checkbox" name="logo_proporcional" id="logo_proporcional" />
								  	</div>
							  	</div>
							  </div>
							  <div class="tab-pane" id="contacto">
							  	<div class="row-fluid">
							  		<div class="span4">
							  			<label for="nombre_admin"><h4>Nombre del administrador</h4></label>
										<input type="text" name="nombre_admin" value="<?=$nombre_admin?>" />
									</div>
									<div class="span4">	
									  	<label for="email"><h4>Email principal</h4></label>
										<input type="email" name="email" value="<?=$correo_admin?>" required />
									</div>
									<div class="span4">
										<label><h4>Emails extra</h4><small>separados con coma (,)</small></label>
										<textarea name="emails_extra" placeholder="emails separados por coma" rows="4" cols="10"><?=$emails_extra?></textarea>
								  	</div>
							  	</div>
							  </div>
							  <div class="tab-pane" id="informacion">
							  	<div class="row-fluid">
									<div class="span3">
										<label><h4>Ubicación</h4></label>
										<textarea type="text" name="direccion" id="direccion" placeholder="Calle, número, colonia, ciudad, estado" rows="4"><?=$direccion?></textarea>
									  	<input type="text" name="mapa_g" id="mapa_g" style="display:none" value="<?=$mapa_g?>">
									  	<img src=".base_url('assets/img/icon-mapa.png')." id='google_img' style="display:none;" width='50px' />
										<label><h4>Teléfono</h4></label>
										<input type="text" name="telefono" value="<?=$telefono?>" />	
									</div>
									<div class="span3">
										<label><h4>Mostrar mapa</h4></label>
										<div class="btn-group" data-toggle="buttons-radio">
											<?php $checado = ''; $checado1 = ''; if ($mostrarmapa == 1) {$checado1 = 'active';}else{$checado = 'active';} ?>
										  <button id='map_si' type="button" value='1' class="btn btn-inverse <?php echo $checado1 ?>"><i id='icon_si' class="icon-ok icon-white"></i></button>
										  <button id='map_no' type="button" value="0" class="btn btn-inverse <?php echo $checado ?>"><i id='icon_no' class="icon-remove icon-white"></i></button>
										</div>
										<div id="map_container" style="display:none;">
											Mueva el marcador para una posición más exacta*
								  			<div id='map_canvas' style='height:250px;'></div>
											<input name="map_u" id="map_u" type="hidden" value="<?php echo $mostrarmapa ?>">
										</div>
								  	</div>
								  	<div class="span6">
										<label><h4>Mostrar información adicional<small><i> (Se mostrará en la sección de contacto)</i></small></h4></label>
										<div class="btn-group" data-toggle="buttons-radio">
											<?php $checado_contacto = ''; $checado_contacto1 = ''; if ($infocontacto == 1) {$checado_contacto1 = 'active';}else{$checado_contacto = 'active';} ?>
										  <button id='contacto_si' type="button" value='1' class="btn btn-inverse <?php echo $checado_contacto1 ?>"><i id='icon_contacto_si' class="icon-ok icon-white"></i></button>
										  <button id='contacto_no' type="button" value="0" class="btn btn-inverse <?php echo $checado_contacto ?>"><i id='icon_contacto_no' class="icon-remove icon-white"></i></button>
										</div>
										<input name="info_c" id="info_c" type="hidden" value="<?php echo $infocontacto ?>">	
									  	<div class="row-fluid" id="adicional" style="display:none;">
									  		<label><h4>Encabezado</h4></label>
											<input type="text" name="encabezado" value="<?=$encabezado?>">
											<label><h4>Información</h4></label>
											<textarea name="info_descripcion" id="ckeditor"><?=$info_descripcion?></textarea>
											<?php $ck_config = array( "replace" => "#ckeditor", "options_configuracion" => ck_options()); echo jquery_ckeditor($ck_config); ?>
									  	</div>
								  	</div>
							  	</div>
							  </div>
							  <div class="tab-pane" id="contenido">
							  	<div class="row">
								  	<div class="span4">
									  	<label for="template"><h4>Template predeterminado</h4></label>
										<select name="template" id="template">
											<option value="1" selected>Plantilla Default</option>
											<option value="2">Plantilla BLog</option>
											<option value="3">Plantilla Página</option>
											<option value="4">Plantilla Portafolio</option>
										</select>
										<label for="num_articulos"><h4>Número de artículos</h4></label>
										<input type="number" name="num_articulos" value="<?=$num_articulos?>" />
									</div>
									<div class="span4">
										<label for="num_recientes"><h4>Número de artículos recientes</h4></label>
										<input type="number" name="num_recientes" value="<?=$num_recientes?>" />
										<label for="categoria"><h4>Categorías</h4></label>
										<select name="categorias[]" id="categorias" multiple>
											<option value="--">Todas</option>
											<?php foreach($categorias_select->result() as $categoria){ ?>
												<option value="<?=$categoria->id?>"><?=$categoria->nombre?></option>
											<?php } ?>
										</select>
									</div>
								</div>
							  </div>
							  <div class="tab-pane" id="social">
							  	<div class="span4">
								  	<label for="twitter"><h4>Twitter</h4></label>
									<input type="text" name="twitter" value="<?=$twitter?>" />
									<label for="facebook"><h4>Facebook</h4></label>
									<input type="text" name="facebook" value="<?=$facebook?>" />
							  	</div>
							  	<div class="span4">
									<label for="youtube"><h4>Youtube</h4></label>
									<input type="text" name="youtube" value="<?=$youtube?>" />
									<label for="google"><h4>G+</h4></label>
									<input type="text" name="google" value="<?=$google?>" />
							  	</div>
							  	<div class="span3">
									<label for="linked"><h4>LinkedIn</h4></label>
									<input type="text" name="linked" value="<?=$linked?>" />
							  	</div>
							  </div>
							  </div>
							</div>
						</div>	
					</div>
				</form>
		</div>
		
		<script type="text/javascript">
			$("#map_si").on("click",function(){
				$("#map_u").val("1");
				$('#map_container').slideDown('slow');
				$('#icon_no').removeClass('icon-white');
				$('#icon_si').addClass('icon-white');
			});
			$("#map_no").on("click",function(){
				$("#map_u").val("0");
				$('#map_container').slideUp('slow');
				$('#icon_si').removeClass('icon-white');
				$('#icon_no').addClass('icon-white');
			});

			$("#contacto_si").on("click",function(){
				$("#info_c").val("1");
				$('#adicional').slideDown('slow');
				$('#icon_contacto_no').removeClass('icon-white');
				$('#icon_contacto_si').addClass('icon-white');
			});
			$("#contacto_no").on("click",function(){
				$("#info_c").val("0");
				$('#adicional').slideUp('slow');
				$('#icon_contacto_si').removeClass('icon-white');
				$('#icon_contacto_no').addClass('icon-white');
			});

			function display_contacto(informacion){
				if (informacion == 1) {
					$('#modal_informacion').show();
				}else{
					$('#modal_informacion').hide();
				}
				return true;
			}

			$(function(){
				$('#info_c').on('change', function(){
					display_contacto($(this).val());
				});
			});

			$(document).on("ready",function(){
				$( "#cambio" ).delay(3500).slideUp('slow');

				if($('#map_u').val() == 1){
					$('#map_container').show();
					$('#icon_no').removeClass('icon-white');
				}else{
					$('#icon_si').removeClass('icon-white');
				}

				if($('#info_c').val() == 1){
					$('#adicional').show();
					$('#icon_contacto_no').removeClass('icon-white');
				}else{
					$('#icon_contacto_si').removeClass('icon-white');
				}

				var plantilla = "<?php echo $plantilla ?>";
				var logo_ancho = $("#logo_ancho").val();
				if(plantilla){
					$("#template option[value=" + plantilla + "]").attr("selected","selected");
				}
				/*var categorias = "<?php echo $categorias ?>";

				if(categorias){
					categorias_ar = categorias.split("|");
					for(var i=0; i<categorias_ar.length; i++ )	{
						$("#categorias option[value="+categorias_ar[i]+"]").attr("selected","selected");
					}
				}*/
				/* display boton información */

				var informacion = $('#info_c').val();
				display_contacto(informacion);
			});
			$("#logo").on("change",function(){
				$("#nuevo_logo").val("1");
				$(".proporcion").val("");
			});

			$("#marca").on("change",function(){
				$("#marca_agua").val("1");
			});

			$("#logo_proporcional").on("change",function(){
				if($(this).is(":checked")){
					$(this).val("1");
					$("#logo_alto").attr("disabled","disabled").val("");
				}else{
					$(this).val("0");
					$("#logo_alto").removeAttr("disabled");
				}
			});
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

		<script type="text/javascript">
// GOOGLE MAPS
		var map;
		var marker;
		var infowindow;
		var geocoder;
        function initialize() {
        	geocoder = new google.maps.Geocoder();
        	var mensaje_titulo = $("input[name='titulo']").val();
        	infowindow = new google.maps.InfoWindow({
        		content: mensaje_titulo,
        		maxwidth: 200
        	});
        	var location = new google.maps.LatLng(31.71531745480608, -106.44790661914061);
			var mapOptions = {
				zoom: 15,
				center: new google.maps.LatLng(31.71531745480608, -106.44790661914061),
				mapTypeId: google.maps.MapTypeId.ROADMAP
			}
			map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
			marker = new google.maps.Marker({
				draggable: true,
				animation: google.maps.Animation.DROP,
				position: location,
				map: map,
				title: mensaje_titulo
			});
			google.maps.event.addListener(marker, 'click', toggleBounce);
			google.maps.event.addListener(marker, 'dragend', sacarPosicion);
			google.maps.event.addListener(marker, 'mouseover', muestraVentana);
			google.maps.event.addListener(marker, 'mouseout', cierraVentana);
			map.setCenter(location);
			if($("#direccion").val() != ''){
				codeAddress();
			}
        }
        function loadScript() {
        	$("#map_canvas").show();
			var script = document.createElement("script");
			script.type = "text/javascript";
			script.src = "http://maps.googleapis.com/maps/api/js?key=AIzaSyAU9f_Gm9I3OnDv6dhQ118KyMuNLKTUS8U&sensor=false&callback=initialize";
			document.body.appendChild(script);
        }
		function toggleBounce() {
			if (marker.getAnimation() != null) {
			  marker.setAnimation(null);
			} else {
			  marker.setAnimation(google.maps.Animation.BOUNCE);
			}			
		}
		function sacarPosicion(){
			$("#mapa_g").val(marker.getPosition());
			map.panTo(marker.getPosition());
		}
		function muestraVentana(){
			var titulo = $("input[name='titulo']").val();
			var mensaje_titulo = "<h4>" + titulo + "</h4>";
			var direccion = $("input[name='direccion']").val();
			var mensaje_direc = "<p>" + direccion + "</p>"
			var mensaje_completo = "<div='mensaje_mapa'>" + mensaje_titulo + mensaje_direc + "</div>";
			infowindow.content = mensaje_completo;
			infowindow.open(map,marker);
		}
		function cierraVentana(){
			infowindow.close();
		}
		function codeAddress(){
			var address = $("#direccion").val();
			geocoder.geocode({'address':address}, function(results, status){
				if(status == google.maps.GeocoderStatus.OK){
					map.setCenter(results[0].geometry.location);
					marker.setPosition(results[0].geometry.location);
					actualizaCampos(results[0].geometry.location);
				}
			});
		}
		function actualizaCampos(latLng){
			var lat = latLng.lat();
			var lng = latLng.lng();
			$("#mapa_g").val("("+lat+","+lng+")");
		}
		$(document).ready(function() {
		  loadScript();
		});
		$("#direccion").on("click",loadScript);
		$("#direccion").on("keypress",loadScript);
		$("#info_tab").on("click",loadScript);
		$('#map_si').on('click',loadScript);
        /*$("#google_img").on("click",loadScript);*/
        $("#direccion").on("change",codeAddress);
// FIN GOOGLE MAPS
</script>
</body>