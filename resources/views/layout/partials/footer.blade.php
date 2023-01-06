<script>
    window.locale = "{{ app()->getLocale() }}";
    window.abi = @include('layout.partials.abi')
    window.address = "{{ env('TOKEN_CONTRACT') }}";
</script>
<script type="text/javascript" src="{{ mix('backend/js/app.js') }}"></script>
@stack('scripts')
