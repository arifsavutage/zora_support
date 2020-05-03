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

    function json_suplier()
    {
        $this->load->model('Suplier_model');
        $list = $this->Suplier_model->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $field) {
            $no++;
            $row = array(
                $no,
                $field->SUPLIER_NAME,
                $field->SUPLIER_ADDRESS,
                $field->SUPLIER_PHONE,
                "<a href='" . site_url('admin/master/suplier/edit/') . $field->ID . "' class='btn btn-warning mr-1'>Edit</a><a href='" . site_url('admin/master/suplier/del/') . $field->ID . "' class='btn btn-danger mr-1'>Delete</a>"
            );


            $data[] = $row;
        }

        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->Suplier_model->count_all(),
            "recordsFiltered" => $this->Suplier_model->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        header('Content-type: Application/json');
        echo json_encode($output);
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
                } else if ($para2 == 'add') {
                    $data_page = [
                        'page_title' => 'Suplier',
                        'card_name'  => 'Suplier Add',
                        'page'       => 'page/admin/module/suplier_add'
                    ];
                    $this->load->model('Suplier_model');
                    $this->load->library('form_validation');
                    $this->form_validation->set_rules('supliername', 'Nama Suplier', 'required');
                    $this->form_validation->set_rules('suplieraddress', 'Alamat Suplier', 'required');
                    $this->form_validation->set_rules('suplierphone', 'No. Telp', 'required');
                    if ($this->form_validation->run() == FALSE) {
                        // tetap disini
                        $data_page['page'] = 'page/admin/module/suplier_add';
                    } else {
                        // simpan ke db
                        $this->Suplier_model->addSuplier();
                        redirect('admin/master/suplier/list');
                    }
                } else if ($para2 == 'edit') {
                    $this->load->model('Suplier_model');
                    $id = $this->uri->segment(5);
                    $data_page = [
                        'page_title' => 'Suplier',
                        'card_name'  => 'Suplier Edit',
                        'page'       => 'page/admin/module/suplier_edit',
                        'suplier'    => $this->Suplier_model->getSuplierById($id)
                    ];
                    $this->load->library('form_validation');
                    $this->form_validation->set_rules('supliername', 'Nama Suplier', 'required');
                    $this->form_validation->set_rules('suplieraddress', 'Alamat Suplier', 'required');
                    $this->form_validation->set_rules('suplierphone', 'No. Telp', 'required');
                    if ($this->form_validation->run() == FALSE) {
                        // tetap disini
                        $data_page['page'] = 'page/admin/module/suplier_edit';
                    } else {
                        // simpan ke db
                        $this->Suplier_model->editSuplier();
                        redirect('admin/master/suplier/list');
                    }
                } else if ($para2 == 'del') {
                    $this->load->model('Suplier_model');
                    $id = $this->uri->segment(5);
                    $this->Suplier_model->delSuplier($id);
                    redirect('admin/master/suplier/list');
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
