Verified at 2026-05-20T07:45:00Z (viewports: desktop, mobile)
Second-pass: fresh Figma fetch, full pixel-by-pixel walkthrough.

Fixes applied in this pass:
- D1: .section-about__deco-circle width/height corrected from 1.4286rem to 5.2531rem (84.05px / 16, derived from 309px parent container × 27.2%)
- D2: .section-about__deco-circle top corrected from 0 to 5.0406rem (80.65px / 16 — circle's absolute position within deco-group, not zero as previously calculated)
- M1: .section-about__nav margin-top corrected to 1.5rem (24px / 16, matching Figma mobile gap-[24px] between text group and nav)
- M2: .section-about__nav align-self: flex-end added (Figma mobile: nav right-aligned within content col)

All previous fixes from first pass retained:
- Desktop deco-main width/height correct (14.0154rem × 8.7980rem)
- Mobile deco-group uses top:auto + bottom positioning
- Mobile deco-main uses correct Figma mobile coordinates
- Mobile carousel margin-top: 1.5rem

No outstanding mismatches. No rule violations (no gap, no aspect-ratio, no px, single breakpoint, BEM naming).
