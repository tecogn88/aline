<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/blog
	 *	- or -  
	 * 		http://example.com/index.php/blog/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *e
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/blog/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	
	public function __construct(){
		parent::__construct();
		$this->load->model('model_usuarios', 'usr');
		$this->load->model('model_post', 'paginas');
	}
			
	public function index(){
		$this->load->library('form_validation');
		$data['no_existe'] = "";
		$data['head'] = $this->alinecms->get_head('Inicio sesion administradores',TRUE);
		$data['footer'] = $this->alinecms->get_footer(TRUE);
		$data['header'] = $this->alinecms->get_header("_0");
		$data['header_admin'] = $this->alinecms->get_header_admin("_0");
		$data['users'] = $this->db->count_all('usuarios');
		$data['paginas'] = $this->db->count_all('post');
		$data['menus'] = $this->db->count_all('menu');
		$data['slides'] = $this->db->count_all('slider');
		$data['banners'] = $this->db->count_all('banners');
		$data['error'] = '';
		$this->form_validation->set_rules('entrar','entrar','callback_inicia_sesion');
		if ($this->form_validation->run() == false) {
			$this->load->view('admin/inicio_sesion',$data);	
		}else{
			$data['header'] = $this->alinecms->get_header("--");
			$this->load->view('admin/escritorio',$data);
		}
	}

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
				'logged_in' => TRUE,
				'estado' => "$row->estado"
			);
			if($newdata['estado'] == 1){
				$this->session->set_userdata($newdata);
				return true;
			}else{
				$this->form_validation->set_message("inicia_sesion",'<h4>Usuario desactivado!</h4>');
				return false;
			}
		}else {
			$this->form_validation->set_message("inicia_sesion",'<h4>Sus datos no coinciden!</h4>');
			return false;
		}
	}// End authenticate function

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */