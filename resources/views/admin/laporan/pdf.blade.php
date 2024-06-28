<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Generated Report</title>
    <style>
        /* Global styles */
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f3f4f6;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Page header */
        h1 {
            font-size: 2.5rem;
            font-weight: bold;
            text-align: center;
            margin-bottom: 2rem;
        }

        /* Report details */
        .grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .grid>div {
            padding: 0.5rem;
            background-color: #ffffff;
            border-radius: 0.5rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .text-sm {
            font-size: 0.875rem;
            color: #4b5563;
        }

        .text-gray-700 {
            color: #4b5563;
        }

        .font-medium {
            font-weight: 500;
        }

        /* Summary section */
        .mb-8 {
            margin-bottom: 2rem;
        }

        .text-xl {
            font-size: 1.25rem;
            font-weight: bold;
            margin-bottom: 1rem;
        }

        .grid-cols-2 {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
        }

        .list-disc {
            margin-left: 1rem;
            list-style-type: disc;
        }

        /* Additional Information section */
        .mb-8 {
            margin-bottom: 2rem;
        }

        /* Footer */
        footer {
            text-align: center;
            padding: 1rem 0;
            background-color: #e2e8f0;
            color: #2d3748;
            font-size: 0.875rem;
        }
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
                            @foreach ($topPatients as $janjitemu)
                                <li class="text-sm text-gray-700">{{ $janjitemu->pasien->name }} -
                                    {{ $janjitemu->appointment_count }} appointments</li>
                            @endforeach
                        </ul>
                    </div>
                    <div>
                        <p class="text-sm text-gray-700">Appointments by Doctor:</p>
                        <ul class="mt-2 ml-4 list-disc">
                            @foreach ($appointmentsByDoctor as $janjitemu)
                                <li class="text-sm text-gray-700">{{ $janjitemu->dokter->name }} -
                                    {{ $janjitemu->appointment_count }} appointments</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
