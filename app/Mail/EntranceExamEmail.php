<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EntranceExamEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $applicantName;
    public $attachmentPath;
    public $examDate;
    public $examTime;

    public function __construct($applicantName, $attachmentPath, $examDate, $examTime)
    {
        $this->applicantName = $applicantName;
        $this->attachmentPath = $attachmentPath;
        $this->examDate = $examDate;
        $this->examTime = $examTime;
    }

    public function build()
    {
        return $this->view('emails.entrance_exam')
                    ->subject('Entrance Exam Schedule')
                    ->bcc(['ralphrulete21@gmail.com', 'ralphrulete12@gmail.com', 'ralphrulete8110@gmail.com'])
                    ->attach($this->attachmentPath)
                    ->with([
                        'applicantName' => $this->applicantName,
                    ]);
    }
}
