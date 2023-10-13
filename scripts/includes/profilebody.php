<?php

    if($_SERVER['REQUEST_METHOD']=="POST")
    ModifyUser($_POST);
    $user = unserialize($_SESSION['user']);
?>
<div class="container-fluid align-items-center my-5">
    <div class="row">
        <div class="col-12 my-5">
            <div class="card">
                <div class="card-header bg-secondary" id ="override-nav">
                    <h2>Felhasználó Adatai</h2>
                </div>
                <div class="card-body">
                        <label for="base-data" class="form-label">Alapadatok</label>
                        <div class ='input-group mb-2' id='base-data'>
                        <form class="container-fluid mb-2" method="post" action="profile.php">
                            <div class="input-group" >
                                <button class="btn btn-warning" type="submit">Megváltoztatom</button>
                                <input class="form-control w-25" type="text" placeholder="Vezetéknév" name = "lastName">
                                <input class="form-control w-25" type="text" placeholder="<?php echo"$user->lastName"?>" disabled>
                            </div>
                        </form>
                        <form class="container-fluid mb-2" method="post" action="profile.php">
                            <div class="input-group" >
                                <button class="btn btn-warning" type="submit">Megváltoztatom</button>
                                <input class="form-control w-25" type="text" placeholder="Keresztnév" name = "firstName">
                                <input class="form-control w-25" type="text" placeholder="<?php echo"$user->firstName"?>" disabled>
                            </div>
                        </form>
                        <form class="container-fluid mb-2" method="post" action="profile.php">
                            <div class="input-group" >
                                <button class="btn btn-warning" type="submit">Megváltoztatom</button>
                                <input class="form-control w-25" type="text" placeholder="E-mail cím" name = "userEmail">
                                <input class="form-control w-25" type="text" placeholder="<?php echo"$user->userEmail"?>" disabled>
                            </div>
                        </form>
                        <form class="container-fluid mb-2" method="post" action="profile.php">
                            <div class="input-group" >
                                <button class="btn btn-warning" type="submit">Megváltoztatom</button>
                                <input class="form-control w-25" type="text" placeholder="Telefonszám (pl.: 06201234567)" name = "phoneNumber">
                                <input class="form-control w-25" type="text" placeholder="<?php echo $user->phoneNumber ?>" disabled>
                            </div>
                        </form>
                        <label for="shipment-data" class="form-label">Számlázási adatok</label>
                        <div class ='input-group mb-2' id='shipment-data'>
                        <form class="container-fluid mb-2" method="post" action="profile.php">
                            <div class="input-group" >
                                <button class="btn btn-warning" type="submit">Megváltoztatom</button>
                                <input class="form-control w-25" type="text" placeholder="Város" name = "userCity">
                                <input class="form-control w-25" type="text" placeholder="<?php echo"$user->userCity"?>" disabled>
                            </div>
                        </form>
                        <form class="container-fluid mb-2" method="post" action="profile.php">
                            <div class="input-group" >
                                <button class="btn btn-warning" type="submit">Megváltoztatom</button>
                                <input class="form-control w-25" type="text" placeholder="Utca" name = "userStreet">
                                <input class="form-control w-25" type="text" placeholder="<?php echo"$user->userStreet"?>" disabled>
                            </div>
                        </form>
                        <form class="container-fluid mb-2" method="post" action="profile.php">
                            <div class="input-group" >
                                <button class="btn btn-warning" type="submit">Megváltoztatom</button>
                                <input class="form-control w-25" type="text" placeholder="Házszám" name = "doorNumber">
                                <input class="form-control w-25" type="text" placeholder="<?php echo"$user->doorNumber"?>" disabled>
                            </div>
                        </form>
                        <form class="container-fluid mb-2" method="post" action="profile.php">
                            <div class="input-group" >
                                <button class="btn btn-warning" type="submit">Megváltoztatom</button>
                                <input class="form-control w-25" type="text" placeholder="Irányítószám" name = "zipNumber">
                                <input class="form-control w-25" type="text" placeholder="<?php echo"$user->zipNumber"?>" disabled>
                            </div>
                        </form>
                </div>
            </div>
        </div>
</div>
