<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Image Processing Defaults (Dipindahkan dari CI4)
|--------------------------------------------------------------------------
|
| Ini adalah konfigurasi default untuk library Image Manipulation Class di CI3
| (menggantikan fungsi app/Config/Images.php dari CI4).
|
*/

$config['image_library'] = 'gd2'; // Setara dengan 'gd' di CI4
$config['library_path']  = '/usr/local/bin/convert'; // Dibutuhkan jika menggunakan ImageMagick
$config['maintain_ratio']= TRUE; // Rekomendasi tambahan agar gambar proporsional saat diresize
$config['create_thumb']  = FALSE;

