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
