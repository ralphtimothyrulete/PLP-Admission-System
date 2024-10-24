<x-layout>
    <x-slot:heading>
        Admission
    </x-slot:heading>
    <p class="mb-4">Complete your application with academic records and course choices.</p>

    <!-- Step 2 of 2: Academic Records and Course Choices -->
    <div class="bg-white p-6 rounded-lg shadow-lg mb-6">
        <form id="application-form" action="{{ route('submit-application') }}" method="POST" onsubmit="return handleFormSubmit(event)">
            @csrf
            <!-- Student Details Section -->
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-green-600 mb-1 font-poppins">STUDENT APPLICATION</h1>
                <div class="text-right text-green-600 mb-1 font-bold">2 of 2</div>
                <h2 class="text-xl font-semibold text-white bg-green-600 p-2 rounded-t-lg">Student Record - General Weighted Average</h2>
                <div class="bg-gray-100 p-4 rounded-b-lg">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block mb-2 font-bold">Science*</label>
                            <input type="number" name="science" class="w-full p-2 border rounded" placeholder="Grade" required min="0" max="99">
                        </div>
                        <div>
                            <label class="block mb-2 font-bold">Mathematics*</label>
                            <input type="number" name="mathematics" class="w-full p-2 border rounded" placeholder="Grade" required min="0" max="99">
                        </div>
                        <div>
                            <label class="block mb-2 font-bold">English*</label>
                            <input type="number" name="english" class="w-full p-2 border rounded" placeholder="Grade" required min="0" max="99">
                        </div>
                        <div>
                            <label class="block mb-2 font-bold">Overall Grade*</label>
                            <input type="number" name="overall_grade" class="w-full p-2 border rounded" placeholder="Grade" required min="0" max="99">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Course Choices Section -->
            <div class="mb-6">
            <p class="mb-4">
                <strong class="font-bold">NOTE:</strong> Before proceeding, please refer to this link to know what courses to apply where your strand is applicable 
                <a href="{{ route('req-strand') }}" class="text-blue-500 underline">PLP- Strand Requirements</a>
            </p>
            </div>
                <h2 class="text-xl font-semibold text-white bg-green-600 p-2 rounded-t-lg">Course Choices</h2>
                <div class="bg-gray-100 p-4 rounded-b-lg">
                    <div class="grid grid-cols-2 gap-4">
                            <div id="strandContainer1">
                            <label class="block mb-2 font-poppins font-bold">First Choice*</label>
                                <select id="strandSelect1" name="first_choice" class="select p-2 border rounded w-full" required>
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
                                </select>
                        </div>
    
                            <div id="strandContainer2">
                            <label class="block mb-2 font-poppins font-bold">Second Choice*</label>
                                <select id="strandSelect2" name="second_choice" class="select p-2 border rounded w-full" required>
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
                                </select>
                            </div>
                        
                            <div id="strandContainer3">
                            <label class="block mb-2 font-poppins font-bold">Third Choice*</label>
                                <select id="strandSelect3" name="third_choice" class="select p-2 border rounded w-full" required>
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
                                    <option value="None">None</option>
                                </select>
                            </div>    
                    </div>
                </div>
            </div>

            <div class="text-right">
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Submit</button>
            </div>
        </form>
    </div>

    <script>
    function handleFormSubmit(event) {
        event.preventDefault(); // Prevent the default form submission

        // Get selected course values
        const firstChoice = document.getElementById('strandSelect1').value;
        const secondChoice = document.getElementById('strandSelect2').value;
        const thirdChoice = document.getElementById('strandSelect3').value;

        // Validate that all choices are selected
        if (!firstChoice || !secondChoice || !thirdChoice) {
            alert('Please select your First, Second, and Third course choices.');
            return false;
        }

        // Validate that all choices are different
        if (firstChoice === secondChoice || firstChoice === thirdChoice || secondChoice === thirdChoice) {
            alert('Please ensure that all three course choices are different.');
            return false;
        }

        // Display confirmation message
        if (confirm('Are you sure you want to submit the application?')) {
            document.getElementById('application-form').submit();
        }
    }
</script>

</x-layout>