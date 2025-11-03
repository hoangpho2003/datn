import Swal from 'sweetalert2';
import 'animate.css';

export function showConfirmPopup(options = {}) {
    const {
        title = 'Are you sure?',
        text = 'Please confirm your action.',
        confirmText = 'Confirm',
        cancelText = 'Cancel',
        icon = 'question',
        confirmColor = '#0ea5e9',
        cancelColor = '#ef4444'
    } = options;

    return Swal.fire({
        title,
        text,
        icon,
        background: '#f0f9ff',
        color: '#082f49',
        showCancelButton: true,
        confirmButtonText: confirmText,
        cancelButtonText: cancelText,
        confirmButtonColor: confirmColor,
        cancelButtonColor: cancelColor,
        showClass: { popup: 'animate__animated animate__zoomIn' },
        hideClass: { popup: 'animate__animated animate__fadeOut' },
        customClass: {
            popup: 'big-popup shadow-2xl rounded-3xl p-6',
            title: 'big-title',
            confirmButton: 'big-button',
            cancelButton: 'cancel-button'
        }
    });
}

export function showSuccessPopup(message = 'Action completed successfully!') {
    return Swal.fire({
        title: '🎉 Success!',
        text: message,
        icon: 'success',
        background: '#f0fdf4',
        color: '#14532d',
        confirmButtonText: 'OK, Got it!',
        confirmButtonColor: '#16a34a',
        showClass: { popup: 'animate__animated animate__zoomIn' },
        hideClass: { popup: 'animate__animated animate__fadeOut' },
        timer: 3000,
        timerProgressBar: true,
        position: 'center',
        customClass: {
            popup: 'big-popup shadow-2xl rounded-3xl p-6',
            title: 'big-title',
            confirmButton: 'big-button'
        },
        timer: 3000,
        timerProgressBar: true,
        position: 'center',
        customClass: {
            popup: 'big-popup shadow-2xl rounded-3xl p-6',
            title: 'big-title',
            confirmButton: 'big-button'
        }
    });
}
