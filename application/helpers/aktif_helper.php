<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if (!function_exists('status')) {
    function aktif($text)
    {
        if ($text=='0' || $text=='NULL' || $text=='') {
            $text = '<span class="label label-danger">Tidak Aktif</span>';
        }
        else {
            $text = '<span class="label label-success">Aktif</span>';
        }
       
        return $text;
    }
}