document.addEventListener("DOMContentLoaded", function () {
  new Splide("#card-slider", {
    type: "slide",
    perPage: 3,
    perMove: 2,
    gap: "2em",
    speed: "400",
    keyboard: "true",
    updateOnMove: "true",
    focus: "center",
    breakpoints: {
      991: {
        perPage: 2,
        perMove: 2,
      },
      542: {
        perPage: 1,
        perMove: 1,
      },
    },
  }).mount();
});
