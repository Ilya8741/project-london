<?php

/**
 * OUR TEAM section (ACF Repeater: our_team_repeater)
 * Subfields: image (Image), name (Text), job_title (Text), content (WYSIWYG),
 *            linkedin_url (URL), linkedin_text (Text)
 */
?>

<section class="team-section" id="team-section">
    <div class="team-section-wrapper">
        <div class="team-section-header">
            <div class="team-section-header-left" data-aos="fade-right" data-aos-offset="200">
                <span class="team-section-subtitle">
                    <?php the_sub_field('subtitle'); ?>
                </span>
                <h2 class="team-section-title">
                    <?php the_sub_field('title'); ?>
                </h2>
            </div>
            <?php if (get_sub_field('button_text')): ?>
                <a href="<?php the_sub_field('button_url'); ?>" class="team-section-button main-button" data-aos="fade-left" data-aos-offset="200">
                    <span><?php the_sub_field('button_text'); ?></span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                        <path d="M1 1H13V13" stroke="#717171" stroke-width="0.5" stroke-linejoin="round" />
                        <path d="M1 13L13 1" stroke="#717171" stroke-width="0.5" stroke-linejoin="round" />
                    </svg>
                </a>
            <?php endif; ?>
        </div>
        <div class="team-grid">
            <?php if (have_rows('our_team_repeater')): ?>
                <?php $i = 0;
                while (have_rows('our_team_repeater')): the_row();
                    $i++;
                    $img          = get_sub_field('image');           // array
                    $name         = get_sub_field('name');            // string
                    $job          = get_sub_field('job_title');       // string
                    $content      = get_sub_field('content');         // HTML
                    $linkedin_url = get_sub_field('linkedin_url');    // string
                    $linkedin_txt = get_sub_field('linkedin_text');   // string
                    $tpl_id       = 'team-modal-' . $i;
                ?>
                    <button class="team-card" data-aos="fade-up" data-aos-offset="200" type="button" data-modal="#<?php echo esc_attr($tpl_id); ?>">
                        <span class="team-card__image team-card__image-grid-item">
                            <?php
                            if ($img) {
                                echo wp_get_attachment_image($img['ID'], 'large', false, [
                                    'alt' => esc_attr($img['alt'] ?? ($name ?: ''))
                                ]);
                            }
                            ?>
                            <span class="team-card__open" aria-hidden="true">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                    <path d="M0.771484 1H17.2286V17" stroke="white" stroke-width="1.10345" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M0.771484 17L17.2286 1" stroke="white" stroke-width="1.10345" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </span>
                        </span>
                        <span class="team-card__meta">
                            <?php if ($name): ?><span class="team-card__name"><?php echo esc_html($name); ?></span><?php endif; ?>
                            <?php if ($job):  ?><span class="team-card__job"><?php echo esc_html($job); ?></span><?php endif; ?>
                        </span>

                    </button>

                    <div id="<?php echo esc_attr($tpl_id); ?>" class="team-modal-template" hidden>
                        <div class="team-modal__inner">
                            <div class="team-modal__media">
                                <?php
                                if ($img) {
                                    echo wp_get_attachment_image($img['ID'], 'large', false, [
                                        'alt' => esc_attr($img['alt'] ?? ($name ?: ''))
                                    ]);
                                }
                                ?>
                            </div>
                            <div class="team-modal__text">
                                <?php if ($name): ?><h3 class="team-modal__title"><?php echo esc_html($name); ?></h3><?php endif; ?>
                                <?php if ($job):  ?><div class="team-modal__subtitle"><?php echo esc_html($job); ?></div><?php endif; ?>
                                <?php if ($content): ?><div class="team-modal__content"><?php echo wp_kses_post($content); ?></div><?php endif; ?>
                                <?php if ($linkedin_url && $linkedin_txt): ?>
                                    <a class="team-modal__link main-button" href="<?php echo esc_url($linkedin_url); ?>" target="_blank" rel="noopener">
                                        <?php echo esc_html($linkedin_txt ?: 'Connect on LinkedIn'); ?>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="19" height="18" viewBox="0 0 19 18" fill="none">
                                            <path d="M1.43945 1H17.8966V17" stroke="white" stroke-width="1.10345" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M1.43945 17L17.8966 1" stroke="white" stroke-width="1.10345" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>
    <div class="team-modal" aria-hidden="true">
        <div class="team-modal__overlay" data-close></div>
        <div class="team-modal__dialog" role="dialog" aria-modal="true" aria-labelledby="team-modal-title">
            <button class="team-modal__close" type="button" data-close aria-label="Close">
                <span aria-hidden="true" class="team-modal__close-button">
                    <div class="team-modal__close-line"></div>
                    <div class="team-modal__close-line"></div>
                </span>
            </button>
            <div class="team-modal__mount"></div>
        </div>
    </div>
</section>

<style>
    html {
        scroll-behavior: smooth !important;  
    }
</style>

<script>
    (function() {
        const root = document.querySelector('.team-section');
        if (!root) return;

        const modal = root.querySelector('.team-modal');
        const mount = modal.querySelector('.team-modal__mount');
        const overlay = modal.querySelector('.team-modal__overlay');
        const closeBtns = modal.querySelectorAll('[data-close]');
        const html = document.documentElement;

        function openModalFromTemplate(selector) {
            const tpl = root.querySelector(selector);
            if (!tpl) return;

            mount.innerHTML = tpl.innerHTML;

            modal.classList.add('is-open');
            modal.setAttribute('aria-hidden', 'false');
            html.classList.add('is-locked');
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
            const btn = e.target.closest('.team-card');
            if (!btn) return;
            const sel = btn.getAttribute('data-modal');
            if (sel) openModalFromTemplate(sel);
        });

        closeBtns.forEach(b => b.addEventListener('click', closeModal));
        overlay.addEventListener('click', closeModal);

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && modal.classList.contains('is-open')) {
                closeModal();
            }
        });

        let lastFocused = null;

        function trapFocus(container) {
            lastFocused = document.activeElement;
            const focusables = container.querySelectorAll(
                'a, button, input, textarea, select, [tabindex]:not([tabindex="-1"])'
            );
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