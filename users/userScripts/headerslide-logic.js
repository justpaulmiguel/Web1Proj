/**
 * Logic for the sliding header upon scroll.
 * works by checking the window Yoffset and adding/removing class.
 */

const scrollUp = "scroll-up";
const scrollDown = "scroll-down";
let lastScroll = 0;
const body = document.body;

window.addEventListener("scroll", () => {
    const currentScroll = window.pageYOffset;
    if (currentScroll <= 0) {
        body.classList.remove(scrollUp);
        return;
    }

    if (currentScroll > lastScroll && !body.classList.contains(scrollDown)) {
        // Scrolled down
        body.classList.remove(scrollUp);
        body.classList.add(scrollDown);
    } else if (
        currentScroll < lastScroll &&
        body.classList.contains(scrollDown)
    ) {
        // Scrolled up
        body.classList.remove(scrollDown);
        body.classList.add(scrollUp);
    }
    lastScroll = currentScroll;
});