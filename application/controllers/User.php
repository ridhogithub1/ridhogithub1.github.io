<?php
defined('BASEPATH') or exit('No direct script access allowed');
require 'vendor/autoload.php';
require FCPATH . 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;

use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        // Tambahkan baris ini
        $this->load->model('User_model');
        $this->load->model('Club_model');
        $this->load->model('Lomba_model');
        $this->load->model('Berita_model');
        $this->load->model('Report_model');
    }
    // Dashboard
    public function index()
    {

        $data['report'] = $this->Report_model->get();

        $this->load->view("layout_admin/header", $data);
        $this->load->view('user/index', $data);
        $this->load->view("layout_admin/footer", $data);
    }

    // Data Report
    public function report()
    {
        $this->load->model('Report_model');
        $data['report'] = $this->Report_model->get();
        $this->load->view("layout_admin/header");
        $this->load->view("user/vw_admin_report", $data);
        $this->load->view("layout_admin/footer");
    }

    public function detail_report($id)
    {
        $this->load->model('Report_model'); // Memuat model Report_model
        $data['report'] = $this->Report_model->getById($id); // Mengambil data laporan
        $this->load->view("layout_admin/header");
        $this->load->view("user/vw_detail_report", $data); // Mem-passing data ke tampilan
        $this->load->view("layout_admin/footer");
    }



    // Fungsi callback untuk memeriksa upload gambar
    public function check_upload()
    {
        if (!empty($_FILES['gambar']['name'])) {
            return true;
        } else {
            $this->form_validation->set_message('check_upload', 'Pilih gambar terlebih dahulu.');
            return false;
        }
    }

    // Fungsi callback untuk memeriksa upload gambar



    public function hapus_report($id)
    {
        $this->Report_model->delete($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" 
            role="alert">Data
            Report Berhasil Dihapus!</div>');
        redirect('User/report');
    }
    // jangan di otak atik udah benar ni.
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
            $this->load->view("layout_admin/header", $data);
            $this->load->view("user/vw_admin_tambah_report", $data);
            $this->load->view("layout_admin/footer", $data);
        } else {
            // Jika upload gambar gagal
            if (!$this->upload->do_upload('gambar')) {
                $error = $this->upload->display_errors();
                // Tampilkan pesan error
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $error . '</div>');
                redirect('User/tambah_report');
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

                // Set pesan sukses
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Report Berhasil Ditambah!</div>');

                // Redirect ke halaman kelola data
                redirect('User/report');
            }
        }
    }
    public function edit_report($id)
    {
        $data['judul'] = "Halaman Edit Report";
        // Ambil data report berdasarkan ID
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['report'] = $this->Report_model->getById($id);

        // Pastikan data report ditemukan

        // Atur aturan validasi form
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

        // Tambahkan aturan validasi untuk gambar jika diperlukan
        $this->form_validation->set_rules('gambar', 'gambar', 'callback_check_upload');

        // Konfigurasi untuk upload gambar
        $config['upload_path']          = './gambar/';
        $config['allowed_types']        = 'gif|jpg|png|PNG';
        $config['max_size']             = 100000;
        $config['max_width']            = 100000;
        $config['max_height']           = 100000;

        $this->load->library('upload', $config);

        if ($this->form_validation->run() == false) {
            // Jika validasi gagal, tampilkan kembali halaman edit dengan pesan error
            $this->load->view("layout_admin/header", $data);
            $this->load->view("user/vw_edit_report", $data);
            $this->load->view("layout_admin/footer", $data);
        } else {
            if (!$this->upload->do_upload('gambar')) {
                $error = $this->upload->display_errors();
                // Tampilkan pesan error
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $error . '</div>');
                redirect('User/tambah_report');
            } else {
                // Jika upload gambar berhasil
                $gambar_data = $this->upload->data();
                $gambar_name = $gambar_data['file_name'];
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
                    'deadline' => $this->input->post('deadline'),
                    'status' => $this->input->post('status'),
                    'planed' => $this->input->post('planed'),
                    'gambar' => $gambar_name // Simpan nama gambar ke dalam array
                ];
            }
            // Lakukan pembaruan data dalam database
            $this->Report_model->update($id, $update_data);

            // Set flashdata untuk menampilkan pesan sukses
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Report Berita Berhasil DiUbah!</div>');

            // Redirect ke halaman daftar laporan
            redirect('user/report');
        }
    }


    // ------------------------------------------
    // public function edit_report($id)
    // {
    //     $data['judul'] = "Halaman Edit Report";
    //     // Ambil data report berdasarkan ID
    //     $data['report'] = $this->Report_model->getById($id);

    //     // Pastikan data report ditemukan

    //     // Atur aturan validasi form
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
    //     $this->form_validation->set_rules('deadline', 'deadline', 'required');
    //     $this->form_validation->set_rules('status', 'status', 'required');
    //     $this->form_validation->set_rules('planed', 'planed', 'required');

    //     // Tambahkan aturan validasi untuk gambar jika diperlukan
    //     $this->form_validation->set_rules('gambar', 'gambar', 'callback_check_upload');

    //     if ($this->form_validation->run() == false) {
    //         // Jika validasi gagal, tampilkan kembali halaman edit dengan pesan error
    //         $this->load->view("layout_admin/header", $data);
    //         $this->load->view("user/vw_edit_report", $data);
    //         $this->load->view("layout_admin/footer", $data);
    //     } else {
    //         // Jika validasi sukses, lakukan pemrosesan data laporan
    //         // Lakukan proses upload gambar jika diperlukan
    //         // $gambar_data = $this->upload->data();
    //         // $gambar_name = $gambar_data['file_name'];

    //         // Siapkan data untuk update
    //         $update_data = [
    //             'tanggal' => $this->input->post('tanggal'),
    //             'estate' => $this->input->post('estate'),
    //             'location' => $this->input->post('location'),
    //             'region' => $this->input->post('region'),
    //             'department' => $this->input->post('department'),
    //             'kegiatan' => $this->input->post('kegiatan'),
    //             'kontraktor' => $this->input->post('kontraktor'),
    //             'inspector' => $this->input->post('inspector'),
    //             'jenis_pelanggaran_nosa' => $this->input->post('jenis_pelanggaran_nosa'),
    //             'hpi' => $this->input->post('hpi'),
    //             'type_nc' => $this->input->post('type_nc'),
    //             'pengawas' => $this->input->post('pengawas'),
    //             'action_plan' => $this->input->post('action_plan'),
    //             'nik' => $this->input->post('nik'),
    //             'pelapor' => $this->input->post('pelapor'),
    //             // 'gambar' => $gambar_name, // Simpan nama gambar ke dalam array jika diperlukan
    //             'deadline' => $this->input->post('deadline'),
    //             'status' => $this->input->post('status'),
    //             'planed' => $this->input->post('planed'),
    //         ];

    //         // Lakukan pembaruan data dalam database
    //         $this->Report_model->update($id, $update_data);

    //         // Set flashdata untuk menampilkan pesan sukses
    //         $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Report Berita Berhasil DiUbah!</div>');

    //         // Redirect ke halaman daftar laporan
    //         redirect('user/report');
    //     }
    // }





    // ------------------------------------------

    // public function check_upload1()
    // {
    //     $this->load->library('upload');

    //     if (!empty($_FILES['gambar']['name'])) {
    //         $config['upload_path'] = './gambar/';
    //         $config['allowed_types'] = 'gif|jpg|png|PNG';
    //         $config['max_size'] = 100000;
    //         $config['max_width'] = 100000;
    //         $config['max_height'] = 100000;
    //         $this->upload->initialize($config);

    //         if (!$this->upload->do_upload('gambar')) {
    //             $this->form_validation->set_message('check_upload1', $this->upload->display_errors());
    //             return false;
    //         } else {
    //             return true;
    //         }
    //     } else {
    //         // Jika tidak ada file yang diunggah, maka tidak ada yang perlu diperiksa
    //         return true;
    //     }
    // }


    // ------------------------------------------


    // dari ai
    // public function excel()
    // {
    //     $spreadsheet = new Spreadsheet();
    //     $sheet = $spreadsheet->getActiveSheet();

    //     foreach (range('A', 'F') as $coulumID) {
    //         $spreadsheet->getActiveSheet()->getColumnDimension($coulumID)->setAutosize(true);
    //     }

    //     $sheet->setCellValue('A1', 'ID');
    //     // harus ada bulan
    //     $sheet->setCellValue('B1', 'Bulan');
    //     $sheet->setCellValue('C1', 'Tanggal');
    //     $sheet->setCellValue('D1', 'Estate');
    //     $sheet->setCellValue('E1', 'Region');
    //     $sheet->setCellValue('F1', 'Location');
    //     $sheet->setCellValue('G1', 'Department');

    //     $users = $this->db->query("SELECT * FROM report")->result_array();
    //     $x = 2; //start from row 2
    //     foreach ($users as $row) {
    //         $sheet->setCellValue('A' . $x, $row['id']);
    //         // disini harus ada bulan
    //         $sheet->setCellValue('A' . $x, $row['bulan']);
    //         $sheet->setCellValue('B' . $x, $row['tanggal']);
    //         $sheet->setCellValue('C' . $x, $row['estate']);
    //         $sheet->setCellValue('D' . $x, $row['region']);
    //         $sheet->setCellValue('E' . $x, $row['location']);
    //         $sheet->setCellValue('F' . $x, $row['department']);
    //         $sheet->setCellValue('F' . $x, $row['kegiatan']);
    //         $sheet->setCellValue('F' . $x, $row['kontraktor']);
    //         $sheet->setCellValue('F' . $x, $row['inspector']);
    //         $sheet->setCellValue('F' . $x, $row['planed']);
    //         $sheet->setCellValue('F' . $x, $row['jenis_pelanggaran_nosa']);
    //         $sheet->setCellValue('F' . $x, $row['hpi']);
    //         $sheet->setCellValue('F' . $x, $row['deadline']);
    //         $sheet->setCellValue('F' . $x, $row['hari_open']);
    //         $sheet->setCellValue('F' . $x, $row['gambar']);
    //         $sheet->setCellValue('F' . $x, $row['pengawas']);
    //         $sheet->setCellValue('F' . $x, $row['action_plan']);
    //         $sheet->setCellValue('F' . $x, $row['nik']);
    //         $sheet->setCellValue('F' . $x, $row['status']);

    //         $x++;
    //     }

    //     $writer = new Xlsx($spreadsheet);
    //     $fileName = 'Data_Nosa_Report.csv';
    //     //$writer->save($fileName);  //this is for save in folder


    //     /* for force download */
    //     header('Content-Type: appliction/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    //     header('Content-Disposition: attachment; filename="' . $fileName . '"');
    //     $writer->save('php://output');
    //     /* force download end */
    // }

    public function excel()
    {
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		
		foreach(range('A','F') as $coulumID) {
			$spreadsheet->getActiveSheet()->getColumnDimension($coulumID)->setAutosize(true);

		}
		$sheet->setCellValue('A1','ID');
		$sheet->setCellValue('B1','Tanggal');
		$sheet->setCellValue('C1','Estate');
		$sheet->setCellValue('D1','Region');
		$sheet->setCellValue('E1','Location');
		$sheet->setCellValue('F1','Department');
		$sheet->setCellValue('G1','Kegiatan');
		$sheet->setCellValue('H1','kontraktor');
		$sheet->setCellValue('I1','inspector');
		$sheet->setCellValue('J1','Jenis Pelanggaran Nosa');
		$sheet->setCellValue('K1','HPI');
		$sheet->setCellValue('L1','Type NC');
		$sheet->setCellValue('M1','pengawas');
		$sheet->setCellValue('N1','action_plan');
		$sheet->setCellValue('O1','nik');
		$sheet->setCellValue('P1','pelapor');
		// $sheet->setCellValue('P1','Hari Open');
		$sheet->setCellValue('Q1','Deadline');
		$sheet->setCellValue('R1','Status');
		$sheet->setCellValue('S1','Planed');


		$users = $this->db->query("SELECT * FROM report")->result_array();
		$x=2; //start from row 2
		foreach($users as $row)
		{
			$sheet->setCellValue('A'.$x, $row['id']);
			$sheet->setCellValue('B'.$x, $row['tanggal']);
			$sheet->setCellValue('C'.$x, $row['estate']);
			$sheet->setCellValue('D'.$x, $row['region']);
			$sheet->setCellValue('E'.$x, $row['location']);
			$sheet->setCellValue('F'.$x, $row['department']);
			$sheet->setCellValue('G'.$x, $row['kegiatan']);
			$sheet->setCellValue('H'.$x, $row['kontraktor']);
			$sheet->setCellValue('I'.$x, $row['inspector']);
			$sheet->setCellValue('J'.$x, $row['jenis_pelanggaran_nosa']);
			$sheet->setCellValue('K'.$x, $row['hpi']);
			$sheet->setCellValue('L'.$x, $row['type_nc']);
			$sheet->setCellValue('M'.$x, $row['pengawas']);
			$sheet->setCellValue('N'.$x, $row['action_plan']);
			$sheet->setCellValue('O'.$x, $row['nik']);
			$sheet->setCellValue('P'.$x, $row['pelapor']);
            // disini harusny ada hari open
            // $sheet->setCellValue('F'.$x, $row['pelapor']);

            $sheet->setCellValue('Q'.$x, $row['deadline']);
			$sheet->setCellValue('R'.$x, $row['status']);
			$sheet->setCellValue('S'.$x, $row['planed']);
			$x++;
		}

		$writer = new Xlsx($spreadsheet);
		$fileName='Data_Nosa_Report.csv';
		//$writer->save($fileName);  //this is for save in folder


		/* for force download */
		header('Content-Type: appliction/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="'.$fileName.'"');
		$writer->save('php://output');
		/* force download end */
	}
    


    // asli
    // function print()
    // {
    //     $html = $this->load->view('receipt_pdf','',true);
    //     $mpdf = new \Mpdf\Mpdf([
    //         'format'=>'A4',
    //         'margin_top'=>0,
    //         'margin_right'=>0,
    //         'margin_left'=>0,
    //         'margin_bottom'=>0,
    //     ]);
    //     $mpdf->WriteHTML($html);
    //     $mpdf->Output();
    // }

    public function detail_reports($id)
    {
        $this->load->model('Report_model'); // Memuat model Report_model
        $data['report'] = $this->Report_model->getById($id); // Mengambil data laporan
        $this->load->view("layout_admin/header");
        $this->load->view("user/vw_detail_report", $data); // Mem-passing data ke tampilan
        $this->load->view("layout_admin/footer");
    }

    function pdf($id)
    {
        $this->load->model('Report_model');
        $data['report'] = $this->Report_model->getById($id);

        $html = $this->load->view('receipt_pdf', $data, true);
        $mpdf = new \Mpdf\Mpdf([
            'format' => 'A4',
            'margin_top' => 0,
            'margin_right' => 0,
            'margin_left' => 0,
            'margin_bottom' => 0,
        ]);
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }







    // Data user

    public function data()
    {
    }
    public function tambah_data()
    {
    }
    public function hapus_data()
    {
    }
    public function edit_data()
    {
    }
}
