#!/bin/bash
# Script pour passer le contenu de la preprod à la prod 
# Ce script doit être appelé depuis le serveur, depuis n'importe quel répertoire.

if [ $# -ne 0 ]; then
	echo "Usage: $0"
	exit -1
fi

cd $HOME
rm preprod/data/cache/*

#--------- Backup ---------
rm -R prod_bak
cp -R prod prod_bak
echo "Le backup prod_bak a été créé."

echo "========== Synchronisation ========"
rsync -rltDzn --stats preprod/ prod
echo "========== Fin synchronisation ========"
cp index_prod.php prod/public/index.php
