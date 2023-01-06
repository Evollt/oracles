@if (null !== $user->email_verified_at)
    {{ $user->email }} <x-setting.status color="success" title="✓ Verified"/>

@else
    {{ $user->email ?? "-" }}
@endif
