@can('color.edit')
    <a href="{{ route('color.edit', $color->id) }}" class="text-gray-400 mr-1"><i class="fas fa-pen"></i></a>
@endcan
@can('color.delete')
    <a data-modal href="{{ route('color.delete', $color->id) }}" class="text-gray-400"><i class="fas fa-trash"></i></a>
@endcan
