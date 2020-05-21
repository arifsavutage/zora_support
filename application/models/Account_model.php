<?php
class Account_model extends CI_Model
{

    private $_table = 'user_account';

    public $ID;
    public $ID_USER;
    public $USER_TYPE;
    public $USERNAME;
    public $EMAIL;
    public $PASSWORD;
    public $LEVEL;

    public function rules()
    {
        return [
            [
                'field' => 'username',
                'label' => 'Username',
                'rules' => 'required'
            ],
            [
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'required|valid_email'
            ],
            [
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'trim|required|min_length[8]'
            ]

        ];
    }

    public function rules_pass()
    {
        return [
            [
                'field' => 'oldpass',
                'label' => 'Password Lama',
                'rules' => 'required'
            ],
            [
                'field' => 'newpass',
                'label' => 'Password Baru',
                'rules' => 'trim|required|min_length[8]'
            ],
            [
                'field' => 'newpass2',
                'label' => 'Re-type Password Baru',
                'rules' => 'trim|required|matches[newpass]'
            ],

        ];
    }

    public function save()
    {
        $post   = $this->input->post();

        $this->ID_USER   = $post['iduser'];
        $this->USER_TYPE = $post['tipe'];
        $this->USERNAME  = $post['username'];
        $this->EMAIL     = $post['email'];
        $this->PASSWORD  = password_hash($post['password'], PASSWORD_DEFAULT);
        $this->LEVEL     = $post['level'];

        return $this->db->insert($this->_table, $this);
    }

    public function update()
    {
        $post   = $this->input->post();

        $this->ID        = $post['id'];
        $this->USERNAME  = $post['username'];
        $this->EMAIL     = $post['email'];
        $this->PASSWORD  = password_hash($post['password'], PASSWORD_DEFAULT);
        $this->LEVEL     = $post['level'];

        return $this->db->update($this->_table, $this, ['ID' => $post['id']]);
    }

    public function ubahpass($data)
    {
        return $this->db->update($this->_table, $data, ['ID' => $data['ID']]);
    }

    public function getAccountByEmail($email)
    {
        $this->db->where('EMAIL', "$email");
        return $this->db->get($this->_table)->row_array();
    }

    public function getAccountById($id)
    {
        return $this->db->get_where($this->_table, ['ID' => $id])->row_array();
    }

    public function delete($id)
    {
        $this->db->where('ID', $id);
        return $this->db->delete($this->_table);
    }

    public function getAll()
    {
        $this->db->where('LEVEL !=', 'superadmin');
        return $this->db->get($this->_table)->result_array();
    }
}
