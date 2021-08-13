<?php 

if(file_exists('./config.php'))
{
require_once('./config.php');

class SerachCity_and_Countries extends php_config{

    private $Qery = null;
    private $Condition = null;
    private $Data = null;
    private $Types = null;
    private $IDs = null;


    public function SearchCityOrCountires(array $data)
    {
        $this->FetchData($data);             
    }

    private function FetchData(array $data)
    {    
        $this->Types = $data["type"];
        $this->IDs = $data["id"];
        if(!empty($this->Types))
        {
            if($this->Types == "city")
            {
                $this->Qery = "SELECT `id`,`name` FROM `city` WHERE `state_id`=:ids";
            }else{
                $this->Qery = "SELECT `id`,`name` FROM `state` WHERE `country_id`=:ids"; 
            }
            $qry = $this->conn->prepare($this->Qery);
            $qry->bindParam(':ids',$this->IDs);
            $qry->execute();            
            $html="";

            while ($row = $qry->fetch(PDO::FETCH_ASSOC))
            {
                echo '<option value='.$row['id'].'>'.$row['name'].'</option>';
            }
         
            
     
        }
       


                                          
    }

    private function FilterQuery($data)
    {
        $data = str_replace(' ', '', $data);
        return preg_replace('/[^A-Za-z0-9\]/', '', $data);
    } 

}

    
}

if(isset($_POST["id"]))
{
    $list = new SerachCity_and_Countries();
    $arr = array("id" => $_POST["id"],"type" => $_POST["type"]);
    $list->SearchCityOrCountires($arr);
}

?>