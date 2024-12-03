<x-layout>
    <x-slot:heading>
        Admission
    </x-slot:heading>
    @if(session('status'))
            <div class="alert alert-success bg-green-600 font-semibold" style="margin: 1%">
                {{ session ('status') }}            
            </div>
    @endif
    <main class="container mx-auto p-8">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h1 class="text-2xl font-bold text-green-600 mb-1 font-poppins">STUDENTS APPLICATION</h1>
            <div class="text-right text-green-600 mb-1 font-bold font-poppins">1 of 2</div>
     <!-- Student Application Form -->
        <form id="studentForm" action="{{ route('admission.store') }}" method="POST">
            @csrf
            <!-- Student Details Section -->
            <div class="mb-6">
                <h2 class="text-xl font-semibold text-white bg-green-600 p-2 rounded-t-lg font-poppins">Student Details</h2>
                <div class="bg-gray-100 p-4 rounded-b-lg font-poppins">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block mb-2 font-bold">Surname(Apelyido)*</label>
                            <input type="text" name="last_name" value="{{ old('last_name') }}" class="w-full p-2 border rounded" placeholder="Last Name" required>
                        </div>
                        <div>
                            <label class="block mb-2 font-bold">Given Name(Pangalan)*</label>
                            <input type="text" name="first_name" value="{{ old('first_name') }}" class="w-full p-2 border rounded" placeholder="First Name" required>
                        </div>
                        <div>
                            <label class="block mb-2 font-bold">Middle Name(Gitnang Pangalan)*</label>
                            <input type="text" name="middle_name" value="{{ old('middle_name') }}" class="w-full p-2 border rounded" placeholder="Middle Name" required>
                        </div>
                        <div>
                            <label class="block mb-2 font-bold">Suffix</label>
                            <input type="text" name="suffix" value="{{ old('suffix') }}" class="w-full p-2 border rounded" placeholder="(e.g. Jr.)" >
                        </div>
                        <div>
                            <label class="block mb-2 font-bold">Age*</label>
                            <input type="number" name="age" value="{{ old('age') }}" class="w-full p-2 border rounded" placeholder="18" min="0" max="99" required>
                        </div>
                        <div>
                            <label class="block mb-2 font-bold">Sex(Kasarian)*</label>
                                <select id="sexGender" name="sex" class="select p-2 border rounded w-full" required>
                                    <option disabled selected>Select Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                        </div>
                        <div>
                            <label class="block mb-2 font-bold">Contact Number*</label>
                            <input type="tel" name="contact_number" value="{{ old('number') }}" class="w-full p-2 border rounded" placeholder="09" required>
                        </div>
                        <div>
                            <label class="block mb-2 font-bold">Religion*</label>
                            <input type="text" name="religion" value="{{ old('religion') }}" class="w-full p-2 border rounded" placeholder="Roman Catholic" required>
                        </div>
                        <div>
                            <label class="block mb-2 font-bold">Sports*</label>
                            <input type="text" name="sports" value="{{ old('sports') }}" class="w-full p-2 border rounded" placeholder="Football" required>
                        </div>
                        <div>
                        <label class="block mb-2 font-bold">Residency Status*</label>
                            <select id="residencyStatus" name="residency_status" class="select p-2 border rounded w-full" onchange="handleResidencyChange()" required>
                                <option disabled selected>Select Residency</option>
                                <option value="Pasig Resident">Pasig Resident</option>
                                <option value="Non-Pasig Resident">Non-Pasig Resident</option>
                            </select>
                        </div>
                        <div id="districtContainer" class="hidden mt-1">
                            <label class="block mb-1 font-bold">District*</label>
                            <select id="districtSelect" name="district" class="select p-2 border rounded w-full" onchange="handleDistrictChange()" >
                                <option disabled selected>Select District</option>
                                <option value="District1">District 1</option>
                                <option value="District2">District 2</option>
                            </select>
                        </div>
                        <div id="barangayContainer1" class="hidden mt-1">
                            <label class="block mb-2 font-bold">Barangay*</label>
                            <select id="barangaySelect1" name="barangay" class="select p-2 border rounded w-full" >
                                <option disabled selected>Select Barangay</option>
                                <option value="Bagong Ilog">Bagong Ilog</option>
                                <option value="Bagong Katipunan">Bagong Katipunan</option>
                                <option value="Bambang">Bambang</option>
                                <option value="Buting">Buting</option>
                                <option value="Caniogan">Caniogan</option>
                                <option value="Kalawaan">Kalawaan</option>
                                <option value="Kapasigan">Kapasigan</option>
                                <option value="Kapitolyo">Kapitolyo</option>
                                <option value="Malinao">Malinao</option>
                                <option value="Oranbo">Oranbo</option>
                                <option value="Palatiw">Palatiw</option>
                                <option value="Pineda">Pineda</option>
                                <option value="Sagad">Sagad</option>
                                <option value="San Antonio">San Antonio</option>
                                <option value="San Joaquin">San Joaquin</option>
                                <option value="San Jose">San Jose</option>
                                <option value="San Nicolas">San Nicolas (Poblacion)</option>
                                <option value="San Miguel">San Miguel</option>
                                <option value="Santa Cruz">Santa Cruz</option>
                                <option value="Santa Rosa">Santa Rosa</option>
                                <option value="Santo Tomas">Santo Tomas</option>
                                <option value="Sumilang">Sumilang</option>
                                <option value="Ugong">Ugong</option>
                            </select>
                        </div>
                        <div id="barangayContainer2" class="hidden mt-1">
                            <label class="block mb-2 font-bold">Barangay*</label>
                            <select id="barangaySelect2" name="barangay" class="select p-2 border rounded w-full" >
                                <option disabled selected>Select Barangay</option>
                                <option value="Dela Paz">Dela Paz</option>
                                <option value="Manggahan">Manggahan</option>
                                <option value="Maybunga">Maybunga</option>
                                <option value="Pinagbuhatan">Pinagbuhatan</option>
                                <option value="Rosario">Rosario</option>
                                <option value="Santa Lucia">Santa Lucia</option>
                                <option value="Santolan">Santolan</option>
                            </select>
                        </div>
                        <div id="nonPasigInputContainer" class="hidden mt-1">
                            <label class="block mb-1 font-bold">Enter Residency*</label>
                            <input type="text" id="nonPasigInput" name="non_pasig_resident" class="w-full p-2 border rounded" placeholder="Enter Residency" />
                        </div>
                        <div>
                            <label class="block mb-2 font-bold">Address*</label>
                            <input type="text" name="address" value="{{ old('address') }}" class="w-full p-2 border rounded" placeholder="House Number/Unit/Building, Street, Subdivision/Village" required>
                        </div>
                        <div id="publicSchoolContainer">
                            <label class="block mb-2 font-bold">Last School Attended*</label>
                            <select id="publicSchoolSelect" name="public_school" class="select p-2 border rounded w-full" onchange="handlePublicSchoolChange()" >
                                <option disabled selected="">Select Last School Attended</option>
                                <option value="Buting Senior High School">Buting Senior High School</option>
                                <option value="Eusebio High School">Eusebio High School</option>
                                <option value="Kapitolyo High School">Kapitolyo High School</option>
                                <option value="RESPSCI">RESPSCI</option>
                                <option value="Rizal High School">Rizal High School</option>
                                <option value="Pasig Science High School">Pasig Science High School</option>
                                <option value="Santolan High School">Santolan High School</option>
                                <option value="San Lorenzo Senior High School">San Lorenzo Senior High School</option>
                                <option value="Sta. Lucia High School">Sta. Lucia High School</option>
                                <option value="Ugong Senior High School">Ugong Senior High School</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <div id="typeContainer" class="hidden mt-1">
                        <label class="block mb-1 font-bold">Type of School*</label>
                        <select id="typeSelect" name="school_type" class="select p-2 border rounded w-full" onchange="handleTypeChange()" required>
                            <option disabled selected>Select Type of School</option>
                            <option value="Public">Public</option>
                            <option value="Private">Private</option>
                        </select>
                        </div>
                        <div id="otherPublicSchoolContainer" class="hidden mt-1">
                            <label class="block mb-2 font-bold">Other: Please Specify*</label>
                            <input type="text" id="otherPublicSchoolInput" name="other_school" class="w-full p-2 border rounded" placeholder="Enter School Name" />
                        </div>
                        <div id="privateSchoolContainer" class="hidden mt-1">
                            <label class="block mb-2 font-bold">Enter Private School Name*</label>
                            <input type="text" id="privateSchoolInput" name="private_school" class="w-full p-2 border rounded" placeholder="Enter Private School Name" />
                        </div>
                        <div>
                            <label class="block mb-2 font-bold">Email*</label>
                            <input type="email" name="email" value="{{ old('email') }}" class="w-full p-2 border rounded" placeholder="@gmail.com" required>
                        </div>
                        <div>
                            <label class="block mb-2 font-bold">Talents*</label>
                            <input type="text" name="talents" value="{{ old('talents') }}" class="w-full p-2 border rounded" placeholder="Singing, Dancing" required>
                        </div>
                        <div>
                            <label class="block mb-2 font-bold">Strand and Program*</label>
                            <select id="strandProgram" name="strand" class="select p-2 border rounded w-full" required>
                                <option disabled selected>Select Strand</option>
                                <option value="ABM">ABM(Accountancy, Business and Management)</option>
                                <option value="GAS">GAS(General Academic Strand)</option>
                                <option value="HUMSS">HUMSS(Humanities and Social Sciences)</option>
                                <option value="STEM">STEM(Science, Technology, Engineering and Mathematics)</option>
                                <option value="TVL-HE">Technical-Vocational-Livelihood(TVL)-HOME ECONOMICS(HE)</option>
                                <option value="TVL-ICT">Technical-Vocational-Livelihood(TVL)-INFORMATION COMMUNICATION TECHNOLOGY(ICT)</option>
                                <option value="TVL-SPORTS">Technical-Vocational-Livelihood(TVL)-SPORTS</option>
                            </select>
                        </div>
                        <div>
                            <label class="block mb-2 font-bold">Parents Monthly Salary(Combined)*</label>
                            <select id="monthlySalary" name="salary" class="select p-2 border rounded w-full" required>
                                <option disabled selected>Select Salary</option>
                                <option value="Low-income">Below 12,000</option>
                                <option value="Lower-middle-income">PHP 12,000 - PHP 25,000</option>
                                <option value="Middle-income">PHP 26,000 - PHP 50,000</option>
                                <option value="Upper-middle-income">PHP 51,000 - PHP 99,000</option>
                                <option value="High-income group"> PHP 100,000 Above</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Parent/Guardian Details Section -->
            <div class="mb-6">
                <h2 class="text-xl font-semibold text-white bg-green-600 p-2 rounded-t-lg font-poppins">Parent/Guardian Details</h2>
                <div class="bg-gray-100 p-4 rounded-b-lg font-poppins">
                    <div class="mb-4">
                        <label class="block mb-2 font-bold">Choose Parent or Guardian*</label>
                        <div>
                            <label>
                                <input type="radio" id="parentOption" name="parent_guardian[type]" value="parent" onclick="handleRelationChange()"> Parent
                            </label>
                            <label>
                                <input type="radio" id="guardianOption" name="parent_guardian[type]" value="guardian" class="ml-2" onclick="handleRelationChange()"> Guardian
                            </label>
                        </div>
                    </div>

        <!-- Parent Details Section -->
        <div id="parentDetailsContainer" class="hidden">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block mb-2 font-bold">Parent Last Name*</label>
                    <input type="text" name="parent_guardian[parent_last_name]" class="w-full p-2 border rounded" placeholder="Last Name">
                </div>
                <div>
                    <label class="block mb-2 font-bold">Parent First Name*</label>
                    <input type="text" name="parent_guardian[parent_first_name]" class="w-full p-2 border rounded" placeholder="First Name">
                </div>
                <div>
                    <label class="block mb-2 font-bold">Parent Middle Name*</label>
                    <input type="text" name="parent_guardian[parent_middle_name]" class="w-full p-2 border rounded" placeholder="Middle Name">
                </div>
                <div>
                    <label class="block mb-2 font-bold">Suffix</label>
                    <input type="text" name="parent_guardian[parent_suffix]" class="w-full p-2 border rounded" placeholder="Suffix (e.g. Jr.)">
                </div>
                <div>
                    <label class="block mb-2 font-bold">Age*</label>
                    <input type="number" name="parent_guardian[parent_age]" class="w-full p-2 border rounded" placeholder="Age" min="0" max="99">
                </div>
                <div>
                    <label class="block mb-2 font-bold">Phone Number*</label>
                    <input type="tel" name="parent_guardian[parent_contact_number]" class="w-full p-2 border rounded" placeholder="+63">
                </div>
                <div>
                    <label class="block mb-2 font-bold">Email*</label>
                    <input type="email" name="parent_guardian[parent_email]" class="w-full p-2 border rounded" placeholder="Email">
                </div>
                <div>
                    <label class="block mb-2 font-bold">Address*</label>
                    <input type="text" name="parent_guardian[parent_address]" class="w-full p-2 border rounded" placeholder="Address">
                </div>
            </div>
        </div>

        <!-- Guardian Details Section -->
        <div id="guardianDetailsContainer" class="hidden">
            <div class="grid grid-cols-2 gap-4 font-poppins">
                <div>
                    <label class="block mb-2 font-bold">Guardian Last Name*</label>
                    <input type="text" name="parent_guardian[guardian_last_name]" class="w-full p-2 border rounded" placeholder="Last Name">
                </div>
                <div>
                    <label class="block mb-2 font-bold">Guardian First Name*</label>
                    <input type="text" name="parent_guardian[guardian_first_name]" class="w-full p-2 border rounded" placeholder="First Name">
                </div>
                <div>
                    <label class="block mb-2 font-bold">Guardian Middle Name*</label>
                    <input type="text" name="parent_guardian[guardian_middle_name]" class="w-full p-2 border rounded" placeholder="Middle Name">
                </div>
                <div>
                    <label class="block mb-2 font-bold">Suffix</label>
                    <input type="text" name="parent_guardian[guardian_suffix]" class="w-full p-2 border rounded" placeholder="Suffix (e.g. Jr.)">
                </div>
                <div>
                    <label class="block mb-2 font-bold">Age*</label>
                    <input type="number" name="parent_guardian[guardian_age]" class="w-full p-2 border rounded" placeholder="Age" min="0" max="99">
                </div>
                <div>
                    <label class="block mb-2 font-bold">Phone Number*</label>
                    <input type="tel" name="parent_guardian[guardian_contact_number]" class="w-full p-2 border rounded" placeholder="+63">
                </div>
                <div>
                    <label class="block mb-2 font-bold">Email*</label>
                    <input type="email" name="parent_guardian[guardian_email]" class="w-full p-2 border rounded" placeholder="Email">
                </div>
                <div>
                    <label class="block mb-2 font-bold">Address*</label>
                    <input type="text" name="parent_guardian[guardian_address]" class="w-full p-2 border rounded" placeholder="Address">
                </div>
            </div>
        </div>
    </div>
</div>

            <div class="text-right">
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded font-poppins mt-5">Next</button>
            </div>
        </form>
    </div>

    <script>
    function handleResidencyChange() {
        const residencyStatus = document.getElementById("residencyStatus").value;
        const districtContainer = document.getElementById("districtContainer");
        const barangayContainer1 = document.getElementById("barangayContainer1");
        const barangayContainer2 = document.getElementById("barangayContainer2");
        const nonPasigInputContainer = document.getElementById("nonPasigInputContainer");

        if (residencyStatus === "Pasig Resident") {
            districtContainer.classList.remove("hidden");
            nonPasigInputContainer.classList.add("hidden");
            barangayContainer1.classList.add("hidden");
            barangayContainer2.classList.add("hidden");
        } else if (residencyStatus === "Non-Pasig Resident") {
            districtContainer.classList.add("hidden");
            barangayContainer1.classList.add("hidden");
            barangayContainer2.classList.add("hidden");
            nonPasigInputContainer.classList.remove("hidden");
        }
    }

    function handleDistrictChange() {
        const districtValue = document.getElementById("districtSelect").value;
        const barangayContainer1 = document.getElementById("barangayContainer1");
        const barangayContainer2 = document.getElementById("barangayContainer2");

        if (districtValue === "District1") {
            barangayContainer1.classList.remove("hidden");
            barangayContainer2.classList.add("hidden");
        } else if (districtValue === "District2") {
            barangayContainer1.classList.add("hidden");
            barangayContainer2.classList.remove("hidden");
        }
    }

    function handlePublicSchoolChange() {
        const publicSchoolSelect = document.getElementById("publicSchoolSelect").value;
        const otherPublicSchoolContainer = document.getElementById("otherPublicSchoolContainer");
        const typeContainer = document.getElementById("typeContainer");

        if (publicSchoolSelect === "Other") {
            otherPublicSchoolContainer.classList.remove("hidden");
        } else {
            otherPublicSchoolContainer.classList.add("hidden");
        }

        if (publicSchoolSelect) {
            typeContainer.classList.remove("hidden");
        } else {
            typeContainer.classList.add("hidden");
        }
    }

    function handleRelationChange() {
        const parentOption = document.getElementById('parentOption').checked;
        const guardianOption = document.getElementById('guardianOption').checked;
        
        const parentDetailsContainer = document.getElementById('parentDetailsContainer');
        const guardianDetailsContainer = document.getElementById('guardianDetailsContainer');
        
        if (parentOption) {
            parentDetailsContainer.classList.remove('hidden');
            guardianDetailsContainer.classList.add('hidden');
        } else if (guardianOption) {
            guardianDetailsContainer.classList.remove('hidden');
            parentDetailsContainer.classList.add('hidden');
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        handleRelationChange();
    });
</script>

</x-layout>