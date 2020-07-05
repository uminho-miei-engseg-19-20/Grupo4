<?php
/*
include 'cmd_soap_msg.php';
            echo "Version 1.0\r\n";

*/

include 'cmd_config.php';

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
            if (($argumentos[2] == "-h" or $argumentos == "--help") and $number == 3) {
                gc_help();
            }
            break;
        case 'GetCertificate':
            if (($argumentos[2] == "-h" or $argumentos == "--help") and $number == 3) {
                gc_help();
            }
            break;
        case 'ms':
            if (($argumentos[2] == "-h" or $argumentos == "--help") and $number == 3) {
                ms_help();
            }
            break;
        case 'CCMovelSign':
            if (($argumentos[2] == "-h" or $argumentos == "--help") and $number == 3) {
                ms_help();
            }
            break;
        case 'mms':
            if (($argumentos[2] == "-h" or $argumentos == "--help") and $number == 3) {
                mms_help();
            }
            break;
        case 'CCMovelMultipleSign':
            if (($argumentos[2] == "-h" or $argumentos == "--help") and $number == 3) {
                mms_help();
            }
            break;
        case 'otp':
            if (($argumentos[2] == "-h" or $argumentos == "--help") and $number == 3) {
                otp_help();
            }
            break;
        case 'ValidateOtp':
            if (($argumentos[2] == "-h" or $argumentos == "--help") and $number == 3) {
                otp_help();
            }
            break;
        case 'test':
            if (($argumentos[2] == "-h" or $argumentos == "--help") and $number == 3) {
                test_help();
            }
            break;
        case 'TestAll':
            echo $number;
            if (($argumentos[2] == "-h" or $argumentos == "--help") and $number == 3) {
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

function its_user($numero) {
    return 1;
}

function gc_help() {
    echo "usage: test_cmd_wsdl.php GetCertificate [-h] [-applicationId APPLICATIONID]\r\n";
    echo "                                       [-prod] [-D]\r\n";
    echo "                                       user\r\n\r\n";
    echo "Get user certificate\r\n\r\n";
    echo "positional arguments:\r\n";
    echo "  user                  user phone number (+XXX NNNNNNNNN)\r\n\r\n";
    echo "optional arguments:\r\n";
    echo "  -h, --help                      show this help message and exit\r\n";
    echo "  -applicationId APPLICATIONID    CMD ApplicationId\r\n";
    echo "  -prod                           Use production SCMD service (preproduction SCMD service used by default)\r\n";
}

function ms_help() {
    echo "usage: test_cmd_wsdl.php CCMovelSign [-h] [-applicationId APPLICATIONID]\r\n";
    echo "                                       [-prod] [-D]\r\n";
    echo "                                       user pin\r\n\r\n";
    echo "Start signature process\n\r\n";
    echo "positional arguments:\r\n";
    echo "  user                  user phone number (+XXX NNNNNNNNN)\r\n";
    echo "  pin                   CMD signature PIN\r\n\r\n";
    echo "optional arguments:\r\n";
    echo "  -h, --help                      show this help message and exit\r\n";
    echo "  -applicationId APPLICATIONID    CMD ApplicationId\r\n";
    echo "  -prod                           Use production SCMD service (preproduction SCMD service used by default)\r\n";
}

function mms_help() {
    echo "usage: test_cmd_wsdl.php CCMovelMultipleSign [-h]\r\n";
    echo "                                             [-applicationId APPLICATIONID]\r\n";
    echo "                                             [-prod] [-D]\r\n";
    echo "                                             user pin\r\n\r\n";
    echo "Start multiple signature process\n\r\n";
    echo "positional arguments:\r\n";
    echo "  user                  user phone number (+XXX NNNNNNNNN)\r\n";
    echo "  pin                   CMD signature PIN\r\n\r\n";
    echo "optional arguments:\r\n";
    echo "  -h, --help                      show this help message and exit\r\n";
    echo "  -applicationId APPLICATIONID    CMD ApplicationId\r\n";
    echo "  -prod                           Use production SCMD service (preproduction SCMD service used by default)\r\n";
}

function otp_help() {
    echo "usage: test_cmd_wsdl.php ValidateOtp [-h] [-applicationId APPLICATIONID]\r\n";
    echo "                                     [-prod] [-D]\r\n";
    echo "                                     OTP ProcessId\r\n\r\n";
    echo "Validate OTP\n\r\n";
    echo "positional arguments:\r\n";
    echo "  OTP                    OTP received in your device\r\n";
    echo "  ProcessId              ProcessID received in the answer of the CCMovelSign/CCMovelMultipleSign command\r\n\r\n";
    echo "optional arguments:\r\n";
    echo "  -h, --help                      show this help message and exit\r\n";
    echo "  -applicationId APPLICATIONID    CMD ApplicationId\r\n";
    echo "  -prod                           Use production SCMD service (preproduction SCMD service used by default)\r\n";
}

function test_help() {
    echo "usage: test_cmd_wsdl.php TestAll [-h] [-applicationId APPLICATIONID]\r\n";
    echo "                                 [-prod] [-D]\r\n";
    echo "                                 file user pin\r\n\r\n";
    echo "Automatically test all commands\n\r\n";
    echo "positional arguments:\r\n";
    echo "  file                   file\r\n";
    echo "  user                   user phone number (+XXX NNNNNNNNN)\r\n";
    echo "  pin                    CMD signature PIN\r\n\r\n";
    echo "optional arguments:\r\n";
    echo "  -h, --help                      show this help message and exit\r\n";
    echo "  -applicationId APPLICATIONID    CMD ApplicationId\r\n";
    echo "  -prod                           Use production SCMD service (preproduction SCMD service used by default)\r\n";
}

function test_all(){
    // completar
}
?>