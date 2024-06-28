<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dokter;
use App\Models\JanjiTemu;
use App\Models\Pasien;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            ->take(5)
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
        $startDate = $request->startDate;
        $endDate = $request->endDate;

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
            ->take(5)
            ->get();

        // Create a new PDF document
        $pdf = Pdf::loadView('admin.laporan.pdf', compact(
            'startDate',
            'endDate',
            'totalAppointments',
            'totalPatients',
            'totalDoctors',
            'newPatientAccounts',
            'topPatients',
            'appointmentsByDoctor'
        ));

        // Download the PDF file
        return $pdf->download('report.pdf');
    }
}
