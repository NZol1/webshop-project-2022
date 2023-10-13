<?php require_once($_SERVER['DOCUMENT_ROOT']."/Webshop/scripts/includes/header.php");
 require_once($_SERVER['DOCUMENT_ROOT']."/Webshop/scripts/includes/navigation.php");?>
    <div class="row resultstage">
    <?php 
    ToCart();
        $result = SearchProduct($_GET['search']);
        while($row = Fetch($result)){
            CreateItem($row);
        }
        $result->close()

    ?>
    </div>
<?php require_once($_SERVER['DOCUMENT_ROOT']."/Webshop/scripts/includes/footer.php");?>