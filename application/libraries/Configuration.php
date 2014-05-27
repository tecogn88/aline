<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Configuration{
	public $titulo = '';
	public $logo = '';
	public $correo_admin = '';
	public $emails_extra = '';
	public $nombre_admin = '';
	public $direccion = '';
	public $mapa_g ='';
	public $mostrarmapa ='';
	public $infocontacto ='';
	public $buscador = '';
	public $encabezado ='';
	public $info_descripcion ='';
	public $telefono ='';
	public $plantilla = 1;
	public $agua = 0;
	public $horizontal = 1;
	public $vertical = 1;
	public $transparencia = 0;
	public $twitter = '';
	public $facebook = '';
	public $google = '';
	public $youtube = '';
	public $linked = '';
	public $g_analytics = '';
	public $m_descripcion = '';
	public $no_articulos = 0;
	public $no_destacados = 0;
	public $marca = '';
	public $categorias = '';
	public $logo_ancho = 0;
	public $logo_alto = 0;
	public $slider_ancho = 0;
	public $slider_alto = 0;
	public $logo_ancho_original = 0;
	public $logo_alto_original = 0;
	public $slider_ancho_original = 0;
	public $slider_alto_original = 0;
	public $auto = 1;
	public $infinito = 1;
	public $breadcrumbs = '';
	public $paginacion = '';
	public $velocidad = 0;
	public $slide_i = 1;
	public $aleatorio = 0;
	public $controles = 1;
	public $m_titulo_blog = '';
	public $m_descripcion_blog = '';
	public $configuracion = false;
	protected $ci;

	function __construct(){
		$this->ci =& get_instance();
		$this->ci->load->model('model_configuracion','conf');
		$this->ci->load->model('model_configuracion','conf_catalogo');
		$this->ci->load->model('model_configuracion','conf_contacto');
		$this->ci->load->model('model_configuracion','conf_contenido');
		$this->ci->load->model('model_configuracion','conf_social');
		$this->ci->load->model('model_configuracion','conf_slider');
		$configuracion = $this->ci->conf->dame_configuracion();
		$configuracion_catalogo = $this->ci->conf_catalogo->dame_config_catalogo();
		$configuracion_contacto = $this->ci->conf_contacto->dame_config_contacto();
		$configuracion_contenido = $this->ci->conf_contenido->dame_config_contenido();
		$configuracion_social = $this->ci->conf_social->dame_config_social();
		$configuracion_slider = $this->ci->conf_slider->dame_config_slider();
		if($configuracion->num_rows() > 0){
			$this->titulo = $configuracion->row('titulo');
			$this->logo = $configuracion->row('logo');
			$this->logo_ancho = $configuracion->row('logo_ancho');
			$this->logo_alto = $configuracion->row('logo_alto');
			$this->g_analytics = $configuracion->row('g_analytics');
			$this->m_descripcion = $configuracion->row('m_descripcion');
			$this->configuracion = true;

			// Calcular ancho y alto del logotipo original
			$ruta_imagen = base_url('assets/img');
			$ruta_imagen .= "/" . $this->logo;
			$imagen = getimagesize($ruta_imagen);
			$this->logo_ancho_original = $imagen[0];
			$this->logo_alto_original = $imagen[1];


			if(($this->logo_ancho == 0) && ($this->logo_alto == 0)){
				$this->logo_ancho = $this->logo_ancho_original;
				$this->logo_alto = $this->logo_alto_original;
			}
		}

		if ($configuracion_catalogo->num_rows() > 0) {
			$this->agua = $configuracion_catalogo->row('marca_agua');
			$this->marca = $configuracion_catalogo->row('marca');
			$this->horizontal = $configuracion_catalogo->row('horizontal');
			$this->vertical = $configuracion_catalogo->row('vertical');
			$this->transparencia = $configuracion_catalogo->row('transparencia');
			$this->no_destacados = $configuracion_catalogo->row('no_destacados');
		}

		if ($configuracion_contacto->num_rows() > 0) {
			$this->correo_admin = $configuracion_contacto->row('correo_admin');
			$this->emails_extra = $configuracion_contacto->row('emails_extra');
			$this->nombre_admin = $configuracion_contacto->row('nombre_admin');
			$this->direccion = $configuracion_contacto->row('direccion');
			$this->mapa_g = $configuracion_contacto->row('mapa_g');
			$this->mostrarmapa = $configuracion_contacto->row('mostrar_mapa');
			$this->infocontacto = $configuracion_contacto->row('mostrar_info');
			$this->encabezado = $configuracion_contacto->row('encabezado');
			$this->info_descripcion = $configuracion_contacto->row('info_descripcion');
			$this->telefono = $configuracion_contacto->row('telefono');
			$this->buscador = $configuracion_contacto->row('mostrar_buscador');
		}

		if ($configuracion_contenido->num_rows() > 0) {
			$this->plantilla = $configuracion_contenido->row('plantilla');
			$this->no_articulos = $configuracion_contenido->row('no_articulos');
			$this->no_recientes = $configuracion_contenido->row('no_recientes');
			$this->categorias = $configuracion_contenido->row('categorias');
			$this->breadcrumbs = $configuracion_contenido->row('breadcrumbs');
			$this->m_titulo_blog = $configuracion_contenido->row('m_titulo');
			$this->m_descripcion_blog = $configuracion_contenido->row('m_descripcion');
			$this->paginacion = $configuracion_contenido->row('paginacion');
		}

		if ($configuracion_social->num_rows() > 0) {
			$this->twitter = $configuracion_social->row('twitter');
			$this->facebook = $configuracion_social->row('facebook');
			$this->google = $configuracion_social->row('google');
			$this->youtube = $configuracion_social->row('youtube');
			$this->linked = $configuracion_social->row('linked');
		}

		if ($configuracion_slider->num_rows() > 0) {
			$this->slider_ancho = $configuracion_slider->row('slider_ancho');
			$this->slider_alto = $configuracion_slider->row('slider_alto');
			$this->auto = $configuracion_slider->row('auto');
			$this->infinito = $configuracion_slider->row('infinito');
			$this->velocidad = $configuracion_slider->row('velocidad');
			$this->slide_i = $configuracion_slider->row('slide_i');
			$this->aleatorio = $configuracion_slider->row('aleatorio');
			$this->controles = $configuracion_slider->row('controles');
		}
	}

	public function medidas_imagenes($ruta_imagen=""){
		if ($ruta_imagen) {
			return getimagesize($ruta_imagen);
		}else{
			return false;
		}
	}

}
?>