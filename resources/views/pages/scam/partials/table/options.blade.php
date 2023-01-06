@can('scam.edit')
    <a href="{{ route('scam.edit', $scam->id) }}" class="text-gray-400 mr-1"><i class="fas fa-pen"></i></a>
@endcan
@can('scam.delete')
    <a data-modal href="{{ route('scam.delete', $scam->id) }}" class="text-gray-400"><i class="fas fa-trash"></i></a>
@endcan
