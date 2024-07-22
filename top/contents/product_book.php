<?php 
  function product_book($pdo){
    $sql = "SELECT * FROM `product_book` ORDER BY date DESC LIMIT 6";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $fetch_data = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="product-book">
  <div class="wrapper">
    <section class="contents-side-title fade-in">
      <div class="text">
        <h2><span>NEW</span><span>PRODUCT</span></h2>
        <p>新着商品</p>
      </div>
    </section>
    <section class="show-product fade-in">
      <div class="product-wrapper slide">
        <?php foreach($fetch_data as $row): ?>
        <div class="product-slide">
          <section class="image">
            <div class="image-box">
              <a href="<?php echo $row["product_url"]; ?>" target="_blank" rel="noopener noreferrer"><img
                  src="<?php echo $row["image_url"]; ?>"  loading="lazy" alt="<?php echo $row["title"]; ?>" /></a>
            </div>
            <div class="cite">
              <a href="<?php echo $row["product_url"]; ?>" target="_blank" rel="noopener noreferrer">Amazonより</a>
            </div>
          </section>
        </div>
        <?php endforeach; ?>
      </div>
      <div class="info-wrapper">
        <?php foreach($fetch_data as $row): ?>
        <section class="info">
          <div class="title">
            <h3><?php echo $row["title"]; ?></h3>
          </div>
          <div class="release-date">
            <p>発売日：<?php echo date('Y年m月d日', strtotime($row["date"]));  ?></p>
          </div>
          <div class="price">
            <p>￥1,210</p>
          </div>
          <blockquote class="description">
            <p><?php echo $row["description"]; ?></p>
            <cite><a href="<?php echo $row["cite_url"]; ?>" target="_blank"
                rel="noopener noreferrer"><?php echo $row["cite"]; ?>より</a></cite>
          </blockquote>
          <div class="product-link">
            <a href="<?php echo $row["product_url"]; ?>" target="_blank" rel="noopener noreferrer">
              <p>購入する</p>
            </a>
          </div>
        </section>
        <?php endforeach; ?>
      </div>
    </section>
  </div>
</div>
<?php } ?>