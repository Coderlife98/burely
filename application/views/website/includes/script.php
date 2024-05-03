<script src="<?php echo base_url('media/website/assets/js/jquery/jquery.min.js');?>"></script>
    <!-- =====bootstrap===== -->
    <script src="<?php echo base_url('media/website/assets/js/bootstrap/bootstrap.bundle.min.js');?>"></script>
    <!-- ======slider===== -->
    <script src="<?php echo base_url('media/website/assets/js/swiper/swiper-bundle.min.js');?>"></script>
    <!-- ===============animation========= -->
    <script src="<?php echo base_url('media/website/assets/js/jquery.nice-select.min.js');?>"></script>
    <script src="<?php echo base_url('media/website/assets/js/animation/aos.js');?>"></script>
    <script src="<?php echo base_url('media/website/assets/js/meanmenu.js');?>"></script>
    <!-- ======mixitup======= -->
    <script src="<?php echo base_url('media/website/assets/js/mixitup/mixitup.min.js');?>"></script>
    <script src="<?php echo base_url('media/website/assets/js/nouislider.js');?>"></script>
    <!-- ======custom script====== -->
    <script src="<?php echo base_url('media/website/assets/js/app.js');?>"></script>
    <!-- ========mixitup init========= -->
    <!-- <script src="<?php //echo base_url('media/website/assets/js/mixitup.js');?>"></script> -->
   <!-- ========gsap animation effect========= -->
   <!-- <script src=".<?php //echo base_url('media/website/.<?php echo base_url('media/website/cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js');?>"></script> -->
   <script src="<?php echo base_url('media/website/cdnjs.cloudflare.com//ajax/libs/gsap/3.12.2/gsap.min.js');?>">
<script src="<?php echo base_url()?>media/light/src/js/lightbox.js" />

   </script>
   <script src="<?php echo base_url('media/website/cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js');?>"></script>
   <script>
    gsap.registerPlugin(ScrollTrigger);

    let revealContainers = document.querySelectorAll(".about-img");

    revealContainers.forEach((container) => {
    let image = container.querySelector("img");
    let tl = gsap.timeline({
    scrollTrigger: {
      trigger: container,
      toggleActions: "restart none none reset"
    }
  });

    tl.set(container, { autoAlpha: 1 });
    tl.from(container, 1.5, {
    xPercent: -100,
    ease: Power2.out
  });
    tl.from(image, 1.5, {
    xPercent: 100,
    scale: 1.3,
    delay: -1.5,
    ease: Power2.out
  });
});
</script>
<!-- Preloader -->
<script src="<?php echo base_url('media/website/assets/js/jquery/jquery.min.js');?>"></script>
<script>
    $(document).ready(function() {
    setTimeout(function() {
    $('#container').addClass('loaded');
    if ($('#container').hasClass('loaded')) {

    $('#preloader').delay(2000).queue(function() {
     $(this).remove();
    });}
    }, 2000);});
</script>
