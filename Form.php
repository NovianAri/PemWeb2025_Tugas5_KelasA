<?php
session_start();

// Pastikan pengguna login sebelum mengakses halaman ini
if (!isset($_SESSION['user_email'])) {
    header("Location: Login.php");
    exit();
}

// Proses form ketika dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["photo"])) {
    $target_dir = __DIR__ . "/"; // Simpan foto di folder yang sama dengan file ini
    $photo_name = basename($_FILES["photo"]["name"]);
    $target_file = $target_dir . $photo_name;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Cek apakah file benar-benar gambar
    $check = getimagesize($_FILES["photo"]["tmp_name"]);
    if ($check === false) {
        echo "File bukan gambar.";
        $uploadOk = 0;
    }

    // Cek jika file sudah ada
    if (file_exists($target_file)) {
        echo "Maaf, file sudah ada.";
        $uploadOk = 0;
    }

    // Batasi tipe file
    $allowed_types = ['jpg', 'jpeg', 'png'];
    if (!in_array($imageFileType, $allowed_types)) {
        echo "Hanya file JPG, JPEG, dan PNG yang diperbolehkan.";
        $uploadOk = 0;
    }

    // Jika tidak ada masalah, simpan file
    if ($uploadOk) {
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
            $_SESSION['form_data'] = [
                'name' => $_POST['name'],
                'birth_place' => $_POST['birth_place'],
                'date' => $_POST['date'],
                'university' => $_POST['university'],
                'major' => $_POST['major'],
                'start_date' => $_POST['start_date'],
                'end_date' => $_POST['end_date'],
                'photo' => $photo_name // Simpan nama file foto
            ];
            header("Location: CV.php"); // Redirect ke halaman CV
            exit();
        } else {
            echo "Maaf, terjadi kesalahan saat mengunggah file.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Input Data</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 20px;
        }

        .form-container {
            max-width: 600px;
            margin: auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        label {
            font-weight: bold;
            display: block;
            margin: 10px 0 5px;
        }

        input, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            background-color: #007bff;
            color: white;
            padding: 10px;
            border: none;
            width: 100%;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .photo-preview {
            display: block;
            max-width: 150px;
            margin: 10px auto;
            border-radius: 50%;
            border: 2px solid #ddd;
        }
    </style>
</head>
<body>

    <div class="form-container">
        <h2>Formulir Data Diri</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <label for="name">Nama Lengkap:</label>
            <input type="text" name="name" id="name" required>

            <label for="birth_place">Tempat Lahir:</label>
            <input type="text" name="birth_place" id="birth_place" required>

            <label for="date">Tanggal Lahir:</label>
            <input type="date" name="date" id="date" required>

            <label for="university">Nama Universitas:</label>
            <input type="text" name="university" id="university" required>

            <label for="major">Jurusan/Program Studi:</label>
            <input type="text" name="major" id="major" required>

            <label for="start_date">Tanggal Mulai:</label>
            <input type="month" name="start_date" id="start_date" required>

            <label for="end_date">Tanggal Selesai:</label>
            <input type="month" name="end_date" id="end_date" required>

            <label for="photo">Upload Foto Profil:</label>
            <input type="file" name="photo" id="photo" accept="image/*" required>

            <button type="submit">Kirim</button>
        </form>
    </div>

</body>
</html>
