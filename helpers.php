<?php

enum PopupTypes {
    case SUCCESS;
    case WARNING;
    case ERROR;
}


$shouldShowPopup = false;
$popupMessage = "";
$popupType;


function setPopup($type, $message) {
    global $shouldShowPopup, $popupMessage, $popupType;
    $shouldShowPopup = true;
    $popupMessage = $message;
    $popupType = $type;
}

function showPopup() {
    global $shouldShowPopup, $popupMessage, $popupType;

    if($shouldShowPopup){
        switch($popupType) {
            case PopupTypes::SUCCESS:
                echo("<script>toastr.success(\"$popupMessage\")</script>");
                break;
            case PopupTypes::WARNING:
                echo("<script>toastr.warning(\"$popupMessage\")</script>");
                break;
            case PopupTypes::ERROR:
                echo("<script>toastr.error(\"$popupMessage\")</script>");
                break;
            default:
                echo("<script>toastr.error(\"$popupMessage\")</script>");
                break;
        }
    }
}

function createProductCard($id, $name, $price, $imageBlob, $isSalesPage = false) {
    echo("<div class=\"product\">");
    echo("<form class=\"productForm\" method=\"POST\">");
    echo("<input type=\"hidden\" name=\"product_id\" value=\"$id\">");
    echo("<img class=\"productImage\" src=\"data:image/jpeg;base64,".base64_encode($imageBlob)."\"/>");
    echo("<p class=\"productName\">$name</p>");
    echo("<p class=\"productPrice\">R$ ". number_format($price, 2, ',', '.') ."</p>");
    if(!$isSalesPage) {
      echo("<div>
              <button class=\"buyButton\" name=\"insert_cart\">Adicionar ao Carrinho</button>
          </div>");
    }
    echo("</form>");

    echo("</div>");
}

function createProductCardAdmin($id, $name, $price, $imageBlob) {
    echo("<div class=\"product\">");
    echo("<form class=\"productForm\" method=\"POST\">");
    echo("<input type=\"hidden\" name=\"product_id\" value=\"$id\">");
    echo("<img class=\"productImage\" src=\"data:image/jpeg;base64,".base64_encode($imageBlob)."\"/>");
    echo("<p class=\"productName\">$name</p>");
    echo("<p class=\"productPrice\">R$ ". number_format($price, 2, ',', '.') ."</p>");
    echo("<div>
            <button class=\"deleteItem\" name=\"deleteItem\">Excluir produto</button>
        </div>");
    echo("</form>");

    echo("</div>");
}

?>