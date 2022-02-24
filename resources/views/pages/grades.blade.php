@extends('layouts.master')

@section('css')
@toastr_css
@endsection
@section('title')
    {{ trans("main_translate.Grades") }}
@stop

@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">{{ trans("main_translate.Grades") }}</h4>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
            <li class="breadcrumb-item"><a href="{{ url("/") }}" class="default-color">{{ trans("main_translate.home") }}</a></li>
            <li class="breadcrumb-item active">{{ trans("main_translate.Grades") }} </li>
          </ol>
        </div>
      </div>
  </div>
<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row opened -->
				<div class="row row-sm">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                         </div>
                    @endif

                   
					<div class="col-xl-12">
						<div class="card">
                            
                       
                   
                           
					
							<div class="card-body">

                                    <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#gradeduct">
                                        {{ trans("modal_trans.add_grade") }}
                                    </button>
                                    <!-- Modal -->
                                        <div class="modal fade" id="gradeduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Add Grades</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="card-body pt-0">
                                                        <form action="{{ route("grades.store") }}" method="POST" autocomplete="off">
                                                            @csrf
                                                            <div class="group-form">
                                                                <label for="ar">{{ trans("modal_trans.ar_name") }}:</label>
                                                                <input type="text" name="name" id="ar" class="form-control">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="name_en">{{ trans("modal_trans.en_name") }}:</label>
                                                                <input type="text" name="name_en" id="name_en" class="form-control">
                                                            </div>
                                                        <div class="group-form">
                                                            <label for="notes">{{ trans("modal_trans.l_nots") }}:</label>
                                                            <textarea name="notes" id="notes" class="form-control"></textarea>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans("modal_trans.close") }}</button>
                                                            <button type="submit" class="btn btn-primary">{{ trans("modal_trans.add_grade") }}</button>
                                                        </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            </div>
                                        </div>
                                    <!-- Modal -->

								<div class="table-responsive">
									<table class="table text-md-nowrap" id="example1">
										<thead>
											<tr>
												<th class="wd-15p border-bottom-0">#</th>
												<th class="wd-15p border-bottom-0">{{ trans("modal_trans.grade") }}</th>
												<th class="wd-20p border-bottom-0">{{ trans("modal_trans.l_nots") }}</th>
												<th class="wd-25p border-bottom-0">{{ trans("modal_trans.controlles") }}</th>
											</tr>
										</thead>
										<tbody>
                                            <?php
                                            $id = 0;
                                                ?>
											@foreach ($grades as $grade)
												<tr>
													<td class="wd-10p border-bottom-0">{{ ++$id }}</td>
													<td class="wd-10p border-bottom-0">{{ $grade['name'] }}</td>
													<td class="wd-10p border-bottom-0">{{ $grade['notes'] }}</td>
													<td class="wd-30p border-bottom-0">
                                                        
								<!-- Button trigger modal -->
                                <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#e{{ $grade['id'] }}">
                                    {{ trans("modal_trans.edit_grade") }}
                                </button>
                                
                                <!-- Modal -->
                                <div class="modal fade" id="e{{ $grade['id'] }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">{{ trans("modal_trans.edit_grade") }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="card-body pt-0">
                                                <form class="form-horizontal" method="POST" action="{{ route("grades.update" , $grade['id']) }}">
                                                    @method('PUT')
                                                    @csrf
                                                    <label for="er">{{ trans("modal_trans.ar_name") }}:</label>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="name" id="er" value="{{ $grade->getTranslation('name', 'ar') }}">
                                                    </div>
                                                    <label for="en">{{ trans("modal_trans.en_name") }}:</label>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="name_en" id="en" value="{{ $grade->getTranslation('name', 'ar') }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="desc">{{ trans("modal_trans.l_nots") }}</label>
                                                        <input type="text" class="form-control" name="notes" id="desc" value="{{ $grade['notes'] }}">
                                                    </div>
                                                    
													
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans("modal_trans.close") }}</button>
                                                            <button type="submit" class="btn btn-primary">{{ trans("modal_trans.edit_grade") }}</button>
                                                        </div>
                                            
                                                </form>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    </div>
                                </div>
                                    <!-- Button trigger modal -->
									<button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#d{{ $grade['id'] }}">
										{{ trans("modal_trans.delete_grade") }}
									</button>
									
									<!-- Modal -->
									<div class="modal fade" id="d{{ $grade['id'] }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
										<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel">{{ trans("modal_trans.delete_grade") }}</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
											</div>
											<div class="modal-body">
                                                <div class="card-body pt-0">
                                                   {{ trans("modal_trans.check_delete") }} <strong>{{ $grade['name'] }}</strong>
                                                   <form method="POST" action="{{ route("grades.destroy" , $grade['id']) }}">
                                                     @method("DELETE")
                                                     @csrf
                                                     <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans("modal_trans.delete") }}</button>
                                                        <button type="submit"  class="btn btn-primary">{{ trans("modal_trans.delete_grade") }}</button>
                                                    </div>
                                                    
                                                   </form>
                                                </div>
											</div>
                                           
										</div>
										</div>
									</div>
													</td>
												</tr>
											
												
											@endforeach
											
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<!--/div-->

				
				</div>
				<!-- /row -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
@toastr_js
    @toastr_render
@endsection