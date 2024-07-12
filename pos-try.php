<?php  

    include('product.php');
    $products = getProducts($conn);

?>

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
                                    <?php foreach($products as $product){ ?>
                                        <div class="col-4 productColContainer" data-pid="<?= $product['id'] ?>">
                                            <div class="productResultContainer">
                                                <img src="database\upload\<?= $product['img'] ?>" class="productImage" alt="">
                                                <div class="productInfoContainer">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <p class="productName"><?= $product['product_name'] ?></p>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <p class="productPrice">P<?= $product['price'] ?></p>
                                                        </div>
                                                    </div>
                                                </div>  
                                            </div>
                                        </div>
                                        <?php    }
                                        ?>
                                    </div>  
                                </div> 
                            </div>
                            <div class="col-3 posOrderContainer">
                                <div class="pos_header">
                                    <div class="setting alignRight">
                                        <a href="javascript:void(0)"><i class="fa fa-gear"> </i></a>
                                    </div>
                                    <p class="logo">IMS</p>
                                    <p class="timeAndDate">XXX XX, XXXX    XX:XX:XX XX</p>
                                </div>
                                <div class="pos_items_container">
                                    <div class="pos_items">
                                        <p class="itemNoData">No data</p>
                                    </div>
                                    <div class="item_total_container">
                                        <p class="item_total">
                                            <span class="item_total--label">TOTAL</span>
                                            <span class="item_total--value">P0.00</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="checkoutBtnContainer">
                                    <a href="javascript:void(0)" class="checkoutBtn">CHECKOUT</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            let productsJson = <?= json_encode($products) ?>;
            var products = {};

            productsJson.forEach((product) =>{
                products[product.id] = {
                    name: product.product_name,
                    stock: product.stock,
                    price: product.price
                }
            });

            console.log(products);

        </script>

         <script src="js/pos_script.js?v=<?= time() ?>"> </script>
         <?php include('partials/app-scripts.php'); ?>
    </body>
</html>
