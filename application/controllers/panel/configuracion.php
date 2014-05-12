<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Clase utilizada para el control y edicion de usuarios del cms AlineCMS
 * @author Roberto Urita Jimenez  @robertuj robertuj@gmail.com 
 * 
 */
class Configuracion extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if(!$this->alinecms->is_LoggedAdmin()){
			redirect('/' , 'location');
		}
		$this->load->model('model_configuracion', 'configuracion');
		$this->load->library('Configuration');
	}

	public function index(){
		$this->load->helper(array('form','ckeditor'));
		if($this->input->post()){
			$conf = $this->configuracion->dame_configuracion();
			$conf_contacto = $this->configuracion->dame_config_contacto();
			$conf_contenido = $this->configuracion->dame_config_contenido();
			$conf_social = $this->configuracion->dame_config_social();
			if(!$conf && $conf_contacto){
				$this->configuracion->agregar_configuracion();
				$this->configuracion->agregar_config_contacto();
				$this->configuracion->agregar_config_contenido();
				$this->configuracion->agregar_config_social();
				redirect('panel/configuracion/','REFRESH');
			}else{
				if((int)$this->input->post('nuevo_logo') != 0){
					$logo = $this->do_upload('logo');
					if(!$logo){
						echo "Problemas al subir la imagen";
					}else{
						if((int)$this->input->post('logo_proporcional') == 1){
							$imagen = $this->dame_proporciones();
						}else{
							$imagen = array('ancho' => $this->input->post('logo_ancho'), 'alto' => $this->input->post('alto'));
						}
						$cambio = $this->configuracion->editar_configuracion($logo,$imagen);
						if($cambio){
							$this->session->set_flashdata('warning','<div id="cambio" class="alert alert-success"><b>La configuración se ha guardado correctamente.</b></div>');
						}
						redirect('panel/configuracion/','REFRESH');	
					}
				}else{
					if((int)$this->input->post('logo_proporcional') == 1){
						$imagen = $this->dame_proporciones();
					}else{
						$imagen = array('ancho' => $this->input->post('logo_ancho'), 'alto' => $this->input->post('logo_alto'));
					}
					$cambio_gen = $this->configuracion->editar_configuracion($this->configuration->logo,$imagen);
					$cambio_cnt = $this->configuracion->editar_config_contacto();
					$cambio_con = $this->configuracion->editar_config_contenido();
					$cambio_soc = $this->configuracion->editar_config_social();
					if($cambio_gen || $cambio_cnt || $cambio_con || $cambio_soc){
						$this->session->set_flashdata('warning','<div id="cambio" class="alert alert-success"><b>La configuración se ha guardado correctamente.</b></div>');
					}
					redirect('panel/configuracion/','REFRESH');
				}
			}
		}
		else{
			// SI NO ENVIA POR POST
			$categorias = $this->configuracion->dame_categorias();
			$data['categorias_select'] = $categorias;
			$data['titulo'] = $this->configuration->titulo;
			$data['logo'] = $this->configuration->logo;
			$data['logo_ancho'] = $this->configuration->logo_ancho;
			$data['logo_alto'] = $this->configuration->logo_alto;
			$data['correo_admin'] = $this->configuration->correo_admin;
			$data['emails_extra'] = $this->configuration->emails_extra;
			$data['nombre_admin'] = $this->configuration->nombre_admin;
			$data['direccion'] = $this->configuration->direccion;
			$data['mapa_g'] = $this->configuration->mapa_g;
			$data['mostrarmapa'] = $this->configuration->mostrarmapa;
			$data['infocontacto'] = $this->configuration->infocontacto;
			$data['buscador'] = $this->configuration->buscador;
			$data['encabezado'] = $this->configuration->encabezado;
			$data['info_descripcion'] = $this->configuration->info_descripcion;
			$data['telefono'] = $this->configuration->telefono;
			$data['plantilla'] = $this->configuration->plantilla;
			$data['twitter'] = $this->configuration->twitter;
			$data['facebook'] = $this->configuration->facebook;
			$data['google'] = $this->configuration->google;
			$data['youtube'] = $this->configuration->youtube;
			$data['linked'] = $this->configuration->linked;
			$data['g_analytics'] = $this->configuration->g_analytics;
			$data['m_descripcion'] = $this->configuration->m_descripcion;
			$data['num_articulos'] = $this->configuration->no_articulos;
			$data['num_recientes'] = $this->configuration->no_recientes;
			$data['head'] = $this->alinecms->get_head('Panel de Configuración', TRUE);
			$data['header'] = $this->alinecms->get_header("_5");
			$data['titulo_pagina'] = "Configuración General";
			$this->load->view('admin/configuracion', $data);
		}
	}// End configuration function

	public function do_upload(){
		$config['upload_path'] = "assets/img/";
		$config['allowed_types'] = 'jpg|png|gif|jpeg';
		$config['max_size']	= '10000';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';

		$this->load->library('upload', $config);
		if(!$this->upload->do_upload('logo')){
			$error = array('error' => $this->upload->display_errors());
			return false;
		}
		else{
			$info = array('upload_data' => $this->upload->data());
			return $info['upload_data']['file_name'];
		}
	}

	public function dame_proporciones(){
		if($this->input->post('logo_ancho') != 0){
			$ancho = $this->input->post('logo_ancho');
			if($this->input->post('nuevo_logo') == 1){
				$ruta_imagen = base_url() . "assets/img/" . $this->input->post('logo');	
			}else{
				$ruta_imagen = base_url() . "assets/img/" . $this->configuration->logo;
			}
			$imagen_datos = getimagesize($ruta_imagen);
			$escala = (int)$ancho/(int)$imagen_datos[0];
			$alto = (int)$imagen_datos[1]*$escala;
			return array('ancho' => $ancho, 'alto' => $alto);
		}else{
			return array('ancho' => 0, 'alto' => 0);
		}
	}

}