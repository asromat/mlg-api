<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Infografis_m extends CI_Model {
	
    public function get($start = null, $limit = null)
	{
		$this->db->select('news_title,news_caption,infografis_url,url');
        $this->db->from('db_news');
        $this->db->order_by('news_datepub','DESC');
		$this->db->limit($limit, $start);
		$this->db->where("infografis","1");
		$query = $this->db->get();
		return $query->result_array();
    }

}
