# TPC 1 - Aula 2

### Grupo 4:

```bash
A82202 - Joel Gama
A82491 - Tiago Pinheiro
```

## Exercício 1 - Números aleatórios/pseudoaleatórios

### Pergunta 1.1

|                         Comando                        | Tempo de execução |
| :----------------------------------------------------: | :----------------:|
| ```head -c 32   /dev/random  \| openssl enc -base64``` | 0.007 segundos    |
| ```head -c 64   /dev/random  \| openssl enc -base64``` | 0.006 segundos    |
| ```head -c 1024 /dev/random  \| openssl enc -base64``` | 50+ minutos       |
| ```head -c 1024 /dev/urandom \| openssl enc -base64``` | 0.008 segundos    |

### Pergunta 1.2

|                         Comando                        | Tempo de execução |
| :----------------------------------------------------: | :----------------:|
| ```head -c 1024 /dev/random  \| openssl enc -base64``` | 0.007 segundos    |
| ```head -c 1024 /dev/urandom \| openssl enc -base64``` | 0.005 segundos    |

## Exercício 2 - Partilha/Divisão de segredo (Secret Sharing/Splitting)

### Pergunta 2.1

## Exercício 4 - Algoritmos e tamanhos de chaves

### Pergunta 4.1

Através do site https://webgate.ec.europa.eu/tl-browser/ foi possível obter o certificado mais recente emitido pela "NISZ National Infocommunications Services Company Limited by Shares" da Hungria. Esta entidade emite certificados com as seguintes caraterísticas:

* **Algoritmo de assinatura:** RSA com SHA256
* **Algoritmo de chave pública:** RSA
* **Tamanho da chave:** 2048 bit

Neste caso, podemos afirmar que os algoritmos e o tamanho são adequados aos tempos atuais. Sendo que, o tamanho da chave podia ser aumentado para 4096 bit, trazendo mais segurança.

O *output* do comando ```openssl x509 -in cert.crt -text -noout``` é:

```bash
Certificate:
    Data:
        Version: 3 (0x2)
        Serial Number: 1132238913 (0x437c9841)
    Signature Algorithm: sha256WithRSAEncryption
        Issuer: C = hu, CN = KGYHSZ (Public Administration Root CA - Hungary)
        Validity
            Not Before: Mar 20 09:34:06 2014 GMT
            Not After : Mar 20 10:04:06 2024 GMT
        Subject: C = HU, L = Budapest, O = NISZ Nemzeti Infokommunik\C3\A1ci\C3\B3s Szolg\C3\A1ltat\C3\B3 Zrt., CN = Min\C5\91s\C3\ADtett K\C3\B6zigazgat\C3\A1si Tan\C3\BAs\C3\ADtv\C3\A1nykiad\C3\B3 - GOV CA
        Subject Public Key Info:
            Public Key Algorithm: rsaEncryption
                Public-Key: (2048 bit)
                Modulus:
                    00:9e:0d:0a:ff:2c:2e:da:64:12:6b:a2:3d:c3:d8:
                    32:ba:2b:3a:68:92:ac:ff:ca:89:18:39:f4:7c:ef:
                    13:bd:d9:5f:8d:df:7d:ed:ed:6a:75:7a:c4:61:7b:
                    83:0c:b3:26:1d:c2:85:f8:57:30:4c:9a:30:a4:13:
                    94:c3:84:0d:99:ed:a2:8d:ea:aa:9b:e5:9d:2c:68:
                    93:02:42:c8:90:fe:da:2f:0e:32:37:37:f1:ae:54:
                    78:9a:66:67:63:58:97:4f:de:dc:48:f9:28:81:52:
                    b6:62:34:23:04:3a:91:af:49:a5:26:ce:07:61:08:
                    e7:ae:12:0d:a6:0c:bb:e9:43:ca:b1:3f:8f:1f:e3:
                    69:c7:91:7b:a8:13:d7:38:03:6a:49:89:00:7f:ca:
                    19:44:ec:7d:55:58:9a:9d:16:7b:68:23:42:e3:fc:
                    8d:20:68:b8:b4:81:5f:da:6c:76:a8:00:7e:07:3c:
                    a4:29:25:68:34:f3:ac:64:3d:53:d9:f5:77:10:15:
                    50:dd:f5:a8:b9:ee:52:4e:bc:56:e4:84:a8:dd:aa:
                    fd:03:b1:1f:36:1b:73:77:bd:d4:2e:a5:0e:77:49:
                    c3:75:e3:78:11:bf:1b:90:82:2c:a7:1f:29:de:f5:
                    78:f9:84:72:15:49:af:68:fb:17:c0:c9:1e:04:9d:
                    e9:bd
                Exponent: 65537 (0x10001)
        X509v3 extensions:
            X509v3 Key Usage: critical
                Certificate Sign, CRL Sign
            X509v3 Basic Constraints: critical
                CA:TRUE, pathlen:0
            X509v3 Certificate Policies:
                Policy: 0.2.216.1.100.42.1.200.2
                  CPS: http://cp.kgyhsz.gov.hu
                  User Notice:
                    Explicit Text:

            Authority Information Access:
                CA Issuers - URI:http://aia.kgyhsz.gov.hu/KGYHSZ_CA_20091210.cer
                OCSP - URI:http://ocsp.kgyhsz.gov.hu/ocsp/

            X509v3 CRL Distribution Points:

                Full Name:
                  URI:http://crl.kgyhsz.gov.hu/KGYHSZ_CA_20091210.crl

            X509v3 Subject Alternative Name:
                email:info@hiteles.gov.hu
            X509v3 Authority Key Identifier:
                keyid:FC:9C:E6:C6:B0:0A:EA:1F:D7:FA:7E:2E:20:05:68:5C:07:4A:C2:E2

            X509v3 Subject Key Identifier:
                23:50:B8:37:C7:0C:4E:FF:57:81:5C:9B:2C:E6:D8:A6:58:3F:C0:D1
    Signature Algorithm: sha256WithRSAEncryption
         aa:b6:88:cd:19:8f:01:90:27:24:c8:c2:fd:04:9e:9d:b2:23:
         cc:d8:6e:af:6b:5e:b6:4a:a4:0a:e2:d3:49:08:90:dc:fa:4c:
         26:fc:29:ae:dd:20:a2:25:98:40:a9:c5:32:18:11:d4:11:8f:
         e6:18:ef:cc:8b:10:3d:44:18:0c:cf:70:df:8e:99:0e:e4:e6:
         22:2e:92:70:8b:23:70:f9:a7:88:31:59:69:01:d7:38:6b:9f:
         63:7d:b1:4d:a4:90:7c:ef:41:02:4d:98:ef:d3:11:bb:2f:c9:
         8e:77:ee:d8:7d:68:ec:99:b4:f1:88:8b:0f:d2:7f:0c:e8:0e:
         24:f1:f2:c0:07:dd:12:a4:5c:45:28:5c:24:ee:91:fb:3a:9b:
         99:13:c3:f9:97:37:1c:b8:96:af:ab:64:a4:a9:91:28:b1:aa:
         b8:2c:46:40:84:67:aa:77:a4:b1:31:32:56:f7:58:b5:34:5a:
         e7:65:72:cb:87:03:1d:32:58:0d:4a:52:92:f8:3c:fe:05:06:
         19:f8:39:ed:c2:d2:a0:a3:82:3d:ff:3c:ad:9c:bd:e0:49:35:
         2f:a1:43:1b:94:49:a8:0b:1d:ea:ba:f8:fe:d3:93:64:82:d5:
         59:54:2c:84:8c:5d:27:eb:bf:09:1b:1d:18:a5:b9:ba:1a:7a:
         eb:2e:7a:91
```
