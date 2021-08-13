<?php 


class ScanServer
{

    public $DataArray = null;
    public function GetInformation()
    {
        $this->fetchInfomations();
    }
    private function fetchInfomations()
    {   
        $this->DataArray = array(
            'Server Address'=>$_SERVER['SERVER_ADDR'],
            'Server Name'=>$_SERVER['SERVER_NAME'],
            'Server Software'=>$_SERVER['SERVER_SOFTWARE'],
            'Document Root'=>$_SERVER['DOCUMENT_ROOT'],
            'HTTP Host'=>$_SERVER['HTTP_HOST'],
            'Remote Address'=>$_SERVER['REMOTE_ADDR'],
            'Remote Port'=>$_SERVER['REMOTE_PORT'],
            'Script File Name'=>$_SERVER['SCRIPT_FILENAME'],
            'Server Admin'=>$_SERVER['SERVER_ADMIN'],
            'Serever Port'=>$_SERVER['SERVER_PORT'],
            'Script Name'=>$_SERVER['SCRIPT_NAME'],
            'Request URI'=>$_SERVER['REQUEST_URI'],	
            'PHP Self'=>$_SERVER['PHP_SELF']
        );

        ?>
        <table class="scanner-table">
        <tr>
        <td>
        <strong>Name</strong></td>
        <td>
        <strong>Value</strong></td>
        </tr>
	
        <?php
        foreach ($this->DataArray as $key=>$value){
            ?>
                <tr>
                    <td>
                    <?php echo $key?> </td>
                    <td>
                    <?php echo $value?></td>
                </tr>
            <?php }
            echo '</table>';
    }
}
$dns = new ScanServer();
$dns->GetInformation();
?>