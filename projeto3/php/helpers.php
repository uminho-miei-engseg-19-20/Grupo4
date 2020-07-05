<?php

function its_user($numero) {
    $n = str_split($numero);

    if (count($n) != 14) {
        return 0;
    } elseif ($n[0] == "+" and is_numeric($n[1]) and is_numeric($n[2]) and is_numeric($n[3]) and
              $n[4] == " " and is_numeric($n[5]) and is_numeric($n[6]) and is_numeric($n[7]) and
                is_numeric($n[8]) and is_numeric($n[9]) and is_numeric($n[10]) and 
                is_numeric($n[11]) and is_numeric($n[12]) and is_numeric($n[13])) {
                    return 1;
    } else {
        return 0;
    }
}

function its_pin($numero) {
    $n = str_split($numero);

    for($i = 0; $i < count($n); $i++) {
        if (!is_numeric($n[$i])) {
            return 0;
        }
    }

    return 1;
}

function its_otp($numero) {
    $n = str_split($numero);

    if (count($n) != 6) {
        return 0;
    }

    for ($i = 0; $i < 6; $i++) {
        if (!is_numeric($n[$i])) {
            return 0;
        }
    }

    return 1;
}

function its_processId($numero) {
    $n = str_split($numero);

    if (count($n) != 36) {
        return 0;
    }

    for ($i = 0; $i < 36; $i++) {

        if (($i == 8) or ($i == 13) or ($i == 18) or ($i == 23)) {
            if ($n[$i] != '-') {
                return 0;
            }
        } elseif (!is_numeric($n[$i])) {
            if (ctype_alpha($n[$i])) {
                if (!ctype_lower($n[$i])) {
                    return 0;
                }
            } else {
                return 0;
            }
        }
    }

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