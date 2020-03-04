# TPC 2 - Aula 3

## Exercício 1 - Assinaturas cegas baseadas no Elliptic Curve Discrete Logarithm Problem (ECDLP)

### Pergunta 1.1

## Exercício 2 - Protocolo SSL/TLS

### Pergunta 2.1

Para a **pergunta 2**, foi-nos pedido que escolhessemos dois Ministérios do Governo Português, nós escolhemos o [Ministério da Justiça](https://justica.gov.pt/) e o [Ministério da Agricultura](https://www.dgadr.gov.pt/). Depois de escolhidos os Ministérios era necessário realizar um *SSL Server test* a cada um dos *websites*, usando o *site* [SSL labs](https://www.ssllabs.com/ssltest/).

#### i. Anexo de resultados

Para um melhor visualização dos resultados eles estão expostos em dois *pdfs* neste repositório:
* [Ministério da Justiça](https://github.com/uminho-miei-engseg-19-20/Grupo4/blob/master/TPC2/MinJustica.pdf)
* [Ministério da Agricultura](https://github.com/uminho-miei-engseg-19-20/Grupo4/blob/master/TPC2/MinAgricultura.pdf)

#### ii. Análise do resultado do SSL Server test relativo ao site com pior rating

Neste caso, o *website* com pior *rating* foi o do Ministério da Justiça. O *site* do Ministério da Justiça obteve uma classificação **B** o que não é propriamente mau, mas fica abaixo do esperado: uma classificação *A* ou *A+*, uma classificação perfeita.

Como é possível ver no *pdf* em anexo, o *site* não usa a versão mais recente do **TLS**, a 1.3, e utiliza versões já algo ultrapassadas como a *TLS 1.0*. Para além disto, quase todas as *Cipher suites* são consideradas fracas, por várias razões. Algumas pelo uso do modo *CBC* em vez do modo *GCM*, outras pelo algoritmo SHA usado (*SHA* em vez de *SHA256* ou até mesmo *SHA384*) e ainda outras devido a usarem apenas *RSA* em vez de *ECDHE*.   

#### iii. **DROWN** na secção de detalhe do protocolo

O **DROWN**, *Decrypting RSA with Obsolete and Weakened eNcryption*, é um ataque. Por outras palavras, é um *bug* de segurança *cross-protocol* que ataca servidores que suportam os protocolos modernos SSLv3/TLS, usando para isso o protocolo *SSLv2*, que já não tem suporte e é insegurado. Através do uso deste protocolo o atacante obtém uma vantagem que permite atacar as conexões usando protocolos atuais, que seriam seguros não fosse o facto explicado anteriormente.

Como o protocolo *SSLv2* não está a ser utilizado, não existe perigo do servidor sofrer um ataque de **DROWN**.

## Exercício 3 - Protocolo SSH

### Pergunta 3.1

#### 1 - Anexo de resultados do *ssh-audit*

- [ZON Tv Cabo](https://www.shodan.io/host/83.132.9.167)
	- [SSH-AUDIT *output*](./ZON.txt)

- [MEO](https://www.shodan.io/host/188.81.26.149#22):
	- [SSH-AUDIT *output*](./MEO.txt)

#### 2 - Versões de software

**ZON Tv Cabo**

# general
(gen) banner: SSH-2.0-OpenSSH_3.8.1p1 Debian-8.sarge.2
(gen) software: OpenSSH 3.8.1p1
(gen) compatibility: OpenSSH 3.7-6.6, Dropbear SSH 0.52
(gen) compression: enabled (zlib)
...

**MEO**

# general
(gen) banner: SSH-2.0-dropbear_0.52
(gen) software: Dropbear SSH 0.52
(gen) compatibility: OpenSSH 3.7-6.6, Dropbear SSH 0.52
(gen) compression: enabled (zlib, zlib@openssh.com)
...

#### 3 - Versão com mais vulnerabilidades

**ZON Tv Cabo**

- [SSH-AUDIT](./ZON.txt) - 18 vulnerabilidades
- [SHODAN Website](https://www.shodan.io/host/83.132.9.167) - 15 vulnerabilidades
- [CVE Details - Debian 8.0.2](https://www.cvedetails.com/version-search.php?vendor=Debian&product=Debian+Linux&version=8.0.2) - 0 vulnerabilidades
- [CVE Details - OpenSSH 3.8.1p1](https://www.cvedetails.com/vulnerability-list/vendor_id-97/product_id-585/version_id-25112/) - 19 vulnerabilidades

**MEO**

- [SSH-AUDIT](./MEO.txt) - 18 vulnerabilidades
- [SHODAN Website](https://www.shodan.io/host/188.81.26.149#22) - 15 vulnerabilidades
- [CVE Details - Dropbear 0.52](https://www.cvedetails.com/vulnerability-list/vendor_id-15806/product_id-33536/version_id-346043/) - 3 vulnerabilidades

#### 4 - Vulnerabilidade mais grave

Depois de analisar todas as vulnerabildiades encontradas, as duas mais graves foram o [CVE-2016-7406](https://www.cvedetails.com/cve-details.php?cve_id=CVE-2016-7406) e [CVE-2016-7407](https://www.cvedetails.com/cve-details.php?cve_id=CVE-2016-7407).

#### 5 - Gravidade da vulnerabilidade

A vulnerabilidade, classificada com valor 10, é muito grave. Pois revela toda a informação do sistema e deixa a integridade do sistema totalmente comprometida. Para além disso existe um *shutdown* total dos recursos afetados. Por fim, a dificuldade de acesso é baixa e não é necessário autenticação para realizar o ataque.
