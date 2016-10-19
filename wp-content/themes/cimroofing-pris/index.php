<?php $page = 'index'; ?>
<?php include('header.php'); ?>
<div id="fullpage">
    <section class="section" id="inicio1">
        <img src="<?php echo CFS()->get('slide1_img'); ?>" alt="texto inicio 1" class="img-text">
        <img src="<?php echo bloginfo('template_url').'/'; ?>img/content/worker2.png" alt="persona inicio 1" class="img-decoration">
    </section>
    <section class="section" id="inicio2">
        <img src="<?php echo CFS()->get('slide2_img'); ?>" alt="texto inicio 2" class="img-text">
        <img src="<?php echo bloginfo('template_url').'/'; ?>img/content/section2.png" alt="persona inicio 2" class="img-decoration">
    </section>
    <section class="section" id="inicio3">
        <img src="<?php echo CFS()->get('slide3_img'); ?>" alt="texto inicio 3" class="img-text"> 
        <img src="<?php echo bloginfo('template_url').'/'; ?>img/content/section3.png" alt="personas incio 3" class="img-decoration">   
    </section>
    <section class="section" id="inicio4">
        <img src="<?php echo CFS()->get('slide4_img'); ?>" alt="texto inicio 4" class="img-text">
        <img src="<?php echo bloginfo('template_url').'/'; ?>img/content/worker-inicio4.png" alt="persona inicio 4" class="img-decoration">
    </section>
    <section class="section" id="inicio5">
        <img src="<?php echo CFS()->get('slide5_img'); ?>" alt="texto inicio 5" class="img-text">
        <img src="<?php echo bloginfo('template_url').'/'; ?>img/content/worker-incio5.png" alt="persona incio 5" class="img-decoration">
    </section>
</div>
<?php include('footer.php'); ?>