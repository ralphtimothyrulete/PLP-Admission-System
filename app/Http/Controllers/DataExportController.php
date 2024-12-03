<?php
// app/Http/Controllers/DataExportController.php
namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Application;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DataExportController extends Controller
{
    public function exportData()
    {
        // Fetch data from the database
        $data = DB::table('students')
            ->join('applications', 'students.id', '=', 'applications.student_id')
            ->select('students.salary', 'applications.overall_grade as GWA')
            ->where('applications.overall_grade', '>=', 85)
            ->whereIn('students.salary', ['Low-income', 'Lower-middle-income'])  // Filter for lower class
            ->get();

        // Convert data to an array
        $csvData = [];
        foreach ($data as $row) {
            $csvData[] = (array) $row;
        }

        // Define the CSV file name
        $fileName = 'admissions_data.csv';

        // Open a file in write mode
        $file = fopen($fileName, 'w');

        // Add the header row
        fputcsv($file, ['Salary', 'GWA']);

        // Add the data rows
        foreach ($csvData as $row) {
            fputcsv($file, $row);
        }

        // Close the file
        fclose($file);

        // Return the file as a download response
        return response()->download($fileName);
    }
}