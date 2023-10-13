
    <?php
    require_once($_SERVER['DOCUMENT_ROOT']."/Webshop/scripts/includes/header.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/Webshop/scripts/includes/navigation.php");
    ToCart();?>
<main>
 <?php 
    if(isset($_GET["id"])){
        $result = GetItem($_GET['id']);
         while ($row = Fetch($result))
            createDescription($row);
            }
            ?>

                            
</main>
<?php
    if (isset($_POST['item-id'])){
        Redirect("");
    }
    require_once($_SERVER['DOCUMENT_ROOT']."/Webshop/scripts/includes/footer.php");
?>
