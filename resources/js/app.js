console.log('app.js loaded');

try {
    import './bootstrap';
    import 'bootstrap/dist/js/bootstrap.bundle.min.js';
    import './header.js';
    import './footer.js';
    import Alpine from 'alpinejs';
    import toastr from 'toastr';
    import 'toastr/build/toastr.css';

    import Dropzone from 'dropzone';

    import 'dropzone/dist/dropzone.css';

    window.Dropzone = Dropzone;

    window.Alpine = Alpine;
    window.toastr = toastr;

    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
    };

    Alpine.start();
} catch (e) {
    console.error('Error in app.js', e);
}