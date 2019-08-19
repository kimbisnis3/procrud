<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Masterbrg extends CI_Controller {
    
    public $table       = 'mbrg';
    public $foldername  = 'mbrg';
    public $indexpage   = 'masterbrg/v_masterbrg';
    function __construct() {
        parent::__construct();
    }
    function index(){
        $q = "SELECT
                msubktg.id,
                CONCAT('Kategori : ', msubktg.nama, ' - ' ,mktg.nama) nama
            FROM
                msubktg
            LEFT JOIN mktg ON mktg.id = msubktg.ref_ktg";
        $data['subktg'] = $this->db->query($q)->result();
        $this->load->view($this->indexpage,$data);  
    }

    public function getall(){
        $q = "SELECT
                mbrg.*, mktg.nama mktg_nama,
                msubktg.nama msubktg_nama
            FROM
                mbrg
            LEFT JOIN msubktg ON msubktg.id = mbrg.ref_subktg
            LEFT JOIN mktg ON mktg.id = msubktg.ref_ktg";
        $result     = $this->db->query($q)->result();
        $list       = [];
        foreach ($result as $i => $r) {
            $row['id']      = $r->id;
            $row['no']      = $i + 1;
            $row['nama']    = $r->nama;
            $row['mktg_nama']= $r->mktg_nama;
            $row['msubktg_nama']= $r->msubktg_nama;
            $row['artikel'] = $r->artikel;
            $row['image1']   = showimage($r->image1);
            $row['image2']   = showimage($r->image2);
            $row['image3']   = showimage($r->image3);
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
        $path1 = $this->libre->goUpload('image1','img-'.time(),$this->foldername);
        $path2 = $this->libre->goUpload('image2','img-'.time(),$this->foldername);
        $path3 = $this->libre->goUpload('image3','img-'.time(),$this->foldername);
        $d['image1']     = $path1;
        $d['image2']     = $path2;
        $d['image3']     = $path3;
        $d['nama']      = $this->input->post('nama');
        $d['ref_subktg']= $this->input->post('ref_subktg');
        $d['artikel']   = $this->input->post('artikel');
        $d['ket']       = $this->input->post('ket');
        $result = $this->db->insert($this->table,$d);
        $r['sukses'] = $result ? 'success' : 'fail' ;
        echo json_encode($r);
    }

    function updatedata()
    {
        //cek apakah kosong atau tidak (gambar diperbaharui atau tidak)
        if (!empty($_FILES['image1']['name'])) {
            $path = $this->libre->goUpload('image1','img3-'.time(),$this->foldername);
            $d['image1'] = $path;
            $oldpath = $this->input->post('path1');
            @unlink(".".$oldpath);
        } else {
            $d['image1'] = $this->input->post('path1');
        }

        if (!empty($_FILES['image2']['name'])) {
            $path = $this->libre->goUpload('image2','img3-'.time(),$this->foldername);
            $d['image2'] = $path;
            $oldpath = $this->input->post('path2');
            @unlink(".".$oldpath);
        } else {
            $d['image2'] = $this->input->post('path2');
        }

        if (!empty($_FILES['image3']['name'])) {
            $path = $this->libre->goUpload('image3','img3-'.time(),$this->foldername);
            $d['image3'] = $path;
            $oldpath = $this->input->post('path3');
            @unlink(".".$oldpath);
        } else {
            $d['image3'] = $this->input->post('path3');
        }

        $d['nama']      = $this->input->post('nama');
        $d['ref_subktg']= $this->input->post('ref_subktg');
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
        $path = $this->db->get_where($this->table,$w)->row();
        
        @unlink('.'.$path->image1);
        @unlink('.'.$path->image2);
        @unlink('.'.$path->image3);
        
        $result = $this->db->delete($this->table,$w);
        $r['sukses'] = $result ? 'success' : 'fail' ;
        echo json_encode($r);
    }
}