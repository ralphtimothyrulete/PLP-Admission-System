<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RequirementsSubmissionEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $applicantName;
    public $submissionDate;
    public $websiteLink;

    public function __construct($applicantName, $submissionDate, $websiteLink)
    {
        $this->applicantName = $applicantName;
        $this->submissionDate = $submissionDate;
        $this->websiteLink = $websiteLink;
    }

    public function build()
    {
        return $this->view('emails.requirements_submission')
                    ->subject('Requirements Submission Schedule')
                    ->bcc(['ralphrulete21@gmail.com', 'ralphrulete12@gmail.com'])
                    ->with([
                        'applicantName' => $this->applicantName,
                        'submissionDate' => $this->submissionDate,
                        'websiteLink' => $this->websiteLink,
                    ]);
    }
}
