<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
{{--        <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"--}}
{{--             style="opacity: .8">--}}
        <span class="brand-text font-weight-light">Dashboard</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{auth()->user()->name}}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{url('admin/complaints')}}" class="nav-link">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>
                            Complaints
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{url('admin/category/')}}" class="nav-link">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>
                            Category
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{url('admin/user')}}" class="nav-link">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>
                            User
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{url('admin/employee')}}" class="nav-link">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>
                            Employee
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{url('admin/assets')}}" class="nav-link">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>
                             Assets
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{url('admin/quote')}}" class="nav-link">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>
                           Quote
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{url('admin/invoice/')}}" class="nav-link">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>
                            Bill/Invoice
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{url('admin/product')}}" class="nav-link">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>
                            Products
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{url('admin/boq')}}" class="nav-link">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>
                            Service/BOQ
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{url('admin/documents')}}" class="nav-link">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>
                            Document/Agreement
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{url('/admin/employee/availability/create')}}" class="nav-link">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>
                            Employee Availability
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{url('/admin/supplier')}}" class="nav-link">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>
                            Supplier
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{url('/admin/delivery')}}" class="nav-link">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>
                            Delivery Challan
                        </p>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
