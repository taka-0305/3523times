<?php 
  function original($pdo){
?>
<div class="original">
  <?php if(is_single()): ?>
  <div class="wrapper is-single">
  <?php else: ?>
  <div class="wrapper">
  <?php endif; ?>
  <?php if(!is_single()): ?>
    <section class="contents-title fade-in">
      <div class="text">
        <h2>original</h2>
        <p>管理人の記事</p>
      </div>
    </section>
  <?php endif; ?>
    <section class="article">
      <div class="article-wrapper">
        <?php 
          $sql = "SELECT * FROM `original` ORDER BY date DESC LIMIT 1;";
          $stmt = $pdo->prepare($sql);
          $stmt->execute();
          $fetch_data = $stmt->fetchAll(PDO::FETCH_ASSOC);
          foreach($fetch_data as $row): 
        ?>
        <section class="top-article fade-in">
          <div class="top-article-wrapper">
            <section class="image">
              <img src="<?php echo get_template_directory_uri().$row["img_url"]; ?>" loading="lazy" alt="<?php echo $row["title"]; ?>" />
            </section>
            <section class="text">
              <div class="title">
                <a href="<?php echo $row["url"]; ?>">
                  <h3><?php echo $row["title"]; ?></h3>
                </a>
              </div>
              <div class="description">
                <p><?php echo $row["description"]; ?></p>
              </div>
              <div class="date">
                <p><?php echo date('Y.m.d', strtotime($row["date"]));  ?></p>
              </div>
            </section>
          </div>
        </section>
        <?php endforeach; ?>
        <section class="article-list">
          <ul>
            <?php 
          $sql = "SELECT * FROM `original` ORDER BY date DESC LIMIT 1,5;";
          $stmt = $pdo->prepare($sql);
          $stmt->execute();
          $fetch_data = $stmt->fetchAll(PDO::FETCH_ASSOC);
          foreach($fetch_data as $row): 
        ?>
            <li class="fade-in">
              <div class="title">
                <a href="<?php echo $row["url"]; ?>">
                  <p><?php echo $row["title"]; ?></p>
                </a>
              </div>
              <div class="description">
                <p><?php echo $row["description"]; ?></p>
              </div>
            </li>
            <?php endforeach; ?>
          </ul>
        </section>
      </div>
    </section>
  </div>
</div>
<?php } ?>