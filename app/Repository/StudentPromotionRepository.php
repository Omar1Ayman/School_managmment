<?php
namespace App\Repository;

use App\Grade;
use App\Promotion;
use App\Student;
use Illuminate\Support\Facades\DB;

class StudentPromotionRepository implements StudentPromotionRepositoryInterface{

    public function index()
    {
        $Grades = Grade::all();
        return view('pages.Students.promotion.index' , compact('Grades'));
    }

    public function store($request)
    {
        DB::beginTransaction();

        try {

            $students = student::where('Grade_id',$request->Grade_id)->where('Classroom_id',$request->Classroom_id)->where('section_id',$request->section_id)->where('academic_year',$request->academic_year)->get();

            // return $request;

            if($students->count() < 1){
                return redirect()->back()->with('error_promotions', (trans('main_translate.checkdata')));
            }

            // update in table student
            foreach ($students as $student){

                $ids = explode(',',$student->id);
                student::whereIn('id', $ids)
                    ->update([
                        'Grade_id'=>$request->Grade_id_new,
                        'Classroom_id'=>$request->Classroom_id_new,
                        'section_id'=>$request->section_id_new,
                        'academic_year'=>$request->academic_year_new,
                    ]);

                // insert in to promotions
                Promotion::updateOrCreate([
                    'student_id'=>$student->id,
                    'from_grade'=>$request->Grade_id,
                    'from_class'=>$request->Classroom_id,
                    'from_section'=>$request->section_id,
                    'to_grade'=>$request->Grade_id_new,
                    'to_class'=>$request->Classroom_id_new,
                    'to_section'=>$request->section_id_new,
                    'academic_year'=>$request->academic_year,
                    'academic_year_new'=>$request->academic_year_new,
                ]);

            }
            DB::commit();
            toastr()->success(trans('messages.success'));
            return redirect()->back();

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }




    }

    public function create(){
        $promotions = Promotion::all();
        return view('pages.Students.promotion.management' , compact('promotions'));
    }

    public function destroy($request)
    {
            DB::beginTransaction();

        try{
            if($request->page_id == "1"){
                $promotions = Promotion::all();
                foreach($promotions as $promotion){
                    $ids = explode(',',$promotion->student_id);
                    Student::whereIn('id', $ids)
                    ->update([
                        'Grade_id'=>$promotion->from_grade,
                        'Classroom_id'=>$promotion->from_class,
                        'section_id'=> $promotion->from_section,
                        'academic_year'=>$promotion->academic_year,
                    ]);

                    //حذف جدول الترقيات
                    Promotion::truncate();
                }
                DB::commit();
                toastr()->error(trans('messages.Delete'));
                return redirect()->back();
            }else{
                $Promotion = Promotion::findorfail($request->id);
                student::where('id', $Promotion->student_id)
                         ->update([
                    'Grade_id'=>$Promotion->from_grade,
                    'Classroom_id'=>$Promotion->from_class,
                    'section_id'=>$Promotion->from_section,
                    'academic_year'=>$Promotion->academic_year,
               ]);
               Promotion::destroy($request->id);
                DB::commit();
                toastr()->error(trans('messages.Delete'));
                return redirect()->back();
            }
        }catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
