@if (!in_array($role->name, ['developer', 'super-admin', 'admin']))
    @can('role.edit')
        <a href="{{ route('roles.edit', $role->id) }}" class="text-gray-400 mr-1"><i class="fas fa-pen"></i></a>
    @endcan
    @can('role.delete')
        <a data-modal href="{{ route('roles.delete', $role->id) }}" class="text-gray-400"><i class="fas fa-trash"></i></a>
    @endcan
@endif
