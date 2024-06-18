<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('AdminLTE-2/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ auth()->user()->name }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li>
                <a href="{{ route('dashboard') }}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>

            <li class="header">MASTER</li>
            <li>
                <a href="{{ route('category.index') }}">
                    <i class="fa fa-cube" aria-hidden="true"></i> <span>Category</span>
                </a>
            </li>
            <li>
                <a href="{{ route('product.index') }}">
                    <i class="fa fa-cubes" aria-hidden="true"></i> <span>Product</span>
                </a>
            </li>
            <li>
                <a href="{{ route('customer.index') }}">
                    <i class="fa fa-users" aria-hidden="true"></i> <span>Customer</span>
                </a>
            </li>
            <li>
                <a href="{{ route('supplier.index') }}">
                    <i class="fa fa-truck" aria-hidden="true"></i> <span>Supplier</span>
                </a>
            </li>

            <li class="header">TRANSACTION</li>
            <li>
                <a href="{{ route('expenditure.index') }}">
                    <i class="fa fa-money" aria-hidden="true"></i> <span>Expenditure</span>
                </a>
            </li>
            <li>
                <a href="{{ route('purchase.index') }}">
                    <i class="fa fa-download" aria-hidden="true"></i> <span>Purchase</span>
                </a>
            </li>
            <li>
                <a href="{{ route('sale.index') }}">
                    <i class="fa fa-upload" aria-hidden="true"></i> <span>Sale</span>
                </a>
            </li>

            <li class="header">ACCOUNT</li>
            <li>
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fa fa-sign-out" aria-hidden="true"></i> <span>Logout</span>
                </a>
                <form id="logout-form-modal" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
