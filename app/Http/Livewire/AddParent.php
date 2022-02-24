<?php

namespace App\Http\Livewire;

use App\My_Parent;
use App\Nationality;
use App\ParentAttachment;
use App\Religon;
use App\Type_Blood;
use App\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;
use phpDocumentor\Reflection\Types\This;

class AddParent extends Component
{
    use WithFileUploads;

     public $currentStep = 1,
            $catchError = '',
            $successMessage = '',
            $updateMode = false,
            $photos,
            $show_table = true,
            $Parent_id,

            // Father_INPUTS
            $email, $password,
            $f_name, $f_name_en,
            $f_id, $f_passport,
            $f_phone, $f_job, $f_job_en,
            $f_id_nationality, $f_id_blood,
            $f_address, $f_id_religon,

            // Mother_INPUTS
            $m_name, $m_name_en,
            $m_id, $m_passport,
            $m_phone, $m_job, $m_job_en,
            $m_id_nationality, $m_id_blood,
            $m_address, $m_id_religon;


    public function updated($propertyName)
        {

            $this->validateOnly($propertyName ,
             [
                'email' => 'required|email',
                'password' => 'required',
                'f_id' => 'required|string|min:14|max:14|regex:/[0-9]{9}/',
                'f_passport' => 'min:10|max:10',
                'f_phone' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
                'm_id' => 'required|string|min:14|max:14|regex:/[0-9]{9}/',
                'm_passport' => 'min:10|max:10',
                'm_phone' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:10'
            ]);

        }

    public function render()
        {
            return view('livewire.add-parent' ,
            [

                'Nationalities' => Nationality::all(),
                'Type_Bloods'   => Type_Blood::all(),
                'Religions'     => Religon::all(),
                'my_parents'    => My_Parent::all()

            ]);

        }

        public function showformadd(){
            $this->show_table = false;
        }


    public function firstStepSubmit()
    {
        $this->validate([
            'email'            => 'required|email|unique:my__parents,email',
            'password'         => 'required',
            'f_name'           => 'required',
            'f_name_en'        => 'required',
            'f_id'             => 'required|unique:my__parents,f_id,' . $this->id,
            'f_passport'       => 'required|unique:my__parents,f_passport,' . $this->id,
            'f_phone'          => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'f_job'            => 'required',
            'f_job_en'         => 'required',
            'f_id_nationality' => 'required',
            'f_id_blood'       => 'required',
            'f_address'        => 'required',
            'f_id_religon'     => 'required',
        ]);
        $this->currentStep = 2;


    }
    public function secondStepSubmit()
    {
        $this->validate([
            'm_name'           => 'required',
            'm_name_en'        => 'required',
            'm_id'             => 'required|unique:my__parents,m_id,' . $this->id,
            'm_passport'       => 'required|unique:my__parents,m_passport,' . $this->id,
            'm_phone'          => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'm_job'            => 'required',
            'm_job_en'         => 'required',
            'm_id_nationality' => 'required',
            'm_id_blood'       => 'required',
            'm_address'        => 'required',
            'm_id_religon'     => 'required',
        ]);
        $this->currentStep = 3;
    }


    public function submitForm()
    {
         try{
            $p = new My_Parent();

            // insert father`s information
            $p->email             = $this->email;
            $p->password          = Hash::make($this->password);
            $p->f_name            = ['en' => $this->f_name_en, 'ar' => $this->f_name];
            $p->f_id              = $this->f_id;
            $p->f_passport        = $this->f_passport;
            $p->f_phone           = $this->f_phone;
            $p->f_job             = ['en' => $this->f_job_en, 'ar' => $this->f_job];
            $p->f_id_nationality  = $this->f_id_nationality;
            $p->f_id_blood        = $this->f_id_blood;
            $p->f_address         = $this->f_address;
            $p->f_id_religon      = $this->f_id_religon;

            // insert mother`s information
            $p->m_name            = ['en' => $this->m_name_en, 'ar' => $this->m_name];
            $p->m_id              = $this->m_id;
            $p->m_passport        = $this->m_passport;
            $p->m_phone           = $this->m_phone;
            $p->m_job             = ['en' => $this->m_job_en, 'ar' => $this->m_job];
            $p->m_id_nationality  = $this->m_id_nationality;
            $p->m_id_blood        = $this->m_id_blood;
            $p->m_address         = $this->m_address;
            $p->m_id_religon      = $this->m_id_religon;

            $p->save();


            if(!empty($this->photos)){
                foreach($this->photos as $photo){
                    $photo->storeAs($this->f_phone , $photo->getClientOriginalName() , $disk= 'parent_attachments');
                    ParentAttachment::create([
                        'file_name' => $photo->getClientOriginalName(),
                        'parent_id' => My_Parent::latest()->first()->id,
                    ]);
                }
            }

            // $this->successMessage = trans('messages.success');
            toastr()->success(trans("messages.success"));

            $this->clearForm();
            $this->currentStep = 1;

        }
        catch (\Exception $e) {
            $this->catchError = $e->getMessage();
        };
    }


    public function edit($id){
        $this->show_table = false;
        $this->updateMode = true;
        $my_parent = My_Parent::where('id' , $id)->first();
        $this->Parent_id = $id;
        // insert father`s information
        $this->email            = $my_parent->email;
        $this->f_name           = $my_parent->getTranslation('f_name', 'ar');
        $this->f_name_en        = $my_parent->getTranslation('f_name', 'en');
        $this->f_id             = $my_parent->f_id;
        $this->f_passport       = $my_parent->f_passport;
        $this->f_phone          = $my_parent->f_phone;
        $this->f_job            = $my_parent->getTranslation('f_job', 'ar');
        $this->f_job_en         = $my_parent->getTranslation('f_job', 'en');
        $this->f_id_nationality = $my_parent->f_id_nationality;
        $this->f_id_blood       = $my_parent->f_id_blood;
        $this->f_address        = $my_parent->f_address;
        $this->f_id_religon     = $my_parent->f_id_religon;

        // insert mother`s information
        $this->m_name           = $my_parent->getTranslation('m_name', 'ar');
        $this->m_name_en        = $my_parent->getTranslation('m_name', 'en');
        $this->m_id             = $my_parent->m_id;
        $this->m_passport       = $my_parent->m_passport;
        $this->m_phone          = $my_parent->m_phone;
        $this->m_job            = $my_parent->getTranslation('m_job', 'ar');
        $this->m_job_en         = $my_parent->getTranslation('m_job', 'en');
        $this->m_id_nationality = $my_parent->m_id_nationality;
        $this->m_id_blood       = $my_parent->m_id_blood;
        $this->m_address        = $my_parent->m_address;
        $this->m_id_religon     = $my_parent->m_id_religon;
    }


    //firstStepSubmit
    public function firstStepSubmit_edit()
    {
        $this->updateMode = true;
        $this->currentStep = 2;

    }

    //secondStepSubmit_edit
    public function secondStepSubmit_edit()
    {
        $this->updateMode = true;
        $this->currentStep = 3;

    }


    public function submitForm_edit(){

       try{
        if ($this->Parent_id){
            $parent = My_Parent::find($this->Parent_id);
            $parent->update([
                // insert father`s information
                             'email'  => $this->email,
                             'f_name'  => ['ar' => $this->f_name, 'en'=>$this->f_name_en],
                             'f_id'  => $this->f_id,
                             'f_passport'  => $this->f_passport,
                             'f_phone'  => $this->f_phone,
                             'f_job'  => ['en'=>$this->f_job_en , 'ar'=> $this->f_job],
                             'f_id_nationality'  => $this->f_id_nationality,
                             'f_id_blood'  => $this->f_id_blood,
                             'f_address'  => $this->f_address,
                             'f_id_religon'  => $this->f_id_religon,

        // insert mother`s information
                             'm_name'  => ['ar' => $this->m_name, 'en'=>$this->m_name_en],
                             'm_id'  => $this->m_id,
                             'm_passport'  => $this->m_passport,
                             'm_phone'  => $this->m_phone,
                             'm_job'  =>  ['en'=>$this->m_job_en , 'ar'=> $this->m_job],
                             'm_id_nationality'  => $this->m_id_nationality,
                             'm_id_blood'  => $this->m_id_blood,
                             'm_address'  => $this->m_address,
                             'm_id_religon'  => $this->m_id_religon,
            ]);

            if(!empty($this->photos)){
                foreach($this->photos as $photo){
                    $photo->storeAs($this->f_phone , $photo->getClientOriginalName() , $disk= 'parent_attachments');
                    ParentAttachment::create([
                        'file_name' => $photo->getClientOriginalName(),
                        'parent_id' => $this->Parent_id,
                    ]);
                }
            }

            $this->successMessage = trans('messages.Update');
            return redirect()->to('/add-parent');
        }

       }catch (\Exception $e) {
        $this->catchError = $e->getMessage();
    }
    }


   //clearForm
   public function clearForm()
   {

    $this->email                = '';
    $this->password             = '';
    $this->f_name               = '';
    $this->f_name_en            = '';
    $this->f_id                 = '';
    $this->f_passport           = '';
    $this->f_phone              = '';
    $this->f_job                = '';
    $this->f_job_en             = '';
    $this->f_id_nationality     = '';
    $this->f_id_blood           = '';
    $this->f_address            = '';
    $this->f_id_religon         = '';

    // insert mother`s information
    $this->m_name               = '';
    $this->m_name_en            = '';
    $this->m_id                 = '';
    $this->m_passport           = '';
    $this->m_phone              = '';
    $this->m_job                = '';
    $this->m_job_en             = '';
    $this->m_id_nationality     = '';
    $this->m_id_blood           = '';
    $this->m_address            = '';
    $this->m_id_religon         = '';

   }

    public function back($step){
        $this->currentStep = $step;
    }


    public function delete($id){
        My_Parent::findOrFail($id)->delete();
        $this->successMessage = trans('messages.Delete');
        return redirect()->to('/add-parent');
    }


}
