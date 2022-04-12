<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->library('cek_transaksi');

        not_login();
    }
    public function index()
    {
        if ($this->session->userdata('role') == 'superadmin') {
            $pages = 'page/admin/admin_dashboard';
        } else {
            $pages = 'page/admin/admin_dashboards';
        }

        $data_page  = [
            'page_title'    => 'Dashboard',
            'page'          => $pages
        ];
        $this->load->view('index', $data_page);
    }

    function getKabkota()
    {
        $this->load->model('Area_model');
        $provinsi = $this->input->post('provinsi', TRUE);
        $data = $this->Area_model->getCityByProvince($provinsi);
        header('Content-type: Application/json');
        echo json_encode($data);
    }

    function getKec()
    {
        $this->load->model('Area_model');
        $kabkota = $this->input->post('kabkota', TRUE);
        $data = $this->Area_model->getSubdistByCity($kabkota);
        header('Content-type: Application/json');
        echo json_encode($data);
    }

    function getCityById()
    {
        $this->load->model('Area_model');
        $kabkota = $this->input->post('kabkota', TRUE);
        $data = $this->Area_model->getCityById($kabkota);
        header('Content-type: Application/json');
        echo json_encode($data);
    }

    function getCityProvinceByAgenId()
    {
        $this->load->model('Agen_model');
        $this->load->model('Area_model');
        $id = $this->input->post('agenid');
        $this->db->select('marketing_agen.ID');
        $this->db->select('marketing_agen.AREA');
        $this->db->select('a_city.city_name');
        $this->db->select('a_city.type');
        $this->db->select('a_city.province_id');
        $this->db->from('marketing_agen');
        $this->db->join('a_city', 'a_city.id = marketing_agen.AREA', 'left');
        $this->db->where('marketing_agen.ID', $id);
        $data = $this->db->get()->row();
        $kec = $this->Area_model->getSubdistByCity($data->AREA);
        $data->areasubagen = $kec;
        header('Content-type: Application/json');
        echo json_encode($data);
    }

    public function master($para1 = '', $para2 = '')
    {

        switch ($para1) {
            case 'suplier':
                $this->load->model('Suplier_model');
                if ($para2 == 'list') {
                    $data_page = [
                        'page_title' => 'Suplier',
                        'card_name'  => 'Suplier List',
                        'page'       => 'page/admin/module/suplier_list',
                        'suplier'    => $this->Suplier_model->getAllSuplier()
                    ];
                } else if ($para2 == 'add') {
                    $data_page = [
                        'page_title' => 'Suplier',
                        'card_name'  => 'Suplier Add',
                        'page'       => 'page/admin/module/suplier_add'
                    ];
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
                    $id = $this->uri->segment(5);
                    $this->Suplier_model->delSuplier($id);
                    redirect('admin/master/suplier/list');
                }
                break;

            case 'marketing':
                $this->load->model('Marketing_model');
                if ($para2 == 'list') {
                    $data_page = [
                        'page_title' => 'Marketing',
                        'card_name'  => 'Marketing List',
                        'page'       => 'page/admin/module/marketing_list',
                        'marketing'    => $this->Marketing_model->getAllMarketing()
                    ];
                } else if ($para2 == 'add') {
                    $data_page = [
                        'page_title' => 'Marketing',
                        'card_name'  => 'Marketing Add',
                        'page'       => 'page/admin/module/marketing_add'
                    ];
                    $this->load->library('form_validation');
                    $this->form_validation->set_rules('ktpmarketing', 'No KTP', 'required|is_unique[marketing.ID_CARD]|exact_length[16]|numeric');
                    $this->form_validation->set_rules('marketingname', 'Nama Marketing', 'required');
                    $this->form_validation->set_rules('alamatmarketing', 'Alamat Marketing', 'required');
                    $this->form_validation->set_rules('telpmarketing', 'No. Telp', 'required');
                    if ($this->form_validation->run() == FALSE) {
                        // tetap disini
                        $data_page['page'] = 'page/admin/module/marketing_add';
                    } else {
                        // ambil data dari form post
                        $data = array(
                            "ID_CARD"           => $this->input->post('ktpmarketing', true),
                            "MARKETING_NAME"    => $this->input->post('marketingname', true),
                            "MARKETING_ADDRESS" => $this->input->post('alamatmarketing', true),
                            "MARKETING_PHONE"   => $this->input->post('telpmarketing', true),
                            "JOIN_DATE"         => date("Y-m-d")
                        );

                        $data_page['errors'] = '';
                        $this->load->library('upload');
                        if ($_FILES['fotoprofile']['error'] == 0) {
                            $data['PHOTO']         = 'M-FP' . $this->input->post('ktpmarketing', true) . '.jpg';
                            //set file upload settings 
                            $FP['upload_path']     = FCPATH . 'uploads/';
                            $FP['allowed_types']   = 'jpg';
                            $FP['max_size']        = 200;
                            $FP['overwrite']       = true;
                            $FP['file_name']       = $data['PHOTO'];

                            $this->upload->initialize($FP);
                            $this->upload->do_upload('fotoprofile');

                            $data_page['errors'] = $this->upload->display_errors();
                        }
                        if ($_FILES['fotoktp']['error'] == 0) {
                            $data['SCAN_ID']       = 'M-KTP' . $this->input->post('ktpmarketing', true) . '.jpg';
                            //set file upload settings 
                            $KTP['upload_path']    = FCPATH . 'uploads/';
                            $KTP['allowed_types']  = 'jpg';
                            $KTP['max_size']       = 200;
                            $KTP['overwrite']      = true;
                            $KTP['file_name']      = $data['SCAN_ID'];

                            $this->upload->initialize($KTP);
                            $this->upload->do_upload('fotoktp');

                            $data_page['errors'] = $this->upload->display_errors();
                        }
                        if ($data_page['errors'] == '') {
                            // simpan ke db
                            $this->Marketing_model->addMarketing($data);
                            redirect('admin/master/marketing/list');
                        }
                    }
                } else if ($para2 == 'edit') {
                    $id = $this->uri->segment(5);
                    $data_page = [
                        'page_title' => 'Marketing',
                        'card_name'  => 'Marketing Edit',
                        'page'       => 'page/admin/module/marketing_edit',
                        'marketing'    => $this->Marketing_model->getMarketingById($id)
                    ];
                    $this->load->library('form_validation');
                    // $this->form_validation->set_rules('ktpmarketing', 'No KTP', 'required|is_unique[marketing.ID_CARD]|exact_length[16]|numeric');
                    $this->form_validation->set_rules('marketingname', 'Nama Marketing', 'required');
                    $this->form_validation->set_rules('alamatmarketing', 'Alamat Marketing', 'required');
                    $this->form_validation->set_rules('telpmarketing', 'No. Telp', 'required');
                    if ($this->form_validation->run() == FALSE) {
                        // tetap disini
                        $data_page['page'] = 'page/admin/module/marketing_edit';
                    } else {
                        // ambil data dari form post
                        $data = array(
                            "ID"                => $this->input->post('id', true),
                            "MARKETING_NAME"    => $this->input->post('marketingname', true),
                            "MARKETING_ADDRESS" => $this->input->post('alamatmarketing', true),
                            "MARKETING_PHONE"   => $this->input->post('telpmarketing', true)
                        );
                        $data_page['errors'] = '';
                        $this->load->library('upload');
                        if ($_FILES['fotoprofile']['error'] == 0) {
                            $data['PHOTO']         = 'M-FP' . $this->input->post('ktpmarketing', true) . '.jpg';
                            //set file upload settings 
                            $FP['upload_path']     = FCPATH . 'uploads/';
                            $FP['allowed_types']   = 'jpg';
                            $FP['max_size']        = 200;
                            $FP['overwrite']       = true;
                            $FP['file_name']       = $data['PHOTO'];

                            $this->upload->initialize($FP);
                            $this->upload->do_upload('fotoprofile');

                            $data_page['errors'] = $this->upload->display_errors();
                        }
                        if ($_FILES['fotoktp']['error'] == 0) {
                            $data['SCAN_ID']       = 'M-KTP' . $this->input->post('ktpmarketing', true) . '.jpg';
                            //set file upload settings 
                            $KTP['upload_path']    = FCPATH . 'uploads/';
                            $KTP['allowed_types']  = 'jpg';
                            $KTP['max_size']       = 200;
                            $KTP['overwrite']      = true;
                            $KTP['file_name']      = $data['SCAN_ID'];

                            $this->upload->initialize($KTP);
                            $this->upload->do_upload('fotoktp');

                            $data_page['errors'] = $this->upload->display_errors();
                        }
                        if ($data_page['errors'] == '') {
                            // simpan ke db
                            $this->Marketing_model->editMarketing($data);
                            redirect('admin/master/marketing/list');
                        }
                    }
                } else if ($para2 == 'del') {
                    $id = $this->uri->segment(5);
                    $this->Marketing_model->delMarketing($id);
                    redirect('admin/master/marketing/list');
                } else if ($para2 == 'detail') {
                    $id = $this->uri->segment(5);
                    $marketing = $this->Marketing_model->getMarketingById($id);
                    echo json_encode($marketing);
                    exit();
                }
                break;
            case 'agen':
                $this->load->model('Agen_model');
                $this->load->model('Marketing_model');
                $this->load->model('Area_model');

                $data_page['agen']['marketing'] = '';
                if ($para2 == 'list') {
                    $data_page = [
                        'page_title' => 'Agen',
                        'card_name'  => 'Agen List',
                        'page'       => 'page/admin/module/agen_list',
                        'agen'       => $this->Agen_model->getAllAgen()
                    ];
                } else if ($para2 == 'add') {
                    $data_page = [
                        'page_title' => 'Agen',
                        'card_name'  => 'Agen Add',
                        'page'       => 'page/admin/module/agen_add',
                        'marketing'  => $this->Marketing_model->getAllMarketing(),
                        'provinsi'   => $this->Area_model->getAllProvince()
                    ];
                    $this->load->library('form_validation');
                    $this->form_validation->set_rules('ktpagen', 'No KTP', 'required|is_unique[marketing_agen.ID_CARD]|exact_length[16]|numeric');
                    $this->form_validation->set_rules('namaagen', 'Nama Agen', 'required');
                    $this->form_validation->set_rules('alamatagen', 'Alamat Agen', 'required');
                    $this->form_validation->set_rules('telpagen', 'No. Telp', 'required');
                    $this->form_validation->set_rules('kabkota', 'Area Agen', 'required|is_unique[marketing_agen.AREA]');
                    $this->form_validation->set_rules('marketingid', 'Marketing', 'required');
                    if ($this->form_validation->run() == FALSE) {
                        // tetap disini
                        $data_page['page'] = 'page/admin/module/agen_add';
                    } else {
                        $data = array(
                            "ID_CARD"       => $this->input->post('ktpagen', true),
                            "AGEN_NAME"     => $this->input->post('namaagen', true),
                            "AGEN_ADDRESS"  => $this->input->post('alamatagen', true),
                            "AGEN_PHONE"    => $this->input->post('telpagen', true),
                            "AREA"          => $this->input->post('kabkota', true),
                            "MARKETING_ID"  => $this->input->post('marketingid', true),
                            "JOIN_DATE"     => date("Y-m-d")
                        );
                        $data_page['errors'] = '';
                        $this->load->library('upload');
                        if ($_FILES['fotoprofile']['error'] == 0) {
                            $data['PHOTO']         = 'A-FP' . $this->input->post('ktpagen', true) . '.jpg';
                            //set file upload settings 
                            $FP['upload_path']     = FCPATH . 'uploads/';
                            $FP['allowed_types']   = 'jpg';
                            $FP['max_size']        = 200;
                            $FP['overwrite']       = true;
                            $FP['file_name']       = $data['PHOTO'];

                            $this->upload->initialize($FP);
                            $this->upload->do_upload('fotoprofile');

                            $data_page['errors'] = $this->upload->display_errors();
                        }
                        if ($_FILES['fotoktp']['error'] == 0) {
                            $data['SCAN_ID_CARD']   = 'A-KTP' . $this->input->post('ktpagen', true) . '.jpg';
                            //set file upload settings 
                            $KTP['upload_path']     = FCPATH . 'uploads/';
                            $KTP['allowed_types']   = 'jpg';
                            $KTP['max_size']        = 200;
                            $KTP['overwrite']       = true;
                            $KTP['file_name']       = $data['SCAN_ID_CARD'];

                            $this->upload->initialize($KTP);
                            $this->upload->do_upload('fotoktp');

                            $data_page['errors'] = $this->upload->display_errors();
                        }
                        if ($data_page['errors'] == '') {
                            // simpan ke db
                            $this->Agen_model->addAgen($data);
                            redirect('admin/master/agen/list');
                        }
                    }
                } else if ($para2 == 'edit') {
                    $id = $this->uri->segment(5);
                    $data_page = [
                        'page_title' => 'Agen',
                        'card_name'  => 'Agen Edit',
                        'page'       => 'page/admin/module/agen_edit',
                        'agen'       => $this->Agen_model->getAgenById($id),
                        'marketing'  => $this->Marketing_model->getAllMarketing(),
                        'provinsi'   => $this->Area_model->getAllProvince()
                    ];

                    $data_page['area'] = $this->Area_model->getCityById($data_page['agen']->AREA);
                    $data_page['kabkota'] = $this->Area_model->getCityByProvince($data_page['area']->province_id);

                    $this->load->library('form_validation');
                    $this->form_validation->set_rules('namaagen', 'Nama Agen', 'required');
                    $this->form_validation->set_rules('alamatagen', 'Alamat Agen', 'required');
                    $this->form_validation->set_rules('telpagen', 'No. Telp', 'required');
                    $this->form_validation->set_rules('kabkota', 'Area Agen', 'required');
                    $this->form_validation->set_rules('marketingid', 'Marketing', 'required');
                    if ($this->form_validation->run() == FALSE) {
                        // tetap disini
                        $data_page['page'] = 'page/admin/module/agen_edit';
                    } else {
                        $data = array(
                            "ID"            => $this->input->post('id', true),
                            "AGEN_NAME"     => $this->input->post('namaagen', true),
                            "AGEN_ADDRESS"  => $this->input->post('alamatagen', true),
                            "AGEN_PHONE"    => $this->input->post('telpagen', true),
                            "AREA"          => $this->input->post('kabkota', true),
                            "MARKETING_ID"  => $this->input->post('marketingid', true)
                        );
                        $data_page['errors'] = '';
                        $this->load->library('upload');
                        if ($_FILES['fotoprofile']['error'] == 0) {
                            $data['PHOTO']         = 'A-FP' . $this->input->post('ktpagen', true) . '.jpg';
                            //set file upload settings 
                            $FP['upload_path']     = FCPATH . 'uploads/';
                            $FP['allowed_types']   = 'jpg';
                            $FP['max_size']        = 200;
                            $FP['overwrite']       = true;
                            $FP['file_name']       = $data['PHOTO'];

                            $this->upload->initialize($FP);
                            $this->upload->do_upload('fotoprofile');

                            $data_page['errors'] = $this->upload->display_errors();
                        }
                        if ($_FILES['fotoktp']['error'] == 0) {
                            $data['SCAN_ID_CARD']   = 'A-KTP' . $this->input->post('ktpagen', true) . '.jpg';
                            //set file upload settings 
                            $KTP['upload_path']     = FCPATH . 'uploads/';
                            $KTP['allowed_types']   = 'jpg';
                            $KTP['max_size']        = 200;
                            $KTP['overwrite']       = true;
                            $KTP['file_name']       = $data['SCAN_ID_CARD'];

                            $this->upload->initialize($KTP);
                            $this->upload->do_upload('fotoktp');

                            $data_page['errors'] = $this->upload->display_errors();
                        }
                        if ($data_page['errors'] == '') {
                            // simpan ke db
                            $this->Agen_model->editAgen($data);
                            redirect('admin/master/agen/list');
                        }
                    }
                } else if ($para2 == 'del') {
                    $id = $this->uri->segment(5);
                    $this->Agen_model->delAgen($id);
                    redirect('admin/master/agen/list');
                } else if ($para2 == 'detail') {
                    $id = $this->uri->segment(5);
                    $agen = $this->Agen_model->getAgenById($id);
                    echo json_encode($agen);
                    exit();
                }
                break;
            case 'subagen':
                $this->load->model('SubAgen_model');
                $this->load->model('Agen_model');
                $this->load->model('Area_model');
                $data_page['agen']['marketing'] = '';
                if ($para2 == 'list') {
                    $data_page = [
                        'page_title' => 'Sub Agen',
                        'card_name'  => 'Sub Agen List',
                        'page'       => 'page/admin/module/subagen_list',
                        'subagen'    => $this->SubAgen_model->getAllSubAgen()
                    ];
                } else if ($para2 == 'add') {
                    $data_page = [
                        'page_title' => 'Sub Agen',
                        'card_name'  => 'Sub Agen Add',
                        'page'       => 'page/admin/module/subagen_add',
                        'agen'       => $this->Agen_model->getAllAgen(),
                        'provinsi'   => $this->Area_model->getAllProvince()
                    ];
                    $this->load->library('form_validation');
                    $this->form_validation->set_rules('agenid', 'Agen', 'required');
                    $this->form_validation->set_rules('ktpsubagen', 'No KTP', 'required|is_unique[marketing_subagen.ID_CARD]|exact_length[16]|numeric');
                    $this->form_validation->set_rules('namasubagen', 'Nama Agen', 'required');
                    $this->form_validation->set_rules('alamatsubagen', 'Alamat Agen', 'required');
                    $this->form_validation->set_rules('telpsubagen', 'No. Telp', 'required');
                    $this->form_validation->set_rules('areasubagen', 'Area Agen', 'required|is_unique[marketing_subagen.AREA]');
                    if ($this->form_validation->run() == FALSE) {
                        // tetap disini
                        $data_page['page'] = 'page/admin/module/subagen_add';
                    } else {
                        $data = array(
                            "AGEN_ID"         => $this->input->post('agenid', true),
                            "ID_CARD"         => $this->input->post('ktpsubagen', true),
                            "SUBAGEN_NAME"    => $this->input->post('namasubagen', true),
                            "SUBAGEN_ADDRESS" => $this->input->post('alamatsubagen', true),
                            "SUBAGEN_PHONE"   => $this->input->post('telpsubagen', true),
                            "AREA"            => $this->input->post('areasubagen', true),
                            "JOIN_DATE"       => date("Y-m-d")
                        );

                        $data_page['errors'] = '';
                        $this->load->library('upload');
                        if ($_FILES['fotoprofile']['error'] == 0) {
                            $data['PHOTO']         = 'S-FP' . $this->input->post('ktpsubagen', true) . '.jpg';
                            //set file upload settings 
                            $FP['upload_path']     = FCPATH . 'uploads/';
                            $FP['allowed_types']   = 'jpg';
                            $FP['max_size']        = 200;
                            $FP['overwrite']       = true;
                            $FP['file_name']       = $data['PHOTO'];

                            $this->upload->initialize($FP);
                            $this->upload->do_upload('fotoprofile');

                            $data_page['errors'] = $this->upload->display_errors();
                        }
                        if ($_FILES['fotoktp']['error'] == 0) {
                            $data['SCAN_ID_CARD']   = 'S-KTP' . $this->input->post('ktpsubagen', true) . '.jpg';
                            //set file upload settings 
                            $KTP['upload_path']     = FCPATH . 'uploads/';
                            $KTP['allowed_types']   = 'jpg';
                            $KTP['max_size']        = 200;
                            $KTP['overwrite']       = true;
                            $KTP['file_name']       = $data['SCAN_ID_CARD'];

                            $this->upload->initialize($KTP);
                            $this->upload->do_upload('fotoktp');

                            $data_page['errors'] = $this->upload->display_errors();
                        }
                        if ($data_page['errors'] == '') {
                            // simpan ke db
                            $this->SubAgen_model->addSubAgen($data);
                            redirect('admin/master/subagen/list');
                        }
                    }
                } else if ($para2 == 'edit') {
                    $id = $this->uri->segment(5);
                    $data_page = [
                        'page_title' => 'Sub Agen',
                        'card_name'  => 'Sub Agen Edit',
                        'page'       => 'page/admin/module/subagen_edit',
                        'subagen'    => $this->SubAgen_model->getSubAgenById($id),
                        'agen'       => $this->Agen_model->getAllAgen(),
                        'provinsi'   => $this->Area_model->getAllProvince()
                    ];

                    $data_page['area'] = $this->Area_model->getSubdistById($data_page['subagen']->AREA);
                    $data_page['kabkota'] = $this->Area_model->getCityByProvince($data_page['area']->province_id);
                    $data_page['areasubagen'] = $this->Area_model->getSubdistByCity($data_page['area']->city_id);

                    $this->load->library('form_validation');
                    $this->form_validation->set_rules('agenid', 'Agen', 'required');
                    // $this->form_validation->set_rules('ktpsubagen', 'No KTP', 'required|is_unique[marketing_subagen.ID_CARD]|exact_length[16]|numeric');
                    $this->form_validation->set_rules('namasubagen', 'Nama Agen', 'required');
                    $this->form_validation->set_rules('alamatsubagen', 'Alamat Agen', 'required');
                    $this->form_validation->set_rules('telpsubagen', 'No. Telp', 'required');
                    $this->form_validation->set_rules('areasubagen', 'Area Agen', 'required');
                    if ($this->form_validation->run() == FALSE) {
                        // tetap disini
                        $data_page['page'] = 'page/admin/module/subagen_edit';
                    } else {
                        $data = array(
                            "ID"              => $this->input->post('id', true),
                            "AGEN_ID"         => $this->input->post('agenid', true),
                            "SUBAGEN_NAME"    => $this->input->post('namasubagen', true),
                            "SUBAGEN_ADDRESS" => $this->input->post('alamatsubagen', true),
                            "SUBAGEN_PHONE"   => $this->input->post('telpsubagen', true),
                            "AREA"            => $this->input->post('areasubagen', true)
                        );
                        $data_page['errors'] = '';
                        $this->load->library('upload');
                        if ($_FILES['fotoprofile']['error'] == 0) {
                            $data['PHOTO']         = 'S-FP' . $this->input->post('ktpsubagen', true) . '.jpg';
                            //set file upload settings 
                            $FP['upload_path']     = FCPATH . 'uploads/';
                            $FP['allowed_types']   = 'jpg';
                            $FP['max_size']        = 200;
                            $FP['overwrite']       = true;
                            $FP['file_name']       = $data['PHOTO'];

                            $this->upload->initialize($FP);
                            $this->upload->do_upload('fotoprofile');

                            $data_page['errors'] = $this->upload->display_errors();
                        }
                        if ($_FILES['fotoktp']['error'] == 0) {
                            $data['SCAN_ID_CARD']   = 'S-KTP' . $this->input->post('ktpsubagen', true) . '.jpg';
                            //set file upload settings 
                            $KTP['upload_path']     = FCPATH . 'uploads/';
                            $KTP['allowed_types']   = 'jpg';
                            $KTP['max_size']        = 200;
                            $KTP['overwrite']       = true;
                            $KTP['file_name']       = $data['SCAN_ID_CARD'];

                            $this->upload->initialize($KTP);
                            $this->upload->do_upload('fotoktp');

                            $data_page['errors'] = $this->upload->display_errors();
                        }
                        if ($data_page['errors'] == '') {
                            // simpan ke db
                            $this->SubAgen_model->editSubAgen($data);
                            redirect('admin/master/subagen/list');
                        }
                    }
                } else if ($para2 == 'del') {
                    $id = $this->uri->segment(5);
                    $this->SubAgen_model->delSubAgen($id);
                    redirect('admin/master/subagen/list');
                } else if ($para2 == 'detail') {
                    $id = $this->uri->segment(5);
                    $subagen = $this->SubAgen_model->getSubAgenById($id);
                    echo json_encode($subagen);
                    exit();
                }
                break;
            case 'apotik':
                $this->load->model('Apotik_model');
                $this->load->model('Marketing_model');
                if ($para2 == 'list') {
                    $data_page = [
                        'page_title' => 'Apotik',
                        'card_name'  => 'Apotik List',
                        'page'       => 'page/admin/module/apotik_list',
                        'apotik'     => $this->Apotik_model->getAllApotik()
                    ];
                } else if ($para2 == 'add') {
                    $data_page = [
                        'page_title' => 'Apotik',
                        'card_name'  => 'Apotik Add',
                        'page'       => 'page/admin/module/apotik_add',
                        'marketing'  => $this->Marketing_model->getAllMarketing()
                    ];
                    $this->load->library('form_validation');
                    $this->form_validation->set_rules('marketingid', 'Marketing', 'required');
                    $this->form_validation->set_rules('namaapotik', 'Nama Apotik', 'required');
                    $this->form_validation->set_rules('dokterpraktek', 'Dokter Praktek', 'required');
                    $this->form_validation->set_rules('apoteker', 'Apoteker', 'required');
                    $this->form_validation->set_rules('alamatapotik', 'Alamat Apotik', 'required');
                    $this->form_validation->set_rules('telp', 'No telp', 'required');
                    $this->form_validation->set_rules('hp', 'No HP', 'required');
                    $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
                    if ($this->form_validation->run() == FALSE) {
                        // tetap disini
                        $data_page['page'] = 'page/admin/module/apotik_add';
                    } else {
                        // ambil data dari form post
                        $data = array(
                            "MARKETING_ID"      => $this->input->post('marketingid', true),
                            "APOTIK_NAME"       => $this->input->post('namaapotik', true),
                            "DOKTER_PRAKTEK"    => $this->input->post('dokterpraktek', true),
                            "APOTEKER_NAME"     => $this->input->post('apoteker', true),
                            "APOTIK_ADDRESS"    => $this->input->post('alamatapotik', true),
                            "APOTIK_PHONE"      => $this->input->post('telp', true),
                            "APOTIK_MOBILE"     => $this->input->post('hp', true),
                            "APOTIK_EMAIL"      => $this->input->post('email', true)
                        );
                        // simpan ke db
                        $this->Apotik_model->addApotik($data);
                        redirect('admin/master/apotik/list');
                    }
                } else if ($para2 == 'edit') {
                    $id = $this->uri->segment(5);
                    $data_page = [
                        'page_title' => 'Apotik',
                        'card_name'  => 'Apotik Edit',
                        'page'       => 'page/admin/module/apotik_edit',
                        'apotik'     => $this->Apotik_model->getApotikById($id),
                        'marketing'  => $this->Marketing_model->getAllMarketing()
                    ];
                    $this->load->library('form_validation');
                    $this->form_validation->set_rules('marketingid', 'Marketing', 'required');
                    $this->form_validation->set_rules('namaapotik', 'Nama Apotik', 'required');
                    $this->form_validation->set_rules('dokterpraktek', 'Dokter Praktek', 'required');
                    $this->form_validation->set_rules('apoteker', 'Apoteker', 'required');
                    $this->form_validation->set_rules('alamatapotik', 'Alamat Apotik', 'required');
                    $this->form_validation->set_rules('telp', 'No telp', 'required');
                    $this->form_validation->set_rules('hp', 'No HP', 'required');
                    $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
                    if ($this->form_validation->run() == FALSE) {
                        // tetap disini
                        $data_page['page'] = 'page/admin/module/apotik_edit';
                    } else {
                        // ambil data dari form post
                        $data = array(
                            "ID"                => $this->input->post('id', true),
                            "MARKETING_ID"      => $this->input->post('marketingid', true),
                            "APOTIK_NAME"       => $this->input->post('namaapotik', true),
                            "DOKTER_PRAKTEK"    => $this->input->post('dokterpraktek', true),
                            "APOTEKER_NAME"     => $this->input->post('apoteker', true),
                            "APOTIK_ADDRESS"    => $this->input->post('alamatapotik', true),
                            "APOTIK_PHONE"      => $this->input->post('telp', true),
                            "APOTIK_MOBILE"     => $this->input->post('hp', true),
                            "APOTIK_EMAIL"      => $this->input->post('email', true)
                        );
                        // simpan ke db
                        $this->Apotik_model->editApotik($data);
                        redirect('admin/master/apotik/list');
                    }
                } else if ($para2 == 'del') {
                    $id = $this->uri->segment(5);
                    $this->Apotik_model->delApotik($id);
                    redirect('admin/master/apotik/list');
                }
                break;
            case 'kategori':
                $this->load->model('Kategori_model');
                if ($para2 == 'list') {
                    $data_page = [
                        'page_title' => 'Kategori Produk',
                        'card_name'  => 'Kategori Produk List',
                        'page'       => 'page/admin/module/kategori_list',
                        'kategori'   => $this->Kategori_model->getAllKategori()
                    ];
                } else if ($para2 == 'add') {
                    $data_page = [
                        'page_title' => 'Kategori',
                        'card_name'  => 'Kategori Add',
                        'page'       => 'page/admin/module/kategori_add'
                    ];
                    $this->load->library('form_validation');
                    $this->form_validation->set_rules('kategoriname', 'Nama Kategori', 'required|is_unique[product_category.CATEGORY_NAME]');
                    if ($this->form_validation->run() == FALSE) {
                        // tetap disini
                        $data_page['page'] = 'page/admin/module/kategori_add';
                    } else {
                        // simpan ke db
                        $this->Kategori_model->addKategori();
                        redirect('admin/master/kategori/list');
                    }
                } else if ($para2 == 'edit') {
                    $id = $this->uri->segment(5);
                    $data_page = [
                        'page_title' => 'Kategori',
                        'card_name'  => 'Kategori Edit',
                        'page'       => 'page/admin/module/kategori_edit',
                        'kategori'   => $this->Kategori_model->getKategoriById($id)
                    ];
                    $this->load->library('form_validation');
                    $this->form_validation->set_rules('kategoriname', 'Nama Kategori', 'required|is_unique[product_category.CATEGORY_NAME]');
                    if ($this->form_validation->run() == FALSE) {
                        // tetap disini
                        $data_page['page'] = 'page/admin/module/kategori_edit';
                    } else {
                        // simpan ke db
                        $this->Kategori_model->editKategori();
                        redirect('admin/master/kategori/list');
                    }
                } else if ($para2 == 'del') {
                    $id = $this->uri->segment(5);
                    $this->Kategori_model->delKategori($id);
                    redirect('admin/master/kategori/list');
                }
                break;
            case 'produk':
                $this->load->model('Produk_model');
                $this->load->model('Kategori_model');
                if ($para2 == 'list') {
                    $data_page = [
                        'page_title' => 'Produk',
                        'card_name'  => 'Produk List',
                        'page'       => 'page/admin/module/produk_list',
                        'produk'     => $this->Produk_model->getAllProduk()
                    ];
                    foreach ($data_page['produk'] as $p) {
                        $p->CAT_ID = $this->Kategori_model->getKategoriById($p->CAT_ID)->CATEGORY_NAME;
                    }
                } else if ($para2 == 'add') {
                    $data_page = [
                        'page_title' => 'Produk',
                        'card_name'  => 'Produk Add',
                        'page'       => 'page/admin/module/produk_add',
                        'kategori'   => $this->Kategori_model->getAllKategori()
                    ];
                    $this->load->library('form_validation');
                    $this->form_validation->set_rules('kategoriid', 'Kategori Produk', 'required');
                    $this->form_validation->set_rules('productname', 'nama Produk', 'required');
                    $this->form_validation->set_rules('sellprice', 'Harga Jual', 'required|numeric');
                    $this->form_validation->set_rules('stock', 'Stock', 'required|numeric');
                    $this->form_validation->set_rules('stocklimit', 'Stock Limit', 'required|numeric');
                    if ($this->form_validation->run() == FALSE) {
                        // tetap disini
                        $data_page['page'] = 'page/admin/module/produk_add';
                    } else {
                        // simpan ke db
                        $this->Produk_model->addProduk();
                        redirect('admin/master/produk/list');
                    }
                } else if ($para2 == 'edit') {
                    $id = $this->uri->segment(5);
                    $data_page = [
                        'page_title' => 'Produk',
                        'card_name'  => 'Produk Edit',
                        'page'       => 'page/admin/module/produk_edit',
                        'product'    => $this->Produk_model->getProdukById($id),
                        'kategori'   => $this->Kategori_model->getAllKategori()
                    ];
                    $this->load->library('form_validation');
                    $this->form_validation->set_rules('kategoriid', 'Kategori Produk', 'required');
                    $this->form_validation->set_rules('productname', 'nama Produk', 'required');
                    $this->form_validation->set_rules('sellprice', 'Harga Jual', 'required|numeric');
                    $this->form_validation->set_rules('stock', 'Stock', 'required|numeric');
                    $this->form_validation->set_rules('stocklimit', 'Stock Limit', 'required|numeric');
                    if ($this->form_validation->run() == FALSE) {
                        // tetap disini
                        $data_page['page'] = 'page/admin/module/produk_edit';
                    } else {
                        // simpan ke db
                        $this->Produk_model->editProduk();
                        redirect('admin/master/produk/list');
                    }
                } else if ($para2 == 'del') {
                    $id = $this->uri->segment(5);
                    $this->Produk_model->delProduk($id);
                    redirect('admin/master/produk/list');
                }
                break;
            case 'purchasing':
                $this->load->model('purchase_model');
                $this->load->model('suplier_model');
                $this->load->model('produk_model');

                if ($para2 == 'list') {
                    $data_page = [
                        'page_title' => 'Pemesanan',
                        'card_name'  => 'Pemesanan Produk',
                        'purchase'   => $this->purchase_model->getAll(),
                        'page'       => 'page/admin/module/purchasing_list',
                    ];
                } else if ($para2 == 'add') {

                    $validation = $this->form_validation;
                    $purchase   = $this->purchase_model;

                    $validation->set_rules($purchase->rules());

                    if ($validation->run()) {

                        $purchase->save();

                        $this->session->set_flashdata('info', '
                        <div class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <h4>Success :</h4> Pembuatan PO Berhasil...
                        </div>');

                        redirect(base_url('index.php/admin/master/purchasing/list'));
                    }

                    $data_page = [
                        'page_title' => 'Buat PO',
                        'card_name'  => 'Form PO',
                        'suplier'    => $this->suplier_model->getAllSuplier(),
                        'produk'     => $this->produk_model->getAllProduk(),
                        'page'       => 'page/admin/module/purchasing_add',
                    ];
                } else if ($para2 == 'edit') {

                    $validation = $this->form_validation;
                    $purchase   = $this->purchase_model;

                    $validation->set_rules($purchase->rules());

                    if ($validation->run()) {
                        $purchase->edit();

                        $this->session->set_flashdata('info', '
                        <div class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <h4>Success :</h4> Edit PO Berhasil...
                        </div>');

                        redirect(base_url('index.php/admin/master/purchasing/list'));
                    }

                    $nofaktur = $this->uri->segment(5);
                    $data_page = [
                        'page_title' => 'Edit PO',
                        'card_name'  => 'Form Edit PO',
                        'suplier'    => $this->suplier_model->getAllSuplier(),
                        'produk'     => $this->produk_model->getAllProduk(),
                        'detail'     => $this->purchase_model->getDataById($nofaktur),
                        'page'       => 'page/admin/module/purchasing_edit',
                    ];
                }
                break;
            case 'selling':
                $this->load->model('agen_model');
                $this->load->model('SubAgen_model');
                $this->load->model('produk_model');
                $this->load->model('selling_model');
                $this->load->model('apotik_model');

                if ($para2 == 'list') {
                    $data_page = [
                        'page_title' => 'Daftar Penjualan',
                        'card_name'  => 'Daftar Penjualan',
                        'penjualan'  => $this->selling_model->getAll(),
                        'page'       => 'page/admin/module/selling_list',
                    ];
                } else if ($para2 == 'add') {

                    $data_page = [
                        'page_title' => 'Penjualan',
                        'card_name'  => 'Form Penjualan',
                        'agen'       => $this->agen_model->getAllAgen(),
                        'subagen'    => $this->SubAgen_model->getAllSubAgen(),
                        'apotik'     => $this->apotik_model->getAllApotik(),
                        'products'   => $this->produk_model->getAllProduk(),
                        'page'       => 'page/admin/module/selling_add',
                    ];
                }
                break;
            case 'return':
                $this->load->model('retur_model');
                if ($para2 == 'list') {
                    $data_page = [
                        'page_title' => 'Daftar Retur Barang',
                        'card_name'  => 'Tabel Retur',
                        'returns'    => $this->retur_model->getAlldata(),
                        'page'       => 'page/admin/module/retur_list',
                    ];
                } else if ($para2 == 'add') {
                    $this->load->model('produk_model');
                    $this->load->model('selling_model');

                    $validation = $this->form_validation;
                    $retur   = $this->retur_model;

                    $validation->set_rules($retur->rules());

                    if ($validation->run()) {

                        //cek keberadaan invoice
                        $invoice = $this->input->post('invoice');
                        $seek_invoice = $this->selling_model->seekInvoice($invoice);

                        if ($seek_invoice > 0) {
                            $retur->save();

                            $this->session->set_flashdata('info', '
                            <div class="alert alert-success" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <h4>Success :</h4> Pembuatan Retur Berhasil...
                            </div>');

                            redirect(base_url('index.php/admin/master/return/list'));
                        } else {
                            $this->session->set_flashdata('info', '
                            <div class="alert alert-warning" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <h4>OOps</h4> Invoice transaksi tidak ditemukan, pastikan no. invoice ada di tabel penjualan...
                            </div>');

                            redirect(base_url('index.php/admin/master/return/add'));
                        }
                    }
                    $data_page = [
                        'page_title' => 'Tambah Retur Barang',
                        'card_name'  => 'Form Retur',
                        'items'      => $this->produk_model->getAllProduk(),
                        'page'       => 'page/admin/module/retur_add',
                    ];
                } else if ($para2 == 'edit') {

                    $data = [
                        'ID'        => $this->input->post('id'),
                        'STATUS'    => $this->input->post('status'),
                        'TGL_GANTI' => $this->input->post('tgl_ganti')
                    ];

                    $this->retur_model->update($data);

                    $this->session->set_flashdata('info', '
                    <div class="alert alert-success" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <h4>Success :</h4> Edit Retur Berhasil...
                    </div>');

                    redirect(base_url('index.php/admin/master/return/list'));
                }
                break;
            case 'rekening':
                $this->load->model('rekening_model');
                if ($para2 == 'list') {
                    $data_page = [
                        'page_title' => 'Daftar Rekening Operasional',
                        'card_name'  => 'Tabel Rek. Operasional',
                        'daftar'    => $this->rekening_model->getAll(),
                        'page'       => 'page/admin/module/rekening_list',
                    ];
                } else if ($para2 == 'add') {

                    $validation = $this->form_validation;
                    $rekening   = $this->rekening_model;

                    $validation->set_rules($rekening->rules());

                    if ($validation->run()) {
                        $rekening->save();

                        $this->session->set_flashdata('info', '
                        <div class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <h4>Success :</h4> Pembuatan Rekening Berhasil...
                        </div>');

                        redirect(base_url('index.php/admin/master/rekening/list'));
                    }
                    $data_page = [
                        'page_title' => 'Tambah Rekening Operasional',
                        'card_name'  => 'Form Rek. Operasional',
                        'page'       => 'page/admin/module/rekening_add',
                    ];
                } else if ($para2 == 'edit') {

                    $this->form_validation->set_rules('namapos', 'Nama Rekening', 'required');

                    if ($this->form_validation->run()) {
                        $data = [
                            'ID'    => $this->input->post('id'),
                            'POS_NAME' => $this->input->post('namapos'),
                            'KETERANGAN' => $this->input->post('keterangan')
                        ];

                        $this->rekening_model->update($data);

                        $this->session->set_flashdata('info', '
                        <div class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <h4>Success :</h4> Edit Rekening Berhasil...
                        </div>');

                        redirect(base_url('index.php/admin/master/rekening/list'));
                    }

                    $id = $this->uri->segment(5);
                    $data_page = [
                        'page_title' => 'Edit Rekening Operasional',
                        'card_name'  => 'Form Edit Rek. Operasional',
                        'detail'     => $this->rekening_model->getById($id),
                        'page'       => 'page/admin/module/rekening_edit',
                    ];
                }
                break;
            case 'operasional':
                $this->load->model('rekening_model');
                $this->load->model('transaksi_model');
                if ($para2 == 'add') {

                    $this->form_validation->set_rules('rekening', 'Jenis Biaya', 'required');
                    $this->form_validation->set_rules('nominal', 'Nominal', 'required');

                    if ($this->form_validation->run()) {

                        $trans = [
                            'tgl'           => $this->input->post('tgl'),
                            'ket'           => $this->input->post('keterangan'),
                            'id_trans'      => $this->input->post('rekening'),
                            'trans_type'    => $this->input->post('tipe'),
                            'nominal'       => $this->input->post('nominal'),
                            'kredit'        => 'yes',
                            'debet'         => 'no',
                        ];

                        $this->cek_transaksi->transaksi($trans);

                        $this->session->set_flashdata('info', '
                        <div class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <h4>Success :</h4> Penambahan Transaksi Berhasil...
                        </div>');

                        redirect(base_url('index.php/admin/master/operasional/list'));
                    }
                    $data_page = [
                        'page_title' => 'Form Input Biaya Operasional',
                        'card_name'  => 'Form',
                        'rekening'   => $this->rekening_model->getAll(),
                        'page'       => 'page/admin/module/operasional_add',
                    ];
                } else if ($para2 == 'list') {
                    $data_page = [
                        'page_title' => 'Biaya Operasional',
                        'card_name'  => 'Daftar Operasional',
                        'daftar'     => $this->transaksi_model->operationList(),
                        'page'       => 'page/admin/module/operasional_list',
                    ];
                } else if ($para2 == 'edit') {
                    $this->load->model('rekening_model');
                    $id = $this->uri->segment(5);

                    $this->form_validation->set_rules('rekening', 'Jenis Biaya', 'required');
                    $this->form_validation->set_rules('nominal', 'Nominal', 'required');

                    if ($this->form_validation->run()) {
                        $ids     = $this->input->post('id');
                        $tgl     = $this->input->post('tgl');
                        $rek     = $this->input->post('rekening');
                        $nominal = $this->input->post('nominal');
                        $ket     = $this->input->post('keterangan');

                        //ambil saldo sebelumnya utk rubah pemotongan
                        if ($ids == 1) {
                            //$saldo = 0;
                            $newsaldo = 0;
                        } else {
                            $up_id  = $ids - 1;
                            $saldo = $this->db->get_where('trans_history', ['ID' => $up_id])->row()->SALDO;
                            $newsaldo = $saldo - $nominal;
                        }

                        $update = [
                            'ID'    => $ids,
                            'TGL'   => $tgl,
                            'KETERANGAN' => $ket,
                            'ID_TRANS'  => $rek,
                            'TRANS_TYPE' => 'operasional',
                            'KREDIT' => $nominal,
                            'DEBET' => 0,
                            'SALDO' => $newsaldo
                        ];
                    }
                    $data_page = [
                        'page_title' => 'Edit Transaksi Biaya',
                        'card_name'  => 'Form',
                        'rek'        => $this->rekening_model->getAll(),
                        'detail'     => $this->transaksi_model->getById($id),
                        'page'       => 'page/admin/module/operasional_edit',
                    ];
                } else if ($para2 == 'koreksi') {
                    $this->form_validation->set_rules('rekening', 'Jenis Biaya', 'required');
                    $this->form_validation->set_rules('nominal', 'Nominal', 'required');

                    if ($this->form_validation->run()) {

                        $trans = [
                            'tgl'           => $this->input->post('tgl'),
                            'ket'           => $this->input->post('keterangan'),
                            'id_trans'      => $this->input->post('rekening'),
                            'trans_type'    => $this->input->post('tipe'),
                            'nominal'       => $this->input->post('nominal'),
                            'kredit'        => 'no',
                            'debet'         => 'yes',
                        ];

                        $this->cek_transaksi->transaksi($trans);

                        $this->session->set_flashdata('info', '
                        <div class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <h4>Success :</h4> Koreksi Transaksi Berhasil...
                        </div>');

                        redirect(base_url('index.php/admin/master/operasional/list'));
                    }
                    $data_page = [
                        'page_title' => 'Form Koreksi Operasional',
                        'card_name'  => 'Form',
                        'rekening'   => $this->rekening_model->getAll(),
                        'page'       => 'page/admin/module/operasional_koreksi',
                    ];
                }
                break;
        }

        $this->load->view('index', $data_page);
    }

    public function koreksi($id = null)
    {
        $this->load->model('kas_model');

        if ($id == null) {
            redirect(base_url() . "index.php/admin/laporan/kas_harian");
        } else {
            $data_page = [
                'page_title' => 'Form Koreksi Transaksi',
                'card_name'  => 'Form',
                'detail'     => $this->kas_model->getById($id),
                'page'       => 'page/admin/module/koreksi_history',
            ];
        }

        $this->load->view('index', $data_page);
    }

    public function report($para1 = '', $para2 = '')
    {
        switch ($para1) {
            case 'invoice':
                if ($para2 == 'print_invoice') {
                    $invoice = $this->uri->segment(5);

                    $data_page = [
                        'page_title' => 'Invoice',
                        'detail'     => $this->selling_model->getByInvoice($invoice),
                        'page'       => 'page/admin/report/invoice'
                    ];
                } else if ($para2 == 'print_labarugi') {
                    $this->load->model('purchase_model');
                    $this->load->model('kas_model');
                    $this->load->model('selling_model');

                    $this->form_validation->set_rules('tgl1', 'Tanggal 1', 'required');

                    if ($this->form_validation->run()) {
                        $date1 = $this->input->post('tgl1');
                        $date2 = $this->input->post('tgl2');

                        $periode = "Periode : " . date('d/m/Y', strtotime($date1)) . " s.d " . date('d/m/Y', strtotime($date2));

                        $data_page = [
                            'page_title'    => 'Laporan Laba Rugi',
                            'periode'       => $periode,
                            'purchase'      => $this->purchase_model->getDateRange($date1, $date2),
                            'operasional'   => $this->kas_model->getOpDateRange($date1, $date2),
                            'koreksi'       => $this->kas_model->getKorDateRange($date1, $date2),
                            'korgroup'       => $this->kas_model->getKoreksiGroup($date1, $date2),
                            'opgroup'       => $this->kas_model->getOpGroup($date1, $date2),
                            'selling'       => $this->selling_model->getDateRange($date1, $date2),
                            'page'          => 'page/admin/report/labarugi'
                        ];
                    }
                }
                break;
        }

        $this->load->view('page/admin/report/index', $data_page);
    }

    public function laporan($para1 = '', $para2 = '')
    {
        switch ($para1) {
            case 'kas_harian':
                $this->load->model('kas_model');
                $data_page = [
                    'page_title' => 'Kas Harian',
                    'rows'       => $this->kas_model->getAll(),
                    'page'       => 'page/admin/laporan/kas_harian'
                ];
                break;
            case 'labarugi':
                $data_page = [
                    'page_title' => 'Laba Rugi',
                    'page'       => 'page/admin/laporan/labarugi'
                ];
                break;
        }

        $this->load->view('index', $data_page);
    }

    public function user($para1 = '', $para2 = '')
    {
        switch ($para1) {
            case 'account':
                $this->load->model('account_model');
                if ($para2 == 'list') {
                    $data_page = [
                        'page_title' => 'Daftar Akun Pengguna',
                        'card_name'  => 'Tabel Pengguna',
                        'lists'      => $this->account_model->getAll(),
                        'page'       => 'page/admin/module/user_account_list',
                    ];
                } else if ($para2 == 'add') {
                    $randpass = $this->_randomPassword(8, 1, "lower_case,upper_case,numbers,special_symbols");
                    $level    = ['operator'];

                    $account = $this->account_model;
                    $validation = $this->form_validation;

                    $validation->set_rules($account->rules());
                    if ($validation->run()) {
                        $account->save();
                        $this->session->set_flashdata('info', '
                        <div class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <h4>Success :</h4> Penambahan akun berhasil...
                        </div>');

                        redirect(base_url('index.php/admin/user/account/list'));
                    }

                    $data_page = [
                        'page_title' => 'Tambah Pengguna',
                        'card_name'  => 'Form',
                        'level'      => $level,
                        'randpass'   => "$randpass[0]",
                        'page'       => 'page/admin/module/user_account_add',
                    ];
                } else if ($para2 == 'edit') {
                    $id = $this->uri->segment(5);
                    $randpass = $this->_randomPassword(8, 1, "lower_case,upper_case,numbers,special_symbols");
                    $level    = ['operator'];

                    $account = $this->account_model;
                    $validation = $this->form_validation;

                    $validation->set_rules($account->rules());
                    if ($validation->run()) {
                        $account->update();
                        $this->session->set_flashdata('info', '
                        <div class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <h4>Success :</h4> Ubah akun berhasil...
                        </div>');

                        redirect(base_url('index.php/admin/user/account/list'));
                    }

                    $data_page = [
                        'page_title' => 'Edit Pengguna',
                        'card_name'  => 'Form',
                        'level'      => $level,
                        'randpass'   => "$randpass[0]",
                        'detail'     => $this->account_model->getAccountById($id),
                        'page'       => 'page/admin/module/user_account_edit',
                    ];
                } else if ($para2 == 'delete') {
                    $id = $this->uri->segment(5);
                    $this->account_model->delete($id);

                    $this->session->set_flashdata('info', '
                        <div class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <h4>Success :</h4> Hapus akun berhasil...
                        </div>');

                    redirect(base_url('index.php/admin/user/account/list'));
                } else if ($para2 == 'ubah_password') {
                    $id = $this->uri->segment(5);

                    $account = $this->account_model;
                    $validation = $this->form_validation;

                    $validation->set_rules($account->rules_pass());
                    if ($validation->run()) {

                        $id         = $this->input->post('id');
                        $oldpass    = $this->input->post('oldpass', true);
                        $newpass    = $this->input->post('newpass2', true);

                        //cek kesamaan pass
                        $akun = $this->account_model->getAccountById($id);
                        if (password_verify($oldpass, $akun['PASSWORD'])) {

                            $data = [
                                'ID'        => $id,
                                'PASSWORD'  => password_hash($newpass, PASSWORD_DEFAULT)
                            ];

                            $account->ubahpass($data);

                            $this->session->set_flashdata('info', '
                            <div class="alert alert-success" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <h4>Success :</h4> Ubah password berhasil...
                            </div>');
                            redirect(base_url() . 'index.php/admin/user/account/ubah_password/' . $id);
                        } else {

                            $this->session->set_flashdata('info', '
                            <div class="alert alert-warning" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <h4>Oops :</h4> Password lama salah...
                            </div>');
                            redirect(base_url() . 'index.php/admin/user/account/ubah_password/' . $id);
                        }
                    }

                    $data_page = [
                        'page_title' => 'Ubah Password',
                        'card_name'  => 'Form',
                        'detail'     => $this->account_model->getAccountById($id),
                        'page'       => 'page/admin/module/user_account_pass_edit',
                    ];
                }
                break;
        }
        $this->load->view('index', $data_page);
    }

    private function _randomPassword($length, $count, $characters)
    {
        // credit : https://www.phpjabbers.com/generate-a-random-password-with-php-php70.html
        // $length - the length of the generated password
        // $count - number of passwords to be generated
        // $characters - types of characters to be used in the password

        // define variables used within the function    
        $symbols = array();
        $passwords = array();
        $used_symbols = '';
        $pass = '';

        // an array of different character types    
        $symbols["lower_case"] = 'abcdefghijklmnpqrstuvwxyz';
        $symbols["upper_case"] = 'ABCDEFGHIJKLMNPQRSTUVWXYZ';
        $symbols["numbers"] = '123456789';
        $symbols["special_symbols"] = '!@#$';

        $characters = explode(",", $characters); // get characters types to be used for the passsword
        foreach ($characters as $key => $value) {
            $used_symbols .= $symbols[$value]; // build a string with all characters
        }
        $symbols_length = strlen($used_symbols) - 1; //strlen starts from 0 so to get number of characters deduct 1

        for ($p = 0; $p < $count; $p++) {
            $pass = '';
            for ($i = 0; $i < $length; $i++) {
                $n = rand(0, $symbols_length); // get a random character from the string with all characters
                $pass .= $used_symbols[$n]; // add the character to the password string
            }
            $passwords[] = $pass;
        }

        return $passwords; // return the generated password

        /*
            //generate one password using 5 upper and lower case characters
            randomPassword(5, 1, "lower_case,upper_case");

            // generate three passwords using 10 lower case characters and numbers
            randomPassword(10, 3, "lower_case,numbers");

            // generate five passwords using 12 lower case and upper case characters, numbers and special symbols
            randomPassword(12, 5, "lower_case,upper_case,numbers,special_symbols");
        */
    }
}
