<div class="regist-header">
            <h1>Regisztráció</h1>
            <?php ValidateRegistry()?>
            <form name="regForm" method="post">
                <div class="regist" id="regist">
                    <div class="Vezetéknév">
                        <label>Vezetéknév:</label>
                        <input type="text" name="lastName" required>
                    </div>
                    <div class="Keresztnév">
                        <label>Keresztnév:</label>
                        <input type="text" name="firstName" required>
                    </div>
                    <div class="username">
                        <label>Felhasználónév:</label>
                        <input type="text" name="userName" required>
                    </div>
                    <div class="email">
                        <label>Email cím:</label>
                        <input type="email" name="userEmail" required>
                    </div>
                    <div class="password">
                        <label>Jelszó:</label>
                        <input type="password" id="password-type" name="userPass" required>
                        <a href="#" id="first-button" onclick="showpassword(this)"><i id="eye" class="fa fa-eye-slash"></i></a>
                    </div>
                    <div class="password2">
                        <label>Jelszó:(2x)</label>
                        <input type="password" id="password-type2" name="confirmPass" required>
                        <a href="#" id="second-button" onclick="showpassword2(this)"><i id="eye2" class="fa fa-eye-slash"></i></a>
                    </div>
                    
                    <div class="regist-button">
                        <p id="aszf">A regisztrációval elfogadom a <a href="#"><u>Felhasználási feltételeket</u></a> és az <a href="#"><u>Adatvédelmi nyilatkozatot</u></a>.</p>
                        <input type="submit" id="regist-button" value="Regisztrálok">
                    </div>
                </div> 
            </form>

        </div>