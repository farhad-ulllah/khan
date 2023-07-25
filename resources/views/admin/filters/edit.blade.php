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
              <h1>Edit Filters</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Edit Filters</li>
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
                <h3 class="card-title">Edit Filters</h3>
    
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
                  <form method="post" action="{{route('filters.update',$Filters->id)}}">
                      @csrf
                      @method('PUT')
                      <div class="row">
                          <div class="col-lg-12">
                              <div id="">
                                  <label for="">Filter Name</label>
                                  <div class="input-group mb-3">
                                      
                                      <input type="text" name="filter_name" value="{{$Filters->filter_name}}" class="form-control m-input" placeholder="Update Group Name" autocomplete="off">
                             
                                  </div>
                              </div>
                              <div id="inputFormRow">
                                  <label for="">Filters Value</label>
                                  @foreach($Filters->filter_value as $values)
                                  <div class="input-group mb-3">
                                    
                                     <input type="text" name="values[{{$values->id}}]" value="{{$values->filter_value}}" class="form-control m-input" placeholder="Update Filters" autocomplete="off">
                                  
                                     <div class="input-group-append">
                                      <a href="{{url('filter_value_delete/'.$values->id)}}"  onclick="return confirm('are you sure?')">
                                      <button id="removeRow" type="button"  class="btn btn-danger">Remove</button>
                                  </a>
                                  </div>
                                
                                  </div>
                                  @endforeach
                              </div>
                  
                              <div id="newRow"></div>
                              <button id="addRow" type="button" class="btn btn-info">Add Filters</button>
                          </div>
                          
                          
                      </div>
                      <input  id="" type="submit" title="Update" class="btn btn-info float-right">
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
                  html += '<input type="text" name="new_value[]"  class="form-control m-input" placeholder="Update Filter Value" autocomplete="off">';
                  html += '<div class="input-group-append">'; 
                  html += '<button id="removeRow"  type="button" class="btn btn-danger">Remove</button>';
                  html += '</div>';
                  html += '</div>';
          
                  $('#newRow').append(html);
              });
          
              // remove row
              $(document).on('click', '#removeRow', function () {
removeRow
                  $(this).closest('#inputFormRow').remove();
              });



      $('#removeRow').on('click', function() {
      $('#value').val($(this).val());
      let _url = `{!! url('/view_attributes_values/') !!}/` + $('#value').val();
      $.ajax({
          url: _url,
          type: 'GET',
          success: function(data) {
              console.log(data);
             
          },
      });
  });
          </script>
          </x-app-layout>