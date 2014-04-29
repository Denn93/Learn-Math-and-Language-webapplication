<?php
/**
 * Description of Beheer
 *
 * @author Dennis
 */
class Beheer {
    
    private $_pdo;
    private $gameType = array('Optellen' => 1, 'Vermenigvuldigen' => 2, 'Aftrekken' => 3);
    private $gameDifficultys = array('Makkelijk' => 1, "Normaal" => 2, "Moeilijk" => 4);
    
    
    public function __construct() {
        $this->_pdoconnection();
        
        if (isset($_POST['select']) == 'true')
            echo json_encode ($this->getQuestions($_POST['gametype'], $_POST['gameniveau']));
    }
    
    private function _pdoconnection()
    {
        $this->_pdo = new PDO(Config::$config['odbcString'], Config::$config['dbUser'], Config::$config['dbPass']);
        $this->_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);        
    }
    
    public function getQuestions($gameSoort, $gameNiveau)
    {              
        $sql = "SELECT qstn.qstnID
                     , qstn.qstnGetal1
                     , qstn.qstnGetal2
                     , qstn.qstnAnswer
                     , qstn.qstnDate
                     , CASE qstn.qstnOperator 
                                WHEN 1 THEN '+'
                                WHEN 2 THEN 'x'
                                WHEN 3 THEN '-'     
                       END AS qstnOperator 
                     , CASE qstn.qstnOperator
                                WHEN 1 THEN 'Optellen'
                                WHEN 2 THEN 'Vermenigvuldigen'
                                WHEN 3 THEN 'Aftrekken'
                       END AS qstnGameName
                     , usr.usrName
                     , CASE qstn.qstnDifficulty 
                                WHEN 1 THEN 'Makkelijk'
                                WHEN 2 THEN 'Normaal'
                                WHEN 3 THEN 'Moeilijk'     
                       END AS qstnDifficulty  
                 FROM tblMathQuestions qstn
                 INNER JOIN tblUsers usr ON usr.usrID = qstn.userID ";
        
        if ($gameSoort != 0)
            $sql .= "WHERE qstn.qstnOperator = ? ";
        
        if ($gameNiveau != 0 && $gameSoort != 0)        
            $sql .= "AND qstn.qstnDifficulty = ? ";
        else if ($gameNiveau != 0 && $gameSoort == 0)
            $sql .= "WHERE qstn.qstnDifficulty = ? ";           
         
        $sql .= "ORDER BY qstn.qstnDifficulty
                        , qstn.qstnID";
        
        $query = $this->_pdo->prepare($sql);
        if ($gameSoort != 0)
            $query->bindValue(1, $gameSoort);
        
        if ($gameNiveau != 0 && $gameSoort != 0)
            $query->bindValue(2, $gameNiveau);
        else if ($gameNiveau != 0 && $gameSoort == 0)
            $query->bindValue(1, $gameNiveau);
        
        $query->execute();
        
        $result = $query->fetchAll();
        return $result;
    }
    
    public function getWijzigQuestions($_param)
    {
        foreach($_param as $qstnID)
            if ($qstnID != "Wijzigen") 
                $qstnIDs[] = $qstnID;
        
        $count = count($qstnIDs);
        
        $sql = "SELECT qstn.qstnID
                     , qstn.qstnGetal1
                     , qstn.qstnGetal2
                     , qstn.qstnAnswer
                     , qstn.qstnDate
                     , qstn.qstnOperator 
                     , CASE qstn.qstnOperator 
                                WHEN 1 THEN '+'
                                WHEN 2 THEN 'x'
                                WHEN 3 THEN '-'     
                       END AS qstnOperatorSign 
                     , CASE qstn.qstnOperator
                                WHEN 1 THEN 'Optellen'
                                WHEN 2 THEN 'Vermenigvuldigen'
                                WHEN 3 THEN 'Aftrekken'
                       END AS qstnGameName
                     , usr.usrName
                     , qstn.qstnDifficulty 
                     , CASE qstn.qstnDifficulty 
                                WHEN 1 THEN 'Makkelijk'
                                WHEN 2 THEN 'Normaal'
                                WHEN 3 THEN 'Moeilijk'     
                       END AS qstnDifficultyName  
                 FROM tblMathQuestions qstn
                 INNER JOIN tblUsers usr ON usr.usrID = qstn.userID 
                 WHERE qstn.qstnID IN (";
        $i = 0;
        foreach($qstnIDs as $qstnID)
        {
           if ($i + 1 == $count)         
                $sql .= $qstnID.")";
           else
               $sql .= $qstnID.", ";
           
           $i++;            
        }
        
        $sql .= "ORDER BY qstn.qstnDifficulty
                        , qstn.qstnOperator";  
        
        $query = $this->_pdo->prepare($sql);
        $query->execute();
        
        echo $sql;
        return $query->fetchAll();        
    }
    
    public function insertMathQuestions($_param)
    {
        $rows = $_param['hiddenrows'];
        
        for ($i = 0; $i < $rows; $i++)
        {
            $userID = User::getUserID();
            $row = $i + 1;
            $gameType = $_param['gameType_'.$i];
            $getal1 = $_param['getal1_'.$i];
            $getal2 = $_param['getal2_'.$i];
            $gameDifficulty = $_param['gameDifficulty_'.$i];
            
            switch($gameType){
                case 1:
                    $answer = $getal1 + $getal2;
                    break;
                case 2:
                    $answer = $getal1 * $getal2;
                    break;
                case 3:
                    $answer = $getal1 - $getal2;
		break;
		}
        }
    }
}

$beheer = new Beheer();
					