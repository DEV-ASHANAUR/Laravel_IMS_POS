@php
    $prefix = Request::route()->getPrefix();
    $route = Route::current()->getName();
@endphp

<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link" href="{{ route('home') }}"
                    ><div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard</a>
                {{-- <div class="sb-sidenav-menu-heading">Interface</div> --}}
                {{-- manage user start --}}
                @if(Auth::user()->usertype=='Admin')
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts1" aria-expanded="false" aria-controls="collapseLayouts"
                    ><div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Manage Employee
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div
                ></a>
                <div class="collapse {{ ($prefix == '/users')?'show':'' }}" id="collapseLayouts1" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav"><a class="nav-link {{ ($route == 'users.view')?'active':'' }}" href="{{ route('users.view') }}">View Employee</a>
                </div>
                @endif
                {{-- manage user end --}}
                {{-- manage suppliers start --}}
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts2" aria-expanded="false" aria-controls="collapseLayouts"
                    ><div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Manage Suppliers
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div
                ></a>
                <div class="collapse {{ ($prefix == '/suppliers')?'show':'' }}" id="collapseLayouts2" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav"><a class="nav-link {{ ($route == 'suppliers.view')?'active':'' }}" href="{{ route('suppliers.view') }}">View Suppliers</a>
                </div>
                {{-- manage Suppliers end --}}
                {{-- manage customers start --}}
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayoutscus" aria-expanded="false" aria-controls="collapseLayouts"
                    ><div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Manage Customer
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div
                ></a>
                <div class="collapse {{ ($prefix == '/customers')?'show':'' }}" id="collapseLayoutscus" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link {{ ($route == 'customers.view')?'active':'' }}" href="{{ route('customers.view') }}">View Customer</a>

                        <a class="nav-link {{ ($route == 'customers.credit')?'active':'' }}" href="{{ route('customers.credit') }}">Credit Customer</a>

                        <a class="nav-link {{ ($route == 'customers.paid')?'active':'' }}" href="{{ route('customers.paid') }}">Paid Customer</a>
                </div>
                {{-- manage customers end --}}
                {{-- manage Unit start --}}
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts3" aria-expanded="false" aria-controls="collapseLayouts"
                    ><div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Manage Units
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div
                ></a>
                <div class="collapse {{ ($prefix == '/units')?'show':'' }}" id="collapseLayouts3" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav"><a class="nav-link {{ ($route == 'units.view')?'active':'' }}" href="{{ route('units.view') }}">View Units</a>
                </div>
                {{-- manage unit end --}}
                {{-- manage categories start --}}
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts4" aria-expanded="false" aria-controls="collapseLayouts"
                    ><div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Manage Categories
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div
                ></a>
                <div class="collapse {{ ($prefix == '/categories')?'show':'' }}" id="collapseLayouts4" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav"><a class="nav-link {{ ($route == 'categories.view')?'active':'' }}" href="{{ route('categories.view') }}">View Categories</a>
                </div>
                {{-- manage categories end --}}
                {{-- manage product start --}}
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts5" aria-expanded="false" aria-controls="collapseLayouts"
                    ><div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Manage Product
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div
                ></a>
                <div class="collapse {{ ($prefix == '/products')?'show':'' }}" id="collapseLayouts5" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav"><a class="nav-link {{ ($route == 'categories.view')?'active':'' }}" href="{{ route('products.view') }}">View Product</a>
                </div>
                {{-- manage product end --}}
                {{-- manage purchase start --}}
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts6" aria-expanded="false" aria-controls="collapseLayouts"
                    ><div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Manage Purchase
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div
                ></a>
                <div class="collapse {{ ($prefix == '/purchase')?'show':'' }}" id="collapseLayouts6" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav"><a class="nav-link {{ ($route == 'purchase.view')?'active':'' }}" href="{{ route('purchase.view') }}">View Purchase</a>

                    <a class="nav-link {{ ($route == 'pending.view.list')?'active':'' }}" href="{{ route('pending.view.list') }}">View Pending</a>
                </div>
                {{-- manage purchase end --}}
                {{-- manage invoice start --}}
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts7" aria-expanded="false" aria-controls="collapseLayouts"
                    ><div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Manage Invoice
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div
                ></a>
                <div class="collapse {{ ($prefix == '/invoice')?'show':'' }}" id="collapseLayouts7" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav"><a class="nav-link {{ ($route == 'invoice.view')?'active':'' }}" href="{{ route('invoice.view') }}">View Invoice</a>

                    <a class="nav-link {{ ($route == 'invoice.pending.list')?'active':'' }}" href="{{ route('invoice.pending.list') }}">Approval Invoice</a>

                    <a class="nav-link {{ ($route == 'invoice.daily.report')?'active':'' }}" href="{{ route('invoice.daily.report') }}">Daily Invoice Report</a>
                </div>
                {{-- manage invoice end --}}
                {{-- manage stock start --}}
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts8" aria-expanded="false" aria-controls="collapseLayouts"
                    ><div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Manage Stock
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div
                ></a>
                <div class="collapse {{ ($prefix == '/stock')?'show':'' }}" id="collapseLayouts8" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav"><a class="nav-link {{ ($route == 'stock.report')?'active':'' }}" href="{{ route('stock.report') }}">Stock Report</a>
                </div>
                {{-- manage stock end --}}
                
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in As : @php
                echo Auth::user()->usertype 
              @endphp</div>
            
        </div>
    </nav>
</div>