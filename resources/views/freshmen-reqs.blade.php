<x-layout> 
    <x-slot:heading>
        Requirements
    </x-slot:heading>
    <x-progress-bar :step="$student->step" />
    <h1 class="text-3xl font-bold text-green-600 mb-1 mt-4 font-poppins text-center md:text-left">STUDENT FRESHMEN APPLICATION</h1>
    <main class="container mx-auto px-6 py-8">
        @if(session('status'))
            <div class="alert alert-success bg-green-600 font-semibold" style="margin: 1%">
                {{ session('status') }}            
            </div>
        @endif
        <form method="POST" action="{{ route('freshmen.upload') }}" enctype="multipart/form-data" id="upload-form">
            @csrf  
            <input type="hidden" name="student_id" value="{{ $student_id }}">        
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Required Documents Section -->
                <div class="bg-white p-6 rounded-lg shadow-lg card-appear">
                    <h2 class="text-xl font-semibold text-white bg-green-600 p-2 rounded-t-lg font-poppins">Required Documents</h2>
                    <ul class="space-y-4 mt-4 font-poppins text-black">
                        <li class="border border-green-500 rounded-lg p-4 transition-all hover:bg-green-100">Certified True Copy (CTC) of Grade 11</li>
                        <li class="border border-green-500 rounded-lg p-4 transition-all hover:bg-green-100">Form 138 (For ongoing Grade 12 Students)</li>
                        <li class="border border-green-500 rounded-lg p-4 transition-all hover:bg-green-100">Form 137 (For SHS Graduate)</li>
                        <li class="border border-green-500 rounded-lg p-4 transition-all hover:bg-green-100">Any Government Issued ID / School ID of Student</li>
                        <li class="border border-green-500 rounded-lg p-4 transition-all hover:bg-green-100">PSA Birth Certificate</li>
                        <li class="border border-green-500 rounded-lg p-4 transition-all hover:bg-green-100">Two (2) pcs. of Passport-Sized Picture, White Background, with Nameplate</li>
                        <li class="border border-green-500 rounded-lg p-4 transition-all hover:bg-green-100">Any Government Issued ID of Parent / Guardian</li>
                        <li class="border border-green-500 rounded-lg p-4 transition-all hover:bg-green-100">Notarized Affidavit of Guardianship (For Applicants with Guardian)</li>
                    </ul>
                </div>

                <!-- Media Upload Section -->
                <div class="bg-white p-6 rounded-lg shadow-lg font-poppins card-appear">
                    <h2 class="text-xl font-semibold text-black mb-2">Media Upload</h2>
                    <p class="mb-1 text-gray-600"> Add your documents here </p>
                    <p class="mb-4 text-gray-800 font-bold"> Make sure to name your file properly (LastName_DocumentName) </p>
                    <div id="drop-area" class="border-dashed border-2 border-green-600 rounded-lg p-4 mb-4 text-center transition-all">
                        <p class="text-gray-600">Drag your file(s) here or <label for="freshmen-uploads" class="text-green-600 cursor-pointer">browse</label></p>
                        <p class="text-sm text-gray-500">Max 10 MB files are allowed</p>
                        <input type="file" name="freshmen_images[]" id="freshmen-uploads" class="hidden" multiple />
                        
                        @if ($errors->has('freshmen_images.*'))
                            <ul class="text-red-600">
                                @foreach($errors->get('freshmen_images.*') as $error)
                                    <li>{{  $error[0] }}</li>
                                @endforeach
                            </ul>
                        @endif

                        @error('freshmen_images')
                            <span class="text-red-600">{{ $message }}</span>
                        @enderror

                    </div>
                        <p class="mb-3 font-poppins text-gray-600">Only supports .jpg, .jpeg and .png files</p>
                    <div>
                        <h3 class="text-lg font-semibold text-black mb-3 font-poppins">Uploaded Files</h3>
                        <ul class="space-y-2" id="file-list">
                            <!-- Uploaded files will be listed here -->
                        </ul>
                    </div>
                </div>
            </div>

            <div class="text-right mt-6">
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg font-poppins hover:scale-105 transition-transform duration-200">Submit Files</button>
            </div>
        </form>
    </main>

    <style>
        .file-link:hover {
            text-decoration: underline;
            text-decoration-color: gray;
        }
        .remove-button {
            position: relative;
        }
        .remove-button::after {
            content: 'Remove';
            position: absolute;
            top: -25px; /* Adjust this value as needed */
            left: 75%;
            transform: translateX(-75%);
            background-color: white;
            border-radius: 3px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            padding: 2px 5px;
            opacity: 0;
            transition: opacity 0.2s;
        }
        .remove-button:hover::after {
            opacity: 1;
        }
        .remove-button:hover::before {
            content: '';
            opacity: 0;
        }
    </style>

    <script>
    let files = [];
    const fileUpload = document.getElementById('freshmen-uploads');
    const fileList = document.getElementById('file-list');
    const dropArea = document.getElementById('drop-area');
    const maxFileSize = 10 * 1024 * 1024; // 10 MB
    const errorMessage = document.createElement('p');
    errorMessage.className = 'text-red-600';

    // Prevent default behavior (Prevent file from being opened)
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropArea.addEventListener(eventName, preventDefaults, false);
    });

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    // Highlight drop area when file is dragged over
    ['dragenter', 'dragover'].forEach(eventName => {
        dropArea.addEventListener(eventName, () => dropArea.classList.add('animate-glow'), false);
    });
    ['dragleave', 'drop'].forEach(eventName => {
        dropArea.addEventListener(eventName, () => dropArea.classList.remove('animate-glow'), false);
    });

    // Handle dropped files
    dropArea.addEventListener('drop', handleDrop, false);

    function handleDrop(e) {
        const dt = e.dataTransfer;
        const droppedFiles = dt.files;

        Array.from(droppedFiles).forEach(file => {
            if (file.size > maxFileSize) {
                errorMessage.textContent = `File ${file.name} exceeds the 10 MB limit.`;
                dropArea.appendChild(errorMessage);
            } else {
                files.push(file);
            }
        });

        renderFileList();
    }

    // Handle file input change (when user selects files manually)
    fileUpload.addEventListener('change', (e) => {
        Array.from(e.target.files).forEach(file => {
            if (file.size > maxFileSize) {
                errorMessage.textContent = `File ${file.name} exceeds the 10 MB limit.`;
                dropArea.appendChild(errorMessage);
            } else {
                files.push(file);
            }
        });
        renderFileList();
    });

    function renderFileList() {
        fileList.innerHTML = ''; // Clear the file list

        files.forEach((file, index) => {
            const li = document.createElement('li');
            li.className = 'border border-green-500 rounded-lg p-4 flex justify-between items-center text-black animate-fadeIn';
            li.innerHTML = `<a href="${URL.createObjectURL(file)}" target="_blank" class="text-black file-link">${file.name}</a>
                            <button type="button" class="text-red-600 font-semibold remove-button" onclick="removeFile(${index})">&times;</button>`;
            fileList.appendChild(li);
        });
    }

    function removeFile(index) {
        files.splice(index, 1); // Remove the file from the array
        renderFileList(); // Re-render the file list
    }

    document.getElementById('upload-form').addEventListener('submit', function (e) {
        const formData = new FormData(this);
        files.forEach(file => formData.append('freshmen_images[]', file));

        e.preventDefault(); // Stop the default form submission
    
        // Send the form data using Fetch API
        fetch("{{ route('freshmen.upload') }}", {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                alert(data.message);
                // Reset the file input and file list
                files = [];
                renderFileList();
                fileUpload.value = '';
            } else {
                alert('An error occurred while uploading the files.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while uploading the files.');
        });
    });
    </script>
</x-layout>