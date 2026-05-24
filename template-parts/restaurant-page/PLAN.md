## Plan: Restaurant Page (Nhà hàng thực dưỡng)

**Figma Desktop:** https://www.figma.com/design/a28Yh7hoqnubwuKE4Oweaf/CareZone--M%E1%BB%9Bi-?node-id=17418-20273&m=dev
**Figma Mobile:** https://www.figma.com/design/a28Yh7hoqnubwuKE4Oweaf/CareZone--M%E1%BB%9Bi-?node-id=18790-53918&m=dev
**Scope:** Full Page
**Viewports:** Desktop 1600×7147px • Mobile 375×6218px
**rem divisor:** 16 (cả 2 viewport — fluid 1vw system)
**Layout:** Content max-width desktop 1600px / mobile 375px
**Breakpoint:** `@media screen and (max-width: 639.98px)`

**CSS Constraints:**
- NO `gap` property — use `margin` on children instead
- NO `aspect-ratio` property — use explicit width/height or padding-top trick
- NO `px` units — chỉ `rem` (ngoại trừ `1px` borders)
- rem divisor = **16** cho cả desktop (1600px) và mobile (375px)
- Fluid font system: `1vw` desktop, `4.267vw` mobile, capped at `17px` cho ≥1920px
- Single breakpoint: `@media screen and (max-width: 639.98px) { }`

---

### Sections (7)

| # | Section | Desktop Node | Mobile Node | Layout (D / M) | Complexity | Heading | Responsive Note |
|---|---------|-------------|-------------|-----------------|------------|---------|-----------------|
| 1 | section-banner | 17418:20279 | 18790:61498 | full / full | complex | **h1** | Cloud decoration thu nhỏ, heading stack vertical, dots nhỏ hơn |
| 2 | section-menu | 18381:46574 | 18790:62336 | contained / full | complex | h2 | 5 tabs → 3 tabs scrollable, menu items nhỏ hơn, pagination dots |
| 3 | section-about | 17418:20300 | 18834:56077 | contained / full | medium | h2 | Side-by-side → stacked vertical, image below text |
| 4 | section-philosophy | 17418:20336 | 18860:65112 | full / full | complex | h2 | 2-col sticky scroll → vertical stack, benefit cards 3-col → 1-col |
| 5 | section-offers | 17418:20416 | 18860:65155 | full / full | complex | h2 | Offer cards 4-col → carousel, form side-by-side → stacked. Mobile mobileNodeRange exclude Bot child 18860:65262 |
| 6 | section-bot | 17418:20528 | 18860:65262 | full / full | medium | — | Decorative roof + footer wrapper. Footer component reused |
| 7 | sticky-booking | 17418:20534 | 19473:41663 | overlay | simple | — | Desktop: sidebar right (calendar + phone + message) → Mobile: bottom sticky bar |

> **Floating elements (included as overlays, not separate sections):**
> - Info Image Container (D: 17918:14624, M: 18860:65279) — floating "Tư vấn ngay" button between section-philosophy and section-offers. Include as absolute-positioned element in section-philosophy.
> - Header floating button (D: 17418:20530, M: —) — desktopOnly expanded booking panel. Not generated as section.

---

### Common Components (shared across sections)

| Component | Used in | Desktop Node | Mobile Node | Source |
|-----------|---------|-------------|-------------|--------|
| cta-social | section-offers | — | — | `template-parts/components/cta-social/` (existing) |
| special-offers | section-offers | — | — | `template-parts/components/special-offers/` (existing) |
| popup-form | section-offers (inline) | — | — | `template-parts/components/popup-form/` (reference) |
| pagination-dots | section-banner, section-menu | 17688:41404 | 19552:50487 | new — `template-parts/components/pagination-dots/` |

---

### Typography (16 unique styles)

| # | Element | Desktop (px / weight / lh) | Mobile (px / weight / lh) | CSS (desktop → mobile override) |
|---|---------|---------------------------|---------------------------|--------------------------------|
| 1 | h1 banner heading | 56 / 600 / 1.2 | 32 / 600 / 1.2 | D `font-size: 3.5rem; font-weight: 600; line-height: 1.2; letter-spacing: -0.14rem; font-family: "SVN-Optima";` • M `font-size: 2rem;` |
| 2 | banner subheading | 24 / 600 / 1.2 | 16 / 400 / 1.5 | D `font-size: 1.5rem; font-weight: 600; line-height: 1.2; letter-spacing: -0.03rem;` • M `font-size: 1rem; font-weight: 400; line-height: 1.5;` |
| 3 | subtitle decorative (SVN-Pleasent) | 56 / 400 / 1.2 | 48 / 400 / 1.2 | D `font-size: 3.5rem; font-weight: 400; line-height: 1.2; font-family: "SVN-Pleasent";` • M `font-size: 3rem;` |
| 4 | h2 section title | 50 / 600 / 1.2 | 32 / 600 / 1.2 | D `font-size: 3.125rem; font-weight: 600; line-height: 1.2; letter-spacing: -0.0625rem;` • M `font-size: 2rem;` |
| 5 | h2 section title medium | 50 / 500 / 1.2 | 28 / 500 / 1.2 | D `font-size: 3.125rem; font-weight: 500; line-height: 1.2; letter-spacing: -0.0625rem;` • M `font-size: 1.75rem;` |
| 6 | h4 heading medium | 30 / 500 / 1.3 | 22 / 500 / 1.3 | D `font-size: 1.875rem; font-weight: 500; line-height: 1.3; letter-spacing: -0.0375rem;` • M `font-size: 1.375rem; letter-spacing: -0.0625rem;` |
| 7 | h5 heading demi | 24 / 600 / 1.2 | 16 / 600 / 1.3 | D `font-size: 1.5rem; font-weight: 600; line-height: 1.2; letter-spacing: -0.03rem;` • M `font-size: 1rem; line-height: 1.3;` |
| 8 | h6 label | 20 / 400 / 1.5 | 14 / 400 / 1.5 | D `font-size: 1.25rem; font-weight: 400; line-height: 1.5;` • M `font-size: 0.875rem;` |
| 9 | body 18 regular | 18 / 400 / 1.5 | 16 / 300 / 1.5 | D `font-size: 1.125rem; font-weight: 400; line-height: 1.5;` • M `font-size: 1rem; font-weight: 300; letter-spacing: -0.1875rem;` |
| 10 | body 16 regular | 16 / 400 / 1.6 | 14 / 400 / 1.5 | D `font-size: 1rem; font-weight: 400; line-height: 1.6; letter-spacing: -0.02rem;` • M `font-size: 0.875rem; line-height: 1.5;` |
| 11 | tab text | 18 / 500 / 1.2 | 12 / 500 / 1.5 | D `font-size: 1.125rem; font-weight: 500; line-height: 1.2; letter-spacing: -0.0338rem;` • M `font-size: 0.75rem; line-height: 1.5;` |
| 12 | menu item name | 18 / 400 / 1.5 | 12 / 400 / 1.5 | D `font-size: 1.125rem; font-weight: 400; line-height: 1.5;` • M `font-size: 0.75rem;` |
| 13 | menu item price | 18 / 600 / 1.5 | 12 / 600 / 1.5 | D `font-size: 1.125rem; font-weight: 600; line-height: 1.5;` • M `font-size: 0.75rem;` |
| 14 | card number | 50 / 500 / 1.2 | 26 / 500 / 1.2 | D `font-size: 3.125rem; font-weight: 500; line-height: 1.2;` • M `font-size: 1.625rem;` |
| 15 | card title | 30 / 500 / 1.3 | 18 / 600 / 1.2 | D `font-size: 1.875rem; font-weight: 500; line-height: 1.3;` • M `font-size: 1.125rem; font-weight: 600; line-height: 1.2;` |
| 16 | button text | 16 / 500 / 1.2 | 12 / 500 / 1.5 | D `font-size: 1rem; font-weight: 500; line-height: 1.2; letter-spacing: -0.03rem; text-transform: uppercase;` • M `font-size: 0.75rem; line-height: 1.5;` |

All typography uses **font-family: "SVN-Optima"** unless noted (SVN-Pleasent for decorative subtitles).

---

### Assets to Download (estimated 25+)

| Type | Filename | Section | Desktop Node | Mobile Node | Note |
|------|----------|---------|-------------|-------------|------|
| image | d-banner-bg.webp | Banner | 17418:20282 | — | Desktop banner background |
| image | m-banner-bg.webp | Banner | — | 18790:61500 | Mobile banner background (different crop) |
| image | d-cloud.webp | Banner | 17418:20290 | — | Cloud decoration composite |
| image | m-cloud.webp | Banner | — | 18841:69813 | Mobile cloud decoration |
| image | d-menu-bg.webp | Menu | 18381:46581 | — | Menu content area BG (green pattern + food overlay) |
| image | d-menu-item-1.webp | Menu | I18381:46586;17125:32047 | — | Menu food item 1 thumbnail |
| image | d-menu-item-2.webp | Menu | I18381:46587;17125:32047 | — | Menu food item 2 thumbnail |
| image | d-menu-item-3.webp | Menu | I18381:46588;17125:32047 | — | Menu food item 3 thumbnail |
| image | d-menu-item-4.webp | Menu | I18381:46589;17125:32047 | — | Menu food item 4 thumbnail |
| image | d-about-main.webp | About | 17418:20312 | — | About section main image |
| image | d-about-decor-1.webp | About | 17918:15548 | — | Decorative stone/food composition |
| image | d-about-decor-2.webp | About | 17418:20329 | — | Main image in stone composition |
| image | d-philosophy-bg-pattern.webp | Philosophy | 17871:40964 | — | Green BG pattern (shared desktop/mobile) |
| image | d-benefit-1.webp | Philosophy | I18088:42082;17911:44367 | — | Benefit card 1 image |
| image | d-benefit-2.webp | Philosophy | I17918:14603;17911:44367 | — | Benefit card 2 image |
| image | d-benefit-3.webp | Philosophy | I17918:14617;17911:44367 | — | Benefit card 3 image |
| image | d-offer-card-1.webp | Offers | 17977:15507 | — | Offer card 1 |
| image | d-offer-card-2.webp | Offers | 17977:15576 | — | Offer card 2 |
| image | d-offer-card-3.webp | Offers | 17977:15597 | — | Offer card 3 |
| image | d-offer-card-4.webp | Offers | 17977:15608 | — | Offer card 4 |
| image | d-offers-overlay.webp | Offers | 17418:20418 | — | Offers section background overlay |
| image | d-form-family.webp | Offers | 19534:44563 | — | Form section family image |
| image | d-bot-bg.webp | Bot | 17418:20528 | — | Bot section background |
| image | d-bot-roof.webp | Bot | — | 18860:65265 | Decorative roof image |
| icon | ic-arrow-left.svg | Multiple | I17688:41404;16989:51033 | — | Pagination arrow left |
| icon | ic-arrow-right.svg | Multiple | I17688:41404;16989:51032 | — | Pagination arrow right |
| icon | ic-calendar.svg | Sticky | 17418:20538 | — | Schedule calendar icon |
| icon | ic-phone.svg | Sticky | 17418:20543 | — | Phone call icon |
| icon | ic-message.svg | Sticky | 17418:20562 | — | Message icon |
| image | d-lotus.svg | About | 18577:43778 | — | Decorative lotus illustration |
| image | d-info-button.webp | Philosophy | 17918:14624 | 18860:65279 | Floating info/CTA button between sections |
| image | d-footer-bg.webp | Bot | 12282:27776 | — | Footer background image |
| image | d-footer-phone.webp | Bot | I13943:45029;12858:33318 | — | Footer phone mockup |

---

### Text Content (per section)

```yaml
section-banner:
    heading: "Nhà hàng chay"
    subheading: "Nơi Tận Hưởng Bình Yên, Khôi Phục Năng Lượng"
    slider_count: 4  # pagination dots indicate 4 slides
    image:
        desktop: d-banner-bg.webp  # 1605×800 px
        mobile: m-banner-bg.webp   # 375×809 px

section-menu:
    subtitle_decorative: "Menu món ăn"
    title: "Thực đơn chay – Tinh hoa từ thiên nhiên"
    title_gradient: "linear-gradient(to right, #2d6635, #b7d10f)"
    tabs:
        - "Món chay 1"
        - "Món chay 2"
        - "Món chay 3"
        - "Món chay 4"
        - "Món chay 5"
    items:
        - name: "Món chay 1"
          price: "120.000 Vnđ"
          image: d-menu-item-1.webp
        - name: "Món chay 2"
          price: "120.000 Vnđ"
          image: d-menu-item-2.webp
        - name: "Món chay 3"
          price: "120.000 Vnđ"
          image: d-menu-item-3.webp
        - name: "Món chay 4"
          price: "120.000 Vnđ"
          image: d-menu-item-4.webp
    annotation: "cả section menu này là ảnh, để KH post ảnh"
    # Note: Menu content area (right side) is a full image posted by client

section-about:
    label: "Về chúng tôi ?"
    description: "Nhà hàng chay Carezone mang đến không gian ấm cúng, thư giãn với các món ăn thanh đạm và bổ dưỡng từ thiên nhiên."
    body_text_1: "Mỗi món ăn tại đây đều được chế biến tinh tế, giữ trọn dưỡng chất và hương vị tươi ngon từ rau củ, ngũ cốc và thảo mộc tự nhiên. Không chỉ giúp cơ thể nhẹ nhàng mà còn thanh lọc tâm hồn, mang lại trải nghiệm sống lành mạnh và cân bằng."
    body_text_2: "Mỗi món ăn tại đây đều được chế biến tinh tế, giữ trọn dưỡng chất và hương vị tươi ngon từ rau củ, ngũ cốc và thảo mộc tự nhiên. Không chỉ giúp cơ thể nhẹ nhàng mà còn thanh lọc tâm hồn, mang lại trải nghiệm sống lành mạnh và cân bằng."
    image:
        desktop: d-about-main.webp  # 546×546 px
    has_prev_next_buttons: true

section-philosophy:
    subtitle_decorative: "Triết lý ẩm thực"
    description: "Nhà hàng chay Carezone mang đến không gian ấm cúng, thư giãn với các món ăn thanh đạm và bổ dưỡng từ thiên nhiên."
    cards:
        - number: "01"
          title: "Phong cách món ăn"
          body: "Phong cách ẩm thực tại Carezone là sự hòa quyện giữa truyền thống và hiện đại, mang lại trải nghiệm ẩm thực tinh tế, thanh đạm nhưng vẫn đầy đủ dưỡng chất. Các món ăn được chế biến tỉ mỉ, giữ trọn hương vị tự nhiên, mang đến sự cân bằng giữa cơ thể và tâm hồn. Với sự kết hợp giữa các nguyên liệu thuần chay và thảo mộc, mỗi món ăn không chỉ là sự thưởng thức mà còn là một hành trình về sức khỏe bền vững."
          bg_color: "#aedbc7"
        - number: "02"
          title: "Chọn nguyên liệu"
          body: "Chúng tôi luôn lựa chọn nguyên liệu tươi mới và tự nhiên, không chứa hóa chất hay phẩm màu. Mỗi nguyên liệu được chọn lọc kỹ lưỡng, từ rau củ quả, ngũ cốc cho đến thảo mộc thiên nhiên, nhằm đảm bảo giá trị dinh dưỡng tối đa và hương vị tươi ngon. Carezone tin rằng nguyên liệu tốt chính là nền tảng cho món ăn ngon và lành mạnh."
          bg_color: "#fbf1cb"
        - number: "03"
          title: "Phương pháp chế biến"
          body: "Phương pháp chế biến tại Carezone chú trọng đến việc giữ trọn dưỡng chất và hương vị của nguyên liệu. Chúng tôi sử dụng các kỹ thuật chế biến nhẹ nhàng như hấp, luộc, nướng để bảo toàn dưỡng chất, hạn chế tối đa việc sử dụng dầu mỡ. Các món ăn được chế biến theo từng công thức riêng biệt để phù hợp với nhu cầu dinh dưỡng của từng thực khách, đảm bảo không chỉ ngon mà còn là sự kết hợp hài hòa giữa sức khỏe và sự sáng tạo."
          bg_color: "#d4da7a"
    benefits_title: "Lợi ích của việc ăn chay"
    benefits:
        - title: "Kết nối với lối sống lành mạnh"
          body: "Ăn chay không chỉ là dinh dưỡng mà còn là cách sống, giúp con người hướng đến sự cân bằng giữa cơ thể – tâm trí – thiên nhiên."
          image: d-benefit-1.webp  # 438×274 px
          bg_style: "green pattern + blue gradient"
          text_color: "white"
        - title: "Duy trì vóc dáng và năng lượng ổn định"
          body: "Thực phẩm giàu dinh dưỡng, ít chế biến giúp kiểm soát cân nặng, cung cấp năng lượng bền vững, hạn chế cảm giác mệt mỏi."
          image: d-benefit-2.webp
          bg_style: "#f8eec7 solid"
          text_color: "#113917"
        - title: "Cân bằng tinh thần, giảm căng thẳng"
          body: "Ẩm thực thuần tự nhiên giúp cơ thể nhẹ nhàng hơn, từ đó mang lại sự thư thái, cải thiện tâm trạng và giấc ngủ."
          image: d-benefit-3.webp
          bg_style: "#d6ebd9 solid"
          text_color: "#113917"
    # Desktop: sticky scroll cards pattern (left text + right stacking cards)
    # Mobile: vertical stack, cards not sticky

section-offers:
    subtitle_decorative: "Stay in touch"
    title: "Theo dõi chúng tôi\n@carezone qua các nền tảng"
    title_gradient: "linear-gradient(to right, #2d6635, #b7d10f)"
    social_buttons:
        - { title: "FACEBOOK", url: "#" }
        - { title: "ZALO", url: "#" }
        - { title: "TIKTOK", url: "#" }
    offer_cards: 4  # carousel of social/offer cards with images
    form:
        fields:
            - { name: "full_name", label: "Họ và tên", type: "text", icon: "user" }
            - { name: "phone", label: "Số điện thoại", type: "tel", icon: "phone" }
            - { name: "service", label: "Chọn dịch vụ tại Carezone", type: "select" }
            - { name: "quantity_adults", label: "Người lớn", type: "counter" }
            - { name: "quantity_children", label: "Trẻ em", type: "counter" }
        submit: { title: "ĐẶT CHỖ NGAY", url: "#" }
        image:
            desktop: d-form-family.webp  # family in Carezone robes

section-bot:
    tagline_lines:
        - "Chạm đến"
        - "trải nghiệm"
        - "Thư giãn"
        - "Đỉnh cao"
    # Contains decorative roof image + existing Footer component
    # Footer content managed separately via get_footer() or footer template-part

sticky-booking:
    schedule:
        icon: ic-calendar.svg
        text: "Đặt chỗ"
    phone:
        icon: ic-phone.svg
        url: "tel:0889227888"
    message:
        icon: ic-message.svg
        url: "#"
    # Desktop: fixed right sidebar
    # Mobile: fixed bottom bar
```

---

### Fonts

| Family | Source | Weights | Used in (D/M) | Load Method |
|--------|-------|---------|---------------|-------------|
| SVN-Optima | Local (existing) | 400, 500, 600 | D, M | `assets/fonts/SVN-Optima/stylesheet.css` — already enqueued |
| SVN-Pleasent | Local (existing) | 400 | D, M | `assets/fonts/SVN-Pleasent/stylesheet.css` — already enqueued |
| SVN-Ameyallinda Signature | Local (existing) | 400 | M (footer) | `assets/fonts/SVN-AmeyallindaSignature/stylesheet.css` — already enqueued |

> All fonts already registered in `import-assets/import-css-js.php`. No new font setup needed.

---

### Asset Enqueue

| Handle | Type | File | Condition |
|--------|------|------|-----------|
| restaurant-page-css | style | `template-parts/restaurant-page/assets/styles.css` | `is_page_template('page-restaurant.php')` |
| restaurant-page-js | script | `template-parts/restaurant-page/assets/scripts.js` | `is_page_template('page-restaurant.php')` |
| restaurant-banner-css | style | `template-parts/restaurant-page/section-banner/assets/styles.css` | same |
| restaurant-banner-js | script | `template-parts/restaurant-page/section-banner/assets/scripts.js` | same (Swiper for banner slides) |
| restaurant-menu-css | style | `template-parts/restaurant-page/section-menu/assets/styles.css` | same |
| restaurant-menu-js | script | `template-parts/restaurant-page/section-menu/assets/scripts.js` | same (Swiper for menu carousel) |
| restaurant-about-css | style | `template-parts/restaurant-page/section-about/assets/styles.css` | same |
| restaurant-about-js | script | `template-parts/restaurant-page/section-about/assets/scripts.js` | same (image carousel nav) |
| restaurant-philosophy-css | style | `template-parts/restaurant-page/section-philosophy/assets/styles.css` | same |
| restaurant-philosophy-js | script | `template-parts/restaurant-page/section-philosophy/assets/scripts.js` | same (GSAP ScrollTrigger sticky cards) |
| restaurant-offers-css | style | `template-parts/restaurant-page/section-offers/assets/styles.css` | same |
| restaurant-offers-js | script | `template-parts/restaurant-page/section-offers/assets/scripts.js` | same (Swiper carousel + form counter) |
| restaurant-bot-css | style | `template-parts/restaurant-page/section-bot/assets/styles.css` | same |
| restaurant-sticky-css | style | `template-parts/restaurant-page/sticky-booking/assets/styles.css` | same |
| restaurant-sticky-js | script | `template-parts/restaurant-page/sticky-booking/assets/scripts.js` | same |

**Dependencies:**
- Swiper CSS/JS — banner slides, menu carousel, offer cards
- GSAP + ScrollTrigger — section-philosophy sticky scroll cards
- AOS — entrance animations

---

### Files to Create

```
page-restaurant.php                              # Page template
template-parts/restaurant-page/
├── index.php                                     # Section orchestrator
├── assets/
│   ├── styles.css                                # Page-level shared styles
│   └── scripts.js                                # Page-level shared scripts
├── section-banner/
│   ├── index.php
│   └── assets/
│       ├── styles.css                            # Desktop + mobile @media
│       └── scripts.js                            # Swiper banner
├── section-menu/
│   ├── index.php
│   └── assets/
│       ├── styles.css
│       └── scripts.js                            # Tab switching + Swiper
├── section-about/
│   ├── index.php
│   └── assets/
│       ├── styles.css
│       └── scripts.js                            # Image carousel nav
├── section-philosophy/
│   ├── index.php
│   └── assets/
│       ├── styles.css
│       └── scripts.js                            # GSAP sticky scroll cards
├── section-offers/
│   ├── index.php
│   └── assets/
│       ├── styles.css
│       └── scripts.js                            # Swiper + form counter
├── section-bot/
│   ├── index.php
│   └── assets/
│       └── styles.css
└── sticky-booking/
    ├── index.php
    └── assets/
        ├── styles.css
        └── scripts.js
```

**Total: ~24 files**

---

### ACF Field Structure

**Field Group: Restaurant Page**
Condition: Page Template = `page-restaurant.php`

```
restaurant_banner (Group)
├── slides (Repeater)
│   ├── image_desktop (Image) — 1605×800 px
│   ├── image_mobile (Image) — 375×809 px
│   ├── heading (Text)
│   └── subheading (Text)

restaurant_menu (Group)
├── subtitle (Text) — decorative subtitle
├── title (Text) — main title
├── tabs (Repeater)
│   ├── tab_name (Text)
│   └── menu_image (Image) — full menu image posted by client (annotation: "cả section menu này là ảnh, để KH post ảnh")
├── menu_items (Repeater)
│   ├── name (Text)
│   ├── price (Text)
│   └── thumbnail (Image) — 72×72 px

restaurant_about (Group)
├── label (Text)
├── description (Textarea)
├── body_paragraphs (Repeater)
│   └── text (Textarea)
├── images (Gallery) — carousel images, 546×546 px (desktop)

restaurant_philosophy (Group)
├── subtitle (Text)
├── description (Textarea)
├── cards (Repeater)
│   ├── number (Text) — "01", "02", "03"
│   ├── title (Text)
│   ├── body (Textarea)
│   └── bg_color (Color Picker)
├── benefits_title (Text)
├── benefits (Repeater)
│   ├── title (Text)
│   ├── body (Textarea)
│   └── image (Image) — 438×274 px

restaurant_offers (Group)
├── subtitle (Text) — "Stay in touch"
├── title (Textarea)
├── social_links (Repeater)
│   └── link (Link) — ACF Link field {title, url, target}
├── offer_cards (Repeater)
│   ├── image (Image) — 391×525 px
│   └── badge (Text) — "FACEBOOK" label
├── form_image (Image) — family image, 800×512 px
├── form_service_options (Repeater)
│   └── option (Text) — select options

restaurant_bot (Group)
├── tagline (Textarea)
├── background_image (Image)
├── roof_image (Image)

sticky_booking (Group)
├── phone_number (Text)
├── booking_url (URL)
```

---

### Warnings

- **Menu section annotation:** Figma annotates "cả section menu này là ảnh, để KH post ảnh" — meaning the menu content area (right side with food images) is a single posted image from the client, not individual elements. The menu list (left side) is structured data, but the food display area is one image.
- **Mobile combined frame:** Mobile Frame 2147264497 (18860:65111) combines Video/Philosophy + Offers + Bot into one frame. Each section's mobileNodeId points to the relevant child within this combined frame.
- **Sticky scroll pattern (section-philosophy):** Desktop uses CSS sticky positioning for stacking cards (similar to a card-stack reveal). Mobile simplifies to vertical layout. Requires GSAP ScrollTrigger for desktop animation.
- **Info Image Container:** Small floating element (264×178px desktop / 150×96px mobile) positioned between section-philosophy and section-offers. Implemented as absolute-positioned overlay within section-philosophy.
- **Header floating button (17418:20530)** — desktopOnly element, 377×813px. Appears to be an expanded booking panel/drawer. Not generated as a section — may need separate implementation if interactive.
- **Gradient text:** section-menu title and section-offers title use `background: linear-gradient(to right, #2d6635, #b7d10f); -webkit-background-clip: text; -webkit-text-fill-color: transparent;` pattern.
- **Backdrop blur:** Menu items container uses `backdrop-filter: blur(23.45px)` with semi-transparent white background.

---

Ready to build? Run: `/figma-build`

> **Build flow tự động responsive:** Khi PLAN.md có `mobileNodeId` per section, `/figma-build` sẽ truyền data 2 viewport cho `component-generator`. Output: 1 PHP template thống nhất + CSS có `@media screen and (max-width: 639.98px)` cho mobile overrides + `<picture>` cho image swap. `visual-verifier` verify cả 2 viewport. Không cần re-plan / re-build cho mobile.
