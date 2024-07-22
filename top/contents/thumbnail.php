<?php 
  function thumbnail($pdo){
    $sql = "SELECT m.*,i.image_name,s.source_name FROM main m LEFT OUTER JOIN image i ON m.image_id = i.id LEFT OUTER JOIN source s ON m.source_id = s.id WHERE m.id IN (SELECT main_id FROM (SELECT main_id FROM top t ORDER BY t.id DESC LIMIT 6) AS foo) ORDER BY date DESC;";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $fetch_data = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<section class="thumbnail">
  <div class="slider">
    <div class="slider-wrapper slide">
      <?php 
        foreach($fetch_data as $row):
      ?>
      <section class="slide-image">
        <div class="slide-image-wrapper">
          <a href="<?php echo $row['url'] ?>" target="_blank" rel="noopener noreferrer">
            <div class="image-box">
              <img src="<?php echo get_template_directory_uri() . "/img/top/lib/" . $row['image_name'].".webp"; ?>"
                alt="イメージ画像" />
            </div>
            <div class="text slide-text">
              <div class="text-wrapper">
                <section class="description">
                  <div class="title">
                    <h3 class="js-textTrim"><?php echo $row['title'] ?></h3>
                  </div>
                  <div class="source">
                    <p class="js-textTrim"><?php echo $row['source_name'] ?></p>
                  </div>
                </section>
              </div>
            </div>
          </a>
        </div>
        <div class="circle">
          <div class="circle-wrapper">
            <div class="inside-image">
              <svg viewbox="0 0 100 100" xmlns="http://www.w3.org/2000/svg" version="1.1">
                <path d="M 1 50 a 49 49 0 1 1 98 0" fill="transparent" stroke="white" stroke-width="2" />
              </svg>
              <?php if($row['member_id'] == 1): ?>
              <a href="https://suzuki-ayanet.com/" target="_blank" rel="noopener noreferrer"><img
                  src="<?php echo get_template_directory_uri(); ?>/img/top/ayane-profile.webp" alt="鈴木絢音さんの写真" />
              </a>
              <?php elseif($row['member_id'] == 2):?>
              <a href="https://nao-welina.com/" target="_blank" rel="noopener noreferrer"><img
                  src="<?php echo get_template_directory_uri(); ?>/img/top/profile-nao.webp" alt="弓木奈於さんの写真" /></a>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </section>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php 
  }
  ?>