# MMS Design CRM — Color Scheme Guide

This guide defines the MMS Design CRM brand colors used across the system UI.

---

## 🎨 Color Palette

| Name              | Hex Code | CSS Variable        | Usage                                |
|-------------------|----------|---------------------|--------------------------------------|
| Primary Green     | #008e49  | --primary-green     | Navbars, buttons, links              |
| Accent Lime       | #a6ce39  | --accent-lime       | Highlights, hover effects            |
| Dark Green Hover  | #006837  | --dark-green-hover  | Button and link hovers               |
| Primary Grey      | #4d4d50  | --primary-grey      | Secondary UI areas, footers          |
| Dark Grey Hover   | #2f2f30  | --dark-grey-hover   | Hover on secondary buttons           |
| Page Background   | #f8f9fa  | --page-background   | Main background                      |
| Text Color        | #333333  | --text-color        | Main text color                      |

---

## 🛠 How to Use

Import the `mms-brand.css` in your Blade layout:

```html
<link rel="stylesheet" href="{{ asset('css/mms-brand.css') }}">
