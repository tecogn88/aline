<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Paginas extends CI_Controller {

    public function __construct(){
        	parent::__construct();
        	$this->load->model('model_post', 'pag');
            $this->load->model('model_post', 'post');
            /*Activar para cargar el contenido del articulo*/
            /*$this->load->model('model_blog', 'post');*/
            $this->load->library('Configuration');
            $this->load->model('model_menus', 'menu');
            /*$this->load->model('model_catalogos', 'catalogos');*/
    }

    public function index(){
    	$this->error_404();
    	//echo"test";
    }

    function get_content_page($slug=""){
        $consulta = $this->pag->dame_pagina_por_slug($slug);
        if($consulta == FALSE OR ! $consulta->num_rows > 0 ){
            echo "No se encontro la página buscada";
        }else{
            echo $consulta->row()->contenido;
        }
    }

    function carga($titulo = ""){
  		if($titulo != ""){

     		$consulta = $this->pag->dame_pagina_por_slug($titulo);

    		if($consulta == FALSE OR ! $consulta->num_rows > 0 ){
    			$this->error_404();
    			return;
    		}
            $data['Menu_Principal'] = $this->get_padres_vista(27);
            $data['Menu_Footer'] = $this->get_padres_vista(28);
            $data['main_menu'] = $this->load->view('public/helper/main_menu' , $data,True);
    		$data['pagina'] = $consulta->row();
            $data['categoria_nombre'] = $this->post->dameNombreCategoria($consulta->row("id_categoria"));
            $data['articulos_ed'] = $this->post->damePostPortafolio();
            $data['destacados'] = $this->post->dameUltimosPostInicio();
            $data['categorias'] = $this->post->dameCategoriasPost();
            $data['recientes'] = $this->post->dameMasRecientes();
            $data['articulos'] = $this->post->blogCategoriaArticulo($consulta->row("id_categoria"));
            $data['autor'] = $this->post->dameNombreAutor($consulta->row("id_autor"));
            $data['autor_id'] = $this->post->dameIdAutor($consulta->row("id_autor"));
            $plantilla = $consulta->row()->plantilla;
            if($plantilla == "" || $plantilla == 0 || $plantilla == null){
                  $plantilla = $this->configuration->$plantilla;  
            }
            $idPagina = $consulta->row("id");
            // Insertar Log en DB para modulo "Lo más leido"
            $this->pag->insertaLog($idPagina);
            $data['menu_left'] = "";
            $id_menu = $this->menu->get_idMenu_by_Pagina($idPagina);
            if($id_menu){
                $data['menu_left'] = $this->get_padres_vista($id_menu);
            }
        	$this->load->view("public/template/pagina_".$plantilla.".php" , $data);
    	}else{
    		$this->error_404();
    		return;
	   	}
    } // Fin funcion cargar


    public function proyectos($titulo = ""){
        if($titulo != ""){

            $consulta = $this->pag->dame_pagina_por_slug($titulo);

            if($consulta == FALSE OR ! $consulta->num_rows > 0 ){
                $this->error_404();
                return;
            }
            $data['Menu_Principal'] = $this->get_padres_vista(27);
            $data['main_menu'] = $this->load->view('public/helper/main_menu' , $data,True);
            $data['pagina'] = $consulta->row();
            $data['articulos'] = $this->post->dameUltimosPostInicio();
            $data['articulos_ed'] = $this->post->damePostPortafolio();
            $plantilla = $consulta->row()->plantilla;
            if($plantilla == "" || $plantilla == 0 || $plantilla == null){
                  $plantilla = 1;  
            }
            $idPagina = $consulta->row("id");
            $data['menu_left'] = "";
            $id_menu = $this->menu->get_idMenu_by_Pagina($idPagina);
            if($id_menu){
                $data['menu_left'] = $this->get_padres_vista($id_menu);
            }
            $this->load->view('public/template/portafolio.php',$data);
        }else{
            $this->error_404();
            return;
        }
    }    

    public function error_404(){
    	$this->load->view("public/template/pagina_404.php");
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

    // public function moduloMasLeidos(){
    //     $data['articulos'] = $this->pag->dameArticulosMasLeidos();
    //     return $this->load->view('public/helper/articulos-mas-leidos',$data,true);
    // }


} // Fin controlador Sesion

