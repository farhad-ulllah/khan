<x-app-layout>
  <div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Comments</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Comments</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">All Blogs Comments</h3>
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
      <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
    <th scope="col">ID</th>
    <th scope="col">Comment</th>
    <th scope="col">Blog title</th>
    <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
          @foreach($comments as $key => $comment)
        <tr>
           <td>{{ ++$key }}</td>
                    <td>{{ $comment->comment }}</td>
                 <td>{{ $comment->blogs->title }}</td>
          <td>  
        @if(auth()->user()->permission('view blogs comments')) 
        <a href="{{ url('blogs-comment-delete/'.$comment->id)}}" >
          <button class="" type="submit" onclick="return confirm('Are you sure to delete this?')"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
          </svg></button>
        </a>
       @endif

        </td>
        </tr>
        @endforeach
        </tbody>
        <tfoot>
        <tr>
    <th scope="col">ID</th>
    <th scope="col">Comment</th>
    <th scope="col">Blog title</th>
    <th scope="col">Action</th>
        </tr>
        </tfoot>
      </table>
    </div>
  </div>
  <!-- /.card -->
</div>
<!-- /.col -->


<script src="{{url('plugins/jquery/jquery.min.js')}}" ></script>

</x-app-layout>