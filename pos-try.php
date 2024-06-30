<!DOCTYPE html>
<html lang="en">
<head>
    <meta chatset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POS</title> 
    <link rel="stylesheet" type="text/css" href="css/login.css?v=<?= time() ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-9">
                <div class="searchInputContainer">
                    <input type="text" placeholder="Search Product...">
                </div>       
                <div class="searchResultContainer">
                    <div class="row">
                        <div class="col-4">
                            <div class="productResultContainer">
                                <img src="images/sakto.png" alt="">
                                <div class="productInfoContainer">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <p class="productName">1.5kg Sakto</p>
                                        </div>
                                        <div class="col-md-4">
                                            <p class="productPrice"> P155.00</p>
                                        </div>
                                    </div>
                                </div>  
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="productResultContainer">
                                <img src="images/11kg.png" alt="">
                                <div class="productInfoContainer">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <p class="productName">11kg Cylinder</p>
                                        </div>
                                        <div class="col-md-4">
                                            <p class="productPrice"> P1016.00</p>
                                        </div>
                                    </div>
                                </div>  
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="productResultContainer">
                                <img src="images/50kg.png" alt="">
                                <div class="productInfoContainer">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <p class="productName">50kg Cylinder</p>
                                        </div>
                                        <div class="col-md-4">
                                            <p class="productPrice"> P000.00</p>
                                        </div>
                                    </div>
                                </div>  
                            </div>
                        </div>
                       
                    </div>  
                </div>                
            </div>
            <div class="col-3">
                col
            </div>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>