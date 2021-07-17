#!/bin/bash -eu

NOME=$(basename $PWD)-$(date '+%Y%m%d.%H%M').zip

zip -r \
    -q \
    -9 \
    $NOME \
    . \
    -x '.git/*' \
    -x '*.zip' \
    -x 'bootstrap/cache/**' \
    -x 'node_modules/*' \
    -x 'storage/app/**' \
    -x 'storage/framework/cache/**' \
    -x 'storage/framework/sessions/**' \
    -x 'storage/framework/testing/**' \
    -x 'storage/framework/views/**' \
    -x 'storage/logs/**' \
    -x 'vendor/*'

echo "Projeto arquivado como $NOME"

