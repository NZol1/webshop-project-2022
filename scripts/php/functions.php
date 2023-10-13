<?php
require_once($_SERVER['DOCUMENT_ROOT']."/Webshop/scripts/php/config.php");
//globális változók
$total=0;
if(isset($_SESSION['cart'])){
    $count = count($_SESSION["cart"]);
}
else $count =0;

/* ----- Oldalak közötti átirányítás ----- */
function Redirect($location){
    global $homepage;
    echo"<script>
        window.location.href=\"{$homepage}{$location}\";
    </script>";
}

/* ----- Session üzenet beállítása a sikeres bejelentkezéshez, regisztrációhoz, stb. ----- */
function SetMessage($msg){
    if(!empty($msg)){
        $_SESSION['msg']=$msg;
    }
    else $msg="";
}

/* ----- Session üzenet kiíratása javascript alert() funkcióval ----- */
function DisplayMessage(){
    if (isset($_SESSION['msg'])){
        echo "<script> alert('{$_SESSION["msg"]}')</script>";
        unset($_SESSION['msg']);
    }
}
/* ----- Hibaüzenetek megjelenítése a kérdőíveken ----- */
function ErrorMessage($error){
    echo"<p>$error</p>";
}
/* ----- Bejelentkezés és Kijelentkezés gomb megjelenítése állapottól függően ----- */
function SignInButton(){
    global $homepage;
    if (isset($_SESSION['user']))
    echo"<a href=".$homepage."pages/logout.php"."><h2>Kijelentkezés</h2></a>";
    else echo"<a href=".$homepage."pages/login.php"."><h2>Bejelentkezés</h2></a>";
}
//-------- Navigáció elkészítése a felhasználó bejelentkezési státuszának függvényében (user, admin, nem bejelentkezett) --------

function NavigationMenu(){
    global $homepage;
    global $count;
    if (isset($_SESSION["user"])){
        $user = unserialize($_SESSION["user"]);
        if ($user->isAdmin !=0){
            echo"
                    <div class=\"logo\">
                    <div id=\"search-bar\">
                        <form name='search' action='".$homepage."pages/search.php' method='get'>
                        <input type=\"text\" name=\"search\" id=\"search\" autocomplete=\"off\" placeholder=\"Keresés..\">
                        <button type=\"submit\"><i class=\"fa fa-search\" id=\"search-logo\"></i></button>
                        </form>
                    </div>
                </div>
                <div class=\"shopping-cart\" onclick=\"shoppingcartinfo()\">
                    <a class='nav-link' href='".$homepage."pages/cart.php"."'>
                    <i id='shopping-cart-icon' class='fa fa-shopping-basket'>
                    </i>
                   
                </a>
                </div>
                <div class=\"Icon\" onclick=\"mobilenavlinks(this)\">
                    <i class=\"fa fa-bars\" id=\"Icon\"></i>
                    <ul class=\"flex-mobilenavlinks\">
                        <li><a href=".$homepage."index.php"." target=\"_self\">Kezdőlap</a></li>
                        <li><a href=".$homepage."#top-sale-text"." target=\"_self\">Termékeink</a></li>
                        <li><a href=".$homepage."/pages/logout.php"." target=\"_self\">Kijelentkezés</a></li>
                        <li><a href=".$homepage."/pages/admin.php"." target=\"_self\">Adminisztráció</a></li>
                        <li><a class='nav-link' href='".$homepage."pages/profile.php"."'>
                        <i class='fa fa-user'>
                        </i>
                        </a>
                        </li>
                    </ul>
                </div>
                <div class=\"navbar fixed-top d-none d-md-flex navbar-expand-md navbar-dark bg-dark\" id=\"override-nav\">
        <div class=\"container-fluid\">
        <a class=\"navbar-brand\" href=".$homepage.">WEBSHOP</a>
        <button class=\"navbar-toggler\" type=\"button\" data-bs-toggle=\"collapse\" data-bs-target=\"#navbarSupportedContent\" aria-controls=\"navbarSupportedContent\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">
          <span class=\"navbar-toggler-icon\"></span>
        </button>
            <div class=\"collapse navbar-collapse\" id=\"navbarSupportedContent\">
                <ul class=\"navbar-nav me-auto mb-2 mb-lg-0\">
                    <li class=\"nav-item\">
                      <a class=\"nav-link active\" aria-current=\"page\" href=".$homepage.">Kezdőlap</a>
                    </li>
                    <li class=\"nav-item\">
                      <a class=\"nav-link\" href=".$homepage."#top-sale-text".">Termékeink</a>
                    </li>
                    <li class=\"nav-item\">
                      <a class=\"nav-link\" href=".$homepage."pages/logout.php".">Kijelentkezés</a>
                    </li>
                    <li class=\"nav-item\">
                      <a class=\"nav-link\" href=".$homepage."pages/admin.php".">Adminisztráció</a>
                    </li>
                    <li class=\"nav-item\">
                    <a class='nav-link' href='".$homepage."pages/cart.php"."'>
                    <i id='shopping-cart-icon' class='fa fa-shopping-basket'>
                    </i>
                </a>
                    </li>
                </ul>
            </div>
            <form name=\"search\"  class=\"d-flex\" method=\"get\" action=".$homepage."pages/search.php".">
                <a class='nav-link' href='".$homepage."pages/profile.php"."'>
                <i class='fa fa-user'>
                </i>
                </a>
                <input class=\"form-control me-2\" type=\"search\" id=\"search\" name=\"search\" placeholder=\"Search\" aria-label=\"Search\">
                <button class=\"btn btn-outline-success\" type=\"submit\"><i class=\"fa fa-search\" id=\"search-logo\"></i></button>
            </form>
        </div>
    </div>
                ";
        }
        else{
            echo"
            <div class=\"logo\">
                    <div id=\"search-bar\">
                        <form name='search' action='".$homepage."pages/search.php' method='get'>
                        <input type=\"text\" name=\"search\" placeholder=\"Keresés..\">
                        <button type=\"submit\"><i class=\"fa fa-search\" id=\"search-logo\"></i></button>
                        </form>
                    </div>
                </div>
                <div class=\"shopping-cart\" onclick=\"shoppingcartinfo()\">
                    <a class='nav-link' href='".$homepage."pages/cart.php"."'>
                    <i id='shopping-cart-icon' class='fa fa-shopping-basket'>
                    </i>
                    </a>
                </div>
                <div class=\"Icon\" onclick=\"mobilenavlinks(this)\">
                    <i class=\"fa fa-bars\" id=\"Icon\"></i>
                    <ul class=\"flex-mobilenavlinks\">
                        <li><a href=".$homepage."index.php"." target=\"_self\">Kezdőlap</a></li>
                        <li><a href=".$homepage."#top-sale-text"." target=\"_self\">Termékeink</a></li>
                        <li><a href=".$homepage."/pages/logout.php"." target=\"_self\">Kijelentkezés</a></li>
                        <li><a class='nav-link' href='".$homepage."pages/profile.php"."'>
                        <i class='fa fa-user'>
                        </i>
                        </a>
                        </li>
                    </ul>
                </div>
            <div class=\"navbar fixed-top d-none d-md-flex navbar-expand-md navbar-dark bg-dark\" id=\"override-nav\">
            <div class=\"container-fluid\">
            <a class=\"navbar-brand\" href=".$homepage.">WEBSHOP</a>
            <button class=\"navbar-toggler\" type=\"button\" data-bs-toggle=\"collapse\" data-bs-target=\"#navbarSupportedContent\" aria-controls=\"navbarSupportedContent\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">
              <span class=\"navbar-toggler-icon\"></span>
            </button>
                <div class=\"collapse navbar-collapse\" id=\"navbarSupportedContent\">
                    <ul class=\"navbar-nav me-auto mb-2 mb-lg-0\">
                        <li class=\"nav-item\">
                          <a class=\"nav-link active\" aria-current=\"page\" href=".$homepage.">Kezdőlap</a>
                        </li>
                        <li class=\"nav-item\">
                          <a class=\"nav-link\" href=".$homepage."#top-sale-text".">Termékeink</a>
                        </li>
                        <li class=\"nav-item\">
                          <a class=\"nav-link\" href=".$homepage."pages/logout.php".">Kijelentkezés</a>
                        </li>
                        <li class=\"nav-item\">
                        <a class='nav-link' href='".$homepage."pages/cart.php"."'>
                        <i id='shopping-cart-icon' class='fa fa-shopping-basket'>
                        </i>
                    </a>
                        </li>
                    </ul>
                </div>
                <form name=\"search\" id=\"search-bar\" class=\"d-flex\" method=\"get\" action=".$homepage."pages/search.php".">
                    <a class='nav-link' href='".$homepage."pages/profile.php"."'>
                    <i class='fa fa-user'>
                    </i>
                    </a>
                    <input class=\"form-control me-2\" type=\"search\" name=\"search\" placeholder=\"Search\" aria-label=\"Search\">
                    <button class=\"btn btn-outline-success\" type=\"submit\"><i class=\"fa fa-search\" id=\"search-logo\"></i></button>
                </form>
            </div>
        </div>
            ";
        }
    }
    else{
        echo"
        <div class=\"logo\">
                <div id=\"search-bar\">
                    <form name='search' action='pages/search.php' method='get'>
                    <input type=\"text\" name=\"search\" placeholder=\"Keresés..\">
                    <button type=\"submit\"><i class=\"fa fa-search\" id=\"search-logo\"></i></button>
                    </form>
                </div>
            </div>
            <div class=\"shopping-cart\" onclick=\"shoppingcartinfo()\">
                <?php ShowHideBasket()?>
            </div>
            <div class=\"Icon\" onclick=\"mobilenavlinks(this)\">
                <i class=\"fa fa-bars\" id=\"Icon\"></i>
                <ul class=\"flex-mobilenavlinks\">
                    <li><a href=".$homepage."index.php"." target=\"_self\">Kezdőlap</a></li>
                    <li><a href=".$homepage."#top-sale-text"." target=\"_self\">Termékeink</a></li>
                    <li><a href=".$homepage."/pages/login.php"." target=\"_self\">Bejelentkezés</a></li>
                    <li><a href=".$homepage."/pages/register.php"." target=\"_self\">Regisztráció</a></li>
                    <li><a class='nav-link' href='".$homepage."pages/profile.php"."'>
                    <i class='fa fa-user'>
                    </i>
                    </a>
                    </li>
                </ul>
            </div>
        <div class=\"navbar fixed-top d-none d-md-flex navbar-expand-md navbar-dark bg-dark\" id=\"override-nav\">
        <div class=\"container-fluid\">
        <a class=\"navbar-brand\" href=".$homepage.">WEBSHOP</a>
        <button class=\"navbar-toggler\" type=\"button\" data-bs-toggle=\"collapse\" data-bs-target=\"#navbarSupportedContent\" aria-controls=\"navbarSupportedContent\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">
          <span class=\"navbar-toggler-icon\"></span>
        </button>
            <div class=\"collapse navbar-collapse\" id=\"navbarSupportedContent\">
                <ul class=\"navbar-nav me-auto mb-2 mb-lg-0\">
                    <li class=\"nav-item\">
                      <a class=\"nav-link active\" aria-current=\"page\" href=".$homepage.">Kezdőlap</a>
                    </li>
                    <li class=\"nav-item\">
                      <a class=\"nav-link\" href=".$homepage."#top-sale-text".">Termékeink</a>
                    </li>
                    <li class=\"nav-item\">
                      <a class=\"nav-link\" href=".$homepage."pages/login.php".">Bejelentkezés</a>
                    </li>
                    <li class=\"nav-item\">
                      <a class=\"nav-link\" href=".$homepage."pages/register.php".">Regisztráció</a>
                    </li>
                    <li class=\"nav-item\">
                    <a class='nav-link' href='".$homepage."pages/cart.php"."'>
                    <i id='shopping-cart-icon' class='fa fa-shopping-basket' style='visibility:hidden'>
                    </i>
                </a>
                    </li>
                </ul>
            </div>
            <form name=\"search\" id=\"search-bar\" class=\"d-flex\" method=\"get\" action=".$homepage."pages/search.php".">
                <a class='nav-link' href='".$homepage."pages/profile.php"."'>
                <i class='fa fa-user' style='visibility:hidden;'>
                </i>
                </a>
                <input class=\"form-control me-2\" type=\"search\" name=\"search\" placeholder=\"Search\" aria-label=\"Search\">
                <button class=\"btn btn-outline-success\" type=\"submit\"><i class=\"fa fa-search\" id=\"search-logo\"></i></button>
            </form>
        </div>
    </div>
        ";
    }
}

/* ----- Regisztrációs és bejelentkezési kérdőív hitelesítése a szerveroldalon ----- */

//regisztrációs kérdőív
function ValidateRegistry(){
    global $conn;
    if ($_SERVER["REQUEST_METHOD"]== 'POST'){
        $firstName = $_POST["firstName"];
        $lastName = $_POST["lastName"];
        $userName = $_POST["userName"];
        $userEmail = $_POST["userEmail"];
        $userPass = $_POST["userPass"];
        $confirmPass = $_POST["confirmPass"];

        $errors =[];

        //Vezeték és keresztnév ellenőrzése: csak betűk, hossza 3-50 karakter
        if(!preg_match("/^[a-zA-ZöüóőúéáűíÖÜÓŐÚÉÁŰÍ]{3,50}$/", $firstName))
        $errors[] = "A keresztnév csak betűket tartalmazhat, hossza 3-50 karakter lehet!";
        if(!preg_match("/^[a-zA-ZöüóőúéáűíÖÜÓŐÚÉÁŰÍ]{3,50}$/", $lastName))
        $errors[] = "A vezetéknév csak betűket tartalmazhat hossza 3-50 karakter lehet!";
        //A megadott e-mail címhez tartozó felhasználó keresése (egy emailhez csak egy felhasználó tartozhat)
        if (Fetch(FindEmail($userEmail)))
        $errors[] = "$userEmail e-mail címhez már tartozik felhasználó!";
        //A megadott felhasználónév használhatóságának ellenőrzése
        if (Fetch(FindUserName($userName)))
        $errors[] = "$userName felhasználónév már foglalt!";
        //Jelszó ellenőrzése: 8-50 karakter, tartalmaz nagy- és kisbetűt, valamint számot
        if (!preg_match("/^(?=.*\d)(?=.*[a-zA-Z])[0-9a-zA-Z]{8,50}$/", $userPass))
        $errors[] = "A jelszó 8-50 karakter, és tartalmaznia kell legalább egy nagy- illetve kisbetűt és egy számot!";
        //Annak ellenőrzése, hogy a két jelszómező tartalma megegyezik
        if ($userPass != $confirmPass)
        $errors[] = "A jelszó és az ellenőrző mező tartalma nem egyezik!";

        //A kitöltésben elkövetett hibák megjelenítése, ha nincsenek, a felhasználó felvitele az adatbázisba
        if(!empty($errors)){
            echo"<div class=\"formerror\">";
            foreach($errors as $error){
                echo ErrorMessage($error);
            }
            echo"</div>";
        }
        else {
            $user = new User();
            $user->CreateUser($firstName,$lastName,$userName,$userEmail,$userPass,$confirmPass,0, "", "", "", "", "");
            AddUser($user->GetProps($user));
            $user->__destruct();
            unset($_POST);
            Redirect("");
            die();
        }
    }
}
//bejelentkezési kérdőív
function ValidateLogin(){
    $errors =[];
    if ($_SERVER["REQUEST_METHOD"]=="POST"){
        $userName = $_POST["userName"];
        $userPass = $_POST["userPass"];
        //A megadott e-mail vagy felhasználónév keresése az adatbázisban
        if (Fetch(FindEmail($userName))){
            $result=(Fetch(FindEmail($userName)));
        }
        else if (Fetch(FindUserName($userName))){
            $result=(Fetch(FindUserName($userName)));
        }
        else $errors[] = "Nincs ilyen felhasználó!";

        //A jelszó helyességének ellenőrzése, abban az esetben, ha a felhasználó létezik
        if(!empty($result)){
            if ($result["jelszo"]==md5($userPass)){
                $user = new User();
                $user->CreateUser($result["keresztnev"], $result["vezeteknev"],$result["felhasznalonev"],$result["email"],$result["jelszo"], "", $result["ad"], $result["telefonszam"], $result["varos"], $result["utca"], $result["hazszam"], $result["iranyitoszam"]);
                unset($_POST);
            }
            else $errors[] = "A jelszó nem megfelelő!";
        }
        //Ha valamilyen hiba történt, annak közlése, egyébként a felhasználó bejelentkeztetése
        if(!empty($errors)){
            echo"<div class=\"formerror\">";
            foreach ($errors as $error)
            echo ErrorMessage($error);
            echo"</div>";
        }
        else LogIn($user);
    }
}
/* ----- Bejelentkezés (ha már van bejelentkezett felhasználó, csak átirányítás a főoldalra)----- */
function LogIn(User $user){
    if (!isset($_SESSION["user"])){
        $_SESSION["user"] = serialize($user);
        SetMessage("Sikeres bejelentkezés, mint $user->userName");
        $_SESSION["cart"]= array ();
        Redirect("");
        die();

    }
    else Redirect("");
    die();
 
}
/* ----- Kijelentkezés, az aktuális session lezárása ----- */
function LogOut(){
    session_unset();
    session_destroy();
    Redirect("");
}

/*  #########################################################################################
    ##########            TERMÉKEK MEGJELENÍTÉSÉHEZ KAPCSOLÓDÓ ELJÁRÁSOK           ##########
    #########################################################################################*/
    
    /* ----- Termék "kártyájának elkészítése" ----- */
    //Termék képének betöltése
function AddImage($image):string{
    global $homepage;

    $path = "$homepage"."images/products/$image";
    return $path;
}
    //Az owl akciós termékeinek elkészítése
function ItemOnSale($row){
        $salePrice= round($row['ar']-$row['ar']/100*$row['akcio']);
        $item="
            <div class=\"card col-12 align-items-center text-align-center\">
                <img class=\"card-img-top \" src='".AddImage($row['kep'])."' style=\"width:200px; height:200px\">
                <div class=\"card-body\">
                    <form method=\"post\" action=\"index.php#top-sale-text\">
                    <h5 class=\"card-title\">{$row['termeknev']}</h5>
                    <hr>
                    <p class=\"card-text text-justify shortdesc\">".nl2br($row['rleiras'])."</p>
                    <input type=\"hidden\" name=\"product-id\" value=\"{$row['cikkszam']}\">
                    <input type=\"hidden\" name=\"product-name\" value=\"{$row['termeknev']}\">
                    <input type=\"hidden\" name=\"price\"value=\"{$salePrice}\" >
                    <hr>
                    <div class=\"prices\">
                    <p class=\"card-text\">Ár: ".number_format("{$salePrice}",0,"."," ")." Ft</p> <div class=\"salerate\">-{$row['akcio']}%</div>
                    <p class=\"card-text text-secondary\"><s>Eredeti ár: ".number_format("{$row['ar']}",0,"."," ")."Ft</s></p>
                    </div>
                    <hr>
                    <button class=\"btn btn-secondary\" type=\"submit\" name=\"add_to_cart\"}>Kosárba teszem<i class=\"fa fa-cart-plus\"></i></button>
                    </form>
                </div>

            </div>";

    echo $item;
}
//termékkártya készítése a keresések eredményéhez 
function CreateItem($row){
    if($row['akcio']==0){
        $salePrice= $row["ar"];
        $item="
        <div class=\"col-sm-6 col-md-3 result\">
                <div class=\"card align-items-center \">
                    <img class=\"card-img-top \" src='".AddImage($row['kep'])."' style=\"width:200px; height:200px\">
                    <div class=\"card-body\">
                        <form method=\"post\" action=\"\">
                            <h5 class=\"card-title\">{$row['termeknev']}</h5>
                            <hr>
                            <p class=\"card-text text-justify shortdesc\">".nl2br($row['rleiras'])."</p>
                            <input type=\"hidden\" name=\"product-id\" value=\"{$row['cikkszam']}\">
                            <input type=\"hidden\" name=\"product-name\" value=\"{$row['termeknev']}\">
                            <input type=\"hidden\" name=\"price\" value=\"{$salePrice}\">
                            <hr>
                            <div class=\"prices\">
                            <p class=\"card-text\">Ár: ".number_format("{$salePrice}",0,"."," ")." Ft</p> <div class=\"salerate\" style=\"visibility:hidden\">-{$row['akcio']}%</div>
                            <p class=\"card-text text-secondary\" style=\"visibility:hidden\"><s>Eredeti ár: {$row['ar']} Ft</s></p>
                            </div>
                            <hr>
                            <button class=\"btn btn-secondary\" type=\"submit\" name=\"add_to_cart\"}>Kosárba teszem<i class=\"fa fa-cart-plus\"></i></button>
                        </form>
                    </div>

                </div>
            </div>";
    
    }
    else{
        $salePrice= round($row['ar']-$row['ar']/100*$row['akcio']);        
        $item="
        <div class=\"col-sm-6 col-md-3 result\">
            <div class=\"card align-items-center\">
                <img class=\"card-img-top \" src='".AddImage($row['kep'])."' style=\"width:200px; height:200px\">
                <div class=\"card-body\">
                    <form method=\"post\" action=\"\">
                    <h5 class=\"card-title\">{$row['termeknev']}</h5>
                    <hr>
                    <p class=\"card-text text-justify shortdesc\">".nl2br($row['rleiras'])."</p>
                    <input type=\"hidden\" name=\"product-id\" value=\"{$row['cikkszam']}\">
                    <input type=\"hidden\" name=\"product-name\" value=\"{$row['termeknev']}\">
                    <input type=\"hidden\" name=\"price\" value=\"{$salePrice}\">
                    <hr>
                    <div class=\"prices\">
                    <p class=\"card-text\">Ár: ".number_format("{$salePrice}",0,"."," ")." Ft</p> <div class=\"salerate\">-{$row['akcio']}%</div>
                    <p class=\"card-text text-secondary\"><s>Eredeti ár: {$row['ar']} Ft</s></p>
                    </div>
                    <hr>
                    <button class=\"btn btn-secondary\" type=\"submit\" name=\"add_to_cart\">Kosárba teszem<i class=\"fa fa-cart-plus\"></i></button>
                    </form>
                </div>

            </div>
        </div>";

    }
    echo $item;
}
//véletlenszerű terméktömb generálása, amit átadunk a következő függvénynek
function RandomizeThumbs($result){
    $count = 0;
    $array = array ();
    $arrayKeys = array();
    while($row=Fetch($result)){
        $array[] =$row; 
    };

    do{
        $random = array_rand($array);
        if(!in_array($random, $arrayKeys)){
            $arrayKeys[] =$random;
            $choice = $random;
            ProductThumbs($array, $choice);
            $count++;
        }

    }while($count!=24);
}

//termék thumbnail (link a termék adatlapjára)
function ProductThumbs( $array, $number){
    global $homepage;
    $ar=(int)$array["$number"]["ar"];
    $akcio=(int)$array["$number"]["akcio"];
    $salePrice= round($ar- $ar/100*$akcio);
    if(isset($array[$number])){
        $item="
        <div class =\"col-sm-6 col-md-4 col-lg-2 mt-2 thumb\">
            <form method=\"post\" action=\"pages/description.php?action=description&id={$array["$number"]["cikkszam"]}\">
            <div class=\"card align-items-center text-align-center\">
                <button type=\"submit\ class=\"linkbutton\" name=\"description\"><img class=\"card-img-top  mt-2\" src='".AddImage($array["$number"]['kep'])."'></button>
                <div class=\"card-body\">
                    <h6 class=\"card-title\">{$array["$number"]["termeknev"]}</h6>
                    <p class=\"card-text\">{$array["$number"]["kategoria"]}</p>
                    <h6 class=\"card-title\">Ár:".number_format("{$salePrice}",0,"."," ")."Ft</h6>
                    <input type=\"hidden\" name=\"description\" value=\"{$array["$number"]['cikkszam']}\">
                    </form>
                </div>
            </div>
        </div>
    ";
    }
   
    echo $item;
}
//termék a kosárban
function CartItem($row){
global $homepage;
if($row['akcio']>0){
    $salePrice= round($row['ar']-$row['ar']/100*$row['akcio']);
}
else{
    $salePrice = $row['ar'];
}
$item = "
<form action=\"cart.php?action=remove&id={$row['cikkszam']}\" method=\"post\" class=\"cart-items\">
<div class=\"border rounded\">
    <div class=\"row\">
        <div class=\"col-md-3 pl-0\"><img src=\"".AddImage($row['kep'])."\" class=\"img-fluid\"></div>
        <div class=\"col-md-6\">
            <h5 class=\"pt-2\">{$row['termeknev']}</h5>
            <small class=\"text-secondary\">Forgalmazó: $homepage</small>
            <h5 class=\"pt-2\">".number_format("{$salePrice}",0,"."," ")."Ft</h5>
            <button type=\"submit\" class=\"btn btn-warning\">Későbbre mentés</button>
            <button type=\"submit\" class=\"btn btn-danger mx-2\" name=\"remove\">Eltávolítás</button>
        </div>
</form>
        <div class=\"col-md-3 py-5\">
        <form class=\"d-inline\" method=\"post\" action =\"cart.php?action=decrease&id={$row['cikkszam']}\">
        <button type=\"submit\" class=\"btn bg-light border rounded-circle w-25 px-1\" name=\"decrease\"><i class=\"fas fa-minus\"></i></button>
        </form >
        <input type=\"number\" min=\"1\" value=\"".Quantity($row['cikkszam'])."\" class=\"form-control w-25 d-inline text-center\" style=\"-moz-appearance: textfield;\">
        <form  class=\"d-inline\"  method=\"post\" action =\"cart.php?action=decrease&id={$row['cikkszam']}\">
        <button type=\"submit\" class=\"btn bg-light border rounded-circle w-25 px-1\" name=\"increase\"><i class=\"fas fa-plus\"></i></button>
        </form>
        </div>
    </div>
</div>
";
echo $item;
}
function createDescription($row){
    if (isset($_GET["id"])){
        if($row["akcio"]<0){
            $salePrice= round($row['ar']-$row['ar']/100*$row['akcio']);
        }
        else {
            $salePrice=$row['ar'];
        }

    $item="
    <div class=\"container-fluid\" style=\"position:relative; top:6.5vh;\">
        <div class=\"row\">
            <form method=\"post\" action=\"description.php?action=description&id={$row["cikkszam"]}\">
                <div class=\"longdescription col-md-10 col-sm-12 mx-auto\">
                    <img class=\"img-fluid\" src=\"".AddImage($row["kep"])."\" style=\"height:250px; width:250px; border:1px solid black;\">
                    <div class=\"longdesc-head mx-auto\">
                        <h3>{$row["termeknev"]}</h3>
                        <input type=\"hidden\" name=\"product-name\" value=\"{$row["termeknev"]}\">
                        <input type=\"hidden\" name=\"product-id\" value=\"{$row["cikkszam"]}\">
                    </div>
                    <div class=\" row longdesc-body my-2 mx-auto\">
                        <div class=\"col-md-6 col-sm12 border border-1\">
                                <h5>Rövid leírás:</h5>
                                <p class=\"text-center\">".nl2br($row['rleiras'])."</p>
                        </div>
                        <div class=\"col-md-6 col-sm12 border border-1\">
                                <h5>Teljes leírás:</h5>
                                <p>".nl2br($row['tleiras'])."</p>
                        </div>
                        <div class=\"longdesc-foot mx-auto\">
                            <hr>
                            <h5> ".number_format("{$salePrice}",0,"."," ")." Ft<h5>
                            <input type=\"hidden\" name=\"price\" value=\"{$row["ar"]}\">
                            <hr>
                            <button class=\"btn btn-secondary w-25\" type=\"submit\" name=\"add_to_cart\"}>Kosárba teszem<i class=\"fa fa-cart-plus\"></i></button>
                        </div>
                    </div>
                </div>
                </form>
        </div>

    </div>
    ";
        
    }
    
echo $item;
}

//felhasználói adatok módosítása
function ModifyUser(array $array){
    if(isset($_SESSION['user']))
    $user = unserialize($_SESSION["user"]);
    foreach($_POST as $key=>$value){
        ModifyData($key, $value, $user->userName);
        $user->SetProp($key,$value);
    }
    $_SESSION['user']=serialize($user);
}



/*  #########################################################################################
    ##########            KOSÁRHOZ KAPCSOLÓDÓ ELJÁRÁSOK                            ##########
    #########################################################################################*/

// Termék kosárba tétele (ha már van ilyen termék a kosárban, üzenet)
function ToCart(){
    if(isset($_POST["add_to_cart"])){
        if(isset($_SESSION['cart'])){
            $itemarray = array( "productid" => $_POST['product-id'], "name"=> $_POST["product-name"], "quantity" => 1, "price"=>$_POST["price"]);
            $inCart=array_column($_SESSION['cart'],"productid");

            if (in_array($_POST['product-id'],$inCart)){
                echo"<script>alert('A termék már a kosárban van')</script>";
            }
            else{
                array_push($_SESSION['cart'], $itemarray);
            }

        }

    }

}
// kosárban lécvő termékek megjelenítése a kosár oldalon
function PopulateCart(){
    global $count;
    global $total;

    if($count > 0){
        $result= AllProducts();
        $product_id= array_column($_SESSION['cart'],"productid");

        while($row=Fetch($result)){
            foreach($product_id as $id){
                if($row["cikkszam"]==$id){
                    CartItem($row);
                }
            }
        }
         $result->free_result();
    }
    else echo"<h5> A kosárban nincs egyetlen termék sem </h5>";
}
//a kosárban lévő termékek számának megállapítása   
function TotalNumber(){
    $totalNumber=0;
    foreach($_SESSION["cart"] as $key=>$value){
        $totalNumber = $totalNumber+$value["quantity"];
    }
    echo $totalNumber;
}

//termékek összértéke
function TotalPrice(){
    global $total;
      foreach($_SESSION["cart"] as $key=>$value){
        $itemnumber =  $value["quantity"];
        $itemprice = $value["price"];
        $total =  $itemnumber*$itemprice + $total;
      }

      return $total;

}
function NetPrice(){
    $full=0;
    $net=0;
    foreach($_SESSION["cart"] as $key=>$value){
        $itemnumber =  $value["quantity"];
        $itemprice = $value["price"];
        $tax = $full*.27;
        $full =  $itemnumber*$itemprice + $full;
        $net =$full-$tax;
    }
    if($net>0){
    echo number_format((int)$net, "0", ","," ");
    }
    

}
function Quantity($itemid) {
    if (isset($_SESSION["cart"]))
    foreach($_SESSION["cart"] as $key=>$value){
        if ($itemid == $value["productid"]){
            return $value['quantity'];
        }
    }
}
//kosárban végzett műveletek (termék számának növelése, termék számának csökkentése, termék törlése a kosárból)
// termékek száma a kosárban min. 1, törölni csak a törlés gomb segítségével lehet
function CartAction(){
    global $conn;
    $now = date("Y-m-d");
    $username= unserialize($_SESSION["user"])->userName;

    if(isset($_POST["remove"])){
   
        foreach ($_SESSION["cart"] as $key => $value) {
            if($value["productid"]==$_GET["id"]){
                unset($_SESSION["cart"][$key]);
                echo"<script>alert('A terméket törölted a kosárból...')</script>";
                Redirect("pages/cart.php");
            }
        }
    }
    elseif (isset($_POST["increase"] )){
        foreach ($_SESSION["cart"] as $key => $value) {
            if($value["productid"]==$_GET["id"]){
                 $qty =$value["quantity"]+1;
                $_SESSION["cart"][$key]["quantity"]=$qty;
                Redirect("pages/cart.php");
            }
            
        }   
    }
    elseif(isset($_POST["decrease"])){
        foreach ($_SESSION["cart"] as $key => $value) 
        {
                if($value["productid"]==$_GET["id"]){
                    $qty =$value["quantity"]-1;
                    $_SESSION["cart"][$key]["quantity"]=$qty;
                    Redirect("pages/cart.php");
                }
            
        }  
    }
    if(isset($_POST["empty_cart"])){
        foreach($_SESSION["cart"] as $key=>$value){
            unset($_SESSION["cart"][$key]);
            Redirect("pages/cart.php");
        }
    }
    if(isset($_POST["finalize"])){
    
    foreach($_SESSION["cart"] as $key=>$value){
        $stmt = $conn->prepare("INSERT INTO vasarlasok(felhasznalonev, termek, datum, ar) VALUES (?,?,?,?)");
        $stmt->bind_param("sssi",$username, $value["name"],$now, $value["price"]);
        $stmt->execute();
        $stmt->close();
        unset($_SESSION["cart"][$key]);

    }



//Még ezt a részt át kell majd írni a véglegesítés előtt
        SetMessage("Köszönjük a vásárlást!");
        Redirect("");

    }

}

//Email küldése a vásárlásról

/*  #############################################################################################
    ##########            ADMINISZTRÁCIÓHOZ KAPCSOLÓDÓ ELJÁRÁSOK                       ##########
    #############################################################################################*/
function TopFiveProds($result){
    echo"<table class=\"table-sm w-50\">";
        echo" Legkeresettebb termékek
        <thead>
        <tr>
            <th scope=\"col\">#</th>
            <th scope=\"col\">Termék neve</th>
            <th scope=\"col\">Vásárlások száma</th>
            </tr>
        </thead>";
    
        echo"
        <tbody>";
           while($row = Fetch($result)){
            echo"
            <th scope=\"row\"></th>
                <td>{$row['termek']}</td>
                <td>{$row['occurence']}</td>
            </tr>";
           }



    

        echo"</tbody>";
    echo"</table>";
}
function TopFiveCustomer($result){
    echo"<table class=\"table-sm my-2\" w-25>";
    echo"
    <thead>
    Legnagyobb összegű vásárlások
    <tr>
        <th scope=\"col\">#</th>
        <th scope=\"col\">Felhasználónév</th>
        <th scope=\"col\">Vásárlások összértéke</th>

        </tr>
    </thead>";
    echo"
    <tbody>";
    while($row = Fetch($result)){
        echo"
        <th scope=\"row\"></th>
            <td>{$row['felhasznalonev']}</td>
            <td>{$row['ossz']}</td>
            

        </tr>";
       }
       echo"</tbody>";
       echo"</table>";

}

?>


