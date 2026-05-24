<?php
$decor_right_id = 972;
$section_selector = $args['section'] ?? '';
?>


<style>
.deco-right-leaf {
    position: absolute;
    top: -11.3rem;
    right: 0;
    width: auto;
    height: 20.5rem;
    z-index: 15;
}

@media (max-width: 640px) {
    .deco-right-leaf {
        display: none;
    }
}
</style>
<?= wp_get_attachment_image($decor_right_id, 'full', false, array('class' => 'deco-right-leaf')) ?>
<script>
(function waitForGsap() {
    if (typeof gsap === "undefined" || typeof ScrollTrigger === "undefined") {
        setTimeout(waitForGsap, 100);
        return;
    }
    const section = document.querySelector(".<?php echo $section_selector?>");
    const decorRight = section.querySelector(".deco-right-leaf");

    if (!section || !decorRight) return;

    const remToPx = (rem) =>
        rem * parseFloat(getComputedStyle(document.documentElement).fontSize);

    ScrollTrigger.create({
        trigger: section,
        start: `top top+=${remToPx(19.3)}`,
        end: "max",
        pin: decorRight,
        pinSpacing: false,
    });
})();
</script>