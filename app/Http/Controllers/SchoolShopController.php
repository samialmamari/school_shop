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
    public function buy($id): RedirectResponse
    {
        // cheack if the student is buy on same day
        // dd($id);
        $student = student::where('id', $id)->first();
        // dd($student);
        $date = date('Y-m-d');
        if(!$student){
            // dd($id);
            dd('لا يوجد طالب ');
        }
        $is_student_buy_on_same_day = student_attend::where('id', $student->id)->where('date', $date)->first();
        if($is_student_buy_on_same_day){
            dd('الطالب لدية تسجيل سابق خلال هذا اليوم');
        }
        //insert student on table student_attend
        $student_attend = new student_attend();
        $student_attend->student_id = $id;
        $student_attend->date = $date;
        $student_attend->save();

        dd( '  تم تسجيل الطالب ');
      

    }
}
