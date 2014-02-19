<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contacto extends CI_Controller {

    public function __construct(){
    	parent::__construct();
    	$this->load->model('model_post', 'pag');
        $this->load->library('Configuration');
        $this->load->model('model_menus', 'menu');
        $this->load->model('model_captcha', 'captcha');
        $this->load->model('model_configuracion', 'configuracion');
        $this->load->library('Configuration');
    }
 
    public function index(){
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->helper('string');
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
        $data['mostrarmapa'] = $this->configuration->mostrarmapa;
        $data['infocontacto'] = $this->configuration->infocontacto;
        $data['encabezado'] = $this->configuration->encabezado;
        $data['info_descripcion'] = $this->configuration->info_descripcion;
        $data['correo_admin'] = $this->configuration->correo_admin;
        $data['direccion'] = $this->configuration->direccion;
        $data['telefono'] = $this->configuration->telefono;
        $data['titulo'] = $this->configuration->titulo;
        $this->form_validation->set_rules($this->form_rules());
        $this->form_validation->set_rules('captcha','Captcha','required|callback_captcha_check');
        $this->form_validation->set_message('captcha_check','El código ingresado no es válido');
        if($this->form_validation->run() == FALSE){
            $this->load->helper('captcha');
            $vals = array(
                'word' => random_string('alpha',4),
                'img_path'   => './assets/captcha/',
                'img_url'    => base_url('assets/captcha') . '/',
                'font_path'  => './assets/captcha/fonts/acmesa.TTF',
                'img_width'  => '216',
                'img_height' => '50',
                'expiration' => 7200
            );
            $cap = create_captcha($vals);
            $captcha_info = array(
                'captcha_time' => $cap['time'],
                'ip_address' => $this->input->ip_address(),
                'word' => $cap['word']
            );
            $this->captcha->insertarCaptcha($captcha_info);
            $data['cap'] = $cap;
            $this->load->view('public/contacto/contacto',$data);
        }else{
            $envio = $this->enviar_correo();
            $this->load->view('public/contacto/exito',$data);
        }
    }

    function captcha_check(){
        $expiration = time()-7200; // Limite de dos horas
        $binds = array ($this->input->post('captcha'),$this->input->ip_address(),$expiration);
        return $this->captcha->captchaExist($binds);
    }

    public function enviar_correo(){
        $remitente = $this->input->post('nombre',true);
        $email_rem = $this->input->post('email',true);
        $destino = $this->configuration->correo_admin;
        $estado = $this->input->post('estado', true);
        $localidad = $this->input->post('localidad',true);
        $mensaje = $this->input->post('mensaje',true);
        $contenido_mail ='
        <html>
        <head>
          <title>Nuevo mensaje!!</title>
        </head>
        <body>
        <p>Se ha recibido un nuevo correo de contacto de <?=$this->configuration->titulo?></p>
          <table>
            <tr>
              <td><b>Los datos recibidos son:</b><br></td>
            </tr>
            <tr>
                <td>Nombre: '.$remitente.'</td></tr>
                <tr>
                <td>Email: '.$email_rem.'</td></tr>
                <tr>
                <td>Estado: '.$estado.'</td></tr>
                <tr>
                <td>Localidad: '.$localidad.'</td></tr>
                <tr>    
              <td>Mensaje:<br />'.$mensaje.'</td>
            </tr>
          </table>
        </body>
        </html>';
        $this->load->library('email');
        $config['mailtype'] = 'html';
        $this->email->initialize($config);
        $this->email->from($email_rem, $remitente);
        $this->email->to($destino);
        $this->email->cc($this->configuration->emails_extra);
        
        $this->email->subject($this->input->post('asunto',true));
        $this->email->message($contenido_mail);
        
        if ($this->email->send()) {
            return true;
        }else{
            return false;
        }     
    }

    public function form_rules(){
        $rules = array(
            array(
                "field" => "nombre",
                "label" => "Nombre",
                "rules" => "required"
            ),
            array(
                "field" => "email",
                "label" => "Correo electrónico",
                "rules" => "required|valid_email"
            ),
            array(
                "field" => "estado",
                "label" => "Estado",
                "rules" => "required"
            ),
            array(
                "field" => "localidad",
                "label" => "Localidad",
                "rules" => "required"
            ),
            array(
                "field" => "mensaje",
                "label" => "Mensaje",
                "rules" => "required|min_length[10]"
            ),
        );
        return $rules;
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
        	$this->load->view("public/template/pagina_".$plantilla.".php" , $data);
    	}else{
    		$this->error_404();
    		return;
	   	}
    } // Fin funcion cargar

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

    public function eventos_fecha($fecha=''){
        $data['eventos'] = $this->eventos->dameEventosPorFecha($fecha);
        $data['fecha'] = $this->alinecms->dameFechaFormato($fecha);
        $this->load->view('public/eventos-modal',$data);
    }

} // Fin controlador Sesion

