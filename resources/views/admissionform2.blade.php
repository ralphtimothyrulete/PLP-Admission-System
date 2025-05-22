<x-layout>
    <x-slot:heading>
        Admission
    </x-slot:heading>
    @if($errors->any())
        <div class="alert alert-danger bg-red-600 font-semibold" style="margin: 1%">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <x-progress-bar :step="$student->step" />
    <p class="mb-4 mt-4 font-poppins font-bold">Complete your application with academic records and course choices.</p>
    <!-- Step 2 of 2: Academic Records and Course Choices -->
    <div class="bg-white p-6 rounded-lg shadow-lg mb-6 animate-slide-in">
        <form id="application-form" action="{{ route('submit-application') }}" method="POST" onsubmit="return handleFormSubmit(event)">
            @csrf
            <input type="hidden" name="student_id" value="{{ $student_id }}">
            <!-- Student Details Section -->
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-green-600 mb-1 font-poppins">STUDENT APPLICATION</h1>
                <div class="text-right text-green-600 mb-1 font-bold font-poppins">2 of 2</div>
                <h2 class="text-xl font-semibold font-poppins text-white bg-green-600 p-2 rounded-t-lg">Student Record - General Weighted Average</h2>
                <div class="bg-gray-100 p-4 rounded-b-lg">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block mb-2 font-poppins font-bold">Science<span class="text-red-500">*</span></label>
                            <input type="number" name="science_grade" class="w-full p-2 border rounded" placeholder="Grade" required min="0" max="99">
                        </div>
                        <div>
                            <label class="block mb-2 font-poppins font-bold">Mathematics<span class="text-red-500">*</span></label>
                            <input type="number" name="mathematics_grade" class="w-full p-2 border rounded" placeholder="Grade" required min="0" max="99">
                        </div>
                        <div>
                            <label class="block mb-2 font-poppins font-bold">English<span class="text-red-500">*</span></label>
                            <input type="number" name="english_grade" class="w-full p-2 border rounded" placeholder="Grade" required min="0" max="99">
                        </div>
                        <div class="relative">
                            <label class="block mb-2 font-poppins font-bold">Overall Grade<span class="text-red-500">*</span>
                                <span class="tooltip ml-2 text-blue-500 cursor-pointer">?
                                    <span class="tooltiptext bg-gray-200 text-black p-2 rounded shadow-lg">
                                        To compute the GWA/Overall Grade, sum all your grades and divide by the number of subjects.
                                    </span>
                                </span>
                            </label>
                            <input type="number" name="overall_grade" class="w-full p-2 border rounded" placeholder="Grade" required min="0" max="99">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Course Choices Section -->
            <div class="mb-6">
            <p class="mb-4 font-poppins">
                <strong class="font-bold font-poppins">NOTE:</strong> Before proceeding, please refer to this link to know what courses to apply where your strand is applicable 
                <a href="{{ route('req-strand') }}" class="text-blue-500 underline">PLP - Strand Requirements</a>
            </p>
            </div>
                <h2 class="text-xl font-semibold font-poppins text-white bg-green-600 p-2 rounded-t-lg">Course Choices</h2>
                <div class="bg-gray-100 p-4 rounded-b-lg">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div id="strandContainer1">
                            <label class="block mb-2 font-poppins font-bold">First Choice<span class="text-red-500">*</span></label>
                                <select id="strandSelect1" name="first_choice" class="select p-2 border rounded w-full @error('first_choice') border-red-500 @enderror" required>
                                    <option disabled selected="">Select First Choice</option>
                                    <option value="Bachelor in Elementary Education">Bachelor in Elementary Education (BEED)</option>
                                    <option value="Bachelor in Secondary Education Major in English">Bachelor in Secondary Education Major in English (BSED-ENG)</option>
                                    <option value="Bachelor in Secondary Education Major in Filipino">Bachelor in Secondary Education Major in Filipino (BSED-FIL)</option>
                                    <option value="Bachelor in Secondary Education Major in Mathematics">Bachelor in Secondary Education Major in Mathematics (BSED-MATH)</option>
                                    <option value="Bachelor of Science in Accountancy">Bachelor of Science in Accountancy (BSA)</option>
                                    <option value="Bachelor of Science in Business Administrations Major in Marketing Management">Bachelor of Science in Business Administrations Major in Marketing Management (BSBA)</option>
                                    <option value="Bachelor of Science in Entrepreneurship">Bachelor of Science in Entrepreneurship (BSENT)</option>
                                    <option value="Bachelor of Science in Hospitality Management">Bachelor of Science in Hospitality Management (BSHM)</option>
                                    <option value="Bachelor of Arts in Psychology">Bachelor of Arts in Psychology (AB Psych)</option>
                                    <option value="Bachelor of Science in Computer Science">Bachelor of Science in Computer Science (BSCS)</option>
                                    <option value="Bachelor of Science in Information Technology">Bachelor of Science in Information Technology (BSIT)</option>
                                    <option value="Bachelor of Science in Electronics Engineering">Bachelor of Science in Electronics Engineering (BSECE)</option>
                                    <option value="Bachelor of Science in Nursing">Bachelor of Science in Nursing (BSN)</option>
                                    @foreach($courses as $course)
                                        <option value="{{ $course->name }}">{{ $course->name }}</option>
                                    @endforeach
                                </select>
                                @error('first_choice')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                        </div>
    
                            <div id="strandContainer2">
                            <label class="block mb-2 font-poppins font-bold">Second Choice<span class="text-red-500">*</span></label>
                                <select id="strandSelect2" name="second_choice" class="select p-2 border rounded w-full @error('second_choice') border-red-500 @enderror" required>
                                    <option disabled selected="">Select Second Choice</option>
                                    <option value="Bachelor in Elementary Education">Bachelor in Elementary Education (BEED)</option>
                                    <option value="Bachelor in Secondary Education Major in English">Bachelor in Secondary Education Major in English (BSED-ENG)</option>
                                    <option value="Bachelor in Secondary Education Major in Filipino">Bachelor in Secondary Education Major in Filipino (BSED-FIL)</option>
                                    <option value="Bachelor in Secondary Education Major in Mathematics">Bachelor in Secondary Education Major in Mathematics (BSED-MATH)</option>
                                    <option value="Bachelor of Science in Accountancy">Bachelor of Science in Accountancy (BSA)</option>
                                    <option value="Bachelor of Science in Business Administrations Major in Marketing Management">Bachelor of Science in Business Administrations Major in Marketing Management (BSBA)</option>
                                    <option value="Bachelor of Science in Entrepreneurship">Bachelor of Science in Entrepreneurship (BSENT)</option>
                                    <option value="Bachelor of Science in Hospitality Management">Bachelor of Science in Hospitality Management (BSHM)</option>
                                    <option value="Bachelor of Arts in Psychology">Bachelor of Arts in Psychology (AB Psych)</option>
                                    <option value="Bachelor of Science in Computer Science">Bachelor of Science in Computer Science (BSCS)</option>
                                    <option value="Bachelor of Science in Information Technology">Bachelor of Science in Information Technology (BSIT)</option>
                                    <option value="Bachelor of Science in Electronics Engineering">Bachelor of Science in Electronics Engineering (BSECE)</option>
                                    <option value="Bachelor of Science in Nursing">Bachelor of Science in Nursing (BSN)</option>
                                    @foreach($courses as $course)
                                        <option value="{{ $course->name }}">{{ $course->name }}</option>
                                    @endforeach
                                </select>
                                @error('second_choice')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        
                            <div id="strandContainer3">
                            <label class="block mb-2 font-poppins font-bold">Third Choice</label>
                                <select id="strandSelect3" name="third_choice" class="select p-2 border rounded w-full @error('third_choice') border-red-500 @enderror" required>
                                    <option disabled selected="">Select Third Choice</option>
                                    <option value="Bachelor in Elementary Education">Bachelor in Elementary Education (BEED)</option>
                                    <option value="Bachelor in Secondary Education Major in English">Bachelor in Secondary Education Major in English (BSED-ENG)</option>
                                    <option value="Bachelor in Secondary Education Major in Filipino">Bachelor in Secondary Education Major in Filipino (BSED-FIL)</option>
                                    <option value="Bachelor in Secondary Education Major in Mathematics">Bachelor in Secondary Education Major in Mathematics (BSED-MATH)</option>
                                    <option value="Bachelor of Science in Accountancy">Bachelor of Science in Accountancy (BSA)</option>
                                    <option value="Bachelor of Science in Business Administrations Major in Marketing Management">Bachelor of Science in Business Administrations Major in Marketing Management (BSBA)</option>
                                    <option value="Bachelor of Science in Entrepreneurship">Bachelor of Science in Entrepreneurship (BSENT)</option>
                                    <option value="Bachelor of Science in Hospitality Management">Bachelor of Science in Hospitality Management (BSHM)</option>
                                    <option value="Bachelor of Arts in Psychology">Bachelor of Arts in Psychology (AB Psych)</option>
                                    <option value="Bachelor of Science in Computer Science">Bachelor of Science in Computer Science (BSCS)</option>
                                    <option value="Bachelor of Science in Information Technology">Bachelor of Science in Information Technology (BSIT)</option>
                                    <option value="Bachelor of Science in Electronics Engineering">Bachelor of Science in Electronics Engineering (BSECE)</option>
                                    <option value="Bachelor of Science in Nursing">Bachelor of Science in Nursing (BSN)</option>
                                    <option value="None">None</option>
                                    @foreach($courses as $course)
                                        <option value="{{ $course->name }}">{{ $course->name }}</option>
                                    @endforeach
                                </select>
                                @error('third_choice')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>    
                        </div>
                    <div class="text-right">
                        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white mt-4 px-4 py-2 rounded font-poppins w-full sm:w-auto">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

<script>

function handleFormSubmit(event) {
// Prevent default only if there are errors
    const firstChoice = document.getElementById('strandSelect1').value;
    const secondChoice = document.getElementById('strandSelect2').value;
    const thirdChoice = document.getElementById('strandSelect3').value;

    if (!firstChoice || !secondChoice || !thirdChoice) {
        alert('Please select your First, Second, and Third course choices.');
        return false;
    }

    if (firstChoice === secondChoice || firstChoice === thirdChoice || secondChoice === thirdChoice) {
        alert('Please ensure that all three course choices are different.');
        return false;
    }

    return true; // Allow form submission

    document.querySelectorAll('input, select').forEach(element => {
    element.addEventListener('focus', () => {
        element.classList.add('focused');
    });

    element.addEventListener('blur', () => {
        element.classList.remove('focused');
    });
});
}
</script>

<style>
.tooltip {
    position: relative;
    display: inline-block;
}

.tooltip .tooltiptext {
    visibility: hidden;
    width: 220px;
    background-color: #f9f9f9;
    color: #000;
    text-align: center;
    border-radius: 6px;
    padding: 5px;
    position: absolute;
    z-index: 1;
    bottom: 125%; 
    left: 50%;
    margin-left: -110px; 
    box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1);
}

.tooltip .tooltiptext::after {
    content: "";
    position: absolute;
    top: 100%; 
    left: 50%;
    margin-left: -5px;
    border-width: 5px;
    border-style: solid;
    border-color: #f9f9f9 transparent transparent transparent;
}

.tooltip:hover .tooltiptext {
    visibility: visible;
}
</style>

</x-layout>