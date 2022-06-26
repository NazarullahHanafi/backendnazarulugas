<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET,POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


$service = "localhost"; $username = "root"; $password = ""; $name = "datadiri";
$koneksiDB = new mysqli($service, $username, $password, $name);


if (isset($_GET["select"])){
    $query = mysqli_query($koneksiDB,"SELECT * FROM tb_kk WHERE id=".$_GET["select"]);
    if(mysqli_num_rows($query) > 0){
        $tb_kk = mysqli_fetch_all($query,MYSQLI_ASSOC);
        echo json_encode($tb_kk);
        exit();
    }
    else{  echo json_encode(["success"=>0]); }
}

if (isset($_GET["delete"])){
    $query = mysqli_query($koneksiDB,"DELETE FROM tb_kk WHERE id=".$_GET["delete"]);
    if($query){
        echo json_encode(["success"=>1]);
        exit();
    }
    else{  echo json_encode(["success"=>0]); }
}

if(isset($_GET["tambah"])){
    $data = json_decode(file_get_contents("php://input"));
    $no_kk=$data->no_kk;
    $kepala=$data->kepala;
    $desa=$data->desa;
    $kec=$data->kec;
    $kab=$data->kab;
    $prov=$data->prov;
    
      if(($no_kk!="")||($kepala!="")||($desa!="")||($kec!="")||($kab!="")||($prov!="")){            
    $query = mysqli_query($koneksiDB,"INSERT INTO tb_kk(no_kk,kepala,desa,kec,kab,prov) VALUES('$no_kk','$kepala','$desa','$kec','$kab','$prov') ");
   echo json_encode(["success"=>1]);
        }
    exit();
}

if(isset($_GET["update"])){
    
    $data = json_decode(file_get_contents("php://input"));

    $id=(isset($data->id))?$data->id:$_GET["update"];
    $no_kk=$data->no_kk;
    $kepala=$data->kepala;
    $desa=$data->desa;
    $kec=$data->kec;
    $kab=$data->kab;
    $prov=$data->prov;
    
   $query = mysqli_query($koneksiDB,"UPDATE tb_kk SET no_kk='$no_kk',kepala='$kepala',desa='$desa',kec='$kec',kab='$kab',prov='$prov' WHERE id='$id'");
    echo json_encode(["success"=>1]);
    exit();
}

$query = mysqli_query($koneksiDB,"SELECT * FROM tb_kk ");
if(mysqli_num_rows($query) > 0){
    $tb_kk = mysqli_fetch_all($query,MYSQLI_ASSOC);
    echo json_encode($tb_kk);
}
else{ echo json_encode([["success"=>0]]); }
