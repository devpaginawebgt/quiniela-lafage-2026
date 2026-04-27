import './bootstrap';
import 'flowbite';
import { initToastErrors } from './components/toast-errors';
import { initPasswordToggle } from './components/password-toggle';
import.meta.glob(['../fonts/**']);

document.addEventListener('DOMContentLoaded', () => {
    initToastErrors();
    initPasswordToggle();
});

import Swiper from 'swiper';
import { Autoplay, Pagination } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/pagination';

Swiper.use([Autoplay, Pagination]);
window.Swiper = Swiper;