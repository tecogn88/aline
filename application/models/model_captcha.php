<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Model_captcha extends CI_Model{

	private $tabla_captcha = 'captcha';

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	function insertarCaptcha($data){
		$this->db->insert($this->tabla_captcha, $data);
		return true;
	}

	function deleteCaptcha($expiration){
		$this->db->where('captcha_time <',$expiration);
		$this->db->delete($this->tabla_captcha);
		return true;
	}

	function captchaExist($binds){
 		$sql = "SELECT COUNT(*) AS count FROM ".$this->tabla_captcha." WHERE word = ? AND ip_address = ? AND captcha_time > ?";
        $query = $this->db->query($sql, $binds);
        $row = $query->row();
 
        if ($row->count == 0)
            return FALSE;
        else
            return TRUE;
	}

}