<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FileValidated extends Mailable
{
    use Queueable, SerializesModels;

    public $userName; // Nama mahasiswa
    public $scholarshipName; // Nama beasiswa

    /**
     * Create a new message instance.
     *
     * @param string $userName
     * @param string $scholarshipName
     */
    public function __construct($userName, $scholarshipName)
    {
        $this->userName = $userName;
        $this->scholarshipName = $scholarshipName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Pengumuman Seleksi Berkas - ' . $this->scholarshipName)
                    ->view('emails.file_validated');
    }
}
