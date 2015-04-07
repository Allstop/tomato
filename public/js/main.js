//全域變數
var list={},
    userId,
    name,
    startTimeValue,
    endTimeValue,
    BASE_URL = location.protocol + '//' + location.hostname;

    $('#do').hide();

//點選START,檢查是否已經登入
$("#start").click(function(){
  if (name != '' ){
    $('#start').hide();
    clockDown();
  }else{
    sessionCheck();
  }
  $('.create').html('');
});
//點選logout,登出
$(document).on("click",".logout",function(){
    name = '';
    $('.welcome_user').html('');
    $('.welcome_user').append("Welcome , Guest");
    $('.listRecord').html('');
    $('#do').hide();
    $('#start').show();
});
//點選送出
$("#submit").click(function(){
    var descriptionVaule = $(".description").val();
    Record = {
            name : name,
            starttime : startTimeValue,
            endtime : endTimeValue,
            description : descriptionVaule
    }
    createRecord(Record);
});

var clockDown=function(){
    startTime = new Date();
    endTime = new Date();
    endTime.setSeconds(endTime.getSeconds()+1);
    var spantime = (endTime - startTime)/1000;
    this.getString = function(dt){
        return dt.getFullYear() + "-" +
               (dt.getMonth()+1) + "-" +
               dt.getDate() + " " +
               dt.getHours() + ":" +
               dt.getMinutes() + ":"+
               dt.getSeconds() ;
    }
    this.cal=function(){
        spantime --;
        if (spantime>=0){
            var d = Math.floor(spantime / (24 * 3600));
            var h = Math.floor((spantime % (24*3600))/3600);
            var m = Math.floor((spantime % 3600)/(60));
            var s = Math.floor(spantime%60);
            str =  h + "时 " + m + "分 " + s + "秒 ";
            document.getElementById("pad").innerHTML = str;
        }else{
            $('#pad').hide();
            $('#do').show();
            clearInterval(timer);
        }
    }
    startTimeValue = getString(startTime);
    endTimeValue = getString(endTime);
    var timer = setInterval(this.cal, 1000);
}
//點選Login
$(document).on("click",".log",function(){
  if ($(".name").val() == '' || $(".password").val() == '') {
    alert("帳號、密碼不得為空值！");
  } else {
    var nameVaule = $(".name").val();
    var passwordVaule = $(".password").val();
    list = {
      name : nameVaule,
      password : passwordVaule
    }
    loginCheck();
  }
});
//點選New registration
$(document).on("click",".new",function(){
  var $Div = $('<div></div>');
  $Div.append('建立帳號：<input type="text" class="name" name="vname"><br/>');
  $Div.append('建立密碼：<input type="text" class="password" name="password"><br/>');
  $Div.append('<button class="go">GO</button>');
  $('.login').html('');
  $('.create').html('');
  $('.create').append($Div);
});
//點選GO
$(document).on("click",".go",function(){
    if ($(".name").val() == '' || $(".password").val() == '') {
        alert("帳號、密碼不得為空值！");
    } else {
        var nameVaule = $(".name").val();
        var passwordVaule = $(".password").val();
        createList = {
            name : nameVaule,
            password : passwordVaule
        }
    createCheck(createList);
    }
});
//session檢查
var sessionCheck = function() {
  $.ajax({
    url: BASE_URL + "/sessionCheck",
    type: "POST",
    dataType: "JSON",
    data: {name:name},
    success: function(response) {
      if (response.status == false) {
        var $Div = $('<div></div>');
        $Div.append('帳號：<input type="text" class="name" name="vname" value="cara"><br/>');
        $Div.append('密碼：<input type="text" class="password" name="password" value="2222"><br/><br/>');
        $Div.append('<button class="log">Login</button>&nbsp;');
        $Div.append('<button class="new">New registration</button>');
        $('.login').html('');
        $('.login').append($Div);
      } else {
      }
    },
    error: function () {
    }
  })
};
//login檢查
var loginCheck = function() {
  $.ajax({
    url: BASE_URL + "/loginCheck",
    type: "POST",
    dataType: "JSON",
    data: list,
    success: function(response) {
      if (response.status == false) {
        alert("登入失敗，請重新登入！");
        $('.login').html('');
        sessionCheck();
      } else {
        alert("登入成功！");
        name = response.status[0]['name'];
        userId = response.status[0]['id'];
        $('.welcome_user').html('');
        $('.welcome_user').append("Welcome , "+name+"&nbsp;&nbsp;");
        $('.welcome_user').append('<a href="#" class="logout">登出</a>');
        $('.login').html('');
        listRecord();
      }
    },
    error: function () {
    }
  })
};
//建立檢查
var createCheck = function(createList) {
  $.ajax({
    url: BASE_URL + "/createCheck",
    type: "POST",
    dataType: "JSON",
    data: createList,
    success: function(response) {
      if (response.status == 'success') {
        create(createList);
      } else {
        alert('123');
      }
    },
    error: function (response) {
    }
  })
};
//建立
var create = function(createList) {
  $.ajax({
    url: BASE_URL + "/create",
    type: "POST",  //POST or GET 大寫
    dataType: "JSON",
    data: createList,    // 要傳入的json 物件

    success: function (response) {
      if (response.status == '失敗') {
        alert('失敗，請重新建立！');
      } else {
        alert('建立成功，請開始使用！');
        $('.create').html('');
        sessionCheck();
      }
    },
    error: function () {
      alert('建立失敗，請重新建立！');
    }
  })
};
//createRecord
var createRecord = function(Record) {
    $.ajax({
        url: BASE_URL + "/createRecord",
        type: "POST",
        dataType: "JSON",
        data: Record,
        success: function (response) {
          console.log(response.status);
          alert('createRecord建立成功！');
            if (response.status == '成功') {
                $('#do').hide();
                $('#start').show();
                listRecord();
            }else{
                alert('createRecord建立失敗！');
            }
        },
        error: function () {
        }
    })
};
//listRecord
var listRecord = function() {
  $.ajax({
    url: BASE_URL + "/listRecord",
    type: "GET",
    dataType: "JSON",
    data: {"name": name},
    success: function (response) {
      if (response.status == false) {
      }else{
        var title = ["日期","起始","結束","描述"];
        $('.listRecord').html('');
        $('.listRecord').append('<h3 class=main>工作清單</h3>');
        var $table = $('<table></table>');
        var $Tr = $('<tr class="title"></tr>');
        for (var m in title ) {
          var $Td = $('<td></td>');
          $Td.text(title[m]);
          $Tr.append($Td);
          $table.append($Tr);
          m++;
        }
        for (var key in response.status) {
          var $Tr = $('<tr></tr>'),
              temp = response.status[key];
          $Tr.append('<td ColSpan=4 Align="Center">'+temp.date+'</td>');
          $table.append($Tr);
          var $Tr = $('<tr></tr>');
          for (var j in temp ) {
            var $Td = $('<td class="b3"></td>');
            $Td.text(temp[j]);
            $Tr.append($Td);
            $table.append($Tr);
          }
          $('.listRecord').append($table);
        }
      }
    },
    error: function () {
    }
  })
};
//welcome_user
if (name != ''){
  $('.welcome_user').html('');
  $('.welcome_user').append("Welcome , "+name+"&nbsp;&nbsp;");
  $('.welcome_user').append('<a href="#" class="logout">登出</a>');
  listRecord();
}else{
  $('.welcome_user').html('');
  $('.welcome_user').append("Welcome , Guest");
}


