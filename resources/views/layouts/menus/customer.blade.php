<li class="nav-item {{ request()->routeIs( 'customer.order.*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route( 'customer.order.index') }}">
        {{ __('Orders') }}
    </a>
</li>

<li class="nav-item {{ request()->routeIs( 'customer.order.*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route( 'customer.order.index') }}">
        {{ __('Report') }}
    </a>
</li>

<li class="nav-item {{ request()->routeIs( 'customer.order.*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route( 'customer.order.index') }}">
        {{ __('Profile') }}
    </a>
</li>
