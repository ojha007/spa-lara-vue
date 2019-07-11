<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
        <img src="{{asset('logo/logo.jpg')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">laravel-Vue</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('logo/man.png')}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Alexander Pierce</a>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <router-link
                        to="/dashboard"
                        class="nav-link">
                        <i class="nav-icon fa fa-desktop"></i>
                        <p>
                            Dashboard
                        </p>
                    </router-link>
                </li>

                <li class="nav-item">
                    <router-link
                        to="/user"
                        class="nav-link">
                        <i class="nav-icon fa fa-user-circle"></i>
                        <p>
                            User
                        </p>
                    </router-link>

                </li>
                <li class="nav-item">
                    <router-link
                        to="/blog"
                        class="nav-link">
                        <i class="nav-icon fa fa-blog"></i>
                        <p>
                            Blogs
                        </p>
                    </router-link>

                </li>
                <li class="nav-item">
                    <router-link
                        to="/product"
                        class="nav-link">
                        <i class="nav-icon fab fa-buromobelexperte"></i>
                        <p>
                            Products
                        </p>
                    </router-link>

                </li>
                <li class="nav-item">
                    <router-link
                        to="/brand"
                        class="nav-link">
                        <i class="nav-icon fab fa-product-hunt"></i>
                        <p>
                            Brands
                        </p>
                    </router-link>

                </li>

                <li class="nav-item">
                    <router-link to="/login" class="nav-link">
                        <i class="nav-icon fa fa-sign-out-alt"></i>
                        <p>
                            Logout
                        </p>
                    </router-link>
                </li>
            </ul>
        </nav>

    </div>

</aside>
