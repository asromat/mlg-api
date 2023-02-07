<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News_m extends CI_Model {
	
    public function get($start = null, $limit = null)
	{
		$this->db->select('hl_id,news_subtitle,focnews_id,news_wm,news_id,catnews_id,news_title,news_headline,news_title,news_caption,news_description,news_content,news_image_new,news_writer,news_datepub,tags_id,news_view');
        $this->db->from('db_news');
        $this->db->order_by('news_datepub','DESC');
		$this->db->limit($limit, $start);
		$query = $this->db->get();
		return $query->result_array();
    }

	public function getBy($kolom = null, $value = null, $start = null, $limit = null)
	{
		$this->db->select('hl_id,news_subtitle,focnews_id,news_wm,news_id,catnews_id,news_title,news_headline,news_title,news_caption,news_description, news_content,news_image_new,news_writer,tags_id,news_datepub,news_view');
        $this->db->from('db_news');
        $this->db->order_by('news_datepub','DESC');
		$this->db->limit($limit, $start);
		$this->db->where($kolom,$value);
		$query = $this->db->get();
		return $query->result_array();
    }

	public function getRandomBy($kolom = null, $value = null, $start = null, $limit = null)
	{
		$this->db->select('hl_id,news_subtitle,focnews_id,news_wm,news_id,catnews_id,news_title,news_headline,news_title,news_caption,news_description, news_content,news_image_new,news_writer,tags_id,news_datepub,news_view');
        $this->db->from('db_news');
        $this->db->order_by('news_datepub','RANDOM');
		$this->db->limit($limit, $start);
        $this->db->like('news_datepub',date("Y-m"));
		$this->db->where($kolom,$value);
		$query = $this->db->get();
		return $query->result_array();
    }
	
	public function getByLocation($start = null, $limit = null, $location = null)
	{
		$this->db->select('hl_id,news_subtitle,focnews_id,news_wm,news_id,catnews_id,news_title,news_headline,news_title,news_caption,news_description,news_content,news_image_new,news_writer,news_datepub,tags_id,news_view');
        $this->db->from('db_news');
        $this->db->order_by('news_datepub','DESC');
		$this->db->limit($limit, $start);
		$this->db->like('si2_id',$location);
		$query = $this->db->get();
		return $query->result_array();
    }

	public function getDetail($id)
	{
		$this->db->select('*');
        $this->db->from('db_news');
		$this->db->where("news_id", $id);
		$query = $this->db->get();
		return $query->result_array();
    }

    public function getSimilar($keyword = null, $category = null, $start = null, $limit = null)
	{
		$this->db->select('hl_id,news_subtitle,focnews_id,news_wm,news_id,catnews_id,news_title,news_headline,news_title,news_caption,news_description, news_content,news_image_new,news_writer,tags_id,news_datepub,news_view');
        $this->db->from('db_news');
        $this->db->order_by('news_datepub','RANDOM');
		$this->db->limit($limit, $start);
        $this->db->where('catnews_id',$category);
        $this->db->like('news_datepub',date("Y-m"));
		$this->db->like("news_title",$keyword,"both");
		$query = $this->db->get();
		return $query->result_array();
    }

	public function getTag($keyword = null, $start = null, $limit = null)
	{
		$this->db->select('hl_id,news_subtitle,focnews_id,news_wm,news_id,catnews_id,news_title,news_headline,news_title,news_caption,news_description, news_content,news_image_new,news_writer,tags_id,news_datepub,news_view');
        $this->db->from('db_news');
        $this->db->order_by('news_datepub','DESC');
		$this->db->limit($limit, $start);
        // $this->db->like('news_datepub',date("Y-m"));
		$this->db->like("news_title",$keyword,"match");
		$query = $this->db->get();
		return $query->result_array();
    }

    public function categoryTitle($cat = null)
	{
		$this->db->select('catnews_id,catnews_order,catnews_title,catnews_slug');
        $this->db->from('db_category_news');
		$this->db->where("catnews_title", $cat);
		$query = $this->db->get();
		return $query;
    }

    public function categoryData($query = null, $value = null)
	{
		$this->db->select('*');
        $this->db->from('db_category_news');
		$this->db->where($query, $value);
		$query = $this->db->get();
		return $query->result();
    }

}
