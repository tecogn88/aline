<?php

class Model_configuracion extends CI_Model {

	private $tabla = "configuracion";

    function __construct()
    {
        parent::__construct();
        $this->load->library('Configuration');
    }
		
    function dame_configuracion(){
    	$this->db->select("*");
    	$configuracion = $this->db->get($this->tabla);
    	if($configuracion->num_rows() < 1){
    		return false;
    	}
    	return $configuracion;
    }

    function dame_config_catalogo(){
        $this->db->select("*");
        $configuracion_catalogo = $this->db->get('config_catalogo');
        if ($configuracion_catalogo->num_rows() < 1) {
            return false;
        }
        return $configuracion_catalogo;
    }

    function dame_config_contacto(){
        $this->db->select("*");
        $configuracion_contacto = $this->db->get('config_contacto');
        if ($configuracion_contacto->num_rows() < 1) {
            return false;
        }
        return $configuracion_contacto;
    }

    function dame_config_contenido(){
        $this->db->select("*");
        $configuracion_contenido = $this->db->get('config_contenido');
        if ($configuracion_contenido->num_rows() < 1) {
            return false;
        }
        return $configuracion_contenido;
    }

    function dame_config_social(){
        $this->db->select("*");
        $configuracion_social = $this->db->get('config_social');
        if ($configuracion_social->num_rows() < 1) {
            return false;
        }
        return $configuracion_social;
    }

    function dame_config_slider(){
        $this->db->select("*");
        $configuracion_slider = $this->db->get('config_slider');
        if ($configuracion_slider->num_rows() < 1) {
            return false;
        }
        return $configuracion_slider;
    }

    function agregar_configuracion(){
        $cats = $this->input->post('categorias', true);
        $categorias = "";
        for ($i=0; $i < count($cats); $i++) { 
            if($i+1 == count($cats)){
                $categorias .= $cats[$i];
            }else{
                $categorias .= $cats[$i] . "|";    
            }
        }
    	$data = array(
    		'titulo' => $this->input->post('titulo', true),
    		'logo' => $this->input->post('logo', true),
    	);
    	$this->db->insert($this->tabla, $data);

    }

    function agregar_config_catalogo(){
        $data = array(
            'marca_agua' => $this->input->post('agua', true),
            'marca' => $this->input->post('marca',true),
            'hozontal' => $this->input->post('horizontal', true),
            'vertical' => $this->input->post('vertical', true),
            'transparencia' => $this->input->post('transparencia', true),
            'no_destacados' => $this->input->post('num_prod_destacados', true),
            );
        $this->db->insert('config_catalogo', $data);
    }

    function agregar_config_contacto(){
        $data = array(
            'correo_admin' => $this->input->post('email', true),
            'nombre_admin' => $this->input->post('nombre_admin', true),
            'emails_extra' => $this->input->post('emails_extra', true),
            'direccion' => $this->input->post('direccion', true),
            'mapa_g' => $this->input->post('mapa_g', true),
            'mostrar_mapa' => $this->input->post('map_u', true),
            'mostrar_info' => $this->input->post('info_c', true),
            'encabezado' => $this->input->post('encabezado', true),
            'info_descripcion' => $this->input->post('info_descripcion', true),
            'telefono' => $this->input->post('telefono', true),
            );
        $this->db->insert('config_contacto', $data);
    }

    function agregar_config_contenido(){
        $data = array(
            'plantilla' => $this->input->post('template', true),
            'no_articulos' => (int)$this->input->post('num_articulos', true),
            'no_recientes' => (int)$this->input->post('num_recientes', true),
            'categorias' => $categorias
            );
        $this->db->insert('config_contenido', $data);
    }

    function agregar_config_social(){
        $data = array(
            'twitter' => $this->input->post('twitter', true),
            'facebook' => $this->input->post('facebook', true),
            'google' => $this->input->post('google', true),
            'youtube' => $this->input->post('youtube', true),
            'linked' => $this->input->post('linked', true),
            );
        $this->db->insert('config_social', $data);
    }

    function agregar_config_slider(){
        $data = array(
            'slider_ancho' => $this->input->post('slider_ancho', true),
            'slider_alto' => $this->input->post('slider_alto', true),
            'auto' => $this->input->post('auto', true),
            'infinito' => $this->input->post('infinito', true),
            'velocidad' => $this->input->post('velocidad', true),
            'slide_i' => $this->input->post('slide_i', true),
            'aleatorio' => $this->input->post('aleatorio', true),
            'controles' => $this->input->post('controles', true),
            );
        $this->db->insert('config_slider', $data);
    }

    function editar_configuracion($logo,$imagen){
        $ancho = $imagen['ancho'];
        $alto = $imagen['alto'];
        $cats = $this->input->post('categorias');
        $categorias = "";
        for ($i=0; $i < count($cats); $i++) {
            if($i+1 == count($cats)){
                $categorias .= $cats[$i];
            }else{
                $categorias .= $cats[$i] . "|"; 
            }
        }
    	$data = array(
    		'titulo' => $this->input->post('titulo', true),
    		'logo' => $logo,
            'logo_ancho' => $ancho,
            'logo_alto' => $alto,
    	);
    	$this->db->update($this->tabla,$data);
        if ($this->db->affected_rows() > 0) {
    	   return true;
        }else{
            return false;
        }
    }

    function editar_config_catalogo(){
        $data = array(
            'marca_agua' => $this->input->post('agua', true),
            'horizontal' => $this->input->post('horizontal', true),
            'vertical' => $this->input->post('vertical', true),
            'transparencia' => $this->input->post('transparencia', true),
            'no_destacados' => $this->input->post('num_prod_destacados', true),
            );
        $this->db->update('config_catalogo',$data);
        return true;
    }

    public function actualiza_img_marca($id=1,$marca=false){
        $data = array();
        if($marca != false){
            $data["marca"] = $marca;
        }
        $this->db->where("id", $id);
        $this->db->update("config_catalogo", $data);
        return true;
    }

    function editar_config_contacto(){
        $data = array(
            'correo_admin' => $this->input->post('email', true),
            'nombre_admin' => $this->input->post('nombre_admin', true),
            'emails_extra' => $this->input->post('emails_extra', true),
            'direccion' => $this->input->post('direccion', true),
            'mapa_g' => $this->input->post('mapa_g', true),
            'mostrar_info' => $this->input->post('info_c', true),
            'encabezado' => $this->input->post('encabezado', true),
            'info_descripcion' => $this->input->post('info_descripcion', true),
            'mostrar_mapa' => $this->input->post('map_u', true),
            'telefono' => $this->input->post('telefono', true),
            );
        $this->db->update('config_contacto',$data);
        if ($this->db->affected_rows() > 0) {
           return true;
        }else{
            return false;
        }
    }

    function editar_config_contenido(){
        $data = array(
            'plantilla' => $this->input->post('template', true),
            'no_articulos' => (int)$this->input->post('num_articulos', true),
            'no_recientes' => (int)$this->input->post('num_recientes', true),
            'categorias' => $categorias,
            );
        $this->db->update('config_contenido',$data);
        if ($this->db->affected_rows() > 0) {
           return true;
        }else{
            return false;
        }
    }

    function editar_config_social(){
        $data = array(
            'twitter' => $this->input->post('twitter', true),
            'facebook' => $this->input->post('facebook', true),
            'google' => $this->input->post('google', true),
            'youtube' => $this->input->post('youtube', true),
            'linked' => $this->input->post('linked', true),
            );
        if ($this->db->affected_rows() > 0) {
           return true;
        }else{
            return false;
        }
    }

    function editar_config_slider(){
        $data = array(
            'slider_ancho' => $this->input->post('slider_ancho', true),
            'slider_alto' => $this->input->post('slider_alto', true),
            'auto' => $this->input->post('auto', true),
            'infinito' => $this->input->post('infinito', true),
            'slide_i' => $this->input->post('slide_i', true),
            'aleatorio' => $this->input->post('aleatorio', true),
            'controles' => $this->input->post('controles', true),
            'velocidad' => $this->input->post('velocidad', true),
            );
        $this->db->update('config_slider',$data);
        return true;
    }

    function dame_categorias(){
        $this->db->select("*");
        $categorias = $this->db->get("categoria");
        return $categorias;
    }

    function dameTotalSlides(){
        $slides = $this->db->count_all('slider');
        return $slides;
    }

}

/* End of file Model_usuarios.php */
/* Location: ./application/models/Model_usuarios.php */