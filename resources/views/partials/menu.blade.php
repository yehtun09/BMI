<!-- partial:../../partials/_settings-panel.html -->
<div class="theme-setting-wrapper">
    <div id="settings-trigger"><i class="ti-settings"></i></div>
    <div id="theme-settings" class="settings-panel">
        <i class="settings-close ti-close"></i>
        <p class="settings-heading">SIDEBAR SKINS</p>
        <div class="sidebar-bg-options selected" id="sidebar-light-theme">
            <div class="img-ss rounded-circle bg-light border mr-3"></div>Light
        </div>
        <div class="sidebar-bg-options" id="sidebar-dark-theme">
            <div class="img-ss rounded-circle bg-dark border mr-3"></div>Dark
        </div>
        <p class="settings-heading mt-2">HEADER SKINS</p>
        <div class="color-tiles mx-0 px-4">
            <div class="tiles success"></div>
            <div class="tiles warning"></div>
            <div class="tiles danger"></div>
            <div class="tiles info"></div>
            <div class="tiles dark"></div>
            <div class="tiles default"></div>
        </div>
    </div>
</div>
<!-- partial -->
{{-- <nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item ">
            <a class="nav-link" href="{{ route('home') }}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <i class="icon-layout menu-icon"></i>
                <span class="menu-title">User Management</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu  {{ request()->is('admin/permissions*') ? 'active open' : '' }} {{ request()->is('admin/roles*') ? 'active open' : '' }} {{ request()->is('admin/users*') ? 'active open' : '' }}">
                    <li class="nav-item  {{ request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.permissions.index') }}">Permissions</a></li>
                    <li class="nav-item  {{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active' : '' }}"> <a class="nav-link" href="{{ route('admin.roles.index') }}">Roles</a></li>
                    <li class="nav-item  {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : '' }}"> <a class="nav-link" href="{{ route('admin.users.index') }}">Users</a></li>
                </ul>
            </div>

        </li>

        <li class="nav-item {{ request()->is('admin/posts*') && !request()->is('admin/users*') ? 'active open' : '' }} ">
            <a class="nav-link" href="{{ route('admin.posts.index') }}">
                <i class="icon-paper menu-icon"></i>
                <span class="menu-title">Posts</span>
            </a>
        </li>
    </ul>
</nav> --}}
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('home') }}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        @can('user_management_access')
            <li
                class="nav-item {{ Request::is('admin/permissions*') ? 'active' : '' }} {{ Request::is('admin/roles*') ? 'active' : '' }} {{ Request::is('admin/users*') ? 'active' : '' }} {{ Request::is('admin/audit_logs*') ? 'active' : '' }}">
                <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                    <i class="icon-layout menu-icon"></i>
                    <span class="menu-title">User Management</span>
                    <i class="menu-arrow"></i>
                </a>

                <div class="collapse {{ Request::is('admin/permissions*') ? 'show' : '' }} {{ Request::is('admin/roles*') ? 'show' : '' }} {{ Request::is('admin/users*') ? 'show' : '' }} {{ Request::is('admin/audit_logs*') ? 'show' : '' }}"
                    id="ui-basic">
                    <ul class="nav flex-column sub-menu">
                        @can('permission_access')
                            <li class="nav-item {{ Request::is('admin/permissions*') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('admin.permissions.index') }}">Permissions</a>
                            </li>
                        @endcan

                        @can('role_access')
                            <li class="nav-item {{ Request::is('admin/roles*') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('admin.roles.index') }}">Roles</a>
                            </li>
                        @endcan

                        @can('user_access')
                            <li class="nav-item {{ Request::is('admin/users*') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('admin.users.index') }}">Users</a>
                            </li>
                        @endcan

                        @can('audit_logs_access')
                            <li class="nav-item {{ Request::is('admin/audit_logs*') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('admin.audit_logs.index') }}">Audit Logs</a>
                            </li>
                        @endcan
                    </ul>
                </div>
            </li>
        @endcan

        @can('buyer_management_access')
            <li
                class="nav-item {{ Request::is('admin/buyers*') ? 'active' : '' }} {{ Request::is('admin/product-category*') ? 'active' : '' }}
            {{ Request::is('admin/products*') ? 'active' : '' }} {{ Request::is('admin/product-order*') ? 'active' : '' }}
            {{ Request::is('admin/product-order*') ? 'active' : '' }} {{ Request::is('admin/product-order-details*') ? 'active' : '' }}  {{ Request::is('admin/product-order-status*') ? 'active' : '' }} {{Request::is('admin/product-measurements*') ? 'active' : '' }}  ">
                <a class="nav-link" data-toggle="collapse" href="#buyer" aria-expanded="false" aria-controls="buyer">
                    <i class="icon-layout menu-icon"></i>
                    <span class="menu-title">Buyer Management</span>
                    <i class="menu-arrow"></i>
                </a>


                <div class="collapse {{ Request::is('admin/buyers*') ? 'show' : '' }} {{ Request::is('admin/product-category*') ? 'show' : '' }}
                {{ Request::is('admin/products*') ? 'show' : '' }} {{ Request::is('admin/product-order/*') ? 'show' : '' }}
                {{ Request::is('admin/product-order/*') ? 'show' : '' }} {{ Request::is('admin/product-order-details/*') ? 'show' : '' }}  {{ Request::is('admin/product-order-status*') ? 'show' : '' }} {{ Request::is('admin/product-measurements*') ? 'show' : '' }}"
                    id="buyer">
                    <ul class="nav flex-column sub-menu">
                        {{-- Buyers --}}
                        @can('permission_access')
                            <li class="nav-item {{ Request::is('admin/buyers*') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('admin.buyers.index') }}">
                                    <span class="">Buyers</span>
                                </a>
                            </li>
                        @endcan

                        {{-- ProductCategory --}}
                        @can('product_category_access')
                            <li class="nav-item {{ Request::is('admin/product-category*') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('admin.product-category.index') }}">
                                    <span class="">Product Category</span>
                                </a>
                            </li>
                        @endcan

                        {{-- Product --}}
                        @can('product_access')
                            <li class="nav-item {{ Request::is('admin/products*') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('admin.products.index') }}">
                                    <span class="">Products</span>
                                </a>
                            </li>
                        @endcan

                        {{-- Product --}}
                        @can('product_measurement_access')
                            <li class="nav-item {{ Request::is('admin/product-measurements*') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('admin.product-measurements.index') }}">
                                    <span class="">Products Measurements</span>
                                </a>
                            </li>
                        @endcan

                        {{-- Product Order --}}
                        <li
                            class="nav-item {{ Request::is('admin/product-order/*') ? 'active' : '' }}  {{ Request::is('admin/product-order') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('admin.product-order.index') }}">
                                <span class="">Product Order</span>
                            </a>
                        </li>

                        {{-- Product Order Details --}}
                        <li
                            class="nav-item {{ Request::is('admin/product-order-details/*') ? 'active' : '' }}  {{ Request::is('admin/product-order-details') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('admin.product-order-details.index') }}">
                                <span class="">Product Order Details</span>
                            </a>
                        </li>

                        {{-- Product Order Status --}}
                        <li class="nav-item {{ Request::is('admin/product-order-status*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('admin.product-order-status.index') }}">
                                <span class="">Product Order Status</span>
                            </a>
                        </li>


                    </ul>

                </div>
            </li>
        @endcan

        {{-- Seller Management --}}
        @can('seller_management_access')
           <li class="nav-item {{ Request::is('admin/sellers*') ? 'active' : '' }} {{ Request::is('admin/seller-product-type*') ? 'active' : '' }} {{ Request::is('admin/seller-type*') ? 'active' : '' }} {{ Request::is('admin/seller-user-statuses*') ? 'active' : '' }}
           {{ Request::is('admin/seller*') ? 'active' : '' }}  {{ Request::is('admin/seller-product.s*') ? 'active' : '' }}">
               <a class="nav-link" data-toggle="collapse" href="#sellers" aria-expanded="false" aria-controls="buyer">
                   <i class="icon-layout menu-icon mdi mdi-sale" ></i>
                   <span class="menu-title">Seller Management</span>
                   <i class="menu-arrow"></i>
               </a>

               <div class="collapse {{ Request::is('admin/sellers*') ? 'show' : '' }} {{ Request::is('admin/seller-product-type*') ? 'show' : '' }} {{ Request::is('admin/seller-type*') ? 'show' : '' }} {{ Request::is('admin/seller-user-statuses*') ? 'show' : '' }}
               {{ Request::is('admin/seller*') ? 'show' : '' }} {{ Request::is('admin/seller-product.s*') ? 'show' : '' }}"  id="sellers">
                   <ul class="nav flex-column sub-menu">
                    @can('seller_type_access')
                            <li class="nav-item {{ Request::is('admin/seller-type*') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('admin.seller-type.index') }}">Seller Type</a>
                            </li>
                        @endcan
                       @can('permission_access')
                           <li class="nav-item {{ Request::is('admin/sellers-product-categories*') ? 'active' : '' }}">
                               <a class="nav-link" href="{{ route('admin.sellers-product-categories.index') }}">Product Category</a>
                           </li>
                       @endcan

                       @can('seller_product_type_access')
                           <li class="nav-item {{ Request::is('admin/seller-product-type*') ? 'active' : '' }}">
                               <a class="nav-link" href="{{ route('admin.seller-product-type.index') }}">Product Type</a>
                           </li>
                       @endcan

                       @can('seller_product_access')
                           <li class="nav-item {{ Request::is('admin/seller-product') ? 'active' : '' }} {{ Request::is('admin/seller-product/*') ? 'active' : '' }}">
                               <a class="nav-link" href="{{ route('admin.seller-product.index') }}">Seller Product</a>
                           </li>
                       @endcan

                        {{-- Seller --}}
                       @can('seller_access')
                           <li class="nav-item {{ Request::is('admin/seller/*') ? 'active' : '' }} {{ Request::is('admin/seller') ? 'active' : '' }}">
                               <a class="nav-link" href="{{ route('admin.seller.index') }}">Seller</a>
                           </li>
                       @endcan

                       @can('seller_user_status_access')
                           <li class="nav-item {{ Request::is('admin/seller-user-statuses*') ? 'active' : '' }}">
                               <a class="nav-link" href="{{ route('admin.seller-user-statuses.index') }}">Seller User Status</a>
                           </li>
                       @endcan

                   </ul>

               </div>
           </li>
        @endcan

        {{-- Measurement --}}
        @can('measurement_access')
            <li class="nav-item {{ Request::is('admin/measurement*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.measurement.index') }}">
                    <i class="icon-layout menu-icon"></i>
                    <span class="menu-title">Measurement</span>
                </a>
            </li>
        @endcan



        {{-- Status --}}
        @can('status_access')
            <li class="nav-item {{ Request::is('admin/status*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.status-all.index') }}">
                    <i class="icon-layout menu-icon"></i>
                    <span class="menu-title">Status</span>
                </a>
            </li>
        @endcan



        {{-- Post --}}
        <li class="nav-item {{ Request::is('admin/posts*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.posts.index') }}">
                <i class="icon-paper menu-icon"></i>
                <span class="menu-title">Posts</span>
            </a>
        </li>
        <li class="nav-item {{ Request::is('admin/system-calendar*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.systemCalendar') }}">
                <i class="mdi mdi-calendar menu-icon"></i>
                <span class="menu-title">System Calander</span>
            </a>
        </li>

        {{-- ProductCategoryPrices --}}
        @can('product_category_prices_access')
        <li class="nav-item {{ Request::is('admin/product-category-prices') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.product-category-prices.index') }}">
                <i class="icon-paper menu-icon"></i>
                <span class="menu-title">Product Category Prices</span>
            </a>
        </li>
    @endcan
    </ul>
</nav>



@section('scripts')
@endsection
