// /** eslint no-param-reassign */

const Banner = {

    init() {
        const handleClick = (button) => {
            const bannerID = button.getAttribute('data-id');
            const banner = document.getElementById(`site-banner-${bannerID}`);

            // Make sure the banner doesn't re-appear when the page is re-loaded.
            localStorage.setItem(`msg-banner-${bannerID}`, 'true');

            // Remove the banner from the page.
            banner.parentNode.removeChild(banner);
        };

        const banners = document.querySelectorAll('.msg-banners__item');

        banners.forEach((banner) => {
            const bannerCacheKey = banner.getAttribute('data-id');
            if (localStorage && bannerCacheKey) {
                if (localStorage.getItem(`msg-banner-${bannerCacheKey}`)) {
                    banner.classList.add('msg-banners--none');
                } else {
                    banner.classList.remove('msg-banners--none');
                }
            } else {
                // hide close button for browsers without localStorage compatibility
                banner.classList.add('msg-banners--none');
            }

            const button = banner.querySelector('.msg-banners__close');
            if (button) {
                button.addEventListener('click', () => {
                    handleClick(button);
                });
            }
          });
    }

};

export default Banner;
