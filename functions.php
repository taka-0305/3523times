<?php

function my_meta_ogp() {
if( is_front_page() || is_home() || is_singular() ){
global $post;
$ogp_title = '';
$ogp_descr = '';
$ogp_url = '';
$ogp_img = '';
$insert = '';

if( is_singular() ) {
//記事＆固定ページ
setup_postdata($post);
$ogp_title = $post->post_title;
$ogp_descr = mb_substr(get_the_excerpt(), 0, 100);
$ogp_url = get_permalink();
wp_reset_postdata();
}elseif ( is_front_page() || is_home() ) {
//トップページ
$ogp_title = get_bloginfo('name');
$ogp_descr = get_bloginfo('description');
$ogp_url = home_url();
}

//og:type
$ogp_type = ( is_front_page() || is_home() ) ? 'website' : 'article';

//og:image
if ( is_singular() && has_post_thumbnail() ) {
$ps_thumb = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
$ogp_img = $ps_thumb[0];
$insert .= '
<meta property="og:title" content="'.esc_attr($ogp_title).'" />' . "\n";
$insert .= '
<meta property="og:description" content="'.esc_attr($ogp_descr).'" />' . "\n";
$insert .= '
<meta property="og:type" content="'.$ogp_type.'" />' . "\n";
$insert .= '
<meta property="og:url" content="'.esc_url($ogp_url).'" />' . "\n";
$insert .= '
<meta property="og:image" content="'.esc_url($ogp_img).'" />' . "\n";
$insert .= '
<meta property="og:site_name" content="'.esc_attr(get_bloginfo('name')).'" />' . "\n";
$insert .= '
<meta name="twitter:card" content="summary_large_image" />' . "\n";
$insert .= '
<meta name="twitter:site" content="@ayanet05368" />' . "\n";
$insert .= '
<meta property="og:locale" content="ja_JP" />' . "\n";
echo $insert;
}else{
$ogp_img = get_template_directory_uri()."/img/ogp.webp";
$insert .= '
<meta property="og:image" content="'.esc_url($ogp_img).'" />' . "\n";
$insert .= '
<meta name="twitter:card" content="summary_large_image" />' . "\n";
$insert .= '
<meta name="twitter:site" content="@ayanet05368" />' . "\n";
echo $insert;
}
}
} //END my_meta_ogp


add_action('wp_head','my_meta_ogp');//headにOGPを出力

// 目次
function add_index($content)
{
  if (is_single()) {
    $pattern = '/<(h[2-3])(?:\s+class="([^"]*)")?>(.*?)<\/\1>/s';
    preg_match_all($pattern, $content, $elements, PREG_SET_ORDER);
    if (count($elements) >= 1) {
      $toc          = '';
      $i            = 0;
      $currentlevel = 0;
      $id           = 'chapter-';
      foreach ($elements as $element) {
        $id           .= $i + 1;
        $regex         = '/' . preg_quote($element[0], '/') . '/su';
        $replace_title = preg_replace('/<(h[1-6])>(.+?)<\/(h[1-6])>/s', '<$1 id="' . $id . '">$2</$3>', $element[0], 1);
        $content       = preg_replace($regex, $replace_title, $content, 1);
        if (strpos($element[0], '<h2') !== false) {
          $level = 1;
        } elseif (strpos($element[0], '<h3') !== false) {
          $level = 2;
        } elseif (strpos($element[0], '<h4') !== false) {
          $level = 3;
        } elseif (strpos($element[0], '<h5') !== false) {
          $level = 4;
        } elseif (strpos($element[0], '<h6') !== false) {
          $level = 5;
        }
        while ($currentlevel < $level) {
          if (0 === $currentlevel) {
            $toc .= '<ol class="index__list">';
          } else {
            $toc .= '<ol class="index__list_child">';
          }
          $currentlevel++;
        }
        while ($currentlevel > $level) {
          $toc .= '</li></ol>';
          $currentlevel--;
        }
        // 目次の項目で使用する要素を指定
        $toc .= '<li class="index__item"><a href="#' . $id . '" class="index__link">' . $element[3] . '</a>';
        $i++;
        $id = 'chapter-';
      } // foreach
      // 目次の最後の項目をどの要素から作成したかによりタグの閉じ方を変更
      while ($currentlevel > 0) {
        $toc .= '</li></ol>';
        $currentlevel--;
      }
      $index = '<div class="single__index index" id="toc"><div class="index__title">目次</div>' . $toc . '</div>';
      $h2    = '/<h2.*?>/i';
if (preg_match($h2, $content, $h2s)) {
$content = preg_replace($h2, $index . $h2s[0], $content, 1);
}
}
}
return $content;
}
add_filter('the_content', 'add_index');

function setup_theme() {
  add_theme_support('post-thumbnails');
}
add_action('after_setup_theme', 'setup_theme');
            ?>