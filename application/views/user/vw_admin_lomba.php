<div class="container-fluid">
  <!--  Row 1 -->
  <ul class="navbar-nav flex-row ms-auto align-items-center">
    <li class="navbar-btn">
      <a target="_blank" href="<?= site_url('User/tambahlomba'); ?>" class="btn btn-primary">Create Nosa Report </a>
    </li>
  </ul>
  <div class="card ">
    <div class="card-body ">
      <h5 class="card-title fw-semibold mb-4">Kelola Lomba</h5>
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
                <h6 class="fw-semibold mb-0">Kontraktor</h6>
              </th>
              <th class="border-bottom-0">
                <h6 class="fw-semibold mb-0">Inspektor</h6>
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
                <h6 class="fw-semibold mb-0">Pelapor</h6>
              </th>
              <th class="border-bottom-0">
                <h6 class="fw-semibold mb-0">Status</h6>
              </th>
              <th class="border-bottom-0">
                <h6 class="fw-semibold mb-0">Edit</h6>
              </th>
              <th class="border-bottom-0">
                <h6 class="fw-semibold mb-0">Export PDf</h6>
              </th>
            </tr>
          </thead>
          <tbody>
            <?php $i = 1; ?>
            <?php foreach ($report as $l) : ?>
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
                  <p class="mb-0 fw-normal"><?= $l['gambar']; ?></p>
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
                  <p class="mb-0 fw-normal"><?= $l['pelapor']; ?></p>
                </td>
                <td class="border-bottom-0">
                  <p class="mb-0 fw-normal"><?= $l['status']; ?></p>
                </td>
                <td class="border-bottom-0">
                  <span><a class="badge bg-primary rounded-3 fw-semibold" href=" <?= base_url('User/edit_lomba/') . $l['id'];  ?>">Edit</a></span>
                  <span><a class="badge bg-danger rounded-3 fw-semibold" href="<?= base_url('User/hapus_lomba/') . $l['id']; ?>">Hapus</a></span>
                </td>
                <td class="border-bottom-0">
                  <span><a class="badge bg-primary rounded-3 fw-semibold" href="<?= base_url('Mahasiswa/editlomba/' . $l['id']); ?>">Lihat Report</a></span>
                </td>
              </tr>


              <?php $i++; ?>
            <?php endforeach; ?>
          </tbody>


        </table>
        <!-- jika user == 3 yaitu ka prodi -->


      </div>
    </div>
  </div>
</div>

</div>
</div>
</div>