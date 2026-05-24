export function sectionExperience() {
  gsap.registerPlugin(ScrollTrigger);
  const experience = document.querySelector(".experience");

  const videos = document.querySelectorAll(".experience__video");

  const iframeEmbed = "https://www.tiktok.com/embed/v3";

  const swiper = new Swiper(".experience__tiktok-swiper", {
    // If we need pagination
    pagination: {
      el: ".experience__tiktok-pagination",
      clickable: true,
    },
    navigation: {
      nextEl: ".experience__tiktok-swiper-next",
      prevEl: ".experience__tiktok-swiper-prev",
    },
  });

  const isElementInViewport = (el) => {
    const rect = el.getBoundingClientRect();
    // check if the top of the element hit bottom of the viewport
    // check if the bottom of the element is below the top of the viewport
    return (
      rect.top <=
        (window.innerHeight || document.documentElement.clientHeight) &&
      rect.bottom >= 0
    );
  };

  const handleRenderVideo = () => {
    videos.forEach((video) => {
      const videoType = video.dataset.type;
      const videoDataSrc = video.dataset.src;
      const src =
        videoType === "tiktok"
          ? `${iframeEmbed}/${videoDataSrc}?autoplay=1&mute=1&loop=1`
          : videoDataSrc;
      video.setAttribute("src", src);
    });
  };

  const handleScroll = () => {
    if (isElementInViewport(experience)) {
      handleRenderVideo();
      window.removeEventListener("scroll", handleScroll);
    }
  };

  if (isElementInViewport(experience)) {
    handleRenderVideo();
  } else {
    window.addEventListener("scroll", handleScroll);
  }
  
  gsap.set(".experience__section-title", {
    opacity: 0,
    y: 30,
    filter: "blur(10px)",
  });
  window.addEventListener("load", function () {
    ScrollTrigger.refresh();
    ScrollTrigger.create({
      trigger: ".experience__section-title",
      start: "top 85%",
      once: true,
      onEnter: () => {
        gsap.to(".experience__section-title", {
          opacity: 1,
          y: 0,
          filter: "blur(0px)",
          duration: 1.5,
          ease: "power3.out",
        });
      },
    });
  });
}
