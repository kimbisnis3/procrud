<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mastersubktg extends CI_Controller {
    
    public $table       = 'msubktg';
    public $foldername  = 'msubktg';
    public $indexpage   = 'mastersubktg/v_mastersubktg';
    function __construct() {
        parent::__construct();
    }
    function index(){
        $data['ktg'] = $this->db->get('mktg')->result();
        $this->load->view($this->indexpage,$data);  
    }

    public function getall(){
        $q = "SELECT 
            msubktg.*,
            mktg.nama mktg_nama
        FROM 
            msubktg
        LEFT JOIN mktg ON mktg.id = msubktg.ref_ktg";
        $result     = $this->db->query($q)->result();
        $list       = [];
        foreach ($result as $i => $r) {
            $row['id']      = $r->id;
            $row['no']      = $i + 1;
            $row['nama']    = $r->nama;
            $row['mktg_nama']= $r->mktg_nama;
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
        $d['ref_ktg']   = $this->input->post('ref_ktg');
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
        $d['ref_ktg']   = $this->input->post('ref_ktg');
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