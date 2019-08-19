<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Masterktg extends CI_Controller {
    
    public $table       = 'mktg';
    public $foldername  = 'mktg';
    public $indexpage   = 'masterktg/v_masterktg';
    function __construct() {
        parent::__construct();
    }
    function index(){
        $this->load->view($this->indexpage);  
    }

    public function getall(){
        $q = "SELECT 
            *
        FROM 
            mktg";
        $result     = $this->db->query($q)->result();
        $list       = [];
        foreach ($result as $i => $r) {
            $row['id']      = $r->id;
            $row['no']      = $i + 1;
            $row['nama']    = $r->nama;
            $row['artikel'] = $r->artikel;
            $row['image']   = showimage($r->image);
            $row['ket']     = $r->ket;

            $list[] = $row;
        }   
        echo json_encode(array('data' => $list));
    }

    public function edit()
    {
        $w['id']= $this->input->post('id');
        $data   = $this->db->get_where($this->table,$w)->row();
        echo json_encode($data);
    }

    public function savedata()
    {   
        $path = $this->libre->goUpload('image','img-'.time(),$this->foldername);
        $d['image']       = $path;
        $d['nama']      = $this->input->post('nama');
        $d['artikel']   = $this->input->post('artikel');
        $d['ket']       = $this->input->post('ket');
        $result = $this->db->insert($this->table,$d);
        $r['sukses'] = $result ? 'success' : 'fail' ;
        echo json_encode($r);
    }

    function updatedata()
    {
        //cek apakah kosong atau tidak (gambar diperbaharui atau tidak)
        if (!empty($_FILES['image']['name'])) {
            $path = $this->libre->goUpload('image','img-'.time(),$this->foldername);
            $d['image'] = $path;
            $oldpath = $this->input->post('path');
            @unlink(".".$oldpath);
        } else {
            $d['image'] = $this->input->post('path');
        }

        $d['nama']      = $this->input->post('nama');
        $d['artikel']   = $this->input->post('artikel');
        $d['ket']       = $this->input->post('ket');
        $w['id'] = $this->input->post('id');

        $result = $this->db->update($this->table,$d,$w);
        $r['sukses']    = $result ? 'success' : 'fail' ;
        echo json_encode($r);
    }



    public function deletedata()
    {
        $w['id'] = $this->input->post('id');
        $path = $this->db->get_where($this->table,$w)->row()->image;
        
        @unlink('.'.$path);
        
        $result = $this->db->delete($this->table,$w);
        $r['sukses'] = $result ? 'success' : 'fail' ;
        echo json_encode($r);
    }
}