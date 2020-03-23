# TPC 4 - Aula 5

## Exercício 1 - *Blockchain*

### Pergunta 1.1

Como pedido no enunciado, foi alterado no método ```createGenesisBlock``` de modo a que o *timestamp* fosse a data atual e a mensagem fosse "Bloco inicial da koreCoin". O código encontra-se em abaixo.

```
createGenesisBlock(){
    var d = new Date();
    return new Block(0, d.toString(), "Bloco inicial da koreCoin", "0");
}
```

Depois de uns ajustes no ficheiro para imprimir o bloco certo, o resultado em abaixo foi o esperado.


```
Blockchain {
  chain:
   [ Block {
       index: 0,
       timestamp:
        'Mon Mar 23 2020 14:47:47 GMT+0000 (Western European Standard Time)',
       data: 'Bloco inicial da koreCoin',
       previousHash: '0',
       hash:
        '25f9251a18b2ac405da58b3d08005a36ee8885c9a7ae57f4471a2ef675df078a' } ] }
```

### Pergunta 1.2

Nesta alínea foram adicionados alguns blocos à blockchain, como foi pedido no enunciado. Estando o código em abaixo.

```
koreCoin.addBlock(new Block (1, "23/03/2020", {amount: 100}));
koreCoin.addBlock(new Block (2, "23/03/2020", {amount: 50}));
koreCoin.addBlock(new Block (3, "23/03/2020", {amount: 70}));
```

## Exercício 2 - *Proof of Work Consensus Model*

### Pergunta 2.1

Depois de alterar a variável da difculdade foi corrido o código para 4 difculdade diferentes.

#### Dificuldade 2

```
Mining block 1...
Block mined: 007abd29e589b6a35f6107095cbc8a3628b7a8ff9ac5f7a203f79b262fff077e
Mining block 2...
Block mined: 009d3e5e004957e04604a4032cc58a97f33adb6711f93bc7514de8fe4a531a37
Mining block 3...
Block mined: 004bb82a658a99fd8c9f0d40ec9e69d3a441dacb6383242659b1ff8f7b42195b

real	0m0.172s
user	0m0.168s
sys	0m0.020s
```

#### Dificuldade 3

```
Mining block 1...
Block mined: 0007c25169f5256ebb80fcbb423b582a8e699a759e41abb28906295973f9de4c
Mining block 2...
Block mined: 0004af57b70136e9f4b5309f92d518b3f297168d4cf47d4f9354808daadce457
Mining block 3...
Block mined: 00075796ab77bb5289bb9a952b91047482b3348d54d915ff5e5bce28256d01fe

real	0m0.640s
user	0m0.632s
sys	0m0.044s
```

#### Dificuldade 4

```
Mining block 1...
Block mined: 0000023168f87d968813b22c4dc92f60c127ff5084af8487d913d497ea7a7900
Mining block 2...
Block mined: 00008e0c291aaf728e015855328b14e651231cce209e6413503fd299e0df6c5e
Mining block 3...
Block mined: 0000fb4a126ef4c1c3c93bf2ed25e8db4c7da2ec89a46aad4f7bf092afd8b6b4

real	0m3.130s
user	0m3.028s
sys	0m0.100s
```

#### Dificuldade 5

```
Mining block 1...
Block mined: 0000023168f87d968813b22c4dc92f60c127ff5084af8487d913d497ea7a7900
Mining block 2...
Block mined: 000000b950a180294edddf4340a2d5834119a41bf89e4b2027f341f0fc02365e
Mining block 3...
Block mined: 0000088dc9c3115ee6ab7e95d2e8836f932d75d303ab451a825241acde589a58

real	0m43.962s
user	0m43.140s
sys	0m0.744s
```

### Pergunta 2.2

#### 2.2.1

O algoritmo ```proof of work```  consiste em incrementar (adicionar 1) ao valor do último número obtido no ```proof of work``` e continuar a incrementar o número até ser divisível por 9 e divisível pelo número anterior.

#### 2.2.2

O algoritmo não é o mais adequado. Primeiro, porque o cálculo da prova é realizado através da prova anterior, o que permite realizar provas antes do "tempo". Segundo, porque quando a *blockchain* atinge um tamanho considerável fica bastante complicado, e penoso computacional, encontrar um número divisível por 9 e pelo último **PoW**. Portanto, não achámos que este algoritmo seja o mais adequado.
