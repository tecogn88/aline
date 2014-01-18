<?php

class Model_post extends CI_Model {

	var $tabla = "post";

    function __construct()
    {
        parent::__construct();
        $this->load->library('Configuration');
    }
	
	function get_posts($tipo = "1"){
		$strSql = " SELECT p.id as id_post,p.*,c.nombre as cnombre,c.slug as cslug,u.* 
					FROM post p 
					LEFT JOIN categoria c ON p.id_categoria = c.id
					LEFT JOIN usuarios u ON p.id_autor = u.id
					WHERE tipo = $tipo;";

		$articulos = $this->db->query($strSql);
		if($articulos->num_rows > 0){
			return $articulos;
		}else{
			return FALSE;
		}
	}
	
	public function dameCategoria($id=0){
		$query = $this->db->get_where('categoria', array('id' => $id));
		if($query->num_rows > 0){
			return $query->row();
		}else{
			return false;
		}
	}

	public function get_articulo_by_id($id=0){
		if($id == 0) return FALSE;
		$this->db->where('id', $id);
		$query = $this->db->get('post');
		return $query;
	}

	public function seleccionar_categorias($id = 0){
		if ($id == 0)
			$productos = $this->db->get('categoria');
		else
			$productos = $this->db->get_where('categoria', array('id' => $id), 1);
		if($productos->num_rows > 0)
			return $productos;
		else return FALSE;
	}

	public function dame_numPost($tipo = "1"){
		$this->db->where('tipo', $tipo);
		$this->db->from('post');
		return $this->db->count_all_results();
	}

	public function get_post($limit=0,$start=0,$paginacion=false,$tipo = "1"){
		if ($paginacion) {
			$this->db->where('tipo', $tipo);
			$this->db->limit($limit,$start);
			$this->db->order_by('titulo', 'asc');
		}
		$productos1 = $this->db->get('post');
		
		if($productos1->num_rows > 0){
			return $productos1->result();
		}else{
			return FALSE;
		}
	}

	public function get_post_by_slug($value=''){
		if(is_null($value)) return FALSE;
		$query = $this->db->get_where('post', array('slug' => $value ));
		if($query->num_rows > 0){
			// Si existe
			return FALSE;
		}else{
			// No existe
			return TRUE;
		}
	}

	public function dame_pagina_por_slug($value=''){
		if(is_null($value)) return FALSE;
		$query = $this->db->get_where('post', array('slug' => $value));
		if($query->num_rows > 0){
			return $query;
		}else{
			return FALSE;
		}
	}

	public function get_row_post_by_slug($value=''){
		if(is_null($value)) return FALSE;
		$query = $this->db->get_where('post', array('slug' => $value ));
		if($query->num_rows > 0){
			// Si existe
			return $query;
		}else{
			// No existe
			return TRUE;
		}
	}

	function get_categorias(){
		$this->db->where('id !=' , 2);
		$query = $this->db->get('categoria');
		return $query;
	}

	public function get_categorias1(){
		$categorias = $this->db->get('categoria');
		if($categorias->num_rows > 0){
			return $categorias;
		}else{
			return FALSE;
		}
	}	

	public function dameCategoriasPost(){
		$query = $this->db->get('categoria');
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return false;
		}
	}

	public function agrega_articulo($imagen=''){
		$id_autor = $this->input->post('autor');
		$id_categoria = $this->input->post('categoria');
		$titulo = $this->input->post('titulo');
		$slug = $this->input->post('slug');
		$contenido = $this->input->post('contenido');
		$fecha = date("y-m-d");
		$fecha_publicacion = $fecha;
		$fecha_despublicacion = $fecha;
		$estado = 1;
		$etiquetas = $this->input->post('etiquetas');
		$tipo = 1;
		$pag_inicio = $this->input->post('pag_inicio', true);
		$portafolio = $this->input->post('porta', true);
		$data = array(
			'id_autor' => $id_autor ,
			'id_categoria' => $id_categoria ,
			'titulo' => $titulo ,
			'slug' => $slug ,
			'contenido' => $contenido ,
			'fecha' => $fecha ,
			'fecha_publicacion' => $fecha_publicacion ,
			'fecha_despublicacion' => $fecha_despublicacion ,
			'estado' => $estado ,
			'etiquetas' => $etiquetas ,
			'tipo' => $tipo,
			'plantilla' => $this->configuration->plantilla,
			'pag_inicio' => $pag_inicio,
			'portafolio' => $portafolio,
			'imagen' => $imagen
		);
		$this->db->insert('post', $data); 
	}

	public function agrega_pagina(){
		$id_autor = $this->session->userdata('id');
		$id_categoria = $this->input->post('categoria');
		$titulo = $this->input->post('titulo');
		$slug = $this->input->post('slug');
		$contenido = $this->input->post('contenido');
		$fecha = date("y-m-d");
		$fecha_publicacion = $fecha;
		$fecha_despublicacion = "0000-00-00";
		$estado = 1;
		$etiquetas = $this->input->post('etiquetas');
		$tipo = 2;
		$plantilla = $this->input->post('plantilla');
		$clase_css = $this->input->post('clase_css');
		$data = array(
			'id_autor' => $id_autor ,
			'id_categoria' => $id_categoria ,
			'titulo' => $titulo ,
			'slug' => $slug ,
			'contenido' => $contenido ,
			'fecha' => $fecha ,
			'fecha_publicacion' => $fecha_publicacion ,
			'fecha_despublicacion' => $fecha_despublicacion ,
			'estado' => $estado ,
			'etiquetas' => $etiquetas ,
			'tipo' => $tipo,
			'plantilla' => $plantilla,
			'clase' => $clase_css
		);
		$this->db->insert('post', $data); 
	}

	public function agrega_categoria($imagen=''){
		$titulo = $this->input->post('titulo');
		$descripcion = $this->input->post('descripcion');
		$data = array(
			'nombre' => $titulo,
			'descripcion' => $descripcion,
			'imagen' => $imagen,
		);
		$this->db->insert('categoria', $data);
	}

	public function get_categoria_by_id($id=0){
		if($id == 0) return FALSE;
		$query = $this->db->get_where('categoria', array('id' => $id), 1);
		return $query;
	}

	public function actualiza_img_cat($id=0,$imagen=false){
		$data = array();
		if($imagen != false){
			$data["imagen"] = $imagen;
		}
		
		$this->db->where("id", $id);
		$this->db->update("categoria", $data);
		return true;
	}

	public function actualizar_cat($id){
		$id_categoria = $this->input->post('id_categoria');
		$titulo = $this->input->post('titulo');
		$descripcion = $this->input->post('descripcion');
		$data = array(
			'nombre' => $titulo ,
			'descripcion' => $descripcion,
		);
		$this->db->where('id',$id_categoria);
		$this->db->update('categoria',$data);
	}

	public function borrar_categoria($id=0){
		if($id == 0) return FALSE;
		$this->db->where('id', $id);
		$this->db->delete("categoria");
		return TRUE;
	}

	public function actualiza_pagina(){
		$id = $this->input->post('id');
		$id_autor = $this->session->userdata('id');
		$id_categoria = $this->input->post('categoria');
		$titulo = $this->input->post('titulo');
		$slug = $this->input->post('slug');
		$contenido = $this->input->post('contenido');
		$fecha = date("y-m-d");
		$fecha_publicacion = $fecha;
		$fecha_despublicacion = "0000-00-00";
		$estado = 1;
		$etiquetas = $this->input->post('etiquetas');
		$tipo = 2;
		$plantilla = $this->input->post('plantilla');
		$clase = $this->input->post('clase_css');
		$data = array(
			'id_autor' => $id_autor ,
			'titulo' => $titulo ,
			'slug' => $slug ,
			'contenido' => $contenido ,
			'fecha' => $fecha ,
			'fecha_publicacion' => $fecha_publicacion ,
			'fecha_despublicacion' => $fecha_despublicacion ,
			'etiquetas' => $etiquetas ,
			'plantilla' => $plantilla,
			'clase' => $clase
		);
		$this->db->where('id', $id);
		$this->db->update('post', $data); 
	}

	// FABIAN EDICION ARTICULOS BLOG

	public function actualiza_articulo($imagen=''){
		$id = $this->input->post('id');
		$id_autor = $this->input->post('id_autor');
		$id_categoria = $this->input->post('id_categoria');
		$titulo = $this->input->post('titulo');
		$slug = $this->input->post('slug');
		$contenido = $this->input->post('contenido');
		$fecha = date("y-m-d");
		$fecha_publicacion = $fecha;
		$fecha_despublicacion = "0000-00-00";
		$estado = 1;
		$etiquetas = $this->input->post('etiquetas');
		$tipo = 1;
		$pag_inicio = $this->input->post('pag_inicio', true);
		$data = array(
			'id_autor' => $id_autor ,
			'titulo' => $titulo ,
			'slug' => $slug ,
			'contenido' => $contenido ,
			'fecha' => $fecha ,
			'fecha_publicacion' => $fecha_publicacion ,
			'fecha_despublicacion' => $fecha_despublicacion ,
			'etiquetas' => $etiquetas ,
			'pag_inicio' => $pag_inicio,
			'id_categoria' =>$id_categoria,
			'imagen' => $imagen
		);
		$this->db->where('id', $id);
		$this->db->update('post', $data); 
	}

	// FIN EDICION ARTICULOS BLOG

	function get_post_by_id($id = 0){
		if($id == 0) return FALSE;
		$query = $this->db->get_where('post',array('id' => $id),1);
		if($query->num_rows == 0) return FALSE;
		return $query;
	}


	function get_usuarios($filtro = ''){
		$this->db->order_by('perfil'); 
		if($filtro != ''){
			// $filtro ==  [| 1 = Admin | 2 = Editor | 3 = Suscriptor |] 
			$this->db->where('perfil',$filtro);
		}
		$consulta = $this->db->get('usuarios');
		return $consulta;
	}
	
	function borrar_articulo($id=0){
		if( $id != 0){
			$this->db->where('id', $id);
			$this->db->delete($this->tabla);
		}
		return TRUE;
	}

	function get_perfiles(){
		$strSql = "SELECT perfil,count(id) AS cantidad FROM usuarios GROUP BY perfil"; 
		$result = $this->db->query($strSql);
		return $result;
	}

	function inserta_usuario_nuevo(){
			$nombre = $this->input->post('nombre');
			$apellidos = $this->input->post('apellidos');
			$usuario = $this->input->post('usuario');
			$pass = $this->input->post('pass');
			$email = $this->input->post('email');
			$perfil = $this->input->post('perfil');

			$data = array(
				'nombre' => ucwords($nombre) ,
				'apellidos' => ucwords($apellidos) ,
				'usuario' => strtolower($usuario),
				'usuario' => $usuario ,
				'pass' => md5($pass) ,
				'email' => $email ,
				'perfil' => $perfil 
			);

			$this->db->insert('usuarios', $data); 
	}

	function existe_usuario($tipo = ''){
		$usuario = $this->input->post('usuario');
		if($tipo != ""){
			$id = $this->input->post('id');
			$busca = $this->db->get_where('usuarios', array('id' => $id) , 1);
			$usr = $busca->row();
			$usr_old = $usr->usuario;
			$condiciones = array('usuario' => $usuario, 'usuario !=' => $usr_old);
		}else{
			$condiciones = array('usuario' => $usuario);
		}
		$query = $this->db->get_where('usuarios', $condiciones , 1);
		if( $query->num_rows() > 0) {
			return TRUE;
		}else{
			return FALSE;
		}
	}

	function existe_email($tipo = ''){
		$email = $this->input->post('email');
		if($tipo != ""){
			$id = $this->input->post('id');
			$busca = $this->db->get_where('usuarios', array('id' => $id) , 1);
			$usr = $busca->row();
			$mail_old = $usr->email;
			$condiciones = array('email' => $email, 'email !=' => $mail_old);
		}else{
			$condiciones = array('email' => $email);
		}
		$query = $this->db->get_where('usuarios', $condiciones ,  1);
		if( $query->num_rows() == 1) {
			return TRUE;
		}else{
			return FALSE;
		}
	}


	function get_usuario_by_id($id=0){
		if( ! $id == 0 ){
			$limit = 1;
			$query = $this->db->get_where('usuarios', array('id' => $id), $limit);
			return $query;
		}
	}

	function verifica_usuario(){
		$usuario = $this->input->post('usuario');
		$pass = md5($this->input->post('pass'));
	
		$this->db->where('usuario',$usuario);
		$this->db->where('pass',$pass);
		$this->db->limit(1);
		$query = $this->db->get('usuarios');
		
		if( $query->num_rows() > 0){
			return $query;
		}else return FALSE;
	}


	function guarda_edicion_usuario(){
			$id = $this->input->post('id');
			$nombre = $this->input->post('nombre');
			$apellidos = $this->input->post('apellidos');
			$usuario = $this->input->post('usuario');
			
			if( $this->input->post('new_pass') != ""){
				$pass = $this->input->post('new_pass');
				$pass = md5($pass);
			}else{
				$pass = $this->input->post('pass');
			}
			$email = $this->input->post('email');
			$perfil = $this->input->post('perfil');

			$data = array(
				'nombre' => ucwords($nombre) ,
				'apellidos' => ucwords($apellidos) ,
				'usuario' => strtolower($usuario),
				'usuario' => $usuario ,
				'pass' => $pass ,
				'email' => $email ,
				'perfil' => $perfil 
			);
			$this->db->where('id', $id);
			$this->db->update('usuarios', $data); 

	}

	public function dameImagen($id){
		$this->db->where('id',$id);
		$this->db->limit(1);
		$query = $this->db->get('post');
		if($query->num_rows() > 0){
			return $query->row('imagen');
		}else{
			return false;
		}
	}

	public function dameUltimosPostInicio(){
		$this->db->where(array('estado' => 1, 'tipo' => 1, 'pag_inicio' => 1));
		$this->db->order_by('id', 'desc');
		$limite = $this->configuration->no_articulos;
		$this->db->limit($limite);
		$query = $this->db->get('post');
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return false;
		}
	}

	public function insertaLog($id){
		$data = array(
			"id_pagina" => $id,
			"fecha" => date("y-m-d")
		);
		$this->db->insert("log_articulos",$data);
		return true;
	}

	public function dameArticulosMasLeidos(){
		$query = $this->db->query("select * from (select t.id_pagina, t.cantidad from (select id_pagina, count(id_pagina) as cantidad from log_articulos group by id_pagina) as t order by cantidad desc) as t left join post as p on p.id = t.id_pagina LIMIT 0, 4 ");
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return false;
		}
	}

	public function dameNombreCategoria($id){
		$this->db->where('id',$id);
		$this->db->limit(1);
		$query = $this->db->get('categoria');
		if($query->num_rows() > 0){
			return $query->row('nombre');
		}else{
			return false;
		}
	}

	public function dameNombreAutor($id){
		$this->db->where('id',$id);
		$query = $this->db->get('usuarios');
		if($query->num_rows() > 0){
			return $query->row('nombre');
		}else{
			return false;
		}
	}

	public function dameIdAutor($id){
		$this->db->where('id',$id);
		$query = $this->db->get('usuarios');
		if($query->num_rows() > 0){
			return $query->row('id');
		}else{
			return false;
		}
	}

	public function dameDatosAutor($id){
		if($id == 0) return FALSE;
		$this->db->where('id', $id);
		$query = $this->db->get('usuarios');
		return $query;
	}

	public function numeroArticulosBuscar($string){
		$this->db->like('titulo',$string);
		$this->db->or_like('contenido',$string);
		$this->db->from('post');
		return $this->db->count_all_results();
	}

	public function buscar($string,$limit,$start){
		$this->db->limit($limit,$start);
		$this->db->like('titulo',$string);
		$this->db->or_like('contenido',$string);
		$query = $this->db->get('post');
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return false;
		}
	}

	public function blog($limit = false, $start = false){
		if ($limit && $start) {
			$this->db->limit($limit,$start);
		}
		$this->db->select('post.*, usuarios.nombre as autor, categoria.nombre as categoria_nombre');
		$this->db->from('post');
		$this->db->join('categoria', 'categoria.id = post.id_categoria');
		$this->db->join('usuarios','usuarios.id = post.id_autor', 'left');
		$this->db->where(array('post.tipo' => 1));
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return false;
		}
	}

	public function blogCategoria($id,$limit,$start){
		/*$this->db->limit($limit,$start);*/
		$this->db->where(array('tipo' => 1,'id_categoria' => $id));
		$query = $this->db->get('post');
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return false;
		}
	}
	
	public function blogCategoriaArticulo($id){
		/*$this->db->limit($limit,$start);*/
		$this->db->where(array('tipo' => 1,'id_categoria' => $id));
		$query = $this->db->get('post');
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return false;
		}
	}

	public function damePostPortafolio(){
		$this->db->where(array('estado' => 1, 'tipo' => 1, 'portafolio' =>1));
		$this->db->order_by('id', 'desc');
		$this->db->limit(8);
		$query = $this->db->get('post');
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return false;
		}
	}

	public function dameMasRecientes(){
		$this->db->where(array('tipo' => 1));
		$this->db->order_by('id', 'desc');
		$limite = $this->configuration->no_recientes;
		$this->db->limit($limite);
    	$query = $this->db->get("post");
    	if($query->num_rows() > 0){
    		return $query->result();
    	}else{
    		return false;
    	}
    }

    public function damePublicacionesAutor($id){
    	$this->db->where('id_autor', $id);
    	$query = $this->db->get("post");
    	if($query->num_rows() > 0){
    		return $query->result();
    	}else{
    		return false;
    	}
    }

}

/* End of file Model_usuarios.php */
/* Location: ./application/models/Model_usuarios.php */