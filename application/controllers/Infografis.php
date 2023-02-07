<?php
ob_start();
defined('BASEPATH') or exit('No direct script access allowed');

/*
    JTN News V1 API
    by Fitrah Izul Falaq
    https://ceo.bikinkarya.com
*/

use chriskacerguis\RestServer\RestController;

class Infografis extends RestController
{

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('infografis_m');
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
            $limit = 10;
        }
        // if ($start == null) { $start = 1; }

        $data = $this->infografis_m->get($start, $limit);

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
