@extends('schoolemployee.layouts.master')
@section('title','Add Gallery')
@section('content')
    <style>
        .gallery img{
            width: 300px;
            height: auto;
            display: inline;
            margin: 5px 5px 5px 0px;
        }
    </style>
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">@yield('title')</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{url('schoolemployee/home')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">@yield('title')</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->
        
        <div class="row justify-content-center">
            <div class="col-sm-12">
                <div class="card rounded" style="background-color: #F5EEF8;">
                    <div class="card-body">
                        <div class="container">
                            <div class="row mb-3">
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
                                <form action="{{route('schoolemployee.uploadGalleryImage')}}" method="post" class="row" enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-sm-6">
                                        <label for="GalleryTitle" class="col-form-label">Gallery Title <star>*</star></label>
                                        <input class="form-control" type="text" required name="galleryTitle" placeholder="Gallery Title" id="GalleryTitle">
                                        <small class="form-text text-danger">@error('galleryTitle')
                                            {{$message}}
                                        @enderror</small>
                                    </div>

                                    <div class="col-sm-6">
                                        <label class="col-form-label">Gallery Picture <star>*</star></label>
                                            <input type="file" required name="galleryImage[]" id="gallery-photo-add" multiple class="form-control">                                            
                                        <small class="form-text text-danger">
                                            @error('galleryImage')
                                                {{$message}}
                                            @enderror
                                        </small>                                        
                                    </div>  
                                   
                                    {{-- <div class="col-sm-12 input_fields_wrap">
                                        <label class="col-form-label">Gallery Picture <star>*</star></label>
                                            <input type="file" required name="galleryImage[]" class="form-control">
                                                <button type="button" class="btn btn-success add_field_button my-2" id="basic-addon1"><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;Add More</button>
                                        <small class="form-text text-danger">@error('galleryImage')
                                            {{$message}}
                                        @enderror</small>                                        
                                    </div>     --}}
                                    <div class="col-sm-12">
                                        <div class="gallery text-center"></div>
                                    </div>
                                    <div class="col-sm-12 text-center mt-3">
                                        <button name="add_course" type="submit" class="btn btn-primary"><i class="fa fa-paper-plane"></i> Upload Image</button>
                                    </div>                            
                                </form>                                
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end col -->
        </div>
        <!-- end row -->
     </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(function() {
    // Multiple images preview in browser
    var imagesPreview = function(input, placeToInsertImagePreview) {

        if (input.files) {
            var filesAmount = input.files.length;

            for (i = 0; i < filesAmount; i++) {
                var reader = new FileReader();

                reader.onload = function(event) {
                    $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
                }

                reader.readAsDataURL(input.files[i]);
            }
        }

    };

    $('#gallery-photo-add').on('change', function() {
        imagesPreview(this, 'div.gallery');
    });
});
</script>
{{-- <script type="text/javascript">
   $(document).ready(function() {
	var max_fields      = 10; //maximum input boxes allowed
	var wrapper   		= $(".input_fields_wrap"); //Fields wrapper
	var add_button      = $(".add_field_button"); //Add button ID
	
	var x = 1; //initlal text box count
	$(add_button).click(function(e){ //on add input button click
		e.preventDefault();
		if(x < max_fields){ //max input box allowed
			x++; //text box increment
			$(wrapper).append('<div><input type="file" class="form-control" name="galleryImage[]" required="true"/><button type="button" class="btn btn-danger my-2 remove_field"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp;Remove</button></div>'); //add input box
		}
	});
	
	$(wrapper).on("click",".remove_field", function(e){ //user click on remove text
		e.preventDefault(); $(this).parent('div').remove(); x--;
	})
});
</script> --}}
@endsection
