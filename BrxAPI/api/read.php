<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../config/database.php';
    include_once '../class/Q1.php';

    $database = new Database();
    $db = $database->getConnection();

    $items = new Q1($db);

    $stmt = $items->getQ1();
    $itemCount = $stmt->rowCount();


    echo json_encode($itemCount);

    if($itemCount > 0){
        
        $Q1Arr = array();
        $Q1Arr["body"] = array();
        $Q1Arr["itemCount"] = $itemCount;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "id" => $id,
                "menuItemName" => $menuItemName,
                "numberSold" => $numberSold,
                "itemFoodCost" => $itemFoodCost,
                "itemSellPrice" => $itemSellPrice,
                "foodCostPerc" => $foodCostPerc
            );

            array_push($Q1Arr["body"], $e);
        }
        echo json_encode($Q1Arr);
    }

    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>