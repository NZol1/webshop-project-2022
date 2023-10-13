<?php
require_once($_SERVER['DOCUMENT_ROOT']."/Webshop/scripts/php/config.php");
$conn = new mysqli("localhost", "root", "", "webshopdb");
$conn -> set_charset("utf8");

if($conn->connect_error)
    die("Nem sikerült kapcsolódni az adatbázishoz".$conn->connect_error);



    
    //***** Adatbázishoz kapcsolódó eljárások ********
// felhasználó hozzáadása az adatbázishoz
function AddUser(array $user){
    global $conn;
    $stmt = $conn -> prepare("INSERT INTO felhasznalok(vezeteknev, keresztnev, felhasznalonev, jelszo, email, ad ) VALUES (?,?,?,?,?,?)");
    $stmt -> bind_param("sssssi",$user['lastName'], $user['firstName'], $user['userName'], $user['userPass'], $user['userEmail'], $user['isAdmin']);
    $stmt -> execute();
    unset($_POST);
    SetMessage("A regisztráció sikeres!");
    Redirect("");
    die();

}
function ModifyData($key,$value,$user){
    global $conn;
        $type=gettype($value);
        switch($key){
            case "firstName":
                $stmt = $conn->prepare("UPDATE felhasznalok SET keresztnev=? WHERE felhasznalonev =?");
                $stmt->bind_param("ss", $value,$user);
                break;
            case "lastName":
                $stmt = $conn->prepare("UPDATE felhasznalok SET vezeteknev=? WHERE felhasznalonev =?");
                $stmt->bind_param("ss", $value,$user);
                break;
            case "userEmail":
                $stmt = $conn->prepare("UPDATE felhasznalok SET email=? WHERE felhasznalonev =?");
                $stmt->bind_param("ss", $value,$user);
                break;
            case "phoneNumber":
                $stmt = $conn->prepare("UPDATE felhasznalok SET telefonszam=? WHERE felhasznalonev =?");
                $stmt->bind_param("is", $value,$user);
                break;
            case "userCity":
                $stmt = $conn->prepare("UPDATE felhasznalok SET varos=? WHERE felhasznalonev =?");
                $stmt->bind_param("ss", $value,$user);
                break;
            case "userStreet":
                $stmt = $conn->prepare("UPDATE felhasznalok SET utca=? WHERE felhasznalonev =?");
                $stmt->bind_param("ss", $value,$user);
                break;
            case "doorNumber":
                $stmt = $conn->prepare("UPDATE felhasznalok SET hazszam=? WHERE felhasznalonev =?");
                $stmt->bind_param("ss", $value,$user);
                break;
            case "zipNumber":
                $stmt = $conn->prepare("UPDATE felhasznalok SET iranyitoszam=? WHERE felhasznalonev =?");
                $stmt->bind_param("is", $value,$user);
                break;
        }
    $stmt->execute();
   
}


//keresés az adatbázisban a megadott e-mail címre
function FindEmail($userEmail){
    global $conn;
    $stmt = $conn -> prepare ("SELECT * FROM felhasznalok WHERE email =?");
    $stmt -> bind_param("s", $userEmail);
    $stmt -> execute();
    return $stmt->get_result();
}
//keresés az adatbázisban a megadott felhasználónévre
function FindUserName($userName){
    global $conn;
    $stmt = $conn -> prepare ("SELECT * FROM felhasznalok WHERE  felhasznalonev=?");
    $stmt -> bind_param("s", $userName);
    $stmt -> execute();
    return $stmt->get_result();
}
//keresés az adatbázisban a megadott jelszóra 
function FindPassword($password){
    global $conn;
    $pass = md5($password);
    $stmt = $conn->prepare("SELECT * FROM felhasznalok WHERE jelszo=?");
    $stmt->bind_param("s",$pass);
    $stmt->execute();
    return $stmt->get_result();
} 
//termék keresése az adatbázisban (a keresés az összes mezőben keresi a megadott kifejezést)
function SearchProduct ($key){
    global $conn;
    $search = "%$key%";
    $stmt = $conn->prepare("SELECT * FROM termekek WHERE termeknev LIKE ? OR kategoria LIKE ?");
    $stmt -> bind_param("ss", $search, $search);
    $stmt -> execute();
    return $stmt->get_result();
}

//visszakapott adatok sorokra bontása
function Fetch($result){
        $row= $result->fetch_assoc();
    return $row;
}
//akciós termékek keresése az adatbázisban
function OnSale(){
    global $conn;
    $stmt= $conn->prepare("SELECT * FROM termekek WHERE akcio >0");
    $stmt->execute();
    return $stmt->get_result();
}
//termék keresése azonosító alapján
function GetItem($id){
    global $conn;
    $stmt=$conn->prepare("SELECT * FROM termekek where cikkszam=?");
    $stmt->bind_param("s", $id);
    $stmt->execute();
    return $stmt->get_result();

}
//összes termék lekérdezése
function AllProducts(){
global $conn;
$stmt= $conn->prepare("SELECT * FROM termekek");
$stmt->execute();
return $stmt->get_result();
}

//Népszerű termékek keresése az adatbázisban
function TopFiveProduct(){
    global $conn;
    $stmt=$conn->prepare("SELECT termek, COUNT(termek) AS occurence FROM vasarlasok GROUP BY termek ORDER BY occurence DESC LIMIT 5");
    $stmt->execute();
    return $stmt->get_result();
}
//legnagyobb összegben vásárló látogatók
function MostPayments(){
    global $conn;
    $stmt=$conn ->prepare("SELECT DISTINCT felhasznalonev, SUM(ar) as ossz FROM vasarlasok GROUP BY felhasznalonev ORDER BY ossz DESC");
    $stmt->execute();
    return $stmt->get_result();
}
function InsertData($cikkszam, $termeknev, $rleiras, $tleiras, $keszlet, $ar, $akcio, $kep, $kategoria){
    global $conn;
    $stmt=$conn->prepare("INSERT INTO termekek(cikkszam, termeknev, rleiras, tleiras, keszlet, ar, akcio, kep, kategoria)
    VALUES(?,?,?,?,?,?,?,?,?)");
    $stmt->bind_param("ssssiiiss", $cikkszam, $termeknev, $rleiras, $tleiras, $keszlet, $ar, $akcio, $kep, $kategoria);
    $stmt->execute();
    $stmt->close();
}
?>