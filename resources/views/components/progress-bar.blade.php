@props(['step'])

@php
    $progress = ($step / 4) * 100;
@endphp


<div class="w-full bg-gray-200 rounded-full h-4 mb-4 text-poppins">
    <div class="bg-green-600 h-4 rounded-full" style="width: {{ $progress }}%"></div>
</div>
<div class="flex flex-col sm:flex-row justify-between text-sm font-semibold">
    <span class="{{ $step >= 1 ? 'text-green-600' : 'text-gray-400' }}">Step 1: Admission Form</span>
    <span class="{{ $step >= 2 ? 'text-green-600' : 'text-gray-400' }}">Step 2: Academic Records</span>
    <span class="{{ $step >= 3 ? 'text-green-600' : 'text-gray-400' }}">Step 3: Application Submission</span>
    <span class="{{ $step >= 4 ? 'text-green-600' : 'text-gray-400' }}">Step 4: Documents Upload</span>
</div>