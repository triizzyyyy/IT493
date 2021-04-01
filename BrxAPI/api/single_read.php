<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../config/database.php';
    include_once '../class/Q1.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new Q1($db);

    $item->id = isset($_GET['id']) ? $_GET['id'] : die();
  
    $item->getSingleQ1();

    if($item->name != null){
        // create array
        $emp_arr = array(
            "brxMenuID" =>  $item->brxMenuID,
            "menuItemName" => $item->menuItemName,
            "numberSold" => $item->numberSold,
            "itemFoodCost" => $item->itemFoodCost,
            "itemSellPrice" => $item->itemSellPrice,
            "foodCostPerc" => $item->foodCostPerc
        );
      
        http_response_code(200);
        echo json_encode($emp_arr);
    }
      
    else{
        http_response_code(404);
        echo json_encode("Q1 item not found.");
    }
?>