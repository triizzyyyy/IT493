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
    
    $data = json_decode(file_get_contents("php://input"));
    
    $item->id = $data->id;
    
    // Q1 values
    $item->menutItemName = $data->menutItemName;
    $item->numberSold = $data->numberSold;
    $item->itemFoodCost = $data->itemFoodCost;
    $item->itemSellPrice = $data->itemSellPrice;
    $item->foodCostPerc = $data->foodCostPerc;
    $item->brxMenuID = $data->brxMenuID;
    
    if($item->updateQ1()){
        echo json_encode("Q1 data updated.");
    } else{
        echo json_encode("Data could not be updated");
    }
?>