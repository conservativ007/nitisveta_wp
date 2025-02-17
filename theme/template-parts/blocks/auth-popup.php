<div id="test-popup" class="white-popup w-full xl:w-2/3 relative mx-auto mfp-hide mt-20 mb-5">
    <div class="grid lg:grid-cols-2 gap-3">
        <div class="bg-white shadow px-5 py-7 rounded-md">
            <div class="font-bold text-base lg:text-lg text-center popup-auth-title">У меня уже есть аккаунт</div>
            <div class="popup-form max-lg:hidden mt-4">
                <?php echo do_shortcode('[ultimatemember form_id="67"]'); ?>
            </div>
        </div>
        <div class="bg-white shadow px-5 py-7 rounded-md relative register-block">
            <div class="font-bold text-base lg:text-lg text-center popup-auth-title">Регистрация</div>
            <div class="popup-form max-lg:hidden mt-4">
                <?php echo do_shortcode('[ultimatemember form_id="66"]'); ?>
            </div>
        </div>
    </div>
    <div class="bg-white shadow px-5 py-7 rounded-md mt-3">
        <div class="font-bold text-base lg:text-lg text-center popup-auth-title">Пропустить и купить без аккаунта</div>
        <div class="popup-form max-lg:hidden mt-4">
            <div class="text-sm lg:text-lg mb-5">
                <div class="font-bold text-sm lg:text-lg mb-3 lg:text-center">Зарегистрированные пользователи:</div>

                <div class="flex items-center gap-2 lg:justify-center">
                    <svg class="shrink-0" width="16" height="14" viewBox="0 0 16 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0 7.07729L1.36867 5.81262C2.96933 6.58729 3.98467 7.17596 5.78333 8.45862C9.16533 4.62062 11.4007 2.67329 15.5547 0.088623L16 1.11262C12.574 4.10196 10.0653 7.43196 6.45267 13.9113C4.224 11.2873 2.73667 9.61396 0 7.07729Z" fill="#EF3343" />
                    </svg>

                    <span>получают персональные промо коды</span>
                </div>

                <div class="flex items-center gap-2 lg:justify-center ">
                    <svg class="shrink-0" width="16" height="14" viewBox="0 0 16 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0 7.07729L1.36867 5.81262C2.96933 6.58729 3.98467 7.17596 5.78333 8.45862C9.16533 4.62062 11.4007 2.67329 15.5547 0.088623L16 1.11262C12.574 4.10196 10.0653 7.43196 6.45267 13.9113C4.224 11.2873 2.73667 9.61396 0 7.07729Z" fill="#EF3343" />
                    </svg>

                    <span>сохраняют своё избранное</span>
                </div>

                <div class="flex items-center gap-2 lg:justify-center ">
                    <svg class="shrink-0" width="16" height="14" viewBox="0 0 16 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0 7.07729L1.36867 5.81262C2.96933 6.58729 3.98467 7.17596 5.78333 8.45862C9.16533 4.62062 11.4007 2.67329 15.5547 0.088623L16 1.11262C12.574 4.10196 10.0653 7.43196 6.45267 13.9113C4.224 11.2873 2.73667 9.61396 0 7.07729Z" fill="#EF3343" />
                    </svg>

                    <span>могут видеть все предыдущие заказы</span>
                </div>

                <div class="flex items-center gap-2 lg:justify-center">
                    <svg class="shrink-0" width="16" height="14" viewBox="0 0 16 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0 7.07729L1.36867 5.81262C2.96933 6.58729 3.98467 7.17596 5.78333 8.45862C9.16533 4.62062 11.4007 2.67329 15.5547 0.088623L16 1.11262C12.574 4.10196 10.0653 7.43196 6.45267 13.9113C4.224 11.2873 2.73667 9.61396 0 7.07729Z" fill="#EF3343" />
                    </svg>

                    <span>их контакты заполняются автоматически</span>
                </div>
            </div>
            <a href="/checkout" class="btn max-w-sm mx-auto text-center max-lg:text-sm"><span>Я спешу и хочу купить без входа на сайт</span></a>
        </div>
    </div>
</div>