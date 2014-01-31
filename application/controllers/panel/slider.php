<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Slider extends CI_Controller{

	public function __construct(){
		parent::__construct();
		if(!$this->alinecms->is_LoggedAdmin()){
			redirect('/' , 'location');
		}
		$this->load->model("model_slider", "slider");
		$this->load->model('model_configuracion', 'configuracion');
		$this->load->library('Configuration');
	}

	public function index(){
		$data = $this->dameModulosEstaticos();
		$data['slides'] = $this->slider->dameSlides();
		$this->load->view('admin/slider/index',$data);
	}

	public function dameModulosEstaticos(){
		$data = array(
			"columna_izq" => $this->load->view('admin/slider/columna-izq','',true),
			"head" => $this->alinecms->get_head('Panel de Slider' , TRUE),
			"header" => $data['header'] = $this->alinecms->get_header('_8')
		);
		return $data;
	}

	public function nuevoSlide(){
		$this->load->library('form_validation');
		$this->load->helper('form');
		$data = $this->dameModulosEstaticos();
		$this->form_validation->set_rules("nombre","Nombre","required");
		$this->form_validation->set_rules("link","Link","prep_url");
		if($this->form_validation->run() == FALSE){
			$this->load->view('admin/slider/nuevo-slide',$data);
		}else{
			$datos_slide = array(
				"nombre" => $this->input->post('nombre', true),
				"imagen" => $this->do_upload(),
				"link" => $this->input->post('link'),
				"t_link" => $this->input->post('t_link'),
				"descripcion" => $this->input->post('descripcion')
			);
			$this->slider->agregaSlide($datos_slide);
			redirect('panel/slider','location');
		}
	}

	public function editaSlide($id=0){
        $slide = $this->slider->dameSlide($id);
        $this->load->library('form_validation');
        if(!$slide){
            redirect('panel/slider','location');
        }else{
        	$this->load->library('form_validation');
			$this->load->helper('form');
			$this->form_validation->set_rules("nombre","Nombre","required");
			$this->form_validation->set_rules("link","Link","prep_url");
        	$data = $this->dameModulosEstaticos();
        	$data['slide'] = $slide;
        	if ($this->form_validation->run()==false) {
        		$this->load->view('admin/slider/editar-slide',$data);
        	}else{
        		$datos = array(
        			"nombre" => $this->input->post('nombre'),
        			"link" => $this->input->post('link'),
        			"t_link" => $this->input->post('t_link'),
        			"descripcion" => $this->input->post('descripcion'),
        			"imagen" => $this->do_upload(true,$id)
        			);
        		$this->slider->actualizaSlide($id,$datos);
        		redirect('panel/slider', 'location');
        	}	
        }
    }

	public function eliminaSlide($id=0){
		$this->slider->eliminaSlide($id);
		redirect('panel/slider','location');
	}

	public function do_upload($edicion=false,$id=0){
		$config['upload_path'] = 'assets/img/slider/';
		$config['allowed_types'] = '*';
		$this->load->library('upload',$config);
		if(!$this->upload->do_upload('imagen')){
			
			$error = array('error' => $this->upload->display_errors());
			if ($edicion) {
				return $this->slider->dameImagenSlide($id);
			}else{
				die($error['error']);
			}

		}else{

			$imagen_info = $this->upload->data();
			return $imagen_info['file_name'];
		}

	}

	public function image_resize($ruta_imagen){
		$config['image_library'] = 'GD2';
		$config['source_image'] = $ruta_imagen;
		$config['create_thumb'] = FALSE;
		$config['maintain_ratio'] = TRUE;
		$config['width'] = 1170;
		$config['height'] = 350;
		$this->load->library('image_lib', $config);
		if(!$this->image_lib->resize()){
			die($this->image_lib->display_errors());
		}else{
			return true;
		}
	}

	public function configuracionSlider(){
		$data = $this->dameModulosEstaticos();
		$data['head'] = $this->alinecms->get_head('Panel de configuración', TRUE);
		$data['header'] = $this->alinecms->get_header("_8");
		$data['titulo_pagina'] = "Configuración del slider";
		$data['slider_ancho'] = $this->configuration->slider_ancho;
		$data['slider_alto'] = $this->configuration->slider_alto;
		$data['auto'] = $this->configuration->auto;
		$data['infinito'] = $this->configuration->infinito;
		$data['velocidad'] = $this->configuration->velocidad;
		$data['slide_i'] = $this->configuration->slide_i;
		$data['aleatorio'] = $this->configuration->aleatorio;
		$data['controles'] = $this->configuration->controles;
		$this->load->view('admin/slider/configuracion', $data);
	}

	public function GuardaConfiguracion(){
		$this->configuracion->editar_config_slider();
		redirect('panel/slider/','REFRESH');
	}

}
