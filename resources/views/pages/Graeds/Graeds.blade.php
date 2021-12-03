@extends('layouts.master')
@section('css')
@toastr_css

@section('title')
{{ trans('min_trans.Grades') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">

        <div class="col-sm-6">
            <h4 class="mb-0">{{ trans('min_trans.Grades') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">{{ trans('min_trans.Dashboard') }}</a></li>
                <li class="breadcrumb-item active">{{ trans('min_trans.Grades') }}</li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
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
            <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                {{ trans('Graeds_trans.add_Grade') }}
            </button>
            <br><br>
          <div class="table-responsive">
          <table id="datatable" class="table table-striped table-bordered p-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{ trans('Graeds_trans.Name') }}</th>
                    <th>{{ trans('Graeds_trans.Notes') }}</th>
                    <th>{{ trans('Graeds_trans.Processes') }}</th>

                </tr>
            </thead>
            <tbody>
                <?php $i=0;?>
                @foreach ($Graeds as $Graed )
                <tr>
                    <?php $i++; ?>
                    <td>{{ $i }}</td>
                    <td>{{ $Graed->Name }}</td>
                    <td>{{ $Graed->Notes }}</td>
                    <td>
                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"data-target="#edit{{ $Graed->id }}"title="{{ trans('Grades_trans.Edit') }}"><i class="fa fa-edit"></i></button>
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete{{ $Graed->id }}"title="{{ trans('Grades_trans.Delete') }}"><i class="fa fa-trash"></i></button>
                    </td>
                </tr>

                <div class="modal fade" id="edit{{ $Graed->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                    id="exampleModalLabel">
                                    {{ trans('Graeds_trans.edit_Grade') }}
                                </h5>
                                <button type="button" class="close" data-dismiss="modal"
                                    aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- add_form -->
                                <form action="{{ route('Graeds.update','test' ) }}" method="post">
                                      {{ method_field('patch') }}
                                      @csrf


                                    <div class="row">
                                        <div class="col">
                                            <label for="Name"
                                                class="mr-sm-2">{{ trans('Graeds_trans.stage_name_ar') }}
                                                :</label>
                                            <input id="Name" type="text" name="Name"
                                                class="form-control"
                                                value="{{ $Graed->getTranslation('Name', 'ar') }}"
                                                required>
                                            <input id="id" type="hidden" name="id" class="form-control"
                                                value="{{ $Graed->id }}">
                                        </div>
                                        <div class="col">
                                            <label for="Name_en"
                                                class="mr-sm-2">{{ trans('Graeds_trans.stage_name_en') }}
                                                :</label>
                                            <input type="text" class="form-control"
                                                value="{{ $Graed->getTranslation('Name', 'en') }}"
                                                name="Name_en" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label
                                            for="exampleFormControlTextarea1">{{ trans('Graeds_trans.Notes') }}
                                            :</label>
                                        <textarea class="form-control" name="Notes"
                                            id="exampleFormControlTextarea1"
                                            rows="3">{{ $Graed->Notes }}</textarea>
                                    </div>
                                    <br><br>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">{{ trans('Graeds_trans.Close') }}</button>
                                        <button type="submit"
                                            class="btn btn-success">{{ trans('Graeds_trans.submit') }}</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>






                <div class="modal fade" id="delete{{ $Graed->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                    id="exampleModalLabel">
                                    {{ trans('Graeds_trans.delete_Grade') }}
                                </h5>
                                <button type="button" class="close" data-dismiss="modal"
                                    aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('Graeds.destroy', 'test') }}" method="post">
                                    {{ method_field('Delete') }}
                                    @csrf

                                    {{ trans('Graeds_trans.Warning_Grade') }}
                                    <!--هاد الكود يظهر ويقول هل انت متاكد من عملية حذف المرحلة الابتدائية-->
                                    <input id="Name" type="text" name="Name"
                                    class="form-control"
                                    value="{{ $Graed->getTranslation('Name', 'ar') }}"
                                    required>
                                    <!--هاد الكود يظهر ويقول هل انت متاكد من عملية حذف المرحلة الابتدائية-->

                                    <input id="id" type="hidden" name="id" class="form-control"
                                        value="{{ $Graed->id }}">
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">{{ trans('Graeds_trans.Close') }}</button>
                                        <button type="submit"
                                            class="btn btn-danger">{{ trans('Graeds_trans.submit') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                @endforeach


            </tbody>

         </table>
        </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    {{ trans('Graeds_trans.add_Grade') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- add_form -->
                <form action="{{ route('Graeds.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <label for="Name" class="mr-sm-2">{{ trans('Graeds_trans.stage_name_ar') }}
                                :</label>
                            <input id="Name" type="text" name="Name" class="form-control">
                        </div>
                        <div class="col">
                            <label for="Name_en" class="mr-sm-2">{{ trans('Graeds_trans.stage_name_en') }}
                                :</label>
                            <input type="text" class="form-control" name="Name_en">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">{{ trans('Graeds_trans.Notes') }}
                            :</label>
                        <textarea class="form-control" name="Notes" id="exampleFormControlTextarea1"
                            rows="3"></textarea>
                    </div>
                    <br><br>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                    data-dismiss="modal">{{ trans('Graeds_trans.Close') }}</button>
                <button type="submit" class="btn btn-success">{{ trans('Graeds_trans.submit') }}</button>
            </div>
            </form>

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
