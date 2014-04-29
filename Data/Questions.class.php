<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Questions
 *
 * @author Dennis
 */
class Question {
    
    private $operators = array("+", "-");
    
    private $getal1, 
            $getal2,
            $operator,
            $question,
            $maxQuestions = 20,
            $viewGame = true,
            $_pdo;
    
    public static $result = array();
    
    public function __construct() {
        $this->generateQuestion();
        
        global $pdo;
        $this->_pdo = $pdo;
        
        if (!isset($_SESSION['GAME_START']) || ($_SESSION['GAME_START'] == 0))
        {
            $_SESSION['GAME_START'] = 1;
            $_SESSION['Question_number'] = 1;
            $_SESSION['Score'] = 0;
            Question::$result['Username'] = "";
            Question::$result['Score'] = 0;
        }
    }            

    private function generateQuestion()
    {
        $this->getal1 = rand(1, 30);
        $this->getal2 = rand(1, 30);
        $rand_operator = array_rand($this->operators);
        $this->operator = $this->operators[$rand_operator];
        
        $this->question = $this->getal1." ".$this->operator." ".$this->getal2." = ";
    }
    
    private function generateAnswer($getal1, $getal2, $operator)
    {
        if ($operator == "+")
            $answer = $getal1 + $getal2;
        else
            $answer = $getal1 - $getal2;
        
        return $answer;
    }
    
    public function submitAnswer($getal1, $getal2, $operator, $answer)
    {
        $correctanswer = $this->generateAnswer($getal1, $getal2, $operator);
        
        if ($answer == $correctanswer)
            $_SESSION['Score']++; 

        if ($_SESSION['Question_number'] >= $this->maxQuestions)
        {
            $_SESSION['GAME_START'] = 0;
            $this->viewGame = false;
            $this->submitScore();
        }
        
        $_SESSION['Question_number']++;
    }
    
    public function submitScore()
    {
        $SQL = "INSERT INTO tblRekenVragen (userID, rknScore, rknDatum) VALUES (?, ?, NOW())";
        $query = $this->_pdo->prepare($SQL);
        $query->bindValue(1, $_SESSION['usrID']);
        $query->bindValue(2, $this->getResult());
        $query->execute();
    }
    
    public function getGetal1()
    {
        return $this->getal1;
    }
    public function getGetal2()
    {
        return $this->getal2;
    }
    public function getOperator()
    {
        return $this->operator;
    }
    
    public function getQuestion()
    {
        return $this->question;
    }
    
    public function getViewGame()
    {
        return $this->viewGame;
    }
    
    public function getResult()
    {
        $answer = ($_SESSION['Score'] / $this->maxQuestions) * 10;
        return $answer;
    }
}

?>
