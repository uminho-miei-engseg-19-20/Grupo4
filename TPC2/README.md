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

#### Anexo de resultados do *ssh-audit*

* 89.153.16.233:

|    Server       | 89.153.16.233                 |
|:---------------:|:-----------------------------:|
| Cidade:         | Braga                         |
| País:           | Portugal                      |
| Organização:    | ZON Tv Cabo                   |
| ISP:            | Nos Comunicacoes, S.A.        |
| Último Update:  | 2020-03-01T00:34:35.515226    |
| Hostname:       | a89-153-16-233.cpe.netcabo.pt |
| ASP:            | AS2860                        |
| Versão SSH:     | SSH-2.0-OpenSSH_8.0           |

* 188.81.26.149:

|    Server       | 188.81.26.149                 |
|:---------------:|:-----------------------------:|
| Cidade:         | Braga                         |
| País:           | Portugal                      |
| Organização:    | MEO                           |
| ISP:            | MEO                           |
| Último Update:  | 2020-03-02T07:49:22.140221    |
| Hostname:       | bl16-26-149.dsl.telepac.pt    |
| ASP:            | AS3243                        |
| Versão SSH:     | SSH-2.0-dropbear_0.52         |

#### Versões de software

#### Versão com mais vulnerabilidades

A versão 4.4 do *Squid* é a versão que têm mais vulnerabilidades registadas. Existindo 4 vulnerabilidades associadas ao servidor 89.153.16.233 que afetam esta versão.

#### Vulnerabilidade mais grave

A vulnerabildiade mais grave encontrada ([CVE-2019-12525](https://www.cvedetails.com/cve-details.php?cve_id=CVE-2019-12525)) diz respeito às versões 3.3.9 até 3.5.28 e 4.X até 4.7 do *Squid*.

#### Gravidade da vulnerabilidade

A vulnerabilidade, classificada com valor 7.5, é grave. Pois causa alterações em ficheiros do do sistema e causa uma redução da performance do sistema. Para além disso, não é necessário autenticação e a complexidade de acesso é muito baixa para um atacante. Porém, a vulnerabilidade não garante acesso ao sistema.
