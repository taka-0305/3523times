<?php
/*
Template Name: post
 */
?>
<?php get_header(); ?>
<?php 
  include_once __DIR__ . '/post/index.php';
  include_once __DIR__ . '/sidebar.php';
  
  $get_data = new GetData();
  $pickup = "";
  if(!empty($_GET['pickup'])){
    $pickup = $_GET['pickup'];
    $get_data->getPickup();
  }else{
    $get_data->getData();
  }
?>
<main>
  <section id="contents">
    <section class="page-title">
      <h2>記事一覧</h2>
      <section class="image">
        <div class="image-box">
          <img src="<?php echo get_template_directory_uri();?>/img/post/title-banner.webp" alt="タイトルバナー">
        </div>
      </section>
    </section>
    <div class="column">
      <section class="post-list">
        <div class="post-list-wrapper">
          <section class="label-block">
            <?php foreach($get_data->button_array as $row){
              echo $row;
            }?>
            <?php if(!empty($get_data->button_array)): ?>
            <button class="delete-all">すべて解除する</button>
            <?php endif; ?>
          </section>
          <?php if(empty($pickup)): ?>
          <section class="sort">
            <div class="sort-wrapper">
              <section class="sort-title">
                <p>並べ替え</p>
              </section>
              <section class="sort-button">
                <select name="sort" id="sort">
                  <option value="1">新着順</option>
                  <option value="2">古い順</option>
                </select>
              </section>
            </div>
          </section>
          <?php endif; ?>
          <section class="post-list">
            <section class="post-list-title">
              <h1><?php echo $get_data->title; ?></h1>
            </section>
            <?php if(empty($get_data->data)):?>
            <p class="no-data">条件に合う記事はありませんでした。</p>
            <?php endif;?>
            <ul>
              <?php 
              foreach($get_data->data as $row):
              ?>
              <li>
                <div class="thumbnail">
                  <a href="">
                    <img
                      src="<?php echo get_template_directory_uri() . "/img/top/lib/" . $row['image_name'].".webp"; ?>" loading="lazy"
                      alt="<?php echo $row["title"]; ?>" />
                  </a>
                </div>
                <div class="text-wrap">
                  <section class="title">
                    <a href="<?php echo $row["url"]; ?>" target="_blank" rel="noopener noreferrer">
                      <h3><?php echo $row["title"]; ?></h3>
                    </a>
                  </section>
                  <section class="source">
                    <p><?php echo $row["source_name"]; ?></p>
                  </section>
                  <section class="date">
                    <p><?php echo date('Y.m.d', strtotime($row["date"]));  ?></p>
                  </section>
                </div>
              </li>
              <?php endforeach; ?>
            </ul>
          </section>
          <section class="paging-wrapper">
            <?php echo $get_data->paging_html; ?>
          </section>
        </div>
      </section>
      <?php sidebar(); ?>
    </div>
  </section>
</main>
<section class="scroll-to-top">
  <a href="#"><svg clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2"
      viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
      <path
        d="m16.843 13.789c.108.141.157.3.157.456 0 .389-.306.755-.749.755h-8.501c-.445 0-.75-.367-.75-.755 0-.157.05-.316.159-.457 1.203-1.554 3.252-4.199 4.258-5.498.142-.184.36-.29.592-.29.23 0 .449.107.591.291 1.002 1.299 3.044 3.945 4.243 5.498z" />
    </svg>
  </a>
</section>
<script src="<?php echo get_template_directory_uri(); ?>/js/post/title-change.js"></script>
<?php get_footer(); ?>