const container = document.querySelector('.containerLoading');
document.addEventListener('DOMContentLoaded', function() {
    container.style.display = 'none';
    window.location.href = document.referrer;
});