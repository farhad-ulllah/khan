<x-app-layout>
  @section('title')
  Duplicate Product
  @endsection
  <link rel="stylesheet" href="{{url('plugins/select2/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{url('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
  <script src="{{url('plugins/jquery/jquery.min.js')}}" ></script>
    <!-- Content Wrapper. Contains page content -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery-tagsinput/1.3.6/jquery.tagsinput.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-tagsinput/1.3.6/jquery.tagsinput.min.js"></script>
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Duplicate Product</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Duplicate  Product</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
          <form action="{{url('add_duplicate')}}"  method="POST" enctype="multipart/form-data">
                    @csrf
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
                  <a class="nav-link" id="custom-tabs-four-gallery-tab" data-toggle="pill" href="#custom-tabs-four-gallery" role="tab" aria-controls="custom-tabs-four-gallery" aria-selected="false">Gallery</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="custom-tabs-four-videos-tab" data-toggle="pill" href="#custom-tabs-four-videos" role="tab" aria-controls="custom-tabs-four-videos" aria-selected="false">Vidoe</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="custom-tabs-four-attribute-tab" data-toggle="pill" href="#custom-tabs-four-attribute" role="tab" aria-controls="custom-tabs-four-attribute" aria-selected="false">Attributes</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="custom-tabs-four-filters-tab" data-toggle="pill" href="#custom-tabs-four-filters" role="tab" aria-controls="custom-tabs-four-filters" aria-selected="false">Filters</a>
                </li>
                  <li class="nav-item">
                  <input type="submit" class="nav-link bg-primary" id="custom-tabs-four--tab"   href="#" role="tab" aria-controls="custom-tabs-four-filters" aria-selected="false">
                </li>
              </ul>
            </div>
            <div class="card-body">
              <div class="tab-content" id="custom-tabs-four-tabContent">
                <div class="tab-pane fade show active" id="custom-tabs-four-general" role="tabpanel" aria-labelledby="custom-tabs-four-general-tab">
            
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Category</label>
                    <select class="form-control select2" name="cat_id"  style="width: 100%;">
                        <option selected="selected">Select Category</option>
                      @foreach($category as $item )
                      <option selected value="{{$item->id}}">{{$item->name}}</option>
                      <option value="{{$item->id}}" {{($item->id == $products->cat_id) ? 'Selected' : ''}}>{{$item->name}}</option>
                      @endforeach
                      @error('cat_id')<span class="text-red-700" style="color:red;">{{$message}}  </span>@enderror  
                    </select>
                  </div>
                </div>
                  <!-- /.form-group -->
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="name">Name (Product Slug Should be Unique)</label>
                      <input type="text" name="name" value="{{$products->name}}-copy" class="form-control" id="product_name" placeholder="Enter Name">
                      @error('slug')<span class="text-red-700" style="color:red;">{{$message}}  </span>@enderror  
                      <input type="number" name="dup_id" hidden value="{{$products->id}}">
                  </div>
                  </div>
                
                  <!-- /.form-group -->
                  <div class="col-md-6">
                  <div class="form-group">
                    <label>Brands</label>
                    <select class="form-control select2" value="{{$products->brand_id}}" name="brand_id" style="width: 100%;">
                      <option selected="selected">Select Brand</option>
                      @foreach($brands as $brand )
                      <option  value="{{$brand->id}}" {{($brand->id == $products->brand_id) ? 'Selected' : ''}}>{{$brand->brand_name}}</option>
                      @endforeach
                    </select>
                    @error('brand_id')<span class="text-red-700" style="color:red;">{{$message}}  </span>@enderror  
                  </div>
                </div>

                <div class="col-12 col-sm-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Small Description</label>
                    <textarea class="form-control" id="" name="small_description" value="{{$products->small_description}}"  placeholder="Enter Small Desc"></textarea>
                  </div>
                </div>

                <div class="col-12 col-sm-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1"> Description</label>
                    <textarea type="text" class="form-control" id="" name="description" value="{{$products->description}}" placeholder="Enter Small Description"></textarea>
                  </div>
                </div>

                   <!-- /.col -->
                   <div class="col-12 col-sm-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Orignal Price</label>
                      <input type="number" class="form-control" id="" value="{{$products->orignal_price}}" name="price" placeholder="Orignal Price">
                      </div>
                    </div>

                
                 
                      <div class="col-12 col-sm-6">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Quantity</label>
                          <input type="number" class="form-control" id="" name="quantity" value="{{$products->qty}}" placeholder="Enter Quantity">
                        </div>
                        <!-- /.form-group -->
                      </div>
         
                   <div class="col-10 col-sm-6">
                                    <div class="form-group">
                                      <label>Ram</label>
                                    <input type="text"  class="form-control" id="" value="{{$products->ram}}" placeholder="Enter Ram" name="ram">
                                    @error('ram')<span class="text-red-700" style="color:red;">{{$message}}  </span>@enderror
                                    </div>
                                  </div>
                                          <div class="col-10 col-sm-6">
                                    <div class="form-group">
                                      <label>Battery</label>
                                    <input type="text" value="{{$products->battery}}" class="form-control" placeholder="Enter Alt Image" id="" name="battery">
                                    @error('alt_image')<span class="text-red-700" style="color:red;">{{$message}}  </span>@enderror
                                    </div>
                                  </div>
                                   <div class="col-10 col-sm-6">
                                    <div class="form-group">
                                      <label>Storage</label>
                                    <input type="text" value="{{$products->storage}}" class="form-control" placeholder="Enter Alt Image" id="" name="storage">
                                    @error('storage')<span class="text-red-700" style="color:red;">{{$message}}  </span>@enderror
                                    </div>
                                  </div>
                  
                              <div class="col-12 col-sm-6">
                                  <div class="form-group">
                                    <label for="exampleInputEmail1">Tag</label>
                                   @php $tags=[]; @endphp;
                                    @foreach($products->tags as $tag)
                                    @php $tags=$tag->name; @endphp
                                    @endforeach 
                                    <input type="text" id="input-tags" style="width:500px !important" class="form-control" value="@foreach($products->tags as $tag) ,{{$tag->name}} @endforeach"  name="tag" placeholder="Enter Tag">
                                    
                                 
                                    </div>
                                  </div>
                         
                                <div class="col-10 col-sm-3">
                                  <label>Upload Image</label>
                                  <div class="form-group">
                                   
                                    <input type="file" required class="form-control" id=""  name="image" >
                                    <input type="text" hidden class="form-control" name="old_image1" value="{{$products->image}}" id="" >
                                    @error('image')<span class="text-red-700" style="color:red;">{{$message}}  </span>@enderror  
                                  </div>
                                </div>
                                <div class="col-10 col-sm-3">
                                  <div class="form-group">
                                    <label>Alt  Image Title</label>
                                  <input type="text" class="form-control" id="" placeholder="Edit Image" name="alt_image" value="{{$products->alt_image}}">
                                  @error('alt_image')<span class="text-red-700" style="color:red;">{{$message}}  </span>@enderror
                                  </div>
                                </div>
                                <div class="col-10 col-sm-4">
                                  <label style="">Mobiles</label>
                                  <div class="form-group">
                                   
                                    <div class="form-group  d-inline">
                                      <label for="checkboxDanger1">  Popular <input type="checkbox" id="" name="popular" {{$products->popular =='1' ? 'checked': ''}}></label>&nbsp;
                                    </div>&nbsp;
                             
                                  <div class="form-group  d-inline">
                                  <label for="checkboxDanger2">Trending <input type="checkbox" id="" name="trending" {{$products->trending =='1' ? 'checked': ''}}></label>
                              </div>&nbsp;
                           
                                <div class="form-group  d-inline">
                                <label for="checkboxDanger2">Upcoming   <input type="checkbox" id="" name="upcoming" {{$products->upcoming =='1' ? 'checked': ''}}>
                                  </label>
                              </div>&nbsp;
                           
                                  </div>
                                </div>
                                <div class="col-10 col-sm-3">
                                  <label>Image</label>
                                  <div class="form-group">
                                   
                                        {{-- <input type="file" class="form-control" id="" name="image">
                                        <input type="text" hidden class="form-control" name="old_image" value="{{$products->image}}" id="" > --}}
                                        <img src="{{ asset('storage/product/'.$products->image) }}" height="50px" width="50px" alt="" title="">
                                  </div>
                                </div>
                                 <div class="col-10 col-sm-6">
                                    <div class="form-group">
                                      <label>Ram/Storage 4/16</label>
                                    <input type="text" value="{{$products->ram_storage1}}" class="form-control" id="" placeholder="Enter Ram Storage 4/16" name="ram_storage1">
                                    @error('ram_storage3')<span class="text-red-700" style="color:red;">{{$message}}  </span>@enderror
                                    </div>
                                  </div>
                                       <div class="col-10 col-sm-6">
                                    <div class="form-group">
                                      <label>Ram/Storage 4/16 Price</label>
                                    <input type="text" value="{{$products->ram_storage1_price}}" class="form-control" id="" placeholder="Enter Ram Storage 4/16 Price" name="ram_storage1_price">
                                    @error('ram_storage1_price')<span class="text-red-700" style="color:red;">{{$message}}  </span>@enderror
                                    </div>
                                  </div>
                                          <div class="col-10 col-sm-6">
                                    <div class="form-group">
                                      <label>Ram/Storage 4/32</label>
                                    <input type="text" value="{{$products->ram_storage2}}" class="form-control" placeholder="Enter Ram Storage 4/32" id="" name="ram_storage2">
                                    @error('ram_storage3')<span class="text-red-700" style="color:red;">{{$message}}  </span>@enderror
                                    </div>
                                  </div>
                                   <div class="col-10 col-sm-6">
                                    <div class="form-group">
                                      <label>Ram/Storage 4/32 Price</label>
                                    <input type="text" value="{{$products->ram_storage2_price}}" class="form-control" placeholder="Enter Ram Storage 4/32 Price" id="" name="ram_storage2_price">
                                    @error('ram_storage2_price')<span class="text-red-700" style="color:red;">{{$message}}  </span>@enderror
                                    </div>
                                  </div>
                                   <div class="col-10 col-sm-6">
                                    <div class="form-group">
                                      <label>Ram/Storage 4/64</label>
                                    <input type="text" class="form-control" placeholder="Enter Ram Storage 4/64" id="" value="{{$products->ram_storage3}}" name="ram_storage3">
                                    @error('ram_storage3')<span class="text-red-700" style="color:red;">{{$message}}  </span>@enderror
                                    </div>
                                  </div>
                                   <div class="col-10 col-sm-6">
                                    <div class="form-group">
                                      <label>Ram/Storage 4/64 Price</label>
                                    <input type="text" class="form-control" placeholder="Enter Ram Storage 4/64 Price" id="" value="{{$products->ram_storage3_price}}" name="ram_storage3_price">
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
                                      <input type="text" class="form-control" id="" name="meta_title" value="{{$products->meta_title}}" placeholder="meta Title">                                    </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                      <div class="form-group">
                                        <label for="exampleInputEmail1">Meta Description</label>
                                        <textarea type="text" class="form-control" id="" name="meta_description"  value="{{$products->meta_description}}" placeholder="meta Description"></textarea>
                                      </div>
                                      </div>
                              
                                  
                                      <div class="col-sm-6">
                                        <div class="form-group">
                                          <label for="exampleInputEmail1">Focus Key Phrases</label>
                                          <input type="text" class="form-control" id="" name="meta_keywords" value="{{$products->meta_keywords}}" placeholder="Meta Keywords">
                                        </div>
                                        </div>
                                        <div class="col-md-6">
                                          <div class="form-group">
                                            <label for="exampleInputEmail1">Sulg</label>
                                            <input type="text" class="form-control" id="slug" name="slug" value="{{$products->slug}}-copy"  placeholder="Enter Slug">
                                            @error('slug')<span class="text-red-700" style="color:red;">{{$message}}  </span>@enderror  
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
                  <div class="row">

                    @foreach($features as $feat)
                    <div class="col-12 col-sm-6">
                  <div class="form-group form-">
                    <label for="exampleInputEmail1">{{$feat->feature_name}}</label>
                    @php  $feature_values='';  @endphp
                     @foreach($products->features as $featur)
                     @if($featur->feature_id==$feat->feature_id )
                     @php $feature_values= $featur->feature_value; @endphp
                      <input type="text" class="form-control" value="{{$feature_values}}" name="feature[{{$featur->feature_id}}]" placeholder="Enter {{$feat->feature_name}}">
                     @endif
                    @endforeach
                   
                  </div>
                  </div>
                  @endforeach
          
                        </div>  
                </div>
                {{-- Features End --}}
                <div class="tab-pane fade" id="custom-tabs-four-gallery" role="tabpanel" aria-labelledby="custom-tabs-four-gallery-tab">
                  {{-- <div class="col-12 inline">
                    <div class="form-group form-inline">
                      <label for="exampleInputEmail1">Image Title</label>
                      @foreach($products->images as $images)
                      <input type="text"  value="" placeholder="Image Title" value="" name="image_title" />
                      @endforeach
                    </div>
                    </div> --}}
                    
               <div class="col-md-9 inline">
                <div class="form-group form-inline">
                  @foreach($products->images as $images)
                  <img src="{{ asset('storage/product/images/'.$images->image) }}" height="50px" width="50px" alt="" title="{{$images->image_title}}">
                  <input type="text" hidden class="form-control" name="old_image[]" value="{{$images->id}}" id="" >
                  <input type="text" hidden class="form-control" name="old_images[]" value="{{$images->image}}" id="" >
                  <label for="exampleInputEmail1">{{$images->image_title}}</label>
                 @php $gallery=$images->image; @endphp
                  @endforeach
                  
                  </div>
                  <input type="file" multiple name="images[]"/>
                </div>
                </div>
                <div class="tab-pane fade" id="custom-tabs-four-videos" role="tabpanel" aria-labelledby="custom-tabs-four-videos-tab">
                  <div class="col-md-6 ">
                    <div class="form-group ">
                      <label for="exampleInputEmail1">Video Host</label>
                      <select class="form-control select2" name="video_host" value="{{$products->video_host}}" style="width: 100%;">
                        <option selected="selected">{{$products->video_host}}</option>
                        <option value="youtube">Youtube</option>
                        <option value="dailymotion">Daily Motion</option>
                        <option value="vimo">Vimo</option>
                      
                      </select>
                      </div>
                    </div>
                    <div class="col-md-6 inline">
                      <div class="form-group ">
                        <label for="exampleInputEmail1">Video Id</label>
                        <input type="text" class="form-control col-md-6" value="{{$products->video_link}}" id="" name="video_link" >
                        </div>
                      </div>
                </div>
                {{-- Statrt Atribut --}}
                <div class="tab-pane fade" id="custom-tabs-four-attribute" role="tabpanel" aria-labelledby="custom-tabs-four-attribute-tab">
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
                          <div class="form-group  col-7 col-sm-9   form-inline">
                           
                            <input type="text" class="form-control " id="" hidden value="{{$val->id}}" name="attribute_id[{{$value->id}}]" >
                            @php  $attvalue = '' ;  @endphp
                            @foreach($products->attribute_values as $attr_val )
                            @if($val->id==$attr_val->attribute_value_id )
                            @php $attvalue = $attr_val->attribute_value ; @endphp
                            @endif
                            @endforeach
                            <input type="text" class="form-control col-11 col-sm-12"  id="" value="{{$attvalue}}" name="attribute_val[{{$value->id}}][{{$val->id}}]" placeholder="Enter  {{$val->value}}">
                          </div>
                         @endforeach
                        </div>
                        @endforeach
                    
                        {{--  --}}
                      </div>
                    </div>
                  </div>
                </div>
               {{-- End  Attribute--}}
               <div class="tab-pane fade" id="custom-tabs-four-filters" role="tabpanel" aria-labelledby="custom-tabs-four-filters-tab">
                @foreach($filters as $filter)
                <div class="col-12 col-sm-8">
                  <label for="">{{$filter->filter_name}} :</label>

                  <div class="icheck-danger ">
                    @foreach($filter->filter_value as $value)
                    <label for="">{{$value->filter_value}}</label>
                    @php  $filtvalue=''; 
                    $condition='';
                    @endphp
                     @foreach($products->product_filters as $product_filter) 
                     @if($value->filter_id==$product_filter->product_filter_id && $products->id==$product_filter->product_id)
                     @php $filtvalue= $value->id;
                      $condition=$value->id==$product_filter->filter_values_id && $products->id==$product_filter->product_id;
                     @endphp
                     @endif
                  
                  @endforeach 
                  <input type="radio" id="" value="{{$filtvalue}}"  name="filter_value[{{$value->id}}][{{$filter->id}}]" {{$condition ? 'checked': ''}}>&nbsp;&nbsp;,
                  {{-- <input type="radio" id="" value="" name="newfilter_value[{{$filter->id}}]" >&nbsp;&nbsp;, --}}
                  
                 
              
                  @endforeach
                    </div>
             </div>
             <hr>
              @endforeach
 
   
      <div class="col-md-9 inline">
        <div class="form-group form-inline">
          
          <input type="Submit" class="form-control col-md-9 bg-primary" id=""  >
          </div>
        </div>

             {{-- End Feature --}}
              </div>
            </div>
            <!-- /.card -->
          </div>
        </div>
    
      </div>
      </form>
            <!-- /.card -->
             {{-- <div class="col-md-4 inline">
        <div class="form-group form-inline">
          
          <input type="Submit" class="form-control col-md-4 bg-primary" value="Click To Duplicate The Product" id=""  >
          </div>
        </div> --}}
          
  <script>
    $('#product_name').keyup(function(e){
      $.get('{{url('check_slug')}}',
      {'name':$('#product_name').val()},
      function(data){
        $('#slug').val(data.slug);
      }
      );

    });
  </script>
  
          </x-app-layout>
            