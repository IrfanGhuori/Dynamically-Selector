        <?php
        /**
         * Create by Irfan Ghuori
         * 
         */ 
        header('Content-type:application/json');
        if(file_exists('./config.php'))
        {
        require_once('./config.php');
        class Countries extends php_config{
        private $Qry = null;
        private $CountriesList = null;
        private $CrossQre = null;
        private $key = null;
        public  $API = null; 
        public function ReturnList()
        {
        $this->FetchList();
        }
        private function FetchList()
        {
        $filter = str_replace(' ', '-', $_GET["key"]);          
        $key = preg_replace('/[^A-Za-z0-9\-]/', '', $filter);
        if(!empty($key))
        {
        $this->key= "SELECT * FROM `key` WHERE `secret_key`=:keys";
        $dc = $this->conn->prepare($this->key);
        $dc->bindParam(':keys',$key);
        $dc->execute();
        if($dc->rowCount() > 0)
        {
        $api = [];
        $this->Qry = "SELECT `id`,`name` FROM `country`";
        if($this->CrossQry($this->Qry) !==false)
        {
        $qer = $this->conn->prepare("SELECT `id`,`name` FROM `country`");
        $qer->execute();
        while ($row = $qer->fetch(PDO::FETCH_ASSOC))
        {
        $api[] = $row;
        }
        $this->API = json_encode(["status" => "connected", "data" => $api],true);
        }
        }else{
        $err = "<strong>API invalid key</strong> Check API key it may be no correct.";
        $this->API = json_encode(["status" => "error", "message" => $err],true);
        }
        }
        }
        private function CrossQry($qr)
        {
        $this->CrossQre = "SELECT `id`,`name` FROM `country`"; 
        return ($qr == $this->CrossQre) ? true : false;
        }
        }
        }else
        {
        echo "";
        }
        $test = new Countries();
        $test->ReturnList();
        echo $test->API ;
        ?>