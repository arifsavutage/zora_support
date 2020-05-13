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
}
