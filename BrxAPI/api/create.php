<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../config/database.php';
    //include_once '../class/employees.php';
    include_once '../class/Q1.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new Q1($db);

    $data = json_decode(file_get_contents("php://input"));

    $item->menuItemName = $data->menuItemName;
    $item->numberSold = $data->numberSold;
    $item->itemFoodCost = $data->itemFoodCost;
    $item->itemSellPrice = $data->itemSellPrice;
    //$item->created = date('Y-m-d H:i:s');
    $item->foodCostPerc = $data->foodCostPerc;
    
    if($item->createQ1()){
        echo 'Quarter 1 created successfully.';
    } else{
        echo 'Quarter 1 could not be created.';
    }
?>