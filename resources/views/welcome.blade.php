<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tampil</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    {{-- tabel kasus --}}
    <table border="1">
        <tr>
            <th></th>
            <th colspan="2">Jumlah Kasus</th>
            <th>Puas</th>
            <th>Tidak Puas</th>
            <th>Entropy</th>
            <th>Gain</th>
        </tr>

        <tr>
            <td>Total</td>
            <td colspan="2">{{ $totalBookings }}</td>
            <td>{{ $totalSatisfiedBookings }}</td> {{-- Puas --}}
            <td>{{ $totalDissatisfiedBookings }}</td> {{-- Tidak Puas --}}
            <td>{{ number_format($entropyTotal, 9) }}</td>
        </tr>

        <tr>
            <td rowspan="5">Tangibles</td>
            <td>STS</td>
            <td>{{ $categoryTangiblesCounts['sts'] }}</td>
            <td>{{ $categoryTangiblesSatisfactionCounts['sts']['puas'] }}</td>
            <td>{{ $categoryTangiblesSatisfactionCounts['sts']['tidak_puas'] }}</td>
            <td>{{ $entropyTangiblesSTS }}</td>{{-- Entropy --}}
            <td rowspan="5">{{ $informationGainTangibles > 0 ? number_format($informationGainTangibles, 9) : 0 }}
            </td>
        </tr>
        <tr>
            <td>TS</td>
            <td>{{ $categoryTangiblesCounts['ts'] }}</td>
            <td>{{ $categoryTangiblesSatisfactionCounts['ts']['puas'] }}</td>
            <td>{{ $categoryTangiblesSatisfactionCounts['ts']['tidak_puas'] }}</td>
            <td>{{ $entropyTangiblesTS }}</td>{{-- Entropy --}}
        </tr>
        <tr>
            <td>N</td>
            <td>{{ $categoryTangiblesCounts['n'] }}</td>
            <td>{{ $categoryTangiblesSatisfactionCounts['n']['puas'] }}</td>
            <td>{{ $categoryTangiblesSatisfactionCounts['n']['tidak_puas'] }}</td>
            <td>{{ $entropyTangiblesN }}</td>{{-- Entropy --}}
        </tr>
        <tr>
            <td>S</td>
            <td>{{ $categoryTangiblesCounts['s'] }}</td>
            <td>{{ $categoryTangiblesSatisfactionCounts['s']['puas'] }}</td>
            <td>{{ $categoryTangiblesSatisfactionCounts['s']['tidak_puas'] }}</td>
            <td>{{ $entropyTangiblesS }} </td>{{-- Entropy --}}
        </tr>
        <tr>
            <td>SS</td>
            <td>{{ $categoryTangiblesCounts['ss'] }}</td>
            <td>{{ $categoryTangiblesSatisfactionCounts['ss']['puas'] }}</td>
            <td>{{ $categoryTangiblesSatisfactionCounts['ss']['tidak_puas'] }}</td>
            <td>{{ $entropyTangiblesSS }}</td>{{-- Entropy --}}
        </tr>

        <tr>
            <td rowspan="5">Reliability</td>
            <td>STS</td>
            <td>{{ $categoryReliabilityCounts['sts'] }}</td>
            <td>{{ $categoryReliabilitySatisfactionCounts['sts']['puas'] }}</td>
            <td>{{ $categoryReliabilitySatisfactionCounts['sts']['tidak_puas'] }}</td>
            <td>{{ $entropyReliabilitySTS }}</td>{{-- Entropy --}}
            <td rowspan="5">
                {{ $informationGainReliability > 0 ? number_format($informationGainReliability, 9) : 0 }}</td>
        </tr>
        <tr>
            <td>TS</td>
            <td>{{ $categoryReliabilityCounts['ts'] }}</td>
            <td>{{ $categoryReliabilitySatisfactionCounts['ts']['puas'] }}</td>
            <td>{{ $categoryReliabilitySatisfactionCounts['ts']['tidak_puas'] }}</td>
            <td>{{ $entropyReliabilityTS }}</td>{{-- Entropy --}}
        </tr>
        <tr>
            <td>N</td>
            <td>{{ $categoryReliabilityCounts['n'] }}</td>
            <td>{{ $categoryReliabilitySatisfactionCounts['n']['puas'] }}</td>
            <td>{{ $categoryReliabilitySatisfactionCounts['n']['tidak_puas'] }}</td>
            <td>{{ $entropyReliabilityN }}</td>{{-- Entropy --}}
        </tr>
        <tr>
            <td>S</td>
            <td>{{ $categoryReliabilityCounts['s'] }}</td>
            <td>{{ $categoryReliabilitySatisfactionCounts['s']['puas'] }}</td>
            <td>{{ $categoryReliabilitySatisfactionCounts['s']['tidak_puas'] }}</td>
            <td>{{ $entropyReliabilityS }}</td>{{-- Entropy --}}
        </tr>
        <tr>
            <td>SS</td>
            <td>{{ $categoryReliabilityCounts['ss'] }}</td>
            <td>{{ $categoryReliabilitySatisfactionCounts['ss']['puas'] }}</td>
            <td>{{ $categoryReliabilitySatisfactionCounts['ss']['tidak_puas'] }}</td>
            <td>{{ $entropyReliabilitySS }}</td>{{-- Entropy --}}
        </tr>

        <tr>
            <td rowspan="5">Responsive</td>
            <td>STS</td>
            <td>{{ $categoryResponsiveCounts['sts'] }}</td>
            <td>{{ $categoryResponsiveSatisfactionCounts['sts']['puas'] }}</td>
            <td>{{ $categoryResponsiveSatisfactionCounts['sts']['tidak_puas'] }}</td>
            <td>{{ $entropyResponsiveSTS }}</td>{{-- Entropy --}}
            <td rowspan="5">{{ $informationGainResponsive > 0 ? number_format($informationGainResponsive, 9) : 0 }}
            </td>
        </tr>
        <tr>
            <td>TS</td>
            <td>{{ $categoryResponsiveCounts['ts'] }}</td>
            <td>{{ $categoryResponsiveSatisfactionCounts['ts']['puas'] }}</td>
            <td>{{ $categoryResponsiveSatisfactionCounts['ts']['tidak_puas'] }}</td>
            <td>{{ $entropyResponsiveTS }}</td>{{-- Entropy --}}
        </tr>
        <tr>
            <td>N</td>
            <td>{{ $categoryResponsiveCounts['n'] }}</td>
            <td>{{ $categoryResponsiveSatisfactionCounts['n']['puas'] }}</td>
            <td>{{ $categoryResponsiveSatisfactionCounts['n']['tidak_puas'] }}</td>
            <td>{{ $entropyResponsiveN }}</td>{{-- Entropy --}}
        </tr>
        <tr>
            <td>S</td>
            <td>{{ $categoryResponsiveCounts['s'] }}</td>
            <td>{{ $categoryResponsiveSatisfactionCounts['s']['puas'] }}</td>
            <td>{{ $categoryResponsiveSatisfactionCounts['s']['tidak_puas'] }}</td>
            <td>{{ $entropyResponsiveS }}</td>{{-- Entropy --}}
        </tr>
        <tr>
            <td>SS</td>
            <td>{{ $categoryResponsiveCounts['ss'] }}</td>
            <td>{{ $categoryResponsiveSatisfactionCounts['ss']['puas'] }}</td>
            <td>{{ $categoryResponsiveSatisfactionCounts['ss']['tidak_puas'] }}</td>
            <td>{{ $entropyResponsiveSS }}</td>{{-- Entropy --}}
        </tr>

        <tr>
            <td rowspan="5">Assurance</td>
            <td>STS</td>
            <td>{{ $categoryAssuranceCounts['sts'] }}</td>
            <td>{{ $categoryAssuranceSatisfactionCounts['sts']['puas'] }}</td>
            <td>{{ $categoryAssuranceSatisfactionCounts['sts']['tidak_puas'] }}</td>
            <td>{{ $entropyAssuranceSTS }}</td>{{-- Entropy --}}
            <td rowspan="5">{{ $informationGainAssurance > 0 ? number_format($informationGainAssurance, 9) : 0 }}
            </td>
        </tr>
        <tr>
            <td>TS</td>
            <td>{{ $categoryAssuranceCounts['ts'] }}</td>
            <td>{{ $categoryAssuranceSatisfactionCounts['ts']['puas'] }}</td>
            <td>{{ $categoryAssuranceSatisfactionCounts['ts']['tidak_puas'] }}</td>
            <td>{{ $entropyAssuranceTS }}</td>{{-- Entropy --}}
        </tr>
        <tr>
            <td>N</td>
            <td>{{ $categoryAssuranceCounts['n'] }}</td>
            <td>{{ $categoryAssuranceSatisfactionCounts['n']['puas'] }}</td>
            <td>{{ $categoryAssuranceSatisfactionCounts['n']['tidak_puas'] }}</td>
            <td>{{ $entropyAssuranceN }}</td>{{-- Entropy --}}
        </tr>
        <tr>
            <td>S</td>
            <td>{{ $categoryAssuranceCounts['s'] }}</td>
            <td>{{ $categoryAssuranceSatisfactionCounts['s']['puas'] }}</td>
            <td>{{ $categoryAssuranceSatisfactionCounts['s']['tidak_puas'] }}</td>
            <td>{{ $entropyAssuranceS }}</td>{{-- Entropy --}}
        </tr>
        <tr>
            <td>SS</td>
            <td>{{ $categoryAssuranceCounts['ss'] }}</td>
            <td>{{ $categoryAssuranceSatisfactionCounts['ss']['puas'] }}</td>
            <td>{{ $categoryAssuranceSatisfactionCounts['ss']['tidak_puas'] }}</td>
            <td>{{ $entropyAssuranceSS }}</td>{{-- Entropy --}}
        </tr>

        <tr>
            <td rowspan="5">Emphaty</td>
            <td>STS</td>
            <td>{{ $categoryEmphatyCounts['sts'] }}</td>
            <td>{{ $categoryEmphatySatisfactionCounts['sts']['puas'] }}</td>
            <td>{{ $categoryEmphatySatisfactionCounts['sts']['tidak_puas'] }}</td>
            <td>{{ $entropyEmphatySTS }}</td>{{-- Entropy --}}
            <td rowspan="5">{{ $informationGainEmphaty > 0 ? number_format($informationGainEmphaty, 9) : 0 }}</td>
        </tr>
        <tr>
            <td>TS</td>
            <td>{{ $categoryEmphatyCounts['ts'] }}</td>
            <td>{{ $categoryEmphatySatisfactionCounts['ts']['puas'] }}</td>
            <td>{{ $categoryEmphatySatisfactionCounts['ts']['tidak_puas'] }}</td>
            <td>{{ $entropyEmphatyTS }}</td>{{-- Entropy --}}
        </tr>
        <tr>
            <td>N</td>
            <td>{{ $categoryEmphatyCounts['n'] }}</td>
            <td>{{ $categoryEmphatySatisfactionCounts['n']['puas'] }}</td>
            <td>{{ $categoryEmphatySatisfactionCounts['n']['tidak_puas'] }}</td>
            <td>{{ $entropyEmphatyN }}</td>{{-- Entropy --}}
        </tr>
        <tr>
            <td>S</td>
            <td>{{ $categoryEmphatyCounts['s'] }}</td>
            <td>{{ $categoryEmphatySatisfactionCounts['s']['puas'] }}</td>
            <td>{{ $categoryEmphatySatisfactionCounts['s']['tidak_puas'] }}</td>
            <td>{{ $entropyEmphatyS }}</td>{{-- Entropy --}}
        </tr>
        <tr>
            <td>SS</td>
            <td>{{ $categoryEmphatyCounts['ss'] }}</td>
            <td>{{ $categoryEmphatySatisfactionCounts['ss']['puas'] }}</td>
            <td>{{ $categoryEmphatySatisfactionCounts['ss']['tidak_puas'] }}</td>
            <td>{{ $entropyEmphatySS }}</td>{{-- Entropy --}}
        </tr>
        <tr>
            <td>Nilai Atribute Tertinggi</td>
            <td colspan="5"><strong>{{ $kategoriTerbaik }}</strong></td>
            <td><strong>{{ $highestInformationGain > 0 ? number_format($highestInformationGain, 9) : 0 }}</strong></td>
        </tr>
    </table>
    <hr>
    <table border="1">
        <tr>
            <th>Booking ID</th>
            <th>Indikator</th>
            <th>Subindikator</th>
            <th>Ratings</th>
            <th>Tangibles</th>
            <th>Reliability</th>
            <th>Responsive</th>
            <th>Assurance</th>
            <th>Emphaty</th>
            <th>Hasil Nilai</th>
            <th>Hasil Akhir</th>
        </tr>
        @php
            $currentBookingId = '';
            function countBookingRows($ratings, $bookingId)
            {
                $count = 0;
                foreach ($ratings as $row) {
                    if ($row->booking_id == $bookingId) {
                        $count++;
                    }
                }
                return $count;
            }
        @endphp
        @foreach ($ratings as $row)
            @if ($currentBookingId != $row->booking_id)
                @php
                    $currentBookingId = $row->booking_id;
                    $spanCount = countBookingRows($ratings, $currentBookingId);
                    $bookingRatings = $data[$currentBookingId];
                    
                    $subindikator016Rating = $bookingRatings['ratingSubindikator016'];
                    $hasilAkhirText = $subindikator016Rating == 1 ? 'Tidak Setuju' : 'Setuju';
                @endphp
                <tr>
                    <td rowspan="{{ $spanCount }}">{{ $currentBookingId }}</td>
                    <td>{{ $row->indikator->name }}</td>
                    <td>{{ $row->subindikator->name }}</td>
                    <td>{{ $row->rating }}</td>
                    <td rowspan="{{ $spanCount }}">
                        @php
                            $hasilTangiblesText = '';
                            if ($bookingRatings['hasilTangibles'] >= 4.1) {
                                $hasilTangiblesText = 'Sangat Puas';
                            } elseif ($bookingRatings['hasilTangibles'] >= 3.1) {
                                $hasilTangiblesText = 'Puas';
                            } elseif ($bookingRatings['hasilTangibles'] >= 2.1) {
                                $hasilTangiblesText = 'Biasa saja/Netral';
                            } elseif ($bookingRatings['hasilTangibles'] <= 2) {
                                $hasilTangiblesText = 'Tidak Puas';
                            } else {
                                $hasilTangiblesText = 'Sangat Tidak Puas';
                            }
                        @endphp
                        {{ $bookingRatings['hasilTangibles'] }}
                        <hr> <strong>{{ $hasilTangiblesText }}</strong>
                    </td>
                    <td rowspan="{{ $spanCount }}">
                        @php
                            $hasilReliabilityText = '';
                            if ($bookingRatings['hasilReliability'] >= 4.1) {
                                $hasilReliabilityText = 'Sangat Puas';
                            } elseif ($bookingRatings['hasilReliability'] >= 3.1) {
                                $hasilReliabilityText = 'Puas';
                            } elseif ($bookingRatings['hasilReliability'] >= 2.1) {
                                $hasilReliabilityText = 'Biasa saja/Netral';
                            } elseif ($bookingRatings['hasilReliability'] <= 2) {
                                $hasilReliabilityText = 'Tidak Puas';
                            } else {
                                $hasilReliabilityText = 'Sangat Tidak Puas';
                            }
                        @endphp
                        {{ $bookingRatings['hasilReliability'] }}
                        <hr> <strong>{{ $hasilReliabilityText }}</strong>
                    </td>
                    <td rowspan="{{ $spanCount }}">
                        @php
                            $hasilResponsiveText = '';
                            if ($bookingRatings['hasilResponsive'] >= 4.1) {
                                $hasilResponsiveText = 'Sangat Puas';
                            } elseif ($bookingRatings['hasilResponsive'] >= 3.1) {
                                $hasilResponsiveText = 'Puas';
                            } elseif ($bookingRatings['hasilResponsive'] >= 2.1) {
                                $hasilResponsiveText = 'Biasa saja/Netral';
                            } elseif ($bookingRatings['hasilResponsive'] <= 2) {
                                $hasilResponsiveText = 'Tidak Puas';
                            } else {
                                $hasilResponsiveText = 'Sangat Tidak Puas';
                            }
                        @endphp
                        {{ $bookingRatings['hasilResponsive'] }}
                        <hr> <strong>{{ $hasilResponsiveText }}</strong>
                    </td>
                    <td rowspan="{{ $spanCount }}">
                        @php
                            $hasilAssuranceText = '';
                            if ($bookingRatings['hasilAssurance'] >= 4.1) {
                                $hasilAssuranceText = 'Sangat Puas';
                            } elseif ($bookingRatings['hasilAssurance'] >= 3.1) {
                                $hasilAssuranceText = 'Puas';
                            } elseif ($bookingRatings['hasilAssurance'] >= 2.1) {
                                $hasilAssuranceText = 'Biasa saja/Netral';
                            } elseif ($bookingRatings['hasilAssurance'] <= 2) {
                                $hasilAssuranceText = 'Tidak Puas';
                            } else {
                                $hasilAssuranceText = 'Sangat Tidak Puas';
                            }
                        @endphp
                        {{ $bookingRatings['hasilAssurance'] }}
                        <hr> <strong>{{ $hasilAssuranceText }}
                    </td>
                    <td rowspan="{{ $spanCount }}">
                        @php
                            $hasilEmphatyText = '';
                            if ($bookingRatings['hasilEmphaty'] >= 4.1) {
                                $hasilEmphatyText = 'Sangat Puas';
                            } elseif ($bookingRatings['hasilEmphaty'] >= 3.1) {
                                $hasilEmphatyText = 'Puas';
                            } elseif ($bookingRatings['hasilEmphaty'] >= 2.1) {
                                $hasilEmphatyText = 'Biasa saja/Netral';
                            } elseif ($bookingRatings['hasilEmphaty'] <= 2) {
                                $hasilEmphatyText = 'Tidak Puas';
                            } else {
                                $hasilEmphatyText = 'Sangat Tidak Puas';
                            }
                        @endphp
                        {{ $bookingRatings['hasilEmphaty'] }}
                        <hr> <strong>{{ $hasilEmphatyText }}</strong>
                    </td>
                    <td rowspan="{{ $spanCount }}">
                        @php
                            $hasilNilai = ($bookingRatings['hasilTangibles'] + $bookingRatings['hasilReliability'] + $bookingRatings['hasilResponsive'] + $bookingRatings['hasilAssurance'] + $bookingRatings['hasilEmphaty']) / 5;
                        @endphp
                        @php
                            $hasilNilaiText = '';
                            if ($hasilNilai >= 4.1) {
                                $hasilNilaiText = 'Sangat Puas';
                            } elseif ($hasilNilai >= 3.1) {
                                $hasilNilaiText = 'Puas';
                            } elseif ($hasilNilai >= 2.1) {
                                $hasilNilaiText = 'Biasa saja/Netral';
                            } elseif ($hasilNilai <= 2) {
                                $hasilNilaiText = 'Tidak Puas';
                            } else {
                                $hasilNilaiText = 'Sangat Tidak Puas';
                            }
                        @endphp
                        {{ $hasilNilai }}
                        <hr> <strong>{{ $hasilNilaiText }}</strong>
                    </td>
                    <td rowspan="{{ $spanCount }}">
                        {{ $subindikator016Rating }}
                        <hr> <strong>{{ $hasilAkhirText }}</strong>
                    </td>
                </tr>
            @else
                <tr>
                    <td>{{ $row->indikator->name }}</td>
                    <td>{{ $row->subindikator->name }}</td>
                    <td>{{ $row->rating }}</td>
                </tr>
            @endif
        @endforeach
    </table>
</body>

</html>
