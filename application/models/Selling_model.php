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
        $this->db->select("marketing_agen.AGEN_NAME AS SELLER_NAME, 
        marketing_agen.AGEN_ADDRESS AS SELLER_ADDRESS, marketing_agen.AGEN_PHONE AS SELLER_PHONE");
        $this->db->from($this->_table);
        //$this->db->from('marketing_agen');
        $this->db->join('marketing_agen', 'selling.SELLER_ID = marketing_agen.ID', 'left');
        //$this->db->where('marketing_agen.ID = selling.SELLER_ID');
        $this->db->where('marketing_agen.ID', $id);
        return $this->db->get()->row();
    }

    public function getSubAgenName($id)
    {
        $this->db->select("marketing_subagen.SUBAGEN_NAME AS SELLER_NAME, 
        marketing_subagen.SUBAGEN_ADDRESS AS SELLER_ADDRESS, marketing_subagen.SUBAGEN_PHONE AS SELLER_PHONE");
        $this->db->from($this->_table);
        //$this->db->from('marketing_subagen');
        $this->db->join('marketing_subagen', 'selling.SELLER_ID = marketing_subagen.ID', 'left');
        //$this->db->where('marketing_subagen.ID = selling.SELLER_ID');
        $this->db->where('marketing_subagen.ID', $id);
        return $this->db->get()->row();
    }

    public function getByDate($date)
    {
        /*$this->db->where('TGL_BELI', $date);
        $this->db->order_by('SALE_ID', 'DESC');
        return $this->db->get($this->_table)->result();*/
        $query = $this->db->query("SELECT * FROM `selling` WHERE DATE_FORMAT(`TGL_BELI`, 'm%Y%') = DATE_FORMAT('$date', 'm%Y%')");
        return $query->result();
    }

    public function getDateRange($date1, $date2)
    {
        $this->db->where("TGL_BELI BETWEEN '$date1' AND '$date2'");
        $this->db->order_by('SALE_ID', 'ASC');
        return $this->db->get($this->_table)->result_array();
    }

    public function getByInvoice($invoice)
    {
        return $this->db->get_where($this->_table, ['INVOICE' => $invoice])->row_array();
    }

    public function updateByInvoice($data)
    {
        return $this->db->update($this->_table, $data, ['INVOICE' => $data['INVOICE']]);
    }
}
