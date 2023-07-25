<x-app-layout>
  <script src="{{url('plugins/jquery/jquery.min.js')}}" ></script>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit  Category</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Edit  Category</li>
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
              <h3 class="card-title">Edit  Category</h3>
              <div class="card-tools">
                <a href="{{route('category.index')}}"> <button type="button" class="btn btn-primary " >
                  View  Category
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
              <form action="{{Route('category.update',$category->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                    <div class="row">
                        <!-- /.col -->
                          <div class="col-12 col-sm-6">
                            <div class="form-group">
                              <label for="exampleInputEmail1">Category Name</label>
                              <input type="text" class="form-control" name="cat_name" id="" value="{{$category->name}}" placeholder="Enter Name">
                            </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                  <label for="exampleInputEmail1"> Description</label>
                                  <textarea type="text" class="form-control" name="cat_desc" value="{{$category->description}}" id="" placeholder="Enter  Description">{{$category->description}}</textarea>
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
                                          <input type="text" class="form-control" name="cat_met_title" value="{{$category->meta_title}}" id="" placeholder="meta Title">
                                        </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                          <div class="form-group">
                                            <label for="exampleInputEmail1">Meta Description</label>
                                            <textarea type="text" class="form-control" name="cat_met_desc" value="{{$category->meta_descrip}}" id="" placeholder="meta Description">{{$category->meta_descrip}}</textarea>
                                          </div>
                                          </div>
                                  
                                      
                                          <div class="col-sm-6">
                                            <div class="form-group">
                                              <label for="exampleInputEmail1">Focus Key Phrases</label>
                                              <input type="text" class="form-control" name="cat_met_keyword" id="" value="{{$category->meta_keywords}}" placeholder="meta Keywords">
                                            </div>
                                            </div>
                                            <div class="col-sm-6">
                                              <div class="form-group">
                                                <label for="exampleInputEmail1">Slug</label>
                                                <input type="text" class="form-control" name="cat_slug" value="{{$category->slug}}" id="" placeholder="Enter Slug">

                                                </div>
                                              </div>
                                     
                                        </div>  </div>   </div>
                              
                                        <div class="col-12 col-sm-6">
                                          <div class="form-group">
                                            <label for="exampleInputEmail1">Image</label>
                                          
                                            <input type="file" class="form-control" name="image" id="exampleInputEmail1" >
                                            <input type="text" hidden class="form-control" name="old_image" value="{{$category->image}}" id="" >
                                              <img src="{{ asset('storage/category/'.$category->image) }}" height="50px" width="50px" alt="" title="">
                                            @error('image')<span class="text-red-700">{{$message}}  </span>@enderror  
                                          </div>
                                          </div>
                                                <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                              <label>Alt  Image Title</label>
                                            <input type="text" class="form-control" id="" name="alt_image" value="{{$category->alt_image}}" placeholder="Alt Image">
                                            @error('alt_image')<span class="text-red-700" style="color:red;">{{$message}}  </span>@enderror
                                            </div>
                                          </div>
                          <!-- /.form-group -->
                          <div class="col-12 col-sm-1 float-right">
                            <div class="form-group float-right">
                              <input type="submit" class="form-control bg-success float-right"  id="" >
                              </div>
                            </div>
                        </div>
                      
              </div>
            </form>
              <!-- /.row -->
            </div>
          </div>
        </div>
 
        <script>
         $('#cat_name').keyup(function(e){
          
          $.get('{{url('check_cat_slug')}}',
          {'cat_name':$('#cat_name').val()},
          function(data){
            $('#cat_slug').val(data.cat_slug);
          }
          );
  
        });
        </script>
        </x-app-layout>