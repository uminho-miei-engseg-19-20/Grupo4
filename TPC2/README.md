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

O **DROWN**, *Decrypting RSA with Obsolete and Weakened eNcryption*, é um ataque. É um *bug* de segurança *cross-protocol* que ataca servidores que suportam os protocolos modernos SSLv3/TLS usando para isso o protocolo *SSLv2*, que já não tem suporte e é insegurado. Através do uso deste protocolo o atacante obtém uma vantagem que permite ataquer as conexões usando protocolos atuais, que seriam seguros não fosse o facto explicado anteriormente.

Como o protocolo *SSLv2* não está a ser utilizado, não existe perigo do servidor sofrer um ataque de **DROWN**. O  

## Exercício 3 - Protocolo SSH

### Pergunta 3.1
