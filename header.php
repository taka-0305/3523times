<?php //session_start(); ?>
<!DOCTYPE html>
<html lang="jp">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?php wp_title( '|', true, 'right' ); ?></title>

  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/destyle.css" />
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/header.min.css" />
  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script src="<?php echo get_template_directory_uri(); ?>/js/imagesloaded.pkgd.min.js"></script>
  <script src="<?php echo get_template_directory_uri(); ?>/js/load.min.js"></script>
  <script src="<?php echo get_template_directory_uri(); ?>/js/top/menu-nav.min.js"></script>
  
  <?php if (is_home()) : ?>
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/top/style.min.css" />
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/top/original.min.css" />
  <script src="<?php echo get_template_directory_uri(); ?>/js/top/thumbnail-slider.min.js"></script>
  <script src="<?php echo get_template_directory_uri(); ?>/js/top/contents-height.min.js"></script>
  <script src="<?php echo get_template_directory_uri(); ?>/js/top/scroll-x.min.js"></script>
  <script src="<?php echo get_template_directory_uri(); ?>/js/top/fade-in.min.js"></script>
  <?php endif; ?>

  <?php if ( is_page('post') ): ?>
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/post/post.min.css" />
  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script src="<?php echo get_template_directory_uri(); ?>/js/post/params.min.js"></script>
  <?php endif; ?>

  <?php if(is_single()): ?>
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/article/article.min.css" />
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/top/original.min.css" />
  <?php endif; ?>

  <?php if (is_404()): ?>
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/404.min.css" />
  <?php endif; ?>

  <script src="<?php echo get_template_directory_uri(); ?>/js/top/header.min.js"></script>

  <?php wp_head(); ?>
</head>

<body>
  <div id="container">
    <section id="loading">
      <div>
        <svg id="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 942.79 301.6">
          <defs>
            <style>
            .cls-1 {
              fill: #cc2c29;
            }

            .cls-1,
            .cls-2 {
              stroke-width: 0px;
            }

            .cls-2 {
              fill: #6e3d99;
            }
            </style>
          </defs>
          <g id="icon-svg">
            <path class="cls-2"
              d="m0,260l32.8-44.8c18,16.8,38.8,28.8,62,28.8,27.6,0,45.6-11.2,45.6-32,0-24.4-13.6-38.8-76-38.8v-50.4c50.8,0,66.8-15.2,66.8-36.8,0-19.6-12-30.4-34-30.4-20,0-35.2,9.2-53.2,25.2L8,37.2C35.6,14.4,65.2,0,100.4,0c61.6,0,102,29.2,102,80.4,0,29.2-16.4,50.8-47.6,64v2c32.8,9.6,57.2,33.2,57.2,70.4,0,54.4-50.8,84.8-110,84.8-47.2,0-80.4-16.4-102-41.6Z" />
            <path class="cls-2"
              d="m244,260.4l32.4-44.8c16.8,16,37.6,28.4,61.2,28.4,28.8,0,46.8-14.4,46.8-42.4s-18-42.8-43.6-42.8c-16.4,0-24.4,3.6-42,14.8l-31.2-20.4,7.6-147.6h167.2v59.6h-106l-4.4,50.4c10.8-4.4,19.6-6,30.8-6,50.4,0,92.8,28.4,92.8,90s-50.4,102-107.6,102c-47.6,0-80.4-18-104-41.2Z" />
            <path class="cls-1"
              d="m494.4,255.2c72-67.2,124.4-116.8,124.4-157.6,0-27.6-14.8-42-38.8-42-20.4,0-36,14.4-50.4,28.8l-38.8-38.4C519.99,15.2,547.19,0,589.59,0c57.6,0,97.6,36.8,97.6,93.6,0,48.4-45.2,100-90,146.4,14.8-2,35.2-4,48.8-4h54.8v60h-206.4v-40.8Z" />
            <path class="cls-1"
              d="m730.79,260l32.8-44.8c18,16.8,38.8,28.8,62,28.8,27.6,0,45.6-11.2,45.6-32,0-24.4-13.6-38.8-76-38.8v-50.4c50.8,0,66.8-15.2,66.8-36.8,0-19.6-12-30.4-34-30.4-20,0-35.2,9.2-53.2,25.2l-36-43.6C766.39,14.4,795.99,0,831.19,0c61.6,0,102,29.2,102,80.4,0,29.2-16.4,50.8-47.6,64v2c32.8,9.6,57.2,33.2,57.2,70.4,0,54.4-50.8,84.8-110,84.8-47.2,0-80.4-16.4-102-41.6Z" />
          </g>
        </svg>
      </div>
    </section>
    <header>
      <div class="header-wrapper">
        <section class="icon">
          <a href="<?php echo home_url(); ?>" class="icon-box">
            <svg id="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 942.79 301.6">
              <defs>
                <style>
                .cls-1 {
                  fill: #cc2c29;
                }

                .cls-1,
                .cls-2 {
                  stroke-width: 0px;
                }

                .cls-2 {
                  fill: #6e3d99;
                }
                </style>
              </defs>
              <g id="icon-svg">
                <path class="cls-2"
                  d="m0,260l32.8-44.8c18,16.8,38.8,28.8,62,28.8,27.6,0,45.6-11.2,45.6-32,0-24.4-13.6-38.8-76-38.8v-50.4c50.8,0,66.8-15.2,66.8-36.8,0-19.6-12-30.4-34-30.4-20,0-35.2,9.2-53.2,25.2L8,37.2C35.6,14.4,65.2,0,100.4,0c61.6,0,102,29.2,102,80.4,0,29.2-16.4,50.8-47.6,64v2c32.8,9.6,57.2,33.2,57.2,70.4,0,54.4-50.8,84.8-110,84.8-47.2,0-80.4-16.4-102-41.6Z" />
                <path class="cls-2"
                  d="m244,260.4l32.4-44.8c16.8,16,37.6,28.4,61.2,28.4,28.8,0,46.8-14.4,46.8-42.4s-18-42.8-43.6-42.8c-16.4,0-24.4,3.6-42,14.8l-31.2-20.4,7.6-147.6h167.2v59.6h-106l-4.4,50.4c10.8-4.4,19.6-6,30.8-6,50.4,0,92.8,28.4,92.8,90s-50.4,102-107.6,102c-47.6,0-80.4-18-104-41.2Z" />
                <path class="cls-1"
                  d="m494.4,255.2c72-67.2,124.4-116.8,124.4-157.6,0-27.6-14.8-42-38.8-42-20.4,0-36,14.4-50.4,28.8l-38.8-38.4C519.99,15.2,547.19,0,589.59,0c57.6,0,97.6,36.8,97.6,93.6,0,48.4-45.2,100-90,146.4,14.8-2,35.2-4,48.8-4h54.8v60h-206.4v-40.8Z" />
                <path class="cls-1"
                  d="m730.79,260l32.8-44.8c18,16.8,38.8,28.8,62,28.8,27.6,0,45.6-11.2,45.6-32,0-24.4-13.6-38.8-76-38.8v-50.4c50.8,0,66.8-15.2,66.8-36.8,0-19.6-12-30.4-34-30.4-20,0-35.2,9.2-53.2,25.2l-36-43.6C766.39,14.4,795.99,0,831.19,0c61.6,0,102,29.2,102,80.4,0,29.2-16.4,50.8-47.6,64v2c32.8,9.6,57.2,33.2,57.2,70.4,0,54.4-50.8,84.8-110,84.8-47.2,0-80.4-16.4-102-41.6Z" />
              </g>
            </svg>
          </a>
        </section>
        <nav>
          <ul class="nav-ul">
            <li class="left">
              <ul class="inner-nav">
                <li>
                  <a href="<?php echo home_url()."/post/"; ?>">
                    <p>新着記事</p>
                  </a>
                </li>
                <li>
                  <a href="<?php echo home_url( '/' );?>/post/?member=1">
                    <p>鈴木絢音<span>さんの記事</span></p>
                  </a>
                </li>
                <li>
                  <a href="<?php echo home_url( '/' );?>/post/?member=2">
                    <p>弓木奈於<span>さんの記事</span></p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="right">
              <ul class="inner-nav">
                <li>
                <li>
                  <a href="https://suzuki-ayanet.com/" target="_blank">
                    <p><span>FANSITE</span>あやねっと</p>
                  </a>
                </li>
                <li>
                  <a href="https://nao-welina.com/" target="_blank">
                    <p><span>FANSITE</span>Welina</p>
                  </a>
                </li>
                <li>
                  <a href="https://twitter.com/3523times">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                      <path
                        d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z" />
                    </svg>
                  </a>
                </li>
            </li>
          </ul>
          </li>
          </ul>
        </nav>
        <section class="header-menu">
          <div class="menu-btn"><span></span></div>
        </section>
      </div>
      <section class="header-nav">
        <div class="nav-box">
          <div>
            <a href="<?php echo home_url( '/' );?>">TOP</a>
          </div>
          <div>
            <a href="<?php echo home_url()."/post/"; ?>">新着記事</a>
          </div>
          <div>
            <a href="<?php echo home_url( '/' );?>/post/?member=1">鈴木絢音さん</a>
          </div>
          <div>
            <a href="<?php echo home_url( '/' );?>/post/?member=2">弓木奈於さん</a>
          </div>
          <div>
            <a href="https://twitter.com/3523times">Twitter</a>
          </div>
        </div>
      </section>
    </header>