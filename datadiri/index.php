<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET,POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


$service = "localhost"; $username = "root"; $password = ""; $name = "datadiri";
$koneksiDB = new mysqli($service, $username, $password, $name);


if (isset($_GET["select"])){
    $query = mysqli_query($koneksiDB,"SELECT * FROM datadiri WHERE id=".$_GET["select"]);
    if(mysqli_num_rows($query) > 0){
        $datadiri = mysqli_fetch_all($query,MYSQLI_ASSOC);
        echo json_encode($datadiri);
        exit();
    }
    else{  echo json_encode(["success"=>0]); }
}

if (isset($_GET["delete"])){
    $query = mysqli_query($koneksiDB,"DELETE FROM datadiri WHERE id=".$_GET["delete"]);
    if($query){
        echo json_encode(["success"=>1]);
        exit();
    }
    else{  echo json_encode(["success"=>0]); }
}

if(isset($_GET["tambah"])){
    $data = json_decode(file_get_contents("php://input"));
    $nama=$data->nama;
    $email=$data->email;
    $agama=$data->agama;
    $ttl=$data->ttl;
    $tanggal=$data->tanggal;
    $alamat=$data->alamat;
        if(($nama!="")||($email!="")||($agama!="")||($ttl!="")||($tanggal!="")||($alamat!="")){
            
    $query = mysqli_query($koneksiDB,"INSERT INTO datadiri(nama,email,agama,ttl,tanggal,alamat) VALUES('$nama','$email','$agama','$ttl','$tanggal','$alamat') ");
    echo json_encode(["success"=>1]);
        }
    exit();
}

if(isset($_GET["update"])){
    
    $data = json_decode(file_get_contents("php://input"));

    $id=(isset($data->id))?$data->id:$_GET["update"];
    $nama=$data->nama;
    $email=$data->email;
    $agama=$data->agama;
    $ttl=$data->ttl;
    $tanggal=$data->tanggal;
    $alamat=$data->alamat;
    
    $query = mysqli_query($koneksiDB,"UPDATE datadiri SET nama='$nama',email='$email',agama='$agama',ttl='$ttl',tanggal='$tanggal',alamat='$alamat' WHERE id='$id'");
    echo json_encode(["success"=>1]);
    exit();
}

$query = mysqli_query($koneksiDB,"SELECT * FROM datadiri ");
if(mysqli_num_rows($query) > 0){
    $datadiri = mysqli_fetch_all($query,MYSQLI_ASSOC);
    echo json_encode($datadiri);
}
else{ echo json_encode([["success"=>0]]); }
