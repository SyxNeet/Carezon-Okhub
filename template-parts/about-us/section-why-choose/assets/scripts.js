export function sectionWhyChooseScripts() {
  const mediaQuery = window.matchMedia("(max-width: 639px)");

  if (mediaQuery.matches) return;
  new Swiper(".why-choose__swiper", {
    slidesPerView: 6,
    spaceBetween: remToPixels(1),
    speed: 500,
  });

  const tl = gsap.timeline({
    scrollTrigger: {
      trigger: ".section-why-choose",
      start: "top 40%",
      // markers: true,
    },
  });

  tl.from(".background-why-choose", {
    scale: 1.5,
    x: -200,
    duration: 2,
    ease: "power2.out",
  }).from(
    ".why-choose__content-item:nth-child(-n + 6)",
    {
      y: 300,
      duration: 0.5,
      stagger: 0.2,
      ease: "power2.out",
    },
    "<+=0.2"
  );
}
