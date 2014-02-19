<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Buscar extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('Alinecms');
		$this->load->library('email');
        $this->load->library('Configuration');
		$this->load->model('model_menus', 'menu');
        /*$this->load->model('model_documentos', 'documentos');*/
        $this->load->model('model_post', 'post');
        /*$this->load->model('model_catalogos', 'catalogos');*/
        $this->load->library('pagination');
	}

	public function index(){
        $this->load->library('pagination');
        if($this->input->server('REQUEST_METHOD') == 'POST'){
            $string = $this->input->post('buscar');
        }else{
            $string = $this->session->flashdata('string');
        }
        $this->session->set_flashdata('string', $string);  
		$menu_top = $this->menu->dameMenuTop();
            if ($menu_top) {
                $data['Menu_Top'] = $this->get_padres_vista($menu_top->id);
                $data['menu_top'] = $this->load->view('public/helper/menus/menu_top' , $data,True);
            }else{
                $data['menu_top'] = '';
            }
            $menu_nav = $this->menu->dameMenuNav();
            if ($menu_nav) {
                $data['Menu_Nav'] = $this->get_padres_vista($menu_nav->id);
                $data['menu_nav'] = $this->load->view('public/helper/menus/menu_nav' , $data,True);
            }else{
                $data['menu_nav'] = '';
            }
            $menu_footer = $this->menu->dameMenuFooter();
            if ($menu_footer) {
                $data['Menu_Footer'] = $this->get_padres_vista($menu_footer->id);
                $data['menu_footer'] = $this->load->view('public/helper/menus/menu_footer' , $data,True);
            }else{
                $data['menu_footer'] = '';
            }
            $menu_footer1 = $this->menu->dameMenuFooter1();
            if ($menu_footer1) {
                $data['Menu_Footer1'] = $this->get_padres_vista_span3($menu_footer1->id);
                $data['menu_footer1'] = $this->load->view('public/helper/menus/menu_footer1' , $data,True);
            }else{
                $data['menu_footer1'] = '';
            }
            $menu_footer2 = $this->menu->dameMenuFooter2();
            if ($menu_footer2) {
                $data['Menu_Footer2'] = $this->get_padres_vista_span3($menu_footer2->id);
                $data['menu_footer2'] = $this->load->view('public/helper/menus/menu_footer2' , $data,True);
            }else{
                $data['menu_footer2'] = '';
            }
            $menu_footer3 = $this->menu->dameMenuFooter3();
            if ($menu_footer3) {
                $data['Menu_Footer3'] = $this->get_padres_vista_span3($menu_footer3->id);
                $data['menu_footer3'] = $this->load->view('public/helper/menus/menu_footer3' , $data,True);
            }else{
                $data['menu_footer3'] = '';
            }
            $menu_footer4 = $this->menu->dameMenuFooter4();
            if ($menu_footer4) {
                $data['Menu_Footer4'] = $this->get_padres_vista_span3($menu_footer4->id);
                $data['menu_footer4'] = $this->load->view('public/helper/menus/menu_footer4' , $data,True);
            }else{
                $data['menu_footer4'] = '';
            }
        /*Activar las siguientes lineas cuando este instalado el componente de blog y catalogo*/
        $numero_articulos = $this->post->numeroArticulosBuscar($string);
        $paginacion = $this->paginacion($numero_articulos);
        $data['paginacion'] = $this->pagination->create_links();
        $data['articulos'] = $this->post->buscar($string,$paginacion['per_page'],$paginacion['desde']);
        /*$data['productos'] = $this->catalogos->buscar($string,$paginacion['per_page'],$paginacion['desde']);*/
		$this->load->view('public/buscar',$data);
	}

	public function paginacion($num){
		$config['base_url'] = base_url('buscar/index');
		$config['total_rows'] = $num;
		$config['per_page'] = 5;
		$config['uri_segment'] = 3;
		$config['first_link'] = TRUE;
		$config['last_link'] = TRUE;
		$this->pagination->initialize($config);
		$desde = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$paginacion = array(
			"per_page" => $config['per_page'],
			"desde" => $desde
		);
		return $paginacion;
	}

	public function get_padres_vista($idMenu = 0, $padre = 0){
        //$this->load->model('model_menus', 'menu');
        // Obtenemos todos los items padre
        $items = $this->menu->get_ItemsMenu_front($idMenu,$padre);
        $nombre_menu = $this->menu->get_nombre_menu($idMenu);
        // Verificamos que exista algun item de menu padre para proseguir con la consulta
        if($items->num_rows == 0 and $padre == 0){
            $elementos = "<ul><li>No hay items de menu en la base de datos.</li></ul>";
            return $elementos;
        }
        // Agregamos los atributos, clases y id al <ul> padre
        if($padre == 0){ 
            $mainMenu = $this->menu->get_mainMenu($idMenu); 
            $classMenu = ""; $idCssMenu =""; $atriMenu ="";
            if(! is_null($mainMenu->clase) ) $classMenu = "class='".$mainMenu->clase."'";
            if(strlen( trim($mainMenu->id_css) ) > 0 ){
                $subId = "id='".$mainMenu->id_css."'";
            }
            if(! is_null($mainMenu->atributos) ) $atriMenu = $mainMenu->atributos;
            $elementos = "<ul ".$classMenu." ".$idCssMenu." ".$atriMenu.">";
        }else{
            $elementos = "<ul class='dropdown-menu'>";
        }
        //$elementos .= "<li class='nav-header'>" . $nombre_menu . "</li>";
        // Recorremos el arbol de elementos padre buscando hijos 
        foreach($items->result() as $row){
            if( $row->is_logged == 'si' && ! $this->session->userdata('logged_in') ) continue;
            
            $hijos = $this->menu->get_hijos($idMenu,$row->idItem);
            
            $subClass =""; $subId = ""; $subAtri = "";
            
            if(! is_null($row->clase) ) $subClass = "class='".$row->clase."'";
            
            if(strlen( trim($row->id_css) ) > 0 ){
                $subId = "id='".$row->id_css."'";
            }
            if(! is_null($row->atri) ) $subAtri = $row->atri;
            $elementos .= "<li ".$subClass." ".$subId." ".$subAtri.">";

            $mhref = "";
            // 1 = Home | 2 = Contact | 3 = Page | 4 = Articulo | 5 = Blog | 6 = URL Externa
            switch ($row->tipo) {
                case 1:
                // Home
                    $mhref = base_url();
                    break;
                case 2:
                // Contacto
                    $mhref = base_url('contacto');
                    break;
                case 3:
                // Pagína
                    $tSlug = $this->menu->slug_actual($row->idpost);
                    $mhref = base_url($tSlug);
                    break;
                case 4:
                // Artículo
                    $tSlug = $this->menu->slug_actual($row->idpost);
                    $mhref = base_url($tSlug);
                    break;
                case 5:
                // Blog
                    $mhref = base_url('blog');
                    break;
                case 6:
                // URL Externa
                    $mhref = $row->url;
                    break;
                // Catalogo
                case 7:
                    $mhref = base_url('tienda/catalogos');
                    break;
                // Galeria imagenes
                case 8:
                    $mhref = base_url('galeria/imagenes/'.$row->idpost);
                    break;
                // Galeria audios
                case 9:
                    $mhref = base_url('galeria/audios/'.$row->idpost);
                    break;
                // Acervo
                case 10:
                    $mhref = base_url('acervo');
                    break;
                // Calendario
                case 11:
                    $mhref = base_url('calendario');
                    break;
                // Galeria videos
                case 12:
                    $mhref = base_url('galeria/videos/'.$row->idpost);
                    break;
            }
            if(! $hijos > 0){
                $elementos .= "<a href='$mhref'>" . $row->titulo . "</a>";
            }else{
                $elementos .= "<a class='dropdown-toggle' data-toggle='dropdown' href='$mhref'>" . $row->titulo . "</a>";
            }

            if($hijos > 0){
                $elementos .= $this->get_padres_vista($idMenu,$row->idItem);
            }

            $elementos .= '</li>';  
        } 
        $elementos .='</ul>';
        return $elementos;
    }

    public function get_padres_vista_span3($idMenu = 0, $padre = 0){
        // Obtenemos todos los items padre
        $items = $this->menu->get_ItemsMenu_front($idMenu,$padre);
        $nombre_menu = $this->menu->get_nombre_menu($idMenu);
        // Verificamos que exista algun item de menu padre para proseguir con la consulta
        if($items->num_rows == 0 and $padre == 0){
            $elementos = "<ul><li>No hay items de menu en la base de datos.</li></ul>";
            return $elementos;
        }
        // Agregamos los atributos, clases y id al <ul> padre
        if($padre == 0){ 
            $mainMenu = $this->menu->get_mainMenu($idMenu); 
            $classMenu = ""; $idCssMenu =""; $atriMenu ="";
            if(! is_null($mainMenu->clase) ) $classMenu = "class='".$mainMenu->clase."'";
            if(strlen( trim($mainMenu->id_css) ) > 0 ){
                $subId = "id='".$mainMenu->id_css."'";
            }
            if(! is_null($mainMenu->atributos) ) $atriMenu = $mainMenu->atributos;
            $elementos = "<ul ".$classMenu." ".$idCssMenu." ".$atriMenu.">";
        }else{
            $elementos = "<ul class='nav nav-list'>";
        }
        $elementos .= "<li class='nav-header'><h4>".$nombre_menu."</h4></li><br>";
        // Recorremos el arbol de elementos padre buscando hijos 
        foreach($items->result() as $row){
            if( $row->is_logged == 'si' && ! $this->session->userdata('logged_in') ) continue;
            $hijos = $this->menu->get_hijos($idMenu,$row->idItem);
            $subClass =""; $subId = ""; $subAtri = "";
            if(! is_null($row->clase) ) $subClass = "class='".$row->clase."'";
            if(strlen( trim($row->id_css) ) > 0 ){
                $subId = "id='".$row->id_css."'";
            }
            if(! is_null($row->atri) ) $subAtri = $row->atri;
            $elementos .= "<li ".$subClass." ".$subId." ".$subAtri.">";
            $mhref = "";
            // 1 = Home | 2 = Contacto | 3 = Página | 4 = Articulo | 5 = Blog | 6 = URL Externa | 7 = Catálogo ...
            switch ($row->tipo) {
                case 1:
                // Home
                    $mhref = base_url();
                    break;
                case 2:
                // Contacto
                    $mhref = base_url('contacto');
                    break;
                case 3:
                // Pagína
                    $tSlug = $this->menu->slug_actual($row->idpost);
                    $mhref = base_url($tSlug);
                    break;
                case 4:
                // Artículo
                    $tSlug = $this->menu->slug_actual($row->idpost);
                    $mhref = base_url($tSlug);
                    break;
                case 5:
                // Blog
                    $mhref = base_url('blog');
                    break;
                case 6:
                // URL Externa
                    $mhref = $row->url;
                    break;
                // Catalogo
                case 7:
                    $mhref = base_url('tienda/catalogos');
                    break;
                // Galeria imagenes
                case 8:
                    $mhref = base_url('galeria/imagenes/'.$row->idpost);
                    break;
                // Galeria audios
                case 9:
                    $mhref = base_url('galeria/audios/'.$row->idpost);
                    break;
                // Acervo
                case 10:
                    $mhref = base_url('acervo');
                    break;
                // Calendario
                case 11:
                    $mhref = base_url('calendario');
                    break;
                // Galeria videos
                case 12:
                    $mhref = base_url('galeria/videos/'.$row->idpost);
                    break;
            }
            if(! $hijos > 0){
                $elementos .= "<a href='$mhref'>" . $row->titulo . "</a>";
            }else{
                $elementos .= "<a class='dropdown-toggle' data-toggle='dropdown' href='$mhref'>" . $row->titulo . "</a>";
            }
            if($hijos > 0){
                $elementos .= $this->get_padres_vista($idMenu,$row->idItem);
            }
            $elementos .= '</li><br>';  
        } 
        $elementos .='</ul>';
        return $elementos;
    }

}