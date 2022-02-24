<?php

namespace App\Http\Livewire;

use App\Gender;
use App\Grade;
use App\Specialization;
use App\Teacher;
use Exception;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddTeacher extends Component
{
    use WithFileUploads;

    public $currentStep = 1,
            $catchError = '',
            $successMessage = '',
            $updateMode = false,
            $photos,
            $show_table = true,
            $teacher_id,

            //Teacher Inputs
            $email,
            $password,
            $name_ar,
            $name_en,
            $address,
            $join_date,
            $spec_id,
            $gender_id,
            $grade_id;


        public function updated($propertyName)
        {

            $this->validateOnly($propertyName ,
             [
                'email' => 'required|email',
                'password' => 'required|min:8',
                'address' => 'required',
                'gender_id' => 'required',
                'spec_id' => 'required',
            ]);

        }
    public function render()
    {
        return view('livewire.add-teacher' ,
        [
            'specializations' => Specialization::all(),
            'genders'         => Gender::all(),
            'Teachers'        => Teacher::all(),
            'Grades'          => Grade::all()
        ]);
    }

    public function firstStepSubmit()
    {
        $this->validate([

            'email'             => 'required|email|unique:teachers,email',
            'password'          => 'required',
            'name_en'           => 'required',
            'name_ar'           => 'required',
            'address'           => 'required',
            'join_date'         => 'date',
            'spec_id'           => 'required',
            'gender_id'         => 'required',
            'grade_id'         => 'required'
        ]);
        return $this->currentStep = 2;
    }

    public function submitForm()
    {
        try{
            $t = new Teacher();
            $t->email             = $this->email;
            $t->password          = Hash::make($this->password);
            $t->name              = ['en' => $this->name_en, 'ar' => $this->name_ar];
            $t->address           = $this->address;
            $t->join_date         = $this->join_date;
            $t->spec_id           = $this->spec_id;
            $t->gender_id         = $this->gender_id;
            $t->grade_id         = $this->grade_id;
            $t->save();

            toastr()->success(trans("messages.success"));

            $this->clearForm();
            $this->show_table = true;

        }
        catch (\Exception $e) {
            $this->catchError = $e->getMessage();
        };
    }

    public function edit($id)
    {
        $this->show_table = false;
        $this->updateMode = true;
        $teacher = Teacher::where('id' , $id)->first();
        $this->teacher_id = $id;
        $this->email      = $teacher->email;
        $this->password   = $teacher->password;
        $this->name_en    = $teacher->getTranslation('name', 'en');
        $this->name_ar    = $teacher->getTranslation('name', 'ar');
        $this->address    = $teacher->address;
        $this->join_date  = $teacher->join_date;
        $this->spec_id    = $teacher->spec_id;
        $this->gender_id  = $teacher->gender_id;
        $this->grade_id   = $teacher->grade_id;


    }

    public function firstStepSubmit_edit()
    {
        $this->updateMode = true;
        $this->currentStep = 1;
    }

    public function submitForm_edit()
    {
        try{
            if($this->teacher_id){
                $teacher = Teacher::find($this->teacher_id);
                $teacher->update([
                             'email'  => $this->email,
                             'password'  => Hash::make($this->password),
                             'name'  => ['ar' => $this->name_ar, 'en'=>$this->name_en],
                             'address'  => $this->address,
                             'join_date'  => $this->join_date,
                             'spec_id'  => $this->spec_id,
                             'gender_id'  => $this->gender_id,
                             'grade_id'  => $this->grade_id,


                ]);

                                toastr()->success(trans("messages.success"));

                                $this->clearForm();
                                $this->show_table = true;

            }
        }
        catch(\Exception $e){
            $this->catchError = $e->getMessage();
        }
    }

    //Delete func
    public function delete($id)
    {
        Teacher::findOrFail($id)->delete();
        $this->successMessage = trans('messages.Delete');
    }

    //Back Step
    public function back($step)
    {
        $this->currentStep = $step;
    }

    //Show Add Form
    public function showformadd()
    {
        return $this->show_table = false;
    }

     //clearForm
   public function clearForm()
   {

    $this->email       = '';
    $this->password    = '';
    $this->name_en     = '';
    $this->name_ar     = '';
    $this->address     = '';
    $this->join_date   = '';
    $this->spec_id     = '';
    $this->gender_id   = '';
    $this->grade_id    = '';





   }
}
