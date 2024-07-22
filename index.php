<?php get_header(); ?>
<?php 
get_template_part('db/pdo');
$connect = new Connect();
$pdo = $connect -> connect_data();
?>
<main>
  <?php 
    include_once __DIR__ . '/top/contents/thumbnail.php';
    include_once __DIR__ . '/top/contents/article-square.php';
    include_once __DIR__ . '/top/contents/article-card.php';
    include_once __DIR__ . '/top/contents/category.php';
    include_once __DIR__ . '/top/contents/product_book.php';
    include_once __DIR__ . '/top/contents/birthplace.php';
    include_once __DIR__ . '/top/contents/original.php';
    thumbnail($pdo);
    ?>
  <section id="contents">
    <?php get_template_part('top/contents/profile');?>
    <?php 
      $title = "What's New";
      $sub_title = "新着記事";
      $sql = "SELECT m.*,c.category_name, i.image_name,s.source_name FROM main m LEFT OUTER JOIN image i ON m.image_id = i.id LEFT OUTER JOIN source s ON m.source_id = s.id LEFT OUTER JOIN category c on m.category_id = c.id ORDER BY m.date DESC LIMIT 3";
      show_article_square($pdo,$title,$sub_title,$sql);
    ?>
    <?php 
      $title = "Pick up";
      $sub_title = "注目の記事";
      $sql = "SELECT m.*,c.category_name, i.image_name,s.source_name FROM main m LEFT OUTER JOIN image i ON m.image_id = i.id LEFT OUTER JOIN source s ON m.source_id = s.id LEFT OUTER JOIN category c on m.category_id = c.id WHERE m.id IN (SELECT main_id FROM (SELECT main_id FROM pickup ORDER BY id DESC LIMIT 3) AS foo) ORDER BY m.date DESC;";
      show_article_card($pdo,$title,$sub_title,$sql);
    ?>
    <?php 
      $category_array = array("media","book","column");
      category_title($pdo,$category_array);
    ?>
    <?php product_book($pdo); ?>
    <?php birthplace($pdo); ?>
    <?php original($pdo); ?>
  </section>
</main>
<?php get_footer(); ?>