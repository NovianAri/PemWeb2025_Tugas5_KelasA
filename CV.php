<?php
session_start();

// Pastikan pengguna sudah login dan telah mengisi form
if (!isset($_SESSION['user_email']) || !isset($_SESSION['form_data'])) {
    header("Location: Login.php");
    exit();
}

$data = $_SESSION['form_data'];
$user_email = $_SESSION['user_email']; // Email dari halaman login

// Fungsi untuk memformat bulan dan tahun
function formatMonthYear($date) {
    if (empty($date)) return "Sekarang";
    $dateObj = DateTime::createFromFormat('Y-m', $date);
    return $dateObj ? $dateObj->format('F Y') : "Tanggal Tidak Valid";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Curriculum Vitae</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 20px;
        }

        .cv-container {
            max-width: 800px;
            margin: auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h1 {
            font-size: 28px;
            color: #333;
        }

        .header p {
            color: #666;
            margin: 5px 0;
        }

        .photo-container {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .photo-container img {
            width: 200px;
            height: 250px;
            object-fit: cover;
            border-radius: 10px;
            border: 2px solid #ddd;
        }

        .section {
            margin-bottom: 25px;
        }

        .section h2 {
            font-size: 20px;
            color: #222;
            margin-bottom: 10px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
        }

        .section p {
            color: #444;
            line-height: 1.6;
        }

        .education-item {
            margin-bottom: 20px;
            padding: 15px;
            background-color: #f6f6f6;
            border-left: 4px solid #007bff;
            border-radius: 5px;
        }

        .education-item h3 {
            margin: 0 0 5px;
            font-size: 18px;
            color: #007bff;
        }

        .education-item p {
            margin: 0 0 5px;
            color: #444;
        }

        .education-item span {
            font-size: 14px;
            color: #666;
        }

        @media (max-width: 600px) {
            .cv-container {
                padding: 20px;
            }

            .header h1 {
                font-size: 22px;
            }

            .section h2 {
                font-size: 18px;
            }

            .photo-container img {
                width: 150px;
                height: 180px;
            }
        }
    </style>
</head>
<body>
    <div class="cv-container">
        <div class="header">
            <h1><?php echo htmlspecialchars($data['name']); ?></h1>
            <p>Email: <?php echo htmlspecialchars($user_email); ?></p>
        </div>

        <div class="photo-container">
            <?php if (!empty($data['photo'])): ?>
                <img src="<?php echo htmlspecialchars($data['photo']); ?>" alt="Foto Profil">
            <?php else: ?>
                <p>Foto tidak tersedia</p>
            <?php endif; ?>
        </div>

        <div class="section">
            <h2>Detail Pribadi</h2>
            <p><strong>Nama Lengkap:</strong> <?php echo htmlspecialchars($data['name']); ?></p>
            <p><strong>Tempat Lahir:</strong> <?php echo htmlspecialchars($data['birth_place']); ?></p>
            <p><strong>Tanggal Lahir:</strong> <?php echo htmlspecialchars($data['date']); ?></p>
        </div>

        <div class="section">
            <h2>Riwayat Pendidikan</h2>
            <div class="education-item">
                <h3><?php echo htmlspecialchars($data['university']); ?></h3>
                <p><strong>Jurusan:</strong> <?php echo htmlspecialchars($data['major']); ?></p>
                <span>
                    <?php echo formatMonthYear($data['start_date']); ?> - 
                    <?php echo formatMonthYear($data['end_date']); ?>
                </span>
            </div>
        </div>
    </div>
</body>
</html>
