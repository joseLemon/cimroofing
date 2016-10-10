<?php $page = 'galeria'; ?>
<?php include('header.php'); ?>

<div id="fullpage">
    <section class="section" id="galeria">
        
        <div class="slide-wrapper">
           
            <div id="carousel-gallery" class="carousel slide" data-ride="carousel">
               <!--<img src="img/backgrounds/galeria2.png" alt="background" class="img-bg">-->
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#carousel-gallery" data-slide-to="0" class="active"></li>
                    <li data-target="#carousel-gallery" data-slide-to="1"></li>
                    <li data-target="#carousel-gallery" data-slide-to="2"></li>
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">
                    <div class="item active">
                        <img src="img/content/galeria/imagen1.png" alt="imagen 1 galeria" class="img-gallery">
                    </div>
                    <div class="item">
                        <img src="img/content/galeria/imagen1.png" alt="" class="img-gallery">
                    </div>
                    <div class="item">
                        <img src="img/content/galeria/imagen1.png" alt="" class="img-gallery">
                    </div>
                </div>

                <!-- Controls -->
                <a class="left carousel-control" href="#carousel-gallery" role="button" data-slide="prev">
                    <span>
                        <img src="img/element/prev-icon.png" alt="previous" class="carousel-button">
                    </span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#carousel-gallery" role="button" data-slide="next">
                    <span>
                        <img src="img/element/next-icon.png" alt="next" class="carousel-button">
                    </span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </section>
</div>

<?php include('footer.php'); ?>