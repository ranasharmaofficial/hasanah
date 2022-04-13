@extends('student.layouts.master')
@section('title', 'Download Admit Card')
@section('content')
<div class="page-content">
    <div class="container-fluid"> 
        <div class="row">
            <div class="col-sm-12">
                <div class="row justify-content-center">
                    <div class="card col-sm-6 p-0">
                        <div class="card-header">
                            <h3 class="card-title">Download Admit Card</h3>
                        </div>
                        <div class="card-body">
                            @if ($getadmitcard)
                            <form action="{{route('generateAdmitCardPDF')}}" method="get">
                                <div class="form-group col-sm-12">
                                    <select name="exam_type" id="examType" class="form-select" required>
                                        <option value="Entrance Exam">Entrance Exam</option>
                                    </select>
                                    <span class="text-danger form-text">@error('exam_type')
                                        {{$message}}
                                    @enderror</span>
                                </div>
                                <div class="form-group col-sm-12 mt-2 text-center">
                                    <button class="btn btn-success" ><i class="fa fa-download" aria-hidden="true"></i>&nbsp;Download Now</button>
                                </div>
                            </form>
                            @else
                            <div class="text-center text-danger">Your admit card not generated.</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
