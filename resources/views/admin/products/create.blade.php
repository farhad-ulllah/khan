
<x-app-layout>
  @section('title')
  Create Product
  @endsection
 
    <link rel="stylesheet" href="{{url('plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{url('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
    <script src="{{url('plugins/jquery/jquery.min.js')}}" ></script>
   
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js"></script> --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery-tagsinput/1.3.6/jquery.tagsinput.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-tagsinput/1.3.6/jquery.tagsinput.min.js"></script>
                      <script>
        // window.onbeforeunload = function(event) {
        //     return confirm("Confirm refresh");
        // };
    </script>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>Add Product</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">Add Product</li>
                </ol>
                <button type="button" class="btn btn-tool bg-primary" data-toggle="modal" data-target="#modal-default">
                  Add Category
                </button>
&nbsp;
                <button type="button" class="btn btn-tool bg-primary" data-toggle="modal" data-target="#modal-brand">
                  Add Brand
                </button>
              </div>
            </div>
          </div><!-- /.container-fluid -->
        </section>
        <div class="col-md-6">
          <div class="form-group">
            <label>Select Product</label>
            <select class="form-control select2" name="pro_id" id="pro" onchange="getProduct()" style="width: 100%;">
              <option selected="selected">Select Product</option>
              @foreach($product as $pro )
              <option value="{{$pro->id}}">{{$pro->name}}</option>
              @endforeach
            </select>
            @error('cat_id')<span class="text-red-700">{{$message}}  </span>@enderror
          </div>
        </div>
          <div class="col-12 col-sm-12">
            <div class="card card-primary card-outline card-outline-tabs">
              <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-four-general-tab" data-toggle="pill" href="#custom-tabs-four-general" role="tab" aria-controls="custom-tabs-four-general" aria-selected="true">General</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-four-features-tab" data-toggle="pill" href="#custom-tabs-four-features" role="tab" aria-controls="custom-tabs-four-features" aria-selected="false">Features</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-four-attribute-tab" data-toggle="pill" href="#custom-tabs-four-attribute" role="tab" aria-controls="custom-tabs-four-attribute" aria-selected="false">Attributes</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-four-gallery-tab" data-toggle="pill" href="#custom-tabs-four-gallery" role="tab" aria-controls="custom-tabs-four-gallery" aria-selected="false">Gallery</a>
                  </li>
                  {{-- <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-four-videos-tab" data-toggle="pill" href="#custom-tabs-four-videos" role="tab" aria-controls="custom-tabs-four-videos" aria-selected="false">Vidoe</a>
                  </li> --}}
           
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-four-filters-tab" data-toggle="pill" href="#custom-tabs-four-filters" role="tab" aria-controls="custom-tabs-four-filters" aria-selected="false">Filters</a>
                  </li>
                         
                
                </ul>
                
              </div>
              <div class="card-body">
         <form action="{{route('products.store')}}" method="POST" enctype="multipart/form-data">
                      @csrf
                <div class="tab-content" id="custom-tabs-four-tabContent">
                  <div class="tab-pane fade show active" id="custom-tabs-four-general" role="tabpanel" aria-labelledby="custom-tabs-four-general-tab">
       
                  <div class="row">
      

                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Category</label>
                      <select class="form-control select2" name="cat_id" id="cat_id" style="width:100%;" required="true">
                        <!--<option value="0">Select Category</option>-->
                        @foreach($category as $item )
                        <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                      </select>
                      @error('cat_id')<span class="text-red-700" style="color:red;">{{$message}}  </span>@enderror
                    </div>
                  </div>
                    <!-- /.form-group -->
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" required class="form-control" value="{{old('name')}}" id="product_name" placeholder="Enter Name">
                       @error('name')<span class="text-red-700" style="color:red;">{{$message}}  </span>@enderror
                      </div>
                    </div>
             
                      <!--<div class=" col-sm-6">-->
                      <!--  <div class="form-group">-->
                      <!--    <label for="exampleInputEmail1">Small Description</label>-->
                      <!--    <textarea type="text" class="form-control" id="small_desc" name="small_description" value="{{old('small_description')}}" placeholder="Enter Small Desc"></textarea>-->
                      <!--  </div>-->
                      <!--</div>-->
                        <div class="col-12 col-sm-12">
                          <div class="form-group">
                            <label for="exampleInputEmail1"> Description</label>
                            <textarea id="editor1" type="text" class="form-control" id="desc" name="description" value="{{old('description')}}" placeholder="Enter Small Description"></textarea>
                          </div>
                        </div>
                    <!-- /.form-group -->
                    <div class="col-md-6">
                    <div class="form-group">
                      <label>Brands</label>
                      <select class="form-control select2" name="brand_id" required="true" id="brand_id" value="{{old('brand_id')}}" style="width: 100%;">
                        <!--<option value="0">Select Brand</option>-->
                        @foreach($brands as $brand )
                        <option value="{{$brand->id}}">{{$brand->brand_name}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                     <!-- /.col -->
                     <div class="col-12 col-sm-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Orignal Price</label>
                        <input type="number" class="form-control" id="orignal_price" name="price" value="{{old('price')}}" placeholder="Orignal Price">
                        </div>
                      </div>
                      <!-- /.form-group -->
                      <div class="col-12 col-sm-6">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Selling Price</label>
                          <input type="text" class="form-control" id="selling" name="selling_price" value="{{old('selling_price')}}" placeholder="Enter Small Desc">
                        </div>
                        <!-- /.form-group -->
                      </div>
                      <!--<div class="col-12 col-sm-6">-->
                      <!--  <div class="form-group">-->
                      <!--    <label for="exampleInputEmail1">Tax</label>-->
                      <!--    <input type="number" class="form-control" id="tax" name="tax" value="{{old('tax')}}" placeholder="Tax">-->
                      <!--    </div>-->
                      <!--  </div>-->
                      <!--  <div class="col-12 col-sm-6">-->
                      <!--    <div class="form-group">-->
                      <!--      <label for="exampleInputEmail1">Quantity</label>-->
                      <!--      <input type="number" class="form-control" id="quan" name="quantity" value="{{old('quantity')}}" placeholder="Enter Quantity">-->
                      <!--    </div>-->
                      <!--  </div>-->
             
                         
                       <!-- /.form-group -->
                      <!-- <div class="col-md-6">-->
                      <!--  <div class="form-group">-->
                      <!--    <label>Video Host</label>-->
                      <!--    <select class="form-control select2" name="video_host" id="video_host" value="{{old('video_host')}}"  style="width: 100%;">-->
                      <!--      <option selected="selected">Youtubet</option>-->
                      <!--      </select>-->
                      <!--  </div>-->
                      <!--</div>-->
                     
                      <div class="col-12 col-sm-6">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Youtube Video Link</label>
                          <input type="text" class="form-control" id="video_link" name="video_link" value="{{old('video_link')}}"  placeholder="Video Link">
                          </div>
                        </div>
                               <div class="col-10 col-sm-6">
                                    <div class="form-group">
                                      <label>Ram</label>
                                    <input type="text"  class="form-control" id="" placeholder="Enter Ram" name="ram">
                                    @error('ram')<span class="text-red-700" style="color:red;">{{$message}}  </span>@enderror
                                    </div>
                                  </div>
                                          <div class="col-10 col-sm-6">
                                    <div class="form-group">
                                      <label>Battery</label>
                                    <input type="text" class="form-control" placeholder="Enter Alt Image" id="" name="battery">
                                    @error('alt_image')<span class="text-red-700" style="color:red;">{{$message}}  </span>@enderror
                                    </div>
                                  </div>
                                   <div class="col-10 col-sm-6">
                                    <div class="form-group">
                                      <label>Storage</label>
                                    <input type="text" class="form-control" placeholder="Enter Alt Image" id="" name="storage">
                                    @error('storage')<span class="text-red-700" style="color:red;">{{$message}}  </span>@enderror
                                    </div>
                                  </div>
                                <div class="col-12 col-sm-6">
                                  <div class="form-group">
                                    <label for="exampleInputEmail1">Tag</label>
                                    <input type="text"  id="input-tags" style="width:500px !important" class="form-control" value="{{old('tag')}}"  name="tag" placeholder="Enter Tag">
                                    </div>
                                  </div>
                             
                               
                            
                                  <div class="col-10 col-sm-3">
                                    <div class="form-group">
                                      <label>Upload Image</label>
                                    <input type="file" required class="form-control" id="" name="image">
                                    @error('image')<span class="text-red-700" style="color:red;">{{$message}}  </span>@enderror
                                    </div>
                                  </div>
                                          <div class="col-10 col-sm-3">
                                    <div class="form-group">
                                      <label>Alt  Image Title</label>
                                    <input type="text" class="form-control" placeholder="Enter Alt Image" id="" name="alt_image">
                                    @error('alt_image')<span class="text-red-700" style="color:red;">{{$message}}  </span>@enderror
                                    </div>
                                  </div>
                                  <div class="col-10 col-sm-4">
                                    <label style="">Mobiles</label>
                                    <div class="form-group">
                                     
                                      <div class="form-group  d-inline">
                                        <label for="checkboxDanger1">  Popular  <input type="checkbox" id="popular" value="{{old('popular')}}"  name="popular"></label>&nbsp;
                                      </div>&nbsp;
                               
                                    <div class="form-group  d-inline">
                                    <label for="checkboxDanger2">Trending  <input type="checkbox" id="trending" name="trending" value="{{old('trending')}}"></label>
                                </div>&nbsp;
                             
                                  <div class="form-group  d-inline">
                                  <label for="checkboxDanger2">Upcoming   <input type="checkbox" id="upcoming" name="upcoming" value="{{old('upcoming')}}">
                                    </label>
                                </div>&nbsp;
                             
                                    </div>
                                  </div>
                
                         <div class="col-10 col-sm-6">
                                    <div class="form-group">
                                      <label>Ram/Storage 4/16</label>
                                    <input type="text"  class="form-control" id="" placeholder="Enter Ram Storage 4/16" name="ram_storage1">
                                    @error('ram_storage3')<span class="text-red-700" style="color:red;">{{$message}}  </span>@enderror
                                    </div>
                                  </div>
                                       <div class="col-10 col-sm-6">
                                    <div class="form-group">
                                      <label>Ram/Storage 4/16 Price</label>
                                    <input type="text"  class="form-control" id="" placeholder="Enter Ram Storage 4/16 Price" name="ram_storage1_price">
                                    @error('ram_storage1_price')<span class="text-red-700" style="color:red;">{{$message}}  </span>@enderror
                                    </div>
                                  </div>
                                          <div class="col-10 col-sm-6">
                                    <div class="form-group">
                                      <label>Ram/Storage 4/32</label>
                                    <input type="text" class="form-control" placeholder="Enter Ram Storage 4/32" id="" name="ram_storage2">
                                    @error('ram_storage3')<span class="text-red-700" style="color:red;">{{$message}}  </span>@enderror
                                    </div>
                                  </div>
                                    <div class="col-10 col-sm-6">
                                    <div class="form-group">
                                      <label>Ram/Storage 4/32 Price</label>
                                    <input type="text" class="form-control" placeholder="Enter Ram Storage 4/32 Price" id="" name="ram_storage2_price">
                                    @error('ram_storage2_price')<span class="text-red-700" style="color:red;">{{$message}}  </span>@enderror
                                    </div>
                                  </div>
                                   <div class="col-10 col-sm-6">
                                    <div class="form-group">
                                      <label>Ram/Storage 4/64</label>
                                    <input type="text" class="form-control" placeholder="Enter Ram Storage 4/64" id="" name="ram_storage3">
                                    @error('ram_storage3')<span class="text-red-700" style="color:red;">{{$message}}  </span>@enderror
                                    </div>
                                  </div>
                                 <div class="col-10 col-sm-6">
                                    <div class="form-group">
                                      <label>Ram/Storage 4/64 PRice</label>
                                    <input type="text" class="form-control" placeholder="Enter Ram Storage 4/64 Price" id="" name="ram_storage3_price">
                                    @error('ram_storage3_price')<span class="text-red-700" style="color:red;">{{$message}}  </span>@enderror
                                    </div>
                                  </div>
                             <hr>
                                  <div class="card card-default" style="width: 100%;" >
                                    <div class="card-header "style="background-color:#ADD8E6;">
                                      <h3 class="card-title">Text Fields For SEO </h3>
                          
                                      <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                          <i class="fas fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                                          <i class="fas fa-times"></i>
                                        </button>
                                      </div>
                                    </div>
                                    <div class="card-body shadow">
                                      <div class="row">
                                   <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                      <label for="exampleInputEmail1">Meta title</label>
                                      <input type="text" class="form-control" id="meta_title" value="{{old('meta_title')}}"  name="meta_title" placeholder="meta Title">
                                      </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                      <div class="form-group">
                                        <label for="exampleInputEmail1">Meta Description</label>
                                        <textarea type="text" class="form-control" id="meta_desc" name="meta_description" value="{{old('meta_description')}}" placeholder="meta Description"></textarea>
                                        </div>
                                      </div>
                              
                                  
                                      <div class="col-sm-6">
                                        <div class="form-group">
                                          <label for="exampleInputEmail1">Focus Key Phrases</label>
                                          <input type="text" class="form-control" id="meta_keyqord" name="meta_keywords" value="{{old('meta_keywords')}}" placeholder="Focus Key Phrases">
                                          </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                          <div class="form-group">
                                            <label for="exampleInputEmail1">Slug</label>
                                            <input type="text" class="form-control" id="slug" name="slug"  value="{{old('slug')}}" tag placeholder="Enter Slug"> @error('slug')<span class="text-red-700" style="color:red;">{{$message}}  </span>@enderror
                                          </div>
                                        </div>
                                 
                                    </div>  </div>   </div>
                   <!-- /.form-group -->
                  </div>
                
                </div>
          {{-- GEneral Form End  --}}
          <script type="text/javascript">
            $('#input-tags').tagsInput();
          </script>
                    <div class="tab-pane fade" id="custom-tabs-four-features" role="tabpanel" aria-labelledby="custom-tabs-four-features-tab">
                      <!--<form action="{{route('StoreProductFeatures')}}"  method="POST" enctype="multipart/form-data">-->
                      <!--  @csrf-->
                      <!--  <input type="text"   name="f_product_id" value="{{$product_id}}" hidden  id="f_product_id">-->
                      <div class="row">
                    @foreach($features as $feat)
                      <div class="col-12 col-sm-6">
                    <div class="form-group form-">
                      <label for="exampleInputEmail1">{{$feat->feature_name}}</label>
                      <input type="text" class="form-control " id="pro_feature" name="feature[{{$feat->id}}]" placeholder="Enter {{$feat->feature_name}}">
                      </div>
                    </div>
                    @endforeach
            
                    <!--<div class="form-group float-right">-->
                                              
                    <!--  <input type="Submit" class="form-control bg-success float-right"  id="" >-->
                    <!--  </div>-->
                      </div>
                    <!--</form>-->
              </div>
                  {{-- Features End --}}
                  <div class="tab-pane fade" id="custom-tabs-four-gallery" role="tabpanel" aria-labelledby="custom-tabs-four-gallery-tab">
                    <!--<form action="{{route('productsGalleryStore')}}" method="POST" enctype="multipart/form-data">-->
                    <!--  @csrf-->
                    <div class="col-md-9 ">
                        <!--<input type="number" name="g_product_id" hidden value="{{$product_id}}"  id="g_product_id">-->
                      
                      <div class="form-group form-group">
                        <label for="exampleInputEmail1">Image Title</label>
                        <input type="text" class="form-control" placeholder="Image Title" name="image_title" />
                        </div>
                      </div>
                      
                 <div class="col-md-9 ">
                  <div class="form-group form-">
                    <label for="exampleInputEmail1">Upload Multiple Image</label>
                    <input type="file" multiple name="images[]" />
                    @error('images')<span class="text-red-700" style="color:red;">{{$message}}  </span>@enderror
                    </div>
                    <span>Select Multiple Images It Once</span>
                  </div>
                <!--  <div class="form-group float-right">-->
                                              
                <!--    <input type="Submit" class="form-control bg-success float-right"  id="" >-->
                <!--    </div>-->
                <!--</form>-->
                  </div>
                     <div class="tab-pane fade" id="custom-tabs-four-filters" role="tabpanel" aria-labelledby="custom-tabs-four-filters-tab">
                      <!--<form action="{{route('productsFiltersStore')}}" method="POST" enctype="multipart/form-data">-->
                      <!--  <input type="number"  name="fil_product_id" hidden id="fil_product_id" value="{{$product_id}}" >-->
                      <!--  @csrf-->
                      @foreach($filters as $filter)
                      <div class="col-12 col-sm-8">
                        <label for="">{{$filter->filter_name}} :</label>

                        <div class="icheck-danger ">
                          @foreach($filter->filter_value as $value)
                          <label for="">{{$value->filter_value}}</label>

                            <input type="checkbox" id="" value="{{$value->filter_value}}" name="filter_value[{{$value->id}}][{{$filter->id}}]">&nbsp;&nbsp;
                        @endforeach
                         
                          </div>
                  </div><hr>
                    @endforeach
      <div class="form-group float-right">    
                      <input type="Submit" class="form-control bg-success float-right"   id="" >
                      </div>
        
            

               {{-- End Feature --}}
                </div>
                  {{-- Statrt Atribut --}}
                  <div class="tab-pane fade" id="custom-tabs-four-attribute" role="tabpanel" aria-labelledby="custom-tabs-four-attribute-tab">
                    <!--<form action="{{route('productsattributes')}}" method="POST" enctype="multipart/form-data">-->
                    <!--  <input type="number"  name="g_product_id" hidden id="g_product_id" value="{{$product_id}}" >-->
                    <!--  @csrf-->
                    <div class="row">
                   
                      <div class="col-5 col-sm-3">
                        <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
                          @foreach($groups as $value)
                          <a class="nav-link " id="vert-tabs-{{$value->id}}-tab" data-toggle="pill" href="#vert-tabs-{{$value->id}}" role="tab" aria-controls="vert-tabs-home" aria-selected="true">{{$value->name}}</a>
                          {{-- <input type="text" class="form-control" id="" value="{{$value->id}}" name="group_{{$value->id}}" > --}}
                          @endforeach
                        </div>
                      </div>
                      <div class="col-7 col-sm-9">
                        <div class="tab-content" id="vert-tabs-tabContent">
                          @foreach($groups as $value)
                          <div class="tab-pane text-left fade " id="vert-tabs-{{$value->id}}" role="tabpanel" aria-labelledby="vert-tabs-{{$value->id}}-tab">
                            <input type="text" class="form-control" id="" hidden value="{{$value->id}}" name="group_id[]" >
                            @foreach($value->values as $val )
                            <label class="row">{{$val->value}}</label>
                            <div class="form-group form-">
                             
                              <input type="text" class="form-control" id="" hidden value="{{$val->id}}" name="attribute_id[{{$value->id}}]" >
                              <input type="text" class="form-control" id="" name="attribute_val[{{$value->id}}][{{$val->id}}]" placeholder="Enter  {{$val->value}}">
                              </div>
                           @endforeach
                          </div>
                          @endforeach
                      
                          {{--  --}}
                        </div>
                      </div>
                    </div>
                    
                    </form>
                 </div>
                 {{-- End  Attribute--}}
           
              </div>
              <!-- /.card -->
            </div>
          </div>
    
          <div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Add \Category</h4>
                <button type="button" id="close" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                  <form action="{{route('category.store')}}" method="POST" enctype="multipart/form-data">

                      @csrf
                            <!-- /.col -->
                            <div class="row">
                              <!-- /.col -->
                                <div class="col-12 col-sm-12">
                                  <div class="form-group">
                                    <label for="exampleInputEmail1">Category Name</label>
                                    <input type="text" class="form-control" name="cat_name" id="cat_name" placeholder="Enter Name">
                                  </div>
                                  </div>
                                  <div class="col-12 col-sm-12">
                                      <div class="form-group">
                                        <label for="exampleInputEmail1"> Description</label>
                                        <textarea type="text" class="form-control" name="cat_desc" id="exampleInputEmail1" placeholder="Enter Small Description"></textarea>
                                      </div>
                                      </div>
                                      <div class="col-12 col-sm-12">
                                        <div class="form-group">
                                          <label for="exampleInputEmail1">Image</label>
                                          <input type="file" class="form-control" name="image" id="exampleInputEmail1" >
                                          @error('image')<span class="text-red-700">{{$message}}  </span>@enderror  
                                        </div>
                                        </div>
                                        <div class="col-12 col-sm-12">
                                          <div class="form-group">
                                            <label>Alt  Image Title</label>
                                          <input type="text" class="form-control" id="" name="alt_image" placeholder="Alt Image">
                                          @error('alt_image')<span class="text-red-700" style="color:red;">{{$message}}  </span>@enderror
                                          </div>
                                        </div>
              
                                      <hr>
                                      <div class="card card-default " style="width: 100%;" >
                                        <div class="card-header " style="background-color:#ADD8E6;">
                                          <h3 class="card-title">Text Fields For SEO </h3>
                              
                                          <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                              <i class="fas fa-minus"></i>
                                            </button>
                                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                              <i class="fas fa-times"></i>
                                            </button>
                                          </div>
                                        </div>
                                              <div class="card-body shadow">
                                                <div class="row">
                                             <div class="col-12 col-sm-6">
                                              <div class="form-group">
                                                <label for="exampleInputEmail1">Meta title</label>
                                                <input type="text" class="form-control" name="cat_met_title" id="meta_title" placeholder="meta Title">
                                              </div>
                                              </div>
                                              <div class="col-12 col-sm-6">
                                                <div class="form-group">
                                                  <label for="exampleInputEmail1">Meta Description</label>
                                                  <textarea type="text" class="form-control" name="cat_met_desc" id="" placeholder="meta Description"></textarea>
                                                </div>
                                                </div>
                                        
                                            
                                                <div class="col-sm-6">
                                                  <div class="form-group">
                                                    <label for="exampleInputEmail1">Focus Key Phrases</label>
                                                    <input type="text" class="form-control" name="cat_met_keyword" id="exampleInputEmail1" placeholder="meta Keywords">
                                                  </div>
                                                  </div>
                                                  <div class="col-sm-6">
                                                    <div class="form-group">
                                                      <label for="exampleInputEmail1">Slug</label>
                                                      <input type="text" class="form-control" name="cat_slug" id="cat_slug"  placeholder="Enter Slug">
      
                                                      </div>
                                                    </div>
                                           
                                              </div>  </div> 
                                                  <div class="form-group">
                        
                                  <input type="Submit" class="form-control bg-success"  id="" >
                                  </div>
                                              
                                              </div>
                                    
                                             
                            
                                </div>
                              </form>
                                  </div>
                                </div>
                              </div> </div> 
                               {{-- Categro Model End --}}
                             <div class="modal fade" id="modal-brand">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h4 class="modal-title">Add Brand</h4>
                                      <button type="button" id="close" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{route('brands.store')}}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            
                                            <div class="row">
                                              <!-- /.col -->
                                                <div class="col-12 col-sm-12">
                                                  <div class="form-group">
                                                    <label for="exampleInputEmail1">Brand Name</label> 
                                                    <input type="text" class="form-control" name="brand_name" required id="brand_name" placeholder="Enter Name">
                                                    </div>
                                                  </div>
                                       
                                                  <div class="col-12 col-sm-12">
                                                      <div class="form-group">
                                                        <label for="exampleInputEmail1"> Description</label>
                                                        <textarea type="text" class="form-control" name="brand_desc" id="" placeholder="Enter Small Description"></textarea>
                                                        </div>
                                                      </div>
                                                      <div class="col-12 col-sm-12">
                                                        <div class="form-group">
                                                          <label for="exampleInputEmail1">Image</label>
                                                          <input type="file" class="form-control" name="image" id="" >
                                                          @error('image')<span class="text-red-700">{{$message}}  </span>@enderror  
                                                          </div>
                                                        </div>
                                                        <div class="col-10 col-sm-12">
                                                          <div class="form-group">
                                                            <label>Alt  Image Title</label>
                                                          <input type="text" class="form-control" id="" name="alt_image" placeholder="Alt Image">
                                                          @error('alt_image')<span class="text-red-700" style="color:red;">{{$message}}  </span>@enderror
                                                          </div>
                                                        </div>
                                                      <hr>
                                                      <div class="card card-default " style="width: 100%;" >
                                                        <div class="card-header " style="background-color:#ADD8E6;">
                                                          <h3 class="card-title">Text Fields For SEO </h3>
                                              
                                                          <div class="card-tools">
                                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                              <i class="fas fa-minus"></i>
                                                            </button>
                                                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                                              <i class="fas fa-times"></i>
                                                            </button>
                                                          </div>
                                                        </div>
                                                              <div class="card-body shadow">
                                                                <div class="row">
                                                             <div class="col-12 col-sm-6">
                                                              <div class="form-group">
                                                                <label for="exampleInputEmail1">Meta title</label>
                                                                <input type="text" class="form-control" name="meta_title" required id="meta_title" placeholder="meta Title">
                                                                </div>
                                                              </div>
                                                              <div class="col-12 col-sm-6">
                                                                <div class="form-group">
                                                                  <label for="exampleInputEmail1">Meta Description</label>
                                                                  <textarea type="text" class="form-control" name="meta_description" id="" placeholder="meta Description"></textarea>
                                                                  </div>
                                                                </div>
                                                        
                                                            
                                                                <div class="col-sm-6">
                                                                  <div class="form-group">
                                                                    <label for="exampleInputEmail1">Focus Key Phrases</label>
                                                                    <input type="text" class="form-control" name="meta_keyword" id="" placeholder="Focus Key Phrases">
                                                                    </div>
                                                                  </div>
                                                                  <div class="col-12 col-sm-6">
                                                                    <div class="form-group">
                                                                      <label for="exampleInputEmail1">Brand SLug</label>
                                                                      <input type="text" class="form-control" name="brand_slug"  id="brand_slug" placeholder="Enter SLug" >
                                                                      </div>
                                                                    </div>
                                                           
                                                              </div>  </div>   </div>
                                                              <div class="form-group">
                        
                                                                <input type="Submit" class="form-control bg-success"  id="" >
                                                                </div>
                                                    </form>
                                                        </div>
                                                      </div>
                                                    </div> </div> 
              <!-- /.card -->
 
              <script>
              
               function getProduct() {
        let _url = `{!!url('/getProductdetailbyid/')!!}` + '/' + $('#pro').val();
        $.ajax({
            url: _url,
            type: 'GET',
            success: function (data) {
              console.log(data.features);
              put_features(data.features);
                $('#product_id').val(data.id);
                $('#f_product_id').val(data.id);
                $('#g_product_id').val(data.id);
                $('#v_product_id').val(data.id);
                $('#fil_product_id').val(data.id);
                $('#product_name').val(data.name);
                $('#cat_id').val(data.cat_id).trigger('change');
                $('#brand_id').val(data.brand_id).trigger('change');
                $('#video_host').val(data.video_host).trigger('change');
                $('#meta_title').val(data.meta_title);
                $('#meta_desc').val(data.meta_description);
                $('#small_desc').val(data.small_description);
                $('#desc').val(data.description);
                $('#orignal_price').val(data.orignal_price);
                $('#selling').val(data.selling_price);
                $('#tax').val(data.tax);
                $('#quan').val(data.qty);
                $('#meta_keyqord').val(data.meta_keywords);
                $('#slug').val(data.slug);
                $('#video_link').val(data.video_link);
                if(data.popular==1){
                  $('#popular').attr('checked',true);
                }else{
                  $('#popular').attr('checked',false);
                }
                    if(data.trending==1){
                  $('#trending').attr('checked',true);
                }else{
                  $('#trending').attr('checked',false);
                }
                if(data.upcoming==1){
                  $('#upcoming').attr('checked',true);
                }else{
                  $('#upcoming').attr('checked',false);
                }
              
                // data.features.forEach(element => {
                  
                //   $('#pro_feature').val(element.feature_value);
         
                // });
                
                // getEmployeeData();
                // getEmployeeExperience();
            }
        });
    }
    function put_features(data){
      $('#pro_feature').val(data.feature_value);
      }
              </script>
    <script>
     $('#product_name').keyup(function(e){
        var title=$('#product_name').val();
        $.get('{{url('check_slug')}}',
        {'name':$('#product_name').val()},
        function(data){
          $('#slug').val(data.slug);
          $("#meta_title").val(title);
        }
        );

      });
    </script>
      <script>
        $('#brand_name').keyup(function(e){
        
          $.get('{{url('check_brand_slug')}}',
          {'brand_name':$('#brand_name').val()},
          function(data){
            $('#brand_slug').val(data.brand_slug);
          }
          );
  
        });
      </script>
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
             <script src="{{url('plugins/jquery/jquery.min.js')}}" ></script>
        <script src="https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>
        {{-- <script src="{{url('ckfinder/ckfinder.js')}}"></script> --}}
        
        <script>
// var onReloadCheck = function () {
//         $(window).on('beforeunload', function () {
//          return confirm("Confirm refresh");
//         });
//     }
          CKEDITOR.replace( 'editor1' ,{
              filebrowserUploadUrl:"{{ route('ckProduct.upload',['_token'=> csrf_token()])}}",
              filebrowserUploadMethod:"form"
          });
          $("selector").dialog({
      //parameters
      }).fadeIn(300);
      setTimeout(function(){CKEDITOR.replace('ckedt-hiddenForms')},350);
      </script>
            </x-app-layout>