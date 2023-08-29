<?php

namespace App\Http\Controllers;
use Inertia\Inertia;
use Illuminate\Http\RedirectResponse;
use App\Models\student_attend;
use App\Models\student;

use Inertia\Response;
use Illuminate\Http\Request;

class SchoolShopController extends Controller
{
    public function index(): Response
    {
        
        return Inertia::render('Welcome');
    }
    //
    public function buy($parcode): RedirectResponse
    {
        // cheack if the student is buy on same day
        // dd($parcode);
        $student = student::where('parcode', $parcode)->first();
        $date = date('Y-m-d');
        if(!$student){
            // dd($parcode);
            dd('لا يوجد طالب ');
        }
        $is_student_buy_on_same_day = student_attend::where('parcode', $student->id)->where('date', $date)->first();
        if($is_student_buy_on_same_day){
            dd('الطالب لدية تسجيل سابق خلال هذا اليوم');
        }
        //insert student on table student_attend
        $student_attend = new student_attend();
        $student_attend->parcode = $parcode;
        $student_attend->date = $date;
        $student_attend->save();

        dd( '  تم تسجيل الطالب ');
      

    }
}
