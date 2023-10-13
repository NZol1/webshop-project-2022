<main>
    <div class="container-fluid" style=" position:relative; top:6.5vh;"> 
        <div class="row px-5">
            <div class="col-md-7 col-sm-12 text-center" style="max-height:700px; overflow-x:hidden; overflow-y:scroll;">           
                <div class="s-cart">
                    <h6>Kosár</h6>
                    <hr>
                     <?php PopulateCart();?>
                     <?php CartAction();?>

                     
                </div>
            </div>
            <div class="col-md-4 offset md-1 border rounded mt-5 h-25">
                <div class="pt-4 text-center">
                    <h6>MEGRENDELÉS RÉSZLETEI</h6>
                    <hr>
                    <div class="row">
                        <div class="col text-center"><?php TotalNumber()?> termék a kosárban
                            <h6>Nettó összérték: <?php NetPrice()?></h6> 
                            <hr>
                            <h6>Fizetendő: <?php echo number_format(TotalPrice(), "0", ",", " ")?> Ft</h6>
                        </div>
                    </div>                 
                </div>
                <form action="cart.php?action=empty_cart" method="post">
                    <button type="submit" name="empty_cart" class="btn btn-danger w-100 my-5">Kosár törlése</button>
                </form>
                <form action="cart.php?action=finalize" method="post">
                <button type="submit" name="finalize" class="btn btn-success w-100 my-5">Véglegesítés</button>
                </form>
            </div>
        </div>
    </div>

</main>