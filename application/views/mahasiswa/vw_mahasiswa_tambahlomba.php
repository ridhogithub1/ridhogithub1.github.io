<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Buat Report</title>
</head>
<body>

<div class="container-fluid">
    <br>
    <div class="row">
        <!-- Form Section -->
        <div class="col-lg-8 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold mb-4">Create Nosa Report</h5>
                    
                    <?php if ($this->session->flashdata('message')) : ?>
                        <div class="alert alert-info" role="alert">
                            <?= $this->session->flashdata('message'); ?>
                        </div>
                    <?php endif; ?>
                    
                    <form action="<?= site_url('Mahasiswa/simpanreport');?>" method="POST" enctype="multipart/form-data">

                        <!-- Lomba Name -->
                        <div class="mb-3">
                            <label for="nama_lomba" class="form-label">Tanggal</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                        </div>
                        <!-- Lomba lokasi -->
                        <div class="mb-3">
                            <label for="lokasi" class="form-label">Estate</label>
                            <input type="text" class="form-control" id="estate" name="estate" required>
                        </div>
                        <!-- Lomba Date -->
                        <div class="mb-3">
                            <label for="waktu" class="form-label">Lokasi</label>
                            <input type="text" class="form-control" id="lokasi" name="lokasi" required>
                        </div>
                        <!-- Lomba tingkat -->
                        <div class="mb-3">
                            <label for="tingkat" class="form-label">Department</label>
                            <input type="text" class="form-control" id="department" name="department" required>
                        </div>
                        <div class="mb-3">
                            <label for="nama_pembimbing" class="form-label">kegiatan</label>
                            <input type="text" class="form-control" id="kegiatan" name="kegiatan" required>
                        </div>
                        <!-- Lomba proposal -->
                        <div class="mb-3">
                            <label for="proposal" class="form-label">Pengawas</label>
                            <input type="text" class="form-control" id="proposal" name="proposal" required>
                        </div>
                        <div class="mb-3">
                            <label for="proposal" class="form-label">Pelapor</label>
                            <input type="text" class="form-control" id="pelaport" name="pelapor" required>
                        </div>
                        <div class="mb-3">
                            <label for="proposal" class="form-label">SAP/NIK</label>
                            <input type="text" class="form-control" id="nik" name="nik" required>
                        </div>
                        <div class="mb-3">
                            <label for="proposal" class="form-label">Nosa Finding</label>
                            <input type="text" class="form-control" id="jenis_pelanggaran_nosa" name="jenis_pelanggaran_nosa" required>
                        </div>
                        <div class="mb-3">
                            <label for="proposal" class="form-label">Action Plan</label>
                            <input type="text" class="form-control" id="action_plane" name="action_plane" required>
                        </div>
                        <div class="mb-3">
                            <label for="proposal" class="form-label">Gambar</label>
                            <input type="file" class="form-control" id="proposal" name="proposal" required>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary">Simpan Lomba</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>