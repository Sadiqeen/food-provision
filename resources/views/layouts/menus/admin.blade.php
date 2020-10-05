<li class="nav-item {{ request()->routeIs( 'admin.order.*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route( 'admin.order.index') }}">
        {{ __('Orders') }}
    </a>
</li>

<li class="nav-item dropdown {{ request()->routeIs('admin.brand.*')
                    || request()->routeIs('admin.category.*')
                    || request()->routeIs('admin.product.*')
                    || request()->routeIs('admin.unit.*')
                    ? 'active' : '' }}">
    <a aria-expanded="false" aria-haspopup="true" class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id="productDropdown" role="button">
        {{ __('Catalog') }}
    </a>
    <div aria-labelledby="productDropdown" class="dropdown-menu mb-3">
        <a class="dropdown-item {{ request()->routeIs('admin.product.*') ? 'active' : '' }}" href="{{ route('admin.product.index') }}">
            {{ __('Product') }}
        </a>
        <a class="dropdown-item {{ request()->routeIs('admin.category.*') ? 'active' : '' }}" href="{{ route('admin.category.index') }}">
            {{ __('Category') }}
        </a>
        <a class="dropdown-item {{ request()->routeIs('admin.brand.*') ? 'active' : '' }}" href="{{ route('admin.brand.index') }}">
            {{ __('Brand') }}
        </a>
        <a class="dropdown-item {{ request()->routeIs('admin.unit.*') ? 'active' : '' }}" href="{{ route('admin.unit.index') }}">
            {{ __('Unit') }}
        </a>
    </div>
</li>

<li class="nav-item {{ request()->routeIs('admin.customer.*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('admin.customer.index') }}">
        {{ __('Customer') }}
    </a>
</li>

<li class="nav-item {{ request()->routeIs('admin.supplier.*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('admin.supplier.index') }}">
        {{ __('Supplier') }}
    </a>
</li>

<li class="nav-item {{ request()->routeIs('admin.report.*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('admin.report.index') }}">
        {{ __('Report') }}
    </a>
</li>

<li class="nav-item {{ request()->routeIs('admin.setting.*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('admin.setting.edit') }}">
        {{ __('Setting') }}
    </a>
</li>
