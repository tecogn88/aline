<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Banners extends CI_Controller{

	public function __construct(){
		parent::__construct();
		if(!$this->alinecms->is_LoggedAdmin()){
			redirect('/' , 'location');
		}
		$banners = array(
		    "1" => "pos1",
		    "2" => "pos2",
		);
		$this->config->set_item('banners', $banners);
		$this->load->model('model_banners', 'banners');
	}

	public function index(){
		$data['head'] = $this->alinecms->get_head('Panel de banners' , TRUE);
		$data['header'] = $this->alinecms->get_header('_6');
		$data['banners'] = $this->get_tabla_banner_panel();
		$this->load->view('admin/banners/banners' , $data);
	}

	public function crea_banner(){
		$data['head'] = $this->alinecms->get_head('Panel de banners' , TRUE);
		$data['header'] = $this->alinecms->get_header('_7');
		$data['titulo_pagina'] = "Crea un nuevo banner";
		$data['descripcion_pagina'] = "";
		//$data['banners'] = $this->get_tabla_banner_panel();
		$data['banners'] = "";
		$this->load->view('admin/banners/nuevo-banner' , $data);
/*		$banners = $this->config->item('banners');
		foreach ($banners as $banner => $value){
    		echo $banners[$banner];
		}*/
	}	

	public function get_tabla_banner_panel(){
		$banners = $this->banners->get_banners();
		$filas = 'No se encontraron banners';
		if($banners == FALSE){
			return $filas;
		}
		$filas = "  <table id='tblMenus' class='table table-striped  table-bordered '>
							<thead>
								<tr>
									<th>#</th>
									<th>Titulo</th>
									<th class='cont_accion'>Acciones</th>
								</tr>
							</thead>
					<tbody>";
		foreach ($banners->result() as $row){
		    $filas.= "<tr title='$row->descripcion'>";
		    	$filas.= "<td style='font-style:italic;font-weight:bold;'>" .  $row->id . "</td>";
	    		$filas.= "<td>" .  $row->nombre . "</td>";
	    		$filas.= "<td><div class='cont_accion'>" 
						."<a class='badge badge-success' href='"   . base_url("/panel/catalogo/edita_catalogo/$row->id")   ."' rel='tooltip' title='Editar catálogo:  <br/>". $row->nombre . "'><i class='icon-edit icon-white'></i></a>"  
						."<a class='badge badge-important btndel' 	href='"   . base_url("/panel/catalogo/borra_catalogo/$row->id") ."' rel='tooltip' title='Borrar catálogo: <br/>". $row->nombre . "'><i class='icon-remove icon-white'></i></a>"  
						."</div></td>";
			    $filas.= "</tr>";
		}
		$filas .= "</tbody></table>"; 
		return $filas;
	}

	public function guarda_banner(){
		$this->set_validacion_banner();
		if ($this->form_validation->run() == FALSE){
			//$this->edita_catalogo();
			echo validation_errors();
		}
		else{ 
			$this->banners->agrega_banner();
			redirect('/panel/banners/crea_banner', 'location');
		}
	}		

	public function set_validacion_banner($value=''){
		$config = array(
			array(
				'field'   => 'nombre',
				'label'   => 'Nombre',
				'rules'   => 'required|trim|min_length[3]|is_unique[banners.nombre]'					
			)
        );	
		$this->form_validation->set_rules($config); 
	}
}
?>