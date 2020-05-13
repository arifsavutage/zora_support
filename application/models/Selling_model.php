<?php
class Selling_model extends CI_Model
{
    private $_table = 'selling';

    public $INVOICE;
    public $SELLER_ID;
    public $SELLER_TYPE;
    public $PRODUCT_DETAIL;
    public $METODE_BAYAR;
    public $JML_CICILAN;
    public $STATUS;
    public $TGL_BELI;
    public $KETERANGAN;

    public function save($data)
    {
        return $this->db->insert($this->_table, $data);
    }

    public function getAll()
    {
        $this->db->order_by('selling.SALE_ID', 'DESC');
        return $this->db->get($this->_table)->result_array();
    }

    public function getAgenName($id)
    {
        $this->db->select("marketing_agen.AGEN_NAME AS SELLER_NAME");
        $this->db->from($this->_table);
        $this->db->from('marketing_agen');
        //$this->db->join('marketing_agen', 'selling.SELLER_ID = marketing_agen.ID', 'left');
        $this->db->where('marketing_agen.ID = selling.SELLER_ID');
        $this->db->where('marketing_agen.ID', $id);
        return $this->db->get()->row();
    }

    public function getSubAgenName($id)
    {
        $this->db->select("marketing_subagen.SUBAGEN_NAME AS SELLER_NAME");
        $this->db->from($this->_table);
        $this->db->from('marketing_subagen');
        //$this->db->join('marketing_subagen', 'selling.SELLER_ID = marketing_subagen.ID', 'left');
        $this->db->where('marketing_subagen.ID = selling.SELLER_ID');
        $this->db->where('marketing_subagen.ID', $id);
        return $this->db->get()->row();
    }

    public function getByDate($date)
    {
        $this->db->where('TGL_BELI', $date);
        $this->db->order_by('SALE_ID', 'DESC');
        return $this->db->get($this->_table)->result();
    }
}
