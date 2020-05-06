<?php

class SubAgen_model extends CI_Model
{
    public function getAllSubAgen()
    {
        return $this->db->get('marketing_subagen')->result();
    }

    public function addSubAgen()
    {
        $data = array(
            "AGEN_ID" => $this->input->post('agenid', true),
            "ID_CARD" => $this->input->post('ktpsubagen', true),
            "SUBAGEN_NAME" => $this->input->post('namasubagen', true),
            "SUBAGEN_ADDRESS" => $this->input->post('alamatsubagen', true),
            "SUBAGEN_PHONE" => $this->input->post('telpsubagen', true),
            "AREA" => $this->input->post('areasubagen', true)
            // "PHOTO" => $this->input->post('suplierphone', true),
            // "SCAN_ID" => $this->input->post('suplierphone', true),
            // "JOIN_DATE" => $this->input->post('suplierphone', true)
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