<?php include 'header.php'; ?>  


<?php


//if user is not logged in
if(!isset($_SESSION['admin_logged_in'])){

    header('location: login.php');
    exit();

}

//get orders


    //1. determine page number
    if(isset($_GET['page_no']) && $_GET['page_no'] != ""){
        // if user has entered a page number
        $page_no = $_GET['page_no'];
    }else{
        // if user has not entered a page number
        $page_no = 1;

    }


    //2. return page number of products
    $stmt1 = $conn->prepare("SELECT COUNT(*) AS total_records FROM orders");

    $stmt1->execute();

    $stmt1->bind_result($total_records);

    $stmt1->store_result();

    $stmt1->fetch();



    //3. determine number of products per page
    $total_records_per_page = 8;

    $offset = ($page_no - 1) * $total_records_per_page;

    $previous_page = $page_no - 1;
    $next_page = $page_no + 1;

    $adjacent = "2";

    $total_no_of_pages = ceil($total_records/$total_records_per_page);


    //4. get all products  
    $stmt2 = $conn->prepare("SELECT * FROM orders LIMIT $offset, $total_records_per_page");
    $stmt2->execute();
    $orders = $stmt2->get_result();



?>





<?php include 'sidemenu.php'; ?>  


        


    <div class="container page-title text-left mt-5 py-4">
    <div class="py-1">

        <p style="color:red;font-weight: 500;" class="text-center">
                <?php if(isset($_GET['order_edit_error'])){ echo $_GET['order_edit_error'];}?>
        </p>
        <p style="color:green;font-weight: 500;" class="text-center">
                <?php if(isset($_GET['order_edit_success'])){ echo $_GET['order_edit_success'];}?>
        </p>

    </div>
        <h2>DASHBOARD</h2>
        <hr class="">
        <h1>Orders</h1>
    </div>

        
 

    <div class="container">

        <table class="table table-striped table-dark">
        <thead>
            <tr>
            <th scope="col">Order Id</th>
            <th scope="col">Order Status</th>
            <th scope="col">User Id</th>
            <th scope="col">Order Date</th>
            <th scope="col">User Phone</th>
            <th scope="col">User Address</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
            </tr>
        </thead>
        <tbody>

        <?php while($order = $orders->fetch_assoc()){ ?>

            <tr>
            <th scope="row"><?php echo $order['order_id']; ?></th>
            <td><?php echo $order['order_status']; ?></td>
            <td><?php echo $order['user_id']; ?></td>
            <td><?php echo $order['order_date']; ?></td>
            <td><?php echo $order['user_phone']; ?></td>
            <td><?php echo $order['user_address']; ?></td>
            <td><a href="edit_order.php?order_id=<?php echo $order['order_id']; ?>" class="btn btn-primary">Edit</a></td>
            <td><a href="edit_order.php?order_id=<?php echo $order['order_id']; ?>" class="btn btn-danger">Delete</a></td>
            </tr>

        <?php } ?>
        </tbody>
        </table>

    </div>



        <nav aria-label="page navigation">
                <ul class="pagination justify-content-center mt-5">
                    <li class="page-item <?php if($page_no <= 1){echo 'disabled';} ?>">
                        <a class="page-link" href="<?php if($page_no <= 1){echo '#';}else{ echo '?page_no='.($page_no-1);} ?>">Previous</a>
                    </li>
                    <li class="page-item <?php if($page_no == 1){echo 'active';}?>"><a class="page-link" href="?page_no=1">1</a></li>
                    <li class="page-item <?php if($page_no == 2){echo 'active';}else if($total_no_of_pages < 2){echo 'disabled';} ?>" aria-current="page">
                        <a class="page-link" href="?page_no=2">2</a>
                    </li>
                    <?php if($total_no_of_pages > 2){ ?>
                        <li class="page-item"><a class="page-link" href="#">...</a></li>
                        <li class="page-item <?php if($page_no > 2){ echo 'active'; }?>"><a class="page-link" href="<?php if($page_no < 3){ echo '?page_no=3'; }else{ echo '?page_no='.$page_no; }?>">
                            <?php if($page_no < 3){ echo 3; }else{ echo $page_no; } ?></a></li>
                    <?php } ?>
                    <li class="page-item <?php if($page_no >= $total_no_of_pages){echo 'disabled';} ?>">
                        <a class="page-link" href="<?php if($page_no >= $total_no_of_pages){echo '#';}else{ echo '?page_no='.($page_no+1);} ?>">Next</a>
                    </li>
                </ul>
        </nav>




<?php include 'footer.php'; ?>  
