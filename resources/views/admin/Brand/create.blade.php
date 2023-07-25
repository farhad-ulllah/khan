<x-app-layout>
  <script src="{{url('plugins/jquery/jquery.min.js')}}" ></script>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add Brand</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add Brand</li>
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
              <h3 class="card-title">Add Brand</h3>
              <div class="card-tools">
                <a href="{{route('brands.index')}}"> <button type="button" class="btn btn-primary " >
                  View Brands
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
                <form action="{{route('brands.store')}}" method="POST" enctype="multipart/form-data">
                  @csrf
                    <div class="row">
                        <!-- /.col -->
                          <div class="col-12 col-sm-6">
                            <div class="form-group">
                              <label for="exampleInputEmail1">Brand Name</label>
                              <input type="text" class="form-control" name="brand_name" id="brand_name" placeholder="Enter Name">
                                @error('brand_name')<span class="text-red-700" style="color:red;">{{$message}}  </span>@enderror  
                              </div>
                            </div>
                   
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                  <label for="exampleInputEmail1"> Description</label>
                                  <textarea type="text" class="form-control" name="brand_desc" id="" placeholder="Enter Small Description"></textarea>
                                  </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                  <div class="form-group">
                                    <label for="exampleInputEmail1">Image</label>
                                    <input type="file" class="form-control" name="image" id="" >
                                    @error('image')<span class="text-red-700">{{$message}}  </span>@enderror  
                                    </div>
                                  </div>
                                <div class="col-10 col-sm-6">
                                    <div class="form-group">
                                      <label>Alt  Image Title</label>
                                    <input type="text" class="form-control" id="" name="alt_image" placeholder="Alt Image">
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
                                          <input type="text" class="form-control" name="meta_title" id="" placeholder="meta Title">
                                          </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                          <div class="form-group">
                                            <label for="exampleInputEmail1">Meta Description</label>
                                            <textarea type="text" class="form-control" name="meta_description" id="" placeholder="meta Description"></textarea>
                                            </div>
                                          </div>
                                  
                                      
                                          <div class="col-sm-6">
                                            <div class="form-group">
                                              <label for="exampleInputEmail1">Focus Key Phrases</label>
                                              <input type="text" class="form-control" name="meta_keyword" id="" placeholder="Focus Key Phrases">
                                              </div>
                                            </div>
                                            <div class="col-sm-6">
                                              <div class="form-group">
                                                <label for="exampleInputEmail1">Slug</label>
                                                <input type="text" class="form-control" name="brand_slug"  id="brand_slug" placeholder="Enter SLug" >
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
         $('#brand_name').keyup(function(e){
          var title=$('#brand_name').val();
          $.get('{{url('check_brand_slug')}}',
          {'brand_name':$('#brand_name').val()},
          function(data){
            $('#brand_slug').val(data.brand_slug);
            $("#meta_title").val(title +''+ "mobiles Phones");
          }
          );
  
        });
      </script>
        </x-app-layout>