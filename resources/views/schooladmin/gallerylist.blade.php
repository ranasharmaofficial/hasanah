@extends('admin.layouts.master')
@section('title','Gallery List')
@section('content')
 <div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">@yield('title')</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                            <li class="breadcrumb-item active">@yield('title')</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->
        
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="flash-message">
                            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                                @if (Session::has('alert-' . $msg))
                                    <div class="alert alert-{{ $msg }} alert-dismissible fade show" role="alert">
                                        {{ Session::get('alert-' . $msg) }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        <h4 class="card-title">@yield('title')</h4>
                        <p class="p-0 m-0">Total Events: <b>{{$gallerylists->total();}}</b>, Page No: <b>{{$gallerylists->currentPage();}}</b></p>
                        <div class="table-responsive">
                        <table class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>Sl.No</th>
                                <th>Title</th>
                                <th>Picture</th>
                                <th>Action</th>
                            </tr>
                            </thead>


                            <tbody>
                                @foreach ($gallerylists as $item)
                                <tr>
                                    <td>Tiger Nixon</td>
                                    <td>{{$item->galleryTitle}}</td>
                                    <td><img src="{{asset('uploads/gallery').'/'.$item->galleryImage}}" style="height:100px;" class="img-thumbnail" alt="Prabuddham Academy"></td>
                                    <td>
                                        <form action="{{route('deleteGalleryImage')}}" method="post" style="display: inline-block;">
                                            @csrf
                                            <input type="hidden" value="{{$item->id}}" name="galleryid" required />
                                            <button class="btn btn-danger btn-sm" type="submit"><i class="fa fa-trash"></i> Delete</button>
                                        </form>
                                    </td>
                                </tr> 
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <nav aria-label="...">
                        <ul class="pagination justify-content-end">
                            {{$gallerylists->links();}}
                        </ul>                                
                    </nav>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
     </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->

@endsection
