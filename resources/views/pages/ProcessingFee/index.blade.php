@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
{{ trans('exclude_fee.Tuition Fee Processors') }}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
{{ trans('exclude_fee.Tuition Fee Processors') }}
@stop
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
                                            <th>{{ trans('exclude_fee.The name') }}</th>
                                            <th>{{ trans('exclude_fee.the amount') }}</th>
                                            <th>{{ trans('exclude_fee.Statement') }}</th>
                                            <th>{{ trans('exclude_fee.Processes') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($ProcessingFees as $ProcessingFee)
                                            <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{$ProcessingFee->student->name}}</td>
                                            <td>{{ number_format($ProcessingFee->amount, 2) }}</td>
                                            <td>{{$ProcessingFee->description}}</td>
                                                <td>
                                                    <a href="{{route('ProcessingFee.edit',$ProcessingFee->id)}}" class="btn btn-info btn-sm" role="button" aria-pressed="true"><i class="fa fa-edit"></i></a>
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#Delete_receipt{{$ProcessingFee->id}}" ><i class="fa fa-trash"></i></button>
                                                </td>
                                            </tr>
                                        @include('pages.ProcessingFee.Delete')
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
    @toastr_js
    @toastr_render
@endsection
