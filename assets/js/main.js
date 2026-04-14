/* SkinLuxe — front-end interactions
 * - Slide-out cart drawer + AJAX
 * - Sticky ATC bar (shows after passing main ATC)
 * - Accordion
 * - Carousel arrow controls
 * - Reveal on scroll
 * - AJAX add-to-cart on product cards
 */
(function ($) {
	'use strict';

	const data = window.SkinLuxeData || {};

	/* ----------------------------------------------------
	 * Drawer
	 * ---------------------------------------------------- */
	const $drawer = $('#sl-drawer');
	const $drawerBody = $drawer.find('.sl-drawer__body');

	function openDrawer() {
		$drawer.addClass('is-open').attr('aria-hidden', 'false');
		document.body.style.overflow = 'hidden';
		refreshDrawer();
	}
	function closeDrawer() {
		$drawer.removeClass('is-open').attr('aria-hidden', 'true');
		document.body.style.overflow = '';
	}
	function refreshDrawer() {
		$.post(data.ajax_url, {
			action: 'skinluxe_get_drawer',
			nonce:  data.nonce,
		}).done(function (res) {
			if (res && res.success) {
				$drawerBody.html(res.data.html);
				$('.skinluxe-cart-count').attr('data-count', res.data.count).text(res.data.count);
			}
		});
	}

	$(document).on('click', '[data-open-drawer]',  function (e) { e.preventDefault(); openDrawer();  });
	$(document).on('click', '[data-close-drawer]', function (e) { e.preventDefault(); closeDrawer(); });
	$(document).on('keydown', function (e) { if (e.key === 'Escape') closeDrawer(); });

	// Qty + remove inside drawer
	$(document).on('click', '.sl-qty-inc, .sl-qty-dec', function () {
		const $item = $(this).closest('.sl-drawer__item');
		const $input = $item.find('.sl-qty-input');
		let qty = parseInt($input.val(), 10) || 0;
		qty = $(this).hasClass('sl-qty-inc') ? qty + 1 : Math.max(0, qty - 1);
		$input.val(qty).trigger('change');
	});
	$(document).on('change', '.sl-qty-input', function () {
		const $item = $(this).closest('.sl-drawer__item');
		updateQty($item.data('key'), parseInt($(this).val(), 10) || 0);
	});
	$(document).on('click', '.sl-drawer__remove', function () {
		const $item = $(this).closest('.sl-drawer__item');
		removeItem($item.data('key'));
	});

	function updateQty(key, qty) {
		$.post(data.ajax_url, {
			action:   'skinluxe_update_qty',
			nonce:    data.nonce,
			cart_key: key,
			qty:      qty,
		}).done(function (res) {
			if (res && res.success) {
				$drawerBody.html(res.data.html);
				$('.skinluxe-cart-count').attr('data-count', res.data.count).text(res.data.count);
				$(document.body).trigger('wc_fragment_refresh');
			}
		});
	}
	function removeItem(key) {
		$.post(data.ajax_url, {
			action:   'skinluxe_remove_item',
			nonce:    data.nonce,
			cart_key: key,
		}).done(function (res) {
			if (res && res.success) {
				$drawerBody.html(res.data.html);
				$('.skinluxe-cart-count').attr('data-count', res.data.count).text(res.data.count);
				$(document.body).trigger('wc_fragment_refresh');
			}
		});
	}

	/* ----------------------------------------------------
	 * AJAX add-to-cart on product cards (bestsellers)
	 * ---------------------------------------------------- */
	$(document).on('click', '.sl-ajax-add', function (e) {
		const id = $(this).data('product-id');
		if (!id) return; // let the link work as fallback
		e.preventDefault();
		const $btn = $(this);
		$btn.addClass('is-loading').text('Adding…');
		$.post(data.ajax_url, {
			action:    'woocommerce_ajax_add_to_cart',
			product_id: id,
			quantity:   1,
		}).done(function () {
			$btn.removeClass('is-loading').text('Added ✓');
			setTimeout(() => $btn.text('Add to bag'), 1200);
			openDrawer();
		}).fail(function () {
			$btn.removeClass('is-loading').text('Add to bag');
		});
	});

	// When Woo fires added_to_cart (form-based), open drawer.
	$(document.body).on('added_to_cart', function () { openDrawer(); });

	/* ----------------------------------------------------
	 * Sticky ATC bar on single-product
	 * ---------------------------------------------------- */
	const $stickyAtc = $('#sl-sticky-atc');
	const $mainAtc = $('.sl-product__atc');

	if ($stickyAtc.length && $mainAtc.length && 'IntersectionObserver' in window) {
		const observer = new IntersectionObserver((entries) => {
			entries.forEach((entry) => {
				if (!entry.isIntersecting) {
					$stickyAtc.addClass('is-visible').attr('aria-hidden', 'false');
				} else {
					$stickyAtc.removeClass('is-visible').attr('aria-hidden', 'true');
				}
			});
		}, { threshold: 0, rootMargin: '-80px 0px 0px 0px' });
		observer.observe($mainAtc[0]);
	}

	/* ----------------------------------------------------
	 * Accordion
	 * ---------------------------------------------------- */
	$(document).on('click', '.sl-accordion__trigger', function () {
		const $t = $(this);
		const expanded = $t.attr('aria-expanded') === 'true';
		$t.attr('aria-expanded', !expanded);
		const $panel = $t.next('.sl-accordion__panel');
		if (expanded) {
			$panel.slideUp(200, () => $panel.attr('hidden', true));
		} else {
			$panel.removeAttr('hidden').hide().slideDown(240);
		}
	});

	/* ----------------------------------------------------
	 * Carousel arrow controls
	 * ---------------------------------------------------- */
	$('[data-carousel]').each(function () {
		const $wrap  = $(this);
		const $track = $wrap.find('> div').first();
		const $scope = $wrap.closest('.sl-container, .sl-section');
		$scope.find('.sl-carousel__next').on('click', () => $track.animate({ scrollLeft: $track.scrollLeft() + $track.outerWidth() * 0.8 }, 400));
		$scope.find('.sl-carousel__prev').on('click', () => $track.animate({ scrollLeft: $track.scrollLeft() - $track.outerWidth() * 0.8 }, 400));
	});

	/* ----------------------------------------------------
	 * Reveal on scroll
	 * ---------------------------------------------------- */
	if ('IntersectionObserver' in window) {
		const io = new IntersectionObserver((entries) => {
			entries.forEach((entry) => {
				if (entry.isIntersecting) {
					entry.target.classList.add('is-in');
					io.unobserve(entry.target);
				}
			});
		}, { threshold: 0.12 });
		document.querySelectorAll('[data-reveal]').forEach((el) => io.observe(el));
	} else {
		document.querySelectorAll('[data-reveal]').forEach((el) => el.classList.add('is-in'));
	}

})(jQuery);
