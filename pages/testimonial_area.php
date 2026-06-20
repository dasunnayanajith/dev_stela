<?php
require_once __DIR__ . '/../includes/content_helpers.php';
$testimonials = sh_get_testimonials($dbh);
?>
<!--==============================
Testimonial Area
==============================-->
<section class="testi-area overflow-hidden space-bottom" id="testi-sec">
    <div class="container-fluid p-0">
        <div class="title-area mb-20 text-center">
            <span class="sub-title">Testimonial</span>
            <h2 class="sec-title">What Client Say About us</h2>
        </div>
        <div class="slider-area">
            <div class="swiper th-slider testiSlider1 has-shadow" id="testiSlider1" data-slider-options='{"breakpoints":{"0":{"slidesPerView":1},"767":{"slidesPerView":"2","centeredSlides":"true"},"992":{"slidesPerView":"2","centeredSlides":"true"},"1200":{"slidesPerView":"2","centeredSlides":"true"},"1400":{"slidesPerView":"3","centeredSlides":"true"}}}'>
                <div class="swiper-wrapper">
                    <?php foreach ($testimonials as $testimonial) { ?>
                    <?php
                    $rating = max(1, min(5, (int) ($testimonial['rating'] ?? 5)));
                    $image = $testimonial['image_filename'] ?: 'testim_1.jpg';
                    ?>
                    <div class="swiper-slide">
                        <div class="testi-card">
                            <div class="testi-card_wrapper">
                                <div class="testi-card_profile">
                                    <div class="testi-card_avater">
                                        <img src="assets/img/testimonial/<?php echo htmlentities($image); ?>" alt="testimonial">
                                    </div>
                                    <div class="media-body">
                                        <h3 class="box-title"><?php echo htmlentities($testimonial['client_name']); ?></h3>
                                        <span class="testi-card_desig"><?php echo htmlentities($testimonial['client_location']); ?></span>
                                    </div>
                                </div>
                                <div class="testi-card_review">
                                    <?php for ($i = 0; $i < $rating; $i++) { ?>
                                    <i class="fa-solid fa-star"></i>
                                    <?php } ?>
                                </div>
                            </div>

                            <p class="testi-card_text"><?php echo htmlentities($testimonial['testimonial_text']); ?></p>
                            <a class="see-more-btn" aria-expanded="false">See More</a>
                            <div class="testi-card-quote">
                                <img src="assets/img/icon/testi-quote.svg" alt="img">
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <div class="slider-pagination"></div>
            </div>
        </div>
    </div>
    <div class="shape-mockup d-none d-xl-block" data-bottom="-2%" data-right="0%">
        <img src="assets/img/shape/line2.png" alt="shape">
    </div>
    <div class="shape-mockup movingX d-none d-xl-block" data-top="30%" data-left="5%">
        <img src="assets/img/shape/shape_7.png" alt="shape">
    </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
<script>
const swiper = new Swiper('.testiSlider1', {
  slidesPerView: 1,
  spaceBetween: 20,
  centeredSlides: true,
  loop: true,
  pagination: {
    el: '.swiper-pagination',
    clickable: true,
  },
  breakpoints: {
    767: { slidesPerView: 2, centeredSlides: true },
    992: { slidesPerView: 2, centeredSlides: true },
    1400: { slidesPerView: 3, centeredSlides: true },
  },
});

const maxWords = 30;

document.querySelectorAll('.testi-card_text').forEach(paragraph => {
  const fullText = paragraph.textContent.trim();
  const words = fullText.split(/\s+/);

  if (words.length > maxWords) {
    paragraph.dataset.fullText = fullText;
    paragraph.textContent = words.slice(0, maxWords).join(' ') + '...';
    paragraph.classList.add('preview');

    const button = paragraph.nextElementSibling;
    if (button && button.classList.contains('see-more-btn')) {
      button.style.display = 'inline-block';
      button.textContent = 'See More';
      button.setAttribute('aria-expanded', 'false');
    }
  } else {
    const button = paragraph.nextElementSibling;
    if (button && button.classList.contains('see-more-btn')) {
      button.style.display = 'none';
    }
  }
});

document.querySelectorAll('.see-more-btn').forEach(button => {
  button.addEventListener('click', () => {
    const paragraph = button.previousElementSibling;
    const isExpanded = button.getAttribute('aria-expanded') === 'true';

    if (isExpanded) {
      const fullText = paragraph.dataset.fullText;
      paragraph.textContent = fullText.split(/\s+/).slice(0, maxWords).join(' ') + '...';
      paragraph.classList.remove('expanded');
      paragraph.classList.add('preview');
      button.textContent = 'See More';
      button.setAttribute('aria-expanded', 'false');
    } else {
      paragraph.textContent = paragraph.dataset.fullText;
      paragraph.classList.remove('preview');
      paragraph.classList.add('expanded');
      button.textContent = 'See Less';
      button.setAttribute('aria-expanded', 'true');
    }
  });
});
</script>
