@if($currentStep != 1)
    <div style="display: none" class="row setup-content" id="step-1">
        @endif
        <div class="col-xs-12">
            <div class="col-md-12">
                <br>
                <div class="form-row">
                    <div class="col">
                        <label for="title">{{trans('Parent_trans.Email')}}</label>
                        <input type="email" wire:model="email"  class="form-control">
                        @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col">
                        <label for="title">{{trans('Parent_trans.Password')}}</label>
                        <input type="password" wire:model="password" class="form-control" >
                        @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="col">
                        <label for="title">{{trans('Parent_trans.Name_Father')}}</label>
                        <input type="text" wire:model="f_name" class="form-control" >
                        @error('f_name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col">
                        <label for="title">{{trans('Parent_trans.Name_Father_en')}}</label>
                        <input type="text" wire:model="f_name_en" class="form-control" >
                        @error('f_name_en')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-3">
                        <label for="title">{{trans('Parent_trans.Job_Father')}}</label>
                        <input type="text" wire:model="f_job" class="form-control">
                        @error('f_job')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="title">{{trans('Parent_trans.Job_Father_en')}}</label>
                        <input type="text" wire:model="f_job_en" class="form-control">
                        @error('f_job_en')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col">
                        <label for="title">{{trans('Parent_trans.National_ID_Father')}}</label>
                        <input type="text" wire:model="f_id" class="form-control">
                        @error('f_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col">
                        <label for="title">{{trans('Parent_trans.Passport_ID_Father')}}</label>
                        <input type="text" wire:model="f_passport" class="form-control">
                        @error('f_passport')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col">
                        <label for="title">{{trans('Parent_trans.Phone_Father')}}</label>
                        <input type="text" wire:model="f_phone" class="form-control">
                        @error('f_phone')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                </div>


                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputCity">{{trans('Parent_trans.Nationality_Father_id')}}</label>
                        <select class="custom-select my-1 mr-sm-2" wire:model="f_id_nationality">
                            <option selected>{{trans('Parent_trans.Choose')}}...</option>
                            @foreach($Nationalities as $National)
                                <option value="{{$National->id}}">{{$National->name}}</option>
                            @endforeach
                        </select>
                        @error('f_id_nationality')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col">
                        <label for="inputState">{{trans('Parent_trans.Blood_Type_Father_id')}}</label>
                        <select class="custom-select my-1 mr-sm-2" wire:model="f_id_blood">
                            <option selected>{{trans('Parent_trans.Choose')}}...</option>
                            @foreach($Type_Bloods as $Type_Blood)
                                <option value="{{$Type_Blood->id}}">{{$Type_Blood->name}}</option>
                            @endforeach
                        </select>
                        @error('f_id_blood')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col">
                        <label for="inputZip">{{trans('Parent_trans.Religion_Father_id')}}</label>
                        <select class="custom-select my-1 mr-sm-2" wire:model="f_id_religon">
                            <option selected>{{trans('Parent_trans.Choose')}}...</option>
                            @foreach($Religions as $Religion)
                                <option value="{{$Religion->id}}">{{$Religion->name}}</option>
                            @endforeach
                        </select>
                        @error('f_id_religon')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>


                <div class="form-group">
                    <label for="exampleFormControlTextarea1">{{trans('Parent_trans.Address_Father')}}</label>
                    <textarea class="form-control" wire:model="f_address" id="exampleFormControlTextarea1" rows="4"></textarea>
                    @error('f_address')
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
