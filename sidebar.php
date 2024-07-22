<?php 
include_once __DIR__ . '/db/pdo.php';
function sidebar(){
    
  $connect = new Connect();
  
  $pdo = $connect -> connect_data();
?>
<aside>
  <div class="side-wrapper">
    <section class="category">
      <section class="title">
        <p>カテゴリー<span>category</span></p>
      </section>
      <section class="list">
        <ul>
          <?php 
            $sql = "SELECT * FROM category";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $fetch_data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach($fetch_data as $row):
          ?>
          <li>
            <button class="add-params" name="category"
              value="<?php echo $row["category_name"]; ?>"><?php echo $row["category_name"]; ?></button>
          </li>
          <?php endforeach; ?>
        </ul>
      </section>
    </section>
    <section class="member">
      <section class="title">
        <p>メンバー<span>member</span></p>
      </section>
      <section class="list">
        <ul>
          <?php 
            $sql = "SELECT * FROM member";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $fetch_data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach($fetch_data as $row):
          ?>
          <li>
            <button class="add-params" name="member"
              value="<?php echo $row["id"]; ?>"><?php echo $row["member_name"]; ?></button>
          </li>
          <?php endforeach; ?>
        </ul>
      </section>
    </section>
    <section class="tags">
      <section class="title">
        <p>タグ<span>tags</span></p>
      </section>
      <section class="list">
        <ul>
          <?php 
            $sql = "SELECT * FROM tag";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $fetch_data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach($fetch_data as $row):
          ?>
          <li>
            <button class="add-params" name="tag" value="<?php echo $row["tag_name"]; ?>">
              <p>#<?php echo $row["tag_name"]; ?></p>
            </button>
          </li>
          <?php endforeach; ?>
        </ul>
      </section>
    </section>
  </div>
</aside>
<?php 
}
?>