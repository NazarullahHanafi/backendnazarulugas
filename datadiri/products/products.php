<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET,POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


$service = "localhost"; $username = "root"; $password = ""; $name = "datadiri";
$koneksiDB = new mysqli($service, $username, $password, $name);


if (isset($_GET["select"])){
    $query = mysqli_query($koneksiDB,"SELECT * FROM products WHERE id=".$_GET["select"]);
    if(mysqli_num_rows($query) > 0){
        $products = mysqli_fetch_all($query,MYSQLI_ASSOC);
        echo json_encode($products);
        exit();
    }
    else{  echo json_encode(["success"=>0]); }
}

if (isset($_GET["delete"])){
    $query = mysqli_query($koneksiDB,"DELETE FROM products WHERE id=".$_GET["delete"]);
    if($query){
        echo json_encode(["success"=>1]);
        exit();
    }
    else{  echo json_encode(["success"=>0]); }
}

if(isset($_GET["tambah"])){
    $data = json_decode(file_get_contents("php://input"));
    $nim=$_POST['nim'];
    $nama=$_POST['nama'];
    $alamat=$_POST['alamat'];
    $foto_tmp = $_FILES['foto']['tmp_name'];
    $nama_foto = $_FILES['foto']['name'];

    move_uploaded_file($foto_tmp, 'foto/'.$nama_foto);
  
        if(($nim!="")||($nama!="")||($alamat!="")||($nama_foto!="")){
            
    $query = mysqli_query($koneksiDB,"INSERT INTO products(nim,nama,alamat,foto) VALUES('$nim','$nama','$alamat','$nama_foto') ");
    echo json_encode(["success"=>1]);
        }
    exit();
}

if(isset($_GET["update"])){
    
    $data = json_decode(file_get_contents("php://input"));

    $id=(isset($data->id))?$data->id:$_GET["update"];
    $nim=$data->nim;
    $nama=$data->nama;
    $alamat=$data->alamat;
    $foto_tmp = $_FILES['foto']['tmp_name'];
    $nama_foto = $_FILES['foto']['name'];
    
    $query = mysqli_query($koneksiDB,"UPDATE products SET nim='$nim',nama='$nama',alamat='$alamat',foto='$nama_foto' WHERE id='$id'");
    echo json_encode(["success"=>1]);
    exit();
}

$query = mysqli_query($koneksiDB,"SELECT * FROM products ");
if(mysqli_num_rows($query) > 0){
    $products = mysqli_fetch_all($query,MYSQLI_ASSOC);
    echo json_encode($products);
}
else{ echo json_encode([["success"=>0]]); }
