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

### Pergunta 2.2
