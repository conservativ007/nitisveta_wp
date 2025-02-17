<?php

/**
 * The header for our theme
 *
 * This is the template that displays the `head` element and everything up
 * until the `#content` element.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Нити_Света
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>

	<!-- Yandex.Metrika counter -->
	<script type="text/javascript">
		(function(m, e, t, r, i, k, a) {
			m[i] = m[i] || function() {
				(m[i].a = m[i].a || []).push(arguments)
			};
			m[i].l = 1 * new Date();
			for (var j = 0; j < document.scripts.length; j++) {
				if (document.scripts[j].src === r) {
					return;
				}
			}
			k = e.createElement(t), a = e.getElementsByTagName(t)[0], k.async = 1, k.src = r, a.parentNode.insertBefore(k, a)
		})
		(window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

		ym(95638673, "init", {
			clickmap: true,
			trackLinks: true,
			accurateTrackBounce: true,
			webvisor: true,
			ecommerce: "goods"
		});
	</script>
	<noscript>
		<div><img src="https://mc.yandex.ru/watch/95638673" style="position:absolute; left:-9999px;" alt="" /></div>
	</noscript>
	<!-- /Yandex.Metrika counter -->

	<!-- Top.Mail.Ru counter -->
	<script type="text/javascript">
		var _tmr = window._tmr || (window._tmr = []);
		_tmr.push({
			id: "3424496",
			type: "pageView",
			start: (new Date()).getTime()
		});
		(function(d, w, id) {
			if (d.getElementById(id)) return;
			var ts = d.createElement("script");
			ts.type = "text/javascript";
			ts.async = true;
			ts.id = id;
			ts.src = "https://top-fwz1.mail.ru/js/code.js";
			var f = function() {
				var s = d.getElementsByTagName("script")[0];
				s.parentNode.insertBefore(ts, s);
			};
			if (w.opera == "[object Opera]") {
				d.addEventListener("DOMContentLoaded", f, false);
			} else {
				f();
			}
		})(document, window, "tmr-code");
	</script>
	<noscript>
		<div><img src="https://top-fwz1.mail.ru/counter?id=3424496;js=na" style="position:absolute;left:-9999px;" alt="Top.Mail.Ru" /></div>
	</noscript>
	<!-- /Top.Mail.Ru counter -->
</head>

<body <?php body_class(!is_user_logged_in() ? 'bg-[#f6f6f6] text-primary not-logged-in' : 'bg-[#f6f6f6] text-primary'); ?>>

	<?php wp_body_open(); ?>

	<div id="page" class="flex flex-col">
		<a href="#content" class="sr-only">
			<?php esc_html_e('Skip to content', 'nitisveta'); ?>
		</a>

		<?php get_template_part('template-parts/layout/header', 'content'); ?>

		<div id="content" class="mt-20 xl:mt-32">