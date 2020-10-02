<li class="nav-item dropdown {{ request()->routeIs('customer.order.*') ? 'active' : '' }}">
    <a aria-expanded="false" aria-haspopup="true" class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id="orderDropdown" role="button">
        {{ __('Orders') }}
    </a>
    <div aria-labelledby="orderDropdown" class="dropdown-menu mb-3">
        <a class="dropdown-item {{ request()->routeIs('customer.order.create') ? 'active' : '' }}" href="{{ route('customer.order.create') }}">
            {{ __('Create new order') }}
        </a>
        <a class="dropdown-item {{ request()->routeIs('customer.order.index') ? 'active' : '' }}" href="{{ route('customer.order.index') }}">
            {{ __('All order') }}
        </a>
    </div>
</li>


<li class="nav-item">
    <a class="nav-link" href="javascript:void(0)">
        {{ __('Report') }}
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="javascript:void(0)">
        {{ __('Profile') }}
    </a>
</li>
