<?php
/*
include 'cmd_soap_msg.php';
            echo "Version 1.0\r\n";

*/

include 'cmd_config.php';
include 'helpers.php';

$APPLICATION_ID = get_appid();

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

function handle_single($argumento){
    switch ($argumento) {
        case '-h':
            echo "usage: test_cmd_wsdl.py [-h] [-V]\r\n";
            echo "                        {GetCertificate,gc,CCMovelSign,ms,CCMovelMultipleSign,mms,ValidateOtp,otp,TestAll,test}\r\n";
            echo "                        ...\r\n\r\n";
            echo "test Command Line Program (for Preprod/Prod Signature CMD (SOAP) version 1.6 technical specification)\r\n\r\n";
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
            echo "usage: test_cmd_wsdl.py [-h] [-V]\r\n";
            echo "                        {GetCertificate,gc,CCMovelSign,ms,CCMovelMultipleSign,mms,ValidateOtp,otp,TestAll,test}\r\n";
            echo "                        ...\r\n\r\n";
            echo "test Command Line Program (for Preprod/Prod Signature CMD (SOAP) version 1.6 technical specification)\r\n\r\n";
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
            echo "test_cmd_wsdl.py v1.0\r\n";
            break;
        case '--version':
            echo "test_cmd_wsdl.py v1.0\r\n";
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
                        echo "Chamei a função com prod\r\n";
                        // Chamar a função prod==1
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
                        echo "Chamei a função com applicationId\r\n";
                        // talvez verificar o agumentos[3] primeiro
                        // Chamar a função argumentos[3]
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
                        echo "Chamei a função com prod\r\n";
                        // Chamar a função prod==1
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
                        echo "Chamei a função com applicationId\r\n";
                        // talvez verificar o agumentos[3] primeiro
                        // Chamar a função argumentos[3]
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

            echo "Wrong arguments\r\n";
            gc_help();
        case 'ms':
            if (($argumentos[2] == "-h" or $argumentos[2] == "--help") and $number == 3) {
                ms_help();
            }
            break;
        case 'CCMovelSign':
            if (($argumentos[2] == "-h" or $argumentos[2] == "--help") and $number == 3) {
                ms_help();
            }
            break;
        case 'mms':
            if (($argumentos[2] == "-h" or $argumentos[2] == "--help") and $number == 3) {
                mms_help();
            }
            break;
        case 'CCMovelMultipleSign':
            if (($argumentos[2] == "-h" or $argumentos[2] == "--help") and $number == 3) {
                mms_help();
            }
            break;
        case 'otp':
            if (($argumentos[2] == "-h" or $argumentos[2] == "--help") and $number == 3) {
                otp_help();
            }
            break;
        case 'ValidateOtp':
            if (($argumentos[2] == "-h" or $argumentos[2] == "--help") and $number == 3) {
                otp_help();
            }
            break;
        case 'test':
            if (($argumentos[2] == "-h" or $argumentos[2] == "--help") and $number == 3) {
                test_help();
            }
            break;
        case 'TestAll':
            echo $number;
            if (($argumentos[2] == "-h" or $argumentos[2] == "--help") and $number == 3) {
                test_help();
            }
            break;
        default:
            echo "Use -h for usage :\r\n";
            echo "    test_cmd_wsdl.php -h for all operations\r\n";
            echo "    test_cmd_wsdl.php <oper1> -h for usage of operation <oper1>\r\n";
            break;
    }
}

function test_all(){
    // completar
}
?>