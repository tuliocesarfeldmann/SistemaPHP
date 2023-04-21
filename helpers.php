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

?>