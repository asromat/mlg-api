<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile_m extends CI_Model {
	
    public function getEditor($id = null)
	{
		$this->db->select('editor_id,editor_name');
        $this->db->from("db_editor");
        if ($id != null){
            $this->db->where('editor_id',$id);
        }
		$query = $this->db->get();
		return $query->result_array();
    }

}
