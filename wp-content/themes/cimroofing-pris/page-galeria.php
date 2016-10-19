<?php $page = 'galeria'; ?>
<?php include('header.php'); ?>

<div id="fullpage">
    <section class="section" id="galeria">
        <div id="carousel-gallery" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#carousel-gallery" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-gallery" data-slide-to="1"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                <div class="item active">
                    <img src="<?php echo CFS()->get('img1_galeria'); ?>" alt="Foto Galería">
                </div>
                <div class="item">
                    <img src="<?php echo CFS()->get('img2_galeria'); ?>" alt="Foto Galería">
                </div>
            </div>

            <!-- Controls -->
            <a class="left carousel-control" href="#carousel-gallery" role="button" data-slide="prev">
                <span>
                    <img src="<?php echo bloginfo('template_url').'/'; ?>img/element/prev-icon.png" alt="next" class="carousel-button">
                </span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#carousel-gallery" role="button" data-slide="next">
                <span>
                    <img src="<?php echo bloginfo('template_url').'/'; ?>img/element/next-icon.png" alt="next" class="carousel-button">
                </span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </section>
</div>

<?php include('footer.php'); ?>