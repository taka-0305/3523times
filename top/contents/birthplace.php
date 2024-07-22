<?php 
  function birthplace($pdo){
    $sql = "SELECT * FROM `birthplace`";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $fetch_data = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="birthplace">
  <div class="wrapper">
    <section class="contents-title fade-in">
      <div class="text">
        <h2>birthplace</h2>
        <p>出身地の紹介</p>
      </div>
    </section>
    <section class="place-list">
      <div class="place-list-wrapper">
        <?php 
        foreach($fetch_data as $row):
      ?>
        <section class="contents">
          <div class="contents-wrapper">
            <section class="pin fade-in">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                <path
                  d="M12 0c-4.198 0-8 3.403-8 7.602 0 6.243 6.377 6.903 8 16.398 1.623-9.495 8-10.155 8-16.398 0-4.199-3.801-7.602-8-7.602zm0 11c-1.657 0-3-1.343-3-3s1.342-3 3-3 3 1.343 3 3-1.343 3-3 3z" />
              </svg>
              <?php if($row['member_id'] == 1): ?>
              <p>AKITA</p>
              <?php elseif($row['member_id'] == 2): ?>
              <p>KYOTO</p>
              <?php endif; ?>
            </section>
            <section class="image fade-in">
              <img src="<?php echo get_template_directory_uri() . "/img/top/" . $row['img_file_name']; ?>" loading="lazy" alt="" />
              <?php if($row['member_id'] == 1): ?>
              <p>秋田県 夜空に映える黄金色の稲穂 ©mko294、クリエイティブ・コモンズ・ライセンス【表示4.0 国際】</p>
              <?php endif; ?>
            </section>
            <section class="text">
              <div class="description fade-in">
                <p><?php echo $row['description']; ?></p>
              </div>
              <div class="link-original-contents">
                <section class="title fade-in">
                  <?php if($row['member_id'] == 1): ?>
                  <h3>FANSITE「あやねっと」のコンテンツ</h3>
                  <?php elseif($row['member_id'] == 2): ?>
                  <h3>FANSITE「Welina」のコンテンツ</h3>
                  <?php endif; ?>
                </section>
                <section class="link-text fade-in">
                  <a href="<?php echo $row['contents_url']; ?>" target="_blank"
                    rel="noopener noreferrer"><?php echo $row['contents']; ?>
                    <svg width="24" height="24" stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                      xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="m6 18h-3c-.48 0-1-.379-1-1v-14c0-.481.38-1 1-1h14c.621 0 1 .522 1 1v3h3c.621 0 1 .522 1 1v14c0 .621-.522 1-1 1h-14c-.48 0-1-.379-1-1zm1.5-10.5v13h13v-13zm7.869 2.5s-2.136.002-4.616.003c-.414 0-.75.336-.75.75-.001 2.479-.003 4.612-.003 4.612 0 .41.335.745.75.745.414 0 .75-.334.75-.745v-2.804l4.439 4.439c.293.293.768.293 1.061 0s.293-.768 0-1.061l-4.439-4.439h2.808c.409 0 .741-.336.741-.75s-.333-.75-.741-.75zm1.131-4v-2.5h-13v13h2.5v-9.5c0-.481.38-1 1-1z"
                        fill-rule="nonzero" />
                    </svg>
                  </a>
                </section>
              </div>
              <div class="link">
                <section class="title fade-in">
                  <?php if($row['member_id'] == 1): ?>
                  <h3>鈴木絢音さん×秋田県</h3>
                  <?php elseif($row['member_id'] == 2): ?>
                  <h3>弓木奈於さん×京都府</h3>
                  <?php endif; ?>
                </section>
                <ul>
                  <?php
                      $sql_n = "SELECT * FROM place_news WHERE member_id = :member_id ORDER BY date DESC";
                      $stmt_n = $pdo->prepare($sql_n);
                      $stmt_n->bindValue(":member_id", $row['member_id']);
                      $stmt_n->execute();
                      $fetch_data_n = $stmt_n->fetchAll(PDO::FETCH_ASSOC);
                      foreach($fetch_data_n as $row_n):
                      ?>
                  <li class="fade-in">
                    <a href="<?php echo $row_n["url"] ?>" target="_blank"
                      rel="noopener noreferrer"><?php echo $row_n["title"] ?><span><?php echo date('Y年m月d日', strtotime($row_n["date"]));  ?></span></a>
                  </li>
                  <?php endforeach; ?>
                </ul>
              </div>
            </section>
          </div>
        </section>
        <?php endforeach; ?>
      </div>
    </section>
  </div>
</div>
<?php 
  }
  ?>