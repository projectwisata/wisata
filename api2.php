<?php
error_reporting(0);
include "config.php";

$auth = $_GET['auth']; //888 sehingga hanya orang yang diberi akses yang dapat masuk.
$perintah=$_GET['perintah'];
$username=$_GET['username'];
$password=$_GET['password'];
$nama=$_GET['nama'];
$id_pengunjung = $_GET['id_pengunjung'];

if($auth == "888"){

if (!empty($_GET) && $perintah=="loginPng"+username+"&pass="+password) {
    $user = $_GET['username'];
    $pass = $_GET['password'];

    $result = mysqli_query($conn,  "SELECT FROM pengunjung WHERE user = '$username'");
}

if (!empty($_GET) && $perintah=="insert") {

    $sql = "INSERT INTO pengunjung (username, password, nama) VALUES ('". $username. "', '".$password."', '".$nama."')";
    echo"<br>";
    echo $sql;

    if (mysqli_query($conn, $sql)) {
        echo "<br>";
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

}

if (!empty($_GET) && $perintah=="update") {

    $sql = "UPDATE pengunjung SET nama='$nama' WHERE username=$username";
    echo"<br>";
    echo $sql;

    if (mysqli_query($conn, $sql)) {
        echo "<br>";
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }

}

if (!empty($_GET) && $perintah=="delete") {

    $sql = "delete from pengunjung where id_pengunjung=".$id_pengunjung;
    echo"<br>";
    echo $sql;

    if (mysqli_query($conn, $sql)) {
        echo "<br>";
        echo "Record has been deleted";
    } else {
        echo "Error updating record: " . $conn->error;
    }

}


$return_arr = array(); 
$sql = "SELECT id, username, nama, password FROM pengunjung";
$result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            //echo "<br>"; sebelum ada json dan hasilnya akan turun
            //echo "id= ". $row["id"]. ", npm= ". $row["npm"]. ", nama = ".$row["nama"];
            //echo "id = $row['id'] , npm= $row['npm']";
            
            $row_array['id_pengunjung'] = $row['id_pengunjung'];
            $row_array['username'] = $row['username'];
            $row_array['password'] = $row['password'];
            $row_array['nama'] = $row['nama'];

            array_push($return_arr,$row_array);
        }
        echo json_encode($return_arr);
    } else {
            echo "0 results";
    }

$conn->close();

}

?>