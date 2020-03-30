# TPC 5 - Aula 6

## Exercício 1 - **RGPD** (Regulmante Geral de Proteção de Dados)

### Pergunta 1.1

A pseudonimização permite a ofuscação da identidade de um indivíduo, bem como tornar a sua procura impossível através de diferentes domínios de processamento de dados. Deste modo, considera-se que as técnicas de pseudonimização tenham de cumprir dois objetivos:

+ D1 - Os pseudónimos de um dado indivíduo não podem ser fáceis de identificar por partes exteriores a um dado contexto de dados.
+ D2 - Os pseudónimos não serão simples de reproduzir por terceiros, de modo a evitar que diferentes contextos de dados utilizem o mesmo pseudónimo para cada determinado indivíduo, certificando que nenhum utilizador pode ser ligado a qualquer pseudónimo.

Para tal, foi desenvolvido um conjunto de técnicas que pretendem proteger a identidade de indivíduos como medida de segurança.

##### *Hashing without key*

Uma função de *hash* criptográfica `h` tem como objetivo transformar qualquer mensagem `m` de tamanho arbitrário num valor de *hash* `h(m)` de tamanho fixo. Apesar destas funções terem propriedades como *pre-image resistance*, *2nd pre-image resistance* e *collision resistance*, não cumprem alguns dos requisitos necessários na pseudonimização como:

- **D2**: terceiros conseguem aplicar a mesma função de *hash* e a partir de um identificador obter o mesmo pseudónimo.
- **D1**: é trivial verificar, por terceiros, se um pseudónimo corresponde a um dado identificador.

Em suma, esta técnica é considerada fraca, pois pode ser revertida sem informação adicional. Logo, não deve ser usada isoladamente para obter pseudonimização.

##### *Hashing with key or salt*

As funções de *hash* com chave podem ser utilizadas para anonimizar dados, visto que apagar a chave secreta elimina quaisquer associações entre pseudónimos e os identificadores iniciais. Isto seria equivalente, a gerar pseudónimos aleatórios, sem qualquer ligação aos identificadores iniciais.

Da mesma forma, poderiam-se utilizar funções de *hash* sem chave, mas que recebem um *salt*, pois se este é destruído de forma segura pelo controlador, não é trivial recuperar a associação entre pseudónimos e identificadores.

Contudo, o *salt* não possui as mesmas propriedades de imprevisibilidade que as chaves secretas (tamanho inferior) e as funções de *hash* com chave são consideradas, geralmente, criptograficamente mais fortes.

##### *Cifra como técnica de pseudonimização*

A utilização de cifras simétricas, tais como o AES, é também considerado um método eficiente de gerar pseudónimos. Nestes, o identificador de um indivíduo é cifrado com uma chave simétrica que deverá ser conhecida apenas pelo controlador e processador dos dados, que, quando necessário, é utilizada para decifrar o pseudónimo para recuperar o identificador original.

Tal como no caso das funções de *hash*, as chaves utilizadas têm um tamanho mínimo de 256 bits, tamanho considerado razoável para segurança mesmo em contexto quântico. No entanto, ao contrário das funções de *hash*, o controlador pode, a qualquer momento, recuperar o identificador do sujeito através de uma operação de decifragem. Assim, torna-se mais difícil o *tracking* de indivíduos devido ao facto de que estes não necessitam guardar os identificadores.

Por outro lado, as cifras assimétricas têm também um conjunto de caraterísticas que as tornam úteis na pseudonimização. A sua estrutura de chave pública ajusta-se bem para contextos nos quais o controlador de dados, responsável por efetuar a pseudonimização, não está autorizado para recuperar a respetiva identidade, utilizando a chave pública correspondente a um controlador que guarda a respetiva chave privada. Deste modo, permite-se a separação de tarefas de segurança. Ainda mais, recorrendo à utilização de valores aleatórios, assegura-se que os pseudónimos gerados não podem ser utilizados para seguir o percurso de um indivíduo através de vários contextos de dados.

É de notar, no entanto, que algoritmos de chaves assimétricas são bastante menos eficientes do que os de chaves simétricas, necessitando chaves de tamanho elevado, 3072 bits no caso do RSA. Mesmo recorrendo a curvas elíticas, que utilizam chaves bastante menores, incorrem tempos de processamento mais longos.

##### Outras técnicas baseadas em criptografia

Além das abordagens anteriormente mencionadas, é possível combinar esquemas criptográficos e obter um abordagem de pseudonimização segura. A título exemplificativo, tem-se a geração de diferentes pseudónimos para os vários domínios que compõe um sistema, através de *polymorphic encryption*. 

Mais ainda, existem as soluções descentralizadas. Nestas, cada participante gera e controla os seus próprios pseudónimos. De facto, esta é uma estratégia muitas vezes aplicada quando o controlador dos dados não pode ter conhecimento prévio da identidade dos utilizadores, ou seja, o acesso apenas é conseguido depois do utilizador assim o entender.

Por fim, referir que o desafio que todos os métodos enfrentam está relacionado com a gestão da chave. Este processo não é de todo trivial, uma vez que depende tanto da escala da aplicação, como da própria técnica escolhida.

##### *Tokenisation*

Tokenização refere-se ao processo em que os identificadores de indivíduos são substituídos por valores gerados aleatoriamente, conhecidos como *tokens*, sem existir qualquer relação matemática com os identificadores originais. Assim, o conhecimento de um *token* é inútil para qualquer um, exceto o controlador ou o processador.

Apesar da eficiência da tokenização, a sua implementação pode, dependendo do contexto, ser relativamente complexa. De facto, em várias aplicações pode ser necessário, por exemplo, a sincronização de *tokens* através de vários sistemas.

##### Outras aboradagens

Existem também outras medidas bem conhecidas cujo objetivo são pseudonimisar a informação guardada num ficheiro, sendo estas relativamente limitadas na sua aplicação:

+ *Masking* refere-se ao processo de esconder o identificador de um indivíduo com carateres aleatórios ou outros dados. Tal prática nem sempre pode garantir as propriedades de pseudonimização. Ainda mais, se implementado pouco cuidadosamente, poderá atribuir o mesmo pseudónimo a indivíduos diferentes, gerando colisões.
+ *Scrambling* refere-se a um conjunto de técnicas de mistura e ofuscação de carateres de um identificador. Este processo é reversível de acordo com a técnica escolhida. O *Scrambling* pode ser considerado uma forma de cifra simétrica simplificada, tornando a fraca na manutenção da pseudonimização em casos específicos.
+ *Blurring* trata-se da utilização de valores aproximados com o intuito a precisão dos dados, reduzindo a identificabilidade dos indivíduos. Esta técnica pode também ser aplicada na ofuscação de imagens no processo de pseudonimização. É de notar, no entanto, que algoritmos de reconhecimento de imagens com redes neuronais poderão ser capazes de recuperar tais imagens.

### Pergunta 1.2 - *Order and delivery of goods*

Como foi apresentado no documento, antes de passar à fase da avaliação do risco é necessário fazer uma pequena introdução ao problema. 

O *Order and delivery of goods* consiste uma loja virtual onde o cliente tem que ser registar para conseguir usufruir do sistema. Com isto diferentes entidades vão obter e guardar diferentes dados. Dito isto, na tabela seguinte é feito o resumo do processo:

|      Descrição do Processo      |                                               *Order and delivery of goods*                                               |
| :-----------------------------: | :------------------------------------------------------------------------------------------------------------------------:|
| Processar dados pessoais        | Informação do contacto (Primeiro e último nome, morada, número de telemóvel) e Informações de pagamento (cartão de credito, informação da conta bancária)                                                                                                                        |
| Propósito do processamento      | *Order and delivery of goods*                                                                                             |
| De quem é a informação?         | Clientes                                                                                                                  |
| Processamento da informação     | Sistemas de gestão de encomendas                                                                                          |
| Quem recebe a informação?       | Provedor do serviço de pagmento (externo)                                                                                 |
| Quem recebe a informação?       | Provedor do serviço de entregas (externo)                                                                                 |
| Quem recebe a informação?       | CRM (*Customer Relation Management*) (interno)                                                                            |
| Quem recebe a informação?       | ERP (*Enterprise Resource Planning*) (interno)                                                                            |
| Processador de informação usado | *In-house* ou organizações externas                                                                                       |


|      Descrição do Processo      |                                               *Order and delivery of goods*                                               |
| :-----------------------------: | :------------------------------------------------------------------------------------------------------------------------:|
| Processar dados pessoais        | Informação do contacto (Primeiro e último nome, morada, número de telemóvel) e Informações de pagamento (cartão de credito, informação da conta bancária)                                                                                                                        |
| Propósito do processamento      | *Order and delivery of goods*                                                                                             |
| De quem é a informação?         | Clientes                                                                                                                  |
| Processamento da informação     | Sistemas de gestão de encomendas                                                                                          |
| Quem recebe a informação?       | Provedor do serviço de pagmento (externo) 
                                    Provedor do serviço de entregas (externo)
                                    CRM (*Customer Relation Management*) (interno)
                                    ERP (*Enterprise Resource Planning*) (interno)                                                                            |
| Processador de informação usado | *In-house* ou organizações externas                                                                                       |

#### sasa