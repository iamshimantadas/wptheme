# WP Theme

**WP Theme** is a clean, modular, and developer-friendly **WordPress custom theme boilerplate** built for developers who want to create **scalable, maintainable, and extensible WordPress themes** for personal or client projects.

This theme follows WordPress best practices, uses a clear folder structure, and separates concerns such as setup logic, custom post types, templates, assets, and global theme settings.

---

## 🎯 Purpose Of This Theme

- Build **custom WordPress themes faster**
- Keep **logic, templates, and settings well organized**
- Easily **extend or customize** for any project
- Ideal for **developers** (no page-builder dependency)
- Uses **WordPress native APIs** (Theme Support, Settings API, Template Hierarchy)

---

## 📁 Folder & File Structure Overview

```text
wptheme/
│
├── assets/
│   ├── css/
│   │   ├── bootstrap.min.css
│   │   └── main.css
│   └── img/
│
├── inc/
│   ├── setup.php
│   └── post-types/
│       ├── Services.php
│       └── Testimonials.php
│
├── template-parts/
│   ├── topbar-header.php
│   ├── inner-banner.php
│   ├── testimonials.php
│   └── get-in-touch.php
│
├── templates/
│   ├── tpl-about.php
│   ├── tpl-contactus.php
│   └── tpl-services.php
│
├── theme-settings.php
├── functions.php
├── header.php
├── footer.php
├── index.php
├── front-page.php
├── page.php
├── single.php
├── single-our_service.php
├── archive.php
├── category.php
├── tag.php
├── taxonomy.php
├── search.php
├── comments.php
├── 404.php
├── style.css
├── screenshot.png
└── whats_new_1.PNG
```

---

## 🧠 Core Files Explained

### style.css
- Contains theme metadata (name, version, author, text-domain)
- Required for WordPress to recognize the theme
- Can also hold global fallback styles

---

### functions.php
Acts as the **main bootstrap file**.

Responsibilities:
- Loads setup logic from `/inc/setup.php`
- Loads custom post types
- Includes `theme-settings.php`
- Enqueues theme stylesheets and scripts
- Keeps logic modular and readable

---

### inc/setup.php
Handles **theme initialization**.

Responsibilities:
- add_theme_support() (title-tag, thumbnails, HTML5, etc.)
- Registering navigation menus
- Registering widget areas
- General theme configuration

---

## 🧩 Custom Post Types (inc/post-types)

This folder contains **all custom post type registrations**, each in its own file.

- Services.php  
  Registers the **Services** custom post type

- Testimonials.php  
  Registers the **Testimonials** custom post type

Each post type uses `register_post_type()` and follows WordPress standards.

---

## 🎨 Assets Management

### assets/css
- bootstrap.min.css → Bootstrap framework
- main.css → Theme-specific styles

### assets/img
- Stores static images used across templates
- Keeps media organized and reusable

---

## 🧱 Template Parts (template-parts)

Reusable UI components included via `get_template_part()`:

- topbar-header.php
- inner-banner.php
- testimonials.php
- get-in-touch.php

---

## 📄 Page Templates (templates)

Custom page templates selectable from WordPress Admin:

- tpl-about.php
- tpl-contactus.php
- tpl-services.php

Unused templates were removed to keep the theme clean.

---

## ⚙️ Theme Settings (Introduced in v1.0.1)

### theme-settings.php

Handles **global theme options** using the **WordPress Settings API**.

Used for:
- Header configuration
- Footer configuration
- Social media links
- Social icons
- Global branding options

Settings are accessed using `get_option()`.

---

## 🆕 What’s New in Version 1.0.1

- Added Theme Settings system
- Introduced theme-settings.php
- Implemented WordPress Settings API
- Improved modular architecture
- Removed unused templates


## 🧑‍💻 Who Should Use This Theme?

- WordPress theme developers
- PHP developers entering WordPress
- Freelancers building custom client themes
- Developers who want full control

---

## 🚀 Extending The Theme

You can:
- Add new custom post types
- Extend theme settings
- Add custom taxonomies
- Integrate ACF
- Make it WooCommerce-ready

---

## 📜 License

Personal and educational use.
Free to modify and extend.
Note: we have integrated acf pro plugin in it. source: https://github.com/wordpress-premium/advanced-custom-fields-pro
Note: we have integrated elementor pro addons integrate plugin. source: https://github.com/proelements/proelements

---

## 🤝 Author

Shimanta Das  
WordPress & PHP Developer

---

Happy coding 🚀
