<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('produk_model');
        $this->load->model('marketing_model');
        $this->load->model('agen_model');
        $this->load->model('SubAgen_model');
        $this->load->model('account_model');
        $this->load->model('selling_model');
        $this->load->model('apotik_model');
    }

    public function index()
    {
        not_login();

        if ($this->session->userdata('role') == 'superadmin') {
            $pages = 'page/admin/admin_dashboard';
        } else {
            $pages = 'page/admin/admin_dashboards';
        }

        $data_page  = [
            'page_title'    => 'Dashboard',
            'permonths'     => $this->selling_model->getEarningByMonth(),
            'peryears'      => $this->selling_model->getEarningByYear(),
            'tunggakan'     => $this->selling_model->getTunggakanByMonth(),
            'chart_data'    => $this->grafikpenjualan(),
            'page'          => $pages
        ];
        $this->load->view('index', $data_page);
    }

    function grafikpenjualan()
    {
        $year  = date('Y');

        $qry_month_by_year  = $this->db->query("SELECT DATE_FORMAT(`TGL`, '%M') AS BULAN FROM `trans_history` WHERE YEAR(`TGL`) = YEAR(`TGL`) = YEAR(CURDATE()) GROUP BY DATE_FORMAT(`TGL`, '%M') ORDER BY DATE_FORMAT(`TGL`, '%m %Y') ASC");
        $data_month_by_year = $qry_month_by_year->result_array();

        $query = $this->db->query("SELECT DATE_FORMAT(TGL, '%M') AS PERIODE, SUM(`DEBET`) AS HASIL, SUM(KREDIT) AS PENGELUARAN FROM `trans_history` WHERE YEAR(`TGL`) = YEAR(CURDATE()) GROUP BY DATE_FORMAT(TGL, '%M %Y') ORDER BY DATE_FORMAT(`TGL`, '%m %Y') ASC");
        $data = $query->result_array();

        $x = [];

        $i = 0;
        foreach ($data as $row) {
            $x['label'][] = $row['PERIODE'];
            $x['value'][] = (int) $row['HASIL'];
            $x['spending'][] = (int) $row['PENGELUARAN'];
            $i++;
        }

        $x  = json_encode($x);

        return $x;
    }

    public function forgot_password()
    {
        //$this->load->library('kirim_email');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

        if ($this->form_validation->run()) {
            $email = $this->input->post('email', true);

            $cek = $this->account_model->getAccountByEmail($email);
            $is_valid = count($cek);

            if ($is_valid > 0) {
                //send email
                $data = [
                    'id'    => $cek['ID'],
                    'nama'  => $cek['USERNAME']
                ];

                $to         = $cek['EMAIL'];
                $subject    = "Lupa Kata Sandi";
                $message    = $this->load->view('email/email_forgot', $data, true);

                kirim_email($to, $subject, $message);
            } else {
                $this->session->set_flashdata('info', '
                    <div class="alert alert-warning" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        Email tidak terdaftar ...
                    </div>');

                redirect(base_url() . 'index.php/home/forgot_password');
            }
        }
        $this->load->view('forgot_password');
    }

    public function update_password($id)
    {
        $this->form_validation->set_rules('password', 'Password baru', 'trim|required|min_length[8]');
        $this->form_validation->set_rules('password2', 'Re-Type Password baru', 'trim|required|matches[password]');

        if ($this->form_validation->run()) {
            $pass   = $this->input->post('password', true);
            $data = [
                'ID'        => $id,
                'PASSWORD'  => password_hash($pass, PASSWORD_DEFAULT)
            ];

            $this->account_model->ubahpass($data);

            $this->session->set_flashdata('info', '
            <div class="alert alert-success" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                Password berhasil di rubah ...
            </div>');

            redirect(base_url());
        }
        $this->load->view('update_password');
    }

    public function login()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if ($this->form_validation->run()) {
            $email  = $this->input->post('email', true);
            $pass   = $this->input->post('password', true);

            $user   = $this->account_model->getAccountByEmail($email);
            //print_r(var_dump($user));

            if ($user) {
                if (password_verify($pass, $user['PASSWORD'])) {

                    /*if ($user['USER_TYPE'] == 'marketing') {
                        $get_data   = $this->marketing_model->getMarketingById($user['ID_USER']);
                        $exname = explode(" ", $get_data->MARKETING_NAME);

                        if (count($exname) > 1) {
                            $nama   = $exname[0] . " " . $exname[1];
                        } else {
                            $nama   = $get_data->MARKETING_NAME;
                        }
                    } else if ($user['USER_TYPE'] == 'agen') {
                        $get_data   = $this->agen_model->getAgenById($user['ID_USER']);
                        $exname = explode(" ", $get_data->AGEN_NAME);

                        if (count($exname) > 1) {
                            $nama   = $exname[0] . " " . $exname[1];
                        } else {
                            $nama   = $get_data->AGEN_NAME;
                        }
                    } else if ($user['USER_TYPE'] == 'sub') {
                        $get_data   = $this->subAgen_model->getSubAgenById($user['ID_USER']);
                        $exname = explode(" ", $get_data->SUBAGEN_NAME);
                        //$nama   = $exname[0] . " " . $exname[1];

                        if (count($exname) > 1) {
                            $nama   = $exname[0] . " " . $exname[1];
                        } else {
                            $nama   = $get_data->SUBAGEN_NAME;
                        }
                    } else if ($user['USER_TYPE'] == 'apotik') {
                        $get_data   = $this->apotik_model->getApotikById($user['ID_USER']);
                        $exname = explode(" ", $get_data->SUBAGEN_NAMEAPOTIK_NAME);
                        //$nama   = $exname[0] . " " . $exname[1];

                        if (count($exname) > 1) {
                            $nama   = $exname[0] . " " . $exname[1];
                        } else {
                            $nama   = $get_data->SUBAGEN_NAME;
                        }
                    } else {
                        $exname = explode(" ", $user['USERNAME']);
                        //$nama = $exname[0] . " " . $exname[1];

                        if (count($exname) > 1) {
                            $nama   = $exname[0] . " " . $exname[1];
                        } else {
                            $nama   = $user['USERNAME'];
                        }
                    }*/

                    $exname = explode(" ", $user['USERNAME']);
                    //$nama = $exname[0] . " " . $exname[1];

                    if (count($exname) > 1) {
                        $nama   = $exname[0] . " " . $exname[1];
                    } else {
                        $nama   = $user['USERNAME'];
                    }

                    $data = [
                        'id'    => $user['ID'],
                        'nama'  => ucfirst($nama),
                        'role'  => $user['LEVEL']
                    ];

                    $this->session->set_userdata($data);
                    //echo "$user[ID], $user[EMAIL], $user[ROLE_ID]";
                    redirect(base_url());
                } else {
                    $this->session->set_flashdata('info', '
                    <div class="alert alert-warning" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        Password salah ...
                    </div>');

                    redirect(base_url() . 'index.php/home/login');
                }
            } else {
                $this->session->set_flashdata('info', '
                <div class="alert alert-danger" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    Email belum terdaftar ...
                </div>');

                redirect(base_url() . 'index.php/home/login');
            }
        } else {
            $this->load->view('login');
        }
    }

    public function logout()
    {
        //$params = ['id', 'email', 'role_id'];

        // $this->session->unset_userdata($params);
        $this->session->sess_destroy();
        $this->session->set_flashdata('success', '
            <div class="alert alert-info" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                Anda telah logout...
            </div>');

        redirect(base_url() . 'index.php/home/login');
    }
}
