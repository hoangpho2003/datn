<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function showConfirmPopup(options = {}) {
        const {
            title = 'Are you sure?', text = 'Please confirm your action.', confirmText = 'Confirm', cancelText =
                'Cancel', icon = 'question', confirmColor = '#0ea5e9', cancelColor = '#ef4444'
        } = options;

        return Swal.fire({
            title,
            text,
            icon,
            showCancelButton: true,
            confirmButtonText: confirmText,
            cancelButtonText: cancelText,
            confirmButtonColor: confirmColor,
            cancelButtonColor: cancelColor,
            background: '#f0f9ff',
            color: '#082f49',
            showClass: {
                popup: 'animate__animated animate__zoomIn'
            },
            hideClass: {
                popup: 'animate__animated animate__fadeOut'
            },
            customClass: {
                popup: 'big-popup shadow-2xl rounded-3xl p-6',
                title: 'big-title',
                confirmButton: 'big-button',
                cancelButton: 'cancel-button'
            }
        });
    }
</script>
