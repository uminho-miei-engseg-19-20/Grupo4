<?php

include 'cmd_soap_msg.php';
include 'cmd_config.php';
include 'helpers.php';

$APPLICATION_ID = getAppid();
$TEXT = "test Command Line Program (for Preprod/Prod Signature CMD
    (SOAP) version 1.6 technical specification)\r\n";
$version = "test_cmd_wsdl.php Version 1.0\r\n";

$number = $argc;
$argm = $argv;

main($number, $argm);

function main($number, $argm)
{
    if ($number < 2) {
        defaultHelp();
    } elseif ($number == 2) {
        handleSingle($argm[1]);
    } else {
        handleAll($number, $argm);
    }
}

function handleSingle($argumento)
{
    switch ($argumento) {
    case '-h':
        helpHelp();
        break;
    case '--help':
        helpHelp();
        break;
    case '-V':
        echo $GLOBALS['version'];
        break;
    case '--version':
        echo $GLOBALS['version'];
        break;
    default:
        defaultHelp();
        break;
    }
}

function handleAll($number,$argumentos)
{
    switch ($argumentos[1]) {
    case 'gc':
    case 'GetCertificate':
        if (($argumentos[2] == "-h" or $argumentos[2] == "--help")
            and $number == 3
        ) {
            gcHelp();
            break;
        }

        if (($argumentos[2] == "-prod") and ($number == 4)) {
            if (itsUser($argumentos[3])) {
                if ($number == 4) {
                    $client = getClient(1);

                    $args = [
                        "applicationId" => $GLOBALS['APPLICATION_ID'],
                        "userId" => $argumentos[3],
                    ];

                    $result = getCertificate($client, $args);
                    $result = json_decode(json_encode($result), true);
                    print_r($result);
                    break;
                } else {
                    echo "Wrong number of arguments, check -h for help.\r\n";
                    break;
                }
            } else {
                echo "Wrong user\r\n";
                echo "Correct format it's '+351 NNNNNNNNN'\r\n";
                break;
            }
        }

        if (($argumentos[2] == "-applicationId") and ($number == 5)) {
            if (itsUser($argumentos[4])) {
                if ($number == 5) {
                    $client = getClient(0);

                    $args = [
                        "applicationId" => $argumentos[3],
                        "userId" => $argumentos[4],
                    ];

                    $result = getCertificate($client, $args);
                    $result = json_decode(json_encode($result), true);
                    print_r($result);
                    break;
                } else {
                    echo "Wrong number of arguments, check -h for help.\r\n";
                    break;
                }
            } else {
                echo "Wrong user\r\n";
                echo "Correct format it's '+351 NNNNNNNNN'\r\n";
                break;
            }
        }

        if (itsUser($argumentos[2]) and ($number == 3)) {
            $client = getClient(0);

            $args = [
                "applicationId" => $GLOBALS['APPLICATION_ID'],
                "userId" => $argumentos[2],
            ];

            $result = getCertificate($client, $args);
            $result = json_decode(json_encode($result), true);
            print_r($result);
            break;
        } else {
            echo "Wrong user\r\n";
            echo "Correct format it's '+351 NNNNNNNNN'\r\n";
            break;
        }

        echo "Wrong arguments\r\n";
        gcHelp();
        break;
    case 'ms':
    case 'CCMovelSign':
        if (($argumentos[2] == "-h" or $argumentos[2] == "--help")
            and $number == 3
        ) {
            msHelp();
            break;
        } 

        if (($argumentos[2] == "-prod") and ($number == 5)) {
            if (itsUser($argumentos[3])) {
                if (itsPin($argumentos[4])) {
                    if ($number == 5) {   
                        $client = getClient(1);

                        $args = [
                            "applicationId" => $GLOBALS['APPLICATION_ID'],
                            "docName" => null,
                            "hash" => null,
                            "pin" => $argumentos[4],
                            "userId" => $argumentos[3],
                        ];

                        $result = ccmovelsign($client, $args, "SHA256");
                        $result = json_decode(json_encode($result), true);
                        print_r($result);
                        break;
                    } else {
                        echo "Wrong number of arguments, check -h for help.\r\n";
                        break;
                    }
                } else {
                    echo "Wrong pin format\r\n";
                    break;
                }
            } else {
                echo "Wrong user\r\n";
                echo "Correct format it's '+351 NNNNNNNNN'\r\n";
                break;
            }
        }

        if (($argumentos[2] == "-applicationId") and ($number == 6)) {
            if (itsUser($argumentos[4])) {
                if (itsPin($argumentos[5])) {
                    if ($number == 6) {
                        $client = getClient(0);

                        $args = [
                            "applicationId" => $argumentos[3],
                            "docName" => null,
                            "hash" => null,
                            "pin" => $argumentos[5],
                            "userId" => $argumentos[4],
                        ];

                        $result = ccmovelsign($client, $args, "SHA256");
                        $result = json_decode(json_encode($result), true);
                        print_r($result);
                        break;
                    } else {
                        echo "Wrong number of arguments, check -h for help.\r\n";
                        break;
                    }
                } else {
                    echo "Wrong pin format\r\n";
                    break;
                }    
            } else {
                echo "Wrong user\r\n";
                echo "Correct format it's '+351 NNNNNNNNN'\r\n";
                break;
            }
        }

        if (itsUser($argumentos[2]) and ($number == 4)) {
            if (itsPin($argumentos[3])) {
                $client = getClient(0);

                $args = [
                    "applicationId" => $GLOBALS['APPLICATION_ID'],
                    "docName" => null,
                    "hash" => null,
                    "pin" => $argumentos[3],
                    "userId" => $argumentos[2],
                ];

                $result = ccmovelsign($client, $args, "SHA256");
                $result = json_decode(json_encode($result), true);
                print_r($result);
                break;
            } else {
                echo "Wrong pin format\r\n";
                break;
            }    
        } else {
            echo "Wrong user\r\n";
            echo "Correct format it's '+351 NNNNNNNNN'\r\n";
            break;
        }

        echo "Wrong arguments\r\n";
        msHelp();
        break;
    case 'mms':
    case 'CCMovelMultipleSign':
        if (($argumentos[2] == "-h" or $argumentos[2] == "--help")
            and $number == 3
        ) {
            mmsHelp();
            break;
        } 

        if (($argumentos[2] == "-prod") and ($number == 5)) {
            if (itsUser($argumentos[3])) {
                if (itsPin($argumentos[4])) {
                    if ($number == 5) {
                        $client = getClient(1);

                        $args = [
                            "applicationId" => $GLOBALS['APPLICATION_ID'],
                            "pin" => $argumentos[4],
                            "userId" => $argumentos[3],
                        ];

                        $result = ccmovelmultiplesign($client, $args);
                        $result = json_decode(json_encode($result), true);
                        print_r($result);
                        break;
                    } else {
                        echo "Wrong number of arguments, check -h for help.\r\n";
                        break;
                    }
                } else {
                    echo "Wrong pin format\r\n";
                    break;
                }
            } else {
                echo "Wrong user\r\n";
                echo "Correct format it's '+351 NNNNNNNNN'\r\n";
                break;
            }
        }

        if (($argumentos[2] == "-applicationId") and ($number == 6)) {
            if (itsUser($argumentos[4])) {
                if (itsPin($argumentos[5])) {
                    if ($number == 6) {
                        $client = getClient(0);

                        $args = [
                            "applicationId" => $argumentos[3],
                            "pin" => $argumentos[5],
                            "userId" => $argumentos[4],
                        ];

                        $result = ccmovelmultiplesign($client, $args);
                        $result = json_decode(json_encode($result), true);
                        print_r($result);
                        break;
                    } else {
                        echo "Wrong number of arguments, check -h for help.\r\n";
                        break;
                    }
                } else {
                    echo "Wrong pin format\r\n";
                    break;
                }    
            } else {
                echo "Wrong user\r\n";
                echo "Correct format it's '+351 NNNNNNNNN'\r\n";
                break;
            }
        }

        if (itsUser($argumentos[2]) and ($number == 4)) {
            if (itsPin($argumentos[3])) {
                $client = getClient(0);

                $args = [
                    "applicationId" => $GLOBALS['APPLICATION_ID'],
                    "pin" => $argumentos[3],
                    "userId" => $argumentos[2],
                ];

                $result = ccmovelmultiplesign($client, $args);
                $result = json_decode(json_encode($result), true);
                print_r($result);
                break;
            } else {
                echo "Wrong pin format\r\n";
                break;
            }    
        } else {
            echo "Wrong user\r\n";
            echo "Correct format it's '+351 NNNNNNNNN'\r\n";
            break;
        }

        echo "Wrong arguments\r\n";
        mmsHelp();
        break;
    case 'otp':
    case 'ValidateOtp':
        if (($argumentos[2] == "-h" or $argumentos[2] == "--help")
            and $number == 3
        ) {
            otpHelp();
            break;
        } 

        if (($argumentos[2] == "-prod") and ($number == 5)) {
            if (itsOtp($argumentos[3])) {
                if (itsProcessId($argumentos[4])) {
                    if ($number == 5) {
                        $client = getClient(1);

                        $args = [
                            "applicationId" => $GLOBALS['APPLICATION_ID'],
                            "processId" => $argumentos[4],
                            "otp" => $argumentos[3],
                        ];
    
                        $result = validateOtp($client, $args);
                        $result = json_decode(json_encode($result), true);
                        print_r($result);
                        break;
                    } else {
                        echo "Wrong number of arguments, check -h for help.\r\n";
                        break;
                    }
                } else {
                    echo "Wrong processId format\r\n";
                    break;
                }
            } else {
                echo "Wrong user\r\n";
                echo "Correct format it's '+351 NNNNNNNNN'\r\n";
                break;
            }
        }

        if (($argumentos[2] == "-applicationId") and ($number == 6)) {
            if (itsOtp($argumentos[4])) {
                if (itsProcessId($argumentos[5])) {
                    if ($number == 6) {
                        $client = getClient(0);

                        $args = [
                            "applicationId" => $argumentos[3],
                            "processId" => $argumentos[5],
                            "otp" => $argumentos[4],
                        ];
    
                        $result = validateOtp($client, $args);
                        $result = json_decode(json_encode($result), true);
                        print_r($result);
                        break;
                    } else {
                        echo "Wrong number of arguments, check -h for help.\r\n";
                        break;
                    }
                } else {
                    echo "Wrong processId format\r\n";
                    break;
                }    
            } else {
                echo "Wrong user\r\n";
                echo "Correct format it's '+351 NNNNNNNNN'\r\n";
                break;
            }
        }

        if (itsOtp($argumentos[2]) and ($number == 4)) {
            if (itsProcessId($argumentos[3])) {
                $client = getClient(0);

                $args = [
                    "applicationId" => $GLOBALS['APPLICATION_ID'],
                    "processId" => $argumentos[3],
                    "otp" => $argumentos[2],
                ];

                $result = validateOtp($client, $args);
                $result = json_decode(json_encode($result), true);
                print_r($result);
                break;
            } else {
                echo "Wrong processId format\r\n";
                break;
            }    
        } else {
            echo "Wrong user\r\n";
            echo "Correct format it's '+351 NNNNNNNNN'\r\n";
            break;
        }

        echo "Wrong arguments\r\n";
        otpHelp();
        break;
    case 'test':
    case 'TestAll':
        if (($argumentos[2] == "-h" or $argumentos[2] == "--help")
            and $number == 3
        ) {
            testHelp();
            break;
        } 

        if (($argumentos[2] == "-prod") and ($number == 6)) {
            if ($myfile = fopen($argumentos[3], "r")) {
                fclose($myfile);
                if (itsUser($argumentos[4])) {
                    if (itsPin($argumentos[5])) {
                        if ($number == 6) {
                            $client = getClient(1);

                            $args = [
                                "applicationId" => $GLOBALS['APPLICATION_ID'],
                                "userId" => $argumentos[4],
                                "pin" => $argumentos[5],
                                "file" => $argumentos[3],
                            ];
                            testAll($client, $args);
                            break;
                        } else {
                            echo "Wrong number of arguments, check -h for help.";
                            echo "\r\n";
                            break;
                        }
                    } else {
                        echo "Wrong pin format\r\n";
                        break;
                    }
                } else {
                    echo "Wrong user\r\n";
                    echo "Correct format it's '+351 NNNNNNNNN'\r\n";
                    break;
                }
            } else {
                echo "File not found\r\n";
                break;
            }
        }

        if (($argumentos[2] == "-applicationId") and ($number == 7)) {
            if ($myfile = fopen($argumentos[4], "r")) {
                fclose($myfile);
                if (itsUser($argumentos[5])) {
                    if (itsPin($argumentos[6])) {
                        if ($number == 7) {
                            $client = getClient(0);

                            $args = [
                                "applicationId" => $argumentos[3],
                                "userId" => $argumentos[5],
                                "pin" => $argumentos[6],
                                "file" => $argumentos[4],
                            ];
                            testAll($client, $args);
                            break;
                        } else {
                            echo "Wrong number of arguments, check -h for help.";
                            echo "\r\n";
                            break;
                        }
                    } else {
                        echo "Wrong pin format\r\n";
                        break;
                    }
                } else {
                    echo "Wrong user\r\n";
                    echo "Correct format it's '+351 NNNNNNNNN'\r\n";
                    break;
                }
            } else {
                echo "File not found\r\n";
                break;
            }
        }

        if ($myfile = fopen($argumentos[2], "r") and ($number == 5)) {
            fclose($myfile);
            if (itsUser($argumentos[3])) {
                if (itsPin($argumentos[4])) {
                    if ($number == 5) {
                        $client = getClient(0);

                        $args = [
                            "applicationId" => $GLOBALS['APPLICATION_ID'],
                            "userId" => $argumentos[3],
                            "pin" => $argumentos[4],
                            "file" => $argumentos[2],
                            "hash" => null,
                            "docName" => null,
                            "otp" => null,
                        ];
                        testAll($client, $args);
                        break;
                    } else {
                        echo "Wrong number of arguments, check -h for help.\r\n";
                        break;
                    }
                } else {
                    echo "Wrong pin format\r\n";
                    break;
                }
            } else {
                echo "Wrong user\r\n";
                echo "Correct format it's '+351 NNNNNNNNN'\r\n";
                break;
            }
        } else {
            echo "File not found\r\n";
            break;
        }

        echo "Wrong arguments\r\n";
        testHelp();
        break;
    default:
        defaultHelp();
        break;
    }
}

function testAll($client, $args)
{
    echo $GLOBALS['TEXT'];
    echo "\r\n";
    echo $GLOBALS['version'];
    echo "\r\n\r\n+++ Test All inicializado +++\r\n\r\n";
    echo "0% ... Leitura de argumentos da linha de comando:\r\n";
    echo "              File: ";
    echo $args['file'];
    echo "\r\n";
    echo "              User: ";
    echo $args['userId'];
    echo "\r\n";
    echo "              Pin:  ";
    echo $args['pin'];
    echo "\r\n\r\n";
    echo "10% ... A contactar servidor SOAP CMD para operação GetCertificate\r\n";

    $cmd_certs = getCertificate($client, $args);
    $certs = json_decode(json_encode($cmd_certs), true);

    if ($certs == null) {
        echo "Não é possível obter o certificado.";
        exit;
    }

    $cert_split = stringSplit($certs);

    $cert_chain = [
        "User" => openssl_x509_parse($cert_split[0]),
        "Root" => openssl_x509_parse($cert_split[1]),
        "CA" => openssl_x509_parse($cert_split[2]),
    ];

    $userString = openssl_x509_parse($cert_split[0])["subject"]["CN"];
    $rootString = openssl_x509_parse($cert_split[1])["subject"]["CN"];
    $caString = openssl_x509_parse($cert_split[2])["subject"]["CN"];

    echo "\r\n20% ... Certificado emitido para ";
    echo $userString;
    echo " pela Entidade de Certificação ";
    echo $caString;
    echo " na hierarquia do ";
    echo $rootString;
    echo "\r\n\r\n30% ... Leitura do ficheiro ";
    echo $args['file'];
    echo "\r\n";

    if ($myfile = fopen($args["file"], "r")) {
        echo $myfile;
        $readFile = fread($myfile, filesize($args["file"]));
    } else {
        echo "File not found";
        exit();
    }

    echo "\r\n40% ... Geração de hash do ficheiro ";
    echo $args['file'];

    $args["hash"] = openssl_digest((hash("sha256", $readFile)), "sha256");

    echo "\r\n\r\n50% ... Hash gerada (em base64): ";
    echo utf8_decode(base64_encode($args["hash"]));     
    echo "\r\n\r\n";
    echo "60% ... A contactar servidor SOAP CMD para operação CCMovelSign\r\n";

    $args["docName"] = $args["file"];
    $res = ccmovelsign($client, $args);
    $res = json_decode(json_encode($res), true);

    if (($res['CCMovelSignResult']['Code']) != 200) {
        echo "\r\nErro ";
        echo $res['CCMovelSignResult']['Code'];
        echo "\r\nValide o PIN introduzido.\r\n";
        exit();
    }

    echo "\r\n70% ... ProcessID devolvido pela operação CCMovelSign: ";
    echo $res['CCMovelSignResult']['ProcessId'];

    $args["processId"] = $res['CCMovelSignResult']["ProcessId"];

    echo "\r\n\r\n80% ... A iniciar operação ValidateOtp\r\n";

    $line = readline("Introduza o OTP recebido no seu dispositivo: ");

    if (itsOtp($line)) {
        echo "\r\n";
        echo "90% ... A contactar servidor SOAP CMD para operação ValidateOtp\r\n";
        
        $args["otp"] = $line;
        $res = validateOtp($client, $args);
        $res = json_decode(json_encode($res), true);
    } else {
        echo "OTP format not valid. Try Again.\r\n";
        exit();
    }

    if ($res['ValidateOtpResult']['Status']['Code'] != '200') {
        echo "\r\nErro ";
        echo $res['ValidateOtpResult']['Status']['Code'];
        echo ". ";
        echo $res['ValidateOtpResult']['Status']['Message'];
        exit();
    }

    echo "\r\n100% ... Assinatura (em base 64) devolvida pela operação ValidateOtp:";
    echo utf8_decode(base64_encode($res['ValidateOtpResult']['Signature']));
    echo '\r\n\r\n110% ... A validar assinatura ...\r\n';

    $digest = openssl_digest(hash("sha256", $readFile));
    $public_key = openssl_get_publickey($cert_split[0]);
    $verified = openssl_verify(
        $digest, $res['ValidateOtpResult']['Signature'], $public_key
    );
    
    echo "\r\nAssinatura verificada com sucesso, baseada na assinatura recebida,";
    echo " na hash gerada e na chave pública do certificado de ";
    echo $userString;
    echo "\r\n\r\n+++ Test All finalizado +++\r\n";
}

?>