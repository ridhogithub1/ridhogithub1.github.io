<?php
class Report_model extends CI_Model
{
    public $table = 'report';
    public $id = 'report.id';

    public function __construct()
    {
        parent::__construct();

        // Load necessary libraries and helpers here
        $this->load->library('form_validation');
    }

    // public function get()
    // {
    //     $query = $this->db->get($this->table);
    //     return $query->result_array();
    // }



    public function getMonthlyReportData()
    {
        $this->db->select('MONTH(tanggal) as month, COUNT(id) as count');
        $this->db->from('report');
        $this->db->group_by('MONTH(tanggal)');
        $result = $this->db->get()->result_array();

        $data['labels'] = [];
        $data['data'] = [];

        foreach ($result as $row) {
            $data['labels'][] = date("F", mktime(0, 0, 0, $row['month'], 1));
            $data['data'][] = $row['count'];
        }

        return $data;
    }

    public function get()
    {
        // $this->db->from($this->table);
        // $query = $this->db->get();
        // return $query->result_array();
        $query = $this->db->get('report');
        return $query->result_array();
    }
    // public function getById($id)
    // {
    //     // Ambil data report berdasarkan ID
    //     return $this->db->get_where($this->table, ['id' => $id])->row_array();
    // }

    public function getSomeReport()
    {
        // Di sini Anda bisa menentukan logika untuk memilih laporan tertentu
        // Misalnya, laporan yang dibuat dalam 7 hari terakhir
        $sevenDaysAgo = date('Y-m-d', strtotime('-7 days'));
        $this->db->where('tanggal >=', $sevenDaysAgo);
        return $this->db->get('report')->result_array();
    }
    public function getById($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get($this->table);
        return $query->row_array();
    }
    public function tampil_data($table)
    {
        return $this->db->get($table)->result_array();
    }


    public function get_report_by_id($id)
    {
        return $this->db->get_where('report', array('id' => $id))->row_array();
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update($this->table, $data);
    }


    public function insert($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
        return $this->db->affected_rows();
    }

    public function getUsers()
    {
        return $this->db->get($this->table)->result_array();
    }

    public function get_report_data()
    {
        // Mengambil semua data dari tabel 'report'
        return $this->db->get($this->table)->result_array();
    }
    public function getByUser($email)
    {
        // Mengambil data report berdasarkan email mahasiswa
        return $this->db->get_where('report', ['email' => $email])->result_array();
    }
    public function getByUserId($user_id)
    {
        // Membuat query untuk mengambil data report berdasarkan id pengguna
        $this->db->where('user_id', $user_id); // Menggunakan kolom 'user_id' sebagai referensi
        $query = $this->db->get('report');
    
        // Mengembalikan hasil query
        return $query->result_array();
    }
 
}
