<?php

class Kategori_model extends CI_Model
{
    public function getAllKategori()
    {
        return $this->db->get('product_category')->result();
    }

    public function addKategori()
    {
        $data = array(
            "CATEGORY_NAME" => $this->input->post('kategoriname', true)
        );

        $this->db->insert('product_category',  $data);
    }

    public function delKategori($id)
    {
        $this->db->where('ID', $id);
        $this->db->delete('product_category');
    }

    public function getKategoriById($id)
    {
        return $this->db->get_where('product_category', ['ID' => $id])->row();
    }

    public function editKategori()
    {
        $data = array(
            "CATEGORY_NAME" => $this->input->post('kategoriname', true)
        );

        $this->db->where('ID', $this->input->post('id'));
        $this->db->update('product_category',  $data);
    }

}