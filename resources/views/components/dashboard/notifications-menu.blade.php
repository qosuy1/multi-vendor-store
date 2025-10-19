<li class="nav-item dropdown">
    <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa-bell"></i>
        <span class="badge badge-warning navbar-badge">{{ $newNotificationsCount }}</span>
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <span class="dropdown-header"> <b style="color: blue"> {{ $newNotificationsCount }} </b> New Notifications | From
            <b>{{ $allNotificationsCount }}
            </b></span>
        <div class="dropdown-divider"></div>
        @foreach ($notifications as $notification)
            <a href="{{ $notification->data['url'] }}?notification_id={{ $notification->id }}"
                class="dropdown-item @if ($notification->unread()) {{ 'text-bold' }} @endif">
                <i class="{{ $notification->data['icon'] }}"></i> {{ $notification->data['title'] }}
                <span
                    class="float-right text-muted text-sm">{{ $notification->created_at->longAbsoluteDiffForHumans() }}</span>
            </a>
            <div class="dropdown-divider mt-3"></div>
        @endforeach
        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
    </div>
</li>
