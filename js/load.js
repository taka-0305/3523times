$(function() {
    const loader_bg = $('#loading');
    //const progressBar = $('.loader-bar');
    
    const imgLoad = imagesLoaded('body');//body内の画像を監視
    const imgTotal = imgLoad.images.length;//画像の総数を取得
    
    let imgLoaded = 0;//ロードした画像カウント
    let progressSpeed = 8;//プログレスバーの進むスピード 大きいほど速くなる
    let progressCount = 0;//ローディングの進捗状況 0〜100
    let progressResult = 0;//ローディングの進捗状況 0〜100
    var past = performance.now();
    //読み込み状況をアップデート
    let progressInit = setInterval(function () {
        updateProgress();
    }, 25);
    
    //画像を一つロードするたびにimgLoadedのカウントをアップ
    imgLoad.on('progress', function (instance, image) {
        imgLoaded++;
    });
    
    //読み込み状況アップデート関数
    function updateProgress() {
        if ($('html').hasClass('wf-active')) {
            $('body').addClass('font-active')
        }
      //ローディング演出用の計算
        progressCount += (imgLoaded / imgTotal) * progressSpeed;
        if (imgTotal == 0) {
            progressResult = 100;
        }else if(progressCount >= 100 && imgTotal > imgLoaded) {
        //カウントは100以上だが画像の読み込みが終わってない
            progressResult = 99;
        } else if(progressCount > 99.9) {
        //カウントが100以上になった
            progressResult = 100;
        } else {
        //現在のカウント
            progressResult = progressCount;
        }
    
      //ローディング進捗状況をプログレスバーと数字で表示
        //progressBar.css('width', progressResult + '%');
    
      //ローディング完了後 0.8秒待ってページを表示
        if (progressResult >= 100 && imgTotal == imgLoaded) {
            clearInterval(progressInit);
            setTimeout(function () {
                loader_bg.addClass('hide');
            }, 1000);
            //if ($('body').hasClass('font-active') || $('html').hasClass//('wf-active')) {
            //    setTimeout(function () {
            //        loader_bg.addClass('loaded');
            //        console.log('load');
            //    }, 800);
            //} else {
            //    let showFont = setInterval(function () {
            //        if (performance.now() - past > 4000) {
            //            loader_bg.addClass('loaded');
            //            console.log('complete!')
            //            clearInterval(showFont);
//
            //        }
            //    }, 25);
            //}
        }
    }
})