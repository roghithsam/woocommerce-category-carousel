# WooCommerce Category Carousel Plugin

This WordPress plugin creates a customizable carousel of WooCommerce product categories using the **Owl Carousel** library. It allows users to display product categories dynamically with options to include/exclude categories, show counts, add navigation controls, and more.

## Features
- Customizable Owl Carousel integration.
- Display WooCommerce product categories dynamically.
- Options to filter categories (include, exclude, hide empty, parent-only).
- Customizable navigation (arrows, dots, autoplay).
- Responsive settings for desktop, tablet, and phone views.
- Optional "View" buttons and product counts.

---

## Installation
1. Copy the PHP code into your WordPress theme's `functions.php` file **or** create a custom plugin.
2. Ensure you have WooCommerce installed and active.
3. Include jQuery in your theme if not already included.

---

## Shortcode Usage
Use the following shortcode to display the category carousel anywhere on your site:

```php
[category_carousel autoplay="true" dots="true" loop="true" arrow="false"]
```

### Shortcode Attributes
The shortcode supports the following attributes for customization:

| Attribute             | Default     | Description                                                                 |
|-----------------------|-------------|-----------------------------------------------------------------------------|
| `autoplay`            | true        | Enable autoplay for the carousel (`true` or `false`).                       |
| `dots`                | true        | Show navigation dots (`true` or `false`).                                   |
| `loop`                | true        | Enable infinite loop (`true` or `false`).                                   |
| `arrow`               | false       | Show navigation arrows (`true` or `false`).                                 |
| `show_view_button`    | no          | Display a "View" button below categories (`yes` or `no`).                   |
| `show_count`          | no          | Display the product count in each category (`yes` or `no`).                 |
| `slides_desktop`      | 4           | Number of slides to display on desktop.                                     |
| `slides_tablet`       | 3           | Number of slides to display on tablets.                                     |
| `slides_phone`        | 2           | Number of slides to display on mobile devices.                              |
| `hide_empty`          | no          | Hide empty categories (`yes` or `no`).                                      |
| `parent_only`         | no          | Show only parent categories (`yes` or `no`).                                |
| `main_category_id`    | ''          | Display subcategories of a specific category ID.                            |
| `include_categories`  | ''          | Comma-separated list of category IDs to include.                            |
| `exclude_categories`  | ''          | Comma-separated list of category IDs to exclude.                            |
| `limit`               | ''          | Limit the number of categories displayed.                                   |
| `orderby`             | name        | Attribute to sort categories (`name`, `id`, etc.).                          |
| `order`               | ASC         | Sort order (`ASC` for ascending, `DESC` for descending).                    |

---

## Example Shortcode
```php
[category_carousel 
    autoplay="true" 
    dots="true" 
    loop="true" 
    arrow="true" 
    slides_desktop="5" 
    slides_tablet="3" 
    slides_phone="2" 
    show_view_button="yes" 
    show_count="yes" 
    parent_only="yes"
    hide_empty="yes"
    limit="10"
]
```
This shortcode will:
- Enable autoplay, dots, and arrows.
- Show 5 categories on desktop, 3 on tablets, and 2 on mobile.
- Show parent categories only, hide empty categories, and limit to 10 categories.
- Display a "View" button and product count.

---

## Custom CSS
The plugin includes basic styling for the carousel and product categories. You can customize it further using CSS.

**Example:**
```css
.product-category-item {
    text-align: center;
    border: 1px solid lightgrey;
    border-radius: 5px;
    background-color: #f5f7fd;
}
.product-category-item img {
    border-radius: 5px;
    object-fit: cover;
}
```

---

## Dependencies
- **WooCommerce**: Required for product category data.
- **Owl Carousel**: The plugin uses the Owl Carousel library (loaded via CDN).

---

## Owl Carousel Assets
The plugin loads the following Owl Carousel assets:
- CSS: [Owl Carousel CSS](https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css)
- Theme: [Owl Carousel Theme CSS](https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css)
- JS: [Owl Carousel JS](https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js)

---

## License
This plugin is open-source and released under the [MIT License](https://opensource.org/licenses/MIT).

---

## Support
For issues, feature requests, or contributions, please open an issue or pull request in this repository.
