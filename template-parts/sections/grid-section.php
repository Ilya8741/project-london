<style>
    .grid-section {
        position: relative;
        overflow: visible;
        padding-top: 200px;
    }

    .grid-image-bg {
        height: 410px;
        width: auto;
        object-fit: contain;
        position: absolute;
        right: 0;
        top: 0;
    }

    .grid-section-wrapper {
        max-width: 1440px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .grid-section-item-3 {
        max-width: 1150px;
        margin: 0 auto;
    }

    .grid-section-icon {
        position: absolute;
        right: 0;
        bottom: 0;
    }

    .grid-section-image-wrapper {
        display: flex;
        position: relative;
    }

    .grid-section-text {
        margin-top: 16px;
        color: #2B2B2B;
        font-family: "Test Newzald";
        font-size: 24px;
        font-style: normal;
        font-weight: 400;
        line-height: 110%;
        letter-spacing: -0.4px;
        text-decoration: none;
    }

    .grid-section-icon {
        padding: 0;
        height: 50px;
        width: 50px;
        display: flex;
        justify-content: center;
        align-items: center;
        background: #2B2B2B;
        transition: all .3s ease;
        border: 1px solid #2B2B2B;
    }

    .grid-section-icon svg {
        min-width: 16px;
        width: 16px;
        height: 16px;
    }

    .grid-section-icon svg path{
        transition: all .3s ease;
    }

    .grid-section-item-1 .grid-section-image-wrapper{
        max-width: 572px;
    }
    
    .grid-section-item-2 {
        margin-top: auto;
        margin-bottom: -195px;
    }

    .grid-section-item-1 img {
        object-fit: contain;
        aspect-ratio: 572 / 800;
        height: auto;
        width: 100%;
        max-width: 572px;
    }

    .grid-section-item-1 .grid-section-link{
        display: block;
        width: fit-content;
    }

    .grid-section-item-2 img {
        object-fit: contain;
        aspect-ratio: 690 / 560;
        height: auto;
        width: auto;
    }

    .grid-section-item-3 img {
        object-fit: cover;
        aspect-ratio: 1150 / 720;
        height: auto;
        width: 100%;
    }

    .grid-section-wrapper-top {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
        margin-bottom: 320px;
    }

    .grid-section-link {
        text-decoration: none;
    }

    .grid-section-link:hover .grid-section-icon {
        background: #fff;
    }

    .grid-section-link:hover .grid-section-icon svg path{
        stroke: #2B2B2B;
    }

    @media(max-width: 992px) {
        .grid-section {
            padding-top: 80px;
        }
        .grid-section-wrapper-top {
            display: grid;
            grid-template-columns: repeat(1, 1fr);
            gap: 50px;
            margin-bottom: 88px;
        }

        .grid-section-item-2 {
            margin-bottom: 0;
        }

        .grid-image-bg {
            display: none;
        }

        .quote-right-name {
            margin-right: auto;
            margin-left: 0 !important; 
        }

        .quote-right-content{
            margin-right: auto;
        }
    }
</style>

<div class="grid-section">
    <?php
    $grid_image = get_sub_field('grid_image_bg');
    if ($grid_image): ?>
        <img src="<?php echo esc_url($grid_image['url']); ?>" class="grid-image-bg" alt="<?php echo esc_attr($grid_image['alt']); ?>">
    <?php endif; ?>
    <div class="grid-section-wrapper">
        <div class="grid-section-wrapper-top">
            <!-- Item 1 -->
            <div class="grid-section-item grid-section-item-1">
                <a href="<?php the_sub_field('item1_link'); ?>" class="grid-section-link">
                    <div class="grid-section-image-wrapper">
                        <?php $image1 = get_sub_field('item1_image'); ?>
                        <?php if ($image1): ?>
                            <img src="<?php echo esc_url($image1['url']); ?>" alt="<?php echo esc_attr($image1['alt']); ?>">
                        <?php endif; ?>
                        <span class="grid-section-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                <path d="M0.771484 1H17.2286V17" stroke="white" stroke-width="1.10345" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M0.771484 17L17.2286 1" stroke="white" stroke-width="1.10345" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </span>
                    </div>

                    <div class="grid-section-text"><?php the_sub_field('item1_text'); ?></div>
                </a>
            </div>

            <!-- Item 2 -->
            <div class="grid-section-item grid-section-item-2">
                <a href="<?php the_sub_field('item2_link'); ?>" class="grid-section-link">
                    <div class="grid-section-image-wrapper">
                            <?php $image2 = get_sub_field('item2_image'); ?>
                    <?php if ($image2): ?>
                        <img src="<?php echo esc_url($image2['url']); ?>" alt="<?php echo esc_attr($image2['alt']); ?>">
                    <?php endif; ?>
  <span class="grid-section-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                <path d="M0.771484 1H17.2286V17" stroke="white" stroke-width="1.10345" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M0.771484 17L17.2286 1" stroke="white" stroke-width="1.10345" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                    </span>
                    </div>
                
                    <div class="grid-section-text"><?php the_sub_field('item2_text'); ?></div>
                  
                </a>
            </div>
        </div>

        <!-- Item 3 -->
        <div class="grid-section-item grid-section-item-3">
            <a href="<?php the_sub_field('item3_link'); ?>" class="grid-section-link">
                <div class="grid-section-image-wrapper">
<?php $image3 = get_sub_field('item3_image'); ?>
                <?php if ($image3): ?>
                    <img src="<?php echo esc_url($image3['url']); ?>" alt="<?php echo esc_attr($image3['alt']); ?>">
                <?php endif; ?>
                    <span class="grid-section-icon">
                   <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                <path d="M0.771484 1H17.2286V17" stroke="white" stroke-width="1.10345" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M0.771484 17L17.2286 1" stroke="white" stroke-width="1.10345" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                </span>
                </div>
                
                <div class="grid-section-text"><?php the_sub_field('item3_text'); ?></div>
            
            </a>
        </div>
    </div>
</div>
