<?php include 'auth.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo $_SESSION['csrf_token']; ?>">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdN2eR5A==" crossorigin="anonymous" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <title>Data Anggota</title>
</head>
<body>
    <nav class="navbar navbar-dark bg-primary">
        <a class="navbar-brand" href="index.php" style="color: #fff;">
            CRUD Dengan Ajax
        </a>
    </nav>
    <div class="container">
        <h2 align="center" style="margin: 30px;">Data Anggota</h2>
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#form-data">
            Tambah Data
        </button>
        <div class="modal fade" id="form-data" role="dialog">
            <div class="modal-dialog">
                <form id="data-form">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Form Data Anggota</h5>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="hidden" name="id" id="id">
                                <label for="nama">Nama:</label>
                                <input type="text" name="nama" id="nama" class="form-control" required="true">
                            </div>
                            <div class="form-group">
                                <label>Jenis Kelamin:</label><br>
                                <input type="radio" name="jenis_kelamin" id="jenis_kelamin" value="L" required="true"> Laki-Laki
                                <input type="radio" name="jenis_kelamin" id="jenis_kelamin" value="P"> Perempuan
                            </div>
                            <div class="form-group">
                                <label>Alamat:</label>
                                <textarea name="alamat" id="alamat" class="form-control" required="true"></textarea>
                            </div>
                            <div class="form-group">
                                <label>No Telepon:</label>
                                <input type="text" name="no_telp" id="no_telp" class="form-control" required="true">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="simpan" id="simpan" class="btn btn-primary">
                                <i class="fa fa-save"></i> Simpan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div id="data">
        </div>
        <div class="text-center" style="margin: 20px;">
            Copyright © <?php echo date('Y'); ?>. Codelgniter, Sendi Dwi Saputro
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $.ajaxSetup({
                data: {
                    'csrf-token': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#data').load('data.php');
        });
    </script>
</body>
</html>