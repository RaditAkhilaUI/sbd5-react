<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Mahasiswa</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">CRUD Mahasiswa</h1>
        <div class="row mt-5">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Tambah Data</div>
                    <div class="card-body">
                        <form id="addForm">
                            <div class="form-group">
                                <input type="text" class="form-control" id="nim" placeholder="NIM" required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="nama" placeholder="Nama" required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="semester" placeholder="Semester" required>
                            </div>
                            <button type="submit" class="btn btn-success">Tambah Data</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Hapus Data</div>
                    <div class="card-body">
                        <form id="deleteForm">
                            <div class="form-group">
                                <input type="text" class="form-control" id="deleteNim" placeholder="NIM" required>
                            </div>
                            <button type="submit" class="btn btn-danger">Hapus Data</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Tampilkan Data</div>
                    <div class="card-body">
                        <button id="showData" class="btn btn-info">Tampilkan Data</button>
                        <div id="dataContainer" class="mt-3"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function() {
            // Add data
            $('#addForm').submit(function(e) {
                e.preventDefault();
                $.post('insert.php', {
                    nim: $('#nim').val(),
                    nama: $('#nama').val(),
                    semester: $('#semester').val()
                }, function(response) {
                    alert(response);
                    $('#nim').val('');
                    $('#nama').val('');
                    $('#semester').val('');
                });
            });

            // Delete data
            $('#deleteForm').submit(function(e) {
                e.preventDefault();
                $.post('delete.php', {
                    nim: $('#deleteNim').val()
                }, function(response) {
                    alert(response);
                    $('#deleteNim').val('');
                });
            });

            // Show data
            $('#showData').click(function() {
                $.get('read.php', function(response) {
                    $('#dataContainer').html(response);
                });
            });
        });
    </script>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Connect to database (assuming you have a connection already)
        $conn = mysqli_connect("localhost", "username", "password", "database_name");
        
        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        
        // INSERT data
        if (isset($_POST["nim"], $_POST["nama"], $_POST["semester"])) {
            $nim = $_POST["nim"];
            $nama = $_POST["nama"];
            $semester = $_POST["semester"];
            
            $sql = "INSERT INTO mahasiswa (nim, nama, semester) VALUES ('$nim', '$nama', '$semester')";
            
            if (mysqli_query($conn, $sql)) {
                echo "<script>alert('Data inserted successfully');</script>";
            } else {
                echo "<script>alert('Error inserting data');</script>";
            }
        }

        // DELETE data
        if (isset($_POST["nim"])) {
            $nim = $_POST["nim"];
            
            $sql = "DELETE FROM mahasiswa WHERE nim='$nim'";
            
            if (mysqli_query($conn, $sql)) {
                echo "<script>alert('Data deleted successfully');</script>";
           
            }
        }
    }
