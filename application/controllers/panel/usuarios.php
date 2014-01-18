<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/**
 * Clase utilizada para el control y edicion de usuarios del cms AlineCMS
 * @author Roberto Urita Jimenez  @robertuj robertuj@gmail.com 
 * 
 */
class Usuarios extends CI_Controller {

	public function __construct(){
		parent::__construct();

		if(!$this->alinecms->is_LoggedAdmin()){
			redirect('/' , 'location');
		}

		$this->load->model('model_usuarios', 'usr');
	}
			
	public function index($filtro = '',$actualizado = ""){
		
		if($actualizado != ""){
			$data['actualizado'] = "";
		}

		$usuarios = $this->usr->get_usuarios($filtro);
		$perfiles = $this->usr->get_perfiles();
		$data['head'] = $this->alinecms->get_head('Panel de Usuarios',TRUE);
		$data['header'] = $this->alinecms->get_header('_1');
		$data['usuarios'] = $usuarios;
		$data['perfiles'] = $perfiles;
		$data['links'] = $this->get_links_filtros($usuarios);
		$this->load->view('admin/usuarios/panel-usuarios',$data);
	}
	
	public function get_links_filtros($usuarios = array() ){
		$m_usuarios = $this->usr->get_usuarios();
		$perfiles = $this->usr->get_perfiles();
		$links = "";
		$total = $m_usuarios->num_rows();
		$links .= "<p>";
		$links .= "<a href='". base_url('panel/usuarios/') ."'> Todos </a> ($total) <strong>|</strong> ";
			foreach ($perfiles->result() as $rowperfiles) {
				switch ($rowperfiles->perfil) {
					case 1:
						$links.= "<a href='". base_url('panel/usuarios/index/1') ."'> Administradores</a> ($rowperfiles->cantidad) <strong>|</strong> ";
						break;
					case 2:
						$links.= "<a href='". base_url('panel/usuarios/index/2') ."'> Editores </a> ($rowperfiles->cantidad) <strong>|</strong> ";
						break;
					case 3:
						$links.= "<a href='". base_url('panel/usuarios/index/3') ."'> Suscriptores </a> ($rowperfiles->cantidad) ";
						break;
				}
			}
		$links.= "</p>";
		return $links;
	}

	/**
	 * Muestra el tablero de herramientas para los usuarios
	 */
	public function nuevo_usuario($pass = TRUE, $usr_fail = FALSE, $email_fail = FALSE){
		$this->load->helper('form');
		$this->load->helper(array('form','ckeditor'));

		if(! $pass){
			$data['pass'] = $pass;                                    
		}
		if($usr_fail){
			$data['usr_fail'] = $usr_fail;            
		}
		if($email_fail){
			$data['email_fail'] = $email_fail;
		}
		$data['head']               = $this->alinecms->get_head('Agrega usuario nuevo', TRUE);
		$data['header']             = $this->alinecms->get_header('_1');
		$data['nombre_pagina']      = "Agregar un nuevo usuario";
		$data['descripcion_pagina'] = "Crea un usuario nuevo para el sitio";
		$this->load->view('admin/usuarios/nuevo-usuario',$data);
	}

	/**
	 * Funcion que agrega un usuario nuevo a la tabla usuarios
	 * recoge los datos por post
	 */
	public function crea_usuario(){
		$this->load->helper(array('form','ckeditor'));
		$this->load->library('form_validation');
		$this->set_validacion();

		$data['usr_fail'] = FALSE;
		$data['email_fail'] = FALSE;
		$data['pass'] = TRUE;

		if ($this->form_validation->run() == FALSE){
			$data['pass'] = FALSE;
			$this->nuevo_usuario($data['pass'] , $data['usr_fail'] , $data['email_fail']);
		}
		else{    		
    		// Verificar existencia de usuario
			if( $this->usr->existe_usuario() == TRUE){
				$data['usr_fail'] = TRUE;
				$data['pass'] = FALSE;
			}
			if( $this->usr->existe_email() == TRUE){
				$data['email_fail'] = TRUE;
				$data['pass'] = FALSE;
			}		
			// ejecuta funcion de guardado de usuario nuevo
			if($data['usr_fail'] == FALSE && $data['email_fail'] == FALSE && $data['pass'] == TRUE){
				$imagen = $this->do_upload();
				$this->usr->inserta_usuario_nuevo($imagen);
				redirect('panel/usuarios','location');
				return;
			}

			$this->nuevo_usuario($data['pass'] , $data['usr_fail'] , $data['email_fail']);
		}
	} // End function crea_usuario

	function do_upload(){
		$config['upload_path'] = 'assets/media/usuarios/';
		$config['allowed_types'] = '*';
		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload('imagen')){
			return $this->input->post('imagen', true);
			if($this->input->post("imagen_anterior")){
                return $this->input->post("imagen_anterior");
            }else{
                return false;
            }
		}
		else{
			$data = array('upload_data' => $this->upload->data());
			return $data['upload_data']['file_name'];
		}

	}

	function set_validacion($origen = ""){
		$this->load->library('form_validation');
			$config = array(
				array(
					'field'   => 'nombre',
					'label'   => 'Nombre',
					'rules'   => 'required|trim|min_length[3]'
				),
				array(
					'field'   => 'apellidos',
					'label'   => 'Apellidos',
					'rules'   => 'required|trim|min_length[3]'
				),
				array(
					'field'   => 'usuario',
					'label'   => 'Usuario',
					'rules'   => 'required|trim|min_length[3]|max_length[15]'
				),  
				array(
					'field'   => 'pass',
					'label'   => 'Contraseña',
					'rules'   => 'trim|required|matches[re_pass]|min_length[4]'
				),   
				array(
					'field'   => 're_pass',
					'label'   => 'Re-Ingrese Contraseña',
					'rules'   => 'trim|required|matches[pass]|min_length[4]'
				),
				array(
					'field'   => 'email',
					'label'   => 'Email',
					'rules'   => 'required|valid_email'
				)
	        );	
		$this->form_validation->set_rules($config); 
	}
	
	/**
	 * Muestra el formulario para la edicion de un usuario 
	 * @var integer $id {Id del usuario a editar}
	 * 
	 */
	
	public function edita_usuario($id=0, $pass = TRUE, $usr_fail = FALSE, $email_fail = FALSE){
		$this->load->helper(array('form','ckeditor'));
		$data['notuser'] = FALSE;
		$data['usr'] = "";
		// Carga usuario desde bd por medio del id
		$usuario                    = $this->usr->get_usuario_by_id($id);
		if(! $pass){
			$data['pass'] = $pass;                                    
		}
		if($usr_fail){
			$data['usr_fail'] = $usr_fail;            
		}
		if($email_fail){
			$data['email_fail'] = $email_fail;
		}


		$data['head']               = $this->alinecms->get_head('Edita información de usuario de usuarios', TRUE);
		$data['header']             = $this->alinecms->get_header('_1');
		$data['nombre_pagina']      = "Edicion de usuario";
		$data['descripcion_pagina'] = "Edita la información de este usuario";
		
		if ($usuario->num_rows() > 0){
			$row         = $usuario->row(); 
			$data['usr'] = $row;
		}else{
			$data['notuser'] = TRUE;
		}
		$this->load->helper('form');
		$this->load->view('admin/usuarios/edita-usuario',$data);
	}

	/**
	 * Muestra formulario para la edicion de un usuario
	 * @global Post recoge los datos de edicion del cliente por medio de post
	 */

	public function guarda_edicion($id){
		$this->load->library('form_validation');
		$this->set_validacion_edicion();

		$data['id'] = $this->input->post('id');

		$data['usr_fail'] = FALSE;
		$data['email_fail'] = FALSE;
		$data['pass'] = TRUE;

		if ($this->form_validation->run() == FALSE){
			$data['pass'] = FALSE;
			$this->edita_usuario($data['id'], $data['pass'] , $data['usr_fail'] , $data['email_fail']);
		}
		else{    		
    		// Verificar existencia de usuario
			if( $this->usr->existe_usuario('edicion') == TRUE){
				$data['usr_fail'] = TRUE;
				$data['pass'] = FALSE;
			}
			if( $this->usr->existe_email('edicion') == TRUE){
				$data['email_fail'] = TRUE;
				$data['pass'] = FALSE;
			}		
			// ejecuta funcion de guardado de usuario nuevo
			if($data['usr_fail'] == FALSE && $data['email_fail'] == FALSE && $data['pass'] == TRUE){
				$imagen = $this->do_upload();
	            if($imagen != false){
	                $this->usr->actualiza_img($id,$imagen);
	            }
				$this->usr->guarda_edicion_usuario();
				redirect('panel/usuarios','location');
				return;
			}
			$this->edita_usuario($data['id'], $data['pass'] , $data['usr_fail'] , $data['email_fail']);
		}
	} // End guarda_edicion

	function set_validacion_edicion($origen = ""){
		$this->load->library('form_validation');

		if($this->input->post('new_pass') != ""){
			$config = array(
				array(
					'field'   => 'nombre',
					'label'   => 'Nombre',
					'rules'   => 'required|trim|min_length[3]'
				),
				array(
					'field'   => 'apellidos',
					'label'   => 'Apellidos',
					'rules'   => 'required|trim|min_length[3]'
				),
				array(
					'field'   => 'usuario',
					'label'   => 'Usuario',
					'rules'   => 'required|trim|min_length[3]|max_length[15]'
				),  
				array(
					'field'   => 'pass',
					'label'   => 'Contraseña',
					'rules'   => 'trim|required|matches[re_pass]|min_length[4]'
				),   
				array(
					'field'   => 're_pass',
					'label'   => 'Re-Ingrese Contraseña',
					'rules'   => 'trim|required|matches[pass]|min_length[4]'
				),
				array(
					'field'   => 'email',
					'label'   => 'Email',
					'rules'   => 'required|valid_email'
				)
	        );
		}else{
			$config = array(
				array(
					'field'   => 'nombre',
					'label'   => 'Nombre',
					'rules'   => 'required|trim|min_length[3]'
				),
				array(
					'field'   => 'apellidos',
					'label'   => 'Apellidos',
					'rules'   => 'required|trim|min_length[3]'
				),
				array(
					'field'   => 'usuario',
					'label'   => 'Usuario',
					'rules'   => 'required|trim|min_length[3]|max_length[15]'
				),  
		/*		array(
					'field'   => 'pass',
					'label'   => 'Contraseña',
					'rules'   => 'trim|required|matches[re_pass]|min_length[4]'
				),   
				array(
					'field'   => 're_pass',
					'label'   => 'Re-Ingrese Contraseña',
					'rules'   => 'trim|required|matches[pass]|min_length[4]'
				),
		*/		array(
					'field'   => 'email',
					'label'   => 'Email',
					'rules'   => 'required|valid_email'
				)
	        );
		}
			
		$this->form_validation->set_rules($config); 
	}
	
	/**
	 * Funcion que borra un usuario 
	 * @var integer $id {Id del usuario a borrar}
	 */
	public function borrar_usuario($id=0){
		$result = $this->usr->borrar_usuario($id);
		redirect('panel/usuarios', 'location'); 
	}	
	
}

/* End of file usuarios.php */
/* Location: ./application/controllers/usuarios.php */