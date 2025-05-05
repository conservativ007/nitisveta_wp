<div class="swiper mySwiper2 select-none swiper-product bg-white shadow mb-3 group">
    <div class="swiper-wrapper">

        <div class="swiper-slide h-[340px] xl:h-[560px] w-full">
            <img src="<?php echo get_the_post_thumbnail_url($product->ID); ?>" class="object-cover object-center h-full w-full" />
        </div>

        <?php foreach ($attachment_ids as $attachment_id) { ?>
            <div class="swiper-slide h-[340px] xl:h-[560px] w-full">
                <img src="<?php echo wp_get_attachment_url($attachment_id); ?>" class='object-cover object-center h-full w-full block' />
            </div>
        <?php } ?>

    </div>
    <div class="hidden xl:flex swiper-navigation absolute h-0 top-1/2 px-[10px] w-full items-center justify-between gap-5 z-10 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
        <div class="swiper-sprod-button-prev flex justify-center items-center w-[27px] h-[41px] border border-white border-opacity-50 rounded-[6px] bg-black bg-opacity-25">
            <svg width="11" height="13" viewBox="0 0 11 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0.498046 7.17779C-0.16862 6.79289 -0.16862 5.83064 0.498046 5.44574L8.74805 0.6826C9.41471 0.2977 10.248 0.778826 10.248 1.54863L10.248 11.0749C10.248 11.8447 9.41471 12.3258 8.74805 11.9409L0.498046 7.17779Z" fill="white" />
            </svg>
        </div>
        <div class="swiper-sprod-button-next flex justify-center items-center w-[27px] h-[41px] border border-white border-opacity-50 rounded-[6px] bg-black bg-opacity-25">
            <svg width="11" height="13" viewBox="0 0 11 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M10.5039 5.44574C11.1706 5.83064 11.1706 6.79289 10.5039 7.17779L2.2539 11.9409C1.58724 12.3258 0.753906 11.8447 0.753906 11.0749L0.753906 1.54863C0.753906 0.778826 1.58724 0.297702 2.25391 0.682602L10.5039 5.44574Z" fill="white" />
            </svg>
        </div>
    </div>
        <!-- <div class="swiper-navigation absolute h-0 top-1/2 px-1 w-full flex items-center justify-between gap-5 z-10">
        <div class="swiper-sprod-button-prev h-4 w-4 block"><svg width="15" height="17" viewBox="0 0 15 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M2 6.76795C0.666667 7.53775 0.666665 9.46225 2 10.2321L10.25 14.9952C11.5833 15.765 13.25 14.8027 13.25 13.2631L13.25 3.73686C13.25 2.19726 11.5833 1.23501 10.25 2.00481L2 6.76795Z" fill="#EF3343" stroke="white" stroke-width="2" />
            </svg>
        </div>
        <div class="swiper-sprod-button-next h-4 w-4 block">
            <svg width="15" height="17" viewBox="0 0 15 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M13 10.2321C14.3333 9.46225 14.3333 7.53775 13 6.76795L4.75 2.00481C3.41667 1.23501 1.75 2.19726 1.75 3.73686L1.75 13.2631C1.75 14.8027 3.41666 15.765 4.75 14.9952L13 10.2321Z" fill="#EF3343" stroke="white" stroke-width="2" />
            </svg>
            <svg width="11" height="13" viewBox="0 0 11 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M10.5039 5.44574C11.1706 5.83064 11.1706 6.79289 10.5039 7.17779L2.2539 11.9409C1.58724 12.3258 0.753906 11.8447 0.753906 11.0749L0.753906 1.54863C0.753906 0.778826 1.58724 0.297702 2.25391 0.682602L10.5039 5.44574Z" fill="white" />
            </svg>
        </div>
    </div>  -->
    <div class="swiper-pagination xl:hidden"></div>
</div>