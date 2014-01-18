<?php

class Model_usuarios extends CI_Model {

    function __construct()
    {
        parent::__construct();
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
	
	function borrar_usuario($id=0){
		if( $id != 0){
			$this->db->where('id', $id);
			$this->db->delete('usuarios');
		}
		return TRUE;
	}

	function dameAutores(){
		$this->db->select('usuarios.*');
		$this->db->from('usuarios');
		$this->db->join('post', 'post.id_autor = usuarios.id');
		$this->db->where_not_in('usuarios.perfil', 3);
		$this->db->distinct('usuarios.id');
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return false;
		}
	}

	function get_perfiles(){
		$strSql = "SELECT perfil,count(id) AS cantidad FROM usuarios GROUP BY perfil"; 
		$result = $this->db->query($strSql);
		return $result;
	}

	function inserta_usuario_nuevo($imagen){
			$nombre = $this->input->post('nombre', true);
			$apellidos = $this->input->post('apellidos', true);
			$usuario = $this->input->post('usuario', true);
			$pass = $this->input->post('password', true);
			$email = $this->input->post('email', true);
			$facebook = $this->input->post('facebook', true);
			$twitter = $this->input->post('twitter', true);
			$g_plus = $this->input->post('g_plus', true);
			$descripcion = $this->input->post('descripcion', true);
			$hobies = $this->input->post('hobies', true);
			$perfil = $this->input->post('perfil', true);

			$data = array(
				'nombre' => ucwords($nombre) ,
				'apellidos' => ucwords($apellidos) ,
				'usuario' => strtolower($usuario),
				'usuario' => $usuario ,
				'pass' => md5($pass) ,
				'descripcion' => $descripcion,
				'hobies' => $hobies,
				'imagen' => $imagen,
				'email' => $email ,
				'facebook' => $facebook,
				'twitter' => $twitter,
				'g_plus' => $g_plus,
				'perfil' => $perfil 
			);

			$this->db->insert('usuarios', $data); 
			return mysql_insert_id();
	}

	function actualiza_img($id=0,$imagen=false){
		$data = array();
		if($imagen != false){
			$data["imagen"] = $imagen;
		}
		$this->db->where("id", $id);
		$this->db->update("usuarios", $data);
		return true;
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

	function guarda_edicion_usuario(){
			$id = $this->input->post('id');
			$nombre = $this->input->post('nombre');
			$apellidos = $this->input->post('apellidos');
			$usuario = $this->input->post('usuario');
			$facebook = $this->input->post('facebook', true);
			$twitter = $this->input->post('twitter', true);
			$g_plus = $this->input->post('g_plus', true);
			$descripcion = $this->input->post('descripcion', true);
			$hobies = $this->input->post('hobies', true);
			
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
				'descripcion' => $descripcion,
				'hobies' => $hobies,
				'email' => $email ,
				'facebook' => $facebook,
				'twitter' => $twitter,
				'g_plus' => $g_plus,
				'perfil' => $perfil 
			);
			$this->db->where('id', $id);
			$this->db->update('usuarios', $data); 

	}

	/* **********************    Funcinoes par anicio de sesion *********************************** */
	function verifica_usuario(){
		$email = $this->input->post('email_login' ,TRUE);
		$pass = md5($this->input->post('pass_login' ,TRUE));
		$this->db->where('email',$email);
		$this->db->where('pass',$pass);
		$this->db->limit(1);
		$query = $this->db->get('usuarios');
		if( $query->num_rows() > 0){
			return $query;
		}else return FALSE;
	}

	function activar_usuario($datos){
		$data = array(
			'estado' => 1,
			'transaccion' => $datos['estado_pago'],
			'email_paypal' => $datos['email_paypal'],
			'txn_id' => $datos['txn_id'],
			'fecha_pago' => date('Y-m-d')
			);
    	$this->db->where('id', $datos['id_usuario']);
		$this->db->update('usuarios', $data);
		return true;
	}

	function fail_activar_usuario($datos){
		$data = array(
			'estado' => 0,
			'transaccion' => 'Failed',
			'email_paypal' => $datos['email_paypal'],
			'txn_id' => $datos['txn_id'],
			'fecha_pago' => $datos['fecha_pago']
			);
    	$this->db->where('id', $datos['id_usuario']);
		$this->db->update('usuarios', $data);
		return true;
	}

	function editar_usuario(){
		$data = array(
			'nombre' => $this->input->post('nombre', TRUE),
			'apellidos' => $this->input->post('apellidos', TRUE),
			'usuario' => $this->input->post('usuario', TRUE),
			'pass' => md5($this->input->post('password', TRUE)),
			'email' => $this->input->post('email',TRUE)
			);

		$this->db->where('id', $this->session->userdata('id'));
		$this->db->update('usuarios', $data);
		return true;
	}

	function consulta_usuario(){
		$this->db->where('id', $this->session->userdata('id'));
		$this->db->limit(1);
		$query = $this->db->get('usuarios');
		if( $query->num_rows() > 0){
			return $query;
		}else return FALSE;
	}

	public function dame_autores_blog(){
		$autores = $this->db->get('usuarios');
		if($autores->num_rows > 0){
			return $autores;
		}else{
			return FALSE;
		}
	}

}

/* End of file Model_usuarios.php */
/* Location: ./application/models/Model_usuarios.php */