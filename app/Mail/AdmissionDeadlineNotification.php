<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdmissionDeadlineNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $studentName;
    public $deadlineDate;

    public function __construct($studentName, $deadlineDate)
    {
        $this->studentName = $studentName;
        $this->deadlineDate = $deadlineDate;
    }

    public function build()
    {
        return $this->subject('Important Admission Deadline Alert')
                    ->markdown('emails.admission-deadline');
    }
}
