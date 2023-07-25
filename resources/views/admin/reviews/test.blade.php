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
                  <form action="{{url('filters')}}" method="POST" enctype="multipart/form-data">
                    @csrf
        
                      <div class="row">
                          <!-- /.col -->
                          <div class="col-md-6">
                            @foreach($attributeoption as $attr)
                            <div class="form-group">
                              <label>{{$attr->name}}</label>
                              <select class="form-control select2" name="product_attributes[{{$attr->name}}]" style="width: 100%;">
                                <option selected="selected">Select {{$attr->name}}</option>
                                @foreach($attr->values as $val )
                                <option >{{$val->value}}</option>
                                @endforeach
                              </select>
                              @endforeach
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
  
          </x-app-layout>