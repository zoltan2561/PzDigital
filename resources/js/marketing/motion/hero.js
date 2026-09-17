export function initHero(gsap) {
    const roots = [...document.querySelectorAll('[data-motion-hero]')];
    const cleanups = [];

    roots.forEach((root) => {
        const stage = root.querySelector('[data-hero-stage]');
        const frame = root.querySelector('[data-hero-stage-frame]');
        const image = root.querySelector('[data-hero-stage-image]');
        const link = root.querySelector('[data-hero-stage-link]');
        const label = root.querySelector('[data-hero-stage-label]');
        const title = root.querySelector('[data-hero-stage-title]');
        const flow = root.querySelector('[data-hero-stage-flow]');
        const options = [...root.querySelectorAll('[data-hero-option]')];

        if (!stage || !frame || !image || !link || options.length === 0) return;

        const select = (option, animate = true) => {
            const commit = () => {
                image.src = option.dataset.image;
                image.alt = option.dataset.alt;
                link.href = option.dataset.url;
                label.textContent = option.dataset.label;
                title.textContent = option.dataset.title;
                flow.textContent = option.dataset.flow;
                options.forEach((item) => item.setAttribute('aria-pressed', String(item === option)));
            };

            if (!animate || window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
                commit();
                return;
            }

            gsap.killTweensOf(frame);
            gsap.to(frame, {
                autoAlpha: 0.35,
                y: 8,
                duration: 0.12,
                ease: 'power1.out',
                onComplete: () => {
                    commit();
                    gsap.to(frame, { autoAlpha: 1, y: 0, duration: 0.2, ease: 'power2.out' });
                },
            });
        };

        const listeners = [];
        options.forEach((option, index) => {
            const onClick = () => select(option);
            const onKeydown = (event) => {
                if (!['ArrowLeft', 'ArrowRight', 'Home', 'End'].includes(event.key)) return;
                event.preventDefault();
                let targetIndex = index;
                if (event.key === 'ArrowLeft') targetIndex = (index - 1 + options.length) % options.length;
                if (event.key === 'ArrowRight') targetIndex = (index + 1) % options.length;
                if (event.key === 'Home') targetIndex = 0;
                if (event.key === 'End') targetIndex = options.length - 1;
                options[targetIndex].focus();
                select(options[targetIndex]);
            };
            option.addEventListener('click', onClick);
            option.addEventListener('keydown', onKeydown);
            listeners.push(() => {
                option.removeEventListener('click', onClick);
                option.removeEventListener('keydown', onKeydown);
            });
        });

        root.dataset.motionReady = 'true';
        if (!window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
            const timeline = gsap.timeline({ defaults: { ease: 'power3.out' } });
            timeline
                .fromTo(root.querySelector('[data-hero-copy]'), { autoAlpha: 0, y: 20 }, { autoAlpha: 1, y: 0, duration: 0.66 })
                .fromTo(stage, { autoAlpha: 0, y: 18 }, { autoAlpha: 1, y: 0, duration: 0.7 }, '-=0.46');
        }

        cleanups.push(() => {
            listeners.forEach((cleanup) => cleanup());
            gsap.killTweensOf([frame, stage, root.querySelector('[data-hero-copy]')]);
            delete root.dataset.motionReady;
        });
    });

    return () => cleanups.forEach((cleanup) => cleanup());
}
