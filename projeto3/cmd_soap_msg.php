<?php
function get_wsdl($env) {
    $wsdl = array("https://preprod.cmd.autenticacao.gov.pt/Ama.Authentication.Frontend/CCMovelDigitalSignature.svc?wsdl",
                  "https://cmd.autenticacao.gov.pt/Ama.Authentication.Frontend/CCMovelDigitalSignature.svc?wsdl");

    if ($env == 0 || $env == 1) {
        return $wsdl[env];
    } else {
        echo "No valid WSDL";
    }
}

?>