<?php

include 'include/header.php';

?>
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="container-fluid-header">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1>Rà soát tập tin mã độc</h1>

                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="/"><i class="fa fa-home" aria-hidden="true"></i> Trang chủ</a></li>
                                    <li class="breadcrumb-item active">Rà soát tập tin mã độc</li>
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
              <div class="col-sm-3">
                <h3>Chọn tệp</h3>
                <div id="files" style="border: 1px solid #585858; border-radius: 5px; background-color:#000000ad; max-height: 500px; min-height: 500px; overflow-y: auto; padding: 0px;">
                      <br><br>


                </div>
                    

              </div>
              <div class="col-sm-9">

                <h3>Danh sách tệp bảo vệ </h3>
                   <div class = "info"  id="list_error"  style="border: 1px solid #585858; border-radius: 5px; background-color:#000000ad; max-height: 500px;min-height: 500px;  overflow-y: auto; padding: 0px;">
                    <?php 
           echo  shell_exec("sudo cat data/clam/final.log"."| awk -F".'" "'." '{ printf(".'"%-25s<br>"'.", $0); }'");
          
           ?>
                   </div>


                   
              </div>
             
            </div>
                   <br>
            <div class="row float-right" style="padding-bottom: 30px; margin-right: 20px;">
    
            <button id="button1" type="button" class="btn btn-add" onclick="ScanSel()"><i class="fa fa-check"></i>Quét </button>

            <button id="button1" type="button" class="btn btn-add" onclick="ScanAll()"><i class="fa fa-check"></i>Quét hệ thống</button>
         
          </div>
            <br><br>
          </section>
             <section class="content">
                            <div class="card">
                                <!-- /.card-header -->
                                <div class="card-header">
                            <h3>Quét tệp tin hệ thống</h3>
                                   <?php
                                  $db = new SQLite3('data/check.sqlite');
                                  $count = $db->querySingle('SELECT count(distinct name) FROM check_file');
                                  $count_malware = $db->querySingle('SELECT count(distinct name) FROM check_file where check_value = 0');
                                  $large = $db->querySingle('SELECT AVG(large_file) FROM check_file');
                      ?>
</div>
                                <div class="card-body">

<div class="row">
                                <div class="col-md-12">
                                               
                                      <div class="card card-custom">

                                      <div class="card-header card-header-cus">
                                         <form action="php/file_scan.php" method="post" style="float: right;">
                 <input value="1" type="hidden" name="tab" id="tabSelect">
                 <button type="submit" class="btn btn-add Disable" style="margin-top: 10px;"><i class="fa fa-refresh" aria-hidden="true"></i>  Quét chủ động </button>
              </form>
                                        <h3 class="card-title">Thông tin tệp trên hệ thống </h3>

                                      </div>
                                      <div class="card-body">
                                          
                                           <ul id="server-list" class="list-group">

                                          <li class="list-group-item">
                                        
                                          
                                          <b class="color-b" >Số lượng file: </b><i><?=$count?> file</i> 
                                          </li>
                                          </li>
                                          <li class="list-group-item">
                                        
                                          <b class="color-b">Số file chứa mã độc: </b>
                                          </a>  <i><?=$count_malware?> file</i> 
                                          </li>
                                         
                                          <li class="list-group-item">
                                          <a>
                                          <b class="color-b">Kích thước trung bình: </b>
                                          </a>  <i><?=$large?> KB</i> 

                  

                                      </li>
                  </ul>
                  </div>

                                        </div>
                                    </div>                         
                                </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
                             </div></div>
        <!-- /.row -->
        <input hidden  id="curpath" value="">
        <input hidden  id="choosepath" value="">
        <input hidden  id="deletepath" value="">
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


function ScanAll(){
  $.ajax({ 
    method:"GET", 
    url: "php/clamall.php",
    // url: "/check",
    // headers:  {'Access-Control-Allow-Origin' : 'http://192.168.218.138'},
    success: function (data) {
        console.log(data)
        $("#list_error").html(data);
      
    }
});

}


function ScanSel(){
 var data = new FormData();
 var curpath = document.getElementById("curpath").value;
 var item = document.getElementById("choosepath").value;
 var path = curpath + "/" + item;
data.append('path', path);
var data = new FormData();

    data.append('sel', path);
      $.ajax({ 
        method:"POST", 
        url: "php/clamav.php",
  data: data,
  processData: false,
  contentType: false,
        // url: "/check",
        // headers:  {'Access-Control-Allow-Origin' : 'http://192.168.218.138'},
        success: function (data) {
            console.log(data)
            $("#list_error").html(data);
          
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
  url: "/php/path_get.php",
  data: data,
  processData: false,
  contentType: false,
    async: false,
    cache: false,
   // url: "/check",
   // headers:  {'Access-Control-Allow-Origin' : 'http://192.168.218.138'},
   success: function (data) {
     console.log(data)
     list = JSON.parse(data)[0];
     folder = JSON.parse(data)[1];
   }
 });
  
  
  for(var i =0; i<list.length; i++){
      if (folder[i] == 1){
        var icon =  '<span><i class="fa fa-folder-o" aria-hidden="true"></i> '
      }else{
        var icon  = '<i class="fa fa-file-o" aria-hidden="true"> '
      }
      $("#files").append('<div class="file" id="'+list[i]+'"><span>'+icon+list[i]+'</span></div>')
       document.getElementById(list[i]).addEventListener("dblclick", function(){
        path = $(this).attr("id");
        readErrors(path)
      });
      document.getElementById(list[i]).addEventListener("click", function(){
        path = $(this).attr("id");
        $(".file").css('background-color', 'black');
        $(this).css('background-color', 'red');
        document.getElementById("choosepath").value = path;

      });

    }
  
  

}
getFile()


   function reload(){
   curpath =  document.getElementById("curpath").value;
 
   var data = new FormData();
  
  data.append('path', curpath);
   $.ajax({ 
  method: "POST",
  url: "/php/path_get.php",
  data: data,
  processData: false,
  contentType: false,
    async: false,
    cache: false,
   // url: "/check",
   // headers:  {'Access-Control-Allow-Origin' : 'http://192.168.218.138'},
   success: function (data) {
     console.log(data)
     list = JSON.parse(data)[0];
     folder = JSON.parse(data)[1];

   }
 });
  
    if (list != false){
     $("#files").empty()
    for(var i =0; i<list.length; i++){
      if (folder[i] == 1){
        console.log("it in");
        var icon =  '<span><i class="fa fa-folder-o" aria-hidden="true"></i> '
      }else{
        var icon  = '<i class="fa fa-file-o" aria-hidden="true"> '
      }
      $("#files").append('<div class="file" id="'+list[i]+'"><span>'+icon+list[i]+'</span></div>')
      document.getElementById(list[i]).addEventListener("dblclick", function(){
        path = $(this).attr("id");
        readErrors(path)
      });
      document.getElementById(list[i]).addEventListener("click", function(){
        path = $(this).attr("id");
        $(".file").css('background-color', 'black');
        $(this).css('background-color', 'red');
        document.getElementById("choosepath").value = path;

      });
    }
   
   }else{
    alert("Tệp đã chọn không là thư mục ");
    document.getElementById("curpath").value =  backup_path;
   }
 }
   
   function readErrors(path){
  curpath = document.getElementById("curpath").value;
  backup_path = curpath;
  if(path != ".."){
  if(curpath != "/"){
    curpath = curpath +  "/" +path;
  }else{
    curpath = curpath + path;
  }
  }else{
    newpath = curpath.split("/")[0]
    for (i = 1; i < curpath.split("/").length - 1; i ++){
      newpath = newpath + "/"+curpath.split("/")[i];
    }

    curpath = newpath
  }
  if (curpath == ""){
    curpath ="/"
  }

  document.getElementById("curpath").value = curpath;
  console.log(curpath)
   var data = new FormData();
  
  console.log(curpath);
  data.append('path', curpath);
   $.ajax({ 
  method: "POST",
  url: "/php/path_get.php",
  data: data,
  processData: false,
  contentType: false,
    async: false,
    cache: false,
   // url: "/check",
   // headers:  {'Access-Control-Allow-Origin' : 'http://192.168.218.138'},
   success: function (data) {
     console.log(data)
     list = JSON.parse(data)[0];
     folder = JSON.parse(data)[1];

   }
 });
  
    if (list != false){
     $("#files").empty()
   for(var i =0; i<list.length; i++){
      if (folder[i] == 1){
        var icon =  '<span><i class="fa fa-folder-o" aria-hidden="true"></i> '
      }else{
        var icon  = '<i class="fa fa-file-o" aria-hidden="true"> '
      }
      $("#files").append('<div class="file" id="'+list[i]+'"><span>'+icon+list[i]+'</span></div>')
      document.getElementById(list[i]).addEventListener("dblclick", function(){
        path = $(this).attr("id");
        readErrors(path)
      });
      document.getElementById(list[i]).addEventListener("click", function(){
        path = $(this).attr("id");
        $(".file").css('background-color', 'black');
        $(this).css('background-color', 'red');
        document.getElementById("choosepath").value = path;

      });
    }
   
   }else{
    alert("Tệp đã chọn không là thư mục ");
    document.getElementById("curpath").value =  backup_path;
   }
 }
   
   
   
   
</script>
