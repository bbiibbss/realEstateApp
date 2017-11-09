<?php
   
    require_once("../../php/session.php");
    
    require_once("../../php/userClass.php");
    $auth_user = new USER();

    require_once("../../php/visitClass.php");
    $visit = new VISIT();
    
    $user_id = $_SESSION['user_session'];
    
    $stmt = $auth_user->runQuery("SELECT * FROM users WHERE user_id=:id");
    $stmt->execute(array(":id"=>$user_id));
    
    $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="icon" href="../../images/logo_icon.jpg">
    <title>Utilizadores</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../css/stylesheet.css">
    <link rel="stylesheet" href="../../css/gridStyle.css">
    <script type="text/javascript" src="../../js/topNav.js"></script>
</head>
<body>

   <!-- Navigation Bar -->

    <div class="topnav" id="myTopnav">
        <a href="index.php" class="navBarItemHome"><i class="fa fa-bar-chart"></i></a>
        <a href="users.php" class="navBarItem">Utilizadores</a>
        <a href="properties.php" class="navBarItem">Propriedades</a>
        <a href="../../php/logout.php?logout=true" class="navBarItem navBarItemLogin">LogOut</a>
        <a href="javascript:void(0);" class="navBarItemHome icon" onclick="topNavFunction()"><i class="fa fa-bars"></i></a>
    </div>
   
    <div class="page">
        <div class='row'>
            <div class="col col-10">
                <h3>Utilizadores</h3>
                <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Procurar por nome" title="Type in a name">
            </div>
            <div class="col col-2">
                <form method='post' action='../../php/visits_pdf.php'>
                    <button type='submit' name='subitVisits' class='backend'><i style='font-size:30px;' class='  fa fa-file-pdf-o'></i> VISITAS</button>
                </form>
            </div>
        </div>
        <div class='row'>
            <div class='col col-1'>
                <h4> ID </h4>
            </div>
            <div class='col col-3'>
                <h4> NOME </h4>
            </div>
            <div class='col col-3'>
                <h4> EMAIL </h4>
            </div>
            <div class='col col-2'>
                <h4> CONTACTO </h4>
            </div>
            <div class='col col-1'>
            </div>
            <div class='col col-2'>
            </div>
        </div>
        <ul id="allUsers">
            <?php
                $auth_user->getAllUsersManagerView();
            ?> 
        </ul>     
    </div>

    <!-- Footer -->
    <footer>
        <div>
        VerdeMar - Gestão Imobiliária
        </div>
        <div class="w3-large">
            <i class="socialMediaIcon fa fa-facebook-official w3-hover-opacity"></i>
            <i class="socialMediaIcon fa fa-instagram w3-hover-opacity"></i>
            <i class="socialMediaIcon fa fa-twitter w3-hover-opacity"></i>
            <i class="socialMediaIcon fa fa-linkedin w3-hover-opacity"></i>
        </div>
    </footer>
    <script>
        function myFunction() {
            var input, filter, ul, li, a, i;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            ul = document.getElementById("allUsers");
            li = ul.getElementsByTagName("li");
            for (i = 0; i < li.length; i++) {
                a = li[i].getElementsByTagName("a")[0];
                if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
                    li[i].style.display = "";
                } else {
                    li[i].style.display = "none";

                }
            }
        }
    </script>
</body>
</html>