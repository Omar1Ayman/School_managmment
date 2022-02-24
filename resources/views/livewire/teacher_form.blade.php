@if($currentStep != 1)
    <div style="display: none" class="row setup-content" id="step-1">
        @endif
        <div class="col-xs-12">
            <div class="col-md-12">
                <br>

                   <div class="form-row">
                       <div class="col">
                           <label for="title">{{trans('Teacher_trans.Email')}}</label>
                           <input type="email" wire:model="email" class="form-control">
                           @error('email')
                           <div class="alert alert-danger">{{ $message }}</div>
                           @enderror
                       </div>
                       <div class="col">
                           <label for="title">{{trans('Teacher_trans.Password')}}</label>
                           <input type="password" wire:model="password" class="form-control">
                           @error('password')
                           <div class="alert alert-danger">{{ $message }}</div>
                           @enderror
                       </div>
                   </div>
                   <br>


                   <div class="form-row">
                       <div class="col">
                           <label for="title">{{trans('Teacher_trans.Name_ar')}}</label>
                           <input type="text" wire:model="name_ar" class="form-control">
                           @error('name_ar')
                           <div class="alert alert-danger">{{ $message }}</div>
                           @enderror
                       </div>
                       <div class="col">
                           <label for="title">{{trans('Teacher_trans.Name_en')}}</label>
                           <input type="text" wire:model="name_en" class="form-control">
                           @error('name_en')
                           <div class="alert alert-danger">{{ $message }}</div>
                           @enderror
                       </div>
                   </div>
                   <br>

                   <div class="form-row">
                        <div class="form-group col">
                           <label for="inputCity">{{trans('main_translate.Grades')}}</label>
                           <select class="custom-select my-1 mr-sm-2" wire:model="grade_id">
                               <option selected disabled>{{trans('Parent_trans.Choose')}}...</option>
                               @foreach($Grades as $grade)
                                   <option value="{{$grade->id}}">{{$grade->name}}</option>
                               @endforeach
                           </select>
                           @error('grade_id')
                           <div class="alert alert-danger">{{ $message }}</div>
                           @enderror
                       </div>

                       <div class="form-group col">
                           <label for="inputCity">{{trans('Teacher_trans.specialization')}}</label>
                           <select class="custom-select my-1 mr-sm-2" wire:model="spec_id">
                               <option selected disabled>{{trans('Parent_trans.Choose')}}...</option>
                               @foreach($specializations as $specialization)
                                   <option value="{{$specialization->id}}">{{$specialization->name}}</option>
                               @endforeach
                           </select>
                           @error('spec_id')
                           <div class="alert alert-danger">{{ $message }}</div>
                           @enderror
                       </div>
                       <div class="form-group col">
                           <label for="inputState">{{trans('Teacher_trans.Gender')}}</label>
                           <select class="custom-select my-1 mr-sm-2" wire:model="gender_id">
                               <option selected disabled>{{trans('Parent_trans.Choose')}}...</option>
                               @foreach($genders as $gender)
                                   <option value="{{$gender->id}}">{{$gender->name}}</option>
                               @endforeach
                           </select>
                           @error('gender_id')
                           <div class="alert alert-danger">{{ $message }}</div>
                           @enderror
                       </div>
                   </div>
                   <br>

                   <div class="form-row">
                       <div class="col">
                           <label for="title">{{trans('Teacher_trans.Joining_Date')}}</label>
                           <div class='input-group date'>
                               <input class="form-control" type="date"  id="datepicker-action" wire:model="join_date" data-date-format="yyyy-mm-dd"  required>
                           </div>
                           @error('join_date')
                           <div class="alert alert-danger">{{ $message }}</div>
                           @enderror
                       </div>
                   </div>
                   <br>

                   <div class="form-group">
                       <label for="exampleFormControlTextarea1">{{trans('Teacher_trans.Address')}}</label>
                       <textarea class="form-control" wire:model="address"
                                 id="exampleFormControlTextarea1" rows="4"></textarea>
                       @error('address')
                       <div class="alert alert-danger">{{ $message }}</div>
                       @enderror
                   </div>




                @if ($updateMode)
                  <button class="btn btn-success  ml-2 nextBtn  pull-right" wire:click="firstStepSubmit_edit"
                     type="button">{{trans('Parent_trans.Next')}}
                  </button>
                @else
                  <button class="btn btn-success  ml-2 nextBtn  pull-right" wire:click="firstStepSubmit"
                       type="button">{{trans('Parent_trans.Next')}}
                  </button>
                @endif



            </div>
        </div>
    </div>
