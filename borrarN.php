<?php 

if (isset($_REQUEST["salir"])) {
    session_destroy();
    header("location:index.php");
}

session_start();

include 'connexio.php';

if($_SESSION["nom"]=="admin" ){

if (!empty($_POST["EliminarN"])) {
    $codiN=$_REQUEST["nomEN"];
  
    $sql="DELETE  FROM noticia WHERE codiNoticia='$codiN'";
  
    $r = mysqli_query($connexio, $sql);

    
  }
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

<body class="bg-secondary">
    <!-- Header Start -->
    <div class="container-fluid bg-dark px-0">
        <div class="row gx-0">
            <div class="col-lg-3 bg-dark d-none d-lg-block">
                <a href="index.php" class="navbar-brand w-100 h-100 m-0 p-0 d-flex align-items-center justify-content-center">
                    <h1 class="m-0 display-4 text-primary ">El PAISaje</h1>
                </a>
            </div>
            <div class="col-lg-8 d-flex justify-content-between">
                
                <nav class="navbar navbar-expand-lg bg-dark navbar-dark p-3 p-lg-0 px-lg-5">
                    <a href="index.html" class="navbar-brand d-block d-lg-none">
                        <h1 class="m-0 display-4 text-primary text-uppercase">Gymster</h1>
                    </a>
                    <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                         
                            <a href="client.php" class="nav-item nav-link ">Client</a>
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle active" data-bs-toggle="dropdown">Admin</a>
                                <div class="dropdown-menu rounded-0 m-0">
                                    <a href="crearN.php" class="dropdown-item ">Crear Noticia</a>
                                    <a href="borrarN.php" class="dropdown-item active">Eliminar Noticia</a>
                                    <a href="modificarN.php" class="dropdown-item">Modificar Noticia</a>
                                </div>
                            </div>
                            
                        </div>
                        
                    </div>
                </nav>
                <div class="my-auto">
                <form action="" method="POST">
                    <input name="salir" type="submit" class='btn btn-primary py-md-3 px-md-5 me-3 text-light' value="Log out">
                </form>
            </div>
            </div>
            
        </div>
    </div>
    <!-- Header End -->

    <div class="row p-5  g-0 ">
            <div class="col-lg-9  mx-auto">
                <div class="bg-dark rounded p-5">
                <h3 class="text-light text-uppercase ">Eliminar Noticia</h3>
                    <form method="post" enctype="multipart/form-data">
                        
                        <div class='row p-0 bg-dark rounded d-flex justify-content-center'>
                        <?php
                            $sql = "SELECT * FROM noticia order by codiNoticia DESC";
                            $r = mysqli_query($connexio, $sql);

                            while ($fila = mysqli_fetch_assoc($r)) {

                                echo"<div class='col-6 py-2 my-2'><div class='d-flex overflow-hidden col-12 bg-light col-2 h2 rounded  py-3'> <input class='form-check-input my-auto ms-3' type='radio' name='nomEN' value=".$fila["codiNoticia"]." required><div class='flex-shrink-0 text-center text-secondary border-end border-secondary pe-3 mx-3 my-auto'><p class='h5 my-auto'>".$fila["data"]."</p> </div ><h5 class='my-auto'>".$fila["titol"]."</h5> </div></div>";
                                
                                
                            }
                            
    ?>
                        </div>
                        <div class="col-12">
                                <input type="submit" class="btn btn-primary w-100 py-3" name="EliminarN"  value="Eliminar noticia">
                        </div>
                    </form>
                </div>
            </div>
    </div>

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
}else{
    header("location:index.php");
}
?>