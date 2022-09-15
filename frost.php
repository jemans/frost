<?php
    //  COFIGURATION
        //1. database (supports only mysql etc.)
        //To call database use: $_SESSION['dbLink']
        $_SESSION['dbHost'] = 'localhost';          #Database IP
        $_SESSION['dbUser'] = 'root';               #Database usernam
        $_SESSION['dbPassword'] = '';               #Database password
        $_SESSION['dbDB'] = 'website';              #Name of the database
    
    
    if(isset($_SESSION['dbHost']))
    {
        $db = mysqli_connect($_SESSION['dbHost'], $_SESSION['dbUser'], $_SESSION['dbPassword'], $_SESSION['dbDB']);
    }
    $_SESSION['dbLink'] = $db;
    class frost_auth
    {       
        public $dbLink;
        public $dbTable;

        //
        //Credentials Arrays = ['credentials to check(f.e. form post data)', 'database field name']
        //

        public $username;   //c array- 2 fields to fill
        public $email;      //c array- 2 fields to fill
        public $password;   //c array- 2 fields to fill
        public $WUD;
        public $sWUD;
        public $DTS;
        public $CASE;

        function __construct($dbLink, $dbTable)
        {
            $this->dbLink = $dbLink;
            $this->dbTable = $dbTable;
        }

        function login()
        {

            //$this->sWUD = implode(', ', $this->wantedUserData);

            #CHECKING WHAT CREDENTIALS ARE GIVEN.
            //is USERNAME given?
            if($this->username[0] == NULL)
                $this->WUD[0] = 0;
            else
                $this->WUD[0] = 1;
            //is EMAIL given?
            if($this->email[0] == NULL)
                $this->WUD[1] = 0;
            else
                $this->WUD[1] = 1;
            //is PASSWORD given?
            if($this->password[0] == NULL)
                $this->WUD[2] = 0;
            else
                $this->WUD[2] = 1;      
                
            
            if($this->WUD[0] == 1)
            {
                $this->sWUD[0] = $this->username[1];
            }
            if($this->WUD[1] == 1)
            {
                $this->sWUD[1] = $this->email[1];
            }
            if($this->WUD[2] == 1)
            {
                $this->sWUD[2] = $this->password[1];
            }
            
            $this->DTS = implode(', ', $this->sWUD);
            //DTS works.
            

            $u = $this->username[0];
            $uf = $this->username[1];
            $e = $this->email[0];
            $ef = $this->email[1];
            $p = $this->password[0];
            $pf = $this->password[1];
            

            $result = mysqli_query($this->dbLink, "SELECT * FROM $this->dbTable WHERE $ef='$e' && $pf='$p'");

            while($row = mysqli_fetch_array($result, MYSQLI_BOTH))
            {
                $_SESSION['user'] = $row[$uf];
                $_SESSION['isAuth']= true;
            }
            
        }


        function logout()
        {
            session_destroy();
        }
        
    }
?>
