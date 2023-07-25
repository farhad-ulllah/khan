<x-app-layout>
    <link rel="stylesheet" href="{{url('plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{url('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
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
        <button type="button" class="btn btn-primary float-right"  data-toggle="modal" id="ads" data-target="#modal-ads" >
          Create Adds
        </button>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
          <tr>
            <th>Title</th>
            <th>Description</th>
            <th>size</th>
            <th>Image</th>
            <th>Action</th>
          </tr>
          </thead>
          <tbody>
            @foreach($ads as $item)
          <tr>
            <td>{{$item->title}}</td>
            <td>{{$item->description}}</td>
            <td>{{$item->size}}</td>
            <td><img src="{{ asset('storage/adds/'.$item->image) }}" height="50px" width="50px" alt="" title=""></td>
            <td>  
              
             <div class="row"> 
               <button  class="edit_silder" data-toggle="modal" id="edit_silder" data-target="#modal-edit_slider" data-ads="{{$item}}" value="{{$item->id}}" data-size_value="{{$item->size}}" data-slider_image="{{$item->image}}" data-slider_title="{{$item->title}}" data-ads_id="{{$item->id}}" data-description="{{$item->description}}" data-html_code="{{$item->html_code}}" >
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                </svg>
               </button>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
         
            <a href="{{route('Ads.destroy', $item->id)}} ">
            <button class="" type="submit" onclick="return confirm('Are you sure to delete this?')"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
              <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
              <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
            </svg></button>
         
          </div>
          </td>
          </tr>
          @endforeach 
          </tbody>
          <tfoot>
          <tr>
            <th>Title</th>
            <th>Description</th>
            <th>size</th>
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
<div class="modal fade" id="modal-ads">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Crate Ads</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{route('Ads.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
            <div class="col-12 col-sm-10">
                <div class="form-group">
                  <label for="exampleInputEmail1">Title</label>
                  <input type="text" class="form-control" id="title" name="title" placeholder="Enter  Title">
                  @error('title')<span class="text-red-700">{{$message}}  </span>@enderror
                </div>
              </div>
    
                     <!-- /.form-group -->  
              <div class="col-12 col-sm-10">
                <div class="form-group">
                  <label>Select Size</label>
                  <select class="form-control select2" name="size" style="width: 100%;">
                    <option selected="selected">Select Size</option>
                    <option value="728 × 90 px">728 × 90 px</option>
                    <option value="336 × 280 px">336 × 280 px</option>
                    <option value="300 × 250 px">300 × 250 px</option>
                    <option value="160 × 600 px">160 × 600 px</option>
                    <option value="120 × 600 px">120 × 600 px</option>
                    <option value="120 × 90 px">120 × 90 px</option>
                    <option value="120 × 60 px">120 × 60 px</option>
                    <option value="	88 × 31 px">88 × 31 px</option>
                
                  </select>
                  @error('size')<span class="text-red-700">{{$message}}  </span>@enderror
                </div>
              </div>
              <div class="col-12 col-sm-10">
                <div class="form-group">
                  <label for="exampleInputEmail1">Description</label>
                  <input type="text" class="form-control" id="title" name="description" placeholder="Enter  Description">
                  @error('description')<span class="text-red-700">{{$message}}  </span>@enderror
                </div>
              </div>
                         <div class="col-12 col-sm-10">
                <div class="form-group">
                  <label>Image OR Code</label>
                  <select class="form-control select2" id="sie" name="image_status" style="width: 100%;">
                      <option >Select</option>
                    <option value="image">Image</option>
                    <option value="code">Code</option>
                  </select>
                  @error('size')<span class="text-red-700">{{$message}}  </span>@enderror
                </div>
              </div>
              <div class="col-12 col-sm-6">
                <div class="form-group">
                  <label for="hmtl_code">Html Code</label>
                  <textarea id="html_code" class="form-controll" placeholder="Enter Code" name="html_code" > </textarea>
                  @error('html_code')<span class="text-red-700">{{$message}}  </span>@enderror
                </div>
              </div>
                     <!-- /.form-group --> 
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
            <form action="{{route('Ads.update')}}" method="POST" enctype="multipart/form-data">
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
                  <label for="hmtl_code">Html Code</label>
                   <textarea id="html_codes" class="form-controll" placeholder="Enter Code" name="html_code" > </textarea>
                  <!--<input type="text" class="form-control"  name="html_code" placeholder="Enter  Code">-->
                  @error('html_code')<span class="text-red-700">{{$message}}  </span>@enderror
                </div>
              </div>
          
              <div class="col-12 col-sm-10">
                <div class="form-group">
                  <label>Select Size</label>
                  <select class="form-control select2" id="size" name="size" style="width: 100%;">
                    <option value="728 × 90 px">728 × 90 px</option>
                    <option value="336 × 280 px">336 × 280 px</option>
                    <option value="300 × 250 px">300 × 250 px</option>
                    <option value="160 × 600 px">160 × 600 px</option>
                    <option value="120 × 600 px">120 × 600 px</option>
                    <option value="120 × 90 px">120 × 90 px</option>
                    <option value="120 × 60 px">120 × 60 px</option>
                    <option value="	88 × 31 px">88 × 31 px</option>
                
                  </select>
                  @error('size')<span class="text-red-700">{{$message}}  </span>@enderror
                </div>
              </div>
              <div class="col-12 col-sm-10">
                <div class="form-group">
                    <input type="text" hidden class="form-control" id="ades_id" name="id" >
                  <label for="exampleInputEmail1">Description</label>
                  <input type="text" class="form-control" id="description" name="description" placeholder="Enter  description">
                  @error('description')<span class="text-red-700">{{$message}}  </span>@enderror
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
           var adss = $(this).data('ads');
        $('#slidertitle').val(adss.title);
        $('#ades_id').val(adss.id);
        $('#html_codes').val(adss.html_code);
        $('#description').val(adss.description);
        $('#image').val(adss.slider_image);
        
        // $('#size').val($(this).data('size_value'));
         var size=$(this).data('size_value');
 
        // $('#size > option[value="'+size+'"]').attr('selected', true);
         $('#size').val(adss.size).trigger('change');
        // image =$(this).data('slider_image');
        // var source = "{!! asset('storage/ads/"+image+"') !!}";
        // $('#my_image').attr('src', source);
        
          $('#slider_image').val(adss.image);
            image = adss.image;
            var source = "{!! asset('storage/adds/"+image+"') !!}";
            $('#my_image').attr('src', source);
    })
  </script>
  </x-app-layout>