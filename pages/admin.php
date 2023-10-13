<?php
    require_once($_SERVER['DOCUMENT_ROOT']."/Webshop/scripts/includes/header.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/Webshop/scripts/includes/navigation.php");?>
<main>
    <?php DisplayMessage();?>
<div class="container-fluid bg-secondary" style="position:relative; top:6vh">
        <div class="row">
                <div class="longdescription col-md-10 col-sm-12 mx-auto ">
                    <div class="text-center w-100 bg-secondary">
                        <h3>Adminisztráció</h3>
                    </div>
                    <div class=" row longdesc-body my-2 mx-auto">
                        <div class="col-md-6 col-sm12 border border-secondary text-center">
                            <div class="col mx-1">
                            <h5>Statisztikák</h5>
                            <div class="stats mt-4 mx-auto">
                               <?php 
                                    TopFiveProds(TopFiveProduct()); 
                                    TopFiveCustomer(MostPayments());
                               ?>
                            </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm12 border border-secondary text-center">
                            <div class="col mx-1">
                                <h5>Adatok feltöltése</h5>
                                <div class="dataupload">
                                    <div class="mt-4">
                                        <form method="post" action="admin.php">
                                        <input type="text" class="form-control mt-1" name="cikkszam" placeholder="Termék cikkszáma" required>
                                        <input type="text" class="form-control mt-1" name="termeknev" placeholder="Termék neve" required>
                                        <textarea class="form-control mt-1" rows="3" name="rleiras" placeholder="Rövid leírás" required></textarea>
                                        <textarea class="form-control mt-1" rows="3" name="tleiras" placeholder="Teljes leírás" required></textarea>
                                        <input type="text" class="form-control mt-1" name="kep" placeholder="Termék képének címe" required>
                                        <input type="text" class="form-control mt-1" name="kategoria" placeholder="Termék kategóriája" required>
                                        <input type="number" class="form-control mt-1 w-25 d-inline-block mx-4" name="keszlet" placeholder="Készlet" required>
                                        <input type="number" class="form-control mt-1 w-25 d-inline-block mx-4" name="ar" placeholder="Ár" required>
                                        <input type="number" class="form-control mt-1 w-25 d-inline-block mx-4" name="akcio" placeholder="Akció" required>
                                        <button type="submit" name="upload" class="btn btn-outline-success my-5 w-75"> Adatok feltöltése </button>
                                        <?php
                                            if ($_SERVER["REQUEST_METHOD"]== 'POST'){
                                                if (isset($_POST["upload"]))
                                                {
                                                     InsertData($_POST["cikkszam"], $_POST["termeknev"], $_POST["rleiras"], $_POST["tleiras"], $_POST["kep"], $_POST["keszlet"], $_POST["ar"], $_POST["akcio"],$_POST["kategoria"] );
                                                }
                                                else {
                                                    die("Az adatbevitel sikertelen...");
                                                }
                                            }
                                        
                                        ?>
                                    
                                        </form>
                                    </div>

                                    <div class="mt-4">
                                        <h5>Kép feltöltése</h5>
                                        <form action="upload.php" method="post" enctype="multipart/form-data">
                                        <div class="input-group mb-5">
                                            <input type="file" class="form-control" name="imgUpload" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                                            <button class="btn btn-outline-secondary" type="submit" name="img-upload" >Feltöltés</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>  
                        </div>
                    </div>
                </div>
</main>
<?php require_once($_SERVER['DOCUMENT_ROOT']."/Webshop/scripts/includes/footer.php");?>