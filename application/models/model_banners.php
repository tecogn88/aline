<?php
class Model_banners extends CI_Model {

    function __construct(){
        parent::__construct();
    }

	public function agrega_banner($imagen){
		/*$id_post = $this->input->post('id_post');*/
		$nombre = $this->input->post('nombre');
		/*$orden = $this->input->post('orden');*/
		/*$imagen = $this->input->post('imagen');*/
		/*$width = $this->input->post('width');
		$heigth = $this->input->post('heigth');*/
		$link = $this->input->post('link');
		$ubicacion = $this->input->post('ubicacion');
		/*$clicks = $this->input->post('clicks');*/
		/*$activo = $this->input->post('activo');*/
		$data = array(
			/*'id_post' => $id_post ,*/
			'nombre' => $nombre,
			/*'orden' => $orden,*/
			/*'width' => $width,
			'heigth' => $heigth,*/
			'imagen' => $imagen,
			'link' => $link,
			'ubicacion' => $ubicacion,
			/*'clicks' => $clicks,
			'activo' => $activo,*/
		);
		$this->db->insert('banners', $data);
		return $this->db->insert_id(); 
	}	

	public function get_banners(){
		$banners = $this->db->get('banners');
		if($banners->num_rows > 0){
			return $banners->result();
		}else{
			return FALSE;
		}
	}

	public function dameBanner($id){
		$this->db->where('id',$id);
		$query = $this->db->get('banners');
		if ($query->num_rows()>0) {
            return $query->row();
        }else{
            return false;
        }
	}

	public function dameImagenBanner($id){
        $query = $this->db->get_where('banners', array('id' => $id));
        if ($query->num_rows()>0) {
            return $query->row('imagen');
        }else{
            return false;
        }
    }

    public function subirImagenBanner($id,$data){
        $this->db->where('id',$id);
        $this->db->update('banners', $data);
        return true;
    }

} 	