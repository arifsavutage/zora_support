<?php
class Kas_model extends CI_Model
{

    private $_table = 'trans_history';

    public $ID;
    public $TGL;
    public $KETERANGAN;
    public $ID_TRANS;
    public $TRANS_TYPE;
    public $KREDIT;
    public $DEBET;
    public $SALDO;

    public function getByPeriode($data)
    {
        $query = $this->db->query("SELECT `ID`, `TGL`, `KETERANGAN`, `ID_TRANS`, 
        `TRANS_TYPE`, `KREDIT`, `DEBET`, `SALDO` FROM `trans_history` 
        WHERE `TGL` BETWEEN '$data[tgl1]' AND '$data[tgl2]' ORDER BY ID ASC");

        return $query->result_array();
    }

    public function getAll()
    {
        return $this->db->get($this->_table)->result_array();
    }

    public function getOpDateRange($date1, $date2)
    {
        $this->db->select("trans_history.`ID`, trans_history.`TGL`, trans_history.`KETERANGAN`, 
        trans_history.`ID_TRANS`, trans_history.`TRANS_TYPE`, trans_history.`KREDIT`, trans_history.`DEBET`, 
        trans_history.`SALDO`, op_pos.POS_NAME");
        $this->db->from($this->_table);
        $this->db->join('op_pos', 'op_pos.ID = trans_history.ID_TRANS', 'left');
        $this->db->where('trans_history.TRANS_TYPE', "operasional");
        $this->db->where("trans_history.TGL BETWEEN '$date1' AND '$date2'");
        return $this->db->get()->result_array();
    }

    public function getOpGroup($date1, $date2)
    {
        $query = $this->db->query("SELECT trans_history.ID_TRANS, op_pos.POS_NAME FROM `trans_history` LEFT JOIN op_pos ON op_pos.ID = trans_history.ID_TRANS WHERE trans_history.TRANS_TYPE = 'operasional' AND trans_history.TGL BETWEEN '$date1' AND '$date2' GROUP BY trans_history.ID_TRANS");
        return $query->result_array();
    }

    public function getById($id)
    {
        return $this->db->get_where($this->_table, ['ID' => $id])->row_array();
    }
}
