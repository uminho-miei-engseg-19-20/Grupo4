<?php

include 'cmd_soap_msg.php';
include 'cmd_config.php';
include 'helpers.php';

$APPLICATION_ID = get_appid();
$TEXT = "test Command Line Program (for Preprod/Prod Signature CMD (SOAP) version 1.6 technical specification)\r\n";
$version = "test_cmd_wsdl.php Version 1.0\r\n";

$number = $argc;
$argm = $argv;

main($number,$argm);

function main($number, $argm) {
    if($number < 2) {
        echo "Use -h for usage :\r\n";
        echo "    test_cmd_wsdl.php -h for all operations\r\n";
        echo "    test_cmd_wsdl.php <oper1> -h for usage of operation <oper1>\r\n";
    } elseif ($number == 2) {
        handle_single($argm[1]);
    } else {
        handle_all($number,$argm);
    }
}

function handle_single($argumento) {
    switch ($argumento) {
        case '-h':
            echo "usage: test_cmd_wsdl.php [-h] [-V]\r\n";
            echo "                        {GetCertificate,gc,CCMovelSign,ms,CCMovelMultipleSign,mms,ValidateOtp,otp,TestAll,test}\r\n";
            echo "                        ...\r\n\r\n";
            echo $GLOBALS['TEXT'];
            echo "\r\n";
            echo "optional arguments:\r\n";
            echo "  -h, --help           show this help message and exit\r\n";
            echo "  -h, --help           show program version\r\n\r\n";
            echo "CCMovelDigitalSignature Service:\r\n";
            echo "  {GetCertificate,gc,CCMovelSign,ms,CCMovelMultipleSign,mms,ValidateOtp,otp,TestAll,test} -> Signature CMD (SCMD) operations\r\n\r\n";
            echo "    GetCertificate (gc)       -> Get user certificate\r\n";
            echo "    CCMovelSign (ms)          -> Start signature process\r\n";
            echo "    CCMovelMultipleSign (mms) -> Start multiple signature process\r\n";
            echo "    ValidateOtp (otp)         -> Validate OTP\r\n";
            echo "    TestAll (test)            -> Automatically test all comands\r\n";
            break;
        case '--help':
            echo "usage: test_cmd_wsdl.php [-h] [-V]\r\n";
            echo "                        {GetCertificate,gc,CCMovelSign,ms,CCMovelMultipleSign,mms,ValidateOtp,otp,TestAll,test}\r\n";
            echo "                        ...\r\n\r\n";
            echo $GLOBALS['TEXT'];
            echo "\r\n";
            echo "optional arguments:\r\n";
            echo "  -h, --help           show this help message and exit\r\n";
            echo "  -h, --help           show program version\r\n\r\n";
            echo "CCMovelDigitalSignature Service:\r\n";
            echo "  {GetCertificate,gc,CCMovelSign,ms,CCMovelMultipleSign,mms,ValidateOtp,otp,TestAll,test} -> Signature CMD (SCMD) operations\r\n\r\n";
            echo "    GetCertificate (gc)       -> Get user certificate\r\n";
            echo "    CCMovelSign (ms)          -> Start signature process\r\n";
            echo "    CCMovelMultipleSign (mms) -> Start multiple signature process\r\n";
            echo "    ValidateOtp (otp)         -> Validate OTP\r\n";
            echo "    TestAll (test)            -> Automatically test all comands\r\n";
            break;
        case '-V':
            echo $GLOBALS['version'];
            break;
        case '--version':
            echo $GLOBALS['version'];
            break;
        default:
            echo "Use -h for usage :\r\n";
            echo "    test_cmd_wsdl.php -h for all operations\r\n";
            echo "    test_cmd_wsdl.php <oper1> -h for usage of operation <oper1>\r\n";
            break;
    }
}

function handle_all($number,$argumentos){
    switch ($argumentos[1]) {
        case 'gc':
            if (($argumentos[2] == "-h" or $argumentos[2] == "--help") and $number == 3) {
                gc_help();
                break;
            }

            if (($argumentos[2] == "-prod") and ($number == 4)) {
                if (its_user($argumentos[3])) {
                    if ($number == 4) {
                        $client = getClient(1);

                        $args = [
                            "applicationId" => $GLOBALS['APPLICATION_ID'],
                            "user" => $argumentos[3],
                        ];

                        $result = getCertificate($client, $args);
                        $result = json_encode($result);
                        echo "$result\r\n";
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
                if (its_user($argumentos[4])) {
                    if ($number == 5) {
                        $client = getClient(0);

                        $args = [
                            "applicationId" => $argumentos[3],
                            "user" => $argumentos[4],
                        ];

                        $result = getCertificate($client, $args);
                        $result = json_encode($result);
                        echo "$result\r\n";
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

            if (its_user($argumentos[2]) and ($number == 3)) {
                $client = getClient(0);

                $args = [
                    "applicationId" => $GLOBALS['APPLICATION_ID'],
                    "user" => $argumentos[2],
                ];

                $result = getCertificate($client, $args);
                $result = json_encode($result);
                echo "$result\r\n";
                break;
            } else {
                echo "Wrong user\r\n";
                echo "Correct format it's '+351 NNNNNNNNN'\r\n";
                break;
            }

            echo "Wrong arguments\r\n";
            gc_help();
            break;
        case 'GetCertificate':
            if (($argumentos[2] == "-h" or $argumentos[2] == "--help") and $number == 3) {
                gc_help();
                break;
            }

            if (($argumentos[2] == "-prod") and ($number == 4)) {
                if (its_user($argumentos[3])) {
                    if ($number == 4) {
                        $client = getClient(1);

                        $args = [
                            "applicationId" => $GLOBALS['APPLICATION_ID'],
                            "user" => $argumentos[3],
                        ];

                        $result = getCertificate($client, $args);
                        $result = json_encode($result);
                        echo "$result\r\n";
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
                if (its_user($argumentos[4])) {
                    if ($number == 5) {
                        $client = getClient(0);

                        $args = [
                            "applicationId" => $argumentos[3],
                            "user" => $argumentos[4],
                        ];

                        $result = getCertificate($client, $args);
                        $result = json_encode($result);
                        echo "$result\r\n";
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

            if (its_user($argumentos[2]) and ($number == 3)) {
                $client = getClient(0);

                $args = [
                    "applicationId" => $GLOBALS['APPLICATION_ID'],
                    "user" => $argumentos[2],
                ];

                $result = getCertificate($client, $args);
                $result = json_encode($result);
                echo "$result\r\n";
                break;
            } else {
                echo "Wrong user\r\n";
                echo "Correct format it's '+351 NNNNNNNNN'\r\n";
                break;
            }

            echo "Wrong arguments\r\n";
            gc_help();
            break;
        case 'ms':
            if (($argumentos[2] == "-h" or $argumentos[2] == "--help") and $number == 3) {
                ms_help();
                break;
            } 

            if (($argumentos[2] == "-prod") and ($number == 5)) {
                if (its_user($argumentos[3])) {
                    if (its_pin($argumentos[4])) {
                        if ($number == 5) {   
                            $client = getClient(1);

                            $args = [
                                "applicationId" => $GLOBALS['APPLICATION_ID'],
                                "docName" => NULL,
                                "hash" => NULL,
                                "pin" => $argumentos[4],
                                "userId" => $argumentos[3],
                            ];

                            $result = ccmovelsign($client, $args, "SHA256");
                            $result = json_encode($result);
                            echo "$result\r\n";
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
                if (its_user($argumentos[4])) {
                    if (its_pin($argumentos[5])) {
                        if ($number == 6) {
                            echo "Chamei a função com applicationId\r\n";
                            // talvez verificar o argumentos[3] primeiro
                            // Chamar a função argumentos[3]
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

            if (its_user($argumentos[2]) and ($number == 4)) {
                if (its_pin($argumentos[3])) {
                    echo "Chamei a função com user\r\n";
                    // chamar a função com prod false e appId default
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
            ms_help();
            break;
        case 'CCMovelSign':
            // just copy above...do later
            break;
        case 'mms':
            if (($argumentos[2] == "-h" or $argumentos[2] == "--help") and $number == 3) {
                mms_help();
                break;
            } 

            if (($argumentos[2] == "-prod") and ($number == 5)) {
                if (its_user($argumentos[3])) {
                    if (its_pin($argumentos[4])) {
                        if ($number == 5) {
                            echo "Chamei a função com prod\r\n";
                            // Chamar a função prod==1
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
                if (its_user($argumentos[4])) {
                    if (its_pin($argumentos[5])) {
                        if ($number == 6) {
                            echo "Chamei a função com applicationId\r\n";
                            // talvez verificar o argumentos[3] primeiro
                            // Chamar a função argumentos[3]
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

            if (its_user($argumentos[2]) and ($number == 4)) {
                if (its_pin($argumentos[3])) {
                    echo "Chamei a função com user\r\n";
                    // chamar a função com prod false e appId default
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
            mms_help();
            break;
        case 'CCMovelMultipleSign':
            // just copy above...do later
            break;
        case 'otp':
            if (($argumentos[2] == "-h" or $argumentos[2] == "--help") and $number == 3) {
                otp_help();
                break;
            } 

            if (($argumentos[2] == "-prod") and ($number == 5)) {
                if (its_otp($argumentos[3])) {
                    if (its_processId($argumentos[4])) {
                        if ($number == 5) {
                            echo "Chamei a função com prod\r\n";
                            // Chamar a função prod==1
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
                if (its_otp($argumentos[4])) {
                    if (its_processId($argumentos[5])) {
                        if ($number == 6) {
                            echo "Chamei a função com applicationId\r\n";
                            // talvez verificar o argumentos[3] primeiro
                            // Chamar a função argumentos[3]
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

            if (its_otp($argumentos[2]) and ($number == 4)) {
                if (its_processId($argumentos[3])) {
                    echo "Chamei a função com otp\r\n";
                    // chamar a função com prod false e appId default
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
            otp_help();
            break;
        case 'ValidateOtp':
            // just copy above...do later
            break;
        case 'test':
            if (($argumentos[2] == "-h" or $argumentos[2] == "--help") and $number == 3) {
                test_help();
                break;
            } 

            if (($argumentos[2] == "-prod") and ($number == 6)) {
                if ($myfile = fopen($argumentos[3],"r")) {
                    $readFile = fread($myfile,filesize($argumentos[3]));    
                    if (its_user($argumentos[4])) {
                        if (its_pin($argumentos[5])) {
                            if ($number == 6) {
                                echo "Chamei a função com prod\r\n";
                                // Chamar a função prod==1
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
            }

            if (($argumentos[2] == "-applicationId") and ($number == 7)) {
                if ($myfile = fopen($argumentos[4],"r")) {
                    $readFile = fread($myfile,filesize($argumentos[4])); 
                    if (its_user($argumentos[5])) {
                        if (its_pin($argumentos[6])) {
                            if ($number == 7) {
                                echo "Chamei a função com prod\r\n";
                                // Chamar a função prod==1
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
            }

            if ($myfile = fopen($argumentos[2],"r") and ($number == 5)) {
                $readFile = fread($myfile,filesize($argumentos[2])); 
                if (its_user($argumentos[3])) {
                    if (its_pin($argumentos[4])) {
                        if ($number == 5) {
                            echo "chamei função\r\n";
                            // Chamar função
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
            test_help();
            break;
        case 'TestAll':
            test_all();
            break;
        default:
            echo "Use -h for usage :\r\n";
            echo "    test_cmd_wsdl.php -h for all operations\r\n";
            echo "    test_cmd_wsdl.php <oper1> -h for usage of operation <oper1>\r\n";
            break;
    }
}

function test_all() {
    $line = readline("Introduza o OTP recebido no seu dispositivo: ");
    if (its_otp($line)) {

    } else {
        echo "OTP format not valid. Try Again.\r\n";
    }
}
?>