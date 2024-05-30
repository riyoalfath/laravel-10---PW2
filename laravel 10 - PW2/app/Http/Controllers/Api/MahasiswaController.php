<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Mahasiswa::orderBy('nim', 'asc')->get();
        return response()->json([
            'status'=> true,
            'message'=> 'Data ditemukan',
            'data'=> $data
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function averageIpk()
    {
        $averageIpk = Mahasiswa::avg('ipk');
        return response()->json([
            'average_ipk' => $averageIpk
        ]);
    }

    public function averageSuliet()
    {
        $averageSuliet = Mahasiswa::avg('suliet');
        return response()->json([
            'average_suliet' => $averageSuliet
        ]);
    }

    public function highestIpk()
    {
        $student = Mahasiswa::orderBy('ipk', 'desc')->first();
        return response()->json($student);
    }

    public function lowestIpk()
    {
        $student = Mahasiswa::orderBy('ipk', 'asc')->first();
        return response()->json($student);
    }

    public function highestSuliet()
    {
        $student = Mahasiswa::orderBy('suliet', 'desc')->first();
        return response()->json($student);
    }

    public function lowestSuliet()
    {
        $student = Mahasiswa::orderBy('suliet', 'asc')->first();
        return response()->json($student);
    }

    public function aggregatePredicates()
    {
        $aggregates = DB::table('mahasiswa')
            ->select(DB::raw('count(*) as count, case 
                when ipk >= 3.5 then "Dengan Pujian" 
                when ipk >= 3.0 then "Sangat Memuaskan"
                else "Memuaskan" end as predicate'))
            ->groupBy('predicate')
            ->get();

        return response()->json($aggregates);
    }

    public function aggregateStudyDuration()
    {
        $aggregates = DB::table('mahasiswa')
            ->select(DB::raw('count(*) as count, `masa studi`'))
            ->groupBy('masa studi')
            ->get();

        return response()->json($aggregates);
    }

    public function studentAges()
    {
        $students = Mahasiswa::all();
        $ages = $students->map(function ($student) {
            $age = Carbon::parse($student->tgllahir)->age;
            return ['nim' => $student->nim, 'name' => $student->nama, 'age' => $age];
        });

        return response()->json($ages);
    }
}