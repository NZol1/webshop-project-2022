<div class="log-header">
        <?php ValidateLogin()?>
            <h1>Bejelentkezés</h1>
            <div class="log" id="log">
                <form name="login" method="post">
                <div class="username">
                    <label>Felhasználónév:</label>
                    <input type="text" name="userName" required>
                </div>
                <div class="password">
                    <label>Jelszó:</label>
                    <input type="password" name="userPass" id="password-type" required>
                    <a href="#" id="first-button" onclick="showpassword(this)"><i id="eye" class="fa fa-eye-slash"></i></a>
                </div>
                <div class="log-button">
                    <input type="submit" id="log-button" value="Bejelentkezés">
                </div>
                </form>
            </div>
        </div>
        