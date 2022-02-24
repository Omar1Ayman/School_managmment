<?php

namespace App\Http\Controllers\Section;

use App\Grade;
use App\Http\Controllers\Controller;
use App\RawRoom;
use App\Section;
use Exception;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $Grades = Grade::with(['Sections'])->get();

        $list_Grades = Grade::all();

        return view('pages.Section.sections' , compact('Grades','list_Grades'));
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
        
        try{
            $request->validate([
                'name' => 'required'
            ]);
            $section = new Section();
            $section->name = ['en' => $request->name_en , 'ar'=>$request->name];
            $section->grade_id = $request->Grade_id;
            $section->class_id = $request->Class_id;
            $section->state = 1;
            $section->save();
            toastr()->success(trans("Sections_trans.add_Section_success"));
            return back();
        }catch(\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function show(Section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function edit(Section $section)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Section $section)
    {
        try {
           $request->validate([
               'name' => 'required'
           ]);
            $Sections = Section::findOrFail($request->id);
      
            $Sections->name = ['ar' => $request->name, 'en' => $request->name_en];
            $Sections->grade_id = $request->Grade_id;
            $Sections->class_id = $request->Class_id;
      
            if(isset($request->state)) {
              $Sections->state = 1;
            } else {
              $Sections->state = 2;
            }
      
            $Sections->save();
            toastr()->success(trans('messages.Update'));
      
            return redirect()->route('Sections.index');
        }
        catch
        (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request , Section $section)
    {
        Section::findOrFail($request->id)->delete();
        toastr()->error(trans('messages.Delete'));
        return redirect()->route('Sections.index');
    }

    public function getclasses($id){

        
        $list_classes = RawRoom::where("grade_id", $id)->pluck("name", "id");

        return $list_classes;
    }
}
