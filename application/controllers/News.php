<?php
ob_start();
defined('BASEPATH') or exit('No direct script access allowed');

/*
    JTN News V1 API
    by Fitrah Izul Falaq
    https://ceo.bikinkarya.com
*/

use chriskacerguis\RestServer\RestController;

class News extends RestController
{

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('news_m');
    }

    public function index_get()
    {
        $this->response([
            'status' => false,
            'message' => 'Invalid Paramater. Read documentation'
        ], 404);
    }

    public function all_get()
    {
        $start = $this->get('start');
        $limit = $this->get('limit');

        if ($limit == null) {
            $limit = 7;
        }
        // if ($start == null) { $start = 1; }

        $data = $this->news_m->get($start, $limit);

        if ($data) {
            $this->response($data, 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'No news were found'
            ], 404);
        }
    }

    public function fokus_get()
    {
        $start = $this->get('start');
        $limit = $this->get('limit');

        if ($limit == null) {
            $limit = 7;
        }
        // if ($start == null) { $start = 1; }

        $data = $this->news_m->getFokus($start, $limit);

        if ($data) {
            $this->response($data, 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'No news were found'
            ], 404);
        }
    }

    // Mendapatkan data dari lokasi daerah
    // tabel si2_id
    public function location_get()
    {
        $start = $this->get('start');
        $limit = $this->get('limit');
        $location = $this->get('location');

        if ($limit == null) {
            $limit = 7;
        }
        // if ($start == null) { $start = 1; }

        $data = $this->news_m->getByLocation($start, $limit,$location);

        if ($data) {
            $this->response($data, 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'No news were found'
            ], 404);
        }
    }

    public function detail_get()
    {
        $id = $this->get('id');
        $data = $this->news_m->getDetail($id);

        if ($data) {
            $this->response($data, 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'News ID Not Found'
            ], 404);
        }
    }

    // Mendapatkan data dari kategori
    public function category_get()
    {
        //Cek ID dari Inputan Kanal
        $cat = urldecode($this->uri->segment(3));
        $cat_id = $this->news_m->categoryTitle($cat)->row("catnews_id");

        //Atur Start dan Limit
        $start = $this->get('start');
        $limit = $this->get('limit');

        if ($limit == null) {
            $limit = 7;
        }

        //Dapatkan data dari DB
        $data = $this->news_m->getBy("catnews_id", $cat_id, $start, $limit);

        if ($data) {
            $this->response($data, 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'News Category ID Not Found'
            ], 404);
        }
    }

    // Mendapatkan berita dari kategori yang sama
    public function sameCategory_get()
    {
        //Atur Start dan Limit
        $cat_id = $this->get('cat_id');
        $start = $this->get('start');
        $limit = $this->get('limit');

        if ($limit == null) {
            $limit = 7;
        }

        //Dapatkan data dari DB
        $data = $this->news_m->getRandomBy("catnews_id", $cat_id, $start, $limit);

        if ($data != null) {
            $this->response($data, 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'News Category ID Not Found'
            ], 200);
        }
    }

    public function similar_get()
    {
        //Atur Start dan Limit
        $keyword = $this->get('keyword');
        $category = $this->get('category');
        $start = $this->get('start');
        $limit = $this->get('limit');

        if ($limit == null) {
            $limit = 7;
        }

        //Dapatkan data dari DB
        $data = $this->news_m->getSimilar($keyword, $category, $start, $limit);

        if ($data != null) {
            $this->response($data, 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'News Category ID Not Found'
            ], 200);
        }
    }

    public function tag_get()
    {
        //Atur Start dan Limit
        $keyword = str_replace(["%20","-"],[" "," "],$this->get('keyword'));
        $start = $this->get('start');
        $limit = $this->get('limit');

        if ($limit == null) {
            $limit = 7;
        }

        //Dapatkan data dari DB
        $data = $this->news_m->getTag($keyword, $start, $limit);
        // var_dump($keyword);
        // die();

        if ($data != null) {
            $this->response($data, 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'News Tag Not Found'
            ], 200);
        }
    }

    public function headline_get()
    {
        $start = $this->get('start');
        $limit = $this->get('limit');

        if ($limit == null) {
            $limit = 7;
        }
        // if ($start == null) { $start = 1; }

        $data = $this->news_m->getBy("news_headline", "1", $start, $limit);

        if ($data) {
            $this->response($data, 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'No news were found'
            ], 404);
        }
    }

    public function optCategoryData_get()
    {
        // Mengambil Data Kategori
        // query -> catnews_id,catnews_slug
        // value -> value
         
        $data = $this->news_m->categoryData($this->get("query"),$this->get("value"));

        if ($data) {
            $this->response($data, 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'No news were found'
            ], 404);
        }
    }
}
