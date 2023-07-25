<x-guest-layout>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Manrope:wght@200;300;400;500;600;700;800&display=swap');
        *{
            font-family: 'Manrope', sans-serif;
        }
        .coundty-drop-down{
            color: black;
            font-size: 18px;
            padding:9px 25px;
            border-radius: 50px;
            width: 188px;
        }
        .coundty-drop-down:hover{
            color:black; 
            border-color: white;
        }
        .coundty-drop-down::after{
            display: none !important;
        }
        .coundty-drop-down-1:hover{
            border-color:white;
        }
        .notification_btn:hover{
            border-color:transparent !important;
            border-radius: 0 !important;
        }
        .person_icon{
            font-size: 18px;
            color: white;
            font-weight: bold;
        }
        .header-2 li{
          margin:8px 4px ;
        }
        .header-2 li a{
          font-weight: bold;
          line-height: 100%;
          border-radius: 0 !important;
          border-right: 2px solid rgb(217, 213, 213) !important;
          padding:0px 14px;
        }
        .header-2 li .last_child{
          border-right: 2px solid transparent !important;
        }
        .header-2 li img{
          margin:0px 12px;
          margin-top:-10px;
          cursor: pointer;
        }
        .footer-paragraph{
          width: 95%;
        }
        .footer-container div h5{
          font-size: 18px !important;
          font-weight: bold;
        }
        .footer-container div ul{
          font-size: 18px !important;
          font-weight: 500;
          color: white !important;
          padding-left: 8px;
          margin-top: 20px;
        }
        .footer-container div ul li .nav-link{
          font-size: 18px !important;
          font-weight: 400;
          color: white !important;
        }
        .footer-container div ul li .nav-link i{
          padding-right: 16px;
        }
        .footer-float-sections{
          margin-top: 12px !important;
          float:left;
        }
        .footer-float-sections:nth-child(3)
        {
          width: 45%;
        }
        .footer-float-sections:nth-child(2)
        {
          width: 55%;
        }
        .doftliee_tab{
          width: 18%;
        }
        .top_brands_section{
          width: 23.5%;
        }
        .active-link-footer{
          color:#EE2835 !important;
        }
        .form-control-custom{
          height: 70px;
          font-size: 22px;
          font-weight: 700;
          background-color: #F8F8F9;
          border:none;
          outline: none;
          border-radius: 0;
          padding-left: 20px;
          padding-right: 20px;
          margin-bottom: 25px;
          margin-top: 25px;
        }
        .form-control-custom:focus{
          border:none;
          box-shadow: none;
          background-color: #F8F8F9;
        }
        .form-control-custom-btn{
          background-color: #4958EF;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <!DOCTYPE html>
    <html lang="en">
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>Document</title>
    </head>
    <body>
<div class="container">
    <div class="spacer_custom_20"></div>
    <div class="bread_crumb_link">
        <a href="" class="bread_crumb_link">Home</a> <i class="fa fa-chevron-right"></i> 
        <a href="" class="bread_crumb_link">{{$pro->category->name}}</a> <i class="fa fa-chevron-right"></i>
        <a href="" class="bread_crumb_link">{{$pro->name}}</a> <i class="fa fa-chevron-right"></i>
    </div>
    <div class="spacer_custom_20"></div>
    <h3 class="product_heading_title">{{$pro->name}}</h3>
    <div class="spacer_custom_20"></div>
</div>
<div class="container py-3">
    <div style="padding:30px 0;background:#F1F1F2" class="text-center">Ad Placement</div>
  </div>
  <div class="container product_detail_section">
    <div class="row p-0">
        <div class="col-5 product_vision_section pe-0">
<div class="inner-border-vision-section">
  <div class="spacer_custom_20"></div>


          <div id="carouselExampleDark" class="carousel carousel-dark slide  product_slider_container" data-bs-ride="carousel">
            <div class="carousel-indicators">
              <button type="button" style="border-radius: 50px !important;" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
              <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
              <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
              <div class="carousel-item active" data-bs-interval="10000">
                <img src="{{asset('storage/product/'.$pro->image)}}" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
       
                </div>
              </div>
             
              @foreach ($pro->images as $img)
             
              
              <div class="carousel-item" data-bs-interval="2000">
                <img src="{{asset('storage/product/images/'.$img->image)}}" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                  {{$img->image_title}}
                </div>
              </div>
              @endforeach
            </div>
      
            <button class="carousel-control-prev d-none" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next d-none" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>


          <div class="spacer_custom_20"></div>
          <h3 class="product_name">{{$pro->small_description}}</h3>
          <h3 class="product_price_under_product_name text-center">RS. {{$pro->orignal_price}}</h3>
          <h4 class="mobile_continue_status">Discontinued</h4>
          <div class="memory_detail_section">
            <nav class="nav nav-pills nav-fill">
              <a class="nav-link rounded-0 memory_status_button memory_status_button_active" aria-current="page" href="#">4/64</a>
              <a class="nav-link rounded-0 memory_status_button" aria-current="page" href="#">6/128</a>
              <a class="nav-link rounded-0 memory_status_button" aria-current="page" href="#">8/256</a>
            </nav>
          </div>
          <div class="">
            <nav class="nav nav-pills nav-fill">
              <a class="nav-link rounded-0 more_vision_details" aria-current="page" href="#">Pictures <i class="fa fa-chevron-right right_arrow_more_vision_details"></i></a>
              <a class="nav-link rounded-0 more_vision_details" aria-current="page" href="#">Compare <i class="fa fa-chevron-right right_arrow_more_vision_details"></i></a>
              <a class="nav-link rounded-0 more_vision_details" aria-current="page" href="#">Opinions <i class="fa fa-chevron-right right_arrow_more_vision_details"></i></a>
            </nav>
          </div>
        </div>


        </div>
        <div class="col-7 product_short_detail_section ps-0">
          <div class="inner-border-vision-section_right">
            <div class="overview_prdouct">
              Overview <img src="{{asset('images/product/watchvideo.png1')}}" style="float:right; margin-top:-7px;cursor:pointer" height="46px">
            </div>
            @foreach($features as $fet)
            <div class="overview_details row p-0 m-0">
              <div class="col-6 overview_details_section">
                <div class="overview_details_section_col overview_details_icon">
                  <img src="{{asset('storage/feature_icons/'.$fet->feature_icon)}}" height="52px">
                </div>
                <div class="overview_details_section_col overview_icon_details">
                  <div class="overview_details_title">{{$fet->feature_name}}</div>
                  @foreach($pro->features as $pro_feat)
                  @if($pro_feat->feature_id==$fet->id )
                  <div class="overview_details_value">{{$pro_feat->feature_value}}</div>
                  @endif
                  @endforeach
                </div>
              </div>
              @endforeach
       
          
       
      
            <div class="see_full_specification_btn">
              See Full Specification
            </div>
            
          </div>
          
        </div>
    </div>
   
  </div>
  <div class="spacer_custom_30"></div>
  <div style="background-color: #F1F1F2;">
    <div class="container py-3">
      <div style="padding:30px 0;background:white" class="text-center">Ad Placement</div>
    </div>
    </div>
    <div class="spacer_custom_30"></div>
<div class="container">
  <div class="row">
    <div class="col-md-9">
      <div class="heading_with_border_left">Specifications</div>
      <div class="icon_heading_sepecification">
        {{-- <img src="{{asset('images/product/general.png')}}" height="30px">  --}}

        @foreach($groups as $value)
            
    
    
        <span class="icon_heading_title">{{$value->name}}</span>
        <img src="{{asset('storage/attribute/'.$value->icon)}}" width="50px">
 
   
      <table class="table specification_table">
        @foreach($value->values as $val )
        <tr>
          <td>{{$val->value}}</td>
          @foreach($pro->attribute_values as $attr)
          @if($attr->product_id==$pro->id && $val->id==$attr->attribute_value_id)
          <td>{{$attr->attribute_value}}</td>
          @endif
          @endforeach
        </tr>
        @endforeach
       
      </table>

      @endforeach
     






    </div>   
</div>    
    <div class="col-md-3">
      <img src="{{asset('images/product/right_Ad_banner.png')}}" width="100%">
      <div class="spacer_custom_50"></div>
      <div class="spacer_custom_20"></div>
      <div class="heading_with_border_left">Specifications</div>
      <div class="tags_Section">
        @foreach($pro->tags as $tag)
        <div class="btn tags">{{ $tag->name }}</div>
        @endforeach 
      </div>

      
      <div class="spacer_custom_30"></div>
      <div class="heading_with_border_left">Browse By {{$pro->brands->brand_name}}</div>
      <div class="spacer_custom_10"></div>

 @foreach($browse_by as $browse)
      <div class="side_mobile_section">
        <div class="side_mobile_Col">
          <center><img src="{{asset('storage/product/'.$browse->image)}}" height="88px"></center>
        </div>
        <div class="side_mobile_Col">
          <div class="side_col_title">{{$browse->name}}</div>
          <div class="side_col_rupee">RS. {{$browse->orignal_price}}</div>
          <a class="view_more_link">View More</a>
        </div>
      </div>
  @endforeach
      <div class="spacer_custom_30"></div>
      <div class="heading_with_border_left">Upcoming Phone</div>
      <div class="spacer_custom_10"></div>

      <div class="side_mobile_section">
        <div class="side_mobile_Col">
          <center><img src="{{asset('images/product/slider_mobile_here.png')}}" height="88px"></center>
        </div>
        <div class="side_mobile_Col">
          <div class="side_col_title">Infinix Note 12 G96</div>
          <div class="side_col_rupee">RS. 36,999</div>
          <a class="view_more_link">View More</a>
        </div>
      </div>
 

      <div class="spacer_custom_30"></div>
      <div class="heading_with_border_left">Browse By Budget</div>
      

      <div class="tags_Section">
        <div class="btn tags">Under 15,000</div>
        <div class="btn tags">Under 25,000</div>
        <div class="btn tags">Under 35,000</div>

      </div>
      <div class="spacer_custom_30"></div>
      <img src="{{asset('images/product/right2_Ad_banner.png')}}" width="100%">


    </div>
  </div>
</div>
                        

      
                
                         
                     
                   
  
<div style="background-color: #FAFAFB;padding:100px 0">
  <div class="container">
    <div class="row p-0 m-0"> 
      <div class="col-md-6">
        <div class="heading_with_border_left">Mobile Information {{$pro->video_link}}</div>
        <div class="spacer_custom_30"></div>
            <p class="mobile_information_p">{!! $pro->description !!}</p>
        <button class="btn read_more_btn">Read More</button>
      </div>
<!--                <video width="560" height="315" autoplay muted>-->
<!--  <source src="{{$pro->video_link}}" type="video/mp4">-->
<!--</video>-->
      <div class="col-md-6">
        <iframe  width="560" height="315" src="https://www.youtube.com/embed/{{$pro->video_link}}"  title="YouTube video player"  frameborder="0" allowfullscreen></iframe>
      </div>
    </div>
    

  </div>
</div>



@include('frontend.commentsDisplay', ['comments' => $pro->comments,'comments.replies.replies', 'pro_id' => $pro->id])

<hr />
<h4>Add comment</h4>
<form method="post" action="{{route('comments.store')}}">
    @csrf
    <div class="form-group col-sm-4">
        <textarea class="form-control" name="comment"></textarea>
        @error('comment')<span class="text-red-700">{{$message}}  </span>@enderror
        <input type="hidden" name="product_id" value="{{ $pro->id }}" />
    </div>
    <div class="form-groupcol-sm-2 ">
        <input type="submit" class="btn btn-success" value="Add Comment" />
    </div>
</form>


<div style="background-color: #F1F1F2;">
    <div class="container py-3">
      <div style="padding:30px 0;background:white" class="text-center">Ad Placement</div>
    </div>
    </div>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    // Save Like Or Dislike
$(document).on('click','#saveLikeDislike',function(){
    var _type=$(this).data('type');
    var id=$(this).data('id');
    var likesum=$(this).data('like_sum');
    var dislike_sum=$(this).data('dislike_sum');
    var vm=$(this);
    // Run Ajax
    let _url = `{!! url('/save-likedislike/') !!}` + '/' + id + '/' + _type;
        $.ajax({
            url: _url,
            type: 'GET',
            success: function(data) {
                if(_type=='like'){
                  $("#likes").load(data.likes);
                  vm.html('Like'   +'&nbsp;' +    ++ likesum);
                }else{
                  vm.html('DisLike'  +'&nbsp;' +    ++ dislike_sum);
                }
            }
        });
});


// End
</script>
</x-guest-layout>