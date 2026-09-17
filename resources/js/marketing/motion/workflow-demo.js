export function initWorkflowDemos() {
    const roots = [...document.querySelectorAll('[data-workflow-demo]')];
    const cleanups = [];

    roots.forEach((root) => {
        const steps = [...root.querySelectorAll('[data-workflow-step]')];
        const nodes = [...root.querySelectorAll('[data-workflow-node]')];
        const play = root.querySelector('[data-workflow-play]');
        const pause = root.querySelector('[data-workflow-pause]');
        const replay = root.querySelector('[data-workflow-replay]');
        const motionQuery = window.matchMedia('(prefers-reduced-motion: reduce)');
        let activeIndex = 0;
        let timer = null;

        const select = (index) => {
            activeIndex = index;
            steps.forEach((step, stepIndex) => step.setAttribute('aria-pressed', String(stepIndex === index)));
            nodes.forEach((node, nodeIndex) => node.classList.toggle('is-active', nodeIndex <= index));
        };
        const stop = () => {
            window.clearTimeout(timer);
            timer = null;
            play.disabled = false;
            pause.disabled = true;
        };
        const advance = () => {
            if (activeIndex >= steps.length - 1) {
                stop();
                return;
            }
            select(activeIndex + 1);
            timer = window.setTimeout(advance, 1400);
        };
        const start = () => {
            if (motionQuery.matches || timer) return;
            play.disabled = true;
            pause.disabled = false;
            timer = window.setTimeout(advance, 1400);
        };
        const restart = () => {
            stop();
            select(0);
            start();
        };
        const onMotionChange = () => {
            root.dataset.reducedMotion = String(motionQuery.matches);
            if (motionQuery.matches) stop();
        };

        const stepListeners = steps.map((step, index) => {
            const onClick = () => {
                stop();
                select(index);
            };
            step.addEventListener('click', onClick);
            return () => step.removeEventListener('click', onClick);
        });
        play?.addEventListener('click', start);
        pause?.addEventListener('click', stop);
        replay?.addEventListener('click', restart);
        motionQuery.addEventListener('change', onMotionChange);
        onMotionChange();

        cleanups.push(() => {
            stop();
            stepListeners.forEach((cleanup) => cleanup());
            play?.removeEventListener('click', start);
            pause?.removeEventListener('click', stop);
            replay?.removeEventListener('click', restart);
            motionQuery.removeEventListener('change', onMotionChange);
        });
    });

    return () => cleanups.forEach((cleanup) => cleanup());
}
