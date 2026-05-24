export function secitonVisionScripts() {
  const mediaQuery = window.matchMedia("(max-width: 639px)");

  if (mediaQuery.matches) return;

  const tl = gsap.timeline({
    scrollTrigger: {
      trigger: ".seciton-vision",
      start: "top 40%",
      //   markers: true,
    },
  });

  tl.from(
    ".vision-content__item",
    {
      y: "200%",
      opacity: 0,
      duration: 2,
      stagger: 0.1,
      ease: "power2.out",
    },
    "-=0.5"
  );
}
