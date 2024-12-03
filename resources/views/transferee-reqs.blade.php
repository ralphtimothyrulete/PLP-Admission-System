<x-layout>
    <x-slot:heading>
        Requirements
    </x-slot:heading>
    <h1 class="text-3xl font-bold text-green-600 mb-1 font-poppins">STUDENT TRANSFEREE APPLICATION</h1>
    <main class="container mx-auto px-6 py-8">
        @if(session('status'))
            <div class="alert alert-success bg-green-600 font-semibold" style="margin: 1%">
                {{ session('status') }}            
            </div>
        @endif
        <form method="POST" action="{{ route('transferee.upload') }}" enctype="multipart/form-data" id="transferee-upload-form">
            @csrf
            <input type="hidden" name="student_id" value="{{ session('student_id') }}">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Required Documents Section -->
                <div class="bg-white p-6 rounded-lg shadow-lg font-poppins">
                    <h2 class="text-xl font-semibold text-white bg-green-600 p-2 rounded-t-lg">Required Documents</h2>
                    <ul class="space-y-4 mt-4 text-black">
                        <li class="border border-green-500 rounded-lg p-4">Certified True Copy (CTC) of TOR with remarks</li>
                        <li class="border border-green-500 rounded-lg p-4">Any Government Issued ID / School ID of Student</li>
                        <li class="border border-green-500 rounded-lg p-4">PSA Birth Certificate</li>
                        <li class="border border-green-500 rounded-lg p-4">Two (2) pcs. of Passport-Sized Picture, White Background, with Nameplate</li>
                        <li class="border border-green-500 rounded-lg p-4">Any Government Issued ID of Parents / Guardian</li>
                        <li class="border border-green-500 rounded-lg p-4">Notarized Affidavit of Guardianship (For Applicants with Guardians only)</li>
                    </ul>
                </div>

                <!-- Media Upload Section -->
                <div class="bg-white p-6 rounded-lg shadow-lg font-poppins">
                    <h2 class="text-xl font-semibold text-gray-700 mb-2">Media Upload</h2>
                    <p class="mb-4"> Add your documents here </p>
                    <div id="drop-area" class="border-dashed border-2 border-green-600 rounded-lg p-4 mb-4 text-center">
                        <p class="text-gray-600">Drag your file(s) or <label for="transferee-uploads" class="text-green-600 cursor-pointer">browse</label></p>
                        <p class="text-sm text-gray-500">Max 10 MB files are allowed</p>
                        <input type="file" name="transferee_files[]" id="transferee-uploads" class="hidden" multiple>

                        @if ($errors->has('transferee_files.*'))
                            <ul class="text-red-600">
                                @foreach($errors->get('transferee_files.*') as $error)
                                    <li>{{  $error[0] }}</li>
                                @endforeach
                            </ul>
                        @endif

                        @error('transferee_files')
                            <span class="text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                    <p class="mb-3 font-poppins text-gray-500">Only supports .jpg, .jpeg, and .png files</p>

                    <div>
                        <h3 class="text-lg font-semibold text-gray-700 mb-3">Uploaded Files</h3>
                        <ul class="space-y-2" id="file-list">
                            <!-- Uploaded files will be listed here -->
                        </ul>
                    </div>
                </div>
            </div>

            <div class="text-right mt-6 font-poppins">
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg">Submit Files</button>
            </div>
        </form>
    </main>

    <script>
        let files = [];
        const fileUpload = document.getElementById('transferee-uploads');
        const fileList = document.getElementById('file-list');
        const dropArea = document.getElementById('drop-area');

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
            dropArea.addEventListener(eventName, () => dropArea.classList.add('bg-gray-100'), false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            dropArea.addEventListener(eventName, () => dropArea.classList.remove('bg-gray-100'), false);
        });

        // Handle dropped files
        dropArea.addEventListener('drop', handleDrop, false);

        function handleDrop(e) {
            const dt = e.dataTransfer;
            const droppedFiles = dt.files;

            Array.from(droppedFiles).forEach(file => {
                files.push(file);
            });

            renderFileList();
        }

        // Handle file input change (when user selects files manually)
        fileUpload.addEventListener('change', (e) => {
            Array.from(e.target.files).forEach(file => {
                files.push(file);
            });
            renderFileList();
        });

        function renderFileList() {
            fileList.innerHTML = ''; // Clear the file list

            files.forEach((file, index) => {
                const li = document.createElement('li');
                li.className = 'border border-green-500 rounded-lg p-4 flex justify-between items-center text-black';
                li.innerHTML = `<span>${file.name}</span>
                                <button type="button" class="text-red-600" onclick="removeFile(${index})">&times;</button>`;
                fileList.appendChild(li);
            });
        }

        function removeFile(index) {
            files.splice(index, 1); // Remove the file from the array
            renderFileList(); // Re-render the file list
        }

        document.getElementById('transferee-upload-form').addEventListener('submit', function (e) {
            const formData = new FormData(this);
            files.forEach(file => formData.append('transferee_files[]', file));

            e.preventDefault(); // Stop the default form submission
        
            // Send the form data using Fetch API
            fetch("{{ route('transferee.upload') }}", {
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