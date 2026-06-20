# Main Site Colour Palette

Source: public site assets only. Admin pages and `admin/` assets were excluded.

Primary colours are taken from `assets/sass/base/_variable.scss` and checked against the public logos in `assets/img/logo.svg`, `assets/img/logo2.svg`, and `assets/img/logo3.svg`.

| Role | Colour | Hex | Usage |
| --- | --- | --- | --- |
| Primary cyan | Stelaran Aqua | `#1CA8CB` | Main brand accent, buttons, icons, active states, logo accent |
| Deep teal | Lagoon Night | `#113D48` | Headings, navigation text, dark brand text, strong contrast areas |
| Body grey | Mist Grey | `#6E7070` | Paragraphs, secondary text, descriptions |
| Soft aqua | Cloud Aqua | `#E9F6F9` | Section backgrounds, cards, subtle panels |
| Cool smoke | Soft Smoke | `#F3F4F6` | Alternate light backgrounds and quiet UI surfaces |
| Border grey | Harbour Line | `#E1E4E5` | Borders, dividers, disabled surfaces |
| Warm yellow | Sunrise Gold | `#FFB539` | Highlights, ratings, small attention accents |
| White | Clean White | `#FFFFFF` | Page background, text on dark/primary areas |
| Near black | Ink Black | `#0D0D0C` | Logo dark variant, highest emphasis text |

## Recommended Palette

```css
:root {
  --brand-primary: #1CA8CB;
  --brand-deep: #113D48;
  --brand-text: #6E7070;
  --brand-surface: #E9F6F9;
  --brand-surface-alt: #F3F4F6;
  --brand-border: #E1E4E5;
  --brand-accent: #FFB539;
  --brand-white: #FFFFFF;
  --brand-ink: #0D0D0C;
}
```

## Suggested Use

- Use `#1CA8CB` for primary calls to action and interactive highlights.
- Use `#113D48` for page titles, header text, and dark overlays.
- Use `#E9F6F9` and `#F3F4F6` for calm travel-site sections without making the page feel heavy.
- Keep `#FFB539` as a small accent only, such as stars, badges, or highlight icons.
