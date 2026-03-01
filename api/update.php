<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT");

if ($_SERVER['REQUEST_METHOD'] !== 'PUT') {
    http_response_code(405);
    echo json_encode(["message" => "Method tidak diizinkan."]);
    exit;
}

include_once '../config/Database.php';
include_once '../models/Mahasiswa.php';

$database = new Database();
$db = $database->getConnection();
$mahasiswa = new Mahasiswa($db);

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->id) && !empty($data->npm) && !empty($data->nama) && !empty($data->jurusan)) {
    $mahasiswa->id = $data->id;
    $mahasiswa->npm = $data->npm;
    $mahasiswa->nama = $data->nama;
    $mahasiswa->jurusan = $data->jurusan;

    if ($mahasiswa->update()) {
        http_response_code(200);
        echo json_encode(["message" => "Data mahasiswa berhasil diperbarui."]);
    } else {
        http_response_code(503);
        echo json_encode(["message" => "Gagal memperbarui data."]);
    }
} else {
    http_response_code(400);
    echo json_encode(["message" => "Data tidak lengkap. ID dan field lainnya harus diisi."]);
}
?>