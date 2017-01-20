<?php $page = 'single'; ?>
<?php include('header.php'); ?>

<div id="singleblogpost">
    <!--<img src="<?php echo bloginfo('template_url').'/'; ?>img/backgrounds/singleblogpost.png" alt="elementos del bg del blog" class="bg-asset">
<section class="section" id="singleblogpost">-->
    <div class="row no-margin">
        <div class="col-sm-6"></div>
        <div class="col-sm-6 contenedor">
            <div class="pos">

                    <h3 class="titulo">Blog</h3><br>
                    <img src="<?php echo bloginfo('template_url').'/'; ?>img/content/division-blog.png" alt="divider blog" class="divider"><br>


                    <!-- Wrapper for slides -->
                        <div class="scrollbar-inner">


                            <?php
                            if ( have_posts() ) {
                                the_post();
                            }
                            ?>
                            <h3 class="titulo-contenido"><?php echo get_the_title(); ?></h3>
                            <p class="fecha"><img src="<?php echo bloginfo('template_url').'/'; ?>img/element/clock.png" alt="reloj fecha" class="img-decoration"> <?php echo get_the_date(); ?></p>
                            <text class="texto-contenido"><?php echo the_content(); ?></p>



                        </div>

                        <!-- NAVEGACIÓN A OTROS POSTS -->
                        <div class="position-links">
                            <nav id="post-entries">
                                <div class="row no-margin">
                                    <div class="nav-prev link"><?php previous_post_link( '%link', '<span class="meta-nav">&larr;</span> %title' ); ?></div>
                                    <div class="nav-next text-right link"><?php next_post_link( '%link', '%title <span class="meta-nav">&rarr;</span>' ); ?></div>
                                </div>
                            </nav><!-- #post-entries -->
                        </div>
                        <?php
                        echo '</div>';


                        wp_reset_query();
                        ?>




            </div>
        </div>
    </div>
    <!-- </section>-->
</div>

<?php include('footer.php'); ?>