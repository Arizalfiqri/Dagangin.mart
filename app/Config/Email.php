<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Email extends BaseConfig
{

    public string $fromEmail  = 'yourgmail@gmail.com'; // Ganti dengan email pengirim
    public string $fromName   = 'Admin Verifikasi';

    public string $protocol = 'smtp';
    public string $SMTPHost = 'smtp.gmail.com';
    public string $SMTPUser = 'fikriganteng238@gmail.com';
    public string $SMTPPass = 'hiay qfyp avwq ehlb';
    public int    $SMTPPort = 465;
    public string $SMTPCrypto = 'ssl';

    public string $mailType = 'html';
    public string $charset  = 'UTF-8';

}
    