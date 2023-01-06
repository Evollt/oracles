@if (null !== $scam->scamStatus)
    <x-setting.status color="{{ $scam->scamStatus->color->id }}" title="{{ $scam->scamStatus->name }}"/>
@else
-
@endif
