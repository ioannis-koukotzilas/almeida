document.addEventListener('DOMContentLoaded', function () {
  initProductGallerySwiper();
});

function initProductGallerySwiper() {
  const swiper = document.querySelector('.product-gallery.swiper');

  if (!swiper) return;

  return new Swiper(swiper, {
    // loop: true,
    autoHeight: true,
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
    spaceBetween: 0,
    keyboard: {
      enabled: true,
      onlyInViewport: true,
    },
  });
}
