<x-app-layout>
  <script src="{{url('plugins/jquery/jquery.min.js')}}" ></script>
  <link rel="stylesheet" href="{{url('plugins/select2/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{url('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add BLog</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add BLog</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <!-- SELECT2 EXAMPLE -->
          <div class="card card-default">
            <div class="card-header">
              <h3 class="card-title">Add BLog</h3>
              <div class="card-tools">
                <a href="{{route('brands.index')}}"> <button type="button" class="btn btn-primary " >
                  Add Blog
                </button></a>
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <form action="{{route('blogs.update',$blog->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                    <div class="row">
                        <!-- /.col -->
                          <div class="col-12 col-sm-6">
                            <div class="form-group">
                              <label>Select Category</label>
                              <select class="form-control select2" name="cat_id" style="width: 100%;">
                                <option selected="selected">Select Category</option>
                                @foreach($category as $item )
                                <option value="{{$item->id}}" {{($item->id == $blog->cat_id) ? 'Selected' : ''}}>{{$item->name}}</option>
                                @endforeach
                              </select>
                              @error('cat_id')<span class="text-red-700">{{$message}}  </span>@enderror
                              </div>
                            </div>
                            <div class="col-12 col-sm-6">
                              <div class="form-group">
                                <label for="exampleInputEmail1">Title</label>
                                <input type="text" class="form-control" value="{{$blog->title}}" id="title" name="title" placeholder="Enter  Title">
                                @error('title')<span class="text-red-700">{{$message}}  </span>@enderror
                                </div>
                              </div>
                            <div class="col-12 col-sm-12">
                                <div class="form-group">
                                  <label for="exampleInputEmail1"> Description</label>
                                  <textarea id="editor1" placeholder="Enter Detail" name="description"   placeholder="Update Description"> {!!$blog->description!!}</textarea>
                                  </div>
                                </div>
                                    <div class="col-12 col-sm-6">
                                          <div class="form-group">
                                            <label for=""> Upload Image</label>
                                        
                                            <input type="file" class="form-control" id="" name="image">
                                            <input type="text" hidden class="form-control" name="old_image" value="{{$blog->image}}" id="" >
                                                <img src="{{ asset('storage/blogs/'.$blog->image) }}" height="50px" width="50px" alt="" title="">
                                            @error('image')<span class="text-red-700">{{$message}}  </span>@enderror 
                                            </div>
                                          </div>
                                        <div class="col-10 col-sm-6">
                                            <div class="form-group">
                                              <label>Alt  Image Title</label>
                                            <input type="text" class="form-control" id="" value="{{$blog->alt_image}}" name="alt_image">
                                            @error('alt_image')<span class="text-red-700" style="color:red;">{{$message}}  </span>@enderror
                                            </div>
                                          </div>
                                          <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                 <label for="">Upload Video</label>
                                            <input type="file" accept="video/mp4,video/x-m4v,video/*" class="form-control" id="" name="video">
                                            @error('video')<span class="text-red-700">{{$message}}  </span>@enderror  
                                          </div>
                                          </div>
        
                                <hr>
                                <div class="card card-default " style="width: 100%;" >
                                  <div class="card-header " style="background-color:#ADD8E6;">
                                    <h3 class="card-title">Text Fields For SEO </h3>
                        
                                    <div class="card-tools">
                                      <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                      </button>
                                      <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                      </button>
                                    </div>
                                  </div>
                                        <div class="card-body shadow">
                                          <div class="row">
                                       <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                          <label for="exampleInputEmail1">Meta title</label>
                                          <input type="text" class="form-control" id="" name="meta_title" value="{{$blog->meta_title}}" placeholder="meta Title">
                                          </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                          <div class="form-group">
                                            <label for="exampleInputEmail1">Meta Description</label>
                                            <textarea type="text" class="form-control" name="meta_description" id="" value="{{$blog->meta_description}}" placeholder="meta Description">{{$blog->meta_description}}</textarea>
                                            </div>
                                          </div>
                                  
                                      
                                          <div class="col-sm-6">
                                            <div class="form-group">
                                              <label for="exampleInputEmail1">Focus Key Phrases</label>
                                              <input type="text" class="form-control" id="" name="meta_keywords" value="{{$blog->meta_keywords}}" placeholder="Meta Keywords">
                                            </div>
                                            </div>
                                            <div class="col-sm-6">
                                              <div class="form-group">
                                                <label for="exampleInputEmail1">Slug</label>
                                                <input type="text" class="form-control" id="blog_slug" value="{{$blog->slug}}" name="blog_slug" placeholder="Enter  Slug" >

                                                </div>
                                              </div>
                                     
                                        </div>  </div>   </div>
                              
                            
                          <!-- /.form-group -->
                          <div class="col-12 col-sm-1 float-right">
                            <div class="form-group float-right">
                              <input type="submit" class="form-control bg-success float-right" value="update"  id="" >
                              </div>
                            </div>
                        </div>
                      
              </div>
            </form>
              <!-- /.row -->
            </div>
          </div>
        </div>
 
      <script src="{{url('plugins/jquery/jquery.min.js')}}" ></script>
        <script src="https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>
        {{-- <script src="{{url('ckfinder/ckfinder.js')}}"></script> --}}
        <script>
            $('#title').keyup(function(e){
              var title=$('#blog_slug').val();
            $.get('{{url('check_blog_slug')}}',
            {'title':$('#title').val()},
            function(data){
              $('#blog_slug').val(data.blog_slug);
              $("#meta_title").val(title + ' ' + "mobiles Phones blog");
            }
            );
          });
          CKEDITOR.replace( 'editor1' ,{
              filebrowserUploadUrl:"{{ route('ck.upload',['_token'=> csrf_token()])}}",
              filebrowserUploadMethod:"form"
          });
          $("selector").dialog({
      //parameters
      }).fadeIn(300);
      setTimeout(function(){CKEDITOR.replace('ckedt-hiddenForms')},350);
      </script>
      <script src="{{url('ckfinder/ckfinder.js')}}"></script>
       <script>CKFinder.config( { connectorPath: 'ckfinder/connector' } );</script>
        </x-app-layout>