<?php

class Installment_model extends CI_Model
{
    private $_table = 'installment';

    public $INVOICE;
    public $JATUH_TEMPO;
    public $TAGIHAN;
    public $TGL_BAYAR;
    public $NOMINAL;

    public function save($data)
    {
        return $this->db->insert($this->_table, $data);
    }

    public function getByInvoice($invoice)
    {
        $this->db->order_by('ID', 'ASC');
        return $this->db->get_where($this->_table, ['INVOICE' => $invoice])->result_array();
    }

    public function cicilan($id, $tglbyr)
    {
        //ambil nilai tagihan
        $tagihan = $this->db->get_where($this->_table, ['ID' => $id])->row_array();

        $data = [
            'TGL_BAYAR' => $tglbyr,
            'NOMINAL'   => $tagihan['TAGIHAN']
        ];

        return $this->db->update($this->_table, $data, ['ID' => $id]);
    }

    public function detailcicilan($id)
    {
        return $this->db->get_where($this->_table, ['ID' => $id])->row_array();
    }
}
