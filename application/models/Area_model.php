<?php

class Area_model extends CI_Model
{
    public function getAllProvince()
    {
        return $this->db->get('a_province')->result();
    }

    public function getCityByProvince($id)
    {
        return $this->db->get_where('a_city', ['province_id' => $id])->result();
    }
    
    public function getSubdistByCity($id)
    {
        return $this->db->get_where('a_subdistrict', ['city_id' => $id])->result();
    }

    public function getCityById($id)
    {
        $this->db->select('*');
        $this->db->from('a_province');
        $this->db->join('a_city', 'a_city.province_id = a_province.id');
        $this->db->where('a_city.id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function getSubdistById($id)
    {
        $this->db->select('*');
        $this->db->from('a_city');
        $this->db->join('a_province', 'a_city.province_id = a_province.id');
        $this->db->join('a_subdistrict', 'a_subdistrict.city_id = a_city.id');
        $this->db->where('a_subdistrict.id', $id);
        $query = $this->db->get();
        return $query->row();
    }
}