<x-app-layout>
    @section('title')
    Slider
    @endsection
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
        <div class="card-header">
          <h3 class="card-title">Sliders</h3>
          <button type="button" class="btn btn-primary float-right"  data-toggle="modal" id="blog_description" data-target="#modal-slider" >
            Create Slider
          </button>
        </div>
         <!-- Content Wrapper. Contains page content -->
 <!-- Main content -->
 <section class="content">

    <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Projects Detail</h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
            <i class="fas fa-minus"></i>
          </button>
          <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
            <i class="fas fa-times"></i>
          </button>
        </div>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
            <div class="row">
              <div class="col-12 col-sm-4">
                <div class="info-box bg-light">
                  <div class="info-box-content">
                    <span class="info-box-text text-center text-muted">Pricet</span>
                    <span class="info-box-number text-center text-muted mb-0">{{$pro->orignal_price}}</span>
                  </div>
                </div>
              </div>
              <div class="col-12 col-sm-4">
                <div class="info-box bg-light">
                  <div class="info-box-content">
                    <span class="info-box-text text-center text-muted">Quantity</span>
                    <span class="info-box-number text-center text-muted mb-0">{{$pro->qty}}</span>
                  </div>
                </div>
              </div>
           
            <div class="row">
              <div class="col-12">
                <h4>{{$pro->name}}</h4>
         


                  <div class="post">
                    <div class="user-block">
                      <img class="img-circle img-bordered-sm" src="{{asset('storage/product/'.$pro->image)}}" alt="user image">
                      <span class="username">
                        <a href="#">{{$pro->slug}}.</a>
                      </span>
                      <span class="description">Shared publicly - 5 days ago</span>
                    </div>
                    <!-- /.user-block -->
                    <p>
                     {{$pro->description}}
                    </p>

                    <p>
                      <a href="#" class="link-black text-sm"><i class="fas fa-link mr-1"></i> {{$pro->category->name}}</a>
                    </p>
                  </div>
              </div>
            </div>
          </div>
          <div class="col-12 col-md-12 col-lg-4 order-1 order-md-2">
            <h3 class="text-primary"><i class="fas fa-paint-brush"></i> AdminLTE v3</h3>
            <p class="text-muted">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terr.</p>
            <br>
            @foreach ($pro->images as $img)
            <img src="{{asset('storage/product/images/'.$img->image)}}" height="60px" width="55px"> 
            @endforeach
           
        
            <div class="text-muted">
              <p class="text-sm">Client Company
                <b class="d-block">Deveint Inc</b>
              </p>
              <p class="text-sm">Project Leader
                <b class="d-block">Tony Chicken</b>
              </p>
            </div>

            <h5 class="mt-5 text-muted">Project files</h5>
            <ul class="list-unstyled">
              <li>
                <a href="" class="btn-link text-secondary"><i class="far fa-fw fa-file-word"></i> Functional-requirements.docx</a>
              </li>
              <li>
                <a href="" class="btn-link text-secondary"><i class="far fa-fw fa-file-pdf"></i> UAT.pdf</a>
              </li>
              <li>
                <a href="" class="btn-link text-secondary"><i class="far fa-fw fa-envelope"></i> Email-from-flatbal.mln</a>
              </li>
              <li>
                <a href="" class="btn-link text-secondary"><i class="far fa-fw fa-image "></i> Logo.png</a>
              </li>
              <li>
                <a href="" class="btn-link text-secondary"><i class="far fa-fw fa-file-word"></i> Contract-10_12_2014.docx</a>
              </li>
            </ul>
            <div class="text-center mt-5 mb-3">
              <a href="#" class="btn btn-sm btn-primary">Add files</a>
              <a href="#" class="btn btn-sm btn-warning">Report contact</a>
            </div>
          </div>
        </div>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
     {{-- Statrt Atribut --}}
    
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
                <div class="form-group form-inline">
                 @foreach($pro->attribute_values as $attr)
              
                 @if($attr->product_id==$pro->id && $val->id==$attr->attribute_value_id)
                  <input type="text" class="form-control" id="" value="{{$attr->attribute_value}}" name="attribute_val[{{$value->id}}][{{$val->id}}]" placeholder="Enter  {{$val->value}}">
                @endif
                  @endforeach 
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
     <!-- /.card-header -->
     <div class="card-body">
      {{-- <form method="post" action="{{url('comments_save')}}">
          @csrf
          <div class="row">
              <div class="col-lg-12">
                  <div id="">
                      <label for="">Filter Name</label>
                      <div class="input-group mb-3">
                        <input type="text" name="user_id" hidden value="{{Auth()->user()->id}}" class="form-control m-input"  >
                        <input type="text" name="product_id" hidden value="{{$pro->id}}" class="form-control m-input" >
                          <input type="text" name="comment" class="form-control m-input" placeholder="Enter Comment" >
                 
                      </div>
                  </div>
                  <input  id="" type="submit" class="btn btn-info float-right">
                </div>
                
                </div>
            </form> --}}
        
                  
                                    @include('admin.test.commentsDisplay', ['comments' => $pro->comments,'comments.replies.replies', 'pro_id' => $pro->id])
                   
                                    <hr />
                                    <h4>Add comment</h4>
                                    <form method="post" action="{{route('comments.store')}}">
                                        @csrf
                                        <div class="form-group">
                                            <textarea class="form-control" name="comment"></textarea>
                                            @error('comment')<span class="text-red-700">{{$message}}  </span>@enderror
                                            <input type="hidden" name="product_id" value="{{ $pro->id }}" />
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" class="btn btn-success" value="Add Comment" />
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                  {{-- @include('comment',['comments'=>$pro->comments]) --}}
                  <div id="inputFormRow">
                      {{-- <label for="">Replays</label>
                      <div class="input-group mb-3">
                      
                        <br>
                        @foreach($pro->comments as $comment)
                        <h2>{{$comment->comment}}</h2>
                        @endforeach --}}
                        {{-- @foreach($comments as $comment)
                        <img src="{{asset('storage/user/'.Auth()->user()->profile_photo_path)}}" height="60px" width="55px"> 
                        <h2>{{$comment->comment}}</h2>
                        @foreach($replys as $reply)
                        @if($comment->id==$reply->comment_id)
                            <h4><span>{{$reply->reply_comment}}</span></h4>
                            @endif
                          @endforeach  
                        <br>
                        <form method="post" action="{{url('comments_reply_save')}}">
                          @csrf
                        <div class="input-group mb-3">
                          <label>Reply</label>
                          <input type="text" name="comment_id"  hidden value="{{$comment->id}}" class="form-control m-input"  >
                          <input type="text" name="reply_user_id" hidden value="{{$comment->user_id}}" class="form-control m-input"  >
                          <input type="text" name="user_id" hidden value="{{Auth()->user()->id}}" class="form-control m-input"  >
                          <input type="text" name="product_id" hidden value="{{$pro->id}}" class="form-control m-input" >
                          <input type="text" name="reply_comment[]" class="form-control m-input" placeholder="Replay" autocomplete="off">
                        </div> --}}
                        {{-- <button  id="" type="submit" class="btn btn-info float-right">Reply</button> --}}
                          {{-- @endforeach --}}
                          {{-- <input type="text" name="replays" class="form-control m-input" placeholder="Replay" autocomplete="off"> --}}
                    
                      </div>
                  </div>
                </form>
              
              </div>
              
              
   
    <!-- /.row -->
  </div>
  <!-- /.card-body -->
</div>  </div>
<!-- /.content-wrapper -->
<script src="{{url('plugins/jquery/jquery.min.js')}}" ></script>
<script>

</script>
</x-app-layout>