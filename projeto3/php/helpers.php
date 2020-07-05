<?php

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

?>