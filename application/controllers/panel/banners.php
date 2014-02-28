<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Banners extends CI_Controller{

	public function __construct(){
		parent::__construct();
		if(!$this->alinecms->is_LoggedAdmin()){
			redirect('/' , 'location');
		}
		$this->load->model('model_banners', 'banners');
		$this->load->library('form_validation');
	}

	public function index(){
		$data['head'] = $this->alinecms->get_head('Panel de banners' , TRUE);
		$data['header'] = $this->alinecms->get_header('_banners');
		$data['banners'] = $this->banners->get_banners();
		$this->load->view('admin/banners/banners' , $data);
	}

	public function crea_banner(){
		$data['head'] = $this->alinecms->get_head('Panel de banners' , TRUE);
		$data['header'] = $this->alinecms->get_header('_banners');
		$data['titulo_pagina'] = "Crear banner";
		$this->load->view('admin/banners/nuevo-banner' , $data);
	}

	public function edita_banner($id){
		$data['banner'] = $this->banners->dameBanner($id);
		$data['head'] = $this->alinecms->get_head('Panel de banners' , TRUE);
		$data['header'] = $this->alinecms->get_header('_banners');
		$data['titulo_pagina'] = "Editar banner";
		$this->load->view('admin/banners/edita-banner' , $data);
	}	

	public function guarda_banner(){
		$this->set_validacion_banner();
		if ($this->form_validation->run() == FALSE){
			$this->crea_banner();
		}
		else{
			$imagen = $this->do_upload();
			$banner = $this->banners->agrega_banner($imagen);
			redirect('/panel/banners/', 'location');
		}
	}		

	public function set_validacion_banner($value=''){
		$config = array(
			array(
				'field'   => 'nombre',
				'label'   => 'Nombre',
				'rules'   => 'required|trim|min_length[3]'					
			),
			array(
				'field'   => 'ubicacion',
				'label'   => 'Posición',
				'rules'   => 'required'					
			)
        );	
		$this->form_validation->set_rules($config); 
	}

	public function subirImagen($id_banner){
        $data['banner'] = $this->banners->dameBanner($id_banner);
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->form_validation->set_rules("enviar","Guardar","required");
        if($this->form_validation->run() == FALSE){
            $this->load->view('admin/banners/edita_banner/'.$id_banner,$data);
        }else{
            $imagen = $this->do_upload();
            $datos_cont = array(
            	"id" => $id_banner,
                "imagen" => $imagen
            );
            if($imagen != false){
                $this->banners->subirImagenBanner($datos_cont);
                $data['mensaje'] = "<div class='alert alert-success'>Exito, la imagen se cargo satisfactoriamente!</div>";
            }else{
                $data['mensaje'] = "<div class='alert alert-error'>Error, intentalo de nuevo</div>";
            }
          	$this->load->view('admin/banners/edita_banner/'.$id_banner,$data);
        }
    }

	public function do_upload($edicion=false,$id=0){
		$config['upload_path'] = 'assets/media/banners/';
		$config['allowed_types'] = '*';
		$this->load->library('upload',$config);
		if(!$this->upload->do_upload('imagen')){
			$error = array('error' => $this->upload->display_errors());
			if ($edicion) {
				return $this->banners->dameImagenBanner($id);
			}else{
				die($error['error']);
			}
		}else{
			$imagen_info = $this->upload->data();
			return $imagen_info['file_name'];
		}
	}

}
?>