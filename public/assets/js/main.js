/**
 * Nagaldham Farm - Interactive Main Scripts
 */

document.addEventListener('DOMContentLoaded', () => {
    initHeroAnimations();
    initHeroInteractions();
    initSmoothScrolling();
});

/**
 * Hero Section Entrance and Visibility Handling
 */
function initHeroAnimations() {
    const heroContent = document.querySelector('.hero-content');
    if (heroContent) {
        // Ensure class is present for CSS transitions
        requestAnimationFrame(() => {
            heroContent.classList.add('is-visible');
        });
    }
}

/**
 * Subtle Parallax / Mouse Movement Effect on Desktop
 */
function initHeroInteractions() {
    const heroSection = document.querySelector('.hero-section');
    const heroContent = document.querySelector('.hero-content');

    if (!heroSection || !heroContent) return;

    // Only apply on non-touch devices with pointer support
    const isTouchDevice = window.matchMedia('(pointer: coarse)').matches;
    if (isTouchDevice) return;

    let targetX = 0;
    let targetY = 0;
    let currentX = 0;
    let currentY = 0;
    let isMoving = false;

    heroSection.addEventListener('mousemove', (e) => {
        const rect = heroSection.getBoundingClientRect();
        const centerX = rect.width / 2;
        const centerY = rect.height / 2;

        // Calculate subtle offset normalized around center (-1 to 1)
        const mouseX = (e.clientX - rect.left - centerX) / centerX;
        const mouseY = (e.clientY - rect.top - centerY) / centerY;

        // Subtle motion: max 8px shift
        targetX = mouseX * 8;
        targetY = mouseY * 6;

        if (!isMoving) {
            isMoving = true;
            requestAnimationFrame(updateHeroMotion);
        }
    });

    heroSection.addEventListener('mouseleave', () => {
        targetX = 0;
        targetY = 0;
    });

    function updateHeroMotion() {
        // Smooth lerp (linear interpolation)
        currentX += (targetX - currentX) * 0.08;
        currentY += (targetY - currentY) * 0.08;

        heroContent.style.transform = `translate3d(${currentX.toFixed(2)}px, ${currentY.toFixed(2)}px, 0)`;

        if (Math.abs(targetX - currentX) > 0.05 || Math.abs(targetY - currentY) > 0.05) {
            requestAnimationFrame(updateHeroMotion);
        } else {
            isMoving = false;
        }
    }
}

/**
 * Smooth Scrolling for CTA Button
 */
function initSmoothScrolling() {
    const exploreBtn = document.getElementById('exploreProductsBtn');
    if (!exploreBtn) return;

    exploreBtn.addEventListener('click', (e) => {
        const targetHref = exploreBtn.getAttribute('href');
        if (targetHref && targetHref.startsWith('#')) {
            const targetEl = document.querySelector(targetHref);
            if (targetEl) {
                e.preventDefault();
                targetEl.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        }
    });
}
