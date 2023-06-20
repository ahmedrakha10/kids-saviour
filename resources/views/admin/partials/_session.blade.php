@if (session('success'))

    <script>
        new Noty({
            layout: @if(app()->getLocale() == 'ar') 'topLeft' @else 'topRight' @endif,
            text: "{{ session('success') }}",
            theme: 'relax',
            type: 'success',
            timeout: 2000,
            killer: true
        }).show();
    </script>

@endif

@if(session('error'))

    <script>
        new Noty({
            layout: @if(app()->getLocale() == 'ar') 'topLeft' @else 'topRight' @endif,
            text: "{{ session('error') }}",
            theme: 'relax',
            type: 'error',
            timeout: 2000,
            killer: true
        }).show();
    </script>

@endif
