<x-app-layout>
    <script src="{{url('plugins/jquery/jquery.min.js')}}" ></script>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Edit Review</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Edit Review</li>
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
                <h3 class="card-title">Edit Review</h3>
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
                  <form action="{{route('reviews.update',$Review->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                      <div class="row">
                          <!-- /.col -->
                            <div class="col-12 col-sm-6">
                              <div class="form-group">
                                <label for="exampleInputEmail1">Name</label>
                                <input type="text" class="form-control" value="{{$Review->name}}" name="name" id="cat_name" placeholder="Enter Name">
                                </div>
                              </div>
                              <div class="col-12 col-sm-6">
                                  <div class="form-group">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input type="text" class="form-control" name="email" value="{{$Review->email}}" id="" placeholder="Enter Small Description">
                                    </div>
                                  </div>
                                  <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                      <label for="">Title</label>
                                        <input type="text" class="form-control" name="title" id=""  value="{{$Review->title}}" placeholder="Enter Title">
                                      </div>
                                    </div>
                              
                                      <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                          <label for="exampl1">Description</label>
                                          <input type="text" class="form-control" name="description" id="" value="{{$Review->description}}" placeholder="meta Description">
                                          </div>
                                        </div>
                                 
                                 
                            <!-- /.form-group -->
                            <div class="col-12 col-sm-6">
                              <div class="form-group">
                                <input type="submit" class="form-control bg-primary" id="" >
                                </div>
                              </div>
                          </div>
                        
                </div>
              </form>
                <!-- /.row -->
              </div>
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