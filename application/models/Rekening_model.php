<?php
class Rekening_model extends CI_Model
{
    private $_table = 'op_pos';

    public $POS_NAME;
    public $POSITION;
    public $KETERANGAN;

    public function rules()
    {
        return [
            [
                'field' => 'namapos',
                'label' => 'Nama Rekening',
                'rules' => 'required'
            ],
        ];
    }

    public function save()
    {
        $post   = $this->input->post();

        $this->POS_NAME     = $post['namapos'];
        $this->POSITION     = '';
        $this->KETERANGAN   = $post['keterangan'];

        return $this->db->insert($this->_table, $this);
    }

    public function getAll()
    {
        $this->db->order_by('POS_NAME', 'ASC');
        return $this->db->get($this->_table)->result_array();
    }

    public function getById($id)
    {
        return $this->db->get_where($this->_table, ['ID' => $id])->row_array();
    }

    public function update($data)
    {
        return $this->db->update($this->_table, $data, ['ID' => $data['ID']]);
    }
}
