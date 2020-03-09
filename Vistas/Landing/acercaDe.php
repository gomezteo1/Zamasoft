<!DOCTYPE html>
<html lang="en">
<head>
    <style>
@import url(https://fonts.googleapis.com/css?family=Erica+One);

::selection {
    background: transparent;
}
@-webkit-keyframes bounce {
    100% {
       
        text-shadow: 0 1px 0 #CCC, 0 2px 0 #CCC, 0 3px 0 #CCC, 0 4px 0 #CCC, 0 5px 0 #CCC, 0 6px 0 #CCC, 0 7px 0 #CCC, 0 8px 0 #CCC, 0 9px 0 #CCC, 0 30px 30px rgba(0, 0, 0, .3); }
}


h1 {
    cursor: default;
    position: absolute;
    top: -300px;
    left: 0;
    right: 0;
    bottom: 0;
    height: 100px;
    margin: auto;
    display: block;
    -webkit-animation: bounce .3s ease infinite alternate;
    font-family: 'sans-serif';
    font-size: 70px;
    color: #000000;
    text-align: center;
    line-height: 100px;
    text-shadow: 0 1px 0 #CCC, 0 2px 0 #CCC, 0 3px 0 #CCC, 0 4px 0 #CCC, 0 5px 0 #CCC, 0 6px 0 transparent, 0 7px 0 transparent, 0 8px 0 transparent, 0 9px 0 transparent, 0 10px 10px rgba(0, 0, 0, .6);
}

    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acerca de</title>
</head>
<body>
    <br>
    <div class="container">
        <div class="row">
            
            <div class="col-3">
                 <div class="h-75 jumbotron text-center">
                     
                    <h1>Imagenes del lugar</h1>
                </div>
            </div> 
            <div class="col-1"></div>
            <div class="col-7">
                <div class="container-login100">
                    <div id="carouselExampleControls" class="carousel slide"  data-ride="carousel">
                        <div class="carousel-inner" >
                            <div class="carousel-item active">
                                <img class="d-block w-100 h-75" src="image/1.jpg" alt="Firt slide">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100 h-75" src="image/2.jpg" alt="Firt slide">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100 h-75" src="image/3.jpg" alt="Firt slide">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100 h-75" src="image/4.jpg" alt="Firt slide">
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>    
    </div>



    <!-- <div class="container container ">
        <div class="row">
            <div class="col-4">  
                <h3>¿Quienes Somos?</h3>
                <p>Lorem ipsum dolor..</p>
            </div>
            <div class="col-4">
                <h3>Column 2</h3>
                <p>Lorem ipsum dolor..</p>
            </div>
            <div class="col-4">
                <h3>Column 3</h3>
                <p>Lorem ipsum dolor..</p>
            </div>
        </div>
    </div> -->

</body>
</html>
