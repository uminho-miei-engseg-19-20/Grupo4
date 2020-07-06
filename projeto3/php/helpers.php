<?php

function itsUser($numero)
{
    $n = str_split($numero);

    if (count($n) != 14) {
        return 0;
    } elseif ($n[0] == "+" and is_numeric($n[1]) and is_numeric($n[2])
        and is_numeric($n[3]) and $n[4] == " " and is_numeric($n[5])
        and is_numeric($n[6]) and is_numeric($n[7]) and is_numeric($n[8])
        and is_numeric($n[9]) and is_numeric($n[10]) and is_numeric($n[11])
        and is_numeric($n[12]) and is_numeric($n[13])
    ) {
        return 1;
    } else {
        return 0;
    }
}

function itsPin($numero)
{
    $n = str_split($numero);

    for ($i = 0; $i < count($n); $i++) {
        if (!is_numeric($n[$i])) {
            return 0;
        }
    }

    return 1;
}

function itsOtp($numero)
{
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

function itsProcessId($numero)
{
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

function stringSplit($certs)
{
    $cert_split = preg_split(
        '/\-\-\-\-\-END CERTIFICATE\-\-\-\-\-/', $certs["GetCertificateResult"]
    );

    $str_final = '-----END CERTIFICATE-----';

    $cert_split[0] = $cert_split[0] . $str_final;
    $cert_split[1] = $cert_split[1] . $str_final;
    $cert_split[2] = $cert_split[2] . $str_final;

    return $cert_split;
}

function defaultHelp()
{
    echo "Use -h for usage :\r\n";
    echo "    test_cmd_wsdl.php -h for all operations\r\n";
    echo "    test_cmd_wsdl.php <oper1> -h for usage of operation <oper1>\r\n";
}

function helpHelp()
{
    echo "usage: test_cmd_wsdl.php [-h] [-V]\r\n";
    echo "                        {GetCertificate,gc,CCMovelSign,ms,";
    echo "CCMovelMultipleSign,mms,ValidateOtp,otp,TestAll,test}\r\n";
    echo "                        ...\r\n\r\n";
    echo $GLOBALS['TEXT'];
    echo "\r\n";
    echo "optional arguments:\r\n";
    echo "  -h, --help           show this help message and exit\r\n";
    echo "  -h, --help           show program version\r\n\r\n";
    echo "CCMovelDigitalSignature Service:\r\n";
    echo "  {GetCertificate,gc,CCMovelSign,ms,CCMovelMultipleSign,mms,";
    echo "ValidateOtp,otp,TestAll,test} -> Signature CMD (SCMD) operations";
    echo "\r\n\r\n";
    echo "    GetCertificate (gc)       -> Get user certificate\r\n";
    echo "    CCMovelSign (ms)          -> Start signature process\r\n";
    echo "    CCMovelMultipleSign (mms) -> Start multiple signature process";
    echo "\r\n    ValidateOtp (otp)         -> Validate OTP\r\n";
    echo "    TestAll (test)            -> Automatically test all comands";
    echo "\r\n";
}

function gcHelp()
{
    echo "usage: test_cmd_wsdl.php GetCertificate ";
    echo "[-h] [-applicationId APPLICATIONID]\r\n";
    echo "                                       [-prod] [-D]\r\n";
    echo "                                       user\r\n\r\n";
    echo "Get user certificate\r\n\r\n";
    echo "positional arguments:\r\n";
    echo "  user                  user phone number (+XXX NNNNNNNNN)\r\n\r\n";
    echo "optional arguments:\r\n";
    echo "  -h, --help                      show this help message and exit\r\n";
    echo "  -applicationId APPLICATIONID    CMD ApplicationId\r\n";
    echo "  -prod                           Use production SCMD service ";
    echo "(preproduction SCMD service used by default)\r\n";
}

function msHelp()
{
    echo "usage: test_cmd_wsdl.php CCMovelSign ";
    echo "[-h] [-applicationId APPLICATIONID]\r\n";
    echo "                                       [-prod] [-D]\r\n";
    echo "                                       user pin\r\n\r\n";
    echo "Start signature process\n\r\n";
    echo "positional arguments:\r\n";
    echo "  user                  user phone number (+XXX NNNNNNNNN)\r\n";
    echo "  pin                   CMD signature PIN\r\n\r\n";
    echo "optional arguments:\r\n";
    echo "  -h, --help                      show this help message and exit\r\n";
    echo "  -applicationId APPLICATIONID    CMD ApplicationId\r\n";
    echo "  -prod                           Use production SCMD service ";
    echo "(preproduction SCMD service used by default)\r\n";
}

function mmsHelp()
{
    echo "usage: test_cmd_wsdl.php CCMovelMultipleSign [-h]\r\n";
    echo "                                             ";
    echo "[-applicationId APPLICATIONID]\r\n";
    echo "                                             [-prod] [-D]\r\n";
    echo "                                             user pin\r\n\r\n";
    echo "Start multiple signature process\n\r\n";
    echo "positional arguments:\r\n";
    echo "  user                  user phone number (+XXX NNNNNNNNN)\r\n";
    echo "  pin                   CMD signature PIN\r\n\r\n";
    echo "optional arguments:\r\n";
    echo "  -h, --help                      show this help message and exit\r\n";
    echo "  -applicationId APPLICATIONID    CMD ApplicationId\r\n";
    echo "  -prod                           Use production SCMD service ";
    echo "(preproduction SCMD service used by default)\r\n";
}

function otpHelp()
{
    echo "usage: test_cmd_wsdl.php ValidateOtp ";
    echo "[-h] [-applicationId APPLICATIONID]\r\n";
    echo "                                     [-prod] [-D]\r\n";
    echo "                                     OTP ProcessId\r\n\r\n";
    echo "Validate OTP\n\r\n";
    echo "positional arguments:\r\n";
    echo "  OTP                    OTP received in your device\r\n";
    echo "  ProcessId              ProcessID received in the answer ";
    echo "of the CCMovelSign/CCMovelMultipleSign command\r\n\r\n";
    echo "optional arguments:\r\n";
    echo "  -h, --help                      show this help message and exit\r\n";
    echo "  -applicationId APPLICATIONID    CMD ApplicationId\r\n";
    echo "  -prod                           Use production SCMD service ";
    echo "(preproduction SCMD service used by default)\r\n";
}

function testHelp()
{
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
    echo "  -prod                           Use production SCMD service ";
    echo "(preproduction SCMD service used by default)\r\n";
}

?>