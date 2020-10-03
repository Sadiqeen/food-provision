<li class="nav-item {{ request()->routeIs('employee.order.create') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('employee.order.create') }}">
        {{ __('Create new order') }}
    </a>
</li>

<li class="nav-item {{ request()->routeIs('employee.order.index') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('employee.order.index') }}">
        {{ __('Manage Orders') }}
    </a>
</li>

<li class="nav-item {{ request()->routeIs('employee.profile.edit') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('employee.profile.edit') }}">
        {{ __('Profile') }}
    </a>
</li>
