# Agilus WordPress Block Theme

A modern, custom WordPress block theme for Agilus, designed for the 2025 relaunch. This theme leverages the latest WordPress block editor features, custom blocks, and advanced theme.json configuration for a flexible, scalable, and maintainable site experience.

## Features

- **Full Site Editing (FSE):** Utilizes WordPress block-based templates and template parts for complete design control.
- **Custom Blocks:** Includes a suite of custom blocks for Agilus-specific content, such as:
  - **AG Case Study:** Display case study logos with overlay details.
  - **AG Latest Jobs:** Show the latest jobs from an XML feed.
  - **AG FAQs:** Toggleable FAQ sections.
  - **AG Branch:** Branch location/contact details.
  - **AG Team Member Role/LinkedIn:** Team member info and LinkedIn links.
  - **AG Search Toggle:** Custom search UI.
  - **AG Content Index:** Content navigation/index block.
- **Custom Navigation:** Font Awesome icon support in navigation links and submenus.
- **Custom Search:** Unique search block styles for clients and job seekers.
- **Custom Templates:** Includes templates for case studies, news items, selection pages, and more.
- **Theme.json:** Centralized configuration for colors, gradients, typography, and block settings.
- **ACF Integration:** Custom blocks are powered by Advanced Custom Fields (ACF) for flexible content management.
- **Modern CSS:** Uses CSS layers and modern best practices for styling.
- **Accessibility:** Designed with accessibility in mind.

## Folder Structure

- `blocks/` — Custom block definitions (PHP, JS, CSS, block.json)
- `inc/` — Theme setup, helpers, custom blocks, navigation, and search logic
- `assets/` — Fonts and images
- `parts/` — Template parts (headers, footers)
- `templates/` — Block-based templates for pages, posts, and custom post types
- `acf-json/` — Local JSON for ACF field groups
- `style.css` — Main theme stylesheet and metadata
- `scripts.js` — Custom JavaScript for UI enhancements
- `theme.json` — Global theme settings and block configuration

## Requirements

- WordPress 6.7+
- PHP 5.7+
- [Advanced Custom Fields Pro](https://www.advancedcustomfields.com/pro/) (for custom blocks)

## Installation

1. Copy the theme folder to your `wp-content/themes/` directory.
2. Activate the theme in the WordPress admin.
3. Ensure ACF Pro is installed and activated.
4. Import or sync ACF field groups from `acf-json/` if needed.

## Development

- Custom blocks are registered in `inc/ag-custom-blocks.php` and defined in the `blocks/` directory.
- Block assets (JS/CSS) are automatically enqueued.
- Modify `theme.json` for global styles and settings.
- Use `scripts.js` for front-end enhancements.

## Credits

- Theme by Ken Chase – [kenchase.com](https://kenchase.com/) for Agilus
- Font: Inter, Sofia Pro Soft
- Icons: Font Awesome

## License

GNU General Public License v2 or later. See `style.css` for details.
