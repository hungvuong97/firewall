<?php

include 'include/header.php';

?>
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="container-fluid-header">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1>Báo cáo thống kê tệp</h1>

                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="/"><i class="fa fa-home" aria-hidden="true"></i> Trang chủ</a></li>
                                    <li class="breadcrumb-item active">Báo cáo thống kê tệp</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- /.container-fluid -->
                </section>

                <!-- Main content -->
                <section class="content">
            
                             <div id="menu1">
<div class="row">
              <div class="col-sm-12"><table id="resTable" class="table table-hover table-striped">
              <thead class="header-table" >
                  <tr>      
                      <th>Tệp tin/ Thư mục</th>
                      <th>Hành động</th>
                      <th>Thời gian</th>
                  </tr>
              </thead>
              <tbody id = "reglist">
              </tbody>
            </table>
              </div>
        </div>
              </div>
              <br>
             
            <br><br>
                             </div></div>
        <!-- /.row -->
        <input hidden  id="curpath" value="">
        <input hidden  id="choosepath" value="">
  <?php


$data = array_values($array);
$label = array_keys($array);
$data = json_encode(array_reverse($data));
$label = json_encode(array_reverse($label));
// print_r($data);
// print_r($label);
include 'include/footer.php';

?>
        <script src="admin_asset_web/dist/js/demo.js"></script>
<script src="admin_asset_web/plugins/js/Chart.js"></script>
        <script type="text/javascript">

function encrype(){
 var data = new FormData();

 var curpath = document.getElementById("curpath").value;
 var item = document.getElementById("choosepath").value;
 var path = curpath + "/" + item
 var pass = document.getElementById("pass").value;
  data.append('path', path);
  data.append('pass', pass);
  $.ajax({ 
  method: "POST",
  url: "/php/encrype.php",
  data: data,
  processData: false,
  contentType: false,
    async: false,
    cache: false,
   // url: "/check",
   // headers:  {'Access-Control-Allow-Origin' : 'http://192.168.218.138'},
   success: function (data) {
    console.log(data)
    if (data == "false"){
    alert("Đã mã hóa tệp tin thành công");

    }else{
      alert("Đã mã hóa thư mục thành công");
    }

  reload();
   }

 });
}

function decrype(){
  
 var data = new FormData();

 var curpath = document.getElementById("curpath").value;
 var item = document.getElementById("choosepath").value;
 var path = curpath  + "/" +  item
 var pass = document.getElementById("pass").value;
  data.append('path', path);
  data.append('pass', pass);
  $.ajax({ 
  method: "POST",
  url: "/php/decrype.php",
  data: data,
  processData: false,
  contentType: false,
    async: false,
    cache: false,
   // url: "/check",
   // headers:  {'Access-Control-Allow-Origin' : 'http://192.168.218.138'},
   success: function (data) {
    console.log(data)
    if (data == "false"){
    alert("Đã giải mã hóa tệp tin thành công");

    }else{
      alert("Đã giải mã thư mục thành công");  
        }
  reload();
   }
 });
}

$(document).ready(function () {
  $('#DgaTable').DataTable();
  $('.dataTables_length').addClass('bs-select');
});
function getInfo(){
$(document).ready(function() {
    $.ajax({
        type: "GET",
        url: 'php/file_scan.php',
        success: function(response)
        {

            console.log("ending");

        }
       });
     });
   
}

// getInfo();

// window.setInterval(function () {
//   getInfo();
// }, 5000);




var ctx = document.getElementById("myChart");
var myChart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: <?=$label?>,
    datasets: [{
      label: 'Thống kê loại file upload đến hệ thống',
      data: <?=$data?>,
     backgroundColor: '#638b94',
      borderWidth: 1
    }]
  },
  options: {
    responsive: false,
    scales: {
      xAxes: [{
        ticks: {
          maxRotation: 90,
          minRotation: 80
        }
      }],
      yAxes: [{
        ticks: {
          beginAtZero: false
        }
      }]
    }
  }
});

Chart.defaults.global.defaultFontColor = '#dcf3ff';



</script>

<script type="text/javascript">
  function getFile() {
  // checkErrors();
   var data = new FormData();

  data.append('path', '/');
  $.ajax({ 
  method: "POST",
  url: "/php/reg_get.php",
  data: data,
  processData: false,
  contentType: false,
    async: false,
    cache: false,
   // url: "/check",
   // headers:  {'Access-Control-Allow-Origin' : 'http://192.168.218.138'},
   success: function (data) {
     list = JSON.parse(data)["alert_list"];
     console.log(list)
   }
 });
  
  
    for(var i =0; i<list.length; i++){
      $("#reglist").append('<tr>')
      $("#reglist").append('<td>'+list[i][3]+'</td>')
      $("#reglist").append('<td>'+list[i][2]+'</td>')
      $("#reglist").append('<td>'+list[i][1]+'</td>')
      $("#reglist").append('</tr>')
     
    }
  
  

}
getFile()

  $(document).ready(function () {
  $('#resTable').DataTable();
 
  $('.dataTables_length').addClass('bs-select');
});  
</script>

<style type="text/css">
  tr:hover {
    background: rgba(255,255,255,0.2);
  }
</style>
