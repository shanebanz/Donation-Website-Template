<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Email extends BaseConfig
{

    public string $fromEmail  = 'yourgmail@gmail.com';
    public string $fromName   = 'SINAG Donation Platform';
    public string $recipients = '';

    public string $userAgent = 'CodeIgniter';

    /*
    |--------------------------------------------------------------------------
    | EMAIL PROTOCOL
    |--------------------------------------------------------------------------
    */
    public string $protocol = 'smtp';

    /*
    |--------------------------------------------------------------------------
    | SMTP SETTINGS
    |--------------------------------------------------------------------------
    */

    public string $SMTPHost = 'smtp.gmail.com';
    public string $SMTPUser = 'norwood0602@gmail.com';
    public string $SMTPPass = 'nnlk yxul cavw rozq';
    public int $SMTPPort = 587;

    public string $SMTPCrypto = 'tls';
    public int $SMTPTimeout = 30;

    public bool $SMTPKeepAlive = false;

    /*
    |--------------------------------------------------------------------------
    | EMAIL FORMAT
    |--------------------------------------------------------------------------
    */

    public bool $wordWrap = true;
    public int $wrapChars = 76;

    public string $mailType = 'html';
    public string $charset = 'UTF-8';

    public bool $validate = true;

    public int $priority = 3;

    public string $CRLF = "\r\n";
    public string $newline = "\r\n";

    public bool $BCCBatchMode = false;
    public int $BCCBatchSize = 200;

    public bool $DSN = false;

}