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
<script type="text/javascript">
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
</script>

<script src="admin_asset_web/plugins/js/Chart.js"></script>
<script type="text/javascript">
    var ctx = document.getElementById("myChart");
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [80, 22, 21, 8080],
            datasets: [{
                label: 'Số lượng thiết bị truy cập dịch vụ',
                data: [3, 6, 2, 1],
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
</script>
<script src="admin_asset_web/plugins/js/Chart.js"></script>
<script src="admin_asset_web/plugins/js/canvasjs.min.js"></script>