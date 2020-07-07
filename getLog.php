<?php

include 'include/header.php';

?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid-header">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <div class="form-inline">

                        <h1>Quản lý lưu nhật ký</h1>
                    </div>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/"><i class="fa fa-home" aria-hidden="true"></i> Trang chủ</a></li>
                        <li class="breadcrumb-item active">Quản lý lưu nhật ký</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">

                        <!-- /.card-header -->
                        <div class="card-body">
                            <br>
                            <div class="tab-content">
                                <div id="home" class="tab-pane  in active">

                                    <div class="row">

                                        <div class="col-md-12">

                                            <canvas id="myChart" style="width: 100%; height: 400px;"></canvas>
                                        </div>
                                        <div class="col-md-12">

                                            <canvas id="myChart1" style="width: 100%; height: 400px;"></canvas>
                                        </div>
                                        <div class="col-md-12">

                                            <canvas id="myChart2" style="width: 100%; height: 400px;"></canvas>
                                        </div>
                                        <div class="col-md-12">

                                            <canvas id="myChart3" style="width: 100%; height: 400px;"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <a id="background-loading">
                                <img id="gif_load" hidden="" style="position: fixed; top: 50%;" src="admin_asset_web/dist/img/loading1.gif">
                            </a>
                        </div>
                    </div>
                    <!-- /.row -->
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

</div>
<!-- /.col -->
</div>
<?php

include 'include/footer.php';

?>
<!-- AdminLTE for demo purposes -->
<script src="admin_asset_web/dist/js/demo.js"></script>
<!-- <script type="text/javascript">
    document.getElementById("tab<?= $_SESSION['logtab'] ?>").click();

    function tabFun(i) {
        document.getElementById("tabSelect").value = i;
    }
    x = <?= $_POST['tab'] ?> + 0;
    console.log(x)
    if (x == 2) {
        document.getElementById("tab2").click();
    }
    if (x == 3) {
        document.getElementById("tab3").click();
    }
    if (x == 4) {
        // console.log("?????")
        document.getElementById("tab4").click();
    }
    if (x == 5) {
        document.getElementById("tab5").click();
    }
</script> -->

<script src="admin_asset_web/plugins/js/Chart.js"></script>
<script type="text/javascript">
    let mychart = (label, data, mychart, text) => {
        var ctx = document.getElementById(`${mychart}`);
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: label,
                datasets: [{
                    label: text,
                    data: data,
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
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

        Chart.defaults.global.defaultFontColor = '#dcf3ff';
    }
    getLog = () => {
        $.ajax({
            type: "GET",
            url: 'php/getLog.php',
            success: function(response) {
                res = JSON.parse(response);
                let label = [],
                    data = [];
                let ipinput = res[0]
                if (ipinput.length > 0) {
                    for (let i = 0; i < ipinput.length; i++) {
                        label.push(ipinput[i]['ip'])
                        data.push(ipinput[i]['count'])
                    }
                    let myChart = 'myChart';
                    let text = 'Số lượng thiết bị truy cập địa chỉ IP Input'
                    mychart(label, data, myChart, text);
                }
                label = [];
                data = [];
                let ipoutput = res[1];
                if (ipoutput.length > 0) {
                    for (let i = 0; i < ipoutput.length; i++) {
                        label.push(ipoutput[i]['ip'])
                        data.push(ipoutput[i]['count'])
                    }
                    let myChart = 'myChart1';
                    let text = 'Số lượng thiết bị truy cập địa chỉ IP Output'
                    mychart(label, data, myChart, text);
                }
                label = [];
                data = [];
                let portinput = res[2];
                if (portinput.length > 0) {
                    for (let i = 0; i < portinput.length; i++) {

                        label.push(portinput[i]['port'])
                        data.push(portinput[i]['count'])
                    }
                    let myChart = 'myChart2';
                    let text = 'Số lượng thiết bị truy cập dịch vụ Input'
                    console.log(label, data)
                    mychart(label, data, myChart, text);
                }
                label = [];
                data = [];
                let portoutput = res[3];
                if (portoutput.length > 0) {
                    for (let i = 0; i < portoutput.length; i++) {
                        label.push(portoutput[i]['port'])
                        data.push(portoutput[i]['count'])
                    }
                    let myChart = 'myChart3';
                    let text = 'Số lượng thiết bị truy cập dịch vụ Output'
                    mychart(label, data, myChart, text);
                }

            }
        }, false)
    }
    getLog();
</script>
<script src="admin_asset_web/plugins/js/Chart.js"></script>
<script src="admin_asset_web/plugins/js/canvasjs.min.js"></script>