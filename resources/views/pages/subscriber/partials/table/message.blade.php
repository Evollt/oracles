@if (true === $subscriber->receive_message)
    <x-setting.status color="success" title="Yes"/>
@else
    <x-setting.status color="danger" title="No"/>
@endif
