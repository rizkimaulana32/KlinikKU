 @if (session()->has('success'))
     <div id="alert-2" class="mt-4 alert alert-success alert-dismissible fade show" role="alert">
         {{ session('success') }}
         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
     </div>
 @endif

 <script>
     $(document).ready(function() {
         setTimeout(function() {
             $('#alert-2').fadeOut('2000');
         }, 3000);
     });
 </script>
