<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EnrollmentSlotOfferingEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $applicantName;

    public function __construct($applicantName)
    {
        $this->applicantName = $applicantName;
    }

    public function build()
    {
        return $this->view('emails.enrollment_slot_offering')
                    ->subject('Enrollment Slot')
                    ->bcc(['ralphrulete21@gmail.com', 'ralphrulete12@gmail.com', 'ralphrulete8110@gmail.com'])
                    ->with([
                        'applicantName' => $this->applicantName,
                        'confirmationLink' => 'https://confirmationform.com/link'
                    ]);
    }
}
