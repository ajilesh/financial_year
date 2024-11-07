<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
//use Illuminate\Support\Facades\Http;

class FinancialYearController extends Controller
{
    public function index()
    {
        return view('financial-year');
    }

    public function getYears($country)
    {
        $years = [];
        $currentYear = Carbon::now()->year;

        for ($i = 10; $i >= 0; $i--) {
            $year = $currentYear - $i;
            $years[] = $country === 'UK' ? "{$year}-" . ($year + 1) : (string)$year;
        }

        return response()->json($years);
    }

    public function getHolidays(Request $request)
    {
        $country = $request->country;
        $year = $request->year;

        $start = $country === 'UK' 
            ? Carbon::create($year, 4, 6) 
            : Carbon::create($year, 1, 1); 

        $end = $country === 'UK' 
            ? $start->copy()->addYear()->subDay()
            : Carbon::create($year, 12, 31);

        $start->isWeekend() && $start->nextWeekday();
        $end->isWeekend() && $end->previousWeekday();

        $holidays = $this->fetchHolidays($start->year, $end->year, $country);

        $filteredHolidays = array_values(array_filter($holidays, function ($holiday) {
            return !Carbon::parse($holiday['date'])->isWeekend();
        }));

        return response()->json([
            'start' => $start->toFormattedDateString(),
            'end' => $end->toFormattedDateString(),
            'holidays' => $filteredHolidays
        ]);
    }

    public function fetchHolidays($startYear, $endYear, $country)
    {
        $holidays = [];
        $apiKey = '3e344ffda9684afe86cd75d391a82bfc';
        $countryCode = $country === 'UK' ? 'GB' : 'IE';

        for ($year = $startYear; $year <= $endYear; $year++) {
            //\Log::info($year);
            $url = "https://holidays.abstractapi.com/v1/?api_key={$apiKey}&country={$countryCode}&year={$year}";
            $response = json_decode(file_get_contents($url), true);
            $holidays = array_merge($holidays, $response);
            //\Log::info($url);
        }

        return $holidays;
    }
}
