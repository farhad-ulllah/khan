<x-app-layout>
  @section('title')
  Edit Product
  @endsection
    <link rel="stylesheet" href="{{url('plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{url('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
    <script src="{{url('plugins/jquery/jquery.min.js')}}" ></script>
   
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js"></script> --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery-tagsinput/1.3.6/jquery.tagsinput.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-tagsinput/1.3.6/jquery.tagsinput.min.js"></script>
    <!-- Content Wrapper. Contains page content -->
    
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Edit Product</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Add Product</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
    <form action="{{route('products.update',$products->id)}}"  method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
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
                <!--<li class="nav-item">-->
                <!--  <a class="nav-link" id="custom-tabs-four-videos-tab" data-toggle="pill" href="#custom-tabs-four-videos" role="tab" aria-controls="custom-tabs-four-videos" aria-selected="false">Vidoe</a>-->
                <!--</li>-->
                
                <li class="nav-item">
                  <a class="nav-link" id="custom-tabs-four-filters-tab" data-toggle="pill" href="#custom-tabs-four-filters" role="tab" aria-controls="custom-tabs-four-filters" aria-selected="false">Filters</a>
                </li>
                 <li class="nav-item" style="padding-left:170px;">
                  <button type="submit" class="nav-link btn btn-success float-right" id="custom-tabs-four-filters-tab"   >Update Product</a>
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
                    <select class="form-control select2" name="cat_id" required  style="width: 100%;">
                        <option >Select Category</option>
                      @foreach($category as $item )
                      <option value="{{$item->id}}" {{($item->id == $products->cat_id) ? 'Selected' : ''}}>{{$item->name}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                  <!-- /.form-group -->
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="name">Name Title</label>
                      <input type="text" name="name" value="{{$products->name}}" class="form-control" required id="product_name" placeholder="Enter Name">
                    </div>
                  </div>
       
        

                <div class="col-12 col-sm-12">
                  <div class="form-group">
                    <label for="exampleInputEmail1"> Description</label>
                     <textarea id="editor1" type="text" class="form-control" id="desc" name="description" value="{{$products->description}}" placeholder="Enter Small Description">{{$products->description}}</textarea>
                
                  </div>
                </div>
                                   <!-- /.col -->
                   <div class="col-12 col-sm-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Date</label>
                      <input type="date" class="form-control" id=""  value="{{date('Y-m-d', strtotime($products->created_at)) }}" name="product_date" placeholder=" ">
                      </div>
                    </div>
          <!-- /.form-group -->
                  <div class="col-md-6">
                  <div class="form-group">
                    <label>Brands</label>
                    <select class="form-control select2"  name="brand_id" required style="width: 100%;">
                      <option >Select Brand</option>
                      @foreach($brands as $brand )
                       <option value="{{$brand->id}}" {{($brand->id == $products->brand_id) ? 'Selected' : ''}}>{{$brand->brand_name}}</option>
                   
                      @endforeach
                    </select>
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
                          <label for="exampleInputEmail1">Selling Price</label>
                          <input type="text" class="form-control" id="selling" name="selling_price" value="{{$products->selling_price}}" placeholder="Enter Small Desc">
                        </div>
                        <!-- /.form-group -->
                      </div>
                      <!--<div class="col-12 col-sm-6">-->
                      <!--  <div class="form-group">-->
                      <!--    <label for="exampleInputEmail1">Tax</label>-->
                      <!--    <input type="number" class="form-control" id="tax" name="tax" value="{{$products->tax}}" placeholder="Tax">-->
                      <!--    </div>-->
                      <!--  </div>-->
                
                         <div class="col-12 col-sm-6">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Youtube Video Link</label>
                          <input type="text" class="form-control" id="video_link" name="video_link" value="{{$products->video_link}}"  placeholder="Video Link">
                          </div>
                        </div>
                      <!--<div class="col-12 col-sm-6">-->
                      <!--  <div class="form-group">-->
                      <!--    <label for="exampleInputEmail1">Quantity</label>-->
                      <!--    <input type="number" class="form-control" id="" name="quantity" value="{{$products->qty}}" placeholder="Enter Quantity">-->
                      <!--  </div>-->
                      <!--</div>-->
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
                                     
                                          <input type="file" class="form-control" id="" name="image">
                                          <input type="text" hidden class="form-control" name="old_image" value="{{$products->image}}" id="" >
                                          {{-- <img src="{{ asset('storage/product/'.$products->image) }}" height="50px" width="50px" alt="" title=""> --}}
                                    </div>
                                  </div>
                                  <div class="col-10 col-sm-3">
                                    <div class="form-group">
                                      <label>Alt Image Title</label>
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
                                    @error('ram_storage2')<span class="text-red-700" style="color:red;">{{$message}}  </span>@enderror
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
                                        <textarea type="text" class="form-control" id="" name="meta_description"  value="{{$products->meta_description}}" placeholder="meta Description">{{$products->meta_description}}</textarea>
                                      </div>
                                      </div>
                              
                                  
                                      <div class="col-sm-6">
                                        <div class="form-group">
                                          <label for="exampleInputEmail1">Focus Key Phrases</label>
                                          <input type="text" class="form-control" id="" name="meta_keywords" value="{{$products->meta_keywords}}" placeholder="Meta Keywords">
                                        </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                          <div class="form-group">
                                            <label for="exampleInputEmail1">Slug</label>
                                            <input type="text" class="form-control" id="slug" name="slug" value="{{$products->slug}}"  placeholder="Enter Slug">
                                          </div>
                                        </div>
                                 
                                    </div>  </div>   </div>
                 <!-- /.form-group -->
                </div>
              </div>
            {{-- GEneral Form End  --}}

                <div class="tab-pane fade" id="custom-tabs-four-features" role="tabpanel" aria-labelledby="custom-tabs-four-features-tab">
                  <div class="row">

                    @foreach($features as $feat)
                    <div class="col-12 col-sm-6">
                  <div class="form-group form-">
                    <label for="exampleInputEmail1">{{$feat->feature_name}}</label>
                    @php  $featuresvalue='';  @endphp
                     @foreach($products->features as $featur)
                    
                      @if($featur->feature_id==$feat->feature_id )
                      
                      @php  $featuresvalue=$featur->feature_value;  @endphp
                
                    @endif
                    @endforeach
                    <input type="text" class="form-control" value="{{$featuresvalue}}" id="" name="feature[{{$feat->feature_id}}]" placeholder="Enter {{$feat->feature_name}}">
                  </div>
                  </div>
                  @endforeach
          
                        </div>  
                </div>
                {{-- Features End --}}
                <div class="tab-pane fade" id="custom-tabs-four-gallery" role="tabpanel" aria-labelledby="custom-tabs-four-gallery-tab">
          <table class="table table-bordered mt-3">
                  <tr>
                  <div class="col-12 inline">
                    <div class="form-group form-inline">
                             <label for="exampleInputEmail1">New Image</label>
                           <input type="file" multiple name="multiple_images[]" /> 
                          </div>
                    </div>
                      @foreach($products->images as $images)
                      <td class="imgcol{{$images->id}}">
                      <p>{{$images->image_title}}</p>
                      <img src="{{ asset('storage/product/images/'.$images->image) }}" width="150" alt="" title="{{$images->image_title}}">
                      <p class="mt-2">
                 <button type="button" onclick="return confirm('Are you sure you want to delete this image??')" class="btn btn-danger btn-sm delete-image" data-image-id="{{$images->id}}"><i class="fa fa-trash"></i></button>
                    </p>
                   </td>
                   @endforeach
                    </tr>
                     </table>
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
                     <script type="text/javascript">
              $('#input-tags').tagsInput();
            </script>
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
                     {{-- @if($product_filter->product_filter_value ==$value->filter_value) --}}
                     @if($value->filter_id==$product_filter->product_filter_id && $products->id==$product_filter->product_id)
                     @php 
                    //  $filtvalue= $value->id;
                      $condition=$value->id==$product_filter->filter_values_id && $products->id==$product_filter->product_id;
                     @endphp
                     @endif
               
               
                  @endforeach 
                  <input type="checkbox" id="" value="{{$value->id}}" name="newfilter_value[{{$filter->id}}]" {{$condition ? 'checked': ''}}>&nbsp;&nbsp;,
                  {{-- <input type="checkbox" id="" value="" name="newfilter_value[{{$filter->id}}]" >&nbsp;&nbsp;, --}}
                  
                 
              
                  @endforeach
                    </div>
             </div>
             <hr>
              @endforeach
 
   
      <!--<div class="col-md-9 inline">-->
      <!--  <div class="form-group form-inline">-->
          
      <!--    <input type="Submit" class="form-control col-md-9 bg-primary" id=""  >-->
      <!--    </div>-->
      <!--  </div>-->

             {{-- End Feature --}}
              </div>
            </div>
            <!-- /.card -->
          </div>
        </div>
    
      </div>
        </form>
            <!-- /.card -->
                 <script src="{{url('plugins/jquery/jquery.min.js')}}" ></script>
        <script src="https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>
  <script>
    $('#product_name').keyup(function(e){
      $.get('{{url('check_slug')}}',
      {'name':$('#product_name').val()},
      function(data){
        $('#slug').val(data.slug);
      }
      );

    });
        $(document).ready(function(){
        $(".delete-image").on('click',function(){
            var _img_id=$(this).attr('data-image-id');
            var _vm=$(this);
            $.ajax({
                url:"{{url('products/galleyimage/delete')}}/"+_img_id,
                dataType:'json',
                beforeSend:function(){
                    _vm.addClass('disabled');
                },
                success:function(res){
                    if(res.bool==true){
                        $(".imgcol"+_img_id).remove();
                    }
                    _vm.removeClass('disabled');
                }
            });
        });
    });
  </script>
          <script>

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
            