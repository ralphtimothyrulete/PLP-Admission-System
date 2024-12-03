<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\EntranceExamEmail;
use App\Mail\EntranceExamPassedEmail;
use App\Mail\EnrollmentSlotOfferingEmail;
use App\Mail\RequirementsSubmissionEmail;
use App\Mail\AdmissionDeadlineNotification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Exception;
use App\Models\User;

class EmailController extends Controller
{
    public function sendEntranceExamEmail()
    {
        $applicantName = "Applicant"; // Replace with actual name
        $attachmentPath = storage_path('public/storage/exam_permit.pdf'); // Path to the attachment file
        $examDate = "March 5, 2024"; // Replace with the actual date
        $examTime = "8:00 AM";

        try {
            Mail::to('primaryrecipient@example.com') // Primary recipient
                ->bcc(['ralphrulete21@gmail.com', 'ralphrulete12@gmail.com', 'ralphtimothyrulete@gmail.com']) // BCC recipients
                ->send(new EntranceExamEmail($applicantName, $attachmentPath, $examDate, $examTime));
            
            Log::info('Entrance Exam Email sent successfully to ralph8110@gmail.com.');
            return response()->json(['message' => 'Entrance Exam Email sent successfully']);
        } catch (Exception $e) {
            Log::error('Failed to send Entrance Exam Email: ' . $e->getMessage());
            return response()->json(['message' => 'Failed to send Entrance Exam Email'], 500);
        }
    }

    public function sendEntranceExamPassedEmail()
    {
        $applicantName = "Applicant"; // Replace with actual name
        $interviewDate = "June 25, 2024"; // Replace with the actual date
        $interviewTime = "8:00 AM"; // Replace with the actual time

        try {
            Mail::to('primaryrecipient@example.com') // Primary recipient
                ->bcc(['ralphrulete21@gmail.com', 'ralphrulete12@gmail.com', 'ralphrulete8110@gmail.com'])
                ->send(new EntranceExamPassedEmail($applicantName, $interviewDate, $interviewTime));
            
            Log::info('Entrance Exam Passed Email sent successfully to primaryrecipient@example.com.');
            return response()->json(['message' => 'Entrance Exam Passed Email sent successfully']);
        } catch (Exception $e) {
            Log::error('Failed to send Entrance Exam Passed Email: ' . $e->getMessage());
            return response()->json(['message' => 'Failed to send Entrance Exam Passed Email'], 500);
        }
    }

    public function sendEnrollmentSlotOfferingEmail()
    {
        $applicantName = "Applicant"; // Replace with actual name

        try {
            Mail::to('primaryrecipient@example.com') // Primary recipient
                ->bcc(['ralphrulete21@gmail.com', 'ralphrulete12@gmail.com', 'ralphrulete8110@gmail.com'])
                ->send(new EnrollmentSlotOfferingEmail($applicantName));
            
            Log::info('Enrollment Slot Offering Email sent successfully to primaryrecipient@example.com.');
            return response()->json(['message' => 'Enrollment Slot Offering Email sent successfully']);
        } catch (Exception $e) {
            Log::error('Failed to send Enrollment Slot Offering Email: ' . $e->getMessage());
            return response()->json(['message' => 'Failed to send Enrollment Slot Offering Email'], 500);
        }
    }

    public function sendRequirementsSubmissionEmail()
    {
        $applicantName = "Applicant"; // Replace with actual name
        $submissionDate = "March 21, 2024"; // Replace with the actual date
        $websiteLink = "https://example.com/requirements"; // Replace with the actual link

        try {
            Mail::to('primaryrecipient@example.com') // Primary recipient
                ->bcc(['ralphrulete21@gmail.com', 'ralphrulete12@gmail.com']) // BCC recipients
                ->send(new RequirementsSubmissionEmail($applicantName, $submissionDate, $websiteLink));
            
            Log::info('Requirements Submission Email sent successfully to primaryrecipient@example.com.');
            return response()->json(['message' => 'Requirements Submission Email sent successfully']);
        } catch (Exception $e) {
            Log::error('Failed to send Requirements Submission Email: ' . $e->getMessage());
            return response()->json(['message' => 'Failed to send Requirements Submission Email'], 500);
        }
    }

    public function sendAdmissionDeadlineNotification($student_id)
    {
        $student = User::find($student_id);

        if (!$student) {
            return response()->json(['message' => 'Student not found'], 404);
        }

        $studentName = $student->name;
        $deadlineDate = '2024-11-30';

        try {
            Mail::to($student->email)->send(new AdmissionDeadlineNotification($studentName, $deadlineDate));
            Log::info('Deadline Notification sent successfully to ' . $student->email);
            return response()->json(['message' => 'Notification sent successfully.']);
        } catch (Exception $e) {
            Log::error('Failed to send Deadline Notification: ' . $e->getMessage());
            return response()->json(['message' => 'Failed to send Deadline Notification'], 500);
        }
    }
    
}
