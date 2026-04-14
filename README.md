# SkinLuxe — Premium WooCommerce Theme

A minimalist, luxury-leaning custom theme for WooCommerce. Inspired by Zara / Dior / Apple: heavy negative space, elegant typography, thin borders, zero clutter.

## Install

1. Copy the entire `skinluxe-theme/` folder into `wp-content/themes/`.
2. Activate **SkinLuxe** under **Appearance → Themes**.
3. Ensure **WooCommerce** is active.

## Seed demo products

Either:

- **WP-CLI**: `wp skinluxe seed-products`
- **Admin URL**: while logged in as an admin, visit `/wp-admin/?skinluxe_seed=1`

The seeder is idempotent (keyed by SKU) and assigns each product to the correct `skin_concern`, `key_ingredient`, and `product_line` terms.

## Taxonomies

| Slug              | Label            | Hierarchical | REST base           |
|-------------------|------------------|--------------|---------------------|
| `skin_concern`    | Skin Concerns    | yes          | `skin-concerns`     |
| `key_ingredient`  | Key Ingredients  | no           | `key-ingredients`   |
| `product_line`    | Lines            | yes          | `product-lines`     |

Default terms are seeded on first page load (Acne, Aging, Dark Spots, Pigmentation, Dryness, etc.).

## File map

```
skinluxe-theme/
├── style.css                     # theme header
├── functions.php                 # setup, enqueues, fragments
├── header.php / footer.php
├── front-page.php                # Hero + Shop by Concern + Shop by Ingredient + Bestsellers
├── index.php
├── inc/
│   ├── taxonomies.php            # skin_concern / key_ingredient / product_line
│   ├── ajax-cart.php             # drawer + AJAX endpoints + shipping progress bar
│   └── product-seeder.php        # WP-CLI + admin one-shot product seeder
├── woocommerce/
│   ├── single-product.php        # CRO override: sticky gallery, accordion, trust badges, sticky ATC bar
│   └── archive-product.php
└── assets/
    ├── css/main.css
    └── js/main.js
```

## Free-shipping threshold

Defaults to **$75**. Override:

```php
add_filter( 'skinluxe_free_shipping_min', fn() => 100 );
```

## Notes

- Tailwind is pulled from the Play CDN for speed; swap to a compiled build before production.
- All custom data (`_skinluxe_size`, `_skinluxe_benefits`, `_skinluxe_ingredients_full`, `_skinluxe_how_to_use`) is stored as post meta and safe to edit from custom fields / ACF.
- The drawer uses core Woo AJAX endpoints where possible and the theme's own handlers for qty/remove so Woo fragments stay in sync via `wc_fragment_refresh`.
