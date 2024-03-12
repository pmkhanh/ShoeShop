<?php

session_start();
require_once './config/database.php';




?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Shop Giày</title>

    <!-- font -->
    <link
      href="https:/fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap"
      rel="stylesheet"
    />

    <!-- bootstrap -->
    <link
      href="https:/cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD"
      crossorigin="anonymous"
    />

    <!-- font awesome -->
    <link
      rel="stylesheet"
      href="https:/cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
      integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />

    <!-- style -->
    <link
      rel="stylesheet"
      type="text/css"
      href="/css/style.css"
    />
    <link
      rel="stylesheet"
      type="text/css"
      href="./public/css/login.css"
    />
  </head>
  <body>
    <?php
    include_once('./partial/navbar.php')
    ?>
    <h1 class='text-center text-white'>Sản phẩm</h1>
        <div class="container row mx-auto p-3 gap-3">
            <?php 
            if(isset($_GET['search']) && ($_GET['search'])){
              $data=$_GET['search'];
              $query = "SELECT * FROM product where name like '%".$data."%'";
            }else{
              $query = 'SELECT * FROM product';
            }
            $sth = $pdo->query($query);
            while($row=$sth->fetch()){
            ?>
            <div class="card col-3" style="width: 18rem; border-radius: 14px ">
                <img class="card-img-top mt-2" style="border-radius: 6px; height: 150px;" src="images/<?=htmlspecialchars($row['image'])?>">
                <div class="card-body">
                    <div class="box-title">
                        <h5 class="card-title"><?=htmlspecialchars($row['name'])?></h5>
                    </div>
                                
                    <div class="box-text">
                        <p class=" pl-1"><?=htmlspecialchars(number_format($row['price'], 0, ',', '.') . ' vnđ')?> </p>
                        <div>
                        <?php
                            $id = htmlspecialchars($row['id']);
                            echo "<button class='btn-primary create_order_button' data-product-id=$id id='create_order_button'>Mua luôn</button>";
                        ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php }?>

       </div>
       <div id="toast" style="display:none; background-color: #333; color: white; padding: 10px; position: fixed; top: 10px; right: 10px; z-index: 999;">
        Đơn hàng đã được tạo!
    </div>
    <!-- jquery -->
    <script
      src="https:/code.jquery.com/jquery-3.6.3.min.js"
      integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU="
      crossorigin="anonymous"
    ></script>

    <!-- bootstrap -->
    <script
      src="https:/cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
      integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
      crossorigin="anonymous"
    ></script>
    <script
      src="https:/cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"
      integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD"
      crossorigin="anonymous"
    ></script>

    <!-- js -->
    <script type="text/javascript">
     
    </script>

    <script>
        $(document).ready(function() {
            $('.create_order_button').click(function() {
              const productId = $(this).data('product-id');
                $.ajax({
                    type: 'POST',
                    url: 'add_order.php',
                    data: { productId }, 
                    success: function(response) {
                        $('#toast').show();
                        setTimeout(function() {
                            $('#toast').hide();
                        }, 3000);
                    }
                });
            });
        });
    </script>
  </body>
</html>