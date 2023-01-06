@can('scam-status.edit')
    <a href="{{ route('scam-status.edit', $scamStatus->id) }}" class="text-gray-400 mr-1"><i class="fas fa-pen"></i></a>
@endcan
@can('scam-status.delete')
    <a data-modal href="{{ route('scam-status.delete', $scamStatus->id) }}" class="text-gray-400"><i class="fas fa-trash"></i></a>
@endcan
