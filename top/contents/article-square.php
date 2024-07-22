<?php 
  function show_article_square($pdo,$title,$sub_title,$sql){
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $fetch_data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>
<div class="new-contents">
  <div class="wrapper">
    <section class="contents-title fade-in">
      <div class="text">
        <h2><?php echo $title; ?></h2>
        <p><?php echo $sub_title; ?></p>
      </div>
      <div class="border"></div>
    </section>
    <section class="article">
      <?php 
        foreach($fetch_data as $row):
      ?>
      <div class="article-box fade-in">
        <section class="article-thumbnail">
          <img src="<?php echo get_template_directory_uri() . "/img/top/lib/" . $row['image_name'].".webp"; ?>"
            alt="イメージ画像" loading="lazy" />
          <section class="article-category">
            <a href="<?php echo $row['url'] ?>" target="_blank" rel="noopener noreferrer">
              <p><?php echo $row['category_name'] ?></p>
            </a>
          </section>
        </section>
        <section class="article-description">
          <section class="article-title">
            <a href="<?php echo $row['url'] ?>" target="_blank" rel="noopener noreferrer">
              <h3><?php echo $row['title'] ?></h3>
            </a>
          </section>
          <section class="article-source">
            <p><?php echo $row['source_name'] ?></p>
          </section>
          <section class="article-date">
            <p><?php echo date('Y.m.d', strtotime($row["date"]));  ?></p>
          </section>
          <!-- <section class="article-tag">
            <a href="http://" target="_blank" rel="noopener noreferrer">
              <p>#other</p>
            </a>
          </section> -->
        </section>
      </div>
      <?php endforeach; ?>
    </section>
    <section class="contents-link-circle fade-in">
      <a href="<?php echo home_url()."/post/"; ?>">
        <p>more</p>
      </a>
    </section>
  </div>
</div>
<?php 
} 
?>