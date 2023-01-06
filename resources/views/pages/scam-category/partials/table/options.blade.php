@can('scam-category.edit')
    <a href="{{ route('scam-category.edit', $scamCategory->id) }}" class="text-gray-400 mr-1"><i class="fas fa-pen"></i></a>
@endcan
@can('scam-category.delete')
    <a data-modal href="{{ route('scam-category.delete', $scamCategory->id) }}" class="text-gray-400"><i class="fas fa-trash"></i></a>
@endcan
