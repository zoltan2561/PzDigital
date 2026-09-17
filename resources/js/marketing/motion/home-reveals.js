export function initHomeReveals(gsap, ScrollTrigger) {
    if (!document.querySelector('.company-home-hero')) {
        return () => {};
    }

    // matchMedia reverts every inline style/timeline when reduced motion is enabled.
    // Without JS the complete layout is visible; nothing is hidden in the stylesheet.
    const media = gsap.matchMedia();
    try {
        media.add('(prefers-reduced-motion: no-preference)', () => {
            const intro = gsap.timeline({ defaults: { ease: 'power3.out', clearProps: 'transform,opacity' } });
            intro.from('.company-home-hero .hero-copy > *', { y: 28, opacity: 0.35, duration: 0.85, stagger: 0.1 });
            if (document.querySelector('[data-hero-showcase]')) {
                intro.from('.showcase-window', { x: 45, y: 32, rotation: -3, opacity: 0.25, duration: 1.25 }, 0.15)
                    .from('.showcase-label', { y: 15, opacity: 0, duration: 0.65 }, 0.55)
                    .from('.showcase-flow', { y: 35, opacity: 0, duration: 0.8 }, 0.75);
            }

            document.querySelectorAll('[data-home-reveal]').forEach((section) => {
                const groups = [
                    '.section-heading, .principles-intro, .technology-heading, .compact-references-inner > div:first-child',
                    '.service-rows article, .process-grid li, .principles-list article, .technology-groups article, .faq-list details',
                ];
                groups.forEach((selector) => {
                    const elements = section.querySelectorAll(selector);
                    if (!elements.length) return;
                    gsap.from(elements, {
                        y: 36, opacity: 0.3, duration: 0.85, stagger: 0.11, ease: 'power3.out',
                        clearProps: 'transform,opacity',
                        scrollTrigger: { trigger: elements[0], start: 'top 92%', once: true },
                    });
                });
                section.querySelectorAll('.home-product-card, .reference-preview').forEach((element) => {
                    gsap.from(element, {
                        y: 48, opacity: 0.35, duration: 1, ease: 'power3.out',
                        clearProps: 'transform,opacity',
                        scrollTrigger: { trigger: element, start: 'top 93%', once: true },
                    });
                });
            });

            const process = document.querySelector('.home-process-section .process-grid');
            if (process) {
                gsap.fromTo(process, { '--process-progress': 0 }, {
                    '--process-progress': 1, duration: 1.3, ease: 'power2.inOut',
                    scrollTrigger: { trigger: process, start: 'top 87%', once: true },
                });
            }
            // Image dimensions are reserved in HTML; refresh also covers cached fonts.
            document.fonts?.ready.then(() => ScrollTrigger.refresh());
        });
    } catch (error) {
        media.revert();
        throw error;
    }

    return () => media.revert();
}
