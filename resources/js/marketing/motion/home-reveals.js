export function initHomeReveals(gsap, ScrollTrigger) {
    const elements = [...document.querySelectorAll('[data-home-reveal]')];

    if (elements.length === 0 || window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        return () => {};
    }

    const triggers = elements.map((element) => gsap.fromTo(element, {
        y: 18,
    }, {
        y: 0,
        duration: 0.55,
        ease: 'power2.out',
        scrollTrigger: {
            trigger: element,
            start: 'top 88%',
            once: true,
        },
    }));

    return () => {
        triggers.forEach((tween) => tween.scrollTrigger?.kill());
        gsap.killTweensOf(elements);
    };
}
