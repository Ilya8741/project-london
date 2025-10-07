<?php
$before = get_sub_field('before_image');
$after  = get_sub_field('after_image'); 
if (!$before && !$after) return;
?>
<section class="before-after <?php if (get_sub_field('top_spacing')): ?> before-after-top-none <?php endif; ?> <?php if (get_sub_field('bottom_spacing')): ?> before-after-bottom-none <?php endif; ?>" data-aos="fade-up" data-aos-offset="200" data-aos-delay="200">
    <div class="before-after__wrap">
        <div class="before-after__viewport" style="--pos:50%;">
            <?php if ($after): ?>
                <img
                    class="before-after__img before-after__img--after"
                    src="<?php echo esc_url($after['url']); ?>"
                    alt="<?php echo esc_attr($after['alt']); ?>"
                    loading="lazy">
            <?php endif; ?>

            <div class="before-after__before" aria-hidden="true">
                <?php if ($before): ?>
                    <img
                        class="before-after__img before-after__img--before"
                        src="<?php echo esc_url($before['url']); ?>"
                        alt="<?php echo esc_attr($before['alt']); ?>"
                        loading="lazy">
                <?php endif; ?>
            </div>

            <div class="before-after__handle" role="separator" aria-orientation="vertical" aria-label="Drag to compare">
                <span class="before-after__handle-icon" aria-hidden="true"><svg width="15" height="25" viewBox="0 0 15 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M13.0714 1L2 12.0714L13.0714 23.1429" stroke="#2B2B2B" stroke-width="2" stroke-linecap="round" />
                    </svg>
                    <svg width="14" height="25" viewBox="0 0 14 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0.999862 23.1445L12.0713 12.0731L0.999864 1.00168" stroke="#2B2B2B" stroke-width="2" stroke-linecap="round" />
                    </svg>
                </span>
            </div>
        </div>

        <div class="before-after__captions">
            <span class="before-after__caption before-after__caption--left">Before</span>
            <span class="before-after__caption before-after__caption--right">After</span>
        </div>
    </div>
</section>

<style>
    .before-after {
        padding: 160px 20px;
        max-width: 1440px;
        margin: 0 auto;
        background: transparent;
        overflow: hidden;
    }

    .before-after.before-after-top-none {
        padding-top: 0 !important;
    }

    .before-after.before-after-bottom-none {
        padding-bottom: 0 !important;
    }

    .before-after__wrap {
        background: transparent;
        padding: 0;
    }

    .before-after__viewport {
        position: relative;
        width: 100%;
        background: #000;
        --pos: 50%;
        aspect-ratio: 16 / 9;
    }

    @supports not (aspect-ratio: 1 / 1) {
        .before-after__viewport {
            height: 0;
        }

        .before-after__viewport::before {
            content: "";
            display: block;
            padding-top: calc(100% * 9 / 16);
        }

        @media (max-width: 768px) {
            .before-after__viewport::before {
                padding-top: calc(100% * 264 / 430);
            }
        }
    }

    .before-after__img {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        will-change: transform;
    }

    .before-after__img--after {
        z-index: 1;
    }

    .before-after__before {
        position: absolute;
        inset: 0;
        width: 100%;
        height: calc(100% + 1px);
        z-index: 2;
        overflow: hidden;
        clip-path: inset(0 calc(100% - var(--pos)) 0 0);
    }

    .before-after__handle {
        position: absolute;
        top: 0;
        bottom: 0;
        left: var(--pos);
        transform: translateX(-50%);
        width: 0;
        z-index: 3;
        cursor: ew-resize;
    }

    .before-after__handle::before {
        content: "";
        position: absolute;
        top: 0;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 2px;
        background: #fff;
        box-shadow: 0 0 0 1px rgba(0, 0, 0, .15);
    }

    .before-after__handle-icon {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: #fff;
        color: #333;
        border-radius: 0;
        user-select: none;
        pointer-events: none;
        height: 53px;
        width: 53px;
        display: flex;
        align-items: center;
        gap: 10px;
        justify-content: center;
    }


    .before-after__captions {
        display: flex;
        justify-content: space-between;
        color: #2B2B2B;
        font-family: "Test Newzald", sans-serif;
        font-size: 24px;
        font-style: normal;
        font-weight: 400;
        line-height: 110%;
        letter-spacing: -0.4px;
        color: #333;
        padding: 17px 0 0 0;
    }

    .before-after__caption--left {
        margin-right: auto;
    }

    .before-after__caption--right {
        margin-left: auto;
    }

    @media (max-width: 992px) {
        .before-after__viewport {
            aspect-ratio: 430 / 264;
        }

        .before-after {
            padding: 64px 24px;
            background: transparent;
        }

        .before-after__handle-icon {
            height: 32px;
            width: 32px;
        }

        .before-after__handle-icon svg {
            height: 12px;
            width: auto;
        }

        .before-after__caption {
            font-size: 20px;
        }

        .before-after__captions {
            padding-top: 15px;
        }
    }
</style>


<script>
    (function() {
        function initBA(root) {
            var viewport = root.querySelector('.before-after__viewport');
            var beforeWrap = root.querySelector('.before-after__before');
            var handle = root.querySelector('.before-after__handle');
            if (!viewport || !beforeWrap || !handle) return;

            var dragging = false;

            function setPos(clientX) {
                var rect = viewport.getBoundingClientRect();
                var x = Math.min(Math.max(clientX - rect.left, 0), rect.width);
                var pct = (x / rect.width) * 100;
                viewport.style.setProperty('--pos', pct + '%');
            }

            function down(e) {
                dragging = true;
                root.classList.add('is-dragging');
                if (e.type === 'mousedown') e.preventDefault();
                setPos(e.touches ? e.touches[0].clientX : e.clientX);
                window.addEventListener('mousemove', move, {
                    passive: false
                });
                window.addEventListener('touchmove', move, {
                    passive: false
                });
                window.addEventListener('mouseup', up, {
                    passive: true
                });
                window.addEventListener('touchend', up, {
                    passive: true
                });
            }

            function move(e) {
                if (!dragging) return;
                setPos(e.touches ? e.touches[0].clientX : e.clientX);
            }

            function up() {
                dragging = false;
                root.classList.remove('is-dragging');
                window.removeEventListener('mousemove', move);
                window.removeEventListener('touchmove', move);
                window.removeEventListener('mouseup', up);
                window.removeEventListener('touchend', up);
            }

            // клик по области тоже двигает
            viewport.addEventListener('mousedown', down);
            viewport.addEventListener('touchstart', down, {
                passive: true
            });
            handle.addEventListener('mousedown', down);
            handle.addEventListener('touchstart', down, {
                passive: true
            });
        }

        document.querySelectorAll('.before-after').forEach(initBA);
    })();
</script>