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
                        // simpan ke db
                        $this->Marketing_model->addMarketing();
                        redirect('admin/master/marketing/list');
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
                        // simpan ke db
                        $this->Marketing_model->editMarketing();
                        redirect('admin/master/marketing/list');
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
                        // simpan ke db
                        $this->Agen_model->addAgen();
                        redirect('admin/master/agen/list');
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
                        // simpan ke db
                        $this->Agen_model->editAgen();
                        redirect('admin/master/agen/list');
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
                        // simpan ke db
                        $this->SubAgen_model->addSubAgen();
                        redirect('admin/master/subagen/list');
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
                        // simpan ke db
                        $this->SubAgen_model->editSubAgen();
                        redirect('admin/master/subagen/list');
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
        }

        $this->load->view('index', $data_page);
    }
}
