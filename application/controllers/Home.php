<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

    public function index()
    {
        $data_page  = [
            'page_title'    => 'Dashboard',
            'page'          => 'page/admin/admin_dashboard'
        ];
        $this->load->view('index', $data_page);
    }
}
