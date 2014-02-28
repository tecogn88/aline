<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Escritorio extends CI_Controller {

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
			if(!$this->alinecms->is_LoggedAdmin()){
				redirect('/' , 'location');
			}
		$this->load->model('model_usuarios', 'usr'); 
		$this->load->model('model_post', 'paginas');     
    }
			
	public function index(){
		$data['head'] = $this->alinecms->get_head('Inicio sesion administradores',TRUE);
		$data['footer'] = $this->alinecms->get_footer(TRUE);
		$data['header'] = $this->alinecms->get_header("_0");
		$data['header'] = $this->alinecms->get_header("--");
		$data['users'] = $this->db->count_all('usuarios');
		$data['paginas'] = $this->db->count_all('post');
		$data['menus'] = $this->db->count_all('menu');
		$data['slides'] = $this->db->count_all('slider');
		$data['banners'] = $this->db->count_all('banners');
		$this->load->view('admin/escritorio',$data);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */