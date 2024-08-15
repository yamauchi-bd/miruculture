var swiper = new Swiper(".mySwiper", {
    slidesPerView: 1,
    spaceBetween: 32,
    loop: true,
    centeredSlides: true,
    pagination: {
      el: ".swiper-pagination",
      clickable: true,

    },
    autoplay: {
      delay: 2500,
      disableOnInteraction: false,
    },
    breakpoints: {
      640: {
        slidesPerView: 1,
        spaceBetween: 32,
      },
      768: {
        slidesPerView: 2,
        spaceBetween: 32,
      },
      1024: {
        slidesPerView: 3,
        spaceBetween: 32,
      },
    },
  });