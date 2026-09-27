/**
 * Nagaldham Farm - Interactive Main Scripts
 */

document.addEventListener('DOMContentLoaded', () => {
    initHeader();
    initHeroAnimations();
    initHeroInteractions();
    initSmoothScrolling();
    initFeaturesMarquee();
    initTestimonialsSlider();
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

/**
 * Features Marquee Ribbon Interactions & Performance
 */
function initFeaturesMarquee() {
    const ribbon = document.getElementById('featuresRibbon');
    if (!ribbon) return;

    const groups = ribbon.querySelectorAll('.features-group');
    if (!groups.length) return;

    // Pause animation when off-screen to optimize CPU & battery
    if ('IntersectionObserver' in window) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                const playState = entry.isIntersecting ? 'running' : 'paused';
                groups.forEach(group => {
                    group.style.animationPlayState = playState;
                });
            });
        }, { threshold: 0.1 });

        observer.observe(ribbon);
    }

    // Touch support for mobile: pause when user touches ribbon
    ribbon.addEventListener('touchstart', () => {
        groups.forEach(group => {
            group.style.animationPlayState = 'paused';
        });
    }, { passive: true });

    ribbon.addEventListener('touchend', () => {
        groups.forEach(group => {
            group.style.animationPlayState = 'running';
        });
    }, { passive: true });
}

/**
 * Testimonials Carousel & Navigation Handling
 */
function initTestimonialsSlider() {
    const prevBtn = document.getElementById('prevTestimonialBtn');
    const nextBtn = document.getElementById('nextTestimonialBtn');
    const track = document.getElementById('testimonialsTrack');

    if (!track || !prevBtn || !nextBtn) return;

    let isAnimating = false;

    function handleNext() {
        if (isAnimating) return;
        isAnimating = true;

        const cards = Array.from(track.querySelectorAll('.testimonial-card'));
        if (cards.length < 2) {
            isAnimating = false;
            return;
        }

        const firstCard = cards[0];
        firstCard.style.transition = 'opacity 0.22s ease, transform 0.22s ease';
        firstCard.style.opacity = '0';
        firstCard.style.transform = 'scale(0.94) translateY(-8px)';

        setTimeout(() => {
            track.appendChild(firstCard);
            firstCard.style.transition = 'none';
            firstCard.style.opacity = '0';
            firstCard.style.transform = 'scale(0.94) translateY(8px)';

            // Trigger reflow
            void firstCard.offsetWidth;

            firstCard.style.transition = 'opacity 0.28s ease, transform 0.28s ease';
            firstCard.style.opacity = '1';
            firstCard.style.transform = '';

            setTimeout(() => {
                isAnimating = false;
            }, 280);
        }, 220);
    }

    function handlePrev() {
        if (isAnimating) return;
        isAnimating = true;

        const cards = Array.from(track.querySelectorAll('.testimonial-card'));
        if (cards.length < 2) {
            isAnimating = false;
            return;
        }

        const lastCard = cards[cards.length - 1];
        lastCard.style.transition = 'none';
        lastCard.style.opacity = '0';
        lastCard.style.transform = 'scale(0.94) translateY(8px)';
        track.insertBefore(lastCard, track.firstChild);

        // Trigger reflow
        void lastCard.offsetWidth;

        lastCard.style.transition = 'opacity 0.28s ease, transform 0.28s ease';
        lastCard.style.opacity = '1';
        lastCard.style.transform = '';

        setTimeout(() => {
            isAnimating = false;
        }, 280);
    }

    nextBtn.addEventListener('click', handleNext);
    prevBtn.addEventListener('click', handlePrev);

    // Touch Swipe support for touch devices
    let touchStartX = 0;
    let touchEndX = 0;

    track.addEventListener('touchstart', (e) => {
        if (e.changedTouches && e.changedTouches.length > 0) {
            touchStartX = e.changedTouches[0].screenX;
        }
    }, { passive: true });

    track.addEventListener('touchend', (e) => {
        if (e.changedTouches && e.changedTouches.length > 0) {
            touchEndX = e.changedTouches[0].screenX;
            const diffX = touchStartX - touchEndX;
            if (Math.abs(diffX) > 40) {
                if (diffX > 0) {
                    handleNext();
                } else {
                    handlePrev();
                }
            }
        }
    }, { passive: true });
}

/**
 * Premium Header Interactions
 */
function initHeader() {
    const siteHeader = document.getElementById('siteHeader');
    if (!siteHeader) return;

    // 1. Sticky Glass Transition on Scroll
    let ticking = false;

    function handleScroll() {
        if (window.scrollY > 30) {
            siteHeader.classList.add('is-scrolled');
        } else {
            siteHeader.classList.remove('is-scrolled');
        }
        ticking = false;
    }

    window.addEventListener('scroll', () => {
        if (!ticking) {
            window.requestAnimationFrame(handleScroll);
            ticking = true;
        }
    }, { passive: true });

    // Initial check
    handleScroll();

    // 2. Active Section Spy for Navigation Links
    const navLinks = document.querySelectorAll('.header-nav .nav-link');
    const sections = [
        { id: 'hero', linkIndex: 0 },
        { id: 'products', linkIndex: 1 },
        { id: 'about', linkIndex: 2 },
        { id: 'process', linkIndex: 3 },
        { id: 'blog', linkIndex: 4 },
        { id: 'cta-contact', linkIndex: 5 }
    ];

    if ('IntersectionObserver' in window && navLinks.length) {
        const sectionObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const match = sections.find(s => s.id === entry.target.id);
                    if (match && navLinks[match.linkIndex]) {
                        navLinks.forEach(link => link.classList.remove('active'));
                        navLinks[match.linkIndex].classList.add('active');
                    }
                }
            });
        }, { threshold: 0.35, rootMargin: '-60px 0px -40% 0px' });

        sections.forEach(s => {
            const el = document.getElementById(s.id);
            if (el) sectionObserver.observe(el);
        });
    }

    // 3. Mobile Navigation Drawer
    const mobileDrawer = document.getElementById('mobileDrawer');
    const mobileToggle = document.getElementById('mobileMenuToggle');
    const closeMobileBtn = document.getElementById('closeMobileDrawer');
    const mobileBackdrop = document.getElementById('mobileDrawerBackdrop');
    const mobileNavLinks = document.querySelectorAll('.mobile-nav-link');

    function openMobileMenu() {
        if (!mobileDrawer || !mobileToggle) return;
        mobileDrawer.classList.add('is-open');
        mobileDrawer.setAttribute('aria-hidden', 'false');
        mobileToggle.classList.add('is-active');
        mobileToggle.setAttribute('aria-expanded', 'true');
        document.body.style.overflow = 'hidden';
    }

    function closeMobileMenu() {
        if (!mobileDrawer || !mobileToggle) return;
        mobileDrawer.classList.remove('is-open');
        mobileDrawer.setAttribute('aria-hidden', 'true');
        mobileToggle.classList.remove('is-active');
        mobileToggle.setAttribute('aria-expanded', 'false');
        document.body.style.overflow = '';
    }

    if (mobileToggle) {
        mobileToggle.addEventListener('click', () => {
            if (mobileDrawer.classList.contains('is-open')) {
                closeMobileMenu();
            } else {
                openMobileMenu();
            }
        });
    }

    if (closeMobileBtn) closeMobileBtn.addEventListener('click', closeMobileMenu);
    if (mobileBackdrop) mobileBackdrop.addEventListener('click', closeMobileMenu);

    mobileNavLinks.forEach(link => {
        link.addEventListener('click', () => {
            closeMobileMenu();
        });
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' || e.key === 'Esc') {
            closeMobileMenu();
        }
    });
}


