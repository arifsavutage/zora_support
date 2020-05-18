<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cek_transaksi
{

    private $_CI;
    public function __construct()
    {
        $this->_CI = &get_instance();

        $this->_CI->load->model('transaksi_model', '', TRUE);
    }

    public function transaksi($data)
    {
        $jml_transaksi = count($this->_CI->transaksi_model->getAll());

        if ($data['kredit'] == 'yes' && $data['debet'] == 'no') {
            if ($jml_transaksi == 0) {

                $saldo = 0 - $data['nominal'];
                $save = [
                    'TGL'           => $data['tgl'],
                    'KETERANGAN'    => $data['ket'],
                    'ID_TRANS'      => $data['id_trans'],
                    'TRANS_TYPE'    => $data['trans_type'],
                    'KREDIT'        => $data['nominal'],
                    'DEBET'         => 0,
                    'SALDO'         => $saldo
                ];
                $this->_CI->transaksi_model->save($save);
            } else {
                $last_trans = $this->_CI->transaksi_model->getLastTrans();

                $kredit = $data['nominal'];
                $debet  = 0;
                $saldo  = $last_trans['SALDO'] - $kredit;

                $save = [
                    'TGL'           => $data['tgl'],
                    'KETERANGAN'    => $data['ket'],
                    'ID_TRANS'      => $data['id_trans'],
                    'TRANS_TYPE'    => $data['trans_type'],
                    'KREDIT'        => $kredit,
                    'DEBET'         => $debet,
                    'SALDO'         => $saldo
                ];
                $this->_CI->transaksi_model->save($save);
            }
        } else if ($data['kredit'] == 'no' && $data['debet'] == 'yes') {
            if ($jml_transaksi == 0) {
                $save = [
                    'TGL'           => $data['tgl'],
                    'KETERANGAN'    => $data['ket'],
                    'ID_TRANS'      => $data['id_trans'],
                    'TRANS_TYPE'    => $data['trans_type'],
                    'KREDIT'        => 0,
                    'DEBET'         => $data['nominal'],
                    'SALDO'         => $data['nominal']
                ];
                $this->_CI->transaksi_model->save($save);
            } else {
                $last_trans = $this->_CI->transaksi_model->getLastTrans();

                $kredit = 0;
                $debet  = $data['nominal'];
                $saldo  = $last_trans['SALDO'] + $debet;

                $save = [
                    'TGL'           => $data['tgl'],
                    'KETERANGAN'    => $data['ket'],
                    'ID_TRANS'      => $data['id_trans'],
                    'TRANS_TYPE'    => $data['trans_type'],
                    'KREDIT'        => $kredit,
                    'DEBET'         => $debet,
                    'SALDO'         => $saldo
                ];
                $this->_CI->transaksi_model->save($save);
            }
        }
    }
}
