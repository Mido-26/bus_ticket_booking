function showToast(type, message, len) {
    const toastBox = document.getElementById('toast-box');
    const toast = document.createElement('div');
    
    toast.classList.add('toast', type);
    toast.innerHTML = `<i class="fa-solid fa-${type === 'error' ? 'circle-xmark' : type === 'warning' ? 'circle-exclamation' : 'circle-check'} ${type}"></i> ${message}`;
    // alert('show toast')
    toastBox.style.display = "flex";
    toastBox.appendChild(toast);

    setTimeout(() => {
        toast.remove();
        if (toastBox.childElementCount === 0) {
            toastBox.style.display = "none";
        }
    }, len);
}

// Example usage of showToast
$(document).ready(function() {
    $('#bt').on('click', function(e) {
        e.preventDefault();
        // alert('clicked')
        showToast('warning', 'This is a custom toast message!', 30000);
    });
});
