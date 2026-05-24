export function sectionAspirationScripts() {
  const mediaQuery = window.matchMedia("(max-width: 639px)");

  if (mediaQuery.matches) return;

  const tl = gsap.timeline({
    scrollTrigger: {
      trigger: ".section-aspiration",
      start: "top 40%",
      //   markers: true,
    },
  });

  tl.fromTo(
    ".aspiration-container",
    {
      top: "70%",
    },
    {
      top: 0,
      duration: 2,
      ease: "power2.out",
    }
  ).from(
    ".aspiration-content__item",
    {
      y: 120,
      opacity: 0,
      duration: 1,
      stagger: 0.25,
      ease: "power2.out",
    },
    "-=0.2"
  );
}
