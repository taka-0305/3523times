<?php
/*
Template Name: 404
*/
?>


<?php get_header(); ?>
<main>
  <section>
    <h1>404 Not Found（ページが見つかりませんでした）</h1>
    <p>指定されたページは存在しないか、または移動した可能性があります。</p>
    <div class="button">
      <a href="<?php echo home_url(); ?>">トップページへ</a>
    </div>
  </section>
</main>
<?php get_footer(); ?>