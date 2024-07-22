function textTrim() {
  // テキストをトリミングする要素
  var selector = document.getElementsByClassName('js-textTrim');
  
  // 表示したい行数
  var row = 6;
  
  // 文末に追加したい文字
  var clamp = '…';
  
  for (i = 0; i < selector.length; i++) {
    //CSSプロパティを取得
    var style = window.getComputedStyle(selector[i]);
    var fontsize = parseFloat(style.fontSize); //font-sizeを取得
    var width = parseFloat(style.width); //widthを取得
    var letterSpacing = parseFloat(style.letterSpacing); //letter-spacingを取得
    console.log(fontsize)
    // 収まる文字数を計算
    var wordCount = Math.floor(width / fontsize) * row;
  
    // letter-spacingも含めて計算する場合
    var wordCount = Math.floor(width / (fontsize + letterSpacing)) * row;
  
    // 文字数を超えたら
    if (selector[i].innerText.length > wordCount) {
      var str = selector[i].innerText; //文字数を取得
      str = str.substr(0, (wordCount - 1)); //1文字削る
      selector[i].innerText = str + clamp; //文末にテキストを足す
    }
  }
}
window.addEventListener('load', textTrim);
window.addEventListener('resize', textTrim);