@if (session()->has('error'))
    <div id="alert-1" class="mt-4 alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<script>
    $(document).ready(function() {
        setTimeout(function() {
            $('#alert-1').fadeOut('2000');
        }, 3000);
    });
</script>
