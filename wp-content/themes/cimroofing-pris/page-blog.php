<?php $page = 'blog'; ?>
<?php include('header.php'); ?>

<div id="fullpage">
    <section class="section" id="blog">
        <div class="row">
            <div class="col-sm-6"></div>
            <div class="col-sm-6 contenedor">
                <div class="pos">
                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                        <h3 class="titulo">Blog</h3><br>
                        <img src="<?php echo bloginfo('template_url').'/'; ?>img/content/division-blog.png" alt="divider blog" class="divider"><br>
                        <!-- Indicators -->
                        <div class="pos-indicators">
                            <ol class="carousel-indicators">
                                <?php
                                $counter = 0;
                                query_posts( 'showposts=10' );
                                if ( have_posts() ) {
                                    while ( have_posts() ) {
                                        the_post();
                                        if($counter == 0) {
                                            echo '<li data-target="#myCarousel" data-slide-to="0" class="active"></li>';
                                        } else {
                                            echo '<li data-target="#myCarousel" data-slide-to="'.$counter.'"></li>';
                                        }
                                        $counter++;
                                    }
                                }
                                wp_reset_query();
                                ?>
                            </ol>
                        </div>
                        <!-- Wrapper for slides -->
                        <div class="carousel-inner" role="listbox">
                            <?php
                            $counter = 0;
                            if ( have_posts() ) {
                                the_post();
                            }
                            ?>                                   
                            <?php
                            query_posts( 'showposts=10' );
                            if ( have_posts() ) {
                                while ( have_posts() ) {
                                    the_post();
                                    if($counter == 0) {
                                        echo '<div class="item active">';
                                    } else {
                                        echo '<div class="item">';
                                    }
                            ?>
                            <div class="col-sm-4 tamano-texto">
                                <h3 class="titulo-contenido"><?php echo get_the_title(); ?></h3>
                                <p class="fecha"><img src="<?php echo bloginfo('template_url').'/'; ?>img/element/clock.png" alt="reloj fecha" class="img-decoration"> <?php echo get_the_date(); ?></p>
                                <p class="texto-contenido"><?php echo CFS()->get('preview'); ?></p>
                                <a href="<?php echo get_the_permalink(); ?>" class="link-blog">Leer Nota</a>
                            </div>
                            <?php
                                    echo '</div>';
                                    $counter++;
                                }
                            }
                            wp_reset_query();
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php include('footer.php'); ?>