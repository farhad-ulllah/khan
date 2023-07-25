<x-app-layout>
  <script src="{{url('plugins/jquery/jquery.min.js')}}" ></script>
  <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>Edit Brand</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">Edit Brand</li>
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
                  <h3 class="card-title">Edit Brand</h3>
                  <div class="card-tools">
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
                  <form action="{{route('brands.update',$brand->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                        <div class="row">
                            <!-- /.col -->
                              <div class="col-12 col-sm-6">
                                <div class="form-group">
                                  <label for="exampleInputEmail1">Brand Name</label>
                                  <input type="text" class="form-control" value="{{$brand->brand_name}}" name="brand_name" id="brand_name" placeholder="Enter Name">
                                  </div>
                                </div>

                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                      <label for="exampleInputEmail1"> Description</label>
                                      <textarea type="text" class="form-control" name="brand_desc" id="" value="{{$brand->description}}" placeholder="Enter  Description">{{$brand->description}}</textarea>
                                      </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                      <div class="form-group">
                                        <label for="exampleInputEmail1">Image</label>
                                       
                                        <input type="file" class="form-control" name="image" id="" >
                                        <input type="text" hidden class="form-control" name="old_image" value="{{$brand->image}}" id="" >
                                         <img src="{{ asset('storage/brands/'.$brand->image) }}" height="50px" width="50px" alt="" title="">
                                        </div>
                                      </div>
                                     <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                      <label>Alt  Image Title</label>
                                    <input type="text" class="form-control" id="" name="alt_image" value="{{$brand->alt_image}}" placeholder="Alt Image">
                                    @error('alt_image')<span class="text-red-700" style="color:red;">{{$message}}  </span>@enderror
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
                                              <input type="text" class="form-control" name="meta_title" value="{{$brand->meta_title}}" id="" placeholder="meta Title">
                                              </div>
                                            </div>
                                            <div class="col-12 col-sm-6">
                                              <div class="form-group">
                                                <label for="exampleInputEmail1">Meta Description</label>
                                                <textarea type="text" class="form-control" name="meta_description" value="{{$brand->meta_description}}" id="" placeholder="meta Description">{{$brand->meta_description}}</textarea>
                                                </div>
                                              </div>
                                      
                                          
                                              <div class="col-sm-6">
                                                <div class="form-group">
                                                  <label for="exampleInputEmail1">Focus Key Phrases</label>
                                                  <input type="text" class="form-control" name="meta_keyword" value="{{$brand->meta_keywords}}" id="" placeholder="Focus Key Phrases">
                                                  </div>
                                                </div>
                                                <div class="col-sm-6">
                                                  <div class="form-group">
                                                    <label for="exampleInputEmail1">Slug</label>
                                                    <input type="text" class="form-control" value="{{$brand->slug}}" name="brand_slug" id="brand_slug" placeholder="Enter SLug" >
                                                    </div>
                                                  </div>
                                         
                                            </div>  </div>   </div>
                                  
                            
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
        var title=$('#cat_name').val();
          $.get('{{url('check_Blogcat_slug')}}',
          {'cat_name':$('#cat_name').val()},
          function(data){
            $('#cat_slug').val(data.cat_slug);
            $("#meta_title").val(title +''+ "mobiles Phones");
          }
          );
  
        });
      </script>
        </x-app-layout>