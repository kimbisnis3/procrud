<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Checkdir extends CI_Controller {

    function coba () {
        $upload_dir = 'd:/xampp/htdocs/procrud';
        if (is_dir($upload_dir)) {
            if (is_writable($upload_dir)) {
                echo "OK: directory $upload_dir exists and is writable by this script.";
            } else {
                echo "ERROR: directory $upload_dir exists but is not writable by this script.";
            }
        } else {
            echo "ERROR: This script does not recognize $upload_dir as a directory.";
        }
    }
}