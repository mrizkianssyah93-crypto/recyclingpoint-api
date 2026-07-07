<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class VerificationCodeMail extends Mailable
{
    public $code;

    public function __construct($code)
    {
        $this->code = $code;
    }

    public function build()
    {
        return $this
            ->subject('Recycling Point Verification Code')
            ->html("
                <div style='font-family:Arial,sans-serif;padding:20px'>
                    <h2>Recycling Point</h2>

                    <p>Terima kasih telah melakukan registrasi.</p>

                    <p>Masukkan kode verifikasi berikut:</p>

                    <h1 style='letter-spacing:5px;color:#16a34a'>
                        {$this->code}
                    </h1>

                    <p>Kode berlaku selama proses registrasi.</p>

                    <br>

                    <small>
                        Jangan bagikan kode ini kepada siapa pun.
                    </small>
                </div>
            ");
    }
}