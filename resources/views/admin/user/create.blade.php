<x-app-layout>
  @section('title')
  Create User
  @endsection
    <link rel="stylesheet" href="{{url('plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{url('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
    <script src="{{url('plugins/jquery/jquery.min.js')}}" ></script>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>Add User</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">Add User</li>
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
                  <h3 class="card-title">Add User</h3>
      
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
                    <form method="post" action="{{route('users.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <label for="">Name</label>
                                <div class="input-group mb-3">
                                    <input type="text" name="name" class="form-control m-input" placeholder="Enter  Name" autocomplete="off" required>
                                </div>   @error('name')<span class="text-red-700">{{$message}}  </span>@enderror
                            </div>
                            <div class="col-lg-12">
                                    <label for="">User Name</label>
                                    <div class="input-group mb-3">
                                        <input type="text" name="user_name" class="form-control m-input" placeholder="Enter User Name" autocomplete="off" required>
                                     
                                    </div>   @error('user_name')<span class="text-red-700">{{$message}}  </span>@enderror

                                </div>
                                <div class="col-lg-12">
                                    <label for="">Email</label>
                                    <div class="input-group mb-3">
                                        <input type="email" name="email" class="form-control m-input" placeholder="Enter User Email" autocomplete="off" required>
                                    </div>
                                    @error('email')<span class="text-red-700">{{$message}}  </span>@enderror
                                </div>
                                <div class="col-lg-12">
                                    <label for="">Password</label>
                                    <div class="input-group mb-3">
                                        <input type="password" name="password" class="form-control m-input" placeholder="Enter User password" autocomplete="off" required>
                                    </div>
                                    @error('password')<span class="text-red-700" style="text-color:red">{{$message}}  </span>@enderror
                                </div>
                                <div class="col-lg-12">
                                <label for="password_confirmation">Confirm Password</label>
                                <div class="input-group mb-3">
                                <input id="password_confirmation" class="form-control m-input" placeholder="Enter Confirm password"
                                                type="password"
                                                name="password_confirmation"  required />
                                            </div>
                                            @error('password_confirmation')<span class="text-red-700">{{$message}}  </span>@enderror
                                        </div>
                                        <div class="col-md-6">
                                          <div class="form-group">
                                            <label>Role</label>
                                            <select class="form-control select2" name="role" style="width: 100%;"  required>
                                              <option value="" >Select Role</option>
                                              @foreach($roles as $role )
                                              <option value="{{$role->id}}">{{$role->name}}</option>
                                              @endforeach
                                            </select>
                                          </div>
                                          @error('role')<span class="text-red-700">{{$message}}  </span>@enderror
                                        </div>
                                <div class="col-lg-12">
                                    <label for="">Photo</label>
                                    <div class="input-group mb-3">
                                        <input type="file" name="image" class="form-control m-input" autocomplete="off">
                                    </div>
                                </div>
                              
                            
                        </div>
                        <input  id="" type="submit" class="btn btn-info float-right">
                        </div>
                    </form>
                  <!-- /.row -->
                </div>
                <!-- /.card-body -->
            </div>  </div>
              </div>
              <script type="text/javascript">
   
            </script>
            </x-app-layout>