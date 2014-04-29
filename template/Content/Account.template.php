<h1>Account</h1>
<h2>Account</h2>
<form name="Uitloggen" action="" method="post">
    <table style="width: 100%;">
        <tr>
            <td>Welkom <?php echo $user->getUserName();?></td>
            <td><input id="uitloggen" name="uitloggen" type="submit" value="Uitloggen" /></td>
        </tr>
        <tr>
            <td style="text-align: left;"><h3>Account:</h3></td>
        </tr>
        <tr>
            <td>Gebruikersnaam: </td>
            <td style="text-transform: capitalize;"><?php echo User::getUserName();?></td>
        </tr>
        <tr>
            <td>Rechten: </td>
            <td><?php echo User::getUserRole();?></td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: right;"></td>
        </tr>
        <?php if (User::isLeerling()){?>
          <tr>
              <td colspan="2" style="text-align: left;"><h3>Persoonlijke scores</h3></td>
          </tr>
          <tr>
              <td>Rekenvragen:</td>
              <td><?php echo $user->getScoreRekenVragen();?></td>
          </tr>
        <?php } 
        if (User::isDocent()){ ?>
            <tr>
              <td colspan="2" style="text-align: left;"><h3>Admin Tools</h3></td>
          </tr>
          <tr>
              <td>Rekenvragen: </td>
              <td><a href="index.php?Page=BeheerRekenen">Vragen beheren</a></td>
          </tr>
          <tr>
              <td>Taal vragen: </td>
              <td><a href="index.php?Page=BeheerTaal  ">Vragen beheren</a></td>
          </tr>
          <?php } ?>
        
    </table>    
</form>

