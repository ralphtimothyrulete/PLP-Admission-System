@component('mail::message')
# Hello {{ $studentName }},

This is a reminder about an important upcoming deadline regarding admissions.

**Deadline Date:** {{ $deadlineDate }}

Please make sure to complete all necessary steps by the due date to avoid any issues with your admission process.

Thank you,  
{{ config('app.name') }}
@endcomponent
