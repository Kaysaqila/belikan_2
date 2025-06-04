import './bootstrap';
document.addEventListener('DOMContentLoaded', function () {
    const parallaxImage = document.querySelector('.parallax-image');
    const parallaxSection = document.querySelector('.parallax-section');

    window.addEventListener('scroll', function () {
        const scrollPosition = window.scrollY || window.pageYOffset;
        const sectionTop = parallaxSection.offsetTop;
        const sectionHeight = parallaxSection.offsetHeight;

        // Hitung persentase scroll dalam section
        const scrollPercentage = ((scrollPosition - sectionTop) / sectionHeight) * 100;

        // Aplikasikan transformasi parallax
        parallaxImage.style.transform = `translateY(${scrollPercentage * 4}px)`;
    });
});