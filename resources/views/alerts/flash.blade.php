@if(session()->has('flash_notification'))
    <script>
        swal({
            title: "{{ session()->get('flash_notification.title') }}",
            text: "{{ session()->get('flash_notification.message') }}",
            type: "{{ session()->get('flash_notification.type') }}",
            showConfirmButton: false,

            @if(session()->has('flash_notification.timer'))
                timer: "{{ session()->get('flash_notification.timer') }}",
            @endif
        });
    </script>
@endif

@if(session()->has('flash_notification_overlay'))
    <script>
        swal({
            title: "{{ session()->get('flash_notification_overlay.title') }}",
            text: "{{ session()->get('flash_notification_overlay.message') }}",
            type: "info",
            confirmButtonText: "Okay",
        });
    </script>
@endif

@if(session()->has('flash_notification_aside'))
    {{--Element used for side flash messages. Initially hidden and triggered by JS--}}
    <div class="flash">
        <div>{{ session()->get('flash_notification_aside.message') }}</div>
    </div>

    <script>
        $('.flash').fadeIn(500).delay(1000).fadeOut(500);
    </script>
@endif