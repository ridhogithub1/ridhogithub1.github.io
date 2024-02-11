<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Mahasiswa extends CI_Controller
{
    // sudah selesai, jangan di otak atikkk
    public function __construct()
    {
        parent::__construct();

        // Load necessary libraries and helpers here
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('Mahasiswa_model');

        // Load the Berita_model
        $this->load->model('Report_model');
        $this->load->model('Lomba_model');
        $this->load->model('Berita_model');
        $this->load->model('Club_model');
    }
    // inin asli
    public function index()
    {


        $data['report'] = $this->Report_model->get();


        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view("layout_user_mahasiswa/header", $data);
        $this->load->view("mahasiswa/dashboard", $data);
        $this->load->view("layout_user_mahasiswa/footer", $data);
    }



    public function report()
    {
        $this->load->model('Report_model');

        $data['report'] = $this->Report_model->get();

        $this->load->view("layout_user_mahasiswa/header", $data);
        $this->load->view("mahasiswa/vw_mahasiswa_report", $data);
        $this->load->view("layout_user_mahasiswa/footer");
    }



    public function getMonthlyReportData()
    {
        $monthlyData = $this->Report_model->getMonthlyReportData();
        echo json_encode($monthlyData);
    }

    public function tambah_report()
    {
        $data['judul'] = "Halaman Tambah Report";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        // Atur aturan validasi
        $this->form_validation->set_rules('tanggal', 'tanggal', 'required');
        $this->form_validation->set_rules('estate', 'estate', 'required');
        $this->form_validation->set_rules('location', 'location', 'required');
        $this->form_validation->set_rules('region', 'region', 'required');
        $this->form_validation->set_rules('department', 'department', 'required');
        $this->form_validation->set_rules('kegiatan', 'kegiatan', 'required');
        $this->form_validation->set_rules('kontraktor', 'kontraktor', 'required');
        $this->form_validation->set_rules('inspector', 'inspector', 'required');
        $this->form_validation->set_rules('jenis_pelanggaran_nosa', 'jenis_pelanggaran_nosa', 'required');
        $this->form_validation->set_rules('hpi', 'hpi', 'required');
        $this->form_validation->set_rules('type_nc', 'type_nc', 'required');
        $this->form_validation->set_rules('pengawas', 'pengawas', 'required');
        $this->form_validation->set_rules('action_plan', 'action_plan', 'required');
        $this->form_validation->set_rules('nik', 'nik', 'required');
        $this->form_validation->set_rules('deadline', 'deadline', 'required');
        $this->form_validation->set_rules('status', 'status', 'required');
        $this->form_validation->set_rules('planed', 'planed', 'required');
        // Tambahkan aturan validasi untuk gambar
        // kalau tampa gambar dia berhasil, kalau ada gambar dia gagal. 
        $this->form_validation->set_rules('gambar', 'gambar', 'callback_check_upload');
        // Konfigurasi untuk upload gambar
        $config['upload_path']          = './gambar/';
        $config['allowed_types']        = 'gif|jpg|png|PNG';
        $config['max_size']             = 100000;
        $config['max_width']            = 100000;
        $config['max_height']           = 100000;

        $this->load->library('upload', $config);

        // Jika validasi form gagal
        if ($this->form_validation->run() == false) {
            $this->load->view("layout_user_mahasiswa/header");
            $this->load->view("mahasiswa/vw_mahasiswa_tambah_report", $data);
            $this->load->view("layout_user_mahasiswa/footer");
        } else {
            // Jika upload gambar gagal
            if (!$this->upload->do_upload('gambar')) {
                $error = $this->upload->display_errors();
                // Tampilkan pesan error
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $error . '</div>');
                redirect('mahasiswa/tambah_report');
            } else {
                // Jika upload gambar berhasil
                $gambar_data = $this->upload->data();
                $gambar_name = $gambar_data['file_name'];

                // Buat array data untuk disimpan ke database
                $report_data = [
                    'tanggal' => $this->input->post('tanggal'),
                    'estate' => $this->input->post('estate'),
                    'location' => $this->input->post('location'),
                    'region' => $this->input->post('region'),
                    'department' => $this->input->post('department'),
                    'kegiatan' => $this->input->post('kegiatan'),
                    'kontraktor' => $this->input->post('kontraktor'),
                    'inspector' => $this->input->post('inspector'),
                    'jenis_pelanggaran_nosa' => $this->input->post('jenis_pelanggaran_nosa'),
                    'hpi' => $this->input->post('hpi'),
                    'type_nc' => $this->input->post('type_nc'),
                    'pengawas' => $this->input->post('pengawas'),
                    'action_plan' => $this->input->post('action_plan'),
                    'nik' => $this->input->post('nik'),
                    'deadline' => $this->input->post('deadline'),
                    'status' => $this->input->post('status'),
                    'planed' => $this->input->post('planed'),
                    'gambar' => $gambar_name // Simpan nama gambar ke dalam array
                ];

                // Simpan data ke database
                $this->Report_model->insert($report_data);

                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Report Berhasil Ditambah!</div>');

                // Redirect ke halaman kelola data
                redirect('mahasiswa/report');
            }
        }
    }

    public function check_upload()
    {
        // Cek apakah ada file yang diupload
        if (!empty($_FILES['gambar']['name'])) {
            return true; // File diupload
        } else {
            // Tidak ada file yang diupload, atur pesan error
            $this->form_validation->set_message('check_upload', 'Pilih gambar terlebih dahulu.');
            return false;
        }
    }






    // ini jangan di otak atik
    // public function tambah_report()
    // {
    //     $data['judul'] = "Halaman Tambah Report";
    //     $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

    //     $this->form_validation->set_rules('tanggal', 'tanggal', 'required');
    //     $this->form_validation->set_rules('estate', 'estate', 'required');
    //     $this->form_validation->set_rules('location', 'location', 'required');
    //     $this->form_validation->set_rules('region', 'region', 'required');
    //     $this->form_validation->set_rules('department', 'department', 'required');
    //     $this->form_validation->set_rules('kegiatan', 'kegiatan', 'required');
    //     $this->form_validation->set_rules('kontraktor', 'kontraktor', 'required');
    //     $this->form_validation->set_rules('inspector', 'inspector', 'required');
    //     $this->form_validation->set_rules('jenis_pelanggaran_nosa', 'jenis_pelanggaran_nosa', 'required');
    //     $this->form_validation->set_rules('hpi', 'hpi', 'required');
    //     $this->form_validation->set_rules('type_nc', 'type_nc', 'required');
    //     $this->form_validation->set_rules('pengawas', 'pengawas', 'required');
    //     $this->form_validation->set_rules('action_plan', 'action_plan', 'required');
    //     $this->form_validation->set_rules('nik', 'nik', 'required');
    //     $this->form_validation->set_rules('pelapor', 'pelapor', 'required');
    //     // $this->form_validation->set_rules('gambar', 'gambar', 'required');
    //     $this->form_validation->set_rules('deadline', 'deadline', 'required');
    //     $this->form_validation->set_rules('status', 'status', 'required');
    //     $this->form_validation->set_rules('planed', 'planed', 'required');
    //     // Konfigurasi untuk upload gambar
    //     $config['upload_path']          = './path/to/upload/directory/'; // Sesuaikan dengan lokasi penyimpanan gambar
    //     $config['allowed_types']        = 'gif|jpg|png'; // Format file yang diizinkan
    //     $config['max_size']             = 2048; // Ukuran maksimum file (dalam kilobita)
    //     $config['max_width']            = 0; // Lebar maksimum gambar (0 untuk tidak membatasi)
    //     $config['max_height']           = 0; // Tinggi maksimum gambar (0 untuk tidak membatasi)

    //     $this->load->library('upload', $config);

    //     if ($this->form_validation->run() == false) {
    //         $this->load->view("layout_user_mahasiswa/header");
    //         $this->load->view("mahasiswa/vw_mahasiswa_tambah_report", $data);
    //         $this->load->view("layout_user_mahasiswa/footer");
    //     } else {

    //         if (!$this->upload->do_upload('gambar')) {
    //             $error = $this->upload->display_errors();
    //             // Tampilkan pesan error
    //             $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $error . '</div>');
    //             redirect('mahasiswa/tambah_report');
    //         } else {

    //             $gambar_data = $this->upload->data();
    //             $gambar_name = $gambar_data['file_name'];
    //             $data = [
    //                 'tanggal' => $this->input->post('tanggal'),
    //                 'estate' => $this->input->post('estate'),
    //                 'location' => $this->input->post('location'),
    //                 'region' => $this->input->post('region'),
    //                 'department' => $this->input->post('department'),
    //                 'kegiatan' => $this->input->post('kegiatan'),
    //                 'kontraktor' => $this->input->post('kontraktor'),

    //                 'inspector' => $this->input->post('inspector'),
    //                 'jenis_pelanggaran_nosa' => $this->input->post('jenis_pelanggaran_nosa'),
    //                 'hpi' => $this->input->post('hpi'),
    //                 'type_nc' => $this->input->post('type_nc'),
    //                 'pengawas' => $this->input->post('pengawas'),

    //                 'action_plan' => $this->input->post('action_plan'),
    //                 'nik' => $this->input->post('nik'),
    //                 'pelapor' => $this->input->post('pelapor'),
    //                 'deadline' => $this->input->post('deadline'),
    //                 'status' => $this->input->post('status'),
    //                 'planed' => $this->input->post('planed'),
    //                 'gambar' => $gambar_name
    //             ];

    //             // Simpan data ke database
    //             $this->Report_model->insert($data);

    //             $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Report Berhasil Ditambah!</div>');

    //             // Redirect ke halaman kelola data
    //             redirect('mahasiswa/report');
    //         }
    //     }
    // }

    public function hapus_report($id)
    {
        $this->Report_model->delete($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" 
            role="alert">Data
            Report Berhasil Dihapus!</div>');
        redirect('mahasiswa/report');
    }


    public function edit_report($id)
    {

        $data['judul'] = "Halaman Edit Report";
        $data['report'] = $this->Report_model->getById($id);
        $this->form_validation->set_rules('tanggal', 'tanggal', 'required');
        $this->form_validation->set_rules('estate', 'estate', 'required');
        $this->form_validation->set_rules('location', 'location', 'required');
        $this->form_validation->set_rules('region', 'region', 'required');
        $this->form_validation->set_rules('department', 'department', 'required');
        $this->form_validation->set_rules('kegiatan', 'kegiatan', 'required');
        $this->form_validation->set_rules('kontraktor', 'kontraktor', 'required');

        $this->form_validation->set_rules('inspector', 'inspector', 'required');
        $this->form_validation->set_rules('jenis_pelanggaran_nosa', 'jenis_pelanggaran_nosa', 'required');
        $this->form_validation->set_rules('hpi', 'hpi', 'required');
        $this->form_validation->set_rules('type_nc', 'type_nc', 'required');
        $this->form_validation->set_rules('pengawas', 'pengawas', 'required');
        $this->form_validation->set_rules('action_plan', 'action_plan', 'required');
        $this->form_validation->set_rules('nik', 'nik', 'required');
        $this->form_validation->set_rules('pelapor', 'pelapor', 'required');
        $this->form_validation->set_rules('gambar', 'gambar', 'required');
        $this->form_validation->set_rules('deadline', 'deadline', 'required');
        $this->form_validation->set_rules('status', 'status', 'required');
        $this->form_validation->set_rules('planed', 'planed', 'required');
        if ($this->form_validation->run() == false) {
            // Pass $data to the view
            $this->load->view("layout_admin/header");
            $this->load->view("user/vw_edit_report", $data);  // Pass $data to the view
            $this->load->view("layout_admin/footer");
        } else {
            $update_data = [
                'tanggal' => $this->input->post('tanggal'),
                'estate' => $this->input->post('estate'),
                'location' => $this->input->post('location'),
                'region' => $this->input->post('region'),
                'department' => $this->input->post('department'),
                'kegiatan' => $this->input->post('kegiatan'),
                'kontraktor' => $this->input->post('kontraktor'),

                'inspector' => $this->input->post('inspector'),
                'jenis_pelanggaran_nosa' => $this->input->post('jenis_pelanggaran_nosa'),
                'hpi' => $this->input->post('hpi'),
                'type_nc' => $this->input->post('type_nc'),
                'pengawas' => $this->input->post('pengawas'),

                'action_plan' => $this->input->post('action_plan'),
                'nik' => $this->input->post('nik'),
                'pelapor' => $this->input->post('pelapor'),
                // 'gambar' => $this->input->post('gambar'),
                'deadline' => $this->input->post('deadline'),
                'status' => $this->input->post('status'),
                'planed' => $this->input->post('planed'),
            ];

            $this->Report_model->update(['id' => $id], $update_data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Report Berita Berhasil DiUbah!</div>');
            redirect('user/report');
        }
    }
}
