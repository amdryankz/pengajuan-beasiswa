<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ScholarshipValidationCancelled extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $scholarshipName;

    /**
     * Create a new message instance.
     *
     * @param string $name
     * @param string $scholarshipName
     */
    public function __construct($name, $scholarshipName)
    {
        $this->name = $name;
        $this->scholarshipName = $scholarshipName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Pengumuman Hasil Seleksi Beasiswa - ' . $this->scholarshipName)
                    ->view('emails.scholarship_validation_cancelled');
    }

}
