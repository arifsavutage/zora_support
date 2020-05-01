<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function index()
    {
        $data_page  = [
            'page_title'    => 'Dashboard',
            'page'          => 'page/admin/admin_dashboard'
        ];
        $this->load->view('index', $data_page);
    }

    public function master($para1 = '', $para2 = '')
    {

        switch ($para1) {
            case 'suplier':

                if ($para2 == 'list') {
                    $data_page = [
                        'page_title' => 'Suplier',
                        'card_name'  => 'Suplier List',
                        'page'       => 'page/admin/module/suplier_list'
                    ];
                } else if ($para2 == 'edit') {
                    $data_page = [
                        'page_title' => 'Suplier',
                        'card_name'  => 'Suplier Add',
                        'page'       => 'page/admin/module/suplier_add'
                    ];
                }
                break;

            case 'marketing':
                if ($para2 == 'list') {
                    $data_page = [
                        'page_title' => 'Seller',
                        'card_name'  => 'Marketing List',
                        'page'       => 'page/admin/module/marketing_list'
                    ];
                }
                break;
        }

        $this->load->view('index', $data_page);
    }
}
