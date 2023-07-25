<x-app-layout>
    <script src="{{url('plugins/jquery/jquery.min.js')}}" ></script>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Add Permissions</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Add Permissions</li>
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
                <h3 class="card-title">Add Roles</h3>
                <div class="card-tools">
                  @if(auth()->user()->permission('add role')) 
                    <button type="button" class="btn btn-tool bg-primary" data-toggle="modal" data-target="#modal-default">
                        Create Role
                      </button>
                      @endif
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
             
        
                <!-- /.row -->
            
                    <!-- /.card-header -->
                    <div class="card-body">
                      <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                          <th>Role Name</th>
                          <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                     @foreach($roles as $role)
                        <tr>
                          <td>{{$role->name}}</td>
                          <td>  
                            <div class="row"> 
                             {{-- <a href="{{ URL::to('de_Active_role/'. $role->id)}}" class="btn btn-danger col-sm-2">
                              De Active
                          </a> --}}
                          <button   class="role_id" data-toggle="modal" data-target="#modal-edit"  data-role_name={{ $role->name }} data-role_id={{$role->id}}>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                              <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                              <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                            </svg>
                        </button>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          <form action="{{ route('roles.destroy', $role->id)}}" method="post">
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
                          <th>Role Name</th>
                          <th>Action</th>
                        </tr>
                        </tfoot>
                      </table>
                    </div>
                  </div>
                  <!-- /.card -->
              </div>
             
            </div>
          </div>
        </div>
        <div class="modal fade" id="modal-default">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Add Role Name</h4>
                  <button type="button" id="close" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('roles.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                          <div class="row">
                              <!-- /.col -->
                                <div class="col-12 col-sm-12">
                                  <div class="form-group">
                                    <label for="Permission">Role Name</label>
                                    <input type="text" class="form-control" name="role_name" id="" placeholder="Enter Role Name">
                                
                                </div>
                                  </div>
                                  <div class="form-group">
                          
                                    <input type="Submit" class="form-control bg-success"  id="" >
                                    </div>
                                  </div>
                                </form>
                                    </div>
                <div class="modal-footer justify-content-between">
              
                  {{-- <button type="button" id="close2" class="btn btn-default" data-dismiss="modal">Close</button> --}}
                
                </div>
            </div>
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>
          <!-- /.modal -->
      {{-- Roles Edit Model Start --}}
      <div class="modal fade" id="modal-edit">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edit Role Name</h4>
              <button type="button" id="close" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form action="{{route('roles.role_update')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                      <div class="row">
                        {{-- href="{{ URL::to('brands/' . $item->id . '/edit')}}" --}}
                          <!-- /.col -->
                            <div class="col-12 col-sm-12">
                              <div class="form-group">
                                <label for="Permission">Role Name</label>
                                <input type="text" class="form-control" name="role_name" id="role_name" placeholder="Enter Role Name">
                                <input type="text" class="form-control" hidden name="role_id" id="role_id" placeholder="Enter Role Name">
                            
                            </div>
                              </div>
                              <div class="form-group">
                      
                                <input type="Submit" class="form-control bg-success"  id="" >
                                </div>
                              </div>
                            </form>
                                </div>
            <div class="modal-footer justify-content-between">
          
              {{-- <button type="button" id="close2" class="btn btn-default" data-dismiss="modal">Close</button> --}}
            
            </div>
        </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
      <script>
        $('.role_id').click(function(e) {
              e.preventDefault();
              $('#role_name').val($(this).data('role_name'));
              $('#role_id').val($(this).data('role_id'));
          })
    </script>
          </x-app-layout>