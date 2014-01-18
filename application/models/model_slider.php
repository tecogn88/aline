<?php
class Model_slider extends CI_Model {

    function __construct(){
        parent::__construct();
    }

    public function dameSlides(){
    	$query = $this->db->get("slider");
    	if($query->num_rows() > 0){
    		return $query->result();
    	}else{
    		return false;
    	}
    }

    public function dameSlide($id){
        $query = $this->db->get_where("slider", array('id' => $id));
        if ($query->num_rows()>0) {
            return $query->row();
        }else{
            return false;
        }
    }

    public function agregaSlide($data){
    	$this->db->insert('slider',$data);
    	return true;
    }

    public function eliminaSlide($id){
    	$this->db->where('id',$id);
    	$this->db->delete('slider');
    	return true;
    }

    public function actualizaSlide($id,$data){
        $this->db->where('id',$id);
        $this->db->update('slider', $data);
        return true;
    }

    public function get_slides_by_id($id=0){
        if($id == 0) return FALSE;
        $query = $this->db->get_where('slider', array('id' => $id), 1);
        return $query;
    }

    public function dameImagenSlide($id){
        $query = $this->db->get_where('slider', array('id' => $id));
        if ($query->num_rows()>0) {
            return $query->row('imagen');
        }else{
            return false;
        }
    }
}