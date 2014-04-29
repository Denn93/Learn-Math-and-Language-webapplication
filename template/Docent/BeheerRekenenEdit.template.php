<?php
if (isset($_POST['Wijzigen']))
    $questions = $beheer->getWijzigQuestions($_POST);
?>

<script type="text/javascript">
function addRow()
{
    var table = document.getElementById("dataTable");
    var lastRow = table.rows.length;
    var iteration = lastRow;
    var row = table.insertRow(lastRow);
    
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);
    var cell5 = row.insertCell(4);
    
    var el1 = document.createElement("input");
    var el2 = document.createElement("input");
    var sel1 = document.createElement("select");
    var sel2 = document.createElement("select");

    el1.type = "text";
    el2.type = "text";
    
    el1.name = "getal1_" + iteration;
    el2.name = "getal2_" + iteration;
    sel1.name = "gameType_" + iteration;
    sel2.name = "gameDifficulty_" + iteration;

    el1.id = "getal1_" + iteration;
    el2.id = "getal2_" + iteration;
    sel1.id = "gameType_" + iteration;
    sel2.id = "gameDifficulty_" + iteration;
    row.id = "row_" + iteration;
    el1.size = 5;
    el2.size = 5;
    
    sel1.options[0] = new Option('Optellen', 1);
    sel1.options[1] = new Option('Vermenigvuldigen', 2);
    sel1.options[2] = new Option('Aftrekken', 3);
    
    sel2.options[0] = new Option('Makkelijk', 1);
    sel2.options[1] = new Option('Normaal', 2);
    sel2.options[2] = new Option('Moeilijk', 3);

    cell1.innerHTML = iteration + 1;
    cell2.appendChild(sel1);
    cell3.appendChild(el1);
    cell4.appendChild(el2);
    cell5.appendChild(sel2);
    
    hidden = document.getElementById('hiddenrows');
    hidden.value = iteration + 1;
}

function removeRow()
{
    var table = document.getElementById("dataTable");
    var lastRow = table.rows.length;
    if (lastRow > 1) table.deleteRow(lastRow - 1);
    var newLastRow = table.rows.length;
    
    hidden = document.getElementById('hiddenrows');
    hidden.value = newLastRow;    
}

function checkValues()
{
  var result = true;
  var rows = document.getElementById('hiddenrows').value;

  for(var i = 0; i < rows; i++)
    {
      var row = document.getElementById("row_" + i);
      
      var getal1 = document.getElementById('getal1_' + i);
      var getal2 = document.getElementById('getal2_' + i);

     if (IsNumeric(getal1.value) == false || IsNumeric(getal2.value) == false)
      {
        if (IsNumeric(getal1.value) == false && IsNumeric(getal2.value) == false)
        {
            getal1.style.borderColor = "red";
            getal2.style.borderColor = "red";                
        }
        
        if (IsNumeric(getal1.value) == false)
            getal1.style.borderColor = "red";
        else
            getal1.style.borderColor = "";
        
        if (IsNumeric(getal2.value) == false)
            getal2.style.borderColor = "red";
        else
            getal2.style.borderColor = "";
        
        result = false;
      }
      else
      {
          getal1.style.borderColor = "";
          getal2.style.borderColor = "";
      }
    }
    return result;
}

function IsNumeric(strString)
   //  check for valid numeric strings	
   {
   var strValidChars = "0123456789.-";
   var strChar;
   var blnResult = true;

   if (strString.length == 0) return false;

   //  test strString consists of valid characters listed above
   for (i = 0; i < strString.length && blnResult == true; i++)
      {
      strChar = strString.charAt(i);
      if (strValidChars.indexOf(strChar) == -1)
         {
         blnResult = false;
         }
      }
   return blnResult;
   }

</script>
<div id="insidecontent">			
	<h1>Beheer docenten</h1>
	<h2>Beheer docenten</h2>
			
	<h3>Reken vragen toevoegen</h3>
	<p>Hieronder kunnen de rekenvragen worden toegevoegd.</p>
        <form name="addQuestions" action="" method="post" onsubmit="return checkValues()">
            <div name="div_questions" id="div_questions" class="div_questions">
                <table>
                    <thead>
                        <tr>
                            <th style="width: 25px;"></th>
                            <th>Game</th>
                            <th>Getal 1</th>
                            <th>Getal 2</th>  
                            <th>Niveau</th>
                        </tr>
                    </thead>
                    <tbody id="dataTable">
                        <?php if (!isset($_POST['Wijzigen'])){?>
                        <tr id="row_0">
                            <td> 1 </td>
                            <td> <select id="gameType_0" name="gameType_0">
                                 <option value="1">Optellen</option>
                                 <option value="2">Vermenigvuldigen</option>
                                 <option value="3">Aftrekken</option>
                              </select></td>
                            <td><input type="text" id="getal1_0" name="getal1_0" size="5" /></td>
                            <td><input type="text" id="getal2_0"name="getal2_0" size="5" /></td>
                            <td> <select id="gameDifficulty_0" name="gameDifficulty_0">
                                 <option value="1">Makkelijk</option>
                                 <option value="2">Normaal</option>
                                 <option value="3">Moeilijk</option>
                              </select></td>
                        </tr>   
                        <?php }
                        else  {
                            
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </form>
</div>
                
                          