<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{
    public function showFilters()
    {
        $years = DB::table('suicide')
            ->select('year')
            ->distinct()
            ->pluck('year');

        $countries = DB::table('suicide')
            ->select('country')
            ->distinct()
            ->pluck('country');

        $ageGroups = DB::table('suicide')
            ->select('age')
            ->distinct()
            ->pluck('age'); // Add this line
        
        $sexes = DB::table('suicide')
            ->select('sex')
            ->distinct()
            ->pluck('sex');

        $totalSuicides = DB::table('suicide')
            ->sum('suicide_no');

        // Suicide rates by year
        $suicideRates = DB::table('suicide')
            ->select('year', DB::raw('AVG(suicide_100k_pop) as average_rate'))
            ->groupBy('year')
            ->pluck('average_rate', 'year');

        // GDP vs Suicide Rate
        $gdpVsSuicide = DB::table('suicide')
            ->select('country', DB::raw('AVG(gdp_per_capita) as avg_gdp'), DB::raw('AVG(suicide_100k_pop) as avg_suicide_rate'))
            ->groupBy('country')
            ->get();

        // Suicide rates for countries
        $countrySuicideRates = DB::table('suicide')
            ->select('country', DB::raw('AVG(suicide_100k_pop) as average_rate'))
            ->groupBy('country')
            ->pluck('average_rate', 'country');

        // Pass all variables to the view
        return view('welcome', compact(
            'years', 'countries', 'ageGroups','sexes', 'totalSuicides', 'suicideRates', 'gdpVsSuicide', 'countrySuicideRates'
        ));
    }

    

    public function filterByYear($year)
    {
        $data = DB::table('suicide')
            ->where('year', $year)
            ->select('country', DB::raw('AVG(suicide_100k_pop) as average_rate'))
            ->groupBy('country')
            ->get();

        return response()->json($data);
    }

    

    
}