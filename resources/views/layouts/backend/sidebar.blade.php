<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link">
      <img src="backend/dist/img/AdminLTELogo.png" alt="Admin Section" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Admin Panel</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <!--<img src="backend/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">-->
        </div>
        <div class="info">
          <a href="{{ route('dashboard') }}" style="text-transform:capitalize;" class="d-block">{{$data->name}}</a>
          <span class="badge badge-warning">{{$data->role}}</span>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item has-treeview menu-open">
              <a href="{{route('dashboard')}}" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  DashBoard
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
          </li>
          @if ($data->role == 'super_admin')
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-user text-orange"></i>
              <p>
                Manage User
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="display: none; margin-left:20px;">
              <li class="nav-item" style="font-size: 15px;">
                <a href="{{route('user.list')}}" class="nav-link">
                  <i class="fa fa-check-circle nav-icon" aria-hidden="true"></i>
                  <p>User</p>
                </a>
              </li>
              <li class="nav-item" style="font-size: 15px;">
                <a href="{{route('vendor.list')}}" class="nav-link">
                  <i class="fas fa-check-circle nav-icon"></i>
                  <p>Vendor List</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-sliders-h text-blue"></i>

              <p>
                Manage Slide
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="display: none; margin-left:20px;">
              <li class="nav-item" style="font-size: 15px;">
                <a href="{{route('banar.list')}}" class="nav-link">
                    <i class="fas fa-check-circle nav-icon"></i>
                  <p>Banner List</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-sitemap text-info"></i>
              <p>
                Manage Category
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="display: none; margin-left:20px;">
              <li class="nav-item" style="font-size: 15px;">
                <a href="{{route('categories')}}" class="nav-link">
                  <i class="fas fa-check-circle nav-icon"></i>
                  <p>Main Category</p>
                </a>
              </li>
              <li class="nav-item" style="font-size: 15px;">
                <a href="{{route('child.category')}}" class="nav-link">
                  <i class="fas fa-check-circle nav-icon"></i>
                  <p>Child Category</p>
                </a>
              </li>
              <li class="nav-item" style="font-size: 15px;">
                  <a href="{{route('sub.child.category')}}" class="nav-link">
                    <i class="fas fa-check-circle nav-icon"></i>
                    <p>Child of Child-category</p>
                  </a>
                </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fab fa-bimobject text-blue"></i>
              <p>
                Manage Brand
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="display: none; margin-left:20px;">
              <li class="nav-item" style="font-size: 15px;">
                <a href="{{ route('brand.brand_list') }}" class="nav-link">
                  <i class="fas fa-check-circle nav-icon"></i>
                  <p>Brand List</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-sitemap text-info"></i>
              <p>
                Manage Attribute
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="display: none; margin-left:20px;">
              <li class="nav-item" style="font-size: 15px;">
                <a href="{{route('attributes')}}" class="nav-link">
                  <i class="fas fa-check-circle nav-icon"></i>
                  <p>Product Attribute</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fab fa-product-hunt text-green"></i>

              <p>
                Manage Product
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="display: none; margin-left:20px;">
              <li class="nav-item" style="font-size: 15px;">
                <a href="{{route('products')}}" class="nav-link">
                  <i class="fas fa-check-circle nav-icon"></i>
                  <p>Product List</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-dolly-flatbed text-blue"></i>
              <p>
                Sales Management
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="display: none; margin-left:20px;">
              <li class="nav-item" style="font-size: 15px;">
                <a href="{{route('sales.history')}}" class="nav-link">
                    <i class="fas fa-check-circle nav-icon"></i>
                  <p>Sales List</p>
                </a>
              </li>
              <li class="nav-item" style="font-size: 15px;">
                <a href="{{route('refund.view')}}" class="nav-link">
                    <i class="fas fa-check-circle nav-icon"></i>
                  <p>Refund List</p>
                </a>
              </li>
            </ul>
        </li>
        @endif
        @if($data->role == 'vendor' || $data->role == 'super_admin')
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users-cog text-green"></i>
              <p>
                Vendor
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="display: none; margin-left:20px;">
              <li class="nav-item" style="font-size: 15px;">
                <a href="{{route('vendors')}}" class="nav-link">
                  <i class="fas fa-check-circle nav-icon"></i>
                  <p>Vendor List</p>
                </a>
              </li>
             @if(optional($validVendor)->status == 1 || $data->role == 'super_admin')
              <li class="nav-item" style="font-size: 15px;">
                <a href="{{route('single.vendors')}}" class="nav-link">
                  <i class="fas fa-check-circle nav-icon"></i>
                  <p>Single Vendor List</p>
                </a>
              </li>

              <li class="nav-item" style="font-size: 15px;">
              <a href="{{route('vendor.products')}}" class="nav-link">
                  <i class="fas fa-check-circle nav-icon"></i>
                  <p>Vendor Product List</p>
                </a>
              </li>
              <li class="nav-item" style="font-size: 15px;">
                <a href="{{route('product.attribute')}}" class="nav-link">
                    <i class="fas fa-check-circle nav-icon"></i>
                    <p>Product Attribute List</p>
                  </a>
                </li>
              
              <li class="nav-item" style="font-size: 15px;">
                  <a href="{{route('vendor.sales.history')}}" class="nav-link">
                    <i class="fas fa-check-circle nav-icon"></i>
                    <p>Sales List</p>
                  </a>
                </li>
                <li class="nav-item" style="font-size: 15px;">
                  <a href="{{route('vendor.sales.refund')}}" class="nav-link">
                    <i class="fas fa-check-circle nav-icon"></i>
                    <p>Refund List</p>
                  </a>
                </li>
            @endif
            </ul>
          </li>
        @endif
        @if($data->role == 'super_admin')
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-ad text-info"></i>
            <p>
              Ads Management
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview" style="display: none; margin-left:20px;">
            <li class="nav-item" style="font-size: 15px;">
              <a href="{{route('ads')}}" class="nav-link">
                <i class="fas fa-check-circle nav-icon"></i>
                <p>Ads List</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-at text-green"></i>
            <p>
              Subscription
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview" style="display: none; margin-left:20px;">
            <li class="nav-item" style="font-size: 15px;">
              <a href="{{route('subscribers')}}" class="nav-link">
                <i class="fas fa-check-circle nav-icon"></i>
                <p>Subscriber List</p>
              </a>
            </li>
          </ul>
        </li>


        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-cogs text-info"></i>
            <p>
              Settings
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview" style="display: none; margin-left:20px;">
            <li class="nav-item" style="font-size: 15px;">
              <a href="{{ route('setup-settings') }}" class="nav-link">
                <i class="fas fa-check-circle nav-icon"></i>
                <p>Setup Website Info</p>
              </a>
            </li>
          </ul>
          <ul class="nav nav-treeview" style="display: none; margin-left:20px;">
            <li class="nav-item" style="font-size: 15px;">
              <a href="{{route('about.view')}}" class="nav-link">
                <i class="fas fa-check-circle nav-icon"></i>
                <p>Setup About Page</p>
              </a>
            </li>
          </ul>
          <ul class="nav nav-treeview" style="display: none; margin-left:20px;">
            <li class="nav-item" style="font-size: 15px;">
              <a href="{{route('contact.list')}}" class="nav-link">
                <i class="fas fa-check-circle nav-icon"></i>
                <p>Contact List</p>
              </a>
            </li>
          </ul>

        </li>
        @endif
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
