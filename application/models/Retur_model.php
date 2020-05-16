<?php
class Retur_model extends CI_Model
{

    private $_table = 'return';

    public $INVOICE;
    public $TGL_RETUR;
    public $QTY;
    public $KETERANGAN;
    public $STATUS; // value ex ('sudah diganti', 'belum diganti')
    public $TGL_GANTI;

    public function rules()
    {
        return [
            [
                'field' => 'invoice',
                'label' => 'No. Invoice',
                'rules' => 'required'
            ],
            [
                'field' => 'tglretur',
                'label' => 'Tgl Retur',
                'rules' => 'required'
            ],
            [
                'field' => 'qty',
                'label' => 'Quantity',
                'rules' => 'required'
            ]
        ];
    }
    public function save()
    {

        $post = $this->input->post();

        $this->INVOICE    = $post['invoice'];
        $this->TGL_RETUR  = $post['tglretur'];
        $this->QTY        = $post['qty'];
        $this->KETERANGAN = $post['keterangan'];
        $this->STATUS     = "belum";
        $this->TGL_GANTI  = "0000-00-00";

        return $this->db->insert($this->_table, $this);
    }

    public function getAlldata()
    {
        $this->db->order_by('TGL_RETUR', 'DESC');
        return $this->db->get($this->_table)->result_array();
    }

    public function getById($id)
    {
        return $this->db->get_where($this->_table, ['ID' => $id])->row_array();
    }

    public function getByInvoice($invoice)
    {
        return $this->db->get_where($this->_table, ['INVOICE' => $invoice])->row_array();
    }

    public function update($data)
    {
        return $this->db->update($this->_table, $data, ['ID' => $data['ID']]);
    }
}
