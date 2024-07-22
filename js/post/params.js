function getParam(name, url) {
  if (!url) url = window.location.href;
  name = name.replace(/[\[\]]/g, "\\$&");
  var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
      results = regex.exec(url);
  if (!results) return null;
  if (!results[2]) return '';
  return decodeURIComponent(results[2].replace(/\+/g, " "));
}

$(function () {
  const params_array = []
  let params = getParams();
  var index = params.get("sort");
  $("#sort option[value=" + index + "]").prop('selected', true);

  $('button.add-params').click(function () {
    let params = getParams();
    var value = $(this).val();
    var name = $(this).attr('name');
    deletePickup(params)
    deletePage(params)
    setParams(name, value, params)
  })

  $('button.selected-label').click(function () {
    var name = $(this).attr('name');
    deleteParams(name)
  })

  $('button.delete-all').click(function () {
    deleteAllParams()
  })

  $('#sort').change(function() {
    let params = getParams();
    var value = $('option:selected').val();
    var name = $(this).attr('name');
    setParams(name, value, params)
  })

  function deleteParams(name) {
    let params = getParams();
    params.delete(name);
    window.location.search = params.toString()
  }

  function deletePickup(params) {
    if (params.get("pickup")) {
      params.delete("pickup");
      params.toString()
    }
  }

  function deletePage(params) {
    if (params.get("post_page")) {
      params.delete("post_page");
      params.toString()
    }
  }
  
  function deleteAllParams() {
    let params = getParams();
    var params_array = splitKey()
    console.log(params_array);
    $.each(params_array, function (index, value) {
      params.delete(index);
    })
    window.location.search = params.toString()
  }

  function setParams(name,value,params) {
    if( params.get(name) ) {
      params.set(name, value);
      //console.log(params.toString())
      window.location.search = params.toString()
    } else {
      params.set(name,value);
      //console.log(params.toString())
      window.location.search = params.toString()
    }
  }

  function splitKey() {
    const query = location.search.substring(1);

    // value,keyのセットで分割する
    const params = query.split('&');

    // クエリパラメータを格納するオブジェクトを宣言しておく
    let queryObject = {};

    // value,keyのセットの数だけ処理を繰り返す
    for(let i = 0; i < params.length; i ++) {
    
      // valueとkeyを分けて、デコードしたものを変数へ代入する
      const elem = params[i].split('=');
      const key = decodeURI(elem[0]);
      const value = decodeURI(elem[1]);
    
      // 宣言しておいたオブジェクトへ追加する
      queryObject[key] = value;
    }
    return queryObject;
  }

  function getParams() {
    let url = new URL(window.location.href);
    let params = url.searchParams;
    return params;
  }
})