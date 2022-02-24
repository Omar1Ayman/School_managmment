@extends('layouts.master')
@section('css')

@section('title')
الفواتير الدراسية
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> الفواتير الدراسية</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="{{ route("Fees.index") }}" class="default-color">Home</a></li>
                <li class="breadcrumb-item active">الفواتير الدراسية</li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="col-xl-12 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                       data-page-length="50"
                                       style="text-align: center">
                                    <thead>
                                    <tr class="alert-success">
                                        <th>#</th>
                                        <th>الاسم</th>
                                        <th>نوع الرسوم</th>
                                        <th>المبلغ</th>
                                        <th>المرحلة الدراسية</th>
                                        <th>الصف الدراسي</th>
                                        <th>البيان</th>
                                        <th>العمليات</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($Fee_invoices as $Fee_invoice)
                                        <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{$Fee_invoice->student->name}}</td>
                                        <td>{{$Fee_invoice->fees->title}}</td>
                                        <td>{{ number_format($Fee_invoice->amount, 2) }}</td>
                                        <td>{{$Fee_invoice->grade->name}}</td>
                                        <td>{{$Fee_invoice->classroom->name}}</td>
                                        <td>{{$Fee_invoice->description}}</td>
                                            <td>
                                                <a href="{{route('Fees_Invoices.edit',$Fee_invoice->id)}}" class="btn btn-info btn-sm" role="button" aria-pressed="true"><i class="fa fa-edit"></i></a>
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#Delete_Fee_invoice{{$Fee_invoice->id}}" ><i class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>
                                    @include('pages.Fees_Invoices.Delete')
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection
