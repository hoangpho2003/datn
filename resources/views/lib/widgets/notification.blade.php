<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if (session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
                timer: 3000,
                showConfirmButton: false,
                position: 'top-end',
                toast: true,
                timerProgressBar: true
            });
        });
    </script>
@endif

@if (session('error'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'error',
                title: 'Failed!',
                text: '{{ session('error') }}',
                timer: 3000,
                showConfirmButton: false,
                position: 'top-end',
                toast: true,
                timerProgressBar: true
            });
        });
    </script>
@endif
