<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\JanjiTemu;
use App\Models\Pasien;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File as FacadesFile;

class LaporanController extends Controller
{
    public function index()
    {
        return view('admin.laporan.index');
    }

    public function generate(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Retrieve data for the report
        $totalAppointments = JanjiTemu::whereBetween('date', [$startDate, $endDate])->count();
        $totalPatients = Pasien::count();
        $totalDoctors = Dokter::count();
        $newPatientAccounts = Pasien::whereBetween('created_at', [$startDate, $endDate])->count();

        // Top 5 patients with most appointments
        $topPatients = JanjiTemu::select('pasien_id', DB::raw('count(*) as appointment_count'))
            ->whereBetween('date', [$startDate, $endDate])
            ->groupBy('pasien_id')
            ->orderByDesc('appointment_count')
            ->take(5)
            ->get();

        // Appointments by doctor
        $appointmentsByDoctor = JanjiTemu::select('dokter_id', DB::raw('count(*) as appointment_count'))
            ->whereBetween('date', [$startDate, $endDate])
            ->groupBy('dokter_id')
            ->orderByDesc('appointment_count')
            ->get();

        return view('admin.laporan.show', compact(
            'startDate',
            'endDate',
            'totalAppointments',
            'totalPatients',
            'totalDoctors',
            'newPatientAccounts',
            'topPatients',
            'appointmentsByDoctor'
        ));
    }

    public function download(Request $request)
    {
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');

        // Retrieve data for the report (optional, if you need to regenerate the report for download)
        $totalAppointments = JanjiTemu::whereBetween('date', [$startDate, $endDate])->count();
        $totalPatients = Pasien::count();
        $totalDoctors = Dokter::count();
        $newPatientAccounts = Pasien::whereBetween('created_at', [$startDate, $endDate])->count();

        // Top 5 patients with most appointments
        $topPatients = JanjiTemu::select('pasien_id', DB::raw('count(*) as appointment_count'))
            ->whereBetween('date', [$startDate, $endDate])
            ->groupBy('pasien_id')
            ->orderByDesc('appointment_count')
            ->take(5)
            ->get();

        // Appointments by doctor
        $appointmentsByDoctor = JanjiTemu::select('dokter_id', DB::raw('count(*) as appointment_count'))
            ->whereBetween('date', [$startDate, $endDate])
            ->groupBy('dokter_id')
            ->orderByDesc('appointment_count')
            ->get();

        $cssFilePath = '';
        $manifestPath = public_path('build/manifest.json');

        if (FacadesFile::exists($manifestPath)) {
            $manifest = json_decode(FacadesFile::get($manifestPath), true);
            foreach ($manifest as $file => $details) {
                if (strpos($file, 'resources/css/app.css') !== false) {
                    $cssFilePath = 'build/' . $details['file'];
                    break;
                }
            }
        }

        // Create a new PDF document
        $pdf = Pdf::loadView('admin.laporan.pdf', compact(
            'startDate',
            'endDate',
            'totalAppointments',
            'totalPatients',
            'totalDoctors',
            'newPatientAccounts',
            'topPatients',
            'appointmentsByDoctor',
            'cssFilePath'
        ));

        // Download the PDF file
        return $pdf->download('report.pdf');
    }
}
