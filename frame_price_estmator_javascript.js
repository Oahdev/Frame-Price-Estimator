//getting the users input
const result = document.getElementById("result"),
widt = document.getElementById("width"),
heigh = document.getElementById("height"),
option = document.getElementById("option"),
toMetre = [0.001,0.01,0.0254];
function submit(){
    width = parseInt(widt.value),
    height = parseInt(heigh.value);
    // converting to metre
    switch (option.value) {
        case "mm":
            widthInMetre = width * toMetre[0],
            heightInMetre = height * toMetre[0];
            break;
        case "cm":
            widthInMetre = width * toMetre[1],
            heightInMetre = height * toMetre[1];
            break;
        default:
            widthInMetre = width * toMetre[2],
            heightInMetre = height * toMetre[2];
            break;
    }
    //finding the area
    area = (widthInMetre * heightInMetre);
    price = (area * area) + (100 * area) + (6);
    //getting the longest length
    if (widthInMetre > heightInMetre) {long = widthInMetre;}
    if (heightInMetre > widthInMetre) {long = heightInMetre;}
    //the postage system
    if (document.getElementById("economy").checked == true) {postagePrice = (2 * long) + 4;}
    if (document.getElementById("rapid").checked == true) {postagePrice = (3 * long) + 8;}
    if (document.getElementById("nextday").checked == true) {postagePrice = (5 * long) + 12;}
    function post(){
        if (document.getElementById("economy").checked == true) {return "economy";}
        if (document.getElementById("rapid").checked == true) {return "rapid";}
        if (document.getElementById("nextday").checked == true) {return "nextday";}
    }
    //converting to 2 decimal places
    finalPrice = price.toFixed(2);
    finalpostagePrice = postagePrice.toFixed(2);
    //vat and total cost
    if (document.getElementById("vat").checked == true) {
        vatPrice = (0.2) * (postagePrice);
        total = (price + postagePrice + vatPrice);
        finalTotal = total.toFixed(2);
        //printing the result
        result.innerHTML = "Your frame cost £<b>"+finalPrice+"</b> plus "+post()+" postage of £<b>"+finalpostagePrice+"</b>, giving a total of £<b>"+finalTotal+"</b> including <b>VAT</b>.";
    }
    if (document.getElementById("vat").checked == false) {
        total = (postagePrice + price);
        finalTotal = total.toFixed(2);
        //printing the result
        result.innerHTML = "Your frame cost £<b>"+finalPrice+"</b> plus "+post()+" postage of £<b>"+finalpostagePrice+"</b>, giving a total of £<b>"+finalTotal+"</b> excluding <b>VAT</b>.";
    }
}