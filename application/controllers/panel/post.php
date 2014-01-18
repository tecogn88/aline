<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Clase utilizada para el control y edicion de usuarios del cms AlineCMS
 * @author Roberto Urita Jimenez  @robertuj robertuj@gmail.com 
 * 
 */
class Post extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if(!$this->alinecms->is_LoggedAdmin()){
			redirect('panel/admin' , 'location');
		}
		$this->load->model('model_post', 'post');
		$this->load->model('model_usuarios', 'usr');
		$this->load->library('form_validation');
	}
			
	public function index($filtro = '',$actualizado = "", $id = 0){
		$this->load->library('pagination');
		$num_post = $this->post->dame_numPost();
		$pagination = $this->paginacion($num_post,base_url("panel/post/index/"));
		$data['articulos'] = $this->post->get_post($pagination['per_page'],$pagination['desde'],true);
		$data['categorias'] = $this->post->get_categorias1($id);
		$data['paginacion'] = $this->pagination->create_links();
		$data['autores'] = $this->dame_autores_blog();
		$data['head'] = $this->alinecms->get_head('Panel de Blog' , TRUE);
		$data['header'] = $this->alinecms->get_header('_2');
		$this->load->view('admin/post/post',$data);
	}
	
	public function panel_categorias(){
		$this->load->helper(array('form','ckeditor'));
		$data['head'] = $this->alinecms->get_head('Edición de categorías' , TRUE);
		$data['header'] = $this->alinecms->get_header('_2');
		$data['titulo_pagina'] = "Panel de categorias";
		$data['descripcion_pagina'] = "";
		$data['categorias'] = $this->get_tabla_categoria_panel();
		$this->load->view('admin/post/panel-categorias' , $data);
	}

	public function paginacion($num,$url){
        $config['base_url'] = $url;
        $config['total_rows'] = $num;
        $config['per_page'] = 20;
        $config['uri_segment'] = 4;
        $config['first_link'] = '&lsaquo; Primero';
        $config['next_link'] = 'Siguiente';
		$config['prev_link'] = 'Anterior';
        $config['last_link'] = 'Último &rsaquo;';
        $config['first_tag_close'] = '<li>';
		$config['last_tag_open'] = '</li>';
		$config['cur_tag_open']	= '<li class="active"><a>';
		$config['cur_tag_close'] = '</a></li>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $this->pagination->initialize($config);
        $desde = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $paginacion = array(
            "per_page" => $config['per_page'],
            "desde" => $desde
        );
        return $paginacion;
    }

	public function crea_articulo(){
		$this->load->helper(array('form','ckeditor'));
		$data['head'] = $this->alinecms->get_head('Panel de articulos' , TRUE);
		$data['header'] = $this->alinecms->get_header('_2');
		$data['titulo_pagina'] = "Crea un nuevo articulo";
		$data['categorias'] = $this->dame_categorias();
		$data['autores'] = $this->dame_autores_blog();
		$data['descripcion_pagina'] = "";
		$this->load->view('admin/post/nuevo-post',$data);
	}

	public function guarda_articulo(){
		$this->set_validacion();
		if ($this->form_validation->run() == FALSE){
			$this->crea_articulo();
		}
		else{
			$imagen = $this->do_upload();
			$this->post->agrega_articulo($imagen);
			redirect('/panel/post', 'location');
		}
	}

	public function crea_categoria(){
		$this->load->helper(array('form','ckeditor'));
		$data['head'] = $this->alinecms->get_head('Edición de categorías' , TRUE);
		$data['header'] = $this->alinecms->get_header('_2');
		$data['titulo_pagina'] = "Creación de categorias";
		$data['descripcion_pagina'] = "Crea una categoria para tu blog y agrupa tus post.";
		$data['categorias'] = $this->get_tabla_categoria_panel();
		$this->load->view('admin/post/nueva-categoria' , $data);
	}

	public function guarda_categoria(){
		$this->set_validacion_categoria();
		if ($this->form_validation->run() == FALSE){
			$this->crea_categoria();
		}
		else{
			$imagen = $this->do_upload();
			$this->post->agrega_categoria($imagen);
			redirect('/panel/post/panel_categorias', 'location');
		}		
	}

	public function set_validacion_categoria($value=''){
		$config = array(
			array(
				'field'   => 'titulo',
				'label'   => 'Titulo',
				'rules'   => 'required|trim|min_length[3]'					
			)
        );	
		$this->form_validation->set_rules($config); 
	}

	public function set_validacion($value=''){
		$this->load->library('form_validation');
			$config = array(
				array(
					'field'   => 'titulo',
					'label'   => 'Titulo',
					'rules'   => 'required|trim|min_length[3]'
				),
				array(
					'field'   => 'slug',
					'label'   => 'Slug',
					'rules'   => 'required|trim|min_length[3]|alpha_dash|is_unique[post.slug]'
				),
				array(
					'field'   => 'contenido',
					'label'   => 'Contenido',
					'rules'   => 'required|trim|min_length[3]'
				)  
	        );	
		$this->form_validation->set_rules($config); 
	}

	public function borra_categoria($id=0){
		$result = $this->post->borrar_categoria($id);
		redirect('panel/post/panel_categorias', 'location'); 
	}

	public function edita_categoria($id = 0){
		$this->load->helper(array('form','ckeditor'));
		$categoria = $this->post->get_categoria_by_id($id);
		if($categoria == FALSE){	
		}
		$data = array(
					"titulo_categoria" => $categoria->row('nombre'),
					"descripcion" => $categoria->row('descripcion'),
				);
		$data['imagen'] = $categoria->row('imagen');
		$data['id_categoria'] = $id;
		$data['head'] = $this->alinecms->get_head('Edición de categorías' , TRUE);
		$data['header'] = $this->alinecms->get_header('_2');
		$data['titulo_pagina'] = "Edita categoría";
		$data['descripcion_pagina'] = "";
		$data['categorias'] = $this->get_tabla_categoria_panel();
		$this->load->view('admin/post/edita_categoria' , $data);
	}

	public function actualizar_categoria($id = 0){
			if ($id == 0) return FALSE;
			$this->set_validacion_categoria();
			if ($this->form_validation->run() == FALSE){
				echo validation_errors();
			}
			else{
				$imagen = $this->do_upload();
                if($imagen != false){
                    $this->post->actualiza_img_cat($id,$imagen);
                }
				$this->post->actualizar_cat($id);
				redirect('/panel/post/panel_categorias');
			}
		}

	public function get_tabla_categoria_panel($id=0){
		$categorias = $this->post->get_categorias1($id);
		$filas = 'No se encontraron categorías';
		if($categorias == FALSE){
			return $filas;
		}
		$filas = "  <table id='tblMenus' class='table table-striped  table-bordered '>
							<thead>															
								<tr style='background-color: #D9EDF7;'>
									<th><span class='label label-info' style='margin-right: 10px;'><i class='icon-barcode icon-white'></i></span>ID</th>
									<th><span class='label label-info' style='margin-right: 10px;'><i class='icon-font icon-white'></i></span>Titulo</th>
									<th><span class='label label-info' style='margin-right: 10px;'><i class='icon-align-left icon-white'></i></span>Descripción</th>
									<th><span class='label label-info' style='margin-right: 10px;'><i class='icon-picture icon-white'></i></span>Imagen</th>
									<th class='cont_accion'><span class='label label-info' style='margin-right: 10px;'><i class='icon-wrench icon-white'></i></span>Acciones</th>
								</tr>
							</thead>
					<tbody>";
		foreach ($categorias->result() as $row){
			$imagen = base_url('/assets/img/'.$row->imagen);
		    $filas.= "<tr title='$row->descripcion'>";
		    	$filas.= "<td style='font-style:italic;font-weight:bold;vertical-align: middle;'>" .  $row->id . "</td>";
	    		$filas.= "<td style='vertical-align: middle;'>" .  $row->nombre . "</td>";
				$filas.= "<td style='vertical-align: middle;'>" . $row->descripcion . "</td>";
				$filas.= "<td style='vertical-align: middle;text-align:center;'><img src=".$imagen." style='width:70px;'></td>";
	    		$filas.= "<td style='vertical-align: middle;'><div class='cont_accion'>" 
						."<a class='badge badge-success' href='"   . base_url("/panel/post/edita_categoria/$row->id")   ."' rel='tooltip' title='Editar categoria:  <br/>". $row->nombre . "'><i class='icon-edit icon-white'></i></a>"  
						."<a class='badge badge-important btndel' 	href='"   . base_url("/panel/post/borra_categoria/$row->id") ."' rel='tooltip' title='Borrar categoria: <br/>". $row->nombre . "'><i class='icon-remove icon-white'></i></a>"  
						."</div></td>";
			    $filas.= "</tr>";
		}
		$filas .= "</tbody></table>"; 
		return $filas;
	}

	public function do_upload($id=0){
		$config['upload_path'] = 'assets/img/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '2000';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';
		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('imagen')){
			$error = array('error' => $this->upload->display_errors());
			if($id != 0){
		 		return $this->post->dameImagen($id);
			}else{
				return false;
			}
		}	
		else{
			$data = array('upload_data' => $this->upload->data());
			return $data['upload_data']['file_name'];
		}
	}

	// FABIAN EDICION ARTICULOS BLOG

	public function edita_post($id){
		$articulo = $this->post->get_post_by_id($id);
		$data["row"] = $articulo->row();
		$this->load->helper(array('form','ckeditor'));
		$data['head'] = $this->alinecms->get_head('Edición de artículos' , TRUE);
		$data['header'] = $this->alinecms->get_header('_2');
		$data['titulo_pagina'] = "Edición de contenido de artículos";
		$data['categorias'] = $this->post->get_categorias1($id);
		$data['autores'] = $this->usr->dame_autores_blog($id);
		$data['descripcion_pagina'] = "";
		$data['id_autor'] = $articulo->row('id_autor');
		$data['id_categoria'] = $articulo->row('id_categoria');
		$this->load->view('admin/post/edita-post', $data);
	}

	public function guarda_edicion_articulo(){
		$this->set_edicion_articulo();

		if ($this->form_validation->run() == FALSE){
			$this->crea_articulo();
		}
		else{
			$imagen = $this->do_upload($this->input->post('id'));
			$this->post->actualiza_articulo($imagen);
			redirect('/panel/post', 'location');
		}
	}

	public function set_edicion_articulo($value=''){
		$this->load->library('form_validation');
			$slug_ = $this->input->post('slug');
			$slug_old_ = $this->input->post('slug_old');

			if($slug_ != $slug_old_){
				
				$config = array(
					array(
						'field'   => 'titulo',
						'label'   => 'Titulo',
						'rules'   => 'required|trim|min_length[3]'
					),
					array(
						'field'   => 'slug',
						'label'   => 'Slug',
						'rules'   => 'required|trim|min_length[3]|alpha_dash|is_unique[post.slug]'
					),
					array(
						'field'   => 'contenido',
						'label'   => 'Contenido',
						'rules'   => 'required|trim|min_length[3]'
					)  
	        	);	
			}else{
				
				$config = array(
					array(
						'field'   => 'titulo',
						'label'   => 'Titulo',
						'rules'   => 'required|trim|min_length[3]'
					),
					array(
						'field'   => 'slug',
						'label'   => 'Slug',
						'rules'   => 'required|trim|min_length[3]|alpha_dash'
					),
					array(
						'field'   => 'contenido',
						'label'   => 'Contenido',
						'rules'   => 'required|trim|min_length[3]'
					)  
	        	);
			}

		$this->form_validation->set_rules($config); 
	}

	//FIN EDICION ARTICULOS BLOG

	public function dame_categorias(){
		$categorias = $this->post->get_categorias1();
		$Cat = "<select name='categoria'>";
		if($categorias->num_rows > 0 ){
			$Cat .= "<option value='0'>Sin categoría</option>";
			foreach ($categorias->result() as $row) {
				$Cat .= "<option " . set_select('categoria', "$row->id")  ."  value='$row->id'>$row->nombre</option>";
			}
		}else{
			$Cat .= "<option value='0'>No hay categorias creadas</option>";
		}
		$Cat .= "</select>";
		return $Cat;
	}

	public function dame_autores_blog(){
		$autores = $this->usr->dame_autores_blog();
		$autor = "<select name='autor'>";
		if($autores->num_rows > 0 ){
			$autor .= "<option value='0'>Anónimo</option>";
			foreach ($autores->result() as $row) {
				$autor .= "<option " . set_select('autor', "$row->id")  ."  value='$row->id'>$row->nombre</option>";
			}
		}else{
			$autor .= "<option value='0'>No hay autores</option>";
		}
		$autor .= "</select>";
		return $autor;
	}

	public function get_tabla_articulos($tblarticulos = ""){
		$filas = '';
		$filas = "  <table id='tblarticulos' class='table table-striped'>
							<thead>
								<tr>
									<th><i class='icon-font icon-black'></i>  Titulo</th>
									<th><i class='icon-bold icon-black'></i>  Slug</th>
									<th><i class='icon-user icon-black'></i>  Autor</th>
									<th><i class='icon-tasks icon-black'></i>  Categorias</th>
									<th><i class='icon-tags icon-black'></i>  Etiquetas</th>
									<th><i class='icon-calendar icon-black'></i>  Fecha</th>
									<th><i class='icon-wrench icon-black'></i>  Accion</th>
								</tr>
							</thead>
					<tbody>";
		if( $tblarticulos == FALSE ){$filas = "No hay articulos creados."; return $filas;}	

		foreach ($tblarticulos->result() as $row){
		    $filas.= "<tr>";
	    		$filas.= "<td style='font-style:italic;font-weight:bold;'>" .  $row->titulo . "</td>";
	    		$filas.= "<td> " .   $row->slug ."</td>";
	    		$filas.= "<td> " .  $row->nombre . " " . $row->apellidos .  "</td>";
				// Aqui se creara una consulta para multiples categorias
				$filas.= "<td> " .   $row->cnombre ."</td>";
				$filas.= "<td> " .   $row->etiquetas ."</td>";
				$filas.= "<td>".$row->fecha_publicacion."</td>";
				$filas.= "<td><div class='cont_accion'>" 
					."<a class='badge badge-success' href='"   . base_url("/panel/post/edita_post/$row->id_post")   ."' rel='tooltip' title='Editar el articulo:  <br/>". $row->titulo . "'><i class='icon-edit icon-white'></i></a>"  
					."<a class='badge badge-important btndel' 	href='"   . base_url("/panel/post/borrar_post/$row->id_post") ."' rel='tooltip' title='Eliminar el articulo: <br/>". $row->titulo . "'><i class='icon-remove icon-white'></i></a>"  
					."</div></td>";
			    $filas.= "</tr>";
		} // End ForEach
		$filas .= "</tbody></table>"; 
		return $filas;
	}//  __get_rows

	public function panel_paginas(){
		$articulos = $this->post->get_posts("2");
		$data['head'] = $this->alinecms->get_head('Panel de Páginas' , TRUE);
		$data['header'] = $this->alinecms->get_header('_3');
		$data['paginas'] = $this->get_tabla_paginas($articulos);
		$this->load->view('admin/post/paginas',$data);
	}
	
	public function crea_pagina(){
		$this->load->helper(array('form','ckeditor'));
		$data['head'] = $this->alinecms->get_head('Panel de páginas' , TRUE);
		$data['header'] = $this->alinecms->get_header('_3');
		$data['titulo_pagina'] = "Crea una página";
		$data['descripcion_pagina'] = "";
		$this->load->view('admin/post/nueva-pagina',$data);
	}

	public function guarda_pagina(){
		$this->set_validacion_pagina();
		if ($this->form_validation->run() == FALSE){
			$this->crea_pagina();
		}
		else{ 
			$this->post->agrega_pagina();
			redirect('/panel/post/panel_paginas', 'location');
		}
	}

	public function set_validacion_pagina($value=''){
		$this->load->library('form_validation');
			$config = array(
				array(
					'field'   => 'titulo',
					'label'   => 'Titulo',
					'rules'   => 'required|trim|min_length[3]'
				),
				array(
					'field'   => 'slug',
					'label'   => 'Slug',
					'rules'   => 'required|trim|min_length[3]|alpha_dash|is_unique[post.slug]'
				),
				array(
					'field'   => 'contenido',
					'label'   => 'Contenido',
					'rules'   => 'required|trim|min_length[3]'
				)  
	        );	
		$this->form_validation->set_rules($config); 
	}

	public function edita_pagina($id = 0){
		$pagina = $this->post->get_post_by_id($id);
		$data["row"] = $pagina->row();
		$this->load->helper(array('form','ckeditor'));
		$data['head'] = $this->alinecms->get_head('Edicion de páginas' , TRUE);
		$data['header'] = $this->alinecms->get_header('_3');
		$data['titulo_pagina'] = "Edición de página";
		$data['descripcion_pagina'] = "";
		$this->load->view('admin/post/edita-pagina',$data);
	}

	public function guarda_edicion_pagina(){
		$this->set_edicion_pagina();
		if ($this->form_validation->run() == FALSE){
			$this->crea_pagina();
		}
		else{ 
			$this->post->actualiza_pagina();
			redirect('/panel/post/panel_paginas', 'location');
		}
	}

	public function set_edicion_pagina($value=''){
		$this->load->library('form_validation');
			$slug_ = $this->input->post('slug');
			$slug_old_ = $this->input->post('slug_old');

			if($slug_ != $slug_old_){
				
				$config = array(
					array(
						'field'   => 'titulo',
						'label'   => 'Titulo',
						'rules'   => 'required|trim|min_length[3]'
					),
					array(
						'field'   => 'slug',
						'label'   => 'Slug',
						'rules'   => 'required|trim|min_length[3]|alpha_dash|is_unique[post.slug]'
					),
					array(
						'field'   => 'contenido',
						'label'   => 'Contenido',
						'rules'   => 'required|trim|min_length[3]'
					)  
	        	);	
			}else{
				
				$config = array(
					array(
						'field'   => 'titulo',
						'label'   => 'Titulo',
						'rules'   => 'required|trim|min_length[3]'
					),
					array(
						'field'   => 'slug',
						'label'   => 'Slug',
						'rules'   => 'required|trim|min_length[3]|alpha_dash'
					),
					array(
						'field'   => 'contenido',
						'label'   => 'Contenido',
						'rules'   => 'required|trim|min_length[3]'
					)  
	        	);
			}
		$this->form_validation->set_rules($config); 
	}
	

	public function get_tabla_paginas($tblarticulos = ""){
		$filas = '';
		$filas = "  <table id='tblarticulos' class='table table-striped  table-bordered '>
							<thead>
								<tr style='background-color: #D9EDF7;'>
									<th><span class='label label-info' style='margin-right: 10px;'><i class='icon-barcode icon-white'></i></span>  Id</th>
									<th><span class='label label-info' style='margin-right: 10px;'><i class='icon-font icon-white'></i></span>  Titulo</th>
									<th><span class='label label-info' style='margin-right: 10px;'><i class='icon-bold icon-white'></i></span>  Slug</th>
									<th><span class='label label-info' style='margin-right: 10px;'><i class='icon-user icon-white'></i></span>  Autor</th>
									<th><span class='label label-info' style='margin-right: 10px;'><i class='icon-tags icon-white'></i></span>  Etiquetas</th>
									<th><span class='label label-info' style='margin-right: 10px;'><i class='icon-calendar icon-white'></i></span>  Fecha</th>
									<th><span class='label label-info' style='margin-right: 10px;'><i class='icon-wrench icon-white'></i></span>  Accion</th>
								</tr>
							</thead>
					<tbody>";
		if( $tblarticulos == FALSE ){$filas = "No hay pagínas creadas."; return $filas;}	

		foreach ($tblarticulos->result() as $row){
		    $filas.= "<tr>";
		    	$filas.= "<td style='font-style:italic;font-weight:bold;'>" .  $row->id_post . "</td>";
	    		$filas.= "<td style='font-style:italic;font-weight:bold;'>" .  $row->titulo . "</td>";
	    			$filas.= "<td> " .   $row->slug ."</td>";
	    		$filas.= "<td> " .  $row->nombre . " " . $row->apellidos .  "</td>";
				// Aqui se creara una consulta para multiples categorias
				
				$filas.= "<td> " .   $row->etiquetas ."</td>";
				$filas.= "<td>".$row->fecha_publicacion."</td>";
				$filas.= "<td><div class='cont_accion'>" 
					."<a class='badge badge-success' href='"   . base_url("/panel/post/edita_pagina/$row->id_post")   ."' rel='tooltip' title='Editar la página:  <br/>". $row->titulo . "'><i class='icon-edit icon-white'></i></a>"  
					."<a class='badge badge-important btndel' 	href='"   . base_url("/panel/post/borrar_pagina/$row->id_post") ."' rel='tooltip' title='Eliminar la página: <br/>". $row->titulo . "'><i class='icon-remove icon-white'></i></a>"  
					."</div></td>";
			    $filas.= "</tr>";
		} // End ForEach
		$filas .= "</tbody></table>"; 
		return $filas;
	}//  __get_rows
	
	/**
	 * Funcion que borra un usuario 
	 * @var integer $id {Id del usuario a borrar}
	 */
	public function borrar_post($id=0){
		$result = $this->post->borrar_articulo($id);
		redirect('panel/post', 'location'); 
	}
	/**
	 * Funcion que borra un usuario 
	 * @var integer $id {Id del usuario a borrar}
	 */
	public function borrar_pagina($id=0){
		$result = $this->post->borrar_articulo($id);
		redirect('panel/post/panel_paginas', 'location'); 
	}

/**********************************************************************************/
	public function inicia_sesion(){
		$query = $this->usr->verifica_usuario();
		if($query != FALSE){
			$row = $query->row();		
			$newdata = array(
				'id'  => "$row->id",
				'nombre'  => "$row->nombre",
				'apellidos'  => "$row->apellidos",
				'usuario'  => "$row->usuario",
				'pass'  => "$row->pass",
				'email'  => "$row->email",
				'perfil'  => "$row->perfil",  // 1 Admin  || 2 Editor  || 3 Suscriptor
				'logged_in' => TRUE
			);
			$this->session->set_userdata($newdata);
			redirect(base_url('panel/admin'),'refresh');
		}else {
			redirect(base_url('panel/admin/index/fail'),'refresh');
		}
	}// End authenticate function

	public function cerrar_sesion(){
		$this->session->sess_destroy();
		redirect('/','refresh');
	}
}

/* End of file usuarios.php */
/* Location: ./application/controllers/usuarios.php */