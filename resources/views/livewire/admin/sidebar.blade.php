{{-- @section('sidebar') --}}

<aside class="main-sidebar sidebar-dark-primary elevation-4">


    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel ">
        <div class="image">
          <img src="{{asset('storage/web-logo.png')}}" class=".img-fluid" style="width:80px; " alt="">
        </div>
      
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="{{url('dashboard')}}" class="nav-link {{ Request::is('dashboard')? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
               
              </p>
            </a>
       
          </li>
          {{-- @hasanyrole('module prodcuts_category|Supper_admin') --}}
          @if(auth()->user()->permission('module prodcuts_category')) 
          <li class="nav-item {{ Request::is('category')? 'menu-is-opening menu-open' : '' }} {{ Request::is('category/create')? 'menu-is-opening menu-open' : '' }}">
            <a href="#" class="nav-link {{ Request::is('category')? 'active' : '' }}  {{Request::is('category/create')? 'active' : ''}}">
              <i class="nav-icon fas fa-copy"></i>
              <p>
             Category
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @if(auth()->user()->permission('add prodcuts_category')) 
              <li class="nav-item">
                <a href="{{route('category.create')}}" class="nav-link {{ Request::is('category/create')? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Category</p>
                </a>
              </li>
              @endif
              @if(auth()->user()->permission('view prodcuts_category')) 
              <li class="nav-item">
                <a href="{{route('category.index')}}" class="nav-link {{ Request::is('category')? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Category</p>
                </a>
              </li>
              @endif
            </ul>
          </li>
          
       @endif
          {{-- End Category --}}
   
          {{-- @can('module products')  --}}
          @if(auth()->user()->permission('module products')) 
          {{-- @hasanyrole('module products|Supper_admin') --}}
          <li class="nav-item {{ Request::is('products')? 'menu-is-opening menu-open' : '' }} {{ Request::is('products/create')? 'menu-is-opening menu-open' : '' }}">
            <a href="#" class="nav-link {{ Request::is('products/create')? 'active' : ''  }} {{Request::is('products')? 'active' : ''}} ">
            
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Products
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              {{-- @if(auth()->user()->can('add products')) --}}
              {{-- @can('add products') --}}
              @if(auth()->user()->permission('add products')) 
              {{-- @hasanyrole('add products|Supper_admin')  --}}
              <li class="nav-item">
                <a href="{{route('products.create')}}" class="nav-link {{ Request::is('products/create')? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Products</p>
                </a>
              </li>
              {{-- @endhasanyrole --}}
              @endif
              @if(auth()->user()->permission('view products')) 
              <li class="nav-item">
                <a href="{{route('products.index')}}" class="nav-link {{ Request::is('products')? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Products</p>
                </a>
              </li>
              @endif
            </ul>
          </li>
          @endif
          {{-- @endhasanyrole --}}
          {{-- End Products --}}
          @if(auth()->user()->permission('module brands')) 
          <li class="nav-item {{ Request::is('brands')? 'menu-is-opening menu-open' : '' }} {{ Request::is('brands/create')? 'menu-is-opening menu-open' : '' }}">
            <a href="#" class="nav-link {{ Request::is('brands/create')? 'active' : '' }}  {{Request::is('brands')? 'active' : ''}}">
              <i class="nav-icon fas fa-copy"></i>
              <p>
             Brands
                <i class="fas fa-angle-left right"></i>
      
              </p>
            </a>
            <ul class="nav nav-treeview">
              @if(auth()->user()->permission('add brands')) 
              <li class="nav-item  {{ Request::is('brands')? 'menu-is-opening menu-open' : '' }} {{ Request::is('brands/create')? 'menu-is-opening menu-open' : '' }}">
                <a href="{{route('brands.create')}}" class="nav-link {{ Request::is('brands/create')? 'active' : '' }} ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Brand</p>
                </a>
              </li>
              @endif
              @if(auth()->user()->permission('view brands')) 
              <li class="nav-item">
                <a href="{{route('brands.index')}}" class="nav-link {{ Request::is('brands')? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Brand</p>
                </a>
              </li>
              @endif
            </ul>
          </li>
          {{-- @endcan --}}
          @endif
          {{-- End Brand --}}
          @if(auth()->user()->permission('module attribute')) 
          <li class="nav-item {{ Request::is('attributes')? 'menu-is-opening menu-open' : '' }} {{ Request::is('attributes/create')? 'menu-is-opening menu-open' : '' }}">
            <a href="#" class="nav-link {{ Request::is('attributes')? 'active' : '' }} {{ Request::is('attributes/create')? 'active' : '' }} ">
              <i class="nav-icon fas fa-tree"></i>
              <p>
                Attributes
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @if(auth()->user()->permission('add attribute')) 
       
              <li class="nav-item">
                <a href="{{route('attributes.create')}}" class="nav-link {{ Request::is('attributes/create')? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Attribute</p>
                </a>
              </li>
              @endif

              @if(auth()->user()->permission('addview attribute')) 
              {{-- @can('view attribute') --}}
              <li class="nav-item">
                <a href="{{route('attributes.index')}}" class="nav-link {{ Request::is('attributes')? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>view Attribute</p>
                </a>
              </li>
              @endif
        </ul>
        {{-- @endcan --}}
        @endif
          {{-- End Attribute --}}
          @if(auth()->user()->permission('module blogs_category')) 
        <li class="nav-item {{ Request::is('blogCat')? 'menu-is-opening menu-open' : '' }} {{ Request::is('blogCat/create')? 'menu-is-opening menu-open' : '' }}">
          <a href="#" class="nav-link {{ Request::is('blogCat')? 'active' : '' }} {{ Request::is('blogCat/create')? 'active' : '' }} ">
            <i class="nav-icon fas fa-blog"></i>
            <p>
              Blog Category
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            @if(auth()->user()->permission('add blogs_category')) 
            <li class="nav-item">
              <a href="{{route('blogCat.create')}}" class="nav-link {{ Request::is('blogCat/create')? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Create Category</p>
              </a>
            </li>
            @endif
            @if(auth()->user()->permission('view blogs_category')) 
            <li class="nav-item">
              <a href="{{route('blogCat.index')}}" class="nav-link {{ Request::is('blogCat')? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>view Category</p>
              </a>
            </li>
            @endif
          </ul>
          @endif
          {{-- End Category --}}
          @if(auth()->user()->permission('module blogs')) 
        <li class="nav-item  {{ Request::is('blogs')? 'menu-is-opening menu-open' : '' }} {{ Request::is('blogs/create')? 'menu-is-opening menu-open' : '' }}">
          <a href="#" class="nav-link {{ Request::is('blogs')? 'active' : '' }} {{ Request::is('blogs/create')? 'active' : '' }} ">
            <i class="nav-icon fas fa-blog"></i>
            <p>
              Blogs
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            @if(auth()->user()->permission('add blogs')) 
            <li class="nav-item">
              <a href="{{route('blogs.create')}}" class="nav-link {{ Request::is('blogs/create')? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Create Blog</p>
              </a>
            </li>
            @endif
            @if(auth()->user()->permission('view blogs')) 
            <li class="nav-item">
              <a href="{{route('blogs.index')}}" class="nav-link {{ Request::is('blogs')? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>view Blogs</p>
              </a>
            </li>
            @endif
              @if(auth()->user()->permission('view blogs comments')) 
            <li class="nav-item">
              <a href="{{route('post.comment')}}" class="nav-link {{ Request::is('post/comment')? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>view Blogs</p>
              </a>
            </li>
            @endif
          </ul>
          @endif
          {{-- End Blogs --}} 
          

          @if(auth()->user()->permission('module filters')) 
          <li class="nav-item  {{ Request::is('filters')? 'menu-is-opening menu-open' : '' }} {{ Request::is('filters/create')? 'menu-is-opening menu-open' : '' }}">
            <a href="#" class="nav-link {{ Request::is('filters')? 'active' : '' }} {{ Request::is('filters/create')? 'active' : '' }} ">
              {{-- @if(auth()->user()->can('view filter')) --}}
              <i class="nav-icon fas fa-filter"></i>
              <p>
                Filters
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            {{-- @endif --}}
            <ul class="nav nav-treeview">
              @if(auth()->user()->permission('add filters')) 
              <li class="nav-item">
                <a href="{{route('filters.create')}}" class="nav-link {{ Request::is('filters/create')? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create Filter</p>
                </a>
              </li>
                @endif 
                @if(auth()->user()->permission('view filters')) 
              <li class="nav-item">
                <a href="{{route('filters.index')}}" class="nav-link {{ Request::is('filters')? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>view Filter</p>
                </a>
              </li>
              @endif
            </ul>
           
            @endif
            
            {{-- End FIlter --}}
            
         
            @if(auth()->user()->permission('module users')) 
            <li class="nav-item {{ Request::is('users')? 'menu-is-opening menu-open' : '' }} {{ Request::is('users/create')? 'menu-is-opening menu-open' : '' }}">
              <a href="#" class="nav-link {{ Request::is('users')? 'active' : '' }} {{ Request::is('users/create')? 'active' : '' }} ">
             
                <i class="nav-icon fas fa-user"></i>
                
                <p>
                  Users
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
          
              <ul class="nav nav-treeview {{ Request::is('users')? 'style="display: block;"' : '' }} {{ Request::is('users/create')? 'style="display: block;"' : '' }}">
                @if(auth()->user()->permission('add users')) 
                <li class="nav-item {{ Request::is('users/create')? 'active' : '' }}" >
                  <a href="{{route('users.create')}}" class="nav-link {{ Request::is('users/create')? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Create User</p>
                  </a>
                </li>
                @endif
                @if(auth()->user()->permission('view users')) 
                <li class="nav-item">
                  <a href="{{route('users.index')}}" class="nav-link {{ Request::is('users')? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>view Users</p>
                  </a>
                </li>
                @endif
              </ul>

              @endif
            {{-- End USer --}}
            @if(auth()->user()->permission('module permission')) 
              <li class="nav-item {{ Request::is('permissions')? 'menu-is-opening menu-open' : '' }} {{ Request::is('permission/create')? 'menu-is-opening menu-open' : '' }}{{ Request::is('roles')? 'menu-is-opening menu-open' : '' }} {{ Request::is('assign_permission')? 'menu-is-opening menu-open' : '' }}">
                <a href="#" class="nav-link {{ Request::is('permissions')? 'active' : '' }} {{ Request::is('permission/create')? 'active' : '' }} {{ Request::is('roles')? 'active' : '' }}{{ Request::is('assign_permission')? 'active' : '' }}">
                  <i class="nav-icon fas fa-tree"></i>
                  <p>
                    Permissions
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  @if(auth()->user()->permission('add permission')) 
                  <li class="nav-item ">
                    <a href="{{route('permission.create')}}" class="nav-link {{ Request::is('permission/create')? 'active' : '' }} ">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Create Permission</p>
                    </a>
                  </li>
                  @endif
                  @if(auth()->user()->permission('add role')) 
  
                  <li class="nav-item">
                    <a href="{{route('roles.index')}}" class="nav-link {{ Request::is('roles')? 'active' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Create Role</p>
                    </a>
                  </li>
                  @endif
                  @if(auth()->user()->permission('view permissions')) 
                  <li class="nav-item">
                    <a href="{{route('AssigPermission.user')}}" class="nav-link {{ Request::is('assign_permission')? 'active' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Assign  Permission</p>
                    </a>
                  </li>
                  @endif
                </ul>
              @endif
              {{-- End Permission --}}
              @if(auth()->user()->permission('module feature')) 
              <li class="nav-item">
                <a href="{{route('feature.index')}}" class="nav-link {{ Request::is('feature')? 'active' : '' }}">
                  <i class="nav-icon fas fa-book"></i>
                  <p>
                  Features
                   
                  </p>
                </a>
              </li>
              @endif
              @if(auth()->user()->permission('module messages')) 
            <li class="nav-item">
              <a href="{{route('reviews.index')}}" class="nav-link {{ Request::is('reviews')? 'active' : '' }}">
                <i class="nav-icon fas fa-book"></i>
                <p>
                Messages
                 
                </p>
              </a>
            </li>
            @endif
            @if(auth()->user()->permission('module sliders')) 
            <li class="nav-item">
              <a href="{{route('sliders.index')}}" class="nav-link {{ Request::is('sliders')? 'active' : '' }}">
                <i class="nav-icon fas fa-image"></i>
                <p>
                Sliders
                 
                </p>
              </a>
            </li>
            @endif

            @if(auth()->user()->permission('module ads')) 
            <li class="nav-item">
              <a href="{{route('Ads.index')}}" class="nav-link {{ Request::is('Ads')? 'active' : '' }}">
                <i class="nav-icon fas fa-ad"></i>
                <p>
                Ads
                 
                </p>
              </a>
            </li>
            @endif
            @if(auth()->user()->permission('module currency')) 
            <li class="nav-item">
              <a href="{{route('Currency.index')}}" class="nav-link {{ Request::is('Currency')? 'active' : '' }}">
                <i class="nav-icon fas fa-dollar-sign"></i>
                <p>
                Currency
                 
                </p>
              </a>
            </li>
            @endif
            @if(auth()->user()->permission('module comments')) 
            <li class="nav-item">
              <a href="{{route('Comments')}}" class="nav-link {{ Request::is('Comments')? 'active' : '' }}">
                <i class="nav-icon fas fa-dollar-sign"></i>
                <p>
               Comments
                 
                </p>
              </a>
            </li>
            @endif
            {{-- <li class="nav-item">
              <a href="{{url('test')}}" class="nav-link {{ Request::is('test')? 'active' : '' }}">
                <i class="nav-icon fas fa-tree"></i>
                <p>
                test
                 
                </p>
              </a>
            </li> --}}
      
        
       
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  {{-- @endsection --}}
