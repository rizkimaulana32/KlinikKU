<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generated Report</title>
    <style>
        {!! file_get_contents(public_path($cssFilePath)) !!}
    </style>
</head>

<body class="bg-gray-50">
    <div class="container p-8 mx-auto">
        <h1 class="mb-8 text-3xl font-bold text-center">Generated Report</h1>
        <div class="max-w-4xl p-6 mx-auto bg-white rounded-lg shadow-md">
            <div class="mb-4">
                <h2 class="mb-4 text-xl font-bold">Report Details</h2>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-700">Start Date: <span
                                class="font-medium">{{ $startDate }}</span></p>
                        <p class="text-sm text-gray-700">End Date: <span class="font-medium">{{ $endDate }}</span>
                        </p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-700">Generated On: <span
                                class="font-medium">{{ now()->toDateTimeString() }}</span></p>
                    </div>
                </div>
            </div>
            <div class="mb-8">
                <h2 class="mb-4 text-xl font-bold">Summary</h2>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-700">Total Appointments: <span
                                class="font-medium">{{ $totalAppointments }}</span></p>
                        <p class="text-sm text-gray-700">Total Patients: <span
                                class="font-medium">{{ $totalPatients }}</span></p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-700">Total Doctors: <span
                                class="font-medium">{{ $totalDoctors }}</span></p>
                        <p class="text-sm text-gray-700">New Patient Accounts: <span
                                class="font-medium">{{ $newPatientAccounts }}</span></p>
                    </div>
                </div>
            </div>
            <div class="mb-8">
                <h2 class="mb-4 text-xl font-bold">Additional Information</h2>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-700">Top 5 Patients with Most Appointments:</p>
                        <ul class="mt-2 ml-4 list-disc">
                            @foreach ($topPatients as $patient)
                                <li class="text-sm text-gray-700">{{ $patient->name }} -
                                    {{ $patient->appointment_count }} appointments</li>
                            @endforeach
                        </ul>
                    </div>
                    <div>
                        <p class="text-sm text-gray-700">Appointments by Doctor:</p>
                        <ul class="mt-2 ml-4 list-disc">
                            @foreach ($appointmentsByDoctor as $doctor)
                                <li class="text-sm text-gray-700">{{ $doctor->name }} -
                                    {{ $doctor->appointment_count }} appointments</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
