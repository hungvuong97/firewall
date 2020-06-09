<?php

include 'include/header.php';

?>
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="container-fluid-header">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1>Cấu hình tường lửa ứng dụng cho hệ thống dịch vụ công </h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="/"><i class="fa fa-home" aria-hidden="true"></i> Trang chủ</a></li>
                                    <li class="breadcrumb-item active">Tường lửa ứng dụng cho hệ thống dịch vụ công </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- /.container-fluid -->
                </section>

                <!-- Main content -->

            <div class="card-body">

             
                <section class="content">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <!-- /.card-header -->
                                <div class="card-body">
                                 <?php
              if(isset($_SESSION['notification'])){
             ?>
                                        <center>
                                            <div class="alert alert-success">
                                                <?=$_SESSION['notification']?>
                                                    <br>
                                            </div>
                                        </center>
                                        <?php
                }
                session_destroy();
                session_start();

              ?>
                 <ul class="nav nav-tabs" id="example-tabs" role="tablist">
                    <li class="nav-item margin_center">
                        <a id="tab1" class="nav-link active color-a" data-toggle="tab" role="tab" href="#home">Cấu hình tổng quan </a>
                    </li>
                    
                    <li class="nav-item margin_center">
                        <a id="tab2" class="nav-link color-a" data-toggle="tab" role="tab" href="#menu1">Thêm luật tường lửa</a>
                    </li>
                </ul>
                <br>
                    <div class="tab-content">
                        <div id="home" class="tab-pane in active show">
                                    <div class="row">

                                <div class="col-md-7">

                                    <div class="card card-custom">

                                        <div class="card-header" style="height: 580px; overflow: auto;">
                                            <div id="EditModal" tabindex="-1" role="dialog" aria-labelledby="removeMedicalAppLabel" aria-hidden="true">
        <div role="document">
            <div id="ConfigContent" style="width: 100%;
   left: 0%;">
                <div class="card-header">
                                            <h3 class="card-title">Cấu hình tường lửa dịch vụ Web</h3>
                </div>
                <div class="modal-body">
                <?php

                    $read = file('data/firewall.txt');
                   

                    $threshold = explode(" ",$read[0])[1];
                    $cpu = explode(" ",$read[1])[1];
                    $ram = explode(" ",$read[2])[1];
                    $paranoia = explode(" ",$read[3])[1];
    

                ?>
                    <form action="php/configfirewall.php" method="post">
                        <div class="container">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" value="<?=$ID?>" name="id" id="id">
                                        <input type="hidden" name="type">
                                        <div class="form-group">
                                            <label><i class="fa fa-globe"></i> Ngưỡng bất thường(
                                                <label style="color: red;">*</label>)</label>
                                            <input class="form-control Disable" name="threshold" value="<?=$threshold?>" required="required" placeholder="Nhập tên thiết bị" />
                                        </div>
                                        <div class="form-group">
                                            <label><i class="fa fa-globe"></i> Chỉ số CPU(
                                                <label style="color: red;">*</label>)</label>
                                            <input class="form-control Disable" name="thresholdCPU" value="<?=$cpu?>" required="required" placeholder="Nhập tên thiết bị" />
                                        </div>
                                        <div class="form-group">
                                            <label><i class="fa fa-globe"></i> Chỉ số Ram(
                                                <label style="color: red;">*</label>)</label>
                                            <input class="form-control Disable" name="thresholdRAM" value="<?=$ram?>" required="required" placeholder="Nhập tên thiết bị" />
                                        </div>
                                        <div class="form-group">
                                            <label>Paranoia level</label>
                                            <select class="form-control Disable" name="paranoia" id="select_Box_Type" value="<?=$paranoia?>" onchange="changeFunc_Type();">
                                                <option value="1">Level 1</option>
                                                <option value="2">Level 2</option>
                                                <option value="3">Level 3</option>
                                                <option value="4">Level 4</option>
                                            </select>
                                            <div id="new_element_type">
                                            </div>
                                        </div>
                                        <button id="SubmitButton" type="submit" class="btn btn-add"><i class="fa fa-cloud-upload"></i> Cập nhật cấu hình</button>
                                    </div>
                                    <div class="col-lg-6">
                                        <h4 style="padding-left: 40px;">Hướng dẫn cấu hình thống số</h4>
                                        <ul>
                                            <li><b>Ngưỡng bất thường:</b> Chỉ số càng cao độ nhạy của tường lửa càng thấp</li>
                                            <li><b>Chỉ số CPU:</b> khi dung lượng CPU sử dụng vượt qua ngưỡng này, hệ thống sẽ giảm ngưỡng nhằm tránh quá tải</li>
                                            <li><b>Chỉ số RAM:</b> khi dung lượng RAM sử dụng vượt qua ngưỡng này, hệ thống sẽ giảm ngưỡng nhằm tránh quá tải</li>
                                            <li><b>Paranoia level:</b> Chỉ số càng cao thì độ phát hiện bất thường mặc định càng cao</li>
                                     <!--        <li><b>Độ nguy hiểm:</b> Chỉ số cho biết độ bất thường của máy chủ, được tính theo hồi quy của các chỉ só trên</li>
 -->                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="card card-custom">
                                        <div class="card-header">
                                            <h3 class="card-title">Điều khiển một số module trên máy chủ</h3>

                                           <!--  <div class="card-tools">
                                                <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                                </button>
                                                <button type="button" class="btn btn-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                            </div> -->
                                        </div>
                                        <div class="card-body">
                                            <ul class="list-group box-list">
                                                <li class="list-group-item">
                                                    <span>Dịch vụ web </span>
                                                    <div role="group" aria-label="Action button">
                                                        <table class="table table-hover">

                                                            <tr>

                                                            <td>
                                                                <button type="button" class="btn btn-circle" onclick="ControlService(,'apache2','start')"><i class="fa fa-play-circle" title="start"></i></button>
                                                                <button type="button" class="btn btn-circle" id="DgaStop" onclick="ControlService('apache2','stop')"><i class="fa fa-pause" title="stop"></i></button>
                                                                <button type="button" class="btn btn-circle" onclick="ControlService('apache2','restart')" title="restart"><i class="fa fa-undo"></i></button>
                                                               
                                                            </td>                                                                <td><b>Trạng thái:</b> 
                                                                <?php 
                                                                    $apache_status = shell_exec("sudo service apache2 status | grep Active");
                                                                    if (strpos($apache_status, 'Active: active') !== false) {
                                                                        echo '                                                                    <span style="color: #00d600;">Active</span>';
                                                                    }else{
                                                                        echo '<span style="color: red;">Inactive (dead)</span>';
                                                                    }
                                                                ?>
                                                                    
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <span>Module modsecurity</span>

                                                    <div role="group" aria-label="Action button">
                                                        <table class="table table-hover">
                                                            <tr>

                                                                <td>
                                                                    <button type="button" class="btn btn-circle"  onclick="ControlService('autoencoder_detection','start')" title="start"><i class="fa fa-play-circle"></i></button>
                                                                    <button type="button" class="btn btn-circle" onclick="ControlService('autoencoder_detection','stop')"><i class="fa fa-pause" title="stop"></i></button>
                                                                    <button type="button" class="btn btn-circle" id="DnsRestart" onclick="ControlService(,'autoencoder_detection','restart')" title="restart"><i class="fa fa-undo"></i></button>
                                                                </td>
                                                                <td><b>Trạng thái:</b>
                                                                 <?php 
                                                                    $mod_status = shell_exec("sudo service autoencoder_detection status | grep Active");
                                                                     if (strpos($mod_status, 'Active: acti') !== false) {
                                                                        echo '                                                                    <span style="color: #00d600;">Active</span>';
                                                                    }else{
                                                                        echo '<span style="color: red;">Inactive (dead)</span>';
                                                                    }
                                                                ?> 
                                                                   
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>

                                                </li>

                                                 <li class="list-group-item">

                                                    <span>Điều khiển máy chủ web</span>
                                                    <div role="group" aria-label="Action button">
                                                        <table class="table table-hover">
                                                            <tr>
                                                                <td>
                                                                  
                                                                    <button type="button" class="btn btn-circle" id="DnsRestart" onclick="reboot()" title="restart"><i class="fa fa-undo"></i></button>
                                                                </td>

                                                                <td>
                                                                <!-- <button class="btn btn-add Disable">SSH</button> -->
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </li>

                                                <!-- </li> -->
                                               
                                                <!-- 
                                                <li class="list-group-item">
                                                        <span>Điều khiển máy trạm</span>
                                                        <div role="group" aria-label="Action button">

                                                         <table class="table table-bordered table-hover">
                                                        <tr>
                                                        <td>
                                                            <button type="button" class="btn btn-success" onclick="ControllService('192.168.20.28','apache2','start')">Turn on</button>
                                                            <button type="button" class="btn btn-danger" id="DgaStop" onclick="ControllService('192.168.20.28','apache2','stop')">Turn off</button>
                                                            <button type="button" class="btn btn-warning" onclick="RestartService('192.168.20.28','apache2')">Restart</button>
                                                            <button type="button" class="btn btn-primary " onclick="RestartService('192.168.20.28','apache2')">SSH</button>

                                                        </td>
                                                        <td></td>
                                                        </tr>
                                                        </table></div>
                                                        </li> -->

                                            </ul>
                                        </div>

                                    </div>
                                </div>
                            </div></div>
                            <div id="menu1" class="tab-pane fade">
                                <h5 style="margin-bottom: 15px;">Chỉnh sửa bộ luật tùy biến</h5>

<?php

include 'include/ip.php';

// include 'include/url.php';

include 'include/custom.php';

?>

<script>
$body = $("body");

$(document).on({
    ajaxStart: function() { $body.addClass("loading");    },
     ajaxStop: function() { $body.removeClass("loading"); }    
});

</script>
                            </div>
                            
                        </div>
                    </div>
                </div>

                           <!--  <div class="row">
                                <div class="col-md-12">
                                    <div class="card card-custom">

                                        <div class="card-header">
                                            <h3 class="card-title"> Log và cảnh báo</h3>

                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                                </button>
                                                <button type="button" class="btn btn-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="container">

                                                <ul class="nav nav-tabs" id="example-tabs" role="tablist">
                                                    <li class="nav-item margin_center">
                                                        <a id="tab1" class="nav-link active color-a" data-toggle="tab" role="tab" href="#home">DGA</a>
                                                    </li>
                                                    <li class="nav-item margin_center">
                                                        <a id="tab2" class="nav-link color-a" data-toggle="tab" role="tab" href="#menu1">ClamAV</a>
                                                    </li>
                                                </ul>
                                                <br>
                                                <div class="tab-content">
                                                    <div id="home" class="tab-pane  in active">
                                                        <table id="example2" class="table table-bordered table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <th>Thời gian</th>
                                                                    <th>Domain</th>
                                                                    <th>IP</th>
                                                                    <th>DGA</th>
                                                                   <th>Khác</th> 
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>time</td>
                                                                    <td>domain</td>
                                                                    <td>ip</td>
                
                                                                    <td style="color: red">Yes</td>    
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>-->
                                                  
                                                </div>
                                            </div>

                                        </div>
</section>
                                    </div>

                                </div>
                            </div> 
                                </div>
                                <!-- /.card-body -->
                            </div>

                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
             <?php

include 'include/footer.php';

?>
         <script type="text/javascript">
        function ControlService(service,action){
                $.ajax({
                    url : "php/servicecontrol.php",
                    type : "post",
                    dataType:"text",
                    data : {
                         name: service,
                         action: action

                    },
                    success : function (result){
                         setTimeout(function(){
                         
                        location.reload();
                     },2000);
                    }
                });
            }
              function reboot(service,action){
                $.ajax({
                    url : "php/reboot.php",
                    type : "post",
                    dataType:"text",
                    data : {
                         name: service,
                         action: action

                    },
                    success : function (result){
                         setTimeout(function(){
                         
                        location.reload();
                     },2000);
                    }
                });
            }
</script> 
