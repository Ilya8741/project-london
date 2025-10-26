<div class="black-quote" data-theme="dark">
  <div class="black-quote-wrapper">
    <div class="black-quote-top" data-aos="fade-right">
      <?php if (get_sub_field('quote_subtitle')): ?>
        <span class="black-quote-subtitle"><?php the_sub_field('quote_subtitle'); ?></span>
      <?php endif; ?>

      <h2 class="black-quote-title<?php if (get_sub_field('large_title')): ?> black-quote-large-title<?php endif; ?>">
        <?php the_sub_field('quote_title'); ?>
      </h2>

      <?php if (get_sub_field('quote_text')): ?>
        <div class="black-quote-text"><?php the_sub_field('quote_text'); ?></div>
      <?php endif; ?>

      <?php
        $bq_btn_text = get_sub_field('quote_button_text');
        $bq_btn_url  = get_sub_field('quote_button_url');
        $bq_form_raw = get_sub_field('contact_form', false, false);
        $bq_title    = get_sub_field('popup_title');
        $bq_tpl_id   = 'black-quote-modal-' . uniqid();
      ?>

      <?php if ($bq_btn_text): ?>
        <?php if ($bq_form_raw): ?>
          <button type="button"
                  class="black-quote-button main-button"
                  data-modal="#<?php echo esc_attr($bq_tpl_id); ?>">
            <span><?php echo esc_html($bq_btn_text); ?></span>
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none" aria-hidden="true">
              <path d="M1 1H13V13" stroke="#fff" stroke-width="0.5" stroke-linejoin="round" />
              <path d="M1 13L13 1" stroke="#fff" stroke-width="0.5" stroke-linejoin="round" />
            </svg>
          </button>

          <div id="<?php echo esc_attr($bq_tpl_id); ?>" class="team-modal-template contact-team-modal-template" hidden>
            <div class="team-modal__inner">
              <div class="team-modal__text">
                <?php if ($bq_title): ?>
                  <h3 class="team-modal__title"><?php echo esc_html($bq_title); ?></h3>
                <?php endif; ?>
                <div class="team-modal__content contact-team-modal__content">
                  <?php echo do_shortcode( shortcode_unautop($bq_form_raw) ); ?>
                </div>
              </div>
            </div>
          </div>
        <?php else: ?>
          <a href="<?php echo esc_url($bq_btn_url); ?>" class="black-quote-button main-button">
            <span><?php echo esc_html($bq_btn_text); ?></span>
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
              <path d="M1 1H13V13" stroke="#fff" stroke-width="0.5" stroke-linejoin="round" />
              <path d="M1 13L13 1" stroke="#fff" stroke-width="0.5" stroke-linejoin="round" />
            </svg>
          </a>
        <?php endif; ?>
      <?php endif; ?>
    </div>

    <div class="black-quote-image-wrapper" data-aos="fade-left">
      <?php $image1 = get_sub_field('image'); ?>
      <?php if ($image1): ?>
        <img src="<?php echo esc_url($image1['url']); ?>" class="black-quote-image" alt="<?php echo esc_attr($image1['alt']); ?>">
      <?php endif; ?>
    </div>
  </div>

  <div class="team-modal black-quote-modal" aria-hidden="true">
    <div class="team-modal__overlay" data-close></div>
    <div class="team-modal__dialog" role="dialog" aria-modal="true">
      <button class="team-modal__close" type="button" data-close aria-label="Close">
        <span aria-hidden="true" class="team-modal__close-button">
          <div class="team-modal__close-line"></div>
          <div class="team-modal__close-line"></div>
        </span>
      </button>
      <div class="team-modal__mount"></div>
    </div>
  </div>
</div>

<script>
(function(){
  const root = document.currentScript.closest('.black-quote') || document.querySelector('.black-quote');
  if (!root || root.dataset.modalInit === '1') return;
  root.dataset.modalInit = '1';

  const modal   = root.querySelector('.black-quote-modal');
  const mount   = modal.querySelector('.team-modal__mount');
  const overlay = modal.querySelector('.team-modal__overlay');
  const closeBtns = modal.querySelectorAll('[data-close]');
  const html = document.documentElement;

  document.body.appendChild(modal);

  function lockScroll(){
    const c = +(html.dataset.plLock || 0) + 1;
    html.dataset.plLock = c;
    html.classList.add('is-locked');
  }
  function unlockScroll(){
    const c = Math.max(+(html.dataset.plLock || 0) - 1, 0);
    html.dataset.plLock = c;
    if (!c) html.classList.remove('is-locked');
  }

  function openModalFromTemplate(selector){
    const tpl = root.querySelector(selector);
    if (!tpl) return;
    mount.innerHTML = tpl.innerHTML;
    modal.classList.add('is-open');
    modal.setAttribute('aria-hidden','false');
    lockScroll();
    trapFocus(modal);
    document.dispatchEvent(new CustomEvent('team-modal:mounted', { detail: { mount } }));
  }

  function closeModal(){
    modal.classList.remove('is-open');
    modal.setAttribute('aria-hidden','true');
    unlockScroll();
    mount.innerHTML = '';
    releaseFocus();
  }

  root.addEventListener('click', function(e){
    const btn = e.target.closest('[data-modal]');
    if (!btn || !root.contains(btn)) return;
    e.preventDefault();
    const sel = btn.getAttribute('data-modal');
    if (sel) openModalFromTemplate(sel);
  });

  closeBtns.forEach(b => b.addEventListener('click', closeModal));
  overlay.addEventListener('click', closeModal);
  document.addEventListener('keydown', e => {
    if (e.key === 'Escape' && modal.classList.contains('is-open')) closeModal();
  });

  let lastFocused = null;
  function trapFocus(container){
    lastFocused = document.activeElement;
    const focusables = container.querySelectorAll('a,button,input,textarea,select,[tabindex]:not([tabindex="-1"])');
    if (focusables.length) focusables[0].focus();
    container.addEventListener('keydown', onTab);
    function onTab(e){
      if (e.key !== 'Tab') return;
      const list = Array.from(focusables).filter(el => !el.hasAttribute('disabled'));
      if (!list.length) return;
      const first = list[0], last = list[list.length-1];
      if (e.shiftKey && document.activeElement === first){ e.preventDefault(); last.focus(); }
      else if (!e.shiftKey && document.activeElement === last){ e.preventDefault(); first.focus(); }
    }
  }
  function releaseFocus(){ if (lastFocused) lastFocused.focus(); }
})();
</script>
