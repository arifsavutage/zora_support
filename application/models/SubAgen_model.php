<?php

class SubAgen_model extends CI_Model
{
    public function getAllSubAgen()
    {
        $this->db->select('marketing_subagen.*');
        $this->db->select('marketing_agen.AGEN_NAME');
        $this->db->select('a_subdistrict.subdistrict_name');
        $this->db->from('marketing_subagen');
        $this->db->join('marketing_agen', 'marketing_agen.ID = marketing_subagen.AGEN_ID', 'left');
        $this->db->join('a_subdistrict', 'a_subdistrict.id = marketing_subagen.AREA', 'left');
        return $query = $this->db->get()->result();
    }

    public function addSubAgen($data)
    {
        $this->db->insert('marketing_subagen',  $data);
    }

    public function delSubAgen($id)
    {
        $this->db->where('ID', $id);
        $this->db->delete('marketing_subagen');
    }

    public function getSubAgenById($id)
    {
        return $this->db->get_where('marketing_subagen', ['ID' => $id])->row();
    }

    public function editSubAgen($data)
    {
        $this->db->where('ID', $data['ID']);
        $this->db->update('marketing_subagen',  $data);
    }

}