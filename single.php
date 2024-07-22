<?php
/*
Template Name: single
*/
?>



<?php get_header(); ?>
<main>
  <!-- main -->
  <div class="article-wrapper">
    <?php if(have_posts()) : while(have_posts()) : the_post(); ?>
    <article>
      <section class="article-title">
        <h1><?php the_title(); ?></h1>
      </section>
      <section class="article-date">
        <p><?php the_date(); ?></p>
      </section>
      <seciton class="context">
        <?php the_content(); ?>
      </seciton>
      <?php endwhile; else: ?>
      <p>
        記事が削除された可能性があります。
      </p>
      <?php endif; ?>
      <!-- ▲表示する記事がある場合、ループ開始▲ -->
      <!-- ▼前か次のページが存在する場合のみ表示する▼ -->
      <?php if( get_previous_post(true) || get_next_post(true) ){ ?>
      <!-- ページャー -->
      <div class="prev">
        <?php if( get_previous_post() ): ?>
        <div class="color1 prev">
          <?php previous_post_link('%link', '← %title' , 'ture'); ?>
        </div>
        <?php endif; if( get_next_post() ): ?>
        <div class="color1 next">
          <?php next_post_link('%link', '%title →' , 'ture'); ?>
        </div>
        <?php endif; ?>
      </div>
      <!-- /ページャー -->
      <?php } ?>
      <!-- ▲前か次のページが存在する場合のみ表示する▲ -->
      <?php 
      get_template_part('db/pdo');
      $connect = new Connect();
      $pdo = $connect -> connect_data();
      include_once __DIR__ . '/top/contents/original.php';
      ?>
      <?php original($pdo); ?>
    </article>
  </div>
  <!-- /main -->
</main>
<?php get_footer(); ?>