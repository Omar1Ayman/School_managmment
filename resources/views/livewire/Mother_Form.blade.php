@if($currentStep != 2)
    <div style="display: none" class="row setup-content" id="step-1">
@endif

        <div class="col-xs-12">
            <div class="col-md-12">
                <br>


                <div class="form-row">
                    <div class="col">
                        <label for="title">{{trans('Parent_trans.Name_Mother')}}</label>
                        <input type="text" wire:model="m_name" class="form-control" >
                        @error('m_name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col">
                        <label for="title">{{trans('Parent_trans.Name_Mother_en')}}</label>
                        <input type="text" wire:model="m_name_en" class="form-control" >
                        @error('m_name_en')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-3">
                        <label for="title">{{trans('Parent_trans.Job_Mother')}}</label>
                        <input type="text" wire:model="m_job" class="form-control">
                        @error('m_job')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="title">{{trans('Parent_trans.Job_Mother_en')}}</label>
                        <input type="text" wire:model="m_job_en" class="form-control">
                        @error('m_job_en')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col">
                        <label for="title">{{trans('Parent_trans.National_ID_Mother')}}</label>
                        <input type="text" wire:model="m_id" class="form-control">
                        @error('m_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col">
                        <label for="title">{{trans('Parent_trans.Passport_ID_Mother')}}</label>
                        <input type="text" wire:model="m_passport" class="form-control">
                        @error('m_passport')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col">
                        <label for="title">{{trans('Parent_trans.Phone_Mother')}}</label>
                        <input type="text" wire:model="m_phone" class="form-control">
                        @error('m_phone')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                </div>


                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputCity">{{trans('Parent_trans.Nationality_Mother_id')}}</label>
                        <select class="custom-select my-1 mr-sm-2" wire:model="m_id_nationality">
                            <option selected>{{trans('Parent_trans.Choose')}}...</option>
                            @foreach($Nationalities as $National)
                                <option value="{{$National->id}}">{{$National->name}}</option>
                            @endforeach
                        </select>
                        @error('m_id_nationality')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col">
                        <label for="inputState">{{trans('Parent_trans.Blood_Type_Mother_id')}}</label>
                        <select class="custom-select my-1 mr-sm-2" wire:model="m_id_blood">
                            <option selected>{{trans('Parent_trans.Choose')}}...</option>
                            @foreach($Type_Bloods as $Type_Blood)
                                <option value="{{$Type_Blood->id}}">{{$Type_Blood->name}}</option>
                            @endforeach
                        </select>
                        @error('m_id_blood')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col">
                        <label for="inputZip">{{trans('Parent_trans.Religion_Mother_id')}}</label>
                        <select class="custom-select my-1 mr-sm-2" wire:model="m_id_religon">
                            <option selected>{{trans('Parent_trans.Choose')}}...</option>
                            @foreach($Religions as $Religion)
                                <option value="{{$Religion->id}}">{{$Religion->name}}</option>
                            @endforeach
                        </select>
                        @error('m_id_religon')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>


                <div class="form-group">
                    <label for="exampleFormControlTextarea1">{{trans('Parent_trans.Address_Mother')}}</label>
                    <textarea class="form-control" wire:model="m_address" id="exampleFormControlTextarea1" rows="4"></textarea>
                    @error('m_address')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>



                <button class="btn btn-danger nextBtn  pull-right" type="button" wire:click="back(1)">
                    {{trans('Parent_trans.Back')}}
                </button>

                        @if ($updateMode)
                  <button class="btn btn-success  ml-2 nextBtn  pull-right" wire:click="secondStepSubmit_edit"
                     type="button">{{trans('Parent_trans.Next')}}
                  </button>
                @else
                  <button class="btn btn-success  ml-2 nextBtn  pull-right" wire:click="secondStepSubmit"
                       type="button">{{trans('Parent_trans.Next')}}
                  </button>
                @endif


            </div>
        </div>
    </div>
