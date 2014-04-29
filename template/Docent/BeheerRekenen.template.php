
<script type="text/javascript">

    function sendRequest()
    {
        gametype = document.getElementById('gameType').value;
        gameniveau = document.getElementById('gameNiveau').value;
        
        new Ajax.Request('Data/Docent/Beheer.class.php',
        {
            method: 'post',
            postBody: 'select=true&gametype=' + gametype + "&gameniveau=" + gameniveau,
            onComplete: showResponse
        });
    }

    function emptyTable(table)
    {
        rows = table.rows.length;
        for(i = 0; i < rows; i++)
                table.deleteRow(0);    
    }
    
    function showResponse(req)
    {
        var JSONText = req.responseText;
        var result = eval(JSONText);
        var rows = result.length;
        
        var insertTable = document.getElementById('dataTable');
        emptyTable(insertTable);
        if (rows == 0)
            {
                var row = insertTable.insertRow(0);
                var cell1 = row.insertCell(0);
                cell1.colSpan = 5;
                cell1.innerHTML = "Geen vragen gevonden.";
            }
            
        for (i = 0; i < rows; i++)
            {
                var row = insertTable.insertRow(i);
                var cell1 = row.insertCell(0)
                var cell2 = row.insertCell(1);
                var cell3 = row.insertCell(2);
                var cell4 = row.insertCell(3);
                var cell5 = row.insertCell(4);
                
                var input = document.createElement('input');
                input.type = 'checkbox';
                input.name = 'check_' + (i + 1);
                input.value = result[i].qstnID;
                
                cell1.appendChild(input);
                cell2.innerHTML = i + 1;
                cell3.innerHTML = result[i].qstnGameName;
                cell4.innerHTML = result[i].qstnGetal1 + " " + result[i].qstnOperator + " " + result[i].qstnGetal2 + " = " + result[i].qstnAnswer;
                cell5.innerHTML = result[i].qstnDifficulty ;
            }
    }
</script>
<div id="insidecontent">			
	<h1>Beheer docenten</h1>
	<h2>Beheer docenten</h2>
			
	<h3>Reken vragen beheren</h3>
	<p>Hieronder zullen alle reken vragen worden weergegeven. Op basis van het gekozen spel</p>
        <p>Game: <select name="gameType" id="gameType" onChange="sendRequest()">
                             <option value="0">Alle</option>
                             <option value="1">Optellen</option>
                             <option value="2">Vermenigvuldigen</option>
                             <option value="3">Aftrekken</option>
                          </select>
      &nbsp;      Niveau: <select name="gameNiveau" id="gameNiveau" onChange="sendRequest()">
                         <option value="0">Alle</option>
                         <option value="1">Makkelijk</option>
                         <option value="2">Normaal</option>
                         <option value="3">Moeilijk</option>
                     </select>
        </p>
        
        <form name="form_rekenvragenBeheer" action="index.php?Page=BeheerRekenenEdit" method="post">
            <div name="div_questions" id="div_questions" class="div_questions">
                <table>
                    <thead>
                        <tr>
                            <th></th>
                            <th id="rownumber"></th>
                            <th id="gameName">Game</th>
                            <th id="question">De Vraag</th>
                            <th id="gameDifficulty">Moeilijkheidsgraad</th>                    
                        </tr>
                    </thead>
                    <tbody id="dataTable">
                        <?php $questions = $beheer->getQuestions(0, 0);
                        $row = 0;
                        foreach($questions as $question => $val)
                        {
                            $row++;
                            $vraag = $val['qstnGetal1']." ".$val['qstnOperator']." ".$val['qstnGetal2']. " = ".$val['qstnAnswer'];
                            echo '
                                <tr>
                                    <td><input type="checkbox" name="check_'.$row.'" value="'.$val['qstnID'].'"/></td>
                                    <td>'.$row.'</td>
                                    <td>'.$val['qstnGameName'].'</td>
                                    <td>'.$vraag.'</td>
                                    <td>'.$val['qstnDifficulty'].'</td>
                                </tr> 
                                 ';
                        }
                        ?>          
                    </tbody>
                </table>            
            </div>   
            <div id="div_buttons">
                <a href="index.php?Page=BeheerRekenenEdit"><button>Toevoegen</button></a>
                <input type="submit" name="Wijzigen" value="Wijzigen" />
                <input type="submit" name="Verwijderen" value="Verwijderen" />
            </div>
        </form>
</div>
