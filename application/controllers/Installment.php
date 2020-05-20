<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Installment extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('cek_transaksi');

        not_login();
    }

    public function bayar_cicilan($invoice = null, $id = null)
    {
        if ($invoice == null || $id == null) {
            $this->session->set_flashdata('info', '
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Oopps, </strong> data tidak di temukan ... 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>');

            redirect(base_url('index.php/admin/master/selling/list'));
        } else {

            //bayar cicilan
            $this->installment_model->cicilan($id);

            //mengurangi masa cicilan
            $data = $this->selling_model->getByInvoice($invoice);

            $jmlbulan   = $data['JML_CICILAN'] - 1;

            //jmlcicilan di history

            $ke = $this->db->get_where('trans_history', ['ID_TRANS' => $invoice])->num_rows();
            if ($jmlbulan == 0) {
                //jadikan lunas
                $data_up = [
                    'INVOICE' => $invoice,
                    'STATUS'  => 'lunas',
                    'JML_CICILAN' => $jmlbulan
                ];

                $ke += 1;
            } else {
                $data_up = [
                    'INVOICE' => $invoice,
                    'JML_CICILAN' => $jmlbulan
                ];

                $ke += 1;
            }
            $this->selling_model->updateByInvoice($data_up);

            //catat history transaksi cicilan
            $ket   = "cicilan invoice $invoice ke-$ke";
            $get_nominal = $this->db->get_where('installment', ['ID' => $id])->row()->TAGIHAN;

            $trans = [
                'tgl'           => date('Y-m-d'),
                'ket'           => $ket,
                'id_trans'      => $invoice,
                'trans_type'    => 'selling',
                'nominal'       => $get_nominal,
                'kredit'        => 'no',
                'debet'         => 'yes',
            ];

            $this->cek_transaksi->transaksi($trans);

            $this->session->set_flashdata('info', '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Succses, </strong> data tersimpan ... 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>');

            redirect(base_url('index.php/admin/master/selling/list'));
        }
    }
}
