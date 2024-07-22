<?php 
function loadEnv($path) {
  if (!file_exists($path)) {
      throw new Exception("The .env file does not exist.");
  }

  $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
  foreach ($lines as $line) {
      // コメント行をスキップ
      if (strpos(trim($line), '#') === 0) {
          continue;
      }

      // 'KEY=VALUE'形式の行をパース
      list($name, $value) = explode('=', $line, 2);
      $name = trim($name);
      $value = trim($value);

      // 環境変数を設定
      putenv("$name=$value");
      $_ENV[$name] = $value;
      $_SERVER[$name] = $value;
  }
}
?>