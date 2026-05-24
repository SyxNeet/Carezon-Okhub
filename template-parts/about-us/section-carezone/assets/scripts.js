export function sectionCarezoneScripts() {
  const mediaQuery = window.matchMedia("(max-width: 639px)");

  if (mediaQuery.matches) return;

  const tl = gsap.timeline({
    scrollTrigger: {
      trigger: ".section-carezone",
      start: "top 50%",
      //   markers: true,
    },
  });

  tl.from(".deco-home", {
    scale: 1.5,
    duration: 2,
    ease: "power2.out",
  })
    .from(
      ".lachuoiblur",
      {
        y: 120,
        duration: 1,
        ease: "power2.out",
      },
      "<"
    )
    .from(
      ".carezone-content",
      {
        top: "100%",
        duration: 3,
        ease: "power2.out",
      },
      "<"
    )
    .from(
      ".lachuoi-left",
      {
        top: "100%",
        duration: 3,
        ease: "power2.out",
      },
      "<"
    )
    .from(
      ".flash-light",
      {
        opacity: 0,
        duration: 6,
        ease: "power2.out",
      },
      "<"
    )
    .from(
      ".lachuoi-right",
      {
        width: "37.84763rem",
        height: "45.46163rem",
        top: "28.45rem",
        left: "33.72rem",
        duration: 3,
        ease: "power2.out",
      },
      "<"
    )
    .from(
      ".lachuoi-bottom-left",
      {
        width: "53.93719rem",
        height: "110.57463rem",
        bottom: "-62.21rem",
        left: "-14.11rem",
        filter: "blur(10.5px)",
        boxShadow: "0 5.405px 54.182px rgba(0,0,0,0.25)",
        duration: 2,
        ease: "power2.out",
      },
      "<"
    );
}
