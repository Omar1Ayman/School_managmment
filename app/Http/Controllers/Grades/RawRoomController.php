<?php

namespace App\Http\Controllers;
namespace App\Http\Controllers\Grades;

use App\Grade;
use App\RawRoom;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;

use function Symfony\Component\String\b;

class RawRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classes = RawRoom::all();
        $Grades = Grade::all();
        return view('pages.classes' , compact('classes' , 'Grades'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    //    $this->validate($request , [
    //        'name' => "required",
    //        'name_en' => "required",
    //    ] , [
    //     'name.required'=> trans("validation.required"),
    //     'name_en.required'=> trans("validation.required"),
    //    ]);


       try{
           $lists = $request->List_Classes;
           foreach($lists as $list){
                $raw = new RawRoom();
                $raw->name = ['en'=>$list['name_en'] , 'ar'=>$list['name']];
                $raw->grade_id = $list['grade_id'];
                $raw->save();
           }


           toastr()->success(trans("My_Classes_trans.add_Class_success"));
           return back();

       }catch(\Exception $e){
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
       }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\RawRoom  $rawRoom
     * @return \Illuminate\Http\Response
     */
    public function show(RawRoom $rawRoom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RawRoom  $rawRoom
     * @return \Illuminate\Http\Response
     */
    public function edit(RawRoom $rawRoom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RawRoom  $rawRoom
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RawRoom $rawRoom)
    {
        $request->validate([
            'name' => 'required|unique:grades,name',
            'name_en' => 'required|unique:grades,name',
        ]);
        try{
            $id = $request->id;
            $raw = RawRoom::findOrFail($id);
            $raw->update([
                $raw->name = ['en' => $request->name_en , 'ar' => $request->name ],
                $raw->grade_id = $request->grade_id,
            ]);

            toastr()->success(trans("Grades_trans.edit_Grade_success"));
            return back();

        }catch(\Exception $e){
         return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RawRoom  $rawRoom
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request , RawRoom $rawRoom)
    {


        if($request->delete === 'one'){
            $raw = RawRoom::findOrFail($request->id);
            $raw->delete();
        }elseif($request->delete === 'all'){
           RawRoom::getQuery()->delete();
        }
        toastr()->success(trans("My_Classes_trans.delete_Classes_success"));
        return redirect()->back();

    }

    public function class(Request $request)
    {
        $grade_id = $request->grade_id;
        $search = RawRoom::where("grade_id",$grade_id)->get();
        $Grades = Grade::all();

        return view('pages.classes' , compact('Grades'))->withDetails($search);


    }
}
