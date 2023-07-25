<x-app-layout>
  @section('title')
  Product
  @endsection
    <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Products</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Products</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">All Products</h3>
        <div class="card-tools">
          <a href="{{route('products.create')}}"> <button type="button" class="btn btn-primary " >
            Create Product
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
        <table id="example1" class="table table-bordered table-striped">
          <thead>
          <tr>
            <th>Name</th>
            <th>Category</th>
            <th>Price</th>
            <th>Brand</th>
            <th>Clicks</th>
            <th>Image</th>
            <th>Duplicate</th>
            <th>Action</th>
          </tr>
          </thead>
          <tbody>
            @foreach($products->sortBy('id') as $item)
          <tr>
            <td>{{$item->name}}</td>
            <td>{{$item->category->name}}</td>
            <td>{{$item->orignal_price}}</td>
            <td>{{$item->brands->brand_name}}</td>
            <td>{{$item->click_count}}</td>
            <td><img src="{{ asset('storage/product/'.$item->image) }}" height="50px" width="50px" alt="" title="">
            </td>
            <td><a href="{{url('duplicate_product/'.$item->id)}}" class="btn btn-primary">Duplicate </a></td>
            <td>  
             
              <div class="row"> 
                @if(auth()->user()->permission('edit products')) 
               <a href="{{ URL::to('products/' . $item->id . '/edit')}}" class="">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                </svg>
            </a>
            @endif
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          @if(auth()->user()->permission('delete products')) 
          <form action="{{ route('products.destroy', $item->id)}}" method="post">
            @csrf
            @method('DELETE')
            <button class="" type="submit" onclick="return confirm('Are you sure to delete this?')"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
              <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
              <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
            </svg></button>
          </form>
         @endif
          </div>
          </td>
          </tr>
          @endforeach
          </tbody>
          <tfoot>
          <tr>
            <th>Name</th>
            <th>Category</th>
            <th>Price</th>
            <th>Brand</th>
            <th>Clicks</th>
            <th>Image</th>
            <th>Duplicate</th>
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
  
  </x-app-layout>