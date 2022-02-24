<?php
namespace App\Repository;

use App\Fees;
use App\Grade;
use App\RawRoom;

class FeesRepository implements FeesRepositoryInterface{

    public function index()
    {
        $fees = Fees::all();
        $Grades = Grade::all();
        return view("pages.Fees.index" , compact('fees' , 'Grades'));

    }

    public function create()
    {
        $Grades= Grade::all();
        return view('pages.Fees.add',compact('Grades'));
    }

    public function strore($request)
    {
        try{

            $fees = new Fees();
            $fees->title = ['en'=>$request->title_en , 'ar' => $request->title_ar];
            $fees->amount = $request->amount;
            $fees->Grade_id = $request->Grade_id;
            $fees->Classroom_id = $request->Classroom_id;
            $fees->year = $request->year;
            $fees->description = $request->description;
            $fees->Fee_type = $request->Fee_type;
            $fees->save();

            toastr()->success(trans('messages.success'));
            return redirect()->route('Fees.index');


        }catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $fee = Fees::findOrFail($id);
        $Grades = Grade::all();
        return view("pages.Fees.edit" , compact('fee' , 'Grades'));
    }

    public function update($request)
    {
        try{

            $fees = Fees::findOrFail($request->id);
            $fees->title = ['en'=>$request->title_en , 'ar' => $request->title_ar];
            $fees->amount = $request->amount;
            $fees->Grade_id = $request->Grade_id;
            $fees->Classroom_id = $request->Classroom_id;
            $fees->year = $request->year;
            $fees->description = $request->description;
            $fees->Fee_type = $request->Fee_type;

            $fees->save();

            toastr()->success(trans('messages.success'));
            return redirect()->route('Fees.index');


        }catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    public function destroy($request)
    {
        try {
            Fees::destroy($request->id);
            toastr()->error(trans('messages.Delete'));
            return redirect()->back();
        }

        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    public function show($id)
    {
        $class = RawRoom::findOrFail($id);
        $students = $class->students;
        return view("pages.Fees.show" , compact("students"));
    }




}
