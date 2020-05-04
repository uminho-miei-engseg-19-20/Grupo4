# TPC 8 - Aula 10

## Pergunta 1.1

### 1.

A vulnerabilidade encontrada na função ```vulneravel``` diz respeito aos argumentos ```x``` e ```y```, que são inteiros *unsigned*. A máquina tem um valor limite que consegue representar, se um destes valor ou o valor da multiplicação de ambos ultrapassar este limite, o número não dá para representar, como tal vai ser atribuído o valor 1. Assim, é alocado muito menos espaço do que era pretendido e, quando o programa começar a escrever na matriz, este irá escrever em locais de memória não pretendidos e não alocados para a variável ```matriz```. Desta forma, irá acontecer um *segmentation fault*.

### 2.

Código da função ```main``` alterado para demonstrar a vulnerabilidade:

```
#include <stdio.h>
#include <stdlib.h>

void vulneravel (char *matriz, size_t x, size_t y, char valor) {
    int i, j;
    matriz = (char *) malloc(x*y);

    for (i = 0; i < x; i++) {
        for (j = 0; j < y; j++) {
            matriz[i*y+j] = valor;
        }
    }
}

int main() {

    char *matrix;
    size_t x = 2147483649;
    size_t y = 2147483649;
    printf("Matrix size: %d\n", x*y);
    vulneravel(matrix,x,y,'1');

    return 0;
}
```

### 3.

Como já era de esperar ao executar a função usando valores de *input* muito grandes, o programa dá erro de *Segmentation Fault* pois tenta escrever em locais de memório não alocados para a variável ```matriz```.

![Pergunta1](./Imagens/Pergunta1.jpg)

## Pergunta 1.2

### 1.

### 2.

### 3.

### 4.

#### 4.1
