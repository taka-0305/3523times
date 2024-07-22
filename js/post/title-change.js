function titleChange() {
  var ogSiteName = document.querySelector('meta[property="og:site_name"]');
  // メタタグが存在するか確認し、存在する場合はその内容を取得
  var siteNameContent = ogSiteName ? ogSiteName.getAttribute('content') : null;

  var currentURL = window.location.href;

  // URLのクエリ文字列部分を取得
  var queryString = currentURL.split('?')[1];
  
  // クエリ文字列が存在し、かつその中に=（イコール）が含まれている場合、パラメータが存在するとみなす
  if (queryString && queryString.includes('=')) {
    const h1Element = document.querySelector('h1');
    var title = h1Element.innerText;
    // タイトルタグを変更
    document.title = title+"の記事一覧 | "+siteNameContent;
  } else {
    document.title = "記事一覧 | "+siteNameContent;
  }
}

titleChange();