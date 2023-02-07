<?php
ob_start();
defined('BASEPATH') or exit('No direct script access allowed');

/*
    JTN News V1 API
    by Fitrah Izul Falaq
    https://ceo.bikinkarya.com
*/

use chriskacerguis\RestServer\RestController;

class Daerah extends RestController
{

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('daerah_m');
    }

    public function index_get()
    {
        $this->response([
            'status' => false,
            'message' => 'Invalid Paramater. Read documentation'
        ], 404);
    }

    public function domain_get()
    {
        $id = $this->get('domain');

        $data = $this->daerah_m->getByDomain($id);

        if ($data) {
            $this->response($data, 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Website Daerah Tidak Ditemukan'
            ], 404);
        }
    }

    
}
