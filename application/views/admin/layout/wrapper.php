<?php
//proteksi halaman admin dengan fungsi chek login yg ada si simple login
$this->simple_login->cek_login();
//gabungkan semua layout jadi 1
require_once('head.php');
require_once('header.php');
require_once('nav.php');
require_once('content.php');
require_once('footer.php');