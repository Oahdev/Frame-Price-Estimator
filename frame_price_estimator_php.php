<?php
$result = "";
if(isset($_POST['submit'])){
    //collecting user data 
    $width = $_POST["photo-width"];              
    $height = $_POST["photo-height"];
    if($width == "" || $height == ""){
        $result = "<b>Enter the Photo width and Photo height</b>";
    }else{
        // setting up the required variables   
        $postage = $_POST["postage"];
        $value = $_POST["value"];
        $toMetre = [0.001,0.01,0.0254];
        //converting values to metre
        if ($value == "mm") {
            $widthInMetre = ($width) * floatval($toMetre[0]);
            $heightInMetre = ($height) * floatval($toMetre[0]);
        }
        elseif ($value == "cm") {
            $widthInMetre = ($width) * floatval($toMetre[1]);
            $heightInMetre = ($height) * floatval($toMetre[1]);
        }
        else{
            $widthInMetre = ($width) * floatval($toMetre[2]);
            $heightInMetre = ($height) * floatval($toMetre[2]);
        }
        // finding the area
        $area = $widthInMetre * $heightInMetre;
        $price = ($area * $area) + (100 * $area) + (6);
        // getting the longest length
        $long = max($widthInMetre,$heightInMetre);
        // the postage system
        if ($postage == "economy") {$postagePrice = (2 * $long) + 4;}
        elseif($postage == "rapid") {$postagePrice = (3 * $long) + 8;}
        elseif($postage == "nextday") {$postagePrice = (5 * $long) + 12;}
        // conveting to 2 decimal place
        $price = number_format(floatval($price),2,".","");
        $postagePrice = number_format(floatval($postagePrice),2,".","");
        // vat value and total cost
        if (isset($_POST["vat"])) {
            $vat = $_POST["vat"];
            $vat = (0.2) * ($postagePrice);
            $total = ($price + $postagePrice + $vat);
            $total = number_format(floatval($total),2,".","");
            $vat = number_format(floatval($vat),2,".","");
            // printing the result
            $result = "Your frame cost <b>£$price</b> plus <b>".strval($postage)."</b> postage of <b>£$postagePrice</b>, giving a total of <b>£$total</b> including VAT.";
        }else{
            $total = ($postagePrice + $price);
            $total = number_format(floatval($total),2,".","");
            // printing the result
            $result =  "Your frame cost <b>£$price</b> plus <b>".strval($postage)."</b> postage of <b>£$postagePrice</b>, giving a total of <b>£$total</b> excluding VAT.";
        }
    }
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Frame Price Estimator</title>
</head>
<body>
    <div class="container">
        <h1>Frame Price Estimator</h1>
        <p>Please enter your photo sizes to get a framing cost estimate.</p>
        <form action="frame_price_estimator_php.php" method="post" >
            
            <label for="photo-width">Photo Width:</label>
            <input type="number" step="0.1" name="photo-width">
            <select name="value">
                <option value="mm">mm</option>
                <option value="cm">cm</option>
                <option value="in">inch</option>
            </select>
            <br><br>
            <label for="photo-height">Photo Height:</label>
            <input type="number" step="0.1" name="photo-height">
            <br><br>
            <label for="postage">Postage:</label>
            <input type="radio" checked name="postage" value="economy">Economy
            <input type="radio" name="postage" value="rapid">Rapid
            <input type="radio" name="postage" value="nextday">NextDay
            <br><br>
            <input type="checkbox" checked name="vat">Include VAT in price
            <br><br>
            <input type="submit" name="submit">
            <br>
            <p><?php echo $result;?></p>
        </form>
    </div>
</body>
</html>
