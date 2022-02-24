<button class="btn btn-success btn-sm btn-lg pull-right" wire:click="showformadd" type="button">{{ trans('Teacher_trans.Add_Teacher') }}</button><br><br>
<div class="table-responsive">
<table id="datatable" class="table  table-hover table-sm table-bordered p-0"
data-page-length="50"
style="text-align: center">
<thead>
<tr>
 <th>#</th>
 <th>{{trans('Teacher_trans.Name_Teacher')}}</th>
 <th>{{trans('Teacher_trans.Gender')}}</th>
 <th>{{trans('Teacher_trans.Joining_Date')}}</th>
 <th>{{trans('Teacher_trans.specialization')}}</th>
 <th>{{trans('main_translate.Grades')}}</th>
 <th>{{ trans("Teacher_trans.Process") }}</th>
</tr>
</thead>
<tbody>
<?php $i = 0; ?>
@foreach($Teachers as $Teacher)
 <tr>
 <?php $i++; ?>
 <td>{{ $i }}</td>
 <td>{{$Teacher->name}}</td>
 <td>{{$Teacher->gender->name}}</td>
 <td>{{$Teacher->join_date}}</td>
 <td>{{$Teacher->specializations->name}}</td>
 <td>{{$Teacher->grades->name}}</td>
 <td>
    <button wire:click="edit({{ $Teacher->id }})" title="{{ trans('Grades_trans.Edit') }}"
            class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button>
    <button type="button" class="btn btn-danger btn-sm" wire:click="delete({{ $Teacher->id }})" title="{{ trans('Grades_trans.Delete') }}"><i class="fa fa-trash"></i></button>
</td>
 </tr>


@endforeach
</table>
</div>
