#!/bin/bash

project_name=$(pwd|rev|awk -F \/ '{print $1}'|rev)
echo "Instalando Flyway para el proyecto: $project_name"

if [ ! -f database/flyway/flyway ]
then
    # En Mac usamos brew, no apt. Verificamos wget:
    if ! command -v wget &> /dev/null
    then
        echo "[!] wget no encontrado. Por favor ejecuta: brew install wget"
        exit 1
    fi

    export VERSION_FLYWAY=11.8.2
    # CAMBIO: Usamos arm64 en lugar de x64 para tu chip M4
    export LINK_FLYWAY=https://repo1.maven.org/maven2/org/flywaydb/flyway-commandline/$VERSION_FLYWAY/flyway-commandline-$VERSION_FLYWAY-macosx-arm64.tar.gz

    echo "[i] Descargando Flyway..."
    wget -qO- $LINK_FLYWAY | tar xvz

    if [ ! -d $(pwd)/database/flyway ]
    then
        mkdir -p $(pwd)/database/flyway
    fi

    cp -R $(pwd)/flyway-$VERSION_FLYWAY/* $(pwd)/database/flyway

    # Crear el enlace simbólico para usarlo como 'flyway-nombre_proyecto'
    if [ ! -f /usr/local/bin/flyway-$project_name ]
    then
        echo "[i] Creando acceso directo en /usr/local/bin/flyway-$project_name"
        # Nota: Esto podría pedirte contraseña de administrador
        sudo ln -s $(pwd)/database/flyway/flyway /usr/local/bin/flyway-$project_name
    fi

    rm -rf $(pwd)/flyway-$VERSION_FLYWAY

    echo "Flyway $VERSION_FLYWAY instalado exitosamente."
else
    echo "Flyway ya está presente en database/flyway"
fi