<?php

defined('ABSPATH') || exit;
?>
<section
    class="store-closed-banner"
    role="status"
    aria-label="<?php esc_attr_e('Магазин временно закрыт', 'nitisveta'); ?>"
    style="box-sizing:border-box;display:flex;min-height:clamp(96px,9vw,118px);width:100%;max-width:1618px;margin:0 auto;padding:clamp(16px,2vw,23px) clamp(12px,3vw,24px);flex-direction:column;align-items:center;justify-content:center;border-radius:10px;background:#fff;box-shadow:1px 1px 2px rgba(0,0,0,.1);color:#3b2f4a;font-family:'Alice',serif;font-size:clamp(18px,2vw,25px);line-height:normal;text-align:center;overflow-wrap:anywhere"
>
    <p style="margin:0 0 5px;color:#ef3343;text-transform:uppercase">
        <?php esc_html_e('Внимание!', 'nitisveta'); ?>
    </p>
    <p style="margin:0">
        <?php esc_html_e('Магазин временно закрыт на 1 неделю. С 30-го августа по 8 сентября. Приносим свои извинения за неудобства', 'nitisveta'); ?>
    </p>
</section>
