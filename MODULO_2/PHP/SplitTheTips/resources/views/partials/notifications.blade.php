@auth
    <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="notificationsDropdown" data-bs-toggle="dropdown" aria-expanded="false">
            Notificaciones ({{ auth()->user()->unreadNotifications->count() }})
        </button>
        <ul class="dropdown-menu" aria-labelledby="notificationsDropdown">
            @forelse(auth()->user()->notifications as $notification)
                <li>
                    <a class="dropdown-item {{ $notification->read_at ? 'text-muted' : 'fw-bold' }}" href="#">
                        {{ $notification->data['message'] }}
                        <small class="d-block text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                    </a>
                </li>
            @empty
                <li><a class="dropdown-item" href="#">No hay notificaciones</a></li>
            @endforelse
            @if(auth()->user()->notifications->isNotEmpty())
                <li><hr class="dropdown-divider"></li>
                <li>
                    <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('mark-as-read').submit();">
                        Marcar todas como leídas
                    </a>
                    <form id="mark-as-read" action="{{ route('notifications.markAsRead') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            @endif
        </ul>
    </div>
@endauth