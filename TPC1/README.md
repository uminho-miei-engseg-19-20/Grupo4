# TPC 1 - Aula 2

## Exercício 1 - Números aleatórios/pseudoaleatórios

### Pergunta 1.1

  Em sistemas operativos *Unix*, ```/dev/random``` e ```/dev/urandom``` são ficheiros especiais que servem de geradores de números pseudoaleatórios. Estes dispositivos permitem ter acesso ao ruído presente no sistema operativo, sendo que esse ruído é usado para gerar os tais números pseudoaleatórios.

  Em termos de diferenças, o ```/dev/random``` bloqueia até que a entropia seja suficiente e, dessa forma, a semente possa ser gerada com segurança. Depois, não volta a bloquear até que o processo esteja concluído. Por outro lado, o ```/dev/urandom``` não espera que exista entropia suficiente, simplesmente, gera imediatamente o número pseudoaleatório. Pelas razões apresentadas anteriormente, o ```/dev/random``` é apropriado, e usado, para fins de segurança, mas o ```/dev/urandom``` é fortemente desaconselhado.

|                         Comando                        | Tempo de execução |
| :----------------------------------------------------: | :----------------:|
| ```head -c 32   /dev/random  \| openssl enc -base64``` | 0.007 segundos    |
| ```head -c 64   /dev/random  \| openssl enc -base64``` | 0.006 segundos    |
| ```head -c 1024 /dev/random  \| openssl enc -base64``` | 50+ minutos       |
| ```head -c 1024 /dev/urandom \| openssl enc -base64``` | 0.008 segundos    |

Os resultados obtidos foram os esperados, ou seja, a operação de geração de quantidades mais pequenas de bytes é bastante rápido mesmo que use o ```/dev/random```. Mas quando o número já é elevado, como é o caso de 1024 *bytes*, nota-se uma diferença brutal de 8 milisegundos para 50 minutos. Isto acontece porque o dispositivo ```/dev/random``` bloqueia até atingir o valor de entropia ideal e o ```/dev/urandom``` não bloqueia e gera o número de imediato.

### Pergunta 1.2

O [HAVEGE](http://www.irisa.fr/caps/projects/hipsor/) é um algoritmo que implementa um gerador de números aleatórios, através da exploração de modificações no volatilidade dos estados internos do *hardware* como fonte de incerteza. O projeto [haveged](http://www.issihosts.com/haveged/index.html) adaptou o algortimo para remediar as condições de baixa entropia que podem ocorrer um sistema *LINUX*, especialmente se este estiver debaixo de uma grande carga.

|                         Comando                        | Tempo de execução |
| :----------------------------------------------------: | :----------------:|
| ```head -c 1024 /dev/random  \| openssl enc -base64``` | 0.007 segundos    |
| ```head -c 1024 /dev/urandom \| openssl enc -base64``` | 0.005 segundos    |

Como era esperado, com a utilização da ferramenta *haveged*, o tempo do comando ```head -c 1024 /dev/urandom \| openssl enc -base64``` não mudou significamente, uma vez que, praticamente não tem influência. Por outro lado, o comando que utilizava o dispositivo ```/dev/random``` sofreu uma redução drástica, ficando praticamente igual ao ```/dev/urandom```, isto porque o algoritmo gera a entropia suficiente de uma forma muito rápida.

## Exercício 2 - Partilha/Divisão de segredo (Secret Sharing/Splitting)

### Pergunta 2.1

#### A

Primeiramente foi executado o comando ```openssl genrsa -aes128 -out mykey.pem 1024``` para gerar a chave privada, usado para assinar o objeto *JWT*. Obtendo o seguinte resultado:

```
-----BEGIN RSA PRIVATE KEY-----
Proc-Type: 4,ENCRYPTED
DEK-Info: AES-128-CBC,76E9D8A5025D52A3BDE012DC98A6CFBC

6MQZNWiuym4DXNeW2m68I/rm6zPwvBrjrrtsIkbvPHqlhc6KkKm80uEfLM4qIleo
/SZGrGcxYS+AvS6toKouGibQ3XlLl1vqoRvyM9KBq+Y1+rRFgj8qfywCTnAQylHd
Ygi2P/99kZopOSUAncjBe0zn3zWpRwmjlYGu3tDoYWgx2gtQbdFVJzQq0D1T8T5S
1fhVfP+BzGno/WpDtfVc/4En5NoCgnckGBO4p8xS05U3kYPoNyNHq+HLL7h7+OxH
cx8HcSktYx8nse2Dz73NdbI+Mql2YgRcZ0FWimTe5dfiAeKuQvKg6sFZcfi4/x4S
DZ77SwzH08c73R/5aAmSjoJECMLskqanrtSLrW5kGqW46WVqsV9Yu4bfCvm9Jj3R
xFw4DFWTMOlK0AdfREIjDTnCRQOE3AzSRx4x7LZTGxgucYMTgYmr9HXYUuSp3G0U
f2hGz+HK6nPq44qkEoNAnKDm4MJP4xl9SewtSROTxjB92BiNjdm34asg0Zu87VLe
+fotx90PpBGBagmHYMEgZkokj1yY6mbTjG3NKi0XedhQaLdK3iqy/QGyBM9U5mBZ
+z3CHvJECe8XS8kaS+GcQsI2xEMq0kOXv2y11UFb+h0XAckd6DNypRpN1kglsNxq
a44sX0q9/cMb/tzUn/oldo0SJzVkjRgtZSQvW/POfUPvVENGso0VOx+KZLI241zu
y7Kkz3huymU42tvNfv0qLNErR5wFuyVQ7Rtfe5Svaw/wumVH1rIGasiwW4faWWKK
cjfApdRNeS90LM5uO5qvRGXxmLxtoxOLj1KiM155q+z7mRS/ZSqzdqxlk8KOk7Gc
-----END RSA PRIVATE KEY-----
```

De seguida, é executado o comando ```openssl req -key mykey.pem -new -x509 -days 365 -out mykey.crt``` para gerar um certificado, que vai ser usado posteriormente para recuperar o segredo. Através do comando ```cat``` obtém-se o seguinte resultado:

```
-----BEGIN CERTIFICATE-----
MIICyzCCAjSgAwIBAgIJAP+PDu9sE4IgMA0GCSqGSIb3DQEBCwUAMH0xCzAJBgNV
BAYTAlBUMQ4wDAYDVQQIDAVCcmFnYTEOMAwGA1UEBwwFQnJhZ2ExDzANBgNVBAoM
BlVNSU5ITzEPMA0GA1UECwwGVU1JTkhPMQswCQYDVQQDDAJVTTEfMB0GCSqGSIb3
DQEJARYQbmFkYUBob3RtYWlsLmNvbTAeFw0yMDAyMjMwNTA1MTZaFw0yMTAyMjIw
NTA1MTZaMH0xCzAJBgNVBAYTAlBUMQ4wDAYDVQQIDAVCcmFnYTEOMAwGA1UEBwwF
QnJhZ2ExDzANBgNVBAoMBlVNSU5ITzEPMA0GA1UECwwGVU1JTkhPMQswCQYDVQQD
DAJVTTEfMB0GCSqGSIb3DQEJARYQbmFkYUBob3RtYWlsLmNvbTCBnzANBgkqhkiG
9w0BAQEFAAOBjQAwgYkCgYEAtbBtzCf0KFJRYIKnczQH8QmhBXJI3qe+Cy2dhdZ8
quzQZM/c2pRDyxEVigQvsLhRzB/JFrByA3WUJotdd+U39rQOQaYeSs5w18oPzaKn
s+LVu+6c/zho01Nwpthe00AtRnZDCWTStsBpVMux+dnTMPJgvjHX8SW439B4nVhu
myUCAwEAAaNTMFEwHQYDVR0OBBYEFFgQU2Gi7vBP5P4N+UaxZ2/SrQWwMB8GA1Ud
IwQYMBaAFFgQU2Gi7vBP5P4N+UaxZ2/SrQWwMA8GA1UdEwEB/wQFMAMBAf8wDQYJ
KoZIhvcNAQELBQADgYEAZ7hfRwlQzBICX5BySy5EgpMXGN8A6rWMxPYDdz0/qKvu
+d9KUTZ7QG4SYqWFJGxe99ZDnCK9xSZjF9hb8s8dLovtJMahnnNoXH2udR/J3hGc
5S4qI4pqTmTZiiADXrUyOyd2fPwOfhTgtShG2spIIPgofEN8/uFqeUThPgkDAL8=
-----END CERTIFICATE-----
```

Por último, é chamado o programa ```createSharedSecret``` através do comando ```python createSharedSecret-app.py 8 5 1 mykey.pem```. Desta forma, o segredo é dividido em 8 partes e são precisas 5 para o reconstruir.

```
Private key passphrase: 1234
Secret: Agora temos um segredo extremamente confidencial
Component: 1
eyJhbGciOiAiUlMyNTYifQ.eyJvYmplY3QiOiBbIjEtMmM1NmUwNTM0ZTg0Y2YxNDFkYmU0NjgyYmQyOWYwMjczZTc4NGYwOTkyYTgxY2Q3MjVhOTA5Nzg4ODM5NjgxMmQ5OGI4NmI2ZmNhYTNkZTNhY2I3NTJkZGI3NDY4MGRlIiwgIjEiLCA1LCA4LCAiYjAzZWZlNDM3ODAxYWRjZGU2MjcyNTJiMTRiMDA2OGE2MDNmOWFhZmY5MzMwYzRhN2IwYWVmYjYyNWY0NGZmZSJdfQ.HZRcAjlqjdFcA1MlreUOkcRq1olKvXICAYw8yxiv0WvvwjkgTw2XQUak1_VEh364PnwhWlwYDe3CLOlEYd9xX6sAw0OI-9TAtiXIyvPOVZ6qvynYod56uLKtZ1gSolKQa5hE67c97ze75Xgu7f9nIbwLZWUbW8nUyxerC6_wo-4
Component: 2
eyJhbGciOiAiUlMyNTYifQ.eyJvYmplY3QiOiBbIjItMmZiYzAyMzAwYTU0YWI3Yjk0Yzk5ZWQxYTUxNjM3OTFlMjVmY2I5MzQ3MmRjYzExMzU1M2VmZGFiMmQ2N2MzYmRkYWNmYjM0YmY5OTc4M2NiYzk4NDY2ODQ0NWY2MzAiLCAiMSIsIDUsIDgsICI4OTJjZDdlNzBkYWEzMmIxZjdiNjdiMzJhYTQwYTM5MTBiODFlZGQ2MzkyOGEwMTFiMzc5ODQyMmViZTZiNTdkIl19.r8rU6JLHT3SuOa553879FACgdCGiZy6KfwKokaumEdQF6WWhb5vXWGtI3e6NJRnMFhPzXvgG4-v7U5jJBSfy8KXJaxRKaRO7CAPaoGKGJF_dwgHfThNYzi0ehuvqb7COGDz8_7lrc8LfhIAdsufH76hmhqcKzwr_BuHuJWXvDVA
Component: 3
eyJhbGciOiAiUlMyNTYifQ.eyJvYmplY3QiOiBbIjMtOTNmZTNhMTVlNjA5Njg1MzU1OTkyNDMyMzE2ZTMzYjlmMGQzNzgwYjU4MWUzZDY2YTRmMzU5YzAxZWM3MDQ3NzJlYWZhMTI0NTA0NzY1ODE4NzE1MGVkNTE2MzRiZWVkIiwgIjEiLCA1LCA4LCAiMTBmNzQyYTcyNTg3NTM0MTQ1M2UxZDhmNWU2NTRmN2UyYzRkODU5NDEwODBjODAyMmUwOWUwM2Q3ZWUwMmZmYiJdfQ.YUJRIG34cBBs3KNz0Di59cGLlwkLVV-0RXwN0DiW4ycdcooCIDYdEUO29hi1GAgIute57_RYUS7bQHT_u2ooBWDhEufCe3XkpONELATpBsI6mnyQwtA2Mi7SQ0I_E_EEJD1-lx0qHA5DJNFq-jc8IkuzI1xsMQuBohcIFKezers
Component: 4
eyJhbGciOiAiUlMyNTYifQ.eyJvYmplY3QiOiBbIjQtOGIwOWYwZjZmYjc3MGFjZDAyMmFiMjc0Njc4NmQ1MjA1NDVkYjg5OWUzNmEyMDlhODUxYzE3MjQ3ZWU1YTIzZjZhYjZhZDIxY2I2ODExN2E0NWI0ZDc0ZTA1YjZjMzhkIiwgIjEiLCA1LCA4LCAiN2QyYzkzODk1ODg4YmM3N2VhNzUzOTBiNGQxM2MzYzhlZjAyYjQwYWU5YTEwZjA3MTM4ODc3ZGNjZTViYjc3ZSJdfQ.pQwUxuwsPfOpH029M_MJfhI7gPn1MOv_lFvKV3mIdgnY81NVoYz6FiJCVwKDbVTH_Kssd2chd7vXHEC9DUvFAlg74xJudqQwDUaq82nAbDvyihxylMGj-5sTUJI6_c5LUjHrjH4h6B-nEKYtoLBGZgDxtlNcpUMl0uPetzcqsiw
Component: 5
eyJhbGciOiAiUlMyNTYifQ.eyJvYmplY3QiOiBbIjUtNzBjZGZmMjdjYmYyNzZlZGM4OTAyODI1ZTIxZDc2Yzg5ODFiYjEwMTkzODc2Y2JlYTU4NmFiMjhiYWJlNzE0MWRiZmJmNmNjNDIxYTg0NmUxNTY0OTM0ZTM4NDZkYjExIiwgIjEiLCA1LCA4LCAiZjNhYTQ4ZjUwODgzNDM3MDlmYzU2ZjI5NTJiZWIzYWI0OTlkOWJkOGJjNDUzMmE5MmE3MzE2ZjI2OTgxMzcwYiJdfQ.ZhQWUGm7jLBQju3GCHJjUtQiuteWwy3_UGmpJCweZ3RzUQMqPg8HAQuGPMFF-Li_F5NAd3lmZQDghnpElV9RMAiYJeZRmsTdVYT_LpQ-0JHX6MIqEmNJgwqBAzc9k-q4CbtiGmbOpt5FbMqhnsCbVfLTCX3BJPd7rWUpFQ1vnrc
Component: 6
eyJhbGciOiAiUlMyNTYifQ.eyJvYmplY3QiOiBbIjYtYWFmY2Y2YTA3MGJlNTM2MWFjNjA3ZjA4ODczMDAyYjRiY2RlNGVlMWZkMTgwY2M0M2YwOGMwNjQxNGRjNmRiNzE3ZWFkMjRjZmMwODI2YmZhYTgwYzhhYWUwMzZjOTM1IiwgIjEiLCA1LCA4LCAiODRmYTc0ZDlmNmFlY2UyYjBlN2UyMjI4MGRlNzk2MTIzMTUyNWIwMzA5NDg5YmZlMDMyZDEzYmFjNTFkMGI5OCJdfQ.J4V_RDWjwpHSoB7Z7_GOH-3z9_BcpeacnTrM98OdqV9YEz3t-7xVVCktyylZCDzEbvXTuj-6Ttb05rFwDwqrST4ZwYv0kFmhumzPKAJpzQHh0L1-uHVOIgoL5SFTHhx_nlhPv6YIKVeZgOdqSHIzOWFuffVpJuLIgXdUhDSgJZY
Component: 7
eyJhbGciOiAiUlMyNTYifQ.eyJvYmplY3QiOiBbIjctN2M0Y2UwZWY5MTViYThiN2FiM2FjNzJkZmQzODFkY2M3NGYwN2FkZDhjMmVmMDJiZDE5Njc4MDcyMzIwNWZlYWRmNGRlNGQ2MDNjNGUwMzQ2MDA2Y2Q5MTdjYWYzZDg5IiwgIjEiLCA1LCA4LCAiYWRhZjZkMGY4MjEzZWQ1MjAwMTUzODVjYmY1NDBlMjk4N2FjZGUxNmI4MTliMWMyYzFlZGFlYjNiZjIzMDhhOSJdfQ.ngbOc_jIRx7lKAreMiDJNM22p023dIuzBpzUsBruhTePxXyUkx4kXqfCuH1Wdfk6mh5B-RDY77d_hNjdAmRhJmZ_fk_Q3A7vrcVfqJNF0BuiiBErMIrNQg1qToOJGshjZtwvrVeoM4tr0ylpFNC9Q9gt9a-fKmdzqPqke0geehw
Component: 8
eyJhbGciOiAiUlMyNTYifQ.eyJvYmplY3QiOiBbIjgtNDc3M2YzYTYzODllMTYxYmNjNjI2ZjdhYjJiMjdkZDI0MTcxODk5ODQ1MDBiMDUyNDQyNjlkYmNlYzBkYzNjMWU0ZjI0YTIyNmNmMTdmNDM3OTRjODg3ZDlhZmQ1M2YiLCAiMSIsIDUsIDgsICI4NGZjY2E2NzE3MWExZjg1ZDJmOWY2NTc1ZDU4OWU1NWZhN2E1ZWMzYjU3OTBmMDUzYmQwYjBjODI4ZjUyMjQyIl19.QRtZiSFSZEFwLD40CdwSKbUwB1FEkHk4xji5bv0NWg00ixupBXXeUjkheWZHdpJzFvvRNsekGw4a-VJBZg-LPC-XSzYtlgDiI-2PDOqnCIi5irbBXMDop6XzWRyIUBqAN7czj3wmi8_RnWm98Yzq0w_v6BPg1iMKG8iX0a9ZJuE
```

#### B

Em ambos os casos, a execução do programa com número de partes de inferior ao número pré-estabelecido do *quorum*  não permite aceder ao segredo. A grande diferença é que no programa ```recoverSecretFromAllComponents``` não é possível aceder ao segredo usando o número do *quorum* pré-estabelecido sendo precisas todas as partes, enquanto que no ```recoverSecretFromComponents``` apenas são necessárias as partes pré-estabelecidas.

```
$ python recoverSecretFromAllComponents-app.py 5 1 mykey.crt
Component 1: eyJhbGciOiAiUlMyNTYifQ.eyJvYmplY3QiOiBbIjEtMmM1NmUwNTM0ZTg0Y2YxNDFkYmU0NjgyYmQyOWYwMjczZTc4NGYwOTkyYTgxY2Q3MjVhOTA5Nzg4ODM5NjgxMmQ5OGI4NmI2ZmNhYTNkZTNhY2I3NTJkZGI3NDY4MGRlIiwgIjEiLCA1LCA4LCAiYjAzZWZlNDM3ODAxYWRjZGU2MjcyNTJiMTRiMDA2OGE2MDNmOWFhZmY5MzMwYzRhN2IwYWVmYjYyNWY0NGZmZSJdfQ.HZRcAjlqjdFcA1MlreUOkcRq1olKvXICAYw8yxiv0WvvwjkgTw2XQUak1_VEh364PnwhWlwYDe3CLOlEYd9xX6sAw0OI-9TAtiXIyvPOVZ6qvynYod56uLKtZ1gSolKQa5hE67c97ze75Xgu7f9nIbwLZWUbW8nUyxerC6_wo-4
Component 2: eyJhbGciOiAiUlMyNTYifQ.eyJvYmplY3QiOiBbIjItMmZiYzAyMzAwYTU0YWI3Yjk0Yzk5ZWQxYTUxNjM3OTFlMjVmY2I5MzQ3MmRjYzExMzU1M2VmZGFiMmQ2N2MzYmRkYWNmYjM0YmY5OTc4M2NiYzk4NDY2ODQ0NWY2MzAiLCAiMSIsIDUsIDgsICI4OTJjZDdlNzBkYWEzMmIxZjdiNjdiMzJhYTQwYTM5MTBiODFlZGQ2MzkyOGEwMTFiMzc5ODQyMmViZTZiNTdkIl19.r8rU6JLHT3SuOa553879FACgdCGiZy6KfwKokaumEdQF6WWhb5vXWGtI3e6NJRnMFhPzXvgG4-v7U5jJBSfy8KXJaxRKaRO7CAPaoGKGJF_dwgHfThNYzi0ehuvqb7COGDz8_7lrc8LfhIAdsufH76hmhqcKzwr_BuHuJWXvDVA
Component 3: eyJhbGciOiAiUlMyNTYifQ.eyJvYmplY3QiOiBbIjMtOTNmZTNhMTVlNjA5Njg1MzU1OTkyNDMyMzE2ZTMzYjlmMGQzNzgwYjU4MWUzZDY2YTRmMzU5YzAxZWM3MDQ3NzJlYWZhMTI0NTA0NzY1ODE4NzE1MGVkNTE2MzRiZWVkIiwgIjEiLCA1LCA4LCAiMTBmNzQyYTcyNTg3NTM0MTQ1M2UxZDhmNWU2NTRmN2UyYzRkODU5NDEwODBjODAyMmUwOWUwM2Q3ZWUwMmZmYiJdfQ.YUJRIG34cBBs3KNz0Di59cGLlwkLVV-0RXwN0DiW4ycdcooCIDYdEUO29hi1GAgIute57_RYUS7bQHT_u2ooBWDhEufCe3XkpONELATpBsI6mnyQwtA2Mi7SQ0I_E_EEJD1-lx0qHA5DJNFq-jc8IkuzI1xsMQuBohcIFKezers
Component 4: eyJhbGciOiAiUlMyNTYifQ.eyJvYmplY3QiOiBbIjQtOGIwOWYwZjZmYjc3MGFjZDAyMmFiMjc0Njc4NmQ1MjA1NDVkYjg5OWUzNmEyMDlhODUxYzE3MjQ3ZWU1YTIzZjZhYjZhZDIxY2I2ODExN2E0NWI0ZDc0ZTA1YjZjMzhkIiwgIjEiLCA1LCA4LCAiN2QyYzkzODk1ODg4YmM3N2VhNzUzOTBiNGQxM2MzYzhlZjAyYjQwYWU5YTEwZjA3MTM4ODc3ZGNjZTViYjc3ZSJdfQ.pQwUxuwsPfOpH029M_MJfhI7gPn1MOv_lFvKV3mIdgnY81NVoYz6FiJCVwKDbVTH_Kssd2chd7vXHEC9DUvFAlg74xJudqQwDUaq82nAbDvyihxylMGj-5sTUJI6_c5LUjHrjH4h6B-nEKYtoLBGZgDxtlNcpUMl0uPetzcqsiw
Component 5: eyJhbGciOiAiUlMyNTYifQ.eyJvYmplY3QiOiBbIjUtNzBjZGZmMjdjYmYyNzZlZGM4OTAyODI1ZTIxZDc2Yzg5ODFiYjEwMTkzODc2Y2JlYTU4NmFiMjhiYWJlNzE0MWRiZmJmNmNjNDIxYTg0NmUxNTY0OTM0ZTM4NDZkYjExIiwgIjEiLCA1LCA4LCAiZjNhYTQ4ZjUwODgzNDM3MDlmYzU2ZjI5NTJiZWIzYWI0OTlkOWJkOGJjNDUzMmE5MmE3MzE2ZjI2OTgxMzcwYiJdfQ.ZhQWUGm7jLBQju3GCHJjUtQiuteWwy3_UGmpJCweZ3RzUQMqPg8HAQuGPMFF-Li_F5NAd3lmZQDghnpElV9RMAiYJeZRmsTdVYT_LpQ-0JHX6MIqEmNJgwqBAzc9k-q4CbtiGmbOpt5FbMqhnsCbVfLTCX3BJPd7rWUpFQ1vnrc
Error: Invalid number of components
```

```
$ python recoverSecretFromComponents-app.py 5 1 mykey.crt
Component 1: eyJhbGciOiAiUlMyNTYifQ.eyJvYmplY3QiOiBbIjEtMmM1NmUwNTM0ZTg0Y2YxNDFkYmU0NjgyYmQyOWYwMjczZTc4NGYwOTkyYTgxY2Q3MjVhOTA5Nzg4ODM5NjgxMmQ5OGI4NmI2ZmNhYTNkZTNhY2I3NTJkZGI3NDY4MGRlIiwgIjEiLCA1LCA4LCAiYjAzZWZlNDM3ODAxYWRjZGU2MjcyNTJiMTRiMDA2OGE2MDNmOWFhZmY5MzMwYzRhN2IwYWVmYjYyNWY0NGZmZSJdfQ.HZRcAjlqjdFcA1MlreUOkcRq1olKvXICAYw8yxiv0WvvwjkgTw2XQUak1_VEh364PnwhWlwYDe3CLOlEYd9xX6sAw0OI-9TAtiXIyvPOVZ6qvynYod56uLKtZ1gSolKQa5hE67c97ze75Xgu7f9nIbwLZWUbW8nUyxerC6_wo-4
Component 2: eyJhbGciOiAiUlMyNTYifQ.eyJvYmplY3QiOiBbIjItMmZiYzAyMzAwYTU0YWI3Yjk0Yzk5ZWQxYTUxNjM3OTFlMjVmY2I5MzQ3MmRjYzExMzU1M2VmZGFiMmQ2N2MzYmRkYWNmYjM0YmY5OTc4M2NiYzk4NDY2ODQ0NWY2MzAiLCAiMSIsIDUsIDgsICI4OTJjZDdlNzBkYWEzMmIxZjdiNjdiMzJhYTQwYTM5MTBiODFlZGQ2MzkyOGEwMTFiMzc5ODQyMmViZTZiNTdkIl19.r8rU6JLHT3SuOa553879FACgdCGiZy6KfwKokaumEdQF6WWhb5vXWGtI3e6NJRnMFhPzXvgG4-v7U5jJBSfy8KXJaxRKaRO7CAPaoGKGJF_dwgHfThNYzi0ehuvqb7COGDz8_7lrc8LfhIAdsufH76hmhqcKzwr_BuHuJWXvDVA
Component 3: eyJhbGciOiAiUlMyNTYifQ.eyJvYmplY3QiOiBbIjMtOTNmZTNhMTVlNjA5Njg1MzU1OTkyNDMyMzE2ZTMzYjlmMGQzNzgwYjU4MWUzZDY2YTRmMzU5YzAxZWM3MDQ3NzJlYWZhMTI0NTA0NzY1ODE4NzE1MGVkNTE2MzRiZWVkIiwgIjEiLCA1LCA4LCAiMTBmNzQyYTcyNTg3NTM0MTQ1M2UxZDhmNWU2NTRmN2UyYzRkODU5NDEwODBjODAyMmUwOWUwM2Q3ZWUwMmZmYiJdfQ.YUJRIG34cBBs3KNz0Di59cGLlwkLVV-0RXwN0DiW4ycdcooCIDYdEUO29hi1GAgIute57_RYUS7bQHT_u2ooBWDhEufCe3XkpONELATpBsI6mnyQwtA2Mi7SQ0I_E_EEJD1-lx0qHA5DJNFq-jc8IkuzI1xsMQuBohcIFKezers
Component 4: eyJhbGciOiAiUlMyNTYifQ.eyJvYmplY3QiOiBbIjQtOGIwOWYwZjZmYjc3MGFjZDAyMmFiMjc0Njc4NmQ1MjA1NDVkYjg5OWUzNmEyMDlhODUxYzE3MjQ3ZWU1YTIzZjZhYjZhZDIxY2I2ODExN2E0NWI0ZDc0ZTA1YjZjMzhkIiwgIjEiLCA1LCA4LCAiN2QyYzkzODk1ODg4YmM3N2VhNzUzOTBiNGQxM2MzYzhlZjAyYjQwYWU5YTEwZjA3MTM4ODc3ZGNjZTViYjc3ZSJdfQ.pQwUxuwsPfOpH029M_MJfhI7gPn1MOv_lFvKV3mIdgnY81NVoYz6FiJCVwKDbVTH_Kssd2chd7vXHEC9DUvFAlg74xJudqQwDUaq82nAbDvyihxylMGj-5sTUJI6_c5LUjHrjH4h6B-nEKYtoLBGZgDxtlNcpUMl0uPetzcqsiw
Component 5: eyJhbGciOiAiUlMyNTYifQ.eyJvYmplY3QiOiBbIjUtNzBjZGZmMjdjYmYyNzZlZGM4OTAyODI1ZTIxZDc2Yzg5ODFiYjEwMTkzODc2Y2JlYTU4NmFiMjhiYWJlNzE0MWRiZmJmNmNjNDIxYTg0NmUxNTY0OTM0ZTM4NDZkYjExIiwgIjEiLCA1LCA4LCAiZjNhYTQ4ZjUwODgzNDM3MDlmYzU2ZjI5NTJiZWIzYWI0OTlkOWJkOGJjNDUzMmE5MmE3MzE2ZjI2OTgxMzcwYiJdfQ.ZhQWUGm7jLBQju3GCHJjUtQiuteWwy3_UGmpJCweZ3RzUQMqPg8HAQuGPMFF-Li_F5NAd3lmZQDghnpElV9RMAiYJeZRmsTdVYT_LpQ-0JHX6MIqEmNJgwqBAzc9k-q4CbtiGmbOpt5FbMqhnsCbVfLTCX3BJPd7rWUpFQ1vnrc
Recovered secret: Agora temos um segredo extremamente confidencial
```

```
$ python recoverSecretFromAllComponents-app.py 8 1 mykey.crt
Component 1: eyJhbGciOiAiUlMyNTYifQ.eyJvYmplY3QiOiBbIjEtMmM1NmUwNTM0ZTg0Y2YxNDFkYmU0NjgyYmQyOWYwMjczZTc4NGYwOTkyYTgxY2Q3MjVhOTA5Nzg4ODM5NjgxMmQ5OGI4NmI2ZmNhYTNkZTNhY2I3NTJkZGI3NDY4MGRlIiwgIjEiLCA1LCA4LCAiYjAzZWZlNDM3ODAxYWRjZGU2MjcyNTJiMTRiMDA2OGE2MDNmOWFhZmY5MzMwYzRhN2IwYWVmYjYyNWY0NGZmZSJdfQ.HZRcAjlqjdFcA1MlreUOkcRq1olKvXICAYw8yxiv0WvvwjkgTw2XQUak1_VEh364PnwhWlwYDe3CLOlEYd9xX6sAw0OI-9TAtiXIyvPOVZ6qvynYod56uLKtZ1gSolKQa5hE67c97ze75Xgu7f9nIbwLZWUbW8nUyxerC6_wo-4
Component 2: eyJhbGciOiAiUlMyNTYifQ.eyJvYmplY3QiOiBbIjItMmZiYzAyMzAwYTU0YWI3Yjk0Yzk5ZWQxYTUxNjM3OTFlMjVmY2I5MzQ3MmRjYzExMzU1M2VmZGFiMmQ2N2MzYmRkYWNmYjM0YmY5OTc4M2NiYzk4NDY2ODQ0NWY2MzAiLCAiMSIsIDUsIDgsICI4OTJjZDdlNzBkYWEzMmIxZjdiNjdiMzJhYTQwYTM5MTBiODFlZGQ2MzkyOGEwMTFiMzc5ODQyMmViZTZiNTdkIl19.r8rU6JLHT3SuOa553879FACgdCGiZy6KfwKokaumEdQF6WWhb5vXWGtI3e6NJRnMFhPzXvgG4-v7U5jJBSfy8KXJaxRKaRO7CAPaoGKGJF_dwgHfThNYzi0ehuvqb7COGDz8_7lrc8LfhIAdsufH76hmhqcKzwr_BuHuJWXvDVA
Component 3: eyJhbGciOiAiUlMyNTYifQ.eyJvYmplY3QiOiBbIjMtOTNmZTNhMTVlNjA5Njg1MzU1OTkyNDMyMzE2ZTMzYjlmMGQzNzgwYjU4MWUzZDY2YTRmMzU5YzAxZWM3MDQ3NzJlYWZhMTI0NTA0NzY1ODE4NzE1MGVkNTE2MzRiZWVkIiwgIjEiLCA1LCA4LCAiMTBmNzQyYTcyNTg3NTM0MTQ1M2UxZDhmNWU2NTRmN2UyYzRkODU5NDEwODBjODAyMmUwOWUwM2Q3ZWUwMmZmYiJdfQ.YUJRIG34cBBs3KNz0Di59cGLlwkLVV-0RXwN0DiW4ycdcooCIDYdEUO29hi1GAgIute57_RYUS7bQHT_u2ooBWDhEufCe3XkpONELATpBsI6mnyQwtA2Mi7SQ0I_E_EEJD1-lx0qHA5DJNFq-jc8IkuzI1xsMQuBohcIFKezers
Component 4: eyJhbGciOiAiUlMyNTYifQ.eyJvYmplY3QiOiBbIjQtOGIwOWYwZjZmYjc3MGFjZDAyMmFiMjc0Njc4NmQ1MjA1NDVkYjg5OWUzNmEyMDlhODUxYzE3MjQ3ZWU1YTIzZjZhYjZhZDIxY2I2ODExN2E0NWI0ZDc0ZTA1YjZjMzhkIiwgIjEiLCA1LCA4LCAiN2QyYzkzODk1ODg4YmM3N2VhNzUzOTBiNGQxM2MzYzhlZjAyYjQwYWU5YTEwZjA3MTM4ODc3ZGNjZTViYjc3ZSJdfQ.pQwUxuwsPfOpH029M_MJfhI7gPn1MOv_lFvKV3mIdgnY81NVoYz6FiJCVwKDbVTH_Kssd2chd7vXHEC9DUvFAlg74xJudqQwDUaq82nAbDvyihxylMGj-5sTUJI6_c5LUjHrjH4h6B-nEKYtoLBGZgDxtlNcpUMl0uPetzcqsiw
Component 5: eyJhbGciOiAiUlMyNTYifQ.eyJvYmplY3QiOiBbIjUtNzBjZGZmMjdjYmYyNzZlZGM4OTAyODI1ZTIxZDc2Yzg5ODFiYjEwMTkzODc2Y2JlYTU4NmFiMjhiYWJlNzE0MWRiZmJmNmNjNDIxYTg0NmUxNTY0OTM0ZTM4NDZkYjExIiwgIjEiLCA1LCA4LCAiZjNhYTQ4ZjUwODgzNDM3MDlmYzU2ZjI5NTJiZWIzYWI0OTlkOWJkOGJjNDUzMmE5MmE3MzE2ZjI2OTgxMzcwYiJdfQ.ZhQWUGm7jLBQju3GCHJjUtQiuteWwy3_UGmpJCweZ3RzUQMqPg8HAQuGPMFF-Li_F5NAd3lmZQDghnpElV9RMAiYJeZRmsTdVYT_LpQ-0JHX6MIqEmNJgwqBAzc9k-q4CbtiGmbOpt5FbMqhnsCbVfLTCX3BJPd7rWUpFQ1vnrc
Component 6: eyJhbGciOiAiUlMyNTYifQ.eyJvYmplY3QiOiBbIjYtYWFmY2Y2YTA3MGJlNTM2MWFjNjA3ZjA4ODczMDAyYjRiY2RlNGVlMWZkMTgwY2M0M2YwOGMwNjQxNGRjNmRiNzE3ZWFkMjRjZmMwODI2YmZhYTgwYzhhYWUwMzZjOTM1IiwgIjEiLCA1LCA4LCAiODRmYTc0ZDlmNmFlY2UyYjBlN2UyMjI4MGRlNzk2MTIzMTUyNWIwMzA5NDg5YmZlMDMyZDEzYmFjNTFkMGI5OCJdfQ.J4V_RDWjwpHSoB7Z7_GOH-3z9_BcpeacnTrM98OdqV9YEz3t-7xVVCktyylZCDzEbvXTuj-6Ttb05rFwDwqrST4ZwYv0kFmhumzPKAJpzQHh0L1-uHVOIgoL5SFTHhx_nlhPv6YIKVeZgOdqSHIzOWFuffVpJuLIgXdUhDSgJZY
Component 7: eyJhbGciOiAiUlMyNTYifQ.eyJvYmplY3QiOiBbIjctN2M0Y2UwZWY5MTViYThiN2FiM2FjNzJkZmQzODFkY2M3NGYwN2FkZDhjMmVmMDJiZDE5Njc4MDcyMzIwNWZlYWRmNGRlNGQ2MDNjNGUwMzQ2MDA2Y2Q5MTdjYWYzZDg5IiwgIjEiLCA1LCA4LCAiYWRhZjZkMGY4MjEzZWQ1MjAwMTUzODVjYmY1NDBlMjk4N2FjZGUxNmI4MTliMWMyYzFlZGFlYjNiZjIzMDhhOSJdfQ.ngbOc_jIRx7lKAreMiDJNM22p023dIuzBpzUsBruhTePxXyUkx4kXqfCuH1Wdfk6mh5B-RDY77d_hNjdAmRhJmZ_fk_Q3A7vrcVfqJNF0BuiiBErMIrNQg1qToOJGshjZtwvrVeoM4tr0ylpFNC9Q9gt9a-fKmdzqPqke0geehw
Component 8: eyJhbGciOiAiUlMyNTYifQ.eyJvYmplY3QiOiBbIjgtNDc3M2YzYTYzODllMTYxYmNjNjI2ZjdhYjJiMjdkZDI0MTcxODk5ODQ1MDBiMDUyNDQyNjlkYmNlYzBkYzNjMWU0ZjI0YTIyNmNmMTdmNDM3OTRjODg3ZDlhZmQ1M2YiLCAiMSIsIDUsIDgsICI4NGZjY2E2NzE3MWExZjg1ZDJmOWY2NTc1ZDU4OWU1NWZhN2E1ZWMzYjU3OTBmMDUzYmQwYjBjODI4ZjUyMjQyIl19.QRtZiSFSZEFwLD40CdwSKbUwB1FEkHk4xji5bv0NWg00ixupBXXeUjkheWZHdpJzFvvRNsekGw4a-VJBZg-LPC-XSzYtlgDiI-2PDOqnCIi5irbBXMDop6XzWRyIUBqAN7czj3wmi8_RnWm98Yzq0w_v6BPg1iMKG8iX0a9ZJuE
Recovered secret: Agora temos um segredo extremamente confidencial
```

O programa ```recoverSecretFromAllComponents``` poderá ser necessário no caso do segredo ser mais importante do que o que estava previsto aquando da criação ou caso dos utilizadores quererem, simplesmente, aumentar a segurança e o secretismo do segredo.

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
