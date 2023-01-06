@if (null !== $scam->scamCategory)
    <x-setting.status color="{{ $scam->scamCategory->color->id }}" title="{{ $scam->scamCategory->name }}"/>
@else
-
@endif
