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
                $this->load->model('subagen_model');

                if ($para2 == 'list') {
                    $data_page = [
                        'page_title' => 'Daftar Pembelian',
                        'card_name'  => 'Daftar Pembelian',
                        'page'       => 'page/admin/module/selling_list',
                    ];
                } else if ($para2 == 'add') {
                    $data_page = [
                        'page_title' => 'Pembelian',
                        'card_name'  => 'Form Pembelian',
                        'agen'       => $this->agen_model->getAllAgen(),
                        'subagen'    => $this->subagen_model->getAllSubAgen(),
                        'page'       => 'page/admin/module/selling_add',
                    ];
                }
                break;
        }

        $this->load->view('index', $data_page);
    }
}
