<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of User
 *
 * @author Dennis
 */
class User {
    
    private static $userID,
            $userName, 
            $userRights,
            $userRole;
    
    private $_pdo, $state;    
    
    public function __construct() {
       global $pdo;
       $this->_pdo = $pdo;
        
        if ($this->isLoggedIn())
            $this->setUser ($_SESSION['usrID'], $_SESSION['usrName'], $_SESSION['usrRights'], $_SESSION['usrRole']);
    }


    private function checkValuesLogin($usrName, $usrPass)
    {
        $sql = "Select * From tblUsers Where usrName = ? and usrPass = ?";
        $query = $this->_pdo->prepare($sql);
        $query->bindValue(1, $usrName);
        $query->bindValue(2, $usrPass);
        $query->execute();
        
        $result = $query->fetch(PDO::FETCH_ASSOC);
        $rows = $query->rowCount();
        
        return $result;
    }
    
    private function setUser($userID, $usrName, $usrRights, $usrRole)
    {
        User::$userID = $userID;
        User::$userName = $usrName;
        User::$userRights = $usrRights;
        User::$userRole = $usrRole;
    }
    
    public function userLogin($usrName, $usrPass)
    {
        $user = array();
        $user = $this->checkValuesLogin($usrName, $usrPass);
        
        $userRole = ($user['usrRights'] == 1) ? "Leerling" : "Docent";

        if (!$user == null)
        {
            $_SESSION['usrID'] = $user['usrID'];
            $_SESSION['usrName'] = $user['usrName'];
            $_SESSION['usrRights'] = $user['usrRights'];
            $_SESSION['usrRole'] = $userRole;
            $this->setUser($user['usrID'], $user['usrName'], $user['usrRights'], $userRole);
            
            $this->state = "Juist";
        }
        else
            $this->state = "Onjuist";
        
    }
    
    public function userLogOff()
    {        
        User::$userID = null;
        User::$userName = null;
        User::$userRights = null;
        User::$userRole = null;
        
        session_destroy();
        header("location: ".$_SERVER['PHP_SELF']);
        
    }
    
    public function getScoreRekenVragen()
    {
        $sql = "SELECT rknID, userID, MAX(rknScore) rknScore, rknDatum FROM tblRekenVragen Where userID = ? GROUP BY userID";
        $query = $this->_pdo->prepare($sql);
        $query->bindValue(1, User::$userID);
        $query->execute();
        
        $result = $query->fetch(PDO::FETCH_ASSOC);
        
        if ($result == 0)
            return "Nog niet gespeeld";
        else
        {
            if ($result['rknScore'] > 6)
                return "<font color='green'>".$result['rknScore']."</font>";
            else
               return "<font color='red'>".$result['rknScore']."</font>";             
        }            
    }

    public static function isLoggedIn()
    {
        if (isset($_SESSION['usrID']))
            return true;
        else
            return false;
    }
    
    public static function getUserID()
    {
        return User::$userID;
    }
    
    public static function getUserName()
    {
        return User::$userName;
    }
    
    public static function getUserRights()
    {
        return User::$userRights;
    }
    
    public static function getUserRole()
    {
        return User::$userRole;
    }
    
    public function getState()
    {
        return $this->state;
    }
    
    public static function isLeerling()
    {
        if (User::$userRights == 1)
                return true;
        else
            return false;
    }
    
    public static function isAdmin()
    {
        if (User::$userRights == 3)
                return true;
        else
            return false;
    }
    
    public static function isDocent()
    {
        if (User::$userRights == 2)
                return true;
        else
            return false;
    }
}

?>
