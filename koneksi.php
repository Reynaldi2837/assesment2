<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "costumerserviceonline";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Jika terdapat parameter 'id' dalam URL, maka proses penghapusan data
if (isset($_GET['id'])) {
    // Mendapatkan ID data yang akan dihapus dari parameter URL
    $id = $_GET['id'];

    // Query untuk menghapus data dari tabel berdasarkan ID
    $sql = "DELETE FROM costumer_service WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Data berhasil dihapus";
    } else {
        // Jangan mencetak pesan error di sini
    }
} else {
    // Query untuk mengambil data dari tabel
    $sql = "SELECT id, nama, email, pesan, alamat FROM costumer_service";
    $result = $conn->query($sql);

    // Membuat array untuk menyimpan data
    $data = array();

    // Mengambil setiap baris hasil query dan menambahkannya ke dalam array
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }

    // Mengubah array menjadi format JSON dan mencetaknya
    header('Content-Type: application/json');
    echo json_encode($data);
}

// Menutup koneksi
$conn->close();
