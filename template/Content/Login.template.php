<h1>Login</h1>
<h2>Login</h2>			
<form name="InlogMenu" action="" method="post">		
    <table>
        <tr>
            <th style="text-align: left;"><h3>Inloggen:</h3></th>
            <th style="text-align: left; color: red;"><?php $state = $user->getState(); 
            if ($state == "Onjuist")
                echo "Inlog is mislukt";
            else if ($state == "Juist")
                echo "Login succesvol";
            ?>
            </th>
        </tr>
        <tr>
            <td><label for="username">Gebruikersnaam: </label></td>
            <td><input id="username" name="username" type="text" size="15"/></td>
        </tr>
        <tr>
            <td><label for="password">Wachtwoord: </label></td>
            <td><input id="password" name="password" type="password" size="15"/></td>
        </tr>
        <tr>
            <td colspan="2"><input class="menu" id="inloggen" name="inloggen" type="submit" value="Inloggen"/></td>
        </tr>
    </table>
</form>