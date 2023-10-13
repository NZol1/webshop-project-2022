              <!--BODY MOBILE START-->
              <?php ToCart();?>
              <div class="flex-container">
            <div class="flex-banner">
                <div class="flex-banner-container">
                    <div class="flex-banner-text">
                        <h2>Üdvözöllek a weboldalon!</h2>
                        <h2>Kellemes időtöltést kívánunk!</h2>
                    </div>
                    <div class="flex-banner-content">
                        <div class="view-products">
                        <a href="#top-sale-text">
                            <h2>Termékeink</h2>
                        </a>
                        </div>
                        <div class="jump-to-login">
                        <?php SignInButton() ?>
                        </div>
                    </div>
                </div>
            </div>
        <!--MOBILE PRODUCTS START-->
            <div class="filters">
                <div class="category">
                    <h1>Szűrők:</h1>
                    <li class="category-filter-option">
                        <label class="filter-label">
                            <input type="checkbox">
                            <span class="filter-indicator"></span>
                            Filter
                        </label>
                    </li>
                    <li class="category-filter-option">
                        <label class="filter-label">
                            <input type="checkbox">
                            <span class="filter-indicator"></span>
                            Filter
                        </label>
                    </li>
                    <li class="category-filter-option">
                        <label class="filter-label">
                            <input type="checkbox">
                            <span class="filter-indicator"></span>
                            Filter
                        </label>
                    </li>
                    <li class="category-filter-option">
                        <label class="filter-label">
                            <input type="checkbox">
                            <span class="filter-indicator"></span>
                            Filter
                        </label>
                    </li>
                </div>
            </div>
                <input type="button" class="filter-show" onclick="showFilters(this)" value="Megjelenítés">

                <h1 id="top-sale-text">Akciós termékeinkből:</h1>
                <div class="owl-carousel owl-theme" id="top-sale">
                    <?php
                        $result = OnSale();
                        while ($row = Fetch($result))
                            ItemOnSale($row);
                            $result->free_result();
                    ?>
                </div>
                     <h1>Kínálatunkból:</h1>
                <div class="row product-thumbs" id="bootstrap-override">
                    <?php
                        $result = AllProducts();
                        while ($row = Fetch($result))
                            RandomizeThumbs($result);
                            $result->free_result();
                    ?>
                </div>


        </div>
        <!--BODY MOBILE END-->