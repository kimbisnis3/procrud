<?php

defined('BASEPATH') or exit('No direct script access allowed');

class libre
{   
    public function pathupload()
    {
      return './uploads/';
    }

    public function appname(){
        return 'Okeapp';
    }

    public function goUpload($field,$filename,$dir)
    {
        $ci=& get_instance();
        $config['upload_path'] = $this->pathupload().$dir;
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0777, TRUE);
        }
        $config['allowed_types'] = '*';
        $config['file_name'] = $filename;
        $path = substr($config['upload_path'],1);
        $ci->upload->initialize($config);
        if ($ci->upload->do_upload($field)) {
            return $path.'/'.$ci->upload->data('file_name');
        } else {
            return null;
        }
    }
}
