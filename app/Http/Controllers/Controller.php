<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public function faculty()
    {
        $facultys = DB::table('aboutus')->get();
        // dd($faculty);
        return view('pages.faculty', compact('facultys'));
    }

    public function contactus()
    {
        return view('pages.contactus');
    }

    public function sports()
    {
        $aboutus = DB::table('aboutus')->get();
        $front_sports = DB::table('front_sports')->get();
        return view('pages.sports', compact('aboutus', 'front_sports'));
    }
    public function labrary()
    {
        $aboutus = DB::table('aboutus')->get();
        $front_library = DB::table('front_library')->get();
        return view('pages.labrary', compact('aboutus', 'front_library'));
    }

    public function laboratory()
    {
        $aboutus = DB::table('aboutus')->get();
        $front_laboratory = DB::table('front_laboratory')->get();
        return view('pages.laboratory', compact('aboutus', 'front_laboratory'));
    }

    public function schoolCampus()
    {
        $aboutus = DB::table('aboutus')->get();
        $front_schoolcampus = DB::table('front_schoolcampus')->get();
        return view('pages.school-campus', compact('aboutus', 'front_schoolcampus'));
    }




    public function admissionProcedure()
    {
        $aboutus = DB::table('aboutus')->get();
        $front_admissionprocedure = DB::table('front_admissionprocedure')->get();
        return view('pages.admissionProcedure', compact('aboutus', 'front_admissionprocedure'));
    }

    public function ageCriteria()
    {
        $aboutus = DB::table('aboutus')->get();
        $front_agecriteria = DB::table('front_agecriteria')->get();
        return view('pages.ageCriteria', compact('aboutus', 'front_agecriteria'));
    }
    public function withdrawal()
    {
        $aboutus = DB::table('aboutus')->get();
        $front_withdrawal = DB::table('front_withdrawal')->get();
        return view('pages.withdrawal', compact('aboutus', 'front_withdrawal'));
    }
    public function feesStructure()
    {
        $aboutus = DB::table('aboutus')->get();
        $front_feestructure = DB::table('front_feestructure')->get();
        return view('pages.feesStructure', compact('aboutus', 'front_feestructure'));
    }
    public function scholership()
    {
        $aboutus = DB::table('aboutus')->get();
        $front_scholership = DB::table('front_scholership')->get();
        return view('pages.scholership', compact('aboutus', 'front_scholership'));
    }

    public function subjectOffered()
    {
        $aboutus = DB::table('aboutus')->get();
        $subjectOffered = DB::table('front_subjectoffers')->get();
        return view('pages.subjectOffered', compact('aboutus', 'subjectOffered'));
    }
    public function interHouse()
    {
        $aboutus = DB::table('aboutus')->get();
        $front_interhouse = DB::table('front_interhouse')->get();
        return view('pages.interHouse', compact('aboutus', 'front_interhouse'));
    }
    public function schoolTiming()
    {
        $aboutus = DB::table('aboutus')->get();
        $front_schooltiming = DB::table('front_schooltiming')->get();
        return view('pages.schoolTiming', compact('aboutus', 'front_schooltiming'));
    }
    public function schoolUniform()
    {
        $aboutus = DB::table('aboutus')->get();
        $front_schooltiming = DB::table('front_schooluniform')->get();
        return view('pages.schoolUniform', compact('aboutus', 'front_schooltiming'));
    }
    public function annualReport()
    {
        $aboutus = DB::table('aboutus')->get();
        $front_schooltiming = DB::table('front_annualreport')->get();
        return view('pages.annualReport', compact('aboutus', 'front_schooltiming'));
    }
    public function rulesOfDiscipline()
    {
        $aboutus = DB::table('aboutus')->get();
        $front_schooltiming = DB::table('front_rulesofdiscipline')->get();
        return view('pages.rulesOfDiscipline', compact('aboutus', 'front_schooltiming'));
    }
    public function recommendationsOfTheParent()
    {
        $aboutus = DB::table('aboutus')->get();
        $front_schooltiming = DB::table('front_rulesofdiscipline')->get();
        return view('pages.recommendationsOfTheParent', compact('aboutus', 'front_schooltiming'));
    }
    public function introduction()
    {
        $aboutus = DB::table('aboutus')->get();
        $front_schoolcampus = DB::table('front_introduction')->get();
        return view('pages.introduction', compact('aboutus', 'front_schoolcampus'));
    }
    public function schoolEducation()
    {
        $aboutus = DB::table('aboutus')->get();
        $front_schoolcampus = DB::table('front_schooleducation')->get();
        return view('pages.schoolEducation', compact('aboutus', 'front_schoolcampus'));
    }
    public function founder()
    {
        $aboutus = DB::table('aboutus')->get();
        // $front_schoolcampus = DB::table('front_schooleducation')->get();
        return view('pages.founder', compact('aboutus'));
    }
    public function principleMessage()
    {
        $aboutus = DB::table('aboutus')->get();
        // $front_schoolcampus = DB::table('front_schooleducation')->get();
        return view('pages.principleMessage', compact('aboutus'));
    }
    public function managingCommittee()
    {
        $aboutus = DB::table('aboutus')->get();
        $front_schoolcampus = DB::table('front_managingcometts')->get();
        return view('pages.managingCommittee', compact('aboutus', 'front_schoolcampus'));
    }
    public function relatedInstitute()
    {
        $aboutus = DB::table('aboutus')->get();
        $front_schoolcampus = DB::table('front_relatedinstitutes')->get();
        return view('pages.relatedInstitute', compact('aboutus', 'front_schoolcampus'));
    }
}
