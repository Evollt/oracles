@can('subscriber.edit')
    <a href="{{ route('subscriber.edit', $subscriber->id) }}" class="text-gray-400 mr-1"><i class="fas fa-pen"></i></a>
@endcan
@can('subscriber.delete')
    <a data-modal href="{{ route('subscriber.delete', $subscriber->id) }}" class="text-gray-400"><i class="fas fa-trash"></i></a>
@endcan
