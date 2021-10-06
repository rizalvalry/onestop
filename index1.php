<?php
session_start();
if(isset($_SESSION['id'])){
?>

    <?php
      include "include/header.php";
    ?>

<div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">My Dashboard</li>
      </ol>
      <!-- Icon Cards-->
      <div class="row">
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-primary o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-exchange"></i>
              </div>
              <div class="mr-5">Data Transaksi</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="transaksi">
              <span class="float-left">View Details</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-warning o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-sitemap"></i>
              </div>
              <div class="mr-5">Data Pakaian</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="pakaian">
              <span class="float-left">View Details</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-success o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
              <i class="fa fa-fw fa-list"></i>
              </div>
              <div class="mr-5">Data Pelanggan</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="pelanggan">
              <span class="float-left">View Details</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-danger o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
              <i class="fa fa-fw fa-bell"></i>
              </div>
              <span class="mr-5" id="ticket_number"></span>New Tickets!
            </div>
            <a class="card-footer text-white clearfix small z-1" href="#">
              <span class="float-left">View Details</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
      </div>
      <!-- Area Chart Example-->
      
    <!-- /.container-fluid-->
    <div class="row">
    <div class="col-md-5">
        <div class="panel panel-primary">
            <div class="panel-heading"><b>Data Laundry</b></div>
            <div class="panel-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Status</th>
                            <th>Jumlah Order</th>
                        </tr>
                    </thead>
                    <tbody id="DatatTabelProduk">
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-7">
        <div class="panel panel-primary">
            <div class="panel-heading"><b>Grafik Data</b></div>
            <div class="panel-body">
                <canvas id="myChart"></canvas>
            </div>
        </div>
        
    </div>
</div>

<script type="text/javascript">
    function loadDoc() {
      setInterval(function(){

      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
        document.getElementById("ticket_number").innerHTML = this.responseText;
        }
      };
      xhttp.open("GET", "notifikasi.php", true);
      xhttp.send();

      },1000);


    }
    loadDoc();
</script>
           

<script>
$.getJSON( "data-pie.php", function( data ) {
    var TabelData="";
    $(data).each(function(i){ 
        TabelData +="<tr><td>"+data[i].status+"</td><td>"+data[i].number+"</td></tr>"; 
    });
    //tampilkan di tabel id DataTabelProduk
    $("#DatatTabelProduk").html(TabelData);

    //array untuk chart label dan chart data
    var isi_labels = [];
    var isi_data=[];
    var TotalJml = 0;
    //menghitung total jumlah item
    data.forEach(function (obj) {
        TotalJml += Number(obj["number"]);
    });

    //push ke dalam array isi label dan isi data
    var number = 0;
    $(data).each(function(i){         
        isi_labels.push(data[i].status); 
        //jml item dalam persentase
        isi_data.push(((data[i].number/TotalJml) * 100).toFixed(2));
    });

    //deklarasi chartjs untuk membuat grafik 2d di id mychart   
    var ctx = document.getElementById('myChart').getContext('2d');

    var myPieChart = new Chart(ctx, {
        //chart akan ditampilkan sebagai pie chart
        type: 'pie',
        data: {
            //membuat label chart
            labels: isi_labels,
            datasets: [{
                label: 'Data Produk',
                //isi chart
                data: isi_data,
                //membuat warna pada chart
                backgroundColor: [
                    'rgb(26, 214, 13)',
                    'rgb(235, 52, 110)',
                    'rgb(52, 82, 235)',
                    'rgb(138, 4, 113)',
                    'rgb(214, 134, 13)'
                ],
                //borderWidth: 0, //this will hide border
            }]
        },
        options: {
            //konfigurasi tooltip
            tooltips: {
                callbacks: {
                    label: function(tooltipItem, data) {
                        var dataset = data.datasets[tooltipItem.datasetIndex];
                        var labels = data.labels[tooltipItem.index];
                        var currentValue = dataset.data[tooltipItem.index];
                        return labels+": "+currentValue+" %";
                    }
                }
            }
          }
    });
});
</script>

<?php
        include "include/footer.php"
?>
<?php
}else{
	header("location:login/index");
}
