//全域變數
var list={},
    BASE_URL = location.protocol + '//' + location.hostname;

$("#submit").click(function(){
  var user = $(".name").val();

  loginCheck(user);
});
//建立User/password～執行click
$(document).on("click","#start",function(){
  console.log(456);
  var name_value = $(".name").val();
  var password_value = $(".password").val();
   list = {
    name : name_value,
    password : password_value
  }
  createCheck();
});
//main
var main = function() {
  $.ajax({
    url: BASE_URL + "/tomatoTime/loginCheck",
    type: "POST",
    dataType: "JSON",
    data: list,
    success: function(response) {
      if (response.status == 'success') {
      } else {
        login();
      }
    },
    error: function () {
    }
  })
};
//login檢查
var loginCheck = function() {
  console.log(444);
  $.ajax({
    url: BASE_URL + "/tomatoTime/loginCheck",
    type: "POST",
    dataType: "JSON",
    data: list,
    success: function(response) {
      if (response.status == 'success') {
        console.log(response);
      } else {
        console.log(response);
        login();
      }
    },
    error: function () {
    }

  })
};
//login
var login = function() {
  $('.login').html('');
  $.ajax({
    url: BASE_URL + "/tomatoTime/create",
    type: "POST",  //POST or GET 大寫
    dataType: "JSON",
    data: list,    // 要傳入的json 物件
    success: function (response) {
      alert("登入成功！");
    },
    error: function () {
      alert("登入失敗，請重新登入！");
      login();
    }
  })
};
//建立檢查
var createCheck = function(name) {
  $.ajax({
    url: BASE_URL + "/tomatoTime/createCheck",
    type: "POST",
    dataType: "JSON",
    data: {name : name},
    success: function(response) {
      if (response.status == 'success') {
        create();
      } else {
        console.log(response);
      }
    },
    error: function () {
    }
  })
};
//建立
var create = function() {
  $.ajax({
    url: BASE_URL + "/tomatoTime/create",
    type: "POST",  //POST or GET 大寫
    dataType: "JSON",
    data: list,    // 要傳入的json 物件
    success: function (response) {
      alert('建立成功，請開始使用！');
      main();
    },
    error: function () {
      alert('建立失敗，請重新建立！');
    }
  })
};