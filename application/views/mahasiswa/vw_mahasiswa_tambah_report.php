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
                    <h5 class="card-title fw-semibold mb-4">Halaman tambah Report</h5>

                        <!-- Form -->
                        <form action="<?= site_url('Mahasiswa/tambah_report'); ?>" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">

                            <!-- Lomba Name -->
                            <div class="mb-3">
                                <label for="tanggal" class="form-label">Tanggal</label>
                                <input type="datetime-local" class="form-control" id="tanggal" name="tanggal" value="2024-02-12T12:00">
                            </div>

                            <!-- Lomba Region -->
                            <div class="mb-3">
                                <label for="region" class="form-label">Region</label>
                                <select class="form-control" id="region" name="region" required onchange="populateEstates()">
                                    <option value="">Pilih Region..</option>
                                    <option value="West">West</option>
                                    <option value="North">North</option>
                                    <option value="East">East</option>
                                    <option value="South">South</option>
                                    <option value="North West">North West</option>
                                </select>
                            </div>


                            <!-- Estate Section -->
                            <div class="mb-3" id="estateDiv" style="display: none;">
                                <label for="lokasi" class="form-label">Estate</label>
                                <select class="form-control" id="estate" name="estate" required>
                                    <!-- Options will be dynamically populated based on region selection -->
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="location" class="form-label">Lokasi</label>
                                <input type="text" class="form-control" id="location" name="location" required >
                            </div>


                            <!-- Lomba Department -->
                            <div class="mb-3">
                                <label for="department" class="form-label">Department</label>
                                <input type="text" class="form-control" id="department" name="department" required>
                            </div>

                            <!-- Lomba Kegiatan -->
                            <div class="mb-3">
                                <label for="kegiatan" class="form-label">Kegiatan</label>
                                <input type="text" class="form-control" id="kegiatan" name="kegiatan" required>
                            </div>

                            <!-- Lomba Kontraktor -->
                            <div class="mb-3">
                                <label for="kontraktor" class="form-label">Kontraktor</label>
                                <input type="text" class="form-control" id="kontraktor" name="kontraktor" required>
                            </div>

                            <!-- Lomba Inspector/Pelapor -->
                            <div class="mb-3">
                                <label for="inspector" class="form-label">Inspector/Pelapor</label>
                                <input type="text" class="form-control" id="inspector" name="inspector" required>
                            </div>

                            <!-- Lomba Jenis Pelanggaran Nosa -->
                            <div class="mb-3">
                                <label for="jenis_pelanggaran_nosa" class="form-label">Jenis Pelanggaran Nosa</label>
                                <input type="text" class="form-control" id="jenis_pelanggaran_nosa" name="jenis_pelanggaran_nosa" required>
                            </div>

                            <!-- Lomba HPI -->
                            <div class="mb-3">
                                <label for="hpi" class="form-label">Type NC</label>
                                <select class="form-control" id="type_nc" name="type_nc" required>
                                    <option value="Engineering">Engineering</option>
                                    <option value="Road Safety">Road Safety</option>
                                    <option value="Method">Method</option>
                                    <option value="PPE">PPE</option>
                                </select>
                            </div>

                            <!-- Lomba Type NC -->
                            <div class="mb-3">
                                <label for="hpi" class="form-label">HPI</label>
                                <select class="form-control" id="hpi" name="hpi" required>
                                    <option value="HPI">HPI</option>
                                    <option value="No-HPI">No-HPI</option>

                                </select>
                            </div>

                            <!-- Lomba Pengawas -->
                            <div class="mb-3">
                                <label for="pengawas" class="form-label">Pengawas</label>
                                <input type="text" class="form-control" id="pengawas" name="pengawas" required>
                            </div>

                            <!-- Lomba Action Plan -->
                            <div class="mb-3">
                                <label for="action_plan" class="form-label">Action Plan</label>
                                <input type="text" class="form-control" id="action_plan" name="action_plan" required>
                            </div>

                            <!-- Lomba NIK -->
                            <div class="mb-3">
                                <label for="nik" class="form-label">NIK</label>
                                <input type="text" class="form-control" id="nik" name="nik" required>
                            </div>

                           

                            <!-- Lomba Gambar -->
                            <div class="mb-3">
                                <label for="gambar" class="form-label">Gambar</label>
                                <input type="file" class="form-control" id="gambar" name="gambar" size="20" required>
                            </div>

                            <!-- Lomba Status -->
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-control" id="status" name="status" required>
                                    <option value="Open">Open</option>
                                    <option value="Close">Close</option>
                                </select>
                            </div>

                            <!-- Lomba Deadline -->
                            <div class="mb-3">
                                <label for="deadline" class="form-label">Deadline</label>
                                <input type="date" class="form-control" id="deadline" name="deadline" required>
                            </div>

                            <!-- Lomba Planed -->
                            <div class="mb-3">
                                <label for="planed" class="form-label">Planed</label>
                                <select class="form-control" id="planed" name="planed" required>
                                    <option value="Planed">Planed</option>
                                    <option value="Unplaned">Unplaned</option>
                                </select>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-primary">Simpan Lomba</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function populateEstates() {
            var region = document.getElementById('region').value;
            var estateDropdown = document.getElementById('estate');
            var estateDiv = document.getElementById('estateDiv');
            estateDropdown.innerHTML = ''; // Clear existing options

            if (region === 'West') {
                estateDiv.style.display = 'block';
                var estates = {
                    'Langgam': 'Langgam',
                    'Teso': 'Teso',
                    'Logas': 'Logas',
                    'Nagodang': 'Nagodang',
                    'Ukui': 'Ukui'
                };

                // Populate the dropdown with estates
                for (var key in estates) {
                    var option = document.createElement('option');
                    option.value = key;
                    option.text = estates[key];
                    estateDropdown.add(option);
                }
            } else if (region === 'North') {
                estateDiv.style.display = 'block';
                var estates = {
                    'Mandau': 'Mandau',
                    'Pulau Padang': 'Pulau Padang',
                    'Rangsang': 'Rangsang',
                    'Seraya': 'Seraya',
                    'Serapung': 'Serapung'
                };

                // Populate the dropdown with estates
                for (var key in estates) {
                    var option = document.createElement('option');
                    option.value = key;
                    option.text = estates[key];
                    estateDropdown.add(option);
                }
            } else if (region === 'East') {
                estateDiv.style.display = 'block';
                var estates = {
                    'Bayas': 'Bayas',
                    'Merbau': 'Merbau',
                    'Meranti': 'Meranti',
                    'Pelalawan & Tasik Belat': 'Pelalawan & Tasik Belat',
                    'Tasik': 'Tasik'
                };

                // Populate the dropdown with estates
                for (var key in estates) {
                    var option = document.createElement('option');
                    option.value = key;
                    option.text = estates[key];
                    estateDropdown.add(option);
                }
            } else if (region === 'South') {
                estateDiv.style.display = 'block';
                var estates = {
                    'Baserah': 'Baserah',
                    'Ceranti': 'Ceranti',
                    'Penarap': 'Penarap',
                    'Sei Lanjut': 'Sei Lanjut',
                    'Lubuk Jambi': 'Lubuk Jambi',
                    'Sijunjung': 'Sijunjung'
                };

                // Populate the dropdown with estates
                for (var key in estates) {
                    var option = document.createElement('option');
                    option.value = key;
                    option.text = estates[key];
                    estateDropdown.add(option);
                }
            } else if (region === 'North West') {
                estateDiv.style.display = 'block';
                var estates = {
                    'Pasir Pengaraian': 'Pasir Pengaraian',
                    'Padang Lawas': 'Padang Lawas',
                    'Garingging': 'Garingging',
                    'Sei Kebaro': 'Sei Kebaro',
                    'Rupat': 'Rupat',
                    'Libo': 'Libo'
                };

                // Populate the dropdown with estates
                for (var key in estates) {
                    var option = document.createElement('option');
                    option.value = key;
                    option.text = estates[key];
                    estateDropdown.add(option);
                }
            } else {
                estateDiv.style.display = 'none';
            }
        }

        function setDeadline() {
            // Mendapatkan tanggal saat ini
            var userDate = new Date(document.getElementById('tanggal').value);

            // Menambahkan 7 hari ke tanggal saat ini
            userDate.setDate(userDate.getDate() + 7);

            // Mendapatkan tahun, bulan, dan tanggal dari deadline
            var year = userDate.getFullYear();
            var month = ('0' + (userDate.getMonth() + 1)).slice(-2); // Ditambah 1 karena bulan dimulai dari 0
            var day = ('0' + userDate.getDate()).slice(-2);

            // Format tanggal yang akan diisi ke dalam input
            var formattedDeadline = year + '-' + month + '-' + day;

            // Mengisi nilai input deadline dengan tanggal yang sudah dihitung
            document.getElementById('deadline').value = formattedDeadline;
        }

        // Panggil fungsi setDeadline() saat halaman dimuat
        window.onload = setDeadline;

        // Validasi untuk memastikan region dipilih sebelum mengirimkan formulir
        function validateForm() {
            var region = document.getElementById('region').value;
            if (region === '') {
                alert('Silakan pilih region terlebih dahulu!');
                return false;
            }
        }
    </script>

</body>

</html>