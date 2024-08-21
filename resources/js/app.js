// import './bootstrap';
// import '@tabler/core';

import.meta.glob([
  '../images/**',
]);

import Alpine from 'alpinejs';
import bootstrap from 'bootstrap/dist/js/bootstrap'

window.Alpine = Alpine;
window.bootstrap = bootstrap
Alpine.start();
