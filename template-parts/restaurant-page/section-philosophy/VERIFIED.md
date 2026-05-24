---
section: section-philosophy
page: restaurant-page
nodeId: "17418:20336"
mobileNodeId: "18860:65112"
verified: 2026-05-20T00:00:00Z
viewports: [desktop, mobile]
fixesApplied: 3
---

Verified at 2026-05-20 (viewports: desktop, mobile).

Fixes applied:
- M1: Removed top padding from .section-philosophy__cards-right in @media mobile block (1.5rem → 0).
- M2: Removed top padding from .section-philosophy__benefits-inner in @media mobile block (1.5rem → 0).
- R1: Moved GSAP initial states (opacity: 0; transform: translateY(3rem)) out of forbidden @media (min-width: 640px) wrapper into base desktop CSS. Mobile @media already resets them to opacity: 1; transform: none.
