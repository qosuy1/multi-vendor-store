<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        @foreach ($items as $item)
            @if (isset($item['subList']))
                @php
                    $isActive = Route::is($item['active']);
                @endphp
                <li class="nav-item menu{{ $isActive == true ? '-open' : '' }}">
                    <a href="{{ route($item['route']) }}"
                        class="nav-link {{ $isActive == true ? 'active' : '' }}">
                        <i class="{{ $item['icon'] }}"></i>
                        <p>
                            {{ $item['title'] }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        @foreach ($item['subList'] as $subList)
                            <li class="nav-item">
                                <a href="{{ route($subList['route']) }}"
                                    class="nav-link {{ url()->current() == route($subList['route']) ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{ $subList['title'] }}</p>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @else
                <li class="nav-item">
                    <a href="{{ route($item['route']) }}"
                        class="nav-link {{ url()->current() == route($item['route']) ? 'active' : '' }}">
                        <i class="{{ $item['icon'] }}"></i>
                        <p>
                            {{ $item['title'] }}
                            @isset($item['badge'])
                                <span class="right badge badge-danger">{{ $item['badge'] }}</span>
                            @endisset
                        </p>
                    </a>
                </li>
            @endif
        @endforeach
    </ul>
</nav>
