<x-app-layout>
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
              <h1>Add Filters</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Add Filters</li>
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
                <h3 class="card-title">Add Filters</h3>
    
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
                  <form method="post" action="{{route('filters.store')}}">
                      @csrf
                      <div class="row">
                          <div class="col-lg-12">
                              <div id="">
                                  <label for="">Filter Name</label>
                                  <div class="input-group mb-3">
                                      
                                      <input type="text" name="filter_name" class="form-control m-input" placeholder="Enter Filter Name" autocomplete="off">
                             
                                  </div>
                              </div>
                              <hr>
                              <div id="inputFormRow">
                                  <label for="">Filter Value</label>
                                  <div class="input-group mb-3">
                                     
                                      <input type="text" name="filter_values[]" class="form-control m-input" placeholder="Enter Attribute Value" autocomplete="off">
                                      <div class="input-group-append">
                                          <button id="removeRow" type="button" class="btn btn-danger">Remove</button>
                                      </div>
                                  </div>
                              </div>
                  
                              <div id="newRow"></div>
                              <button id="addRow" type="button" class="btn btn-info">Add Another</button>
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
              // add row
              $("#addRow").click(function () {
                  var html = '';
                  html += '<div id="inputFormRow">';
                  html += '<div class="input-group mb-3">';
                  html += '<input type="text" name="filter_values[]" class="form-control m-input" placeholder="Enter Filter Value" autocomplete="off">';
                  html += '<div class="input-group-append">';
                  html += '<button id="removeRow" type="button" class="btn btn-danger">Remove</button>';
                  html += '</div>';
                  html += '</div>';
          
                  $('#newRow').append(html);
              });
          
              // remove row
              $(document).on('click', '#removeRow', function () {
                  $(this).closest('#inputFormRow').remove();
              });
          </script>
          </x-app-layout>