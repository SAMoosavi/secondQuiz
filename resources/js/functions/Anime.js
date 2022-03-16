import anime from "animejs/lib/anime.es.js";

export function close(el, done) {
    anime({
        targets: el,
        height: 0,
        duration: 500,
        easing: "linear",
        complete: done,
    });
}
export function open(el, done) {
    anime({
        targets: el,
        height: 0,
        duration: 500,
        easing: "linear",
        direction: "reverse",
    }).finished.then(() => el.style.removeProperty("height"));
}

export function togel(el) {
    if (el.clientHeight) {
        anime({
            targets: el,
            height: 0,
            duration: 500,
            easing: "linear",
            direction: "reverse",
        }).finished.then(() => el.style.removeProperty("height"));
    } else {
        anime({
            targets: el,
            height: 0,
            duration: 500,
            easing: "linear",
        });
    }
}
