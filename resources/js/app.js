import './bootstrap';
import 'bootstrap/dist/js/bootstrap.bundle.min.js';
import './header.js';
import Alpine from 'alpinejs';

import Dropzone from 'dropzone';

import 'dropzone/dist/dropzone.css';

window.Dropzone = Dropzone;

window.Alpine = Alpine;

Alpine.start();