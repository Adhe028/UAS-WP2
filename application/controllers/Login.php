<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {

        $this->form_validation->set_rules('user_name', 'User_name', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Login Page';
            $this->load->view('login', $data);
        } else {
            // validasinya success
            $this->_login();
        }
    }


    private function _login()
    {
        $uname = $this->input->post('user_name');
        $password = $this->input->post('password');

        $admin = $this->db->get_where('admin', ['user_name' => $uname])->row_array();

        // jika usernya ada
        if ($admin) {
            // jika usernya aktif
            if ($admin['is_active'] == 1) {
                // cek password
                if (password_verify($password, $admin['password'])) {
                    $data = [
                        'user_name' => $admin['user_name'],
                    ];
                    $this->session->set_userdata($data);
                    redirect('home');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong password!</div>');
                    redirect('login');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">This email has not been activated!</div>');
                redirect('login');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email is not registered!</div>');
            redirect('login');
        }
    }

    public function register()
    {

        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('user_name', 'User_name', 'required|trim');
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'matches' => 'Password dont match!',
            'min_length' => 'Password too short!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Register';
            $this->load->view('register', $data);
        } else {
            $uname = $this->input->post('user_name', true);
            $data = [
                'nama_lengkap' => htmlspecialchars($this->input->post('name', true)),
                'user_name' => htmlspecialchars($uname),
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'is_active' => 1,
      
            ];

            $this->db->insert('admin',$data);
            redirect('login');
        }
    }

    public function logout()
    {
        // hancurkan semua sesi
        $this->session->sess_destroy();
        redirect('login');
    }


}