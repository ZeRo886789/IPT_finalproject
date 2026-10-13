@php
$nav = [
    ['route'=>'dashboard','label'=>'Dashboard','icon'=>'⌂'],
    ['route'=>'customers.index','label'=>'Customers','icon'=>'♙'],
    ['route'=>'employees.index','label'=>'Employees','icon'=>'✦'],
    ['route'=>'orders.index','label'=>'Clothing Orders','icon'=>'▣'],
    ['route'=>'measurements.index','label'=>'Measurements','icon'=>'⌁'],
    ['route'=>'payments.index','label'=>'Payments','icon'=>'₱'],
];
@endphp
<div class="nav-section">WORKSPACE</div>
<nav class="nav-menu">
@foreach($nav as $item)
    <a href="{{ route($item['route']) }}" class="{{ request()->routeIs($item['route'].'*')?'active':'' }}">
        <span class="nav-icon">{{ $item['icon'] }}</span>{{ $item['label'] }}
    </a>
@endforeach
</nav>
