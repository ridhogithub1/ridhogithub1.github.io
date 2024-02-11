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
                <h6 class="fw-semibold mb-0">Kontraktor/Perusahaan</h6>
              </th>
              <th class="border-bottom-0">
                <h6 class="fw-semibold mb-0">Inspektor</h6>
              </th>
              <th class="border-bottom-0">
                <h6 class="fw-semibold mb-0">NIK</h6>
              </th>
              <th class="border-bottom-0">
                <h6 class="fw-semibold mb-0">Nosa Finding</h6>
              </th>
              <th class="border-bottom-0">
                <h6 class="fw-semibold mb-0">Action Plan</h6>
              </th>
              <th class="border-bottom-0">
                <h6 class="fw-semibold mb-0">Gambar</h6>
              </th>
              <th class="border-bottom-0">
                <h6 class="fw-semibold mb-0">Status</h6>
              </th>
              <th class="border-bottom-0">
                <h6 class="fw-semibold mb-0">Export PDF</h6>
              </th>

            </tr>
          </thead>
          <tbody>
            <?php if (!empty($report) && is_array($report)) : ?>
              <?php $i = 1; ?>
              <?php foreach ($report  as $l) : ?>
                <tr>
                  <td class="border-bottom-0">
                    <h6 class="fw-semibold mb-0"><?= $i; ?></h6>
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
                    <p class="mb-0 fw-normal"><?= $l['nik']; ?></p>
                  </td>
                  <td class="border-bottom-0">
                    <p class="mb-0 fw-normal"><?= $l['jenis_pelanggaran_nosa']; ?></p>
                  </td>
                  <td class="border-bottom-0">
                    <p class="mb-0 fw-normal"><?= $l['action_plan']; ?></p>
                  </td>
                  <td class="border-bottom-0">
                    <p class="mb-0 fw-normal"><?= $l['gambar']; ?></p>
                  </td>
                  <td class="border-bottom-0">
                    <p class="mb-0 fw-normal"><?= $l['status']; ?></p>
                  </td>



                  <td class="border-bottom-0">
                    <span><a class="badge bg-primary rounded-3 fw-semibold" href="<?= base_url('Mahasiswa/editlomba/' . $l['id']); ?>">Lihat Report</a></span>
                  </td>
                </tr>


                <?php $i++; ?>
              <?php endforeach; ?>
            <?php else : ?>
              <tr>
                <td colspan="15">No data available</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

</div>
</div>
</div>