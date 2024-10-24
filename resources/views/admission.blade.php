<x-layout>
    <x-slot:heading>
        Admission
    </x-slot:heading>
    <main class="container mx-auto p-8">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h1 class="text-2xl font-bold text-green-600 mb-1 font-poppins">STUDENT APPLICATION</h1>
            <div class="text-right text-green-600 mb-1 font-bold">1 of 2</div>
     <!-- Student Application Form -->
        <form id="studentForm" action="{{ route('admissionform2') }}" method="GET">
            @csrf
            <!-- Student Details Section -->
            <div class="mb-6">
                <h2 class="text-xl font-semibold text-white bg-green-600 p-2 rounded-t-lg font-poppins">Student Details</h2>
                <div class="bg-gray-100 p-4 rounded-b-lg">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block mb-2 font-poppins font-bold">Surname(Apelyido)*</label>
                            <input type="text" name="last_name" class="w-full p-2 border rounded" placeholder="Last Name" required>
                        </div>
                        <div>
                            <label class="block mb-2 font-poppins font-bold">Given Name(Pangalan)*</label>
                            <input type="text" name="first_name" class="w-full p-2 border rounded" placeholder="First Name" required>
                        </div>
                        <div>
                            <label class="block mb-2 font-poppins font-bold">Middle Name(Gitnang Pangalan)*</label>
                            <input type="text" name="middle_name" class="w-full p-2 border rounded" placeholder="Middle Name" required>
                        </div>
                        <div>
                            <label class="block mb-2 font-poppins font-bold">Suffix</label>
                            <input type="text" name="suffix" class="w-full p-2 border rounded" placeholder="(e.g. Jr.)">
                        </div>
                        <div>
                            <label class="block mb-2 font-poppins font-bold">Age*</label>
                            <input type="number" name="dob" class="w-full p-2 border rounded" placeholder="18" required>
                        </div>
                        <div>
                            <label class="block mb-2 font-poppins font-bold">Sex(Kasarian)*</label>
                                <select id="sexGender" name="sex" class="select p-2 border rounded w-full">
                                    <option disabled selected>Select Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                        </div>
                        <div>
                            <label class="block mb-2 font-poppins font-bold">Contact Number*</label>
                            <input type="tel" name="number" class="w-full p-2 border rounded" placeholder="+63" required>
                        </div>
                        <div>
                            <label class="block mb-2 font-poppins font-bold">Religion*</label>
                            <input type="text" name="religion" class="w-full p-2 border rounded" placeholder="Roman Catholic" required>
                        </div>
                        <div>
                            <label class="block mb-2 font-poppins font-bold">Sports*</label>
                            <input type="text" name="sports" class="w-full p-2 border rounded" placeholder="Football" required>
                        </div>
                        <div>
                        <label class="block mb-2 font-poppins font-bold">Residency Status*</label>
                            <select id="residencyStatus" name="residency_status" class="select p-2 border rounded w-full" onchange="handleResidencyChange()">
                                <option disabled selected>Select Residency</option>
                                <option value="Pasig Resident">Pasig Resident</option>
                                <option value="Non-Pasig Resident">Non-Pasig Resident</option>
                            </select>
                        </div>
                        <div id="districtContainer" class="hidden mt-1">
                            <label class="block mb-1 font-poppins font-bold">District*</label>
                            <select id="districtSelect" name="district" class="select p-2 border rounded w-full" onchange="handleDistrictChange()">
                                <option disabled selected>Select District</option>
                                <option value="district1">District 1</option>
                                <option value="district2">District 2</option>
                            </select>
                        </div>
                        <div id="barangayContainer1" class="hidden mt-1">
                            <label class="block mb-2 font-poppins font-bold">Barangay*</label>
                            <select id="barangaySelect1" name="barangay1" class="select p-2 border rounded w-full">
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
                            <label class="block mb-2 font-poppins font-bold">Barangay*</label>
                            <select id="barangaySelect2" name="barangay2" class="select p-2 border rounded w-full">
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
                            <label class="block mb-1 font-poppins font-bold">Enter Residency*</label>
                            <input type="text" id="nonPasigInput" name="non_pasig_resident" class="w-full p-2 border rounded" placeholder="Enter Residency" />
                        </div>
                        <div>
                            <label class="block mb-2 font-poppins font-bold">Address*</label>
                            <input type="text" name="address" class="w-full p-2 border rounded" placeholder="House Number/Unit/Building, Street, Subdivision/Village" required>
                        </div>
                        <div id="typeContainer">
                        <label class="block mb-1 font-poppins font-bold">Type of School*</label>
                        <select id="typeSelect" name="type" class="select p-2 border rounded w-full" onchange="handleTypeChange()">
                            <option disabled selected>Select Type of School</option>
                            <option value="public">Public</option>
                            <option value="private">Private</option>
                        </select>
                        </div>
                        <div id="publicSchoolContainer" class="hidden mt-1">
                            <label class="block mb-2 font-poppins font-bold">Last School Attended*</label>
                            <select id="publicSchoolSelect" name="public_school" class="select p-2 border rounded w-full" onchange="handlePublicSchoolChange()">
                                <option select disabled value="">Select Last School Attended</option>
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
                        <div id="otherPublicSchoolContainer" class="hidden mt-1">
                            <label class="block mb-2 font-poppins font-bold">Other: Please Specify*</label>
                            <input type="text" id="otherPublicSchoolInput" name="other_public_school" class="w-full p-2 border rounded" placeholder="Enter School Name" />
                        </div>
                        <div id="privateSchoolContainer" class="hidden mt-1">
                            <label class="block mb-2 font-poppins font-bold">Enter Private School Name*</label>
                            <input type="text" id="privateSchoolInput" name="private_school" class="w-full p-2 border rounded" placeholder="Enter Private School Name" />
                        </div>
                        <div>
                            <label class="block mb-2 font-poppins font-bold">Email*</label>
                            <input type="email" name="email" class="w-full p-2 border rounded" placeholder="@gmail.com" required>
                        </div>
                        <div>
                            <label class="block mb-2 font-poppins font-bold">Talents*</label>
                            <input type="text" name="talents" class="w-full p-2 border rounded" placeholder="Singing, Dancing" required>
                        </div>
                        <div>
                            <label class="block mb-2 font-poppins font-bold">Strand and Program*</label>
                            <select id="strandProgram" name="strand" class="select p-2 border rounded w-full">
                                <option disabled selected>Select Strand</option>
                                <option value="ABM">ABM(Accountancy, Business and Management)</option>
                                <option value="GAS">GAS(General Academic Strand)</option>
                                <option value="HUMSS">HUMSS(Humanities and Social Sciences)</option>
                                <option value="STEM">STEM(Science, Technology, Engineering and Mathematics)</option>
                                <option value="TVL_HE">Technical-Vocational-Livelihood(TVL)-HOME ECONOMICS(HE)</option>
                                <option value="TVL_ICT">Technical-Vocational-Livelihood(TVL)-INFORMATION COMMUNICATION TECHNOLOGY(ICT)</option>
                                <option value="TVL_SPORTS">Technical-Vocational-Livelihood(TVL)-SPORTS</option>
                            </select>
                        </div>
                        <div>
                            <label class="block mb-2 font-poppins font-bold">Monthly Salary(Combined)*</label>
                            <select id="strandProgram" name="strand" class="select p-2 border rounded w-full">
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
                <div class="bg-gray-100 p-4 rounded-b-lg">
                    <div class="mb-4">
                        <label class="block mb-2 font-poppins font-bold">Choose Parent or Guardian*</label>
                        <div>
                            <input type="radio" id="parentOption" name="relation" value="parent" onchange="handleRelationChange()">
                            <label for="parentOption" class="font-poppins">Parent</label>
                            <input type="radio" id="guardianOption" name="relation" value="guardian" class="ml-4" onchange="handleRelationChange()">
                            <label for="guardianOption" class="font-poppins">Guardian</label>
                        </div>
                    </div>
            
            <!-- Guardian Details Section -->
            <div id="guardianDetailsContainer" class="hidden">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block mb-2 font-poppins font-bold">Guardian Last Name*</label>
                        <input type="text" name="guardian_last_name" class="w-full p-2 border rounded" placeholder="Last Name" required>
                    </div>
                    <div>
                        <label class="block mb-2 font-poppins font-bold">Guardian First Name*</label>
                        <input type="text" name="guardian_first_name" class="w-full p-2 border rounded" placeholder="First Name" required>
                    </div>
                    <div>
                        <label class="block mb-2 font-poppins font-bold">Guardian Middle Name*</label>
                        <input type="text" name="guardian_middle_name" class="w-full p-2 border rounded" placeholder="Middle Name" required>
                    </div>
                    <div>
                        <label class="block mb-2 font-poppins font-bold">Suffix</label>
                        <input type="text" name="guardian_suffix" class="w-full p-2 border rounded" placeholder="Suffix (e.g. Jr.)">
                    </div>
                    <div>
                        <label class="block mb-2 font-poppins font-bold">Age*</label>
                        <input type="number" name="guardian_dob" class="w-full p-2 border rounded" placeholder="Age" required>
                    </div>
                    <div>
                        <label class="block mb-2 font-poppins font-bold">Phone Number*</label>
                        <input type="tel" name="guardian_phone_number" class="w-full p-2 border rounded" placeholder="+63" required>
                    </div>
                    <div>
                        <label class="block mb-2 font-poppins font-bold">Email*</label>
                        <input type="email" name="guardian_email" class="w-full p-2 border rounded" placeholder="@gmail.com" required>
                    </div>
                    <div>
                        <label class="block mb-2 font-poppins font-bold">Address*</label>
                        <input type="text" name="guardian_address" class="w-full p-2 border rounded" placeholder="House Number/Unit/Building, Street, Subdivision/Village" required>
                    </div>
                </div>
            </div>
            
             <!-- Parent Details Section -->
            <div id="parentDetailsContainer" class="hidden">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block mb-2 font-poppins font-bold">Parent Last Name*</label>
                            <input type="text" name="parent_last_name" class="w-full p-2 border rounded" placeholder="Last Name" required>
                        </div>
                        <div>
                            <label class="block mb-2 font-poppins font-bold"> Parent First Name*</label>
                            <input type="text" name="parent_first_name" class="w-full p-2 border rounded" placeholder="First Name" required>
                        </div>
                        <div>
                            <label class="block mb-2 font-poppins font-bold">Parent Middle Name*</label>
                            <input type="text" name="parent_middle_name" class="w-full p-2 border rounded" placeholder="Middle Name" required>
                        </div>
                        <div>
                            <label class="block mb-2 font-poppins font-bold">Suffix</label>
                            <input type="text" name="parent_suffix" class="w-full p-2 border rounded" placeholder="Suffix (e.g. Jr.)">
                        </div>
                        <div>
                            <label class="block mb-2 font-poppins font-bold">Age*</label>
                            <input type="number" name="parent_dob" class="w-full p-2 border rounded" placeholder="Age" required>
                        </div>
                        <div>
                            <label class="block mb-2 font-poppins font-bold">Phone Number*</label>
                            <input type="tel" name="parent_phone_number" class="w-full p-2 border rounded" placeholder="+63" required>
                        </div>
                        <div>
                            <label class="block mb-2 font-poppins font-bold">Email*</label>
                            <input type="email" name="parent_email" class="w-full p-2 border rounded" placeholder="Email" required>
                        </div>
                        <div>
                            <label class="block mb-2 font-poppins font-bold">Address*</label>
                            <input type="text" name="parent_address" class="w-full p-2 border rounded" placeholder="House Number/Unit/Building, Street, Subdivision/Village" required>
                        </div>
                    </div>
                </div>
            </div>


            <div class="text-right">
                <button type="button" onclick="redirectNext()" class="bg-green-600 text-white px-4 py-2 rounded font-poppins mt-5">Next</button>
            </div>
        </form>
    </div>

    <script>
        function redirectNext() {
            window.location.href = "{{ url('admissionform2') }}";
        }

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

            if (districtValue === "district1") {
                barangayContainer1.classList.remove("hidden");
                barangayContainer2.classList.add("hidden");
            } else if (districtValue === "district2") {
                barangayContainer1.classList.add("hidden");
                barangayContainer2.classList.remove("hidden");
            }
        }

        function handleTypeChange() {
                const typeSelect = document.getElementById("typeSelect").value;
                const publicSchoolContainer = document.getElementById("publicSchoolContainer");
                const privateSchoolContainer = document.getElementById("privateSchoolContainer");

                if (typeSelect === "public") {
                    publicSchoolContainer.classList.remove("hidden");
                    privateSchoolContainer.classList.add("hidden");
                } else if (typeSelect === "private") {
                    publicSchoolContainer.classList.add("hidden");
                    privateSchoolContainer.classList.remove("hidden");
                }
            }

        function handlePublicSchoolChange() {
            const publicSchoolSelect = document.getElementById("publicSchoolSelect").value;
            const otherPublicSchoolContainer = document.getElementById("otherPublicSchoolContainer");

            if (publicSchoolSelect === "Other") {
                otherPublicSchoolContainer.classList.remove("hidden");
            } else {
                otherPublicSchoolContainer.classList.add("hidden");
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
    </script>

</x-layout>