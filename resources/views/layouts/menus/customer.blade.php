<li class="nav-item {{ request()->routeIs('customer.order.create') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('customer.order.create') }}">
        {{ __('Create Order') }}
    </a>
</li>

<li class="nav-item {{ request()->routeIs('customer.order.index') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('customer.order.index') }}">
        {{ __('Manage Order') }}
    </a>
</li>

<li class="nav-item {{ request()->routeIs('customer.report.index') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('customer.report.index') }}">
        {{ __('Order History') }}
    </a>
</li>

<li class="nav-item {{ request()->routeIs('customer.employee.*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('customer.employee.index') }}">
        {{ __('Employee') }}
    </a>
</li>

<li class="nav-item {{ request()->routeIs('customer.profile.*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('customer.profile.edit') }}">
        {{ __('Profile') }}
    </a>
</li>
