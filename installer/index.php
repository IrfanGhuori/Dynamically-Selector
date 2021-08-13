<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Installer : Countries api </title>
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="shortcut icon" href="../dist/img/log.ico" type="image/x-icon">
    <style>
    .img-fluid{
    width: 289px;
    padding: 10px;
    }
    .card{
    border-radius: 11px;
    }
    .shadow-3dp {
    box-shadow: 0 0 0 0 rgb(0 0 0 / 14%), 0 3px 3px -2px rgb(0 0 0 / 0%), 0 1px 8px 0 rgb(0 0 0 / 12%);
    }
    .form-control {
    border-radius: 0.25rem !important;    
    padding-top: 8px;
    padding-bottom: 10px;
    }
    .card-footer {
    padding: 0.75rem 1.25rem;
    background-color: rgb(255 255 255);
    border-top: 1px solid rgba(0, 0, 0, 0.125);
    }
    a{
       
        transition: 0.3s;
    }
    a:hover{
        color: #024fa1;
        text-decoration: none;
    }
    .card-footer:last-child {
    border-radius: 0 0 calc(0.25rem - 1px) calc(0.25rem - 1px);
    text-align: right;
    font-size: 12px;
    color: #666;
    border-radius: 9px;
}
    .scanner-table{
        max-width : 500px;
    }
    .scanner-table td
    {
        border: 1px solid #66666638;
    }
    .install{
        display : none;
    }
    .progress {
    display: flex;
    height: 1rem;
    overflow: hidden;
    font-size: 0.75rem;
    background-color: #e9ecef;
    border-radius: 0.25rem;
    width: 100%;
}
#basic-addon1{
    cursor: pointer;
}
    </style>
</head>
<body>


<div class="container d-flex justify-content-center ">
<div class="col-8 mt-5">
<!-- card content \-->
<div class="card shadow-3dp" >

<div class="card-headr">
<img class="img-fluid " src="../assets/images/logo.jpg" alt="logo">
</div>

<div class="card-body">

<div class="card-text"><h5> Check Database Connection </h2></div>

<form id="database-connection">

<!-- host name -->
<div class="row">
<div class="form-group col-6">
<label for="">Host</label>
<input type="text" class="form-control" name="host_title" placeholder="Enter Your Host Name" >
<small>You may change,  if this not your hosting name! </small>
</div>

<div class="form-group col-6">
<label for="">Database Name</label>
<input type="text" class="form-control" name="data_title" placeholder="Enter Database Name" >
<small>Enter <a href="https://webdveloper.blogspot.com/2021/06/how-to-find-your-database-username-if.html" target="_blank" rel="referrer">database name</a>  </small>
</div>


<div class="form-group col-6">
<label for="">Database username</label>
<input type="text" class="form-control" name="data_user" placeholder="Enter Database UserName" >
<small>You have created for countries! </small>
</div>

<div class="form-group col-6">
<label for="">Database Password</label>
<input type="text" class="form-control" name="data_pass" placeholder="Enter Database Password" >
</div>



<div class="input-group  col-12">
  
  <input type="text" class="form-control" placeholder="Generate API key" name="api_key" aria-label="api_key" aria-describedby="basic-addon1">
  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">Generate API key</span>
  </div>
</div>
</div>

<hr>
<div class="btn-group">
<div class="btn btn-primary" id="connecting"> Test Connection! </div>
<div class="btn btn-primary" id="scaning"> Scan Server</div>
</div>

</form>

<div class="install">
<div class="btn-group d-flex justify-content-center col">
<div class="btn btn-primary" id="start-installation" > Ready to Install </div>
</div>
</div>
<div class="col">
<div class="loading-progress mt-3"></div>
</div>
</div>
<div class="card-footer float-right"> 
<a href="mailto:IrfanGhuori@yandex.com">IrfanGhuori@yandex.com</a> :  The best quality product
</div>


</div>
<!-- card content /-->
</div>
</div>



<div class="modal fade" id="servercaning" tabindex="-1" role="dialog" aria-labelledby="servercaningLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title text-success" id="servercaningLabel">Scaning Competed</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">

</div>
<div class="modal-footer">
<button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>

</div>
</div>
</div>
</div>

 


<script src="../assets/js/jquery-3.6.0.min.js"></script>
<script src="../assets/plugin/progress_bar/dist/js/jquery.progresstimer.js"></script>
<script src="../assets/js/create_connection.js"></script>
<script src="../assets/js/bootstrap.js"></script>
</body>
</html>


<!-- This Script is from www.phpfreecpde.com, Coded by: Kerixa Inc-->
<?php

	  
// print_r(phpinfo());
	 
?>

	
<?php
