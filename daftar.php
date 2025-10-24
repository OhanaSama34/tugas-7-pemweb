<?php
header('Content-Type: text/html; charset=utf-8');

$nama_depan = '';
$nama_belakang = '';
$umur = '';
$asal_kota = '';
$is_valid = false;
$umur_int = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {

    $nama_depan = htmlspecialchars($_POST['nama_depan']);
    $nama_belakang = htmlspecialchars($_POST['nama_belakang']);
    $umur = htmlspecialchars($_POST['umur']);
    $asal_kota = htmlspecialchars($_POST['asal_kota']);

   if (!empty($nama_depan) && !empty($nama_belakang) && !empty($umur) && !empty($asal_kota)) {
        
        $umur_int = intval($umur);
        if ($umur_int < 10) {
            $is_valid = false;
            $error_message_text = 'Error: Umur tidak boleh kurang dari 10 tahun!';
        } else {
            $is_valid = true;
        }

    } else {
        $is_valid = false;
        $error_message_text = 'Error: Semua data wajib diisi!';
    }
}
?>
<html>
    <head>
        <title>::Data Registrasi::</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style type="text/css">
            body{
                display: flex;
                justify-content: center;
                align-items: center;
                min-height: 100vh;
                background-size: cover;
                background-position: center; /* Menambahkan posisi background */
                background-image: url("https://cdn.arstechnica.net/wp-content/uploads/2023/06/bliss-update-1440x960.jpg");
                font-family: Arial, Helvetica, sans-serif;
                margin: 0;
                padding: 20px;
                box-sizing: border-box; /* Menambahkan box-sizing */
            }
            .container{
                background-color: white;
                border: 3px solid grey;
                padding: 30px;
                border-radius: 10px;
                box-shadow: 0 4px 8px rgba(0,0,0,0.1);
                max-width: 600px;
                width: 100%;
            }
            h1{
                text-align: center;
                color: #333;
                margin-top: 0; /* Menghapus margin atas */
                margin-bottom: 30px;
                font-size: 28px;
            }
            .success-message{
                background-color: #d4edda;
                color: #155724;
                padding: 15px;
                margin-bottom: 20px;
                border: 1px solid #c3e6cb;
                border-radius: 5px;
                text-align: center;
                font-weight: bold;
            }
            /* Menambahkan style untuk pesan error */
            .error-message{
                background-color: #f8d7da;
                color: #721c24;
                padding: 15px;
                margin-bottom: 20px;
                border: 1px solid #f5c6cb;
                border-radius: 5px;
                text-align: center;
                font-weight: bold;
            }
            table{
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 20px;
            }
            th, td{
                padding: 12px;
                text-align: left;
                border-bottom: 1px solid #ddd;
            }
            th{
                background-color: #f8f9fa;
                font-weight: bold;
                color: #333;
                /* Hapus width: 30% agar lebar kolom otomatis */
            }
            td{
                color: #666;
            }
            .back-button{
                text-align: center;
                margin-top: 20px;
            }
            .back-button a{
                background-color: #007bff;
                color: white;
                padding: 12px 24px;
                text-decoration: none;
                border-radius: 5px;
                display: inline-block;
                transition: background-color 0.3s;
            }
            .back-button a:hover{
                background-color: #0056b3;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h1>Data Registrasi User</h1>
            
            <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])): ?>
                
                <?php if ($is_valid): ?>
                    <div class="success-message">
                        Registrasi Berhasil!
                    </div>
                    <h2 style="text-align: center; color: #555; margin-bottom: 15px; font-size: 22px;">Data Registrasi</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Lengkap</th>
                                <th>Umur</th>
                                <th>Asal Kota</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($umur_int > 0) {
                                for ($i = 1; $i <= $umur_int; $i++) {

                                    if ( ($i % 2 != 0) && ($i != 7) && ($i != 13) ) {
                                        echo "<tr>";
                                        echo "<td>" . $i . "</td>";
                                        // Menggabungkan nama depan dan belakang
                                        echo "<td>" . $nama_depan . " " . $nama_belakang . "</td>";
                                        // Menambahkan kolom umur
                                        echo "<td>" . $umur_int . " tahun</td>";
                                        echo "<td>" . $asal_kota . "</td>";
                                        echo "</tr>";
                                    }
                                }
                            } else {
                                echo "<tr><td colspan='4' style='text-align:center; color: #777;'>Umur yang dimasukkan (0 atau kurang) tidak menghasilkan data ganjil.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>

                <?php else: ?>
                    <div class="error-message">
                        <?php echo $error_message_text;  ?>
                    </div>
                <?php endif; ?>

                <div class="back-button">
                    <a href="index.html">Kembali ke Form Registrasi</a>
                </div>

            <?php else: ?>

                <div style="text-align: center; color: #dc3545; padding: 20px;">
                    <h3>Error: Data tidak ditemukan</h3>
                    <p>Silakan isi form registrasi terlebih dahulu.</p>
                    <div class="back-button">
                        <a href="index.html">Kembali ke Form Registrasi</a>
                    </div>
                </div>

            <?php endif; ?>
        </div>
    </body>
</html>