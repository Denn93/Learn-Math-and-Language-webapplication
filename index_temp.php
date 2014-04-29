<?php 
require_once 'Data/Questions.class.php';
$question = new Question();

if (isset($_POST['submit']))
    $question->submitAnswer($_POST['getal1'], $_POST['getal2'], $_POST['operator'], $_POST['answer']);

?>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Tijdelijk Eerste Game: Work in Progress</title>
    </head>
    <body>
         <h2>Tijdelijke Pagina voor de eerste applicatie</h2>
         <p><a href="index.php">Ga terug naar Home</a></p>         
         
         <?php if ($question->getViewGame() == true && $_SESSION['GAME_START'] == 1){?>
         
         <div style="float: left; width: 400px;">
            <form name="Game" action="" method="post">
             <table style="border: 1px solid black;">
                 <tr style="background: darkblue; color: white;">
                     <td colspan="2">Vraag <?php echo $_SESSION['Question_number']; ?></td>
                 </tr>
                 <tr>
                     <td style="width: 75px; "><?php echo $question->getQuestion(); ?></td>
                     <td><input name="answer" type="text" size="25" /></td>
                 </tr>
                 <tr>
                     <td colspan="2" style="text-align: right;" ><input name="submit" type="submit" value="Volgende vraag" /></td>
                 </tr>
            </table>
             
             <input name="getal1" type="hidden" value="<?php echo $question->getGetal1();?>" />
             <input name="getal2" type="hidden" value="<?php echo $question->getGetal2();?>" />
             <input name="operator" type="hidden" value="<?php echo $question->getOperator();?>" />
          </form>
         </div>

        <?php }
        else {?>    
         Uw totale score is: <?php echo $question->getResult();?>
         <?php }?>
    </body>
</html>
