@can('users.view')
    <a href="{{ route('users.show', $user->id) }}" class="text-gray-400 mr-1"><i class="fas fa-eye"></i></a>
@endcan
@if (!in_array($user->roles->first()->name ?? '-', ['developer', 'super-admin']) || Auth::user()->hasRole('developer'))
    @can('users.role')
        <a data-modal href="{{ route('users.role-modal', $user->id) }}" class="text-gray-400"><i class="fas fa-pen"></i></a>
    @endcan
    @can('users.deactivate')
        @if (null !== $user->deactivated_at)
            <a data-modal href="{{ route('users.active-modal', $user->id) }}" class="text-gray-400"><i class="fas fa-toggle-off"></i></a>
        @else
            <a data-modal href="{{ route('users.active-modal', $user->id) }}" class="text-gray-400"><i class="fas fa-toggle-on"></i></a>
        @endif
    @endcan
@endif
