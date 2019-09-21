<?php

defined('BASEPATH') or exit('No direct script access allowed');

class libre
{   
    public function pathupload()
    {
        $upload_dir_parent  = api_image_upload();
        $upload_dir_child   = 'uploads/';
        $upload_dir         = $upload_dir_parent.$upload_dir_child;
        return array(
            'upload_dir_parent' => $upload_dir_parent, 
            'upload_dir_child'  => $upload_dir_child, 
            'upload_dir'        => $upload_dir, 
        );
    }

    public function appname(){
        return 'Okeapp';
    }

    public function goUpload($field,$filename,$dir)
    {
        $ci=& get_instance();
        $config['upload_path'] = $this->pathupload()['upload_dir'].$dir;
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0777, TRUE);
        }
        $config['allowed_types'] = '*';
        $config['file_name'] = $filename;
        // $path = substr($config['upload_path'],1);
        $path = $this->pathupload()['upload_dir_child'].$dir;
        $ci->upload->initialize($config);
        if ($ci->upload->do_upload($field)) {
            return $path.'/'.$ci->upload->data('file_name');
        } else {
            return null;
        }
    }
}
