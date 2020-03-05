# TPC 3 - Aula 4

## Exercício 1 - TOR (The Onion Router)

### Pergunta 1.1

Não é possível garantir que o *IP* está localizado nos Estados Unidos através do comando ```sudo anonsurf start```. Isto porque apesar do *Onion Proxy (OP)* estabelecer um circuito através da rede *TOR*, o processo é feito de forma aleatória e independemente do utilizador. Como o processo é aleatório não existe forma de garantir que o *IP* final do circuito (nodo de saída) está localizado nos Estados Unidos.

### Pergunta 1.2

O *output* da consulta ao *website* [http://zqktlwi4fecvo6ri.onion/wiki/index.php/Main_Page](http://zqktlwi4fecvo6ri.onion/wiki/index.php/Main_Page) é possível ser consultado na seguinte imagem. Onde existem 6 saltos, os três primeiros () e os três seguintes são *relay*.

![Tor_info](/Images/Tor_info.jpg)

Para começar, este tipo de circuitos estão associados aos serviços anónimos e *pontos de rendezvous*. Ou seja, tanto quem fornecer o serviço (servidor *web*) como quem acede são anónimos.

O processo de criação assenta em 6 passos:
* O Bob (fornece o serviço) tem que criar um par de chaves para identificar o serviço *Web* (a chave pública identifica o serviço). Depois, são escolhidos alguns pontos de introdução (*introduction points*) e anuncionados ao *Directory Server* sendo que este é assinado com chave privada. A seguir, de modo a complementar os dois primeiros passos, é criado um circuito *TOR* para cada um dos pontos de introdução e estes ficam à espera de pedidos.

![Tor1](/Images/Tor_1-2.jpg)

* A Alice (acede ao servidor *web*) conhece o endereço do serviço e acede aos seus detalhes através do *directory server*, no **TOR**. Depois, a Alice estabelece uma conexão ao serviço através de um *OR* usando como *ponto de rendezvous*. Nesta fase, a Alice constrói um caminho até ao *ponto de rendezvous* fornecendo-lhe um segredo para depois ser reconhecido pelo servidor. Por fim, é aberto um *stream anónimo* até um dos pontos de introdução enviando uma mensagem cifrada que contém informação sobre o *ponto de rendezvous*, o segredo e o ínicio da troca das chaves **DH**.

![Tor2](/Images/Tor_3-4.jpg)

* Caso o servidor (Bob) pretende falar com quem está a aceder (Alice), o Bob cria um circuito até o *ponto de rendezvous* enviando o *rendezvous cookie*, a segunda parte da troca de chaves **DH** e uma *hash* da chave da sessão que ambos partilham, a partir desse momento. Desta forma, cada uma das partes, normalmente, cria um circuito com 3 nodos sem que haja reconhecimento das partes de um ou de outro. Assim, a Alice envia uma célula de *relay* que ao chegar ao *OR* do Bob conecta o serviço, permitindo comunicar anonimamente.

![Tor3](/Images/Tor_5-6.jpg)

Com isto tudo, é possível entender que 3 dos nodos são escolhidos pelo servidor (*relay*) e os outros 3 são escolhidos por quem acede.
