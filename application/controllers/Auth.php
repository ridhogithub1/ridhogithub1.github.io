<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // $this->load->model('User_model','userrole');    
        $this->load->library('form_validation');
    }

    public function index()
    {

        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->form_validation->run() == false) {
            // tidak berhasil login
            $data['title'] = 'Login';
            $this->load->view('layout/auth_header', $data);
            $this->load->view("auth/login");
            $this->load->view('layout/auth_footer');
        } else {
            $this->_login();
        }
    }

    private function  _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $user = $this->db->get_where('user', ['email' => $email])->row_array();
        // jika user ada       
        if ($user) {
            // user nya aktif
            if ($user['is_active'] == 1) {
                // chek password
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'email' => $user['email'],
                        'role_id' => $user['role_id']
                    ];
                    $this->session->set_userdata($data);
                    // ini bakalan masuk ke halaman user.
                    // kondisi untuk di masuk sebagai user atau sebagai admin.
                    if ($user['role_id'] == 1) {
                        redirect('user');
                    } else if($user['role_id'] == 2){
                        redirect('mahasiswa');
                    }

                    // else if($user['role_id'] == 3) {
                    //     redirect('kp');
                    // }
                    // redirect('user');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Wrong password!</div>');
                    //redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                This email has not been activated!
                </div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Email Is not registered!
          </div>');
            redirect('auth');
        }
    }

    // private function _login()
    // {

    //     $email = $this->input->post('email');
    //     $password = $this->input->post('password');
    //     $user = $this->db->get_where('user', ['email' => $email])->row_array();

    //     // jika user ada       
    //     if ($user) {
    //         // user nya aktif
    //         if ($user['is_active'] == 1) {
    //             // check password
    //             if (password_verify($password, $user['password'])) {
    //                 $data = [
    //                     'email' => $user['email'],
    //                     'role_id' => $user['role_id']
    //                 ];
    //                 $this->session->set_userdata($data);

    //                 // Redirect to the appropriate page based on role_id
    //                 if ($user['role_id'] == 1) {
    //                     redirect('user');
    //                 } else if ($user['role_id'] == 2) {
    //                     redirect('mahasiswa');
    //                 }
    //             } else {
    //                 $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
    //                 Wrong password!</div>');
    //             }
    //         } else {
    //             $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
    //             This email has not been activated!</div>');
    //         }
    //     } else {
    //         $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
    //         Email Is not registered!</div>');
    //     }

    //     if ($this->session->flashdata('message')) {
    //         echo '<div class="alert alert-danger" role="alert">' . $this->session->flashdata('message') . '</div>';
    //     }


    //     // Load the login page with error message

    //     // $data['title'] = 'Login';
    //     // $this->load->view('layout/auth_header', $data);
    //     // $this->load->view("auth/login");
    //     // $this->load->view('layout/auth_footer');
    // }


    public function registrasi()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'is_unique' => 'This email has already registered!'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'matches' => 'password dont match!',
            'min_length' => 'password to short!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Registrasi';
            $this->load->view('layout/auth_header', $data);
            $this->load->view('auth/registrasi');
            $this->load->view('layout/auth_footer');
        } else {
            $data = [
                'nama' => htmlentities($this->input->post('nama', true)),
                'email' => htmlentities($this->input->post('email', true)),
                'image' => 'default.jpg',
                'password' => password_hash(
                    $this->input->post('password1'),
                    PASSWORD_DEFAULT
                ),
                'role_id' => 2,
                // role 2 = member, role 1 = admin
                'is_active' => 1,
                //is_active 1 = aktif, is_active = 0 tidak aktif
                'date_created' => time()

            ];
            $this->db->insert('user', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Congratulation, Your Acount has been created. Please Login!
          </div>');
            redirect('auth');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            You Has been Log Out
            </div>');
        redirect('auth');
    }
}
