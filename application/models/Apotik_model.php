<?php

class Apotik_model extends CI_Model
{
    public function getAllApotik()
    {
        $this->db->select('apotik.*');
        $this->db->select('marketing.MARKETING_NAME');
        $this->db->from('apotik');
        $this->db->join('marketing', 'marketing.ID = apotik.MARKETING_ID', 'left');
        return $this->db->get()->result();
    }

    public function addApotik($data)
    {
        $this->db->insert('apotik',  $data);
    }

    public function delApotik($id)
    {
        $this->db->where('ID', $id);
        $this->db->delete('apotik');
    }

    public function getApotikById($id)
    {
        return $this->db->get_where('apotik', ['ID' => $id])->row();
    }

    public function editApotik($data)
    {
        $this->db->where('ID', $data['ID']);
        $this->db->update('apotik',  $data);
    }
}
