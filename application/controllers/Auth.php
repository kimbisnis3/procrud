<?php

class Auth extends CI_Controller{

    function __construct(){
        parent::__construct();
    }

    function index(){
        $this->load->view('auth/v_auth');
    }

    function auth_process(){
        $username = $this->input->post('username');
        $password = $this->input->post('pass');
            $where = array(
                'user'  => $username,
                'pass'  => $password,
                );
            $cek = $this->db->get_where("muser",$where)->num_rows();
            $result = $this->db->get_where('muser',array('user' => $username ))->row();
            if($cek > 0){
                $this->db->trans_start();
                $d = array(
                    'status'    => "online",
                    'masuk'     => TRUE,
                    'id'        => $result->id,
                    'nama'      => $result->nama,
                    'username'  => $result->user,
                );
                $this->session->set_userdata($d);
                $this->db->trans_complete();
                $r['result']    = 'success';
                $r['caption']   = 'Sukses';
                $r['msg']       = 'Login Sukses';
                $r['class']     = 'success';
                echo json_encode($r);

            }else{
                $r['result']    = 'fail';
                $r['caption']   = 'Gagal';
                $r['msg']       = 'Username dan Password tidak sesuai';
                $r['class']     = 'danger';
                echo json_encode($r);
            }
    }
    
    function logout(){
        $this->session->sess_destroy();
        redirect(base_url('auth'));
    }
}
