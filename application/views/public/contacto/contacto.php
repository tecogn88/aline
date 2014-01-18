<?php $this->load->view('/public/helper/head.php'); ?>
	<?php $this->load->view('/public/helper/main_menu.php'); ?>
	<div class="container">
		<div class="row">
			<div class="span12">
				<div class="span12 titulos">
					<h2 class="principal"><span>Contacto</span></h2>
				</div>
				<div class="row-fluid">
					<div class="span9">
						<?php if ($infocontacto == 1){ ?>
						<h2 style="margin-top:0px;"><?php echo $encabezado; ?></h2>
						<p><?php echo $info_descripcion; ?></p>
						<p>
							<strong>
								<?php echo $titulo; ?>,	<?php echo $direccion; ?><br />Teléfono: <?php echo $telefono; ?>, contacto: <?php echo $correo_admin; ?>
							</strong>
						</p>
						<?php } ?>
						<?php if ($mostrarmapa == 1){ ?>
						<h2 style="margin-top:0px;">Ubicación</h2>
							<div id='map_canvas' style='height:350px;width:850px;'></div>
						<?php }?>
					</div>
					<div class="span3 bordertop">
						<h2>Contáctenos</h2>
						<?php echo form_open('contacto'); ?>
						    <fieldset>
						    <input type="text" placeholder="Nombre *" name="nombre">
						    <?php echo form_error('nombre'); ?>
						    <input type="text" placeholder="Correo electrónico *" name="email">
						    <?php echo form_error('email'); ?>
						    <input type="text" placeholder="Estado *" name="estado">
						    <?php echo form_error('estado'); ?>
						    <input type="text" placeholder="Localidad *" name="localidad">
						    <?php echo form_error('localidad'); ?>
						    <input type="text" placeholder="asunto" name="asunto">
						    <?php echo form_error('asunto'); ?>
						    <textarea placeholder="Mensaje" rows="5" name="mensaje"></textarea>
						    <?php echo form_error('mensaje'); ?>
						    <br>
						    <div class="row-fluid">
							    <div class="span">
						    		<?php echo $cap['image']; ?>	
						    	</div>
						    	
						    </div>
				    		<?php 
				    			$frm_captcha = array (
								    'name' => 'captcha',
								    'id' => 'frCaptcha',
								    'captcha' => 'required',
								    'size' => '20'
								);
				    		?>
				    		<div class="row-fluid">
				    			<div class="span12">
						    		<?php echo form_label('Introduzca el código', $frm_captcha['id']); ?>
						    		<?php echo form_input($frm_captcha); ?>
									<?php echo form_error($frm_captcha['name']); ?>
				    			</div>
				    		</div>
						    <hr>
						    <input type="submit" value="Enviar">
						   <!-- <a class="leermas" href="#">Enviar</a> -->
						    </fieldset>
			    		</form>
			        </div>
				</div>
			</div>
		</div>
	</div>
	<?php $this->load->view('public/helper/footer.php'); ?>

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
</html>
