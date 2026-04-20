#!/bin/bash

RUTA_ENV="$(pwd)/.env"

if [ ! -f $RUTA_ENV ]
then
    echo "============================================="
    echo "[!] Parece que no ha creado el archivo "$RUTA_ENV
    echo "============================================="
    echo "Es necesario configurar la conexión a la base de datos en el archivo .env primero.\n"
    exit;
fi

BASEDIR_FLYWAY=$(pwd)/database/flyway
CONFIG_FILE=$BASEDIR_FLYWAY/conf/flyway.conf
ORIGINAL_TEMPLATE=$BASEDIR_FLYWAY/conf/flyway.conf.original

# Respalda el archivo de configuracion
# como si fuera un template de configuracion original
if [ ! -f $ORIGINAL_TEMPLATE ]
then
   cp $CONFIG_FILE $ORIGINAL_TEMPLATE
fi

# Respalda el archivo de configuracion actual
if [ -f $CONFIG_FILE ]
then
    cp $CONFIG_FILE $CONFIG_FILE.BAK
fi

# Obtiene las variables del .env
db_host=`grep ^DB_HOST $RUTA_ENV | cut -d"=" -f2`
if [ -z "$db_host" ]
then
    echo "========================================================================"
    echo "[!] Falta el parámetro DB_HOST en el archivo .env"
    echo "========================================================================"
    exit;
fi

db_port=`grep ^DB_PORT $RUTA_ENV | cut -d"=" -f2`
if [ -z "$db_port" ]
then
    db_port=5432
fi

db_name=`grep ^DB_DATABASE $RUTA_ENV | cut -d"=" -f2`
if [ -z "$db_name" ]
then
    echo "========================================================================"
    echo "[!] Falta el parámetro DB_DATABASE en el archivo .env"
    echo "========================================================================"
    exit;
fi

db_user=`grep ^DB_USERNAME $RUTA_ENV | cut -d"=" -f2`
if [ -z "$db_user" ]
then
    echo "========================================================================"
    echo "[!] Falta el parámetro DB_USERNAME en el archivo .env"
    echo "========================================================================"
    exit;
fi

db_password=`grep ^DB_PASSWORD $RUTA_ENV | cut -d"=" -f2`
if [ -z "$db_password" ]
then
    echo "========================================================================"
    echo "[!] Falta el parámetro DB_PASSWORD en el archivo .env"
    echo "========================================================================"
    exit;
fi

echo "Configurando el archivo flyway.conf..."

echo "flyway.url=jdbc:postgresql://$db_host:$db_port/$db_name" > $CONFIG_FILE
echo "flyway.user=$db_user" >> $CONFIG_FILE
echo "flyway.password=$db_password" >> $CONFIG_FILE

# Configuraciones por default...
echo "#flyway.locations=filesystem:sql" >> $CONFIG_FILE
echo "flyway.cleanDisabled=false" >> $CONFIG_FILE
echo "flyway.reportFilename=/tmp/flyway-report" >> $CONFIG_FILE

echo "Finalizó la configuración de Flyway"

