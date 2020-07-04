<?php
/*
import hashlib            # hash SHA256
import logging.config     # debug
from zeep import Client   # zeep para SOAP
from zeep.transports import Transport
*/

function debug(){
    // completar
}

function get_wsdl($env) {
    $wsdl = array("https://preprod.cmd.autenticacao.gov.pt/Ama.Authentication.Frontend/CCMovelDigitalSignature.svc?wsdl",
                  "https://cmd.autenticacao.gov.pt/Ama.Authentication.Frontend/CCMovelDigitalSignature.svc?wsdl");

    if ($env == 0 || $env == 1) {
        return $wsdl[env];
    } else {
        echo "No valid WSDL";
    }
}

function getClient($env = 0, $timeout = 10){

    //transport = Transport(timeout);
    //return Client(get_wsdl(env),trasport);
}

function hashPrefix(hashtype, hash){
    /*
    prefix = {
        "SHA256" = bytes(bytearray([0x30, 0x31, 0x30, 0x0d, 0x06, 0x09, 0x60, 0x86, 0x48, 0x01, 
                                    0x65, 0x03, 0x04, 0x02, 0x01, 0x05, 0x00, 0x04, 0x20])),
    };
    */
    //return prefix.get(hashtype) + hash;
}

function getCertificate(client, args){

    request_data = [
        "applicationId" = args["applicationId"].encode("UTF-8"), // Encode
        "userId" = args["user"],
    ];

    //return client.service.GetCertificate(request_data);
}

function ccmovelsign(client, args, hashtype = "SHA256"){
    
    if (args["docName"] == NULL){
        args["docName"] = "docname teste";
    }
    if (args["hash"] == NULL){
        args["hash"] = hashlib.sha256(b"Nobody inspects the spammish repetition").digest();
    }
    args["hash"] = hashPrefix(hashtype, args["hash"]);

    request = [
        "ApplicationId": args["applicationId"].encode("UTF-8"), // python
        "DocName": args["docName"],
        "Hash": args["hash"],
        "Pin": args["pin"],
        "UserId": args["user"],
    ];
    
    request_data = [
        "request" = request;
    ];

    //return client.service.CCMovelSign(request_data);
}

function ccmovelmultiplesign(client, args){

    request = [
        "ApplicationId": args["applicationId"].encode("UTF-8"),
        "Pin": args["pin"],
        "UserId": args["user"],
    ];

    doc_1 = [
        "Hash" = hashlib.sha256(b"Nobody inspects the spammish repetition").digest(),
        "Name" = "docname teste1", 
        "id"   = "1234",
    ];

    doc_2 = [
        "Hash" = hashlib.sha256(b"Always inspect the spammish repetition").digest(),
        "Name" = "docname teste2", 
        "id"   = "1235",
    ];

    HashStructure = [
        "doc_1" = doc_1,
        "doc_2" = doc_2,
    ];

    documents = [
        "HashStructure" = HashStructure,
    ];

    request_data = [
        "request" = request;
        "documents" = documents
    ];

    //return client.service.CCMovelMultipleSign(request_data);
}

function validate_otp(client, args){

    request_data = [
        "applicationId" = args["applicationId"].encode("UTF-8"),
        "processId" = args["ProcessId"],
        "code" = args["OTP"],
    ];

    //return client.service.ValidateOtp(request_data);
}

?>