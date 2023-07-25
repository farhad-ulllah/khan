<x-app-layout>
  @section('title')
  Slider
  @endsection
    <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>DataTables</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">DataTables</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Sliders</h3>
        <button type="button" class="btn btn-primary float-right"  data-toggle="modal" id="blog_description" data-target="#modal-slider" >
          Create Slider
        </button>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
          <tr>
            <th>Title</th>
            <th>Image</th>
            <th>Action</th>
          </tr>
          </thead>
          <tbody>
            @foreach($sliders as $item)
          <tr>
            <td>{{$item->title}}</td>
            <td><img src="{{ asset('storage/slider/'.$item->image) }}" height="50px" width="50px" alt="" title=""></td>
            <td>  
                 {{-- href="{{ URL::to('sliders/' . $item->id . '/edit')}}" --}}
              <div class="row"> 
               <button  class="edit_silder" data-toggle="modal" id="edit_silder" data-target="#modal-edit_slider" value="{{$item->id}}" data-slider_image="{{$item->image}}" data-slider_title="{{$item->title}}" data-slider_id="{{$item->id}}">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                </svg>
               </button>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <form action="{{ route('sliders.destroy', $item->id)}}" method="post">
            @csrf
            @method('DELETE')
            <button class="" type="submit" onclick="return confirm('Are you sure to delete this?')"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
              <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
              <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
            </svg></button>
          </form>
         
          </div>
          </td>
          </tr>
          @endforeach
          </tbody>
          <tfoot>
          <tr>
            <th>Title</th>
            <th>Image</th>
            <th>Action</th>
          </tr>
          </tfoot>
        </table>
      </div>
    </div>
    <!-- /.card -->
  </div>
  <!-- /.col -->
  </div>
  <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
</div> 
{{-- Add Slider Model --}}
<div class="modal fade" id="modal-slider">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add Slider</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{route('sliders.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
            <div class="col-12 col-sm-10">
                <div class="form-group">
                  <label for="exampleInputEmail1">Title</label>
                  <input type="text" class="form-control" id="title" name="title" placeholder="Enter  Title">
                  @error('title')<span class="text-red-700">{{$message}}  </span>@enderror
                </div>
                <!-- /.form-group -->  
              </div>
              <div class="col-12 col-sm-10">
                <div class="form-group">
                  <label for="">Select Image</label>
                  <input type="file" class="form-control" id="" name="image" >
                  @error('image')<span class="text-red-700">{{$message}}  </span>@enderror
                </div>
                <!-- /.form-group -->  
              </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.Add modal  End-->
</form>
  {{-- Edit Slider Model --}}
<div class="modal fade" id="modal-edit_slider">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Slider</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{route('slider.update')}}" method="POST" enctype="multipart/form-data">
                @csrf
            <div class="col-12 col-sm-10">
                <div class="form-group">
                    <input type="text" hidden class="form-control" id="slider_id" name="id" >
                  <label for="exampleInputEmail1">Title</label>
                  <input type="text" class="form-control" id="slidertitle" name="title" placeholder="Enter  Title">
                  @error('title')<span class="text-red-700">{{$message}}  </span>@enderror
                </div>
                <!-- /.form-group -->  
              </div>
              <div class="col-12 col-sm-10">
                <div class="form-group">
                  <label for="">Select Image</label>
                  <input type="text" hidden class="form-control" id="image" name="old_image" >
                  <input type="file" class="form-control" id="" name="image">
                  <img src="" height="50px" id="my_image" width="50px" alt="" title="">
                  @error('image')<span class="text-red-700">{{$message}}  </span>@enderror
                </div>
                <!-- /.form-group -->  
              </div>
            </div>
           <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
           <button type="submit" class="btn btn-primary">Save</button>
          </div>
           </div>
      <!-- /.modal-content -->
        </form>
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.Add modal  End-->
  </div> </div></div>
  <!-- /.modal -->
  <script src="{{url('plugins/jquery/jquery.min.js')}}" ></script>
  <script>
        $('.edit_silder').click(function(e) {
        e.preventDefault();
       console.log('yes');
        $('#slidertitle').val($(this).data('slider_title'));
        $('#slider_id').val($(this).data('slider_id'));
        $('#image').val($(this).data('slider_image'));
        image =$(this).data('slider_image');
        var source = "{!! asset('storage/slider/"+image+"') !!}";
        $('#my_image').attr('src', source);
    })
  </script>
  </x-app-layout>