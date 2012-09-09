#!/bin/bash
# Script pour mettre en preprod le contenu du git.
# Ce script doit être appelé depuis l'ordinateur local

if [ $# -ne 1 ]; then
	echo "Usage: $0 username"
	exit -1
fi
USERNAME=$1

cd $HOME/Site/Sesquidistus/reference
git pull

echo "========== Synchronisation ========"
# -v: verbeux
# -e: Utilisation de SSH
# -r: récursif
# -l: Suis les liens symboliques
# -p: Préserve les permissions
# -t: Préserve les dates
# -D: Préserve les périphériques
# -z: pour compresser avant l'envoi sur le réseau
# -n: Liste ce qu'elle va faire sans l'exécuter
# --progress: Affiche l'avancement
# --filter: N'inclue pas les fichiers du répertoire .git
rsync -e ssh -rltDz --filter "- .git" ./ ${USERNAME}@ftp.frisbee-strasbourg.net:/homez.63/${USERNAME}/preprod --stats
echo "========== Fin synchronisation ========"

# Suppression répertoire cache et session
# Création du répertoire cache
# copie de application.ini dans le répertoire preprod
ssh ${USERNAME}@ftp.frisbee-strasbourg.net "cd preprod ; rm -fr data/cache data/session ; mkdir data/cache ; cp ../prod/application/configs/application.ini application/configs/application.ini ; cp ../index_preprod.php public/index.php"

