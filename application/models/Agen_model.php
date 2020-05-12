<?php

class Agen_model extends CI_Model
{
    public function getAllAgen()
    {
        $this->db->select('marketing_agen.*');
        $this->db->select('marketing.MARKETING_NAME');
        $this->db->select('a_city.city_name');
        $this->db->from('marketing_agen');
        $this->db->join('marketing', 'marketing.ID = marketing_agen.MARKETING_ID', 'left');
        $this->db->join('a_city', 'a_city.id = marketing_agen.AREA', 'left');
        return $query = $this->db->get()->result();
    }

    public function addAgen($data)
    {
        $this->db->insert('marketing_agen',  $data);
    }

    public function delAgen($id)
    {
        $this->db->where('ID', $id);
        $this->db->delete('marketing_agen');
    }

    public function getAgenById($id)
    {
        return $this->db->get_where('marketing_agen', ['ID' => $id])->row();
    }

    public function editAgen($data)
    {
        $this->db->where('ID', $data['ID']);
        $this->db->update('marketing_agen',  $data);
    }

}