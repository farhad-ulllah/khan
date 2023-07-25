<x-app-layout>
  @section('title')
  Edit User
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
                    <form method="post" action="{{route('users.update',$users->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-lg-12">
                                <label for="">Name</label>
                                <div class="input-group mb-3">
                                    <input type="text" name="name" value="{{$users->name}}" class="form-control m-input" placeholder="Enter  Name" autocomplete="off">
                                </div>   @error('name')<span class="text-red-700">{{$message}}  </span>@enderror
                            </div>
                            <div class="col-lg-12">
                                    <label for="">User Name</label>
                                    <div class="input-group mb-3">
                                        <input type="text" name="user_name" value="{{$users->user_name}}" class="form-control m-input" placeholder="Enter User Name" autocomplete="off">
                                     
                                    </div>   @error('user_name')<span class="text-red-700">{{$message}}  </span>@enderror

                                </div>
                                <div class="col-lg-12">
                                    <label for="">Email</label>
                                    <div class="input-group mb-3">
                                        <input type="email" name="email" value="{{$users->email}}" class="form-control m-input" placeholder="Enter User Email" autocomplete="off">
                                    </div>
                                    @error('email')<span class="text-red-700">{{$message}}  </span>@enderror
                                </div>
                                {{-- <div class="col-lg-12">
                                  <label for="">Password</label>
                                  <div class="input-group mb-3">
                                      <input type="password" name="password" value="{{$users->password}}" class="form-control m-input" placeholder="Enter User password" autocomplete="off">
                                  </div>
                                  @error('password')<span class="text-red-700" style="text-color:red">{{$message}}  </span>@enderror
                              </div> --}}
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label>Role</label>
                                    <select class="form-control select2" name="role"  style="width: 100%;">
                                      <option selected="selected" >Select Role</option>
                                      @foreach($roles as $role )
                                      <option value="{{$role->id}}" {{($role->id == $role_id) ? 'selected' : ''}}>{{$role->name}}</option>
                                      @endforeach
                                    </select>
                                  </div>
                                  @error('role')<span class="text-red-700">{{$message}}  </span>@enderror
                                </div>
                                <div class="col-lg-12">
                                    <label for="">Photo</label>
                                    <div class="input-group mb-3">
                                        <img src="{{ asset('storage/user/'.$users->profile_photo_path) }}" height="50px" width="50px" alt="" title="">
                                        <input type="file" class="form-control" id="" name="image">
                                        <input type="text" hidden class="form-control" name="old_image" value="{{$users->profile_photo_path}}" id="" >
                                     
                                    </div>
                                </div>
                              
                            
                        </div>
                        <input  id="" type="submit" class="btn btn-info float-right">
                        </div>
                    </form>
                  <!-- /.row -->
                </div>
                <!-- /.card-body -->
            </div> 
            <div class="card-body">
              <form action="{{url('update_password/'.$users->id)}}">
             @csrf
              
             <div class="col-lg-12">
              <label for="new">Current Password</label>
                        <input id="current_password" class="form-control m-input" name="current_password" required type="password" class="mt-1 block w-full" placeholder="current password"  autocomplete="current-password" />
                        @error('current_password')<span class="text-red-700">{{$message}}  </span>@enderror
                    </div>
                    @if(Session::has('message'))
                    <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('message') }}</p>
                    @endif
                    <div class="col-lg-12">
                      <label for="new">New Password</label>
                        <input id="password" type="password" class="form-control m-input" name="password" required class="mt-1 block w-full" placeholder="new password"  autocomplete="new-password" />
                        @error('password')<span class="text-red-700">{{$message}}  </span>@enderror
                    </div>
            
                    <div class="col-lg-12">
                      <label for="password_confirmation">Confirm Password</label>
                      <div class="input-group mb-3">
                      <input id="password_confirmation" class="form-control m-input" required placeholder="Enter Confirm password"
                                      type="password"
                                      name="password_confirmation"  required />
                                  </div>
                                  @error('password_confirmation')<span class="text-red-700">{{$message}}  </span>@enderror
                              </div>

                    <div class="col-span-6 sm:col-span-4">
                      <label for="" value="Confirm Password" >
                        <input  id="" type="submit" class="btn btn-info float-right">
                 
                 
                  </div>
            
              </form>
            </div>
            </x-app-layout>