<x-layout>
    <x-slot:heading>
        Requirements
    </x-slot:heading>
    <h1 class="text-3xl font-bold text-green-600 mb-1">STUDENT TRANSFEREE APPLICATION</h1>
    <main class="container mx-auto px-6 py-8">
        <form method="POST" action="{{ route('transferee.upload') }}" enctype="multipart/form-data" id="upload-form">
            @csrf
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Required Documents Section -->
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h2 class="text-xl font-semibold text-white bg-green-600 p-2 rounded-t-lg font-poppins">Required Documents</h2>
                    <ul class="space-y-4 mt-4">
                        <li class="border border-green-500 rounded-lg p-4">Certified True Copy (CTC) of TOR with remarks</li>
                        <li class="border border-green-500 rounded-lg p-4">Any Government Issued ID / School ID of Student</li>
                        <li class="border border-green-500 rounded-lg p-4">PSA Birth Certificate</li>
                        <li class="border border-green-500 rounded-lg p-4">Two (2) pcs. of Passport-Sized Picture, White Background, with Nameplate</li>
                        <li class="border border-green-500 rounded-lg p-4">Any Government Issued ID of Parents / Guardian</li>
                        <li class="border border-green-500 rounded-lg p-4">Notarized Affidavit of Guardianship (For Applicants with Guardians only)</li>
                    </ul>
                </div>

                <!-- Media Upload Section -->
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h2 class="text-xl font-semibold text-gray-700 mb-4">Media Upload</h2>
                    <div class="border-dashed border-2 border-gray-300 rounded-lg p-4 mb-4 text-center">
                        <p class="text-gray-600">Drag your file(s) or <label for="file-upload" class="text-green-600 cursor-pointer">browse</label></p>
                        <p class="text-sm text-gray-500">Max 10 MB files are allowed</p>
                        <input type="file" name="files[]" id="file-upload" class="hidden" multiple>
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold text-gray-700 mb-2">Uploaded Files</h3>
                        <ul class="space-y-2" id="file-list">
                            <!-- Uploaded files will be listed here -->
                        </ul>
                    </div>
                </div>
            </div>

            <div class="text-right mt-6">
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg">Submit Files</button>
            </div>
        </form>
    </main>

    <script>
        let files = [];
        const fileUpload = document.getElementById('file-upload');
        const fileList = document.getElementById('file-list');

        fileUpload.addEventListener('change', (e) => {
            Array.from(e.target.files).forEach(file => {
                files.push(file); // Add files to the array
            });
            renderFileList();
        });

        function renderFileList() {
            fileList.innerHTML = ''; // Clear the file list

            files.forEach((file, index) => {
                const li = document.createElement('li');
                li.className = 'border border-green-500 rounded-lg p-4 flex justify-between items-center';
                li.innerHTML = `<span>${file.name}</span>
                                <button type="button" class="text-red-600" onclick="removeFile(${index})">&times;</button>`;
                fileList.appendChild(li);
            });
        }

        function removeFile(index) {
            files.splice(index, 1); // Remove the file from the array
            renderFileList(); // Re-render the file list
        }

        document.getElementById('upload-form').addEventListener('submit', function (e) {
            const formData = new FormData();
            files.forEach(file => formData.append('files[]', file));

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
                alert(data.message);
                // Reset the file input and file list
                files = [];
                renderFileList();
                fileUpload.value = '';
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    </script>
</x-layout>
