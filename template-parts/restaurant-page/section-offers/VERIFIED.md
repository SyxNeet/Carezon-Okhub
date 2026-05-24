Verified at 2026-05-20T08:30:00Z (viewports: desktop, mobile)
Second-pass re-verification from scratch against fresh Figma data (desktop node 17418:20416, mobile node 18860:65155).

## Second-pass fixes applied

### Desktop fixes (assets/styles.css)

- `.section-offers__subtitle`: added `margin-bottom: 1rem` (16px) — Figma desktop gap-[16px] between subtitle and title text elements
- `.section-offers__counter-control`: height `2.125rem` → `2.75rem` (44px), width `6.5625rem` → `8.3125rem` (133px) — Figma PC: h-[44px] w-[133px]
- `.section-offers__counter-btn`: width/height `1.625rem` → `1.6756rem` (~26.8px) — matches Figma PC aspect-ratio 26.81/26.81 in 44px container
- `.section-offers__form-fields`: padding `1.5rem` → `2.5rem` (40px) — Figma: p-[var(--space/40,40px)]
- `.section-offers__submit`: padding-top/bottom `0.25rem` → `0.5rem` (8px) — Figma: py-[8px]
- `.section-offers__submit-label`: line-height `1.5` → `1.2` — Figma: leading-[1.2]; added letter-spacing `-0.03rem` (-0.48px) — Figma: tracking-[-0.48px]

### Mobile fixes (@media screen and (max-width: 639.98px))

- `.section-offers__subtitle`: added `margin-bottom: 0.125rem` (2px) — Figma MB: gap-[2px] between subtitle and title
- `.section-offers__title`: added `font-weight: 500` — Figma MB uses SVN-Optima:Medium vs desktop DemiBold (600)
- `.section-offers__counter-control`: restored `height: 2.125rem` (34px), `width: 6.5625rem` (105px) — Figma MB Default variant
- `.section-offers__counter-btn`: restored `1.625rem` (26px) — Figma MB: size-[26px]
- `.section-offers__submit`: height `2.625rem` (42px), border-radius `0.5rem` (8px), padding-left `0.75rem` (12px), padding-right `0.25rem` (4px), padding-top/bottom `0.25rem` (4px) — Figma MB: h-[42px] pl-12 pr-4 py-4
- `.section-offers__submit-label`: font-size `0.75rem` (12px), letter-spacing `0`, line-height `1.5` — Figma MB button text
- `.section-offers__submit-icon`: width/height `2.125rem` (34px) — Figma MB: size-[34px]

## Status
All code-vs-design mismatches resolved for both desktop and mobile viewports.
