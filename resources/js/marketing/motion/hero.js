export function initHero(gsap) {
    const roots = [...document.querySelectorAll('[data-motion-hero]')];
    const cleanups = [];

    roots.forEach((root) => {
        const copy = root.querySelector('[data-hero-copy]');
        const visual = root.querySelector('[data-company-visual]');
        const visualParts = [...root.querySelectorAll('[data-company-visual-part]')];

        if (!copy || !visual) return;

        root.dataset.motionReady = 'true';

        if (!window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
            const timeline = gsap.timeline({ defaults: { ease: 'power3.out' } });
            timeline
                .fromTo(copy, { y: 18 }, { y: 0, duration: 0.58 })
                .fromTo(visual, { y: 16 }, { y: 0, duration: 0.58 }, '-=0.38')
                .fromTo(visualParts, { x: -12 }, {
                    x: 0,
                    duration: 0.42,
                    stagger: 0.1,
                }, '-=0.32');
        }

        cleanups.push(() => {
            gsap.killTweensOf([copy, visual, ...visualParts]);
            delete root.dataset.motionReady;
        });
    });

    return () => cleanups.forEach((cleanup) => cleanup());
}
