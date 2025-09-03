import '@fortawesome/fontawesome-free/css/all.min.css';
import 'animate.css';
import AOS from 'aos';
import 'aos/dist/aos.css';
import Alpine from 'alpinejs';
import "flatpickr/dist/flatpickr.min.css";



window.Alpine = Alpine;
Alpine.start();



const mobileMenuButton = document.getElementById("mobile-menu-button");
const closeMobileMenu = document.getElementById("close-mobile-menu");
const mobileSidebar = document.getElementById("mobile-sidebar");
const mobileOverlay = document.getElementById("mobile-overlay");

function openMenu() {
    mobileSidebar.classList.add("open");
    mobileSidebar.classList.remove("closed");

    mobileOverlay.classList.remove("invisible");
    mobileOverlay.style.opacity = "1";
    mobileOverlay.style.pointerEvents = "auto";

    mobileMenuButton.classList.add("hamburger-open");
}


function closeMenu() {
    mobileSidebar.classList.remove("open");
    mobileSidebar.classList.add("closed");

    mobileOverlay.style.opacity = "0";
    mobileOverlay.style.pointerEvents = "none";
    setTimeout(() => {
        mobileOverlay.classList.add("invisible");
    }, 300); // Tiempo igual a la duración del fade (300ms)

    mobileMenuButton.classList.remove("hamburger-open");
}

function toggleMenu() {
    if (mobileSidebar.classList.contains("open")) {
        closeMenu();
    } else {
        openMenu();
    }
}

mobileMenuButton.addEventListener("click", toggleMenu);
closeMobileMenu.addEventListener("click", toggleMenu);
mobileOverlay.addEventListener("click", toggleMenu);

// Cerrar menú cuando hacen click en un enlace del sidebar
document.querySelectorAll("#mobile-sidebar nav a").forEach((link) => {
    link.addEventListener("click", toggleMenu);
});

// gallery lightbox
document.addEventListener('DOMContentLoaded', function() {
    const galleryLinks = document.querySelectorAll('a[href^="img/gallery/"]');

    galleryLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const imgSrc = this.getAttribute('href');
            const lightbox = document.createElement('div');
            lightbox.className =
                'fixed inset-0 bg-black bg-opacity-90 z-50 flex items-center justify-center p-4';
            lightbox.innerHTML = `
            <div class="relative max-w-4xl w-full">
                <img src="${imgSrc}" class="max-h-screen w-full object-contain" alt="Gallery Image">
                <button class="absolute top-4 right-4 text-white text-3xl">&times;</button>
            </div>
        `;

            document.body.appendChild(lightbox);

            lightbox.querySelector('button').addEventListener('click', function() {
                document.body.removeChild(lightbox);
            });
        });
    });
});

