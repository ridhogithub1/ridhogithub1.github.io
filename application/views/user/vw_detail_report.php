<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Report</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <center>
            <h1>Detail Report</h1>
        </center>
        <?php if (!empty($report)) : ?>
            
            <table class="table">
                <tbody>
                    <tr>
                        <th scope="row">ID</th>
                        <td><?= $report['id']; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Bulan</th>
                        <td><?= $report['bulan']; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Tanggal</th>
                        <td><?= $report['tanggal']; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Estate</th>
                        <td><?= $report['estate']; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Region</th>
                        <td><?= $report['region']; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Location</th>
                        <td><?= $report['location']; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Department</th>
                        <td><?= $report['department']; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Kegiatan</th>
                        <td><?= $report['kegiatan']; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Perusahaan/Kontraktor</th>
                        <td><?= $report['kontraktor']; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Inspektor/Pelapor</th>
                        <td><?= $report['inspector']; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Planed</th>
                        <td><?= $report['planed']; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Jenis Pelanggaran Nosa</th>
                        <td><?= $report['jenis_pelanggaran_nosa']; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">HPI</th>
                        <td><?= $report['hpi']; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Type NC</th>
                        <td><?= $report['type_nc']; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Deadline</th>
                        <td><?= $report['deadline']; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Hari Open</th>
                        <td><?= $report['hari_open']; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Gambar</th>
                        <td><?= $report['gambar']; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Pengawas</th>
                        <td><?= $report['pengawas']; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Action Plan</th>
                        <td><?= $report['action_plan']; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">SAP/NIK</th>
                        <td><?= $report['nik']; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Status</th>
                        <td><?= $report['status']; ?></td>
                    </tr>
                </tbody>
            </table>
        <?php else : ?>
            <p>Tidak ada laporan yang ditemukan.</p>
        <?php endif; ?>
    </div>
</body>

</html>
