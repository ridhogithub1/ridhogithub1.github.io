<div class="container-fluid">
  <ul class="navbar-nav flex-row ms-auto align-items-center">
    <li class="navbar-btn">
      <a target="_blank" href="<?= site_url('Mahasiswa/tambah_report'); ?>" class="btn btn-primary">Create Nosa Report </a>
    </li>
  </ul>
  <!--  Row 1 -->
  <div class="card ">
    <div class="card-body ">
      <h5 class="card-title fw-semibold mb-4">Report <?php //echo $user;
                                                      ?></h5>
      <div class="table-responsive">
        <?= $this->session->flashdata('message'); ?>

        <table class="table text-nowrap mb-0 align-middle">
          <thead class="text-dark fs-4">
            <tr>
              <th class="border-bottom-0">
                <h6 class="fw-semibold mb-0">Id</h6>
              </th>
              <th class="border-bottom-0">
                <h6 class="fw-semibold mb-0">Bulan</h6>
              </th>

              <th class="border-bottom-0">
                <h6 class="fw-semibold mb-0">Tanggal</h6>
              </th>
              <th class="border-bottom-0">
                <h6 class="fw-semibold mb-0">Estate</h6>
              </th>
              <th class="border-bottom-0">
                <h6 class="fw-semibold mb-0">Region</h6>
              </th>
              <th class="border-bottom-0">
                <h6 class="fw-semibold mb-0">Location</h6>
              </th>
              <th class="border-bottom-0">
                <h6 class="fw-semibold mb-0">Department</h6>
              </th>
              <th class="border-bottom-0">
                <h6 class="fw-semibold mb-0">Kegiatan</h6>
              </th>
              <th class="border-bottom-0">
                <h6 class="fw-semibold mb-0">Perusahaan/Kontraktor</h6>
              </th>
              <th class="border-bottom-0">
                <h6 class="fw-semibold mb-0">Inspektor/Pelapor</h6>
              </th>
              <th class="border-bottom-0">
                <h6 class="fw-semibold mb-0">Planed</h6>
              </th>
              <th class="border-bottom-0">
                <h6 class="fw-semibold mb-0">Jenis Pelanggaran Nosa</h6>
              </th>
              <th class="border-bottom-0">
                <h6 class="fw-semibold mb-0">HPI</h6>
              </th>
              <th class="border-bottom-0">
                <h6 class="fw-semibold mb-0">Type NC</h6>
              </th>
              <th class="border-bottom-0">
                <h6 class="fw-semibold mb-0">Deadline</h6>
              </th>
              <th class="border-bottom-0">
                <h6 class="fw-semibold mb-0">Hari Open</h6>
              </th>
              <th class="border-bottom-0">
                <h6 class="fw-semibold mb-0">Gambar</h6>
              </th>
              <th class="border-bottom-0">
                <h6 class="fw-semibold mb-0">Pengawas</h6>
              </th>
              <th class="border-bottom-0">
                <h6 class="fw-semibold mb-0">Action Plan</h6>
              </th>
              <th class="border-bottom-0">
                <h6 class="fw-semibold mb-0">SAP/NIK</h6>
              </th>

              <th class="border-bottom-0">
                <h6 class="fw-semibold mb-0">Status</h6>
              </th>
              <th class="border-bottom-0">
                <h6 class="fw-semibold mb-0">Planed</h6>
              </th>
            
              <th class="border-bottom-0">
                <h6 class="fw-semibold mb-0">Export PDf</h6>
              </th>
            </tr>
          </thead>
          <tbody>
            <?php $i = 1;
            $report_reversed = array_reverse($report);
            ?>


            <?php foreach ($report as $l) : ?>
              <tr>
                <td class="border-bottom-0">
                  <h6 class="fw-semibold mb-0"><?= $i; ?></h6>
                </td>
                <td class="border-bottom-0">
                  <h6 class="fw-semibold mb-1">
                    <?php
                    // Mengambil nama bulan dari tanggal yang disediakan dalam format MMMM
                    $tanggal = new DateTime($l['tanggal']);
                    echo $tanggal->format('F');
                    ?>
                  </h6>
                </td>
                <td class="border-bottom-0">
                  <h6 class="fw-semibold mb-1"><?= $l['tanggal']; ?></h6>
                </td>

                <td class="border-bottom-0">
                  <p class="mb-0 fw-normal"><?= $l['estate']; ?></p>
                </td>
                <td class="border-bottom-0">
                  <p class="mb-0 fw-normal"><?= $l['region']; ?></p>
                </td>
                <td class="border-bottom-0">
                  <p class="mb-0 fw-normal"><?= $l['location']; ?></p>
                </td>
                <td class="border-bottom-0">
                  <p class="mb-0 fw-normal"><?= $l['department']; ?></p>
                </td>
                <td class="border-bottom-0">
                  <p class="mb-0 fw-normal"><?= $l['kegiatan']; ?></p>
                </td>
                <td class="border-bottom-0">
                  <p class="mb-0 fw-normal"><?= $l['kontraktor']; ?></p>
                </td>
                <td class="border-bottom-0">
                  <p class="mb-0 fw-normal"><?= $l['inspector']; ?></p>
                </td>
                <td class="border-bottom-0">
                  <p class="mb-0 fw-normal"><?= $l['planed']; ?></p>
                </td>
                <td class="border-bottom-0">
                  <p class="mb-0 fw-normal"><?= $l['jenis_pelanggaran_nosa']; ?></p>
                </td>
                <td class="border-bottom-0">
                  <p class="mb-0 fw-normal"><?= $l['hpi']; ?></p>
                </td>
                <td class="border-bottom-0">
                  <p class="mb-0 fw-normal"><?= $l['type_nc']; ?></p>
                </td>
                <td class="border-bottom-0">
                  <p class="mb-0 fw-normal"><?= $l['deadline']; ?></p>
                </td>

                <td class="border-bottom-0">
                  <p class="mb-0 fw-normal">
                    <?php
                    // $l['tanggal'] adalah variabel yang menyimpan tanggal dari data yang Anda punya
                    $tanggal = new DateTime($l['tanggal']);
                    $sekarang = new DateTime();

                    $selisih = $sekarang->diff($tanggal);
                    echo $selisih->days . ' hari';
                    ?>
                  </p>
                </td>
                <td class="border-bottom-0">
                  <p class="mb-0 fw-normal"><img width="100%" src="<?= base_url().'gambar/'. $l['gambar']; ?>" alt=""></p>
                </td>
                <td class="border-bottom-0">
                  <p class="mb-0 fw-normal"><?= $l['pengawas']; ?></p>
                </td>
                <td class="border-bottom-0">
                  <p class="mb-0 fw-normal"><?= $l['action_plan']; ?></p>
                </td>
                <td class="border-bottom-0">
                  <p class="mb-0 fw-normal"><?= $l['nik']; ?></p>
                </td>

                <td class="border-bottom-0">
                  <p class="mb-0 fw-normal"><?= $l['status']; ?></p>
                </td>
                <td class="border-bottom-0">
                  <p class="mb-0 fw-normal"><?= $l['planed']; ?></p>
                </td>
             
                <td class="border-bottom-0">
                  <!-- harus pakai / -->
                  <a target="_blank" href="<?= base_url('User/pdf/'). $l['id'];;  ?>" class="badge bg-secondary rounded-3 fw-semibold">Export PDF</a>
                </td>
              </tr>


              <?php $i++; ?>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>

  </div>


</div>

</div>
</div>
</div>