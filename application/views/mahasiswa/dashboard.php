<div class="container-fluid">
  <!--  Row 1 -->
  <div class="row">
    <!-- ini untuk grafik nya -->
    <!-- <div class="col-lg-12">
      <canvas id="monthlyReportChart"></canvas>
    </div>
    <script src="path/to/chart.js"></script>
    <script>
      // Ambil data dari controller
      $.ajax({
        url: "<?php echo site_url('Mahasiswa/getMonthlyReportData'); ?>",
        method: "GET",
        success: function(data) {
          var monthlyData = JSON.parse(data);

          // Gunakan data untuk membuat grafik
          var ctx = document.getElementById('monthlyReportChart').getContext('2d');
          var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
              labels: monthlyData.labels,
              datasets: [{
                label: 'Monthly Report',
                data: monthlyData.data,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
              }]
            },
            options: {
              scales: {
                y: {
                  beginAtZero: true
                }
              }
            }
          });
        }
      });
    </script> -->
    <div class="col-lg-8 d-flex align-items-strech">
      <div class="card w-100">
        <div class="card-body">
          <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
            <div class="mb-3 mb-sm-0">
              <h5 class="card-title fw-semibold">Table Report 2024</h5>
            </div>
          </div>
          <div class="table-responsive">
            <?= $this->session->flashdata('message'); ?>
            <!-- Jika user == 1 yaitu admin -->
            <table class="table text-nowrap mb-0 align-middle">
              <thead class="text-dark fs-4">
                <tr>
                  <th class="border-bottom-0">
                    <h6 class="fw-semibold mb-0">Id</h6>
                  </th>
                  <th class="border-bottom-0">
                    <h6 class="fw-semibold mb-0">Tanggal</h6>
                  </th>
                  <th class="border-bottom-0">
                    <h6 class="fw-semibold mb-0">Jenis Pelanggaran Nosa</h6>
                  </th>
                  <th class="border-bottom-0">
                    <h6 class="fw-semibold mb-0">Action</h6>
                  </th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 10; ?>
                <?php $a = 1; ?>
                <?php foreach ($report as $l) : ?>
                  <tr>
                    <td class="border-bottom-0">
                      <h6 class="fw-semibold mb-0"><?= $a; ?></h6>
                    </td>
                    <td class="border-bottom-0">
                      <h6 class="fw-semibold mb-1"><?= $l['tanggal']; ?></h6>
                    </td>
                    <td class="border-bottom-0">
                      <p class="mb-0 fw-normal"><?= $l['jenis_pelanggaran_nosa']; ?></p>
                    </td>
                    <td class="border-bottom-0">
                      <p class="mb-0 fw-normal"><?= $l['action_plan']; ?></p>
                    </td>
                  </tr>
                  <?php $i--; ?>
                  <?php $a++; ?>
                <?php endforeach; ?>
              </tbody>
            </table>
            <!-- jika user == 3 yaitu ka prodi -->
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="row">
        <div class="col-lg-12">
          <!-- Yearly Breakup -->
          <div class="card overflow-hidden">
            <div class="card-body p-4">
              <h5 class="card-title mb-9 fw-semibold">Jumlah Report</h5>
              <div class="row align-items-center">
                <div class="col-8">
                  <h4 class="fw-semibold mb-3"><?php echo $a - 1; ?></h4>


                </div>

              </div>
            </div>
          </div>
        </div>


      </div>
    </div>


  </div>

  