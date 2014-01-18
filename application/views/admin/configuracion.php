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
					</div>
					<div>
						<ul class="nav nav-tabs" id="myTab">
						  <li class="active"><a href="#general">General</a></li>
						  <li><a href="#contacto">Contacto</a></li>
						  <li><a href="#contenido">Contenido</a></li>
						  <li><a href="#social">Social</a></li>
						</ul>
						<div class="alert alert-tabs">
							<div class="tab-content">
							  <div class="tab-pane active" id="general">
							  	<div class="row">
								  	<div class="span4">
									  	<label for="titulo"><h5>
											Título de la página
										</h5></label>
										<input type="text" name="titulo" value="<?=$titulo?>" />
								  	</div>
								  	<div class="span4">
										<label for="Logo"><h5>
											Logotipo
										</h5></label>
										<input type="hidden" name="nuevo_logo" value="0" id="nuevo_logo">
										<?php $logotipo = "assets/img/" . $logo; ?>
										<div>
											<img src="<?php echo base_url($logotipo); ?>" alt="<?php $titulo ?>" width="120" />
										</div>
										<input type="file" name="logo" value="<?=$logo?>" id="logo" />
								  	</div>
								  	<div class="span4">
										<label><h5>
											Proporciones de logotipo
										</h5></label>
										Ancho: <input type="text" pattern="[0-9]{0,5}" title="Solo se permiten números" name="logo_ancho" class="span1 proporcion" value="<?=$logo_ancho?>" id="logo_ancho" />
										Alto: <input type="text" pattern="[0-9]{0,5}" title="Solo se permiten números" name="logo_alto" class="span1 proporcion" value="<?=$logo_alto?>" id="logo_alto" />
										Proporcional: <input type="checkbox" name="logo_proporcional" id="logo_proporcional" />
								  	</div>
							  	</div>
							  </div>
							  <div class="tab-pane" id="contacto">
							  	<div class="row">
							  		<div class="span3">
							  			<label for="nombre_admin"><h5>
											Nombre del administrador
										</h5></label>
										<input type="text" name="nombre_admin" value="<?=$nombre_admin?>" />
									  	<label for="email"><h5>
											Email administrador
										</h5></label>
										<input type="email" name="email" value="<?=$correo_admin?>" required />
										<label><h5>Emails extra</h5><small>separados con coma (,)</small></label>
										<textarea name="emails_extra" placeholder="emails separados por coma"><?=$emails_extra?></textarea>
										<label><h5>Mostrar mapa</h5></label>
										<select name="map_u" id="map_u">
											<?php $seleccion = ''; $seleccion1 = '';
										  	if ($mostrarmapa == 1) {
										  		$seleccion = 'selected';
										  	}else{
										  		$seleleccion1 = 'selected';
										  	}
										  	?>
											<option value="0" <?=$seleccion1?>>No</option>
											<option value="1" <?=$seleccion?>>Si</option>
										</select>
										<label><h5>Mostrar información de contacto</h5></label>
										<select name="info_c" id="info_c">
											<?php $sel_info = ''; $sel_info1 = '';
										  	if ($infocontacto == 1) {
										  		$sel_info = 'selected';
										  	}else{
										  		$sel_info1 = 'selected';
										  	}
										  	?>
											<option value="0" <?=$sel_info1?>>No</option>
											<option value="1" <?=$sel_info?>>Si</option>
										</select>	
									</div>
									<div class="span3">
										<label><h5>Direccion</h5></label>
										<textarea type="text" name="direccion" id="direccion" placeholder="Calle, número, colonia, ciudad, estado" rows="4"><?=$direccion?></textarea>
									  	<input type="text" name="mapa_g" id="mapa_g" style="display:none" value="<?=$mapa_g?>">
									  	<img src=".base_url('assets/img/icon-mapa.png')." id='google_img' style="display:none;" width='50px' />
										<label><h5>
											Teléfono
										</h5></label>
										<input type="text" name="telefono" value="<?=$telefono?>" />	
									</div>
									<div class="span6">
										Arrastre el marcador para una posición más exacta*
								  		<div id='map_canvas' style='height:300px;'></div>
								  	</div>
							  	</div>
							  	<div class="row-fluid">
							  			<hr>
							  			<h3>Información de contacto<small><i> (ésta información aparecerá en la sección de contacto)</i></small></h3><br>
							  			<div class="span3">
								  			<label><h5>Encabezado</h5></label>
											<input type="text" name="encabezado" value="<?=$encabezado?>">
							  			</div>
							  			<div class="span8">
										<label><h5>Descripción</h5></label>
										<textarea name="info_descripcion" id="ckeditor"><?=$info_descripcion?></textarea>
										<?php $ck_config = array(     
											"replace" => "#ckeditor"   
											, "options" => ck_options()     
											);
											echo jquery_ckeditor($ck_config); ?>
							  			</div>
							  		
							  	</div>
							  </div>
							  <div class="tab-pane" id="contenido">
							  	<div class="row">
								  	<div class="span4">
									  	<label for="template"><h5>
											Template predeterminado
										</h5></label>
										<select name="template" id="template">
											<option value="1" selected>Plantilla Default</option>
											<option value="2">Plantilla BLog</option>
											<option value="3">Plantilla Página</option>
											<option value="4">Plantilla Portafolio</option>
										</select>
										<label for="num_articulos"><h5>
											Número de artículos
										</h5></label>
										<input type="number" name="num_articulos" value="<?=$num_articulos?>" />
									</div>
									<div class="span4">
										<label for="num_recientes"><h5>
											Número de artículos recientes
										</h5></label>
										<input type="number" name="num_recientes" value="<?=$num_recientes?>" />
										<label for="categoria"><h5>
											Categorías
										</h5></label>
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
								  	<label for="twitter"><h5>
										Twitter
									</h5></label>
									<input type="text" name="twitter" value="<?=$twitter?>" />
									<label for="facebook"><h5>
										Facebook
									</h5></label>
									<input type="text" name="facebook" value="<?=$facebook?>" />
							  	</div>
							  	<div class="span4">
									<label for="youtube"><h5>
										Youtube
									</h5></label>
									<input type="text" name="youtube" value="<?=$youtube?>" />
									<label for="google"><h5>
										G+
									</h5></label>
									<input type="text" name="google" value="<?=$google?>" />
							  	</div>
							  	<div class="span3">
								<label for="linked"><h5>
									LinkedIn
								</h5></label>
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
				var plantilla = "<?php echo $plantilla ?>";
				var logo_ancho = $("#logo_ancho").val();
				if(plantilla){
					$("#template option[value=" + plantilla + "]").attr("selected","selected");
				}
				var categorias = "<?php echo $categorias ?>";

				if(categorias){
					categorias_ar = categorias.split("|");
					for(var i=0; i<categorias_ar.length; i++ )	{
						$("#categorias option[value="+categorias_ar[i]+"]").attr("selected","selected");
					}
				}
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
			var mensaje_titulo = "<h5>" + titulo + "</h5>";
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
		/*$("#direccion").on("click",loadScript);*/
        /*$("#google_img").on("click",loadScript);*/
        $("#direccion").on("change",codeAddress);
// FIN GOOGLE MAPS
		


</script>

	</body>