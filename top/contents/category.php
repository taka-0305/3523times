<?php 
  function category_title($pdo,$category_array){
?>
<div class="category">
  <div class="wrapper">
    <section class="contents-title fade-in">
      <div class="text">
        <h2>CATEGORY</h2>
        <p>カテゴリー</p>
      </div>
    </section>
    <?php 
    foreach($category_array as $arr){
      $sql = "SELECT m.*,c.category_name,i.image_name,s.source_name FROM main m LEFT OUTER JOIN image i ON m.image_id = i.id LEFT OUTER JOIN source s ON m.source_id = s.id LEFT OUTER JOIN category c on m.category_id = c.id WHERE c.category_name = :category_name ORDER BY m.date DESC LIMIT 9";
      $stmt = $pdo->prepare($sql);
      $stmt->bindValue(':category_name', $arr, PDO::PARAM_STR);
      $stmt->execute();
      $fetch_data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>
    <section class="article-list ">
      <div class="article-list-wrapper">
        <section class="list">
          <div class="category-title fade-in">
            <h3><?php echo $arr; ?></h3>
          </div>
          <ul class="article-wrap-js">
            <?php foreach($fetch_data as $row):?>
            <li class="fade-in">
              <section class="image">
                <img src="<?php echo get_template_directory_uri() . "/img/top/lib/" . $row['image_name'].".webp"; ?>" loading="lazy"
                  alt="<?php echo $row['title'];?>" />
              </section>
              <section class="text">
                <div class="title">
                  <a href="<?php echo $row['url'];?>" target="_blank" rel="noopener noreferrer">
                    <p><?php echo $row['title'];?></p>
                  </a>
                </div>
                <div class="source">
                  <p><?php echo $row['source_name'];?></p>
                </div>
              </section>
            </li>
            <?php endforeach; ?>
          </ul>
          <div class="link fade-in">
            <a href="<?php echo home_url()."/post?category=".$arr; ?>">
              <p>MORE</p>
              <svg clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2"
                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path
                  d="m10.211 7.155c-.141-.108-.3-.157-.456-.157-.389 0-.755.306-.755.749v8.501c0 .445.367.75.755.75.157 0 .316-.05.457-.159 1.554-1.203 4.199-3.252 5.498-4.258.184-.142.29-.36.29-.592 0-.23-.107-.449-.291-.591-1.299-1.002-3.945-3.044-5.498-4.243z" />
              </svg>
            </a>
          </div>
        </section>
      </div>
    </section>
    <?php } ?>
  </div>
</div>
<?php } ?>