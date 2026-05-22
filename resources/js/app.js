import Alpine from 'alpinejs';
import Swiper from 'swiper';
import { Navigation, Pagination, Autoplay } from 'swiper/modules';

// Import Swiper styles
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';

// ── Alpine.js Setup ──────────────────────────────
window.Alpine = Alpine;

Alpine.start();

// ── Swiper Helper ────────────────────────────────
// Expose a factory so Blade templates can init carousels easily
window.initSwiper = function (selector, options = {}) {
    const defaults = {
        modules: [Navigation, Pagination, Autoplay],
        loop: true,
        autoplay: {
            delay: 4000,
            disableOnInteraction: false,
        },
        pagination: {
            el: `${selector} .swiper-pagination`,
            clickable: true,
        },
        navigation: {
            nextEl: `${selector} .swiper-button-next`,
            prevEl: `${selector} .swiper-button-prev`,
        },
    };

    return new Swiper(selector, { ...defaults, ...options });
};
