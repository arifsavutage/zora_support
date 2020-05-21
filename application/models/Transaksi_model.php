<?php

class Transaksi_model extends CI_Model
{

    private $_table = 'trans_history';

    public $TGL;
    public $KETERANGAN;
    public $ID_TRANS;
    public $TRANS_TYPE;
    public $KREDIT;
    public $DEBET;
    public $SALDO;

    public function save($data)
    {
        return $this->db->insert($this->_table, $data);
    }

    public function getAll()
    {
        $this->db->order_by('ID', 'DESC');
        return $this->db->get($this->_table)->result_array();
    }

    public function getById($id)
    {
        return $this->db->get_where($this->_table, ['ID' => $id])->row_array();
    }

    public function getListByType($type)
    {
        $this->db->order_by('ID', 'DESC');
        return $this->db->get_where($this->_table, ['TRANS_TYPE' => $type])->result_array();
    }

    public function operationList()
    {
        $this->db->select("trans_history.`ID`, trans_history.`TGL`, trans_history.`KETERANGAN`, 
        trans_history.`ID_TRANS`, trans_history.`TRANS_TYPE`, trans_history.`KREDIT`, op_pos.POS_NAME");
        $this->db->from($this->_table);
        $this->db->join('op_pos', 'op_pos.ID = trans_history.ID_TRANS', 'left');
        $this->db->where('trans_history.TRANS_TYPE', 'operasional');
        $this->db->order_by('trans_history.ID', 'ASC');
        return $this->db->get()->result_array();
    }

    public function getLastTrans()
    {
        $this->db->order_by('ID', 'DESC');
        return $this->db->get($this->_table)->row_array();
    }
}
