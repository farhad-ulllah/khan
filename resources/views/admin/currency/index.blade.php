<x-app-layout>
    @section('title')
    Currency
    @endsection
    <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Currency</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Currency</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Currency</h3>
        <button type="button" class="btn btn-primary float-right"  data-toggle="modal" id="blog_description" data-target="#modal-slider" >
          Create Currency
        </button>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
          <tr>
            <th>Name</th>
            <th>price</th>
            <th>date</th>
            <th>Flag Icon</th>
            <th>Action</th>
          </tr>
          </thead>
          <tbody>
           @foreach($Currency as $item)
          <tr>
            <td>{{$item->name}}</td>
            <td>{{$item->price}}</td>
            <td>{{$item->date}}</td>
            <td><img src="{{ asset('storage/currency/'.$item->flag_icon) }}" ></td>
            <td>  
                
              <div class="row"> 
               <button  class="edit_silder" data-toggle="modal" id="edit_silder" data-target="#modal-edit_slider" value="{{$item->id}}"  data-currency_name="{{$item->name}}" data-icon="{{$item->flag_icon}}" data-currency_id="{{$item->id}}" data-currency_price="{{$item->price}}"  data-country="{{$item->country}}" data-date="{{$item->date}}">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                </svg>
               </button>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <a href="{{route('Currency.destroy', $item->id)}} ">
            <button class="" type="submit" onclick="return confirm('Are you sure to delete this?')"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
              <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
              <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
            </svg></button>
        </a>
         
          </div>
          </td>
          </tr>
          @endforeach 
          </tbody>
          <tfoot>
          <tr>
            <th>Name</th>
            <th>price</th>
            <th>date</th>
            <th>Flag Icon</th>
            <th>Action</th>
          </tr>
          </tfoot>
        </table>
      </div>
    </div>
    <!-- /.card -->
  </div>
  <!-- /.col -->
  </div>
  <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
</div> 
{{-- Add Slider Model --}}
<div class="modal fade" id="modal-slider">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add Curency</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{route('Currency.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
            <div class="col-12 col-sm-10">
                <div class="form-group">
                  <label for="">Name</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="Enter  Currency Name">
                  @error('name')<span class="text-red-700">{{$message}}  </span>@enderror
                </div>
                <!-- /.form-group -->  
              </div>
              <div class="col-12 col-sm-10">
                <div class="form-group">
                  <label for="">Price</label>
                  <input type="number" class="form-control" id="" name="price" >
                  @error('price')<span class="text-red-700">{{$message}}  </span>@enderror
                </div>
                <!-- /.form-group -->  
              </div>
              <div class="col-12 col-sm-10">
                <div class="form-group">
                  <label for="">Country Name</label>
                  <input type="text" class="form-control" id="" name="country" >
                  @error('country')<span class="text-red-700">{{$message}}  </span>@enderror
                </div>
                <!-- /.form-group -->  
              </div>
              <div class="col-12 col-sm-10">
              <div class="form-group">
                <label for="">Date</label>
                <input type="date" class="form-control" id="name" name="currency_date" >
                @error('currency_date')<span class="text-red-700">{{$message}}  </span>@enderror
              </div>
              <!-- /.form-group -->  
            </div>
             <div class="col-12 col-sm-10">
              <div class="form-group">
                <label for="">Flag Icon</label>
                <input type="file" class="form-control" id="" name="image" >
                @error('image')<span class="text-red-700">{{$message}}  </span>@enderror
              </div>
              <!-- /.form-group -->  
            </div>
        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
          </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.Add modal  End-->
</form>
</div>  </div>  </div>
  {{-- Edit Slider Model --}}
<div class="modal fade" id="modal-edit_slider">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Slider</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{route('Currency.update')}}" method="POST" enctype="multipart/form-data">
                @csrf
            <div class="col-12 col-sm-10">
                <div class="form-group">
                    <input type="text" hidden class="form-control" id="curr_id" name="currency_id" >
                    <label for="">Name</label>
                    <input type="text" class="form-control" id="curr_name" name="name" placeholder="Enter  Currency Name">
                    @error('name')<span class="text-red-700">{{$message}}  </span>@enderror
                  </div>
                <!-- /.form-group -->  
              </div>
              <div class="col-12 col-sm-10">
                <div class="form-group">
                    <label for="">Price</label>
                    <input type="number" class="form-control" id="curr_price" name="price" >
                    @error('price')<span class="text-red-700">{{$message}}  </span>@enderror
                  </div>
                <!-- /.form-group -->  
              </div>
              <div class="col-12 col-sm-10">
                <div class="form-group">
                  <label for="">Country Name</label>
                  <input type="text" class="form-control" id="country_name" name="country" >
                  @error('country')<span class="text-red-700">{{$message}}  </span>@enderror
                </div>
                <!-- /.form-group -->  
              </div>
            <div class="col-12 col-sm-10">
                <div class="form-group">
                  <label for="">Date</label>
                  <input type="date" class="form-control" required id="curr_date" name="currency_date" >
                  @error('currency_date')<span class="text-red-700">{{$message}}  </span>@enderror
                </div>
                <!-- /.form-group -->  
              </div>
               <div class="col-12 col-sm-10">
              <div class="form-group">
                <label for="">Flag Icon</label>
                 <input type="text" hidden class="form-control" id="image" name="old_image" >
                  <input type="file" class="form-control" id="" name="image">
                <img src="" height="50px" id="my_image" width="50px" alt="" title="">
                @error('image')<span class="text-red-700">{{$message}}  </span>@enderror
              </div>
              <!-- /.form-group -->  
            </div>
           <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
           <button type="submit" class="btn btn-primary">Save</button>
          </div>
           </div>
      <!-- /.modal-content -->
        </form>
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.Add modal  End-->
  </div> </div></div>
  <!-- /.modal -->
  <script src="{{url('plugins/jquery/jquery.min.js')}}" ></script>
  <script>
        $('.edit_silder').click(function(e) {
        e.preventDefault();
        $('#curr_name').val($(this).data('currency_name'));
          $('#country_name').val($(this).data('country'));
        
        $('#curr_id').val($(this).data('currency_id'));
        $('#curr_price').val($(this).data('currency_price'));
        $('#curr_date').val($(this).data('date'));
          $('#image').val($(this).data('icon'));
        image =$(this).data('icon');
        var source = "{!! asset('storage/currency/"+image+"') !!}";
        $('#my_image').attr('src', source);
    })
  </script>
  </x-app-layout>