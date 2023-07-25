<x-app-layout>
    @section('title')
    Slider
    @endsection
    <link rel="stylesheet" href="{{url('plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{url('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
    <script src="{{asset('plugins/jquery/jquery.min.js')}}" ></script>
      <div class="content-wrapper">
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>DataTables</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">DataTables</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
      
      <div class="card">
        <form action="{{url('change_currency_rate')}}" id="form_id"  method="POST">
          @csrf
        <div class="card-header">
          <h3 class="card-title">Country</h3>
          <div class="col-md-6">
            <div class="form-group">
              <label>Select Country</label>
              <select class="curr form-control select2 " name="cat_id" id="country" onchange="chnagecurrency()" style="width: 100%;">
                <option selected="selected">Select Country</option>
                @foreach($Currency as $country )
                <option value="{{$country->id}}">{{$country->country}}</option>
                @endforeach
              </select>
              @error('cat_id')<span class="text-red-700">{{$message}}  </span>@enderror
            </div>
          </div>
        </div>
      </form>
         <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Widgets</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Widgets</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <h5 class="mb-2">Info Box</h5>
 
  

      

        <!-- =========================================================== -->
      
        <div class="row">

          @foreach($products as $item)
              
        
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box shadow">
              <span class="info-box-icon bg-warning"><i class="far fa-copy"></i></span>
              <a href="{{url('product_view/'.$item->slug)}}">
              <div class="info-box-content">
                <span class="info-box-text">{{$item->name}}</span>
                {{-- @dd(session('data')->name); --}}
                @if(Session::has('data'))
                @php $rate= $item->orignal_price/session('data')->price ;
                $ff= intval($rate);
                 @endphp
                <span class="info-box-number price">{{$ff}}  {{session('data')->name}} </span>
         {{-- {{session('data')[0]->id}} --}}
                     @else
         <span class="info-box-number price">{{$item->orignal_price}}</span>
                @endif
               
              </div>
              <!-- /.info-box-content -->
            </div> </a>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
       
          @endforeach
  
        </div>
        <!-- /.row -->
    </div>
    <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
  </div>   </div>   </div>   </div> 


   
    <script>
   
  //  $('.curr').on('change', function() {

    function chnagecurrency(){
        // $('#form_id').submit()  
      
        let _url = `{!! url('/change_currency_rate/') !!}`;
        $.ajaxSetup({
          headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
          });
          var id=$('#country').val();
        $.ajax({
            url: _url,
            type: 'POST',
            data: {id:id},
            success: function(data) {
              location.reload();
              // var valu=item_price/data.price;

        
            },
        });
      }
    </script>
    </x-app-layout>