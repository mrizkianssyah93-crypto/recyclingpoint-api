<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class TestMail extends Mailable
{
    public function build()
    {
        return $this
            ->subject('Recycling Point Test Email')
            ->html('
                <h2>Email berhasil dikirim</h2>
                <p>SMTP Recycling Point sudah aktif.</p>
            ');
    }
}