import anime from "animejs/lib/anime.es.js";

export function closeH(el, done) {
    anime({
        targets: el,
        height: 0,
        duration: 500,
        easing: "linear",
        complete: done,
    });
}
export function openH(el, done) {
    anime({
        targets: el,
        height: 0,
        duration: 500,
        easing: "linear",
        direction: "reverse",
    }).finished.then(() => el.style.removeProperty("height"));
}

export function togelH(el) {
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

export function closeW(el, done) {
    anime({
        targets: el,
        width: 0,
        duration: 500,
        easing: "linear",
        complete: done,
    });
}

export function openW(el, done) {
    anime({
        targets: el,
        width: 0,
        duration: 500,
        easing: "linear",
        direction: "reverse",
        complete: done,
    }).finished.then(() => el.style.removeProperty("width"));
}

export function togelW(el) {
    if (el.clientWidth) {
        anime({
            targets: el,
            width: 0,
            duration: 500,
            easing: "linear",
            direction: "reverse",
        }).finished.then(() => el.style.removeProperty("height"));
    } else {
        anime({
            targets: el,
            width: 0,
            duration: 500,
            easing: "linear",
        });
    }
}
