// Service Worker Register
if ('serviceWorker' in navigator) {
    window.addEventListener('load', function () {
        navigator.serviceWorker.register('https://www.example.com/service-worker.js')
            .then(registration => {
            })
            .catch(err => {
            });
    });
}
