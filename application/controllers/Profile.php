<?php
ob_start();
defined('BASEPATH') or exit('No direct script access allowed');

/*
    JTN News V1 API
    by Fitrah Izul Falaq
    https://ceo.bikinkarya.com
*/

use chriskacerguis\RestServer\RestController;

class Profile extends RestController
{

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('profile_m');
    }

    public function index_get()
    {
        $this->response([
            'status' => false,
            'message' => 'Invalid Paramater. Read documentation'
        ], 404);
    }

    public function editor_get()
    {
        $id = $this->get('id');

        $data = $this->profile_m->getEditor($id);

        if ($data) {
            $this->response($data, 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'No account were found'
            ], 404);
        }
    }

    
}
