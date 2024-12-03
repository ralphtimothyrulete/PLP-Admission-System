
@extends('components.master')

@section('body')
<main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
    <div class="container px-6 py-8 mx-auto">
        <h3 class="text-3xl font-bold text-black">Dashboard</h3>

        <div class="mt-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="bg-white p-4 rounded-lg shadow-md">
                <h3 class="text-2xl font-bold text-gray-800">Gender</h3>
                <canvas id="genderChart" width="400" height="300"></canvas>
            </div>
            <div class="bg-white p-4 rounded-lg shadow-md">
                <h3 class="text-2xl font-bold text-gray-800">Residency</h3>
                <canvas id="residencyChart" width="400" height="300"></canvas>
            </div>
            <div class="bg-white p-4 rounded-lg shadow-md md:col-span-2">
                <h3 class="text-2xl font-bold text-gray-800">First Choice Programs</h3>
                <canvas id="programTrendsChart" width="800" height="300"></canvas>
            </div>
            <div class="bg-white p-4 rounded-lg shadow-md md:col-span-2">
                <h3 class="text-2xl font-bold text-gray-800">Admission</h3>
                <canvas id="admissionTrendsChart" width="800" height="300"></canvas>
            </div>
            <div class="bg-white p-4 rounded-lg shadow-md md:col-span-2">
                <h3 class="text-2xl font-bold text-gray-800">Grade Performance</h3>
                <canvas id="gradePerformanceChart" width="800" height="300"></canvas>
            </div>
            <div class="bg-white p-4 rounded-lg shadow-md md:col-span-2">
                <h3 class="text-2xl font-bold text-gray-800">Incomes</h3>
                <canvas id="incomeDistributionChart" width="800" height="300"></canvas>
            </div>
            <div class="bg-white p-4 rounded-lg shadow-md md:col-span-2">
                <h3 class="text-2xl font-bold text-gray-800">Strands</h3>
                <canvas id="strandDistributionChart" width="800" height="300"></canvas>
            </div>
            <div class="bg-white p-4 rounded-lg shadow-md md:col-span-2">
                <h3 class="text-2xl font-bold text-gray-800">Application Choices</h3>
                <canvas id="choiceFrequencyChart" width="800" height="600"></canvas>
            </div>
            <div class="bg-white p-4 rounded-lg shadow-md md:col-span-2">
                <h3 class="text-2xl font-bold text-gray-800">Religion Distribution</h3>
                <canvas id="religionChart" width="800" height="300"></canvas>
            </div>
            <div class="bg-white p-4 rounded-lg shadow-md md:col-span-2">
                <h3 class="text-2xl font-bold text-gray-800">Applicants School Type</h3>
                <canvas id="schoolTypeChart" width="800" height="400"></canvas>
            </div>
            <div class="bg-white p-4 rounded-lg shadow-md md:col-span-2">
                <h3 class="text-2xl font-bold text-gray-800">Residency by Barangay</h3>
                <canvas id="residencyByBarangayChart" width="800" height="300"></canvas>
            </div>
            <div class="bg-white p-4 rounded-lg shadow-md md:col-span-2">
                <h3 class="text-2xl font-bold text-gray-800">Talent Distribution</h3>
                <canvas id="talentsChart" width="800" height="300"></canvas>
            </div>
            <div class="bg-white p-4 rounded-lg shadow-md md:col-span-2">
                <h3 class="text-2xl font-bold text-gray-800">Sports Participation</h3>
                <canvas id="sportsChart" width="800" height="300"></canvas>
            </div>
        </div>
    </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', function () {
    fetch("{{ route('analytics.data') }}")
        .then(response => response.json())
        .then(data => {
            // Gender Chart
            new Chart(document.getElementById('genderChart'), {
                type: 'pie',
                data: {
                    labels: ['Male', 'Female'],
                    datasets: [{
                        data: [data.maleCount, data.femaleCount],
                        backgroundColor: ['#36A2EB', '#FF6384']
                    }]
                }
            });

            // Residency Chart
            new Chart(document.getElementById('residencyChart'), {
                type: 'pie',
                data: {
                    labels: ['Pasigueños', 'Non-Pasigueños'],
                    datasets: [{
                        data: [data.pasiguenosCount, data.nonPasiguenosCount],
                        backgroundColor: ['#4BC0C0', '#FFCE56']
                    }]
                }
            });

            // Program Trends Chart
            new Chart(document.getElementById('programTrendsChart'), {
                type: 'bar',
                data: {
                    labels: data.programTrends.map(item => item.first_choice),
                    datasets: [{
                        label: 'Number of Applications',
                        data: data.programTrends.map(item => item.total),
                        backgroundColor: '#FF6384'
                    }]
                }
            });

            // Admission Trends Chart
            new Chart(document.getElementById('admissionTrendsChart'), {
                type: 'line',
                data: {
                    labels: data.admissionTrends.map(item => item.first_choice),
                    datasets: [{
                        label: 'Number of Admissions',
                        data: data.admissionTrends.map(item => item.total),
                        backgroundColor: '#36A2EB',
                        borderColor: '#36A2EB',
                        fill: false
                    }]
                }
            });

            // Grade Performance Chart
            new Chart(document.getElementById('gradePerformanceChart'), {
                type: 'bar',
                data: {
                    labels: ['Science', 'Math', 'English', 'Overall'],
                    datasets: [{
                        label: 'Average Grades',
                        data: [data.averageGrades.avg_science, data.averageGrades.avg_math, data.averageGrades.avg_english, data.averageGrades.avg_overall],
                        backgroundColor: '#FF6384'
                    }]
                }
            });

            // Income Distribution Chart
            new Chart(document.getElementById('incomeDistributionChart'), {
                type: 'bar',
                data: {
                    labels: data.incomeDistribution.map(item => item.salary),
                    datasets: [{
                        label: 'Number of Students',
                        data: data.incomeDistribution.map(item => item.total),
                        backgroundColor: '#4BC0C0'
                    }]
                }
            });

            // Strand Distribution Chart
            new Chart(document.getElementById('strandDistributionChart'), {
                type: 'bar',
                data: {
                    labels: data.strandDistribution.map(item => item.strand),
                    datasets: [{
                        label: 'Number of Students',
                        data: data.strandDistribution.map(item => item.total),
                        backgroundColor: '#FFCE56'
                    }]
                }
            });

            // Choice Frequency Chart
            new Chart(document.getElementById('choiceFrequencyChart'), {
                type: 'bar',
                data: {
                    labels: data.choiceFrequency.map(item => item.choice),
                    datasets: [{
                        label: 'Number of Choices',
                        data: data.choiceFrequency.map(item => item.total),
                        backgroundColor: '#36A2EB'
                    }]
                },
                options: {
                    indexAxis: 'y'
                }   
            });

            // Religion Chart
            new Chart(document.getElementById('religionChart'), {
                type: 'doughnut',
                data: {
                    labels: data.religionDistribution.map(item => item.religion),
                    datasets: [{
                        data: data.religionDistribution.map(item => item.total),
                        backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0']
                    }]
                }
            });

            // School Type Chart
            new Chart(document.getElementById('schoolTypeChart'), {
                type: 'bar',
                data: {
                    labels: data.applicantsBySchoolType.map(item => item.school_type),
                    datasets: [{
                        label: 'Number of Applicants',
                        data: data.applicantsBySchoolType.map(item => item.total),
                        backgroundColor: ['#36A2EB', '#FF6384']
                    }]
                }
            });

            // Sports Chart
            new Chart(document.getElementById('sportsChart'), {
                type: 'bar',
                data: {
                    labels: data.sportsParticipation.map(item => item.sports),
                    datasets: [{
                        label: 'Number of Participants',
                        data: data.sportsParticipation.map(item => item.total),
                        backgroundColor: '#FFCE56'
                    }]
                },
                options: {
                    indexAxis: 'y'
                }   
            });

            // Residency by Barangay Chart
            new Chart(document.getElementById('residencyByBarangayChart'), {
                type: 'bar',
                data: {
                    labels: data.residencyByBarangay.map(item => item.barangay),
                    datasets: [{
                        label: 'Number of Applicants',
                        data: data.residencyByBarangay.map(item => item.total),
                        backgroundColor: '#4BC0C0'
                    }]
                },
                options: {
                    indexAxis: 'y'
                }   
            });

            // Talent Chart
            new Chart(document.getElementById('talentsChart'), {
                type: 'bar',
                data: {
                    labels: data.talentsDistribution.map(item => item.talents),
                    datasets: [{
                        label: 'Number of Students',
                        data: data.talentsDistribution.map(item => item.total),
                        backgroundColor: '#FF6384'
                    }]
                },
                options: {
                    indexAxis: 'y'
                }   
            });
        });
});
</script>
@endsection