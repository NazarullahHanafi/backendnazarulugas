<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET,POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


$service = "localhost"; $username = "root"; $password = ""; $name = "datadiri";
$koneksiDB = new mysqli($service, $username, $password, $name);


if (isset($_GET["select"])){
    $query = mysqli_query($koneksiDB,"SELECT * FROM tb_pdd WHERE id=".$_GET["select"]);
    if(mysqli_num_rows($query) > 0){
        $tb_pdd = mysqli_fetch_all($query,MYSQLI_ASSOC);
        echo json_encode($tb_pdd);
        exit();
    }
    else{  echo json_encode(["success"=>0]); }
}

if (isset($_GET["delete"])){
    $query = mysqli_query($koneksiDB,"DELETE FROM tb_pdd WHERE id=".$_GET["delete"]);
    if($query){
        echo json_encode(["success"=>1]);
        exit();
    }
    else{  echo json_encode(["success"=>0]); }
}

if(isset($_GET["tambah"])){
    $data = json_decode(file_get_contents("php://input"));
    $nik=$data->nik;
    $nama=$data->nama;
    $tempat_lh=$data->tempat_lh;
    $tgl_lh=$data->tgl_lh;
    $jekel=$data->jekel;
    $desa=$data->desa;
    $agama=$data->agama;
        if(($nik!="")||($nama!="")||($tempat_lh!="")||($tgl_lh!="")||($jekel!="")||($desa!="")||($agama!="")){
            
    $query = mysqli_query($koneksiDB,"INSERT INTO tb_pdd(nik,nama,tempat_lh,tgl_lh,jekel,desa,agama) VALUES('$nik','$nama','$tempat_lh','$tgl_lh','$jekel','$desa','$agama') ");
    echo json_encode(["success"=>1]);
        }
    exit();
}

if(isset($_GET["update"])){
    
    $data = json_decode(file_get_contents("php://input"));

    $id=(isset($data->id))?$data->id:$_GET["update"];
    $nik=$data->nik;
    $nama=$data->nama;
    $tempat_lh=$data->tempat_lh;
    $tgl_lh=$data->tgl_lh;
    $jekel=$data->jekel;
    $desa=$data->desa;
    $agama=$data->agama;
    
    $query = mysqli_query($koneksiDB,"UPDATE tb_pdd SET nik='$nik',nama='$nama',tempat_lh='$tempat_lh',tgl_lh='$tgl_lh',jekel='$jekel',desa='$desa',agama='$agama' WHERE id='$id'");
    echo json_encode(["success"=>1]);
    exit();
}

$query = mysqli_query($koneksiDB,"SELECT * FROM tb_pdd ");
if(mysqli_num_rows($query) > 0){
    $tb_pdd = mysqli_fetch_all($query,MYSQLI_ASSOC);
    echo json_encode($tb_pdd);
}
else{ echo json_encode([["success"=>0]]); }
