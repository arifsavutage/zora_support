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

    public function addSubAgen()
    {
        $data = array(
            "AGEN_ID" => $this->input->post('agenid', true),
            "ID_CARD" => $this->input->post('ktpsubagen', true),
            "SUBAGEN_NAME" => $this->input->post('namasubagen', true),
            "SUBAGEN_ADDRESS" => $this->input->post('alamatsubagen', true),
            "SUBAGEN_PHONE" => $this->input->post('telpsubagen', true),
            "AREA" => $this->input->post('areasubagen', true),
            "JOIN_DATE" => date("Y-m-d")
            // "PHOTO" => $this->input->post('suplierphone', true),
            // "SCAN_ID" => $this->input->post('suplierphone', true),
        );

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

    public function editSubAgen()
    {
        $data = array(
            "AGEN_ID" => $this->input->post('agenid', true),
            // "ID_CARD" => $this->input->post('ktpsubagen', true),
            "SUBAGEN_NAME" => $this->input->post('namasubagen', true),
            "SUBAGEN_ADDRESS" => $this->input->post('alamatsubagen', true),
            "SUBAGEN_PHONE" => $this->input->post('telpsubagen', true),
            "AREA" => $this->input->post('areasubagen', true)
            // "PHOTO" => $this->input->post('', true),
            // "SCAN_ID" => $this->input->post('', true)
        );

        $this->db->where('ID', $this->input->post('id'));
        $this->db->update('marketing_subagen',  $data);
    }

}