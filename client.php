<?php 
 
 if (isset($_REQUEST["salir"])) {
     session_destroy();
     header("location:index.php");
 }

session_start();

include 'connexio.php';

if($_SESSION["nom"]=="admin" || $_SESSION["nom"]=="client"){

 if(!empty($_REQUEST["select"])&&!empty($_REQUEST["busqueda"])&&!empty($_REQUEST['paginacio'])){
    $inici=0;

}else if (isset($_REQUEST['paginacio']) ) {
    
    $inici=$_REQUEST['paginacio'];
}else{
    $inici=0;
}
$lineas=2;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>GYMSTER - Gym HTML Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;500;600;700&family=Rubik&display=swap" rel="stylesheet"> 

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="lib/flaticon/font/flaticon.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body class='bg-secondary'>
    <!-- Header Start -->
    <div class="container-fluid bg-dark px-0">
        <div class="row gx-0">
            <div class="col-lg-3 bg-dark d-none d-lg-block">
                <a href="index.php" class="navbar-brand w-100 h-100 m-0 p-0 d-flex align-items-center justify-content-center">
                    <h1 class="m-0 display-4 text-primary ">El PAISaje</h1>
                </a>
            </div>
            <div class="col-lg-9">
                
            <nav class="navbar navbar-expand-lg bg-dark navbar-dark p-3 p-lg-0 px-lg-5">
                    <a href="index.html" class="navbar-brand d-block d-lg-none">
                        <h1 class="m-0 display-4 text-primary text-uppercase">Gymster</h1>
                    </a>
                    <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                         
                            <a href="client.php" class="nav-item nav-link active">Client</a>
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle " data-bs-toggle="dropdown">Admin</a>
                                <div class="dropdown-menu rounded-0 m-0">
                                    <a href="crearN.php" class="dropdown-item ">Crear Noticia</a>
                                    <a href="borrarN.php" class="dropdown-item ">Eliminar Noticia</a>
                                    <a href="modificarN.php" class="dropdown-item">Modificar Noticia</a>
                                </div>
                            </div>
                            
                        </div>
                        <form action="" method="post">
                            <?php
                                if (!empty($_POST["select"]) && $_REQUEST["select"]!=-1) {
                                    $seccio=$_REQUEST["select"];
                                    
                                    $sql = "SELECT * FROM seccio where codiSeccio =$seccio ";
                                    $r = mysqli_query($connexio, $sql);
                                    while ($fila = mysqli_fetch_assoc($r)) {
                                    echo "<select name='select' class='fs-5 fw-bold text-dark m-0 p-0  text-uppercase ' onchange='this.form.submit()'>
                                    <option class='fs-5 fw-bold text-dark text-uppercase mb-2' value=".$fila["codiSeccio"]." >".$fila["seccio"]."</option>
                                    <option class='fs-5 fw-bold text-dark text-uppercase mb-2' value='-1'>totes les seccions</option>";
                                    }
                                    $sql = "SELECT * FROM seccio where codiSeccio !=$seccio ";
                                    $r = mysqli_query($connexio, $sql);
                                    
                                    
                                    while ($fila = mysqli_fetch_assoc($r)) {
                                        
                                        
                                        echo"<option class='fs-5 fw-bold text-dark text-uppercase mb-2' value=".$fila["codiSeccio"]." >".$fila["seccio"]."</option>";
                                    }

                                    echo "</select>";
                                   
                                } else {
                                    
                                
                                
                            ?>
                            <select name='select' class="fs-5 fw-bold text-dark m-0 p-0  text-uppercase " onchange='this.form.submit()'>
                            <option class="fs-5 fw-bold text-dark text-uppercase mb-2" >totes les seccions</option>
                            <?php
                                $sql = "SELECT * FROM seccio";
                                $r = mysqli_query($connexio, $sql);
                                while ($fila = mysqli_fetch_assoc($r)) {
                                    echo"<option class='fs-5 fw-bold text-dark text-uppercase mb-2' value=".$fila["codiSeccio"].">".$fila["seccio"]."</option>";
                                }
                            ?>
                            </select>
                            
                            <?php }?>
                            
                        </form>
                        <div class="col-4 ">
                            <form class="input-group mx-auto" method="post">
                                
                                <input type="text" class="form-control p-3" name="busqueda" placeholder="Search">
                                
                                <button onchange="this.form.submit()" class="btn btn-primary px-4" name='lupa' value="bi bi-search"><i class="bi bi-search"></i></button>
                                
                            </form>
                        </div>
                        <div>
                            <form action="" method="POST">
                                <input name="salir" type="submit" class='btn btn-primary py-md-3 px-md-5 me-3 text-light' value="Log out">
                            </form>
                        </div>
                       
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- Header End -->

    <!-- Blog Start -->
    <div class="container-fluid p-5">
        <div class="row g-5">
        <div class="col-lg-8 mx-auto">
                <div class="row g-5">
                    <?php 
                    if (!empty($_REQUEST["select"]) && $_REQUEST["select"] !=-1 && empty($_REQUEST["busqueda"])) {
                        $codiSeccio=$_REQUEST["select"];
                        $sql = "SELECT *, DATE_FORMAT(data, '%d') as dia, DATE_FORMAT(data, '%M') as mes, DATE_FORMAT(data, '%y') as any  FROM noticia n  inner join seccio s on (n.codiSeccio=s.codiSeccio) where s.codiSeccio = $codiSeccio  order by codiNoticia DESC limit $inici,$lineas";
                        $r = mysqli_query($connexio, $sql);
                    }else if (!empty($_REQUEST["lupa"])) {
                        echo"<div class='col-md-12'>
                            <p class='h1 text-uppercase '>Resultats de '".$_REQUEST["busqueda"]."' :</p>
                        </div>";
                        $busqueda=explode(" ",$_REQUEST["busqueda"]);
                       
                        $sql = "SELECT *, DATE_FORMAT(data, '%d') as dia, DATE_FORMAT(data, '%M') as mes, DATE_FORMAT(data, '%y') as any  FROM noticia n inner join seccio s on (n.codiSeccio=s.codiSeccio) ";
                        for ($i=0; $i < count($busqueda); $i++) { 

                            if ($i==0) {
                                $sql .="where ( cos like '%".$busqueda[$i]."%'";
                            }else{
                            $sql .=" and cos like '%".$busqueda[$i]."%' ";
                            }
                            if ($i== count($busqueda)-1) {
                               $sql.=")";
                            }
                        }
                        for ($i=0; $i < count($busqueda); $i++) { 

                            if ($i==0) {
                                $sql .=" or ( titol like '%".$busqueda[$i]."%'";
                            }else{
                            $sql .=" and titol like '%".$busqueda[$i]."%' ";
                            }
                            if ($i== count($busqueda)-1) {
                               $sql.=")";
                            }
                        }
                        for ($i=0; $i < count($busqueda); $i++) { 

                            if ($i==0) {
                                $sql .=" or ( autor like '%".$busqueda[$i]."%'";
                            }else{
                            $sql .=" and autor like '%".$busqueda[$i]."%' ";
                            }
                            if ($i== count($busqueda)-1) {
                               $sql.=")";
                            }
                        }
                        $sql .= " order by codiNoticia DESC limit $inici,$lineas";
                        
                        $r = mysqli_query($connexio, $sql);
                    }else{
                        $sql = "SELECT *, DATE_FORMAT(data, '%d') as dia, DATE_FORMAT(data, '%M') as mes, DATE_FORMAT(data, '%y') as any  FROM noticia n inner join seccio s on (n.codiSeccio=s.codiSeccio) order by codiNoticia DESC limit $inici,$lineas";
                        $r = mysqli_query($connexio, $sql);
                    }
                    $impresos=0;
                    while ($fila = mysqli_fetch_assoc($r)) {
                        $impresos++;
                        echo"<div class='col-md-12'>
                        <div class=''>
                            <div class='bg-dark d-flex align-items-center rounded-top p-4'>
                                <div class='flex-shrink-0 text-center text-secondary border-end border-secondary pe-3 me-3'>
                                    <span>".$fila["dia"]."</span>
                                    <h6 class='text-light text-uppercase mb-0'>".$fila["mes"]."</h6>
                                    <span>".$fila["any"]."</span>
                                </div>
                                <div class='d-flex justify-content-between col'>
                                    <span class='h5 text-uppercase text-light my-auto' href=''>".$fila["titol"]."</h4></span>
                                    <span class='h6 text-uppercase text-light my-auto'>".$fila["seccio"]."</span>
                                </div>
                            </div>
                            <div class=' d-flex   bg-light'>
                                <div class='position-relative blog-item overflow-hidden  col-5'>
                                    <img class='img-fluid w-100 rounded-start' src=\"data:".$fila["tipus"].";base64,".base64_encode($fila["imatge"])."\" alt=''>
                                </div>
                                <div class='col p-4 d-flex flex-column justify-content-between'>
                                    
                                    <p class='h6 my-auto text-uppercase text-justify'>".$fila["cos"]."</p>
                                    <p class=' p-0 m-0 d-flex flex-column text-end'> Autor: ".$fila["autor"]."</p>
                                </div>
                            </div>
                        </div>
                    </div>";
                        
                    }
                    
                    mysqli_close($connexio);

                    if ($impresos==0 && $inici==0) {
                        echo"<div class='col-md-12'>
                            <p class='h1 text-uppercase text-center'>Sense resultat</p>
                        </div>";
                    }else{
                        ?>
                        <section class='col-md-12 d-flex justify-content-between'>
                        <?php
                        if ($inici==0 ) {
                            echo"<p class='my-auto'>Anteriors<p>";
                        }else if (!empty($_REQUEST["select"])) {
                            $anterior=$inici-$lineas;
                            echo"<a class='btn btn-primary py-md-3 px-md-5 me-3' href=\"client.php?paginacio=$anterior&select=".$_REQUEST["select"]."\">Anteriors</a>";
                        }else if (!empty($_REQUEST["lupa"])) {
                            $anterior=$inici-$lineas;
                            echo"<a class='btn btn-primary py-md-3 px-md-5 me-3' href=\"client.php?paginacio=$anterior&lupa=".$_REQUEST["lupa"]."&busqueda=".$_REQUEST["busqueda"]."\">Anteriors</a>";
                        }else {
                            $anterior=$inici-$lineas;
                            echo"<a  class='btn btn-primary py-md-3 px-md-5 me-3' href=\"client.php?paginacio=$anterior\">Anteriors</a>";
                        }
                        if ($lineas==$impresos && !empty($_REQUEST["select"])) {
                            $proper=$inici+$lineas;
                            echo"<a class='btn btn-primary py-md-3 px-md-5 me-3' href=\"client.php?paginacio=$proper&select=".$_REQUEST["select"]."\">Següents</a>";
                        
                        }else if ($lineas==$impresos && !empty($_REQUEST["lupa"])) {
                            $proper=$inici+$lineas;
                            echo"<a class='btn btn-primary py-md-3 px-md-5 me-3' href=\"client.php?paginacio=$proper&lupa=".$_REQUEST["lupa"]."&busqueda=".$_REQUEST["busqueda"]."\">Següents</a>";
                        
                        }else  if(empty($_REQUEST["select"])&&empty($_REQUEST["lupa"])&&$lineas==$impresos){
                            $proper=$inici+$lineas;
                            echo"<a class='btn btn-primary py-md-3 px-md-5 me-3' href=\"client.php?paginacio=$proper\">Següents</a>";
                        
                        } else {
                            echo"<p class='my-auto'>Següents<p>";
                        }
                        
                    }

                    
                    
                    ?>
                    </section>
                  
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-dark py-3 fs-4 back-to-top col-1"><i class="bi bi-arrow-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>
<?php

}
else{
    header("location:index.php");
}
?>