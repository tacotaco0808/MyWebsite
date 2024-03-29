<?php //投稿ページ
?>
<div class="anchor base-backcolor">
    <?php get_header(); ?>
    <div class="figure-viewer">
        <img id="figure-viewer-zoom" src="" alt="">
    </div>
    <main>
        <?php if (have_posts()) : ?>
            <article>
                <div>
                    <figure class="figure-area chalk-font">
                        <div class="figure-title">
                            <h1><?php the_title(); ?></h1>
                        </div>
                        <div id="figure-img">
                            <?php the_post_thumbnail(); ?>
                        </div>
                        <div class="figure-caption">
                            <?php the_content(); ?>
                            <time datetime="<?php echo esc_attr(get_the_date(DATE_W3C)); ?>">
                                <?php echo esc_html(get_the_date()); ?>
                            </time>
                        </div>

                    </figure>


                </div>

                <!--イラストのミニスライド-->
                <?php
                //関数化できそうだったらthe_page_IDを引数にして関数化しとく
                $the_page_ID = get_the_ID(); //表示しているページのIDを取得
                $args = array( //この中で条件を書く
                    'category_name' => 'illust',
                    'posts_per_page' => 100 // 表示件数

                );
                $posts = get_posts($args);
                ?>
                <div class="minislide-container">
                    <?php foreach ($posts as $post) : // ループの開始
                        setup_postdata($post); // 記事データの取得
                    ?>
                        <?php if (has_post_thumbnail() and (get_the_ID() != $the_page_ID)) : //他ページのサムネイルを表示 
                        ?>
                            <div>
                                <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
                            </div>
                        <?php else : //表示しているページのサムネは選択できない
                        ?>
                            <div class="minislide-selected"><?php the_post_thumbnail(); ?></div>
                        <?php endif; ?>
                    <?php endforeach; // ループの終了
                    ?>
                    <?php wp_reset_postdata(); ?>
                </div>

            </article>
        <?php endif; ?>
    </main>

    <?php get_footer(); ?>
</div>