<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SellerRegisteredMail extends Mailable
{
    use Queueable, SerializesModels;

    public User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function build()
    {
        return $this->subject('Terima Kasih Telah Mendaftar - LapakMahasiswa')
            ->view('emails.seller.registered')
            ->with([
                'user' => $this->user,
            ]);
    }
}
