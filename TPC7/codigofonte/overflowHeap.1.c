#include <stdio.h>
#include <string.h>
#include <stdlib.h>

int main(int argc, char **argv) {
    int tam = 0;
    tam = strlen(argv[1]);

    char *dummy = (char *) malloc (sizeof(char) * (tam+1));
    char *readonly = (char *) malloc (sizeof(char) * 10);

    strncpy(readonly, "laranjas", 8);
    strncpy(dummy, argv[1], tam);
    dummy[tam] = '\0';

    printf("%s\n", readonly);
    printf("%s\n", dummy);
}
