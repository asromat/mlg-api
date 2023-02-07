<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Daerah_m extends CI_Model {
	
    public function getByDomain($domain)
	{
		$this->db->select('*');
        $this->db->from("tb_daerah");
        if ($domain != null){
            $this->db->where('domain',$domain);
        }
		$query = $this->db->get();
		return $query->result_array();
    }

}
