const end = Date.now() + 26.5 * 1000;
const colors = ["#69ff00", "#ffffff", "#ffc107", "00f6ff", "ff0018"];

(function frame() {

    confetti({
        particleCount: 2,
        angle: 60,
        spread: 55,
        origin: {
            x: 0
        },
        colors: colors,
    });

    confetti({
        particleCount: 2,
        angle: 120,
        spread: 55,
        origin: {
            x: 1
        },
        colors: colors,
    });
    if (Date.now() < end) {
        requestAnimationFrame(frame);
    }
})();
