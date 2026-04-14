#!/usr/bin/env bash
#
# SkinLuxe — local bootstrap via @wordpress/env
# Requires: Docker Desktop running, and Node.js 18+.
#
# After this finishes you'll have:
#   - WordPress at http://localhost:8888  (admin / password)
#   - WooCommerce installed + activated
#   - SkinLuxe theme activated
#   - 11 demo products seeded with custom taxonomies
#
set -euo pipefail

cd "$(dirname "$0")/.."

echo "▸ Starting wp-env (this pulls Docker images on first run)…"
npx --yes @wordpress/env@latest start

echo "▸ Activating theme…"
npx @wordpress/env run cli wp theme activate skinluxe-theme

echo "▸ Finishing WooCommerce setup (skip onboarding)…"
npx @wordpress/env run cli wp option update woocommerce_onboarding_profile '{"completed":true}' --format=json || true
npx @wordpress/env run cli wp option update woocommerce_task_list_hidden 'yes' || true

echo "▸ Creating default WC pages (shop, cart, checkout)…"
npx @wordpress/env run cli wp wc --user=admin tool run install_pages || true

echo "▸ Seeding products…"
npx @wordpress/env run cli wp skinluxe seed-products

echo ""
echo "✓ Done."
echo "  Front end:  http://localhost:8888"
echo "  Admin:      http://localhost:8888/wp-admin   (admin / password)"
echo ""
echo "To stop:      npx @wordpress/env stop"
echo "To destroy:   npx @wordpress/env destroy"
