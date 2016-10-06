<?php $page = 'galeria'; ?>
<?php include('header.php'); ?>

<div id="fullpage">
    <section class="section" id="galeria">
        <div id="carousel-gallery" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#carousel-galleryc" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-gallery" data-slide-to="1"></li>
                <li data-target="#carousel-gallery" data-slide-to="2"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                <div class="item active">
                    <img src="..." alt="...">
                    <div class="carousel-caption">
                        ...
                    </div>
                </div>
                <div class="item">
                    <img src="..." alt="...">
                    <div class="carousel-caption">
                        ...
                    </div>
                </div>
                ...
            </div>

            <!-- Controls -->
            <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                <span class="icon-prev" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                <span class="icon-next" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </section>
</div>

<?php include('footer.php'); ?>