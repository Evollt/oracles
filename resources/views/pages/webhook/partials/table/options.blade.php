@can('webhook.edit')
    <a href="{{ route('webhook.edit', $webhook->id) }}" class="text-gray-400 mr-1"><i class="fas fa-pen"></i></a>
@endcan
@can('webhook.delete')
    <a data-modal href="{{ route('webhook.delete', $webhook->id) }}" class="text-gray-400"><i class="fas fa-trash"></i></a>
@endcan
