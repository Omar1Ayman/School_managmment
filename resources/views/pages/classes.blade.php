@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('My_Classes_trans.title_page') }}
@stop
onchange="this.form.submit()"
@endsection
@section('page-header')
<!-- breadcrumb -->
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">{{ trans("My_Classes_trans.title_page") }}</h4>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
            <li class="breadcrumb-item"><a href="{{ url("/") }}" class="default-color">{{ trans("main_translate.home") }}</a></li>
            <li class="breadcrumb-item active">{{ trans("My_Classes_trans.title_page") }} </li>
          </ol>
        </div>
      </div>
  </div>
<!-- breadcrumb -->
@section('PageTitle')
{{ trans('My_Classes_trans.title_page') }}
@stop

@endsection
@section('content')
<!-- row -->

<div class="row">

<div class="col-xl-12 mb-30">
    <div class="card card-statistics h-100">
        <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="d-flex flex-row bd-highlight mb-3">

                <div class="ml-2">
                    <button type="button" class="btn btn-outline-secondary" data-toggle="modal" data-target="#add">
                        {{ trans('My_Classes_trans.add_class') }}
                    </button>
                </div>
                <div class="ml-2">
                    <button type="button" class="btn btn-outline-secondary" data-toggle="modal" data-target="#deleteallclasses">
                        {{ trans('My_Classes_trans.delete_all_class') }}
                    </button>
                </div>


                <div class="ml-2">
                    <button type="button" id="btn_check_class" class="btn btn-outline-secondary" data-toggle="modal" data-target="#deleteclass">
                        delete checked classes
                    </button>
                </div>


            </div>
            <form class="form" action="{{ route("class") }}" method="POST">
                @csrf
                 <div class="form-row">
                       <div class="form-group">
                         <select onchange="this.form.submit()" name="grade_id" id="inputState" class="form-control">
                             <option value="" selected >choose class</option>
                             @foreach ($Grades as $Grade)
                               <option value="{{ $Grade->id }}"  >{{ $Grade->name }}</option>
                            @endforeach
                         </select>
                       </div>
                 </div>
               </form>
            <br><br>

            <div class="table-responsive">
                <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                    style="text-align: center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th><input type="checkbox" class="allcheck" CheckAll('checked', this)></th>
                            <th>{{ trans("My_Classes_trans.Name_class") }}</th>
                            <th>{{ trans('My_Classes_trans.Name_Grade') }}</th>
                            <th>{{ trans('My_Classes_trans.Processes') }}</th>
                        </tr>
                    </thead>
                    <tbody>

                        @if (isset($details))
                            <?php $List_Classes = $details ?>
                        @else
                        <?php $List_Classes = $classes ?>
                        @endif
                        <?php $i = 0; ?>
                        @foreach ($List_Classes as $My_Class)
                            <tr>
                                <?php $i++; ?>
                                <td>{{ $i }}</td>
                                <td><input type="checkbox" class="checked" value="{{ $My_Class->id }}"></td>
                                <td>{{ $My_Class->name }}</td>
                                <td>{{ $My_Class->grades->name }}</td>
                                <td>
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                        data-target="#edit{{ $My_Class->id }}"
                                        title="{{ trans('Grades_trans.Edit') }}"><i class="fa fa-edit"></i></button>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                        data-target="#delete{{ $My_Class->id }}"
                                        title="{{ trans('Grades_trans.Delete') }}"><i
                                            class="fa fa-trash"></i></button>
                                </td>
                            </tr>

                            <!-- edit_modal_Grade -->
                            <div class="modal fade" id="edit{{ $My_Class->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                {{ trans('Grades_trans.edit_Grade') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- add_form -->
                                            <form action="{{ route('classes.update', $My_Class->id) }}" method="POST">
                                                {{ method_field('PUT') }}
                                                @csrf
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="ar"
                                                            class="mr-sm-2">{{ trans('My_Classes_trans.Name_class') }}
                                                            :</label>
                                                        <input id="ar" type="text" name="name"
                                                            class="form-control"
                                                            value="{{ $My_Class->getTranslation('name', 'ar') }}"
                                                            required>
                                                        <input id="id" type="hidden" name="id" class="form-control"
                                                            value="{{ $My_Class->id }}">
                                                    </div>
                                                    <div class="col">
                                                        <label for="en"
                                                            class="mr-sm-2">{{ trans('My_Classes_trans.Name_class_en') }}
                                                            :</label>
                                                        <input id="en" type="text" class="form-control"
                                                        value="{{ $My_Class->getTranslation('name', 'en') }}"
                                                            name="name_en" required>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="grade" class="mr-sm-2">{{ trans('My_Classes_trans.Name_Grade') }}:</label>

                                                        <select  id="grade" class="form-control" name="grade_id">
                                                             @foreach ($Grades as $Grade)
                                                                <option <?= $My_Class->id == $Grade->id ? 'selected' : ''?> value="{{ $Grade->id }}">{{ $Grade->name }}</option>
                                                            @endforeach
                                                        </select>
                                                </div>
                                                <br><br>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">{{ trans('Grades_trans.Close') }}</button>
                                                    <button type="submit"
                                                        class="btn btn-success">{{ trans('Grades_trans.submit') }}</button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- delete_modal_Grade -->
                            <div class="modal fade" id="delete{{ $My_Class->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                {{ trans('Grades_trans.delete_Grade') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('classes.destroy', $My_Class->id) }}" method="POST">
                                                @method("DELETE")
                                                @csrf
                                                {{ trans('My_Classes_trans.Warning_Grade') }}
                                                <input type="hidden" name="id" value="{{$My_Class->id }}">
                                                <input type="" name="delete" value="one">
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">{{ trans('My_Classes_trans.Close') }}</button>
                                                    <button type="submit"
                                                        class="btn btn-danger">{{ trans("My_Classes_trans.submit") }}</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                </table>

            </div>
        </div>
    </div>
</div>


<!-- add_modal_class -->
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="add"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="add">
                    {{ trans('My_Classes_trans.add_class') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class=" row mb-30" action="{{ route('classes.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="repeater">
                            <div data-repeater-list="List_Classes">
                                <div data-repeater-item>
                                    <div class="row">
                                        <div class="col">
                                            <label for="ar" class="mr-sm-2">{{ trans('My_Classes_trans.Name_class') }}:</label>
                                            <input class="form-control" id="ar" type="text" name="name" required />
                                        </div>
                                        <div class="col">
                                            <label for="en" class="mr-sm-2">{{ trans('My_Classes_trans.Name_class_en') }}:</label>
                                            <input class="form-control" id="en" type="text" name="name_en" required />
                                        </div>
                                        <div class="col">
                                            <label for="Name_en" class="mr-sm-2">{{ trans('My_Classes_trans.Name_Grade') }}:</label>
                                            <div class="box">
                                                <select class="fancyselect" name="grade_id">
                                                     @foreach ($Grades as $Grade)
                                                        <option value="{{ $Grade->id }}">{{ $Grade->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                        </div>

                                        <div class="col">
                                            <label for="Name_en"
                                                class="mr-sm-2">{{ trans('My_Classes_trans.Processes') }}
                                                :</label>
                                            <input class="btn btn-danger btn-block" data-repeater-delete
                                                type="button" value="{{ trans('My_Classes_trans.delete_row') }}" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-20">
                                <div class="col-12">
                                    <input class="button" data-repeater-create type="button" value="{{ trans('My_Classes_trans.add_row') }}"/>
                                </div>

                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-dismiss="modal">{{ trans('Grades_trans.Close') }}</button>
                                <button type="submit"
                                    class="btn btn-success">{{ trans('Grades_trans.submit') }}</button>
                            </div>


                        </div>
                    </div>
                </form>
            </div>


        </div>

    </div>

</div>
<!--Delete All Classes-->
<div class="modal fade" id="deleteallclasses" tabindex="-1" role="dialog"
    aria-labelledby="deleteallclasses" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                    id="deleteallclasses">
                    {{ trans('Grades_trans.delete_Grade') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal"
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('classes.destroy', 'deleteall') }}" method="POST">
                    @method("DELETE")
                    @csrf
                    {{ trans('My_Classes_trans.Warning_Grades') }}
                    <input type="hidden" name="delete" value="all">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{ trans('My_Classes_trans.Close') }}</button>
                        <button type="submit"
                            class="btn btn-danger">{{ trans("My_Classes_trans.submit") }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--Delete All Classes-->


<!--Delete All Classes-->
<div class="modal fade" id="deleteclass" tabindex="-1" role="dialog"
    aria-labelledby="deleteclass" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                    id="deleteclass">
                    checked class
                </h5>
                <button type="button" class="close" data-dismiss="modal"
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('classes.destroy', 'deleteall') }}" method="POST">
                    @method("DELETE")
                    @csrf
                    {{ trans('My_Classes_trans.Warning_Grades') }}
                    <input class="text" type="" id="delete_all_id" name="delete_all_id" value=''>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{ trans('My_Classes_trans.Close') }}</button>
                        <button type="submit"
                            class="btn btn-danger">{{ trans("My_Classes_trans.submit") }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--Delete All Classes-->


</div>
</div>

</div>

<!-- row closed -->
@endsection
@section('js')
@toastr_js
@toastr_render

<script type="text/javascript">
 $(function(){

        $('#btn_check_class').click(function(){
            var selected = new Array();
            $('#datatable input[type=checkbox]:checked').each(function(){
                selected.push(this.val);


            })
            if(selected.length > 0){
                $('#btn_check_class').modal('show');
                $('#delete_all_id').val('kkk');
            }
        });

    })


</script>


@endsection

