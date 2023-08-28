<?php
    $title = 'dashboard';
    include '../template/header.php';

    $data_peserta = query("SELECT * FROM data_peserta WHERE is_active = 0 AND deleted_at IS NULL");
    $data_lokasi = query("SELECT * FROM master_lokasi WHERE deleted_at IS NULL");
    $akun_peserta = query("SELECT * FROM users WHERE level = 0 AND deleted_at IS NULL");
    $akun_admin = query("SELECT * FROM users WHERE level = 1 AND deleted_at IS NULL");
    

    $hadir = query("SELECT da.* FROM data_absensi da LEFT JOIN users u ON u.id = da.id_users WHERE deleted_at IS NULL AND da.keterangan = 1");
    $izin = query("SELECT da.* FROM data_absensi da LEFT JOIN users u ON u.id = da.id_users WHERE deleted_at IS NULL AND da.keterangan = 2");
    $sakit = query("SELECT da.* FROM data_absensi da LEFT JOIN users u ON u.id = da.id_users WHERE deleted_at IS NULL AND da.keterangan = 3");

    $januari = 0;
    $februari = 0;
    $maret = 0;
    $april = 0;
    $mei = 0;
    $juni = 0;
    $juli = 0;
    $agustus = 0;
    $september = 0;
    $oktober = 0;
    $november = 0;
    $desember = 0;
    $test_git = 0;


    foreach ($data_peserta as $key) {
        
        if (date('m', strtotime($key['tgl_masuk'])) == date('1')) {
            $januari += 1;
        }elseif (date('m', strtotime($key['tgl_masuk'])) == date('2')) {
            $februari += 1;
        }elseif (date('m', strtotime($key['tgl_masuk'])) == date('3')) {
            $maret += 1;
        }elseif (date('m', strtotime($key['tgl_masuk'])) == date('4')) {
            $april += 1;
        }elseif (date('m', strtotime($key['tgl_masuk'])) == date('5')) {
            $mei += 1;
        }elseif (date('m', strtotime($key['tgl_masuk'])) == date('6')) {
            $juni += 1;
        }elseif (date('m', strtotime($key['tgl_masuk'])) == date('7')) {
            $juli += 1;
        }elseif (date('m', strtotime($key['tgl_masuk'])) == date('8')) {
            $agustus += 1;
        }elseif (date('m', strtotime($key['tgl_masuk'])) == date('9')) {
            $september += 1;
        }elseif (date('m', strtotime($key['tgl_masuk'])) == date('10')) {
            $oktober += 1;
        }elseif (date('m', strtotime($key['tgl_masuk'])) == date('11')) {
            $npvember += 1;
        }elseif (date('m', strtotime($key['tgl_masuk'])) == date('12')) {
            $desember += 1;
        }
    }


    // var_dump($key);
    // die();



    

    // $d=cal_days_in_month(CAL_GREGORIAN,8,2023);

?>       
                   <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                    </div>

                    <?php if ($akun['level'] == 1) { ?>
                        
                                            <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Peserta PKL</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= count($data_peserta); ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Lokasi PKL</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= count($data_lokasi) ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-map-marker fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                Akun Peserta PKL
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= count($akun_peserta) ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-address-card fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Admin
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= count($akun_admin) ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user-cog fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row">

                        <div class="col-xl-3 col-md-3 mb-3">
                            <div class="card border-secondary shadow">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Data Keterangan Seluruh Absensi</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div>
                                        <canvas id="myChart"></canvas>
                                    </div>                                
                                    <hr>
                                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-xl-9 col-md-9 mb-3">
                            <div class="card border-secondary shadow">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Data Bulan Masuk Peserta PKL</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div>
                                        <canvas id="myBarChart"></canvas>
                                    </div>                                
                                    <hr>
                                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                </div>
                            </div>
                        </div>

                    </div>

                    <?php }elseif($akun['level'] == 0){ ?>

                        <?php
                            $id = $akun['id'];
                            $datas = query("SELECT dp.*, u.foto FROM data_peserta dp LEFT JOIN users u ON dp.users_id = u.id WHERE dp.deleted_at IS NULL AND u.deleted_at IS NULL AND dp.users_id = $id")[0];
                            $absen = query("SELECT * FROM data_absensi WHERE 1=1 AND id_users = $id AND keterangan = 1 ORDER BY tgl_absen DESC");
                            
                            $hadir = query("SELECT da.* FROM data_absensi da WHERE da.id_users = $id AND da.keterangan = 1 ORDER BY tgl_absen DESC");
                            $izin = query("SELECT da.* FROM data_absensi da WHERE da.id_users = $id AND da.keterangan = 2 ORDER BY tgl_absen DESC");
                            $sakit = query("SELECT da.* FROM data_absensi da WHERE da.id_users = $id AND da.keterangan = 3 ORDER BY tgl_absen DESC");

                            date_default_timezone_set("Asia/Jakarta");

                            $cek_absensi = query("SELECT * FROM data_absensi WHERE 1=1 AND id_users = $id ORDER BY tgl_absen DESC")[0];

                            $last_absen = date('Y-m-d', strtotime($cek_absensi['tgl_absen']));
                            $current_absen = date('Y-m-d');


                            $awal = date('m', strtotime($datas['tgl_masuk']));
                            $akhir = date('m', strtotime($datas['tgl_keluar']));

                            $range = $akhir - $awal;

                            $day = (int)cal_days_in_month(CAL_GREGORIAN,date('m', strtotime($datas['tgl_masuk'])),date('Y', strtotime($datas['tgl_masuk']))) - (int)date('d', strtotime($datas['tgl_masuk'])) - 1;
                            
                            for ($i=0; $i < $range; $i++) { 
                            $temp = (int)cal_days_in_month(CAL_GREGORIAN,date('m', strtotime($datas['tgl_masuk'])) + date($i),date('Y', strtotime($datas['tgl_masuk']))) - (int)date('d', strtotime($datas['tgl_keluar']));
                            $day += (int)cal_days_in_month(CAL_GREGORIAN,date('m', strtotime($datas['tgl_masuk'])) + date($i),date('Y', strtotime($datas['tgl_masuk']))) - (int)$temp;
                                
                            
                            }
                            $hari_libur = (int)floor($day / 7) * 2;

                            $day = $day - $hari_libur;
                            $persentase_absen = (int)count($absen)/$day;
                            $persentase_absen = $persentase_absen * 100;

                            $count_hari_magang = (int)((mktime (0,0,0,date('m', strtotime($datas['tgl_keluar'])),date('d', strtotime($datas['tgl_keluar'])),date('Y', strtotime($datas['tgl_keluar']))) -time())/86400);

                            $current_hour = (int)date('H');
                            
                            // var_dump($current_hour);
                            // die();
                        ?>

                    <div class="row">                            
                        <div class="col-xl-12 col-md-12 mb-4">
                            <div class="card border-info shadow h-400 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="h4 font-weight-bold text-info text-center mb-1">
                                            Hello, Selamat 
                                            <?php if ($current_hour < 12 && $current_hour >= 7) {
                                                echo 'Pagi ' . $akun['nama'];
                                                echo '<br>';
                                                echo '<div class="h4 mt-1"> Selamat beraktivitas</div>';
                                            

                                                if ($current_absen != $last_absen) {
                                                    echo '<div class="h5 text-dark">Anda Belum Absen Hari ini, Silahkan Absen ke link berikut :</div>';
                                                    echo '<a href="data-absensi.php" class="btn btn-sm btn-outline-primary">Go Absen !</a>';
                                                }
                                            }elseif ($current_hour >= 12 && $current_hour <= 17) {
                                                echo 'Siang ' . $akun['nama'];
                                                echo '<br>';
                                                if ($current_absen != $last_absen) {
                                                    echo '<div class="h5 text-dark">Anda Belum Absen Hari ini, Silahkan Absen ke link berikut :</div>';
                                                    echo '<br>';
                                                    echo '<a href="data-absensi.php" class="btn btn-sm btn-outline-primary">Go Absen !</a>';
                                                }
                                            }else{
                                                echo 'Malam ' . $akun['nama'];
                                                echo '<br>';
                                                echo '<div class="h5 mt-1"> Waktu Absen Telah Habis Silahkan Kembali Besok Hari,
                                                Selamat Beristirahat :)</div>';
                                            } ?>

                                            </div>
                                            <!-- <div class="row no-gutters align-items-center">
                                                
                                            </div> -->
                                           
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-12 col-md-12 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                Persentase Kehadiran
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= number_format($persentase_absen,2); ?>%</div>
                                                </div>
                                                <div class="col">
                                                    <div class="progress progress-sm mr-2">
                                                        <div class="progress-bar <?php if ($persentase_absen <= 50) {
                                                            echo 'bg-danger';
                                                        }elseif($persentase_absen > 51){
                                                            echo 'bg-info';
                                                        } ?>" 
                                                        role="progressbar"
                                                            style="width: <?= floor($persentase_absen) ?>%" aria-valuenow="<?= $persentase_absen ?>" aria-valuemin="0"
                                                            aria-valuemax="<?= $day; ?>"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6 col-md-6 mb-3">
                            <div class="card border-secondary shadow">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Data Keterangan Absensi <?= $akun['nama'] ?></h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div>
                                        <canvas id="myChart"></canvas>
                                    </div>                                
                                    <hr>
                                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6 col-md-6 mb-3">
                            <div class="card border-secondary shadow">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Sisa Hari Magang</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="h1 text-center font-weight-bold text-info text-uppercase mb-1">
                                        <?= $count_hari_magang ?> hari
                                    </div>
                                    <hr>
                                    Manfaatkan hari-hari PKL mu untuk menambah ilmu.
                                    
                                </div>
                            </div>
                        </div>

                    </div>
                    
                    <?php } ?>


<script>
  const pieChart = document.getElementById('myChart');

   new Chart(pieChart, {
    type: 'doughnut',
    data:{
        labels: [
    'Hadir',
    'Izin',
    'Sakit',
  ],
  datasets: [{
    label: 'Hari',
    data: [
        <?= count($hadir) ?>,
        <?= count($izin) ?>,
        <?= count($sakit) ?>
    ],
    backgroundColor: [
        'rgb(124,252,0)',
      'rgb(54, 162, 235)',
      'rgb(255, 205, 86)',

    ],
    hoverOffset: 4
  }]
    }
   }
        
);

const barChart = document.getElementById('myBarChart');

// Set new default font family and font color to mimic Bootstrap's default styling
// Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
// Chart.defaults.global.defaultFontColor = '#858796';

function number_format(number, decimals, dec_point, thousands_sep) {
  // *     example: number_format(1234.56, 2, ',', ' ');
  // *     return: '1 234,56'
  number = (number + '').replace(',', '').replace(' ', '');
  var n = !isFinite(+number) ? 0 : +number,
    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
    sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
    s = '',
    toFixedFix = function(n, prec) {
      var k = Math.pow(10, prec);
      return '' + Math.round(n * k) / k;
    };
  // Fix for IE parseFloat(0.55).toFixed(0) = 0;
  s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
  if (s[0].length > 3) {
    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
  }
  if ((s[1] || '').length < prec) {
    s[1] = s[1] || '';
    s[1] += new Array(prec - s[1].length + 1).join('0');
  }
  return s.join(dec);
}

// Area Chart Example
// var ctx = document.getElementById("myAreaChart");
var myLineChart = new Chart(barChart, {
  type: 'line',
  data: {
    labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
    datasets: [{
      label: "Orang",
      lineTension: 0.3,
      backgroundColor: "rgba(78, 115, 223, 0.05)",
      borderColor: "rgba(78, 115, 223, 1)",
      pointRadius: 3,
      pointBackgroundColor: "rgba(78, 115, 223, 1)",
      pointBorderColor: "rgba(78, 115, 223, 1)",
      pointHoverRadius: 3,
      pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
      pointHoverBorderColor: "rgba(78, 115, 223, 1)",
      pointHitRadius: 10,
      pointBorderWidth: 2,
      data: [
        <?= $januari ?>,
        <?= $februari ?>,
        <?= $maret ?>,
        <?= $april ?>,
        <?= $mei ?>,
        <?= $juni ?>,
        <?= $juli ?>,
        <?= $januari ?>,
        <?= $januari ?>,
        <?= $januari ?>,
        <?= $januari ?>,
        <?= $januari ?>
    ],
    }],
  },
  options: {
    maintainAspectRatio: false,
    layout: {
      padding: {
        left: 10,
        right: 25,
        top: 25,
        bottom: 0
      }
    },
    scales: {
      xAxes: [{
        time: {
          unit: 'date'
        },
        gridLines: {
          display: false,
          drawBorder: false
        },
        ticks: {
          maxTicksLimit: 7
        }
      }],
      yAxes: [{
        ticks: {
          maxTicksLimit: 5,
          padding: 10,
          // Include a dollar sign in the ticks
          callback: function(value, index, values) {
            return '$' + number_format(value);
          }
        },
        gridLines: {
          color: "rgb(234, 236, 244)",
          zeroLineColor: "rgb(234, 236, 244)",
          drawBorder: false,
          borderDash: [2],
          zeroLineBorderDash: [2]
        }
      }],
    },
    legend: {
      display: false
    },
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      titleMarginBottom: 10,
      titleFontColor: '#6e707e',
      titleFontSize: 14,
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      intersect: false,
      mode: 'index',
      caretPadding: 10,
      callbacks: {
        label: function(tooltipItem, chart) {
          var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
          return datasetLabel + ': $' + number_format(tooltipItem.yLabel);
        }
      }
    }
  }
});


</script>





<?php
    include '../template/footer.php';
?>      