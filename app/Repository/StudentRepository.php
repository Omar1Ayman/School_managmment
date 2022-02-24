<?php
namespace App\Repository;

use App\Gender;
use App\Grade;
use App\Image;
use App\My_Parent;
use App\Nationality;
use App\RawRoom;
use App\Repository\StudentRepositoryinterface;
use App\Section;
use App\Student;
use App\Type_Blood;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class StudentRepository implements StudentRepositoryinterface{


    //Get ALl Students
    public function getAllStudent()
    {
        $students = Student::all();
        return view("pages.Students.Studentss" , compact('students') );
    }

    public function Create_Student()
    {
        $data['Genders'] = Gender::all();
        $data['my_classes'] = Grade::all();
        $data['nationals'] = Nationality::all();
        $data['bloods'] = Type_Blood::all();
        $data['parents'] = My_Parent::all();
        return view('pages.Students.create' , $data);
    }

    public function Store_Student($request)
    {

        DB::beginTransaction();

        try{

            //add student
            $students = new Student();
            $students->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $students->email = $request->email;
            $students->password = Hash::make($request->password);
            $students->gender_id = $request->gender_id;
            $students->nationalitie_id = $request->nationalitie_id;
            $students->blood_id = $request->blood_id;
            $students->Date_Birth = $request->Date_Birth;
            $students->Grade_id = $request->Grade_id;
            $students->Classroom_id = $request->Classroom_id;
            $students->section_id = $request->section_id;
            $students->parent_id = $request->parent_id;
            $students->academic_year = $request->academic_year;
            $students->save();



            //add attachments
            if($request->hasfile('photos'))
            {
                foreach($request->file('photos') as $file)
                {
                    $name = $file->getClientOriginalName();
                    $file->storeAs('attachments/students/'.$students->name, $file->getClientOriginalName(),'upload_attachments');
                    $images = new Image();
                    $images->filename = $name;
                    $images->imageable_id= $students->id;
                    $images->imageable_type = 'App\Student';
                    $images->save();

                }
            }

            DB::commit();
            toastr()->success(trans('messages.success'));
            return redirect()->route('Students.create');


        }
        catch (\Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $data['Grades'] = Grade::all();
        $data['parents'] = My_Parent::all();
        $data['Genders'] = Gender::all();
        $data['nationals'] = Nationality::all();
        $data['bloods'] = Type_Blood::all();
        $data['Students'] = Student::findOrFail($id);
        return view('pages.Students.Edit',$data);


    }

    public function Update_Student($request)
    {
        try {
            $Edit_Students = Student::findorfail($request->id);
            $Edit_Students->name = ['ar' => $request->name_ar, 'en' => $request->name_en];
            $Edit_Students->email = $request->email;
            $Edit_Students->password = Hash::make($request->password);
            $Edit_Students->gender_id = $request->gender_id;
            $Edit_Students->nationalitie_id = $request->nationalitie_id;
            $Edit_Students->blood_id = $request->blood_id;
            $Edit_Students->Date_Birth = $request->Date_Birth;
            $Edit_Students->Grade_id = $request->Grade_id;
            $Edit_Students->Classroom_id = $request->Classroom_id;
            $Edit_Students->section_id = $request->section_id;
            $Edit_Students->parent_id = $request->parent_id;
            $Edit_Students->academic_year = $request->academic_year;
            $Edit_Students->save();
            toastr()->success(trans('messages.Update'));
            return redirect()->route('Students.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function Delete_student($id)
    {
        // $student = Student::findOrFail($id);
        // $student->delete();
        // toastr()->error(trans('messages.Delete'));
        // return back();

        Student::destroy($id);
        toastr()->error(trans('messages.Delete'));
        return back();
    }

    public function attachment($id)
    {
        $Student = Student::findOrFail($id);
        return view('pages.Students.Show' , compact("Student"));
    }

    public function Upload_attachment($request)
    {
        foreach($request->file('photos') as $file)
        {
            $name = $file->getClientOriginalName();
            $file->storeAs('attachments/students/'.$request->student_name, $file->getClientOriginalName(),'upload_attachments');

            // insert in image_table
            $images= new image();
            $images->filename=$name;
            $images->imageable_id = $request->student_id;
            $images->imageable_type = 'App\Student';
            $images->save();
        }
        toastr()->success(trans('messages.success'));
        return redirect()->route('Students.show',$request->student_id);
    }

    public function Download_attachment($studentsname , $filename)
    {
        return response()->download(public_path('attachments/students/'.$studentsname.'/'.$filename));
    }

    public function Delete_attachment($request)
    {
      //Delete imags from desk
      Storage::disk('upload_attachments')->delete('attachments/students/'.$request->student_name.'/'.$request->filename);

      //Delete imags from database
      Image::where('id' , $request->id)->where('filename' , $request->filename)->delete();
      toastr()->error(trans('messages.Delete'));
      return redirect()->route('Students.show',$request->student_id);

    }

    public function open_attachment($studentsname , $filename)
    {
         return response()->file(public_path('attachments/students/'.$studentsname.'/'.$filename));
    }




    public function Get_classrooms($id)
    {
        $list_classes = RawRoom::where("grade_id", $id)->pluck("name", "id");
        return $list_classes;
    }

    public function Get_Sections($id)
    {
        $list_sections = Section::where('class_id' , $id)->pluck("name" , "id");
        return $list_sections;
    }





}