<?php

function getWsdl($env)
{
    $wsdl = array(
        "https://preprod.cmd.autenticacao.gov.pt/Ama.Authentication.Frontend/CCMovelDigitalSignature.svc?wsdl",
        "https://cmd.autenticacao.gov.pt/Ama.Authentication.Frontend/CCMovelDigitalSignature.svc?wsdl"
    );

    if ($env == 0 || $env == 1) {
        return $wsdl[$env];
    } else {
        echo "No valid WSDL";
    }
}

function getClient($env = 0)
{
    $wsdl = getWsdl($env);
    $client = new SoapClient($wsdl);

    return $client;
}

function hashPrefix($hashtype, $hash)
{
    $prefix = [
        "SHA256" => b'010\r\x06\t`\x86H\x01e\x03\x04\x02\x01\x05\x00\x04',
    ];

    return $prefix[$hashtype].$hash;
}

function getCertificate($client, $args)
{
    $request_data = [
        "applicationId" => utf8_encode($args["applicationId"]),
        "userId" => $args["userId"],
    ];

    return $client->__soapCall("GetCertificate", array($request_data));
}

function ccmovelsign($client, $args, $hashtype = "SHA256")
{
    if ($args["docName"] == null) {
        $args["docName"] = "docname teste";
    }

    if ($args["hash"] == null) {
        $args["hash"] = openssl_digest(
            hash("sha256", b"Nobody inspects the spammish repetition"), "sha256"
        );
    }

    $args["hash"] = hashPrefix($hashtype, $args["hash"]);

    $request = [
        "ApplicationId" => utf8_encode($args["applicationId"]),
        "DocName" => $args["docName"],
        "Hash" => $args["hash"],
        "Pin" => $args["pin"],
        "UserId" => $args["userId"],
    ];
    
    $request_data = [
        "request" => $request,
    ];

    return $client->__soapCall("CCMovelSign", array($request_data));
}

function ccmovelmultiplesign($client, $args)
{
    $request = [
        "ApplicationId" => utf8_encode($args["applicationId"]),
        "Pin" => $args["pin"],
        "UserId" => $args["userId"],
    ];

    $doc_1 = [
        "Hash" => hash("sha256", b"Nobody inspects the spammish repetition"),
        "Name" => "docname teste1", 
        "id"   => "1234",
    ];

    $doc_2 = [
        "Hash" => hash("sha256", b"Always inspect the spammish repetition"),
        "Name" => "docname teste2", 
        "id"   => "1235",
    ];

    $documents = [
        "doc_1" => $doc_1,
        "doc_2" => $doc_2,
    ];

    $request_data = [
        "request" => $request,
        "documents" => $documents,
    ];

    return $client->__soapCall("CCMovelMultipleSign", array($request_data));
}

function validateOtp($client, $args)
{
    $request_data = [
        "applicationId" => utf8_encode($args["applicationId"]),
        "processId" => $args["processId"],
        "code" => $args["otp"],
    ];

    return $client->__soapCall("ValidateOtp", array($request_data));
}

?>