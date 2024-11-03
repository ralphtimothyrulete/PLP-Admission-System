<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EntranceExamPassedEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $applicantName;
    public $interviewDate;
    public $interviewTime;

    public function __construct($applicantName, $interviewDate, $interviewTime)
    {
        $this->applicantName = $applicantName;
        $this->interviewDate = $interviewDate;
        $this->interviewTime = $interviewTime;
    }

    public function build()
    {
        return $this->view('emails.entrance_exam_passed')
                    ->subject('Entrance Exam Result')
                    ->bcc(['ralphrulete21@gmail.com', 'ralphrulete12@gmail.com', 'ralphrulete8110@gmail.com'])
                    ->with([
                        'applicantName' => $this->applicantName,
                        'programLink' => 'https://classroom.google.com/c/________'
                    ]);
    }
}
