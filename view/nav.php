<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<link rel="stylesheet" href="./home.css">
</head>
<body>
    



<div id="wrapper" class="active">  
 
    <div id="sidebar-wrapper">
        <ul id="sidebar_menu" class="sidebar-nav">
           <li class="sidebar-brand"><a id="menu-toggle" href="#"> <span id="main_icon" class="glyphicon glyphicon-align-justify"></span></a></li>
           <img style="width: 100%" src="./img/logo.png" alt="" srcset="">

          </ul>
        <ul class="sidebar-nav" id="sidebar">
          <li><a>Acceuil<span class="sub_icon glyphicon glyphicon-home"></span></a></li>
           <ul class="sidebar-nav" id="sidebar">
                <li><a>Rechercher<span class="sub_icon glyphicon glyphicon-search"></span></a></li>
                
                <li><a>Messagerie<span class="sub_icon glyphicon glyphicon-send"></span></a></li>
           </ul>
          <li><a>Cree<span class="sub_icon 	glyphicon glyphicon-plus"></span></a></li>
          <li><a>Profile<span class="sub_icon glyphicon glyphicon-user"></span></a></li>
        </ul>
      </div>
          
     
      
</div>

<script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("active");
});
</script>
</body>
</html>