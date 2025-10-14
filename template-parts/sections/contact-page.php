<div class="contact-page">
    <div class="contact-page-wrapper">
        <div class="contact-page-header">
            <h1 class="contact-page-title" data-aos="fade-right" data-aos-duration="600" data-aos-delay="100" data-aos-easing="ease-out">
                <?php the_sub_field('title'); ?>
            </h1>
            <div class="contact-page-text" data-aos="fade-left" data-aos-duration="600" data-aos-delay="100" data-aos-easing="ease-out">
                <?php the_sub_field('text'); ?>
            </div>

            <?php if (have_rows('contact_buttons')): ?>
                <div class="contact-buttons" data-aos="fade-right" data-aos-duration="600" data-aos-delay="100" data-aos-easing="ease-out">
                    <?php $i = 0;
                    while (have_rows('contact_buttons')): the_row();
                        $i++;
                        $button_text = get_sub_field('button_text');
                        $popup_title = get_sub_field('popup_title');
                        $popup_text = get_sub_field('popup_text');
                        $contact_form = get_sub_field('contact_form', false, false);
                        $tpl_id = 'contact-modal-' . $i;

                    ?>
                        <button type="button" class="contact-button main-button" data-modal="#<?php echo esc_attr($tpl_id); ?>">
                            <span><?php echo esc_html($button_text); ?></span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                                <path d="M1 1H13V13" stroke="#717171" stroke-width="0.5" stroke-linejoin="round" />
                                <path d="M1 13L13 1" stroke="#717171" stroke-width="0.5" stroke-linejoin="round" />
                            </svg>
                        </button>

                        <div id="<?php echo esc_attr($tpl_id); ?>" class="team-modal-template contact-team-modal-template" hidden>
                            <div class="team-modal__inner">
                                <div class="team-modal__text">
                                    <?php if ($popup_title): ?><h3 class="team-modal__title"><?php echo esc_html($popup_title); ?></h3><?php endif; ?>
                                    <?php if ($popup_text): ?><div class="team-modal__content"><?php echo wp_kses_post($popup_text); ?></div><?php endif; ?>
                                    <?php if ($contact_form): ?>
                                        <div class="team-modal__content contact-team-modal__content">
                                            <?php
                                            $contact_form_raw = get_sub_field('contact_form', false, false);
                                            echo do_shortcode(shortcode_unautop($contact_form_raw));
                                            ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php endif; ?>

            <div class="team-modal" aria-hidden="true">
                <div class="team-modal__overlay" data-close></div>
                <div class="team-modal__dialog" role="dialog" aria-modal="true" aria-labelledby="team-modal-title">
                    <button class="team-modal__close" type="button" data-close aria-label="Close">
                        <span aria-hidden="true" class="team-modal__close-button">
                            <div class="team-modal__close-line"></div>
                            <div class="team-modal__close-line"></div>
                        </span>
                    </button>
                    <div class="team-modal__mount contact-team-modal__mount"></div>
                </div>
            </div>
        </div>
        <div class="contact-page-info">
            <?php $image1 = get_sub_field('image'); ?>
            <?php if ($image1): ?>
                <div class="contact-page-media-wrapper" data-aos="fade-right" data-aos-duration="600" data-aos-delay="100" data-aos-easing="ease-out">
                    <img src="<?php echo esc_url($image1['url']); ?>" class="contact-page-info-image" alt="<?php echo esc_attr($image1['alt']); ?>">
                </div>
            <?php endif; ?>
            <div class="contact-page-info-block" data-aos="fade-left" data-aos-duration="600" data-aos-delay="100" data-aos-easing="ease-out">
                <?php if (have_rows('contact_info')): ?>
                    <ul class="hb-info__list contact-hb-info__list">
                        <?php while (have_rows('contact_info')): the_row();
                            $info_link = get_sub_field('link');
                            if ($info_link && !empty($info_link['url'])): ?>
                                <li class="hb-info__item contact-page-hb-info__item">
                                    <a
                                        class="hb-info__link contact-page-hb-info__link"
                                        href="<?php echo esc_url($info_link['url']); ?>"
                                        target="<?php echo esc_attr($info_link['target'] ?: '_self'); ?>">
                                        <?php echo esc_html($info_link['title'] ?: ''); ?>
                                        <?php $get = get_sub_field('get_directions_url'); ?>
                                        <?php if ($get): ?>
                                            <a href="<?php echo esc_html($get); ?>" class="contact-page-get-link">
                                                Get directions
                                            </a>
                                        <?php endif; ?>
                                    </a>
                                </li>
                        <?php endif;
                        endwhile; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
  document.querySelectorAll('.wpcf7-submit.contact-form-button').forEach(btn => {
    if (btn.tagName.toLowerCase() === 'input') {
      const newBtn = document.createElement('button');
      newBtn.type = 'submit';
      newBtn.className = btn.className;
      newBtn.innerHTML = '<span>' + (btn.value || 'Submit') + '</span>' +
        '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none" aria-hidden="true">' +
        '<path d="M1 1H13V13" stroke="white" stroke-width="0.5" stroke-linejoin="round"/>' +
        '<path d="M1 13L13 1" stroke="white" stroke-width="0.5" stroke-linejoin="round"/>' +
        '</svg>';
      btn.parentNode.replaceChild(newBtn, btn);
    }
  });
});
</script>

<script>
    (function() {
        const root = document.querySelector('.contact-page');
        if (!root) return;

        const modal = root.querySelector('.team-modal');
        const mount = modal.querySelector('.team-modal__mount');
        const overlay = modal.querySelector('.team-modal__overlay');
        const closeBtns = modal.querySelectorAll('[data-close]');
        const html = document.documentElement;

        function openModalFromTemplate(selector, trigger) {
            const tpl = root.querySelector(selector);
            if (!tpl) return;
            mount.innerHTML = tpl.innerHTML;
            modal.classList.add('is-open');
            modal.setAttribute('aria-hidden', 'false');
            html.classList.add('is-locked');
            if (trigger) trigger.setAttribute('aria-expanded', 'true');
            trapFocus(modal);
        }

        function closeModal() {
            modal.classList.remove('is-open');
            modal.setAttribute('aria-hidden', 'true');
            html.classList.remove('is-locked');
            mount.innerHTML = '';
            releaseFocus();
        }

        root.addEventListener('click', function(e) {
            const btn = e.target.closest('.contact-button');
            if (!btn) return;
            const sel = btn.getAttribute('data-modal');
            if (sel) openModalFromTemplate(sel, btn);
        });

        closeBtns.forEach(b => b.addEventListener('click', closeModal));
        overlay.addEventListener('click', closeModal);

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && modal.classList.contains('is-open')) closeModal();
        });

        let lastFocused = null;

        function trapFocus(container) {
            lastFocused = document.activeElement;
            const focusables = container.querySelectorAll('a, button, input, textarea, select, [tabindex]:not([tabindex="-1"])');
            if (focusables.length) focusables[0].focus();
            container.addEventListener('keydown', onTab);

            function onTab(e) {
                if (e.key !== 'Tab') return;
                const list = Array.from(focusables).filter(el => !el.hasAttribute('disabled'));
                if (!list.length) return;
                const first = list[0],
                    last = list[list.length - 1];
                if (e.shiftKey && document.activeElement === first) {
                    e.preventDefault();
                    last.focus();
                } else if (!e.shiftKey && document.activeElement === last) {
                    e.preventDefault();
                    first.focus();
                }
            }
        }

        function releaseFocus() {
            if (lastFocused) lastFocused.focus();
        }
    })();
</script>