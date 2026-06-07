#!/usr/bin/env bash
set -euo pipefail

# À exécuter SUR le VPS (Ubuntu 24, root@144.91.78.84)
#
# Usage :
#   bash deploy/setup-vps.sh symbioll.com /var/www/symbioll.com/symbioll

DOMAIN="${1:-symbioll.com}"
APP_DIR="${2:-/var/www/symbioll.com/symbioll}"
DB_NAME="symbioll"
DB_USER="symbioll_user"
DB_PASS="$(openssl rand -base64 24 | tr -dc 'A-Za-z0-9' | head -c 24)"

echo "==> Domaine : $DOMAIN"
echo "==> Dossier : $APP_DIR"

if [ ! -f "${APP_DIR}/schema.sql" ]; then
    echo "Erreur : schema.sql introuvable dans ${APP_DIR}"
    exit 1
fi

echo "==> Création de la base MySQL..."
mysql -e "CREATE DATABASE IF NOT EXISTS ${DB_NAME} CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
mysql -e "CREATE USER IF NOT EXISTS '${DB_USER}'@'localhost' IDENTIFIED BY '${DB_PASS}';"
mysql -e "GRANT ALL PRIVILEGES ON ${DB_NAME}.* TO '${DB_USER}'@'localhost';"
mysql -e "FLUSH PRIVILEGES;"

echo "==> Import du schéma..."
mysql "${DB_NAME}" < "${APP_DIR}/schema.sql"

if [ ! -f "${APP_DIR}/config.php" ]; then
    echo "==> Génération de config.php..."
    cat > "${APP_DIR}/config.php" <<EOF
<?php

return [
    "db" => [
        "host" => "127.0.0.1",
        "port" => "3306",
        "name" => "${DB_NAME}",
        "user" => "${DB_USER}",
        "pass" => "${DB_PASS}",
    ],
];
EOF
else
    echo "==> config.php existant conservé."
fi

chown -R www-data:www-data "${APP_DIR}"
chmod 640 "${APP_DIR}/config.php"

echo ""
echo "=== Base configurée ==="
echo "DB_NAME=${DB_NAME}"
echo "DB_USER=${DB_USER}"
echo "DB_PASS=${DB_PASS}"
echo ""
echo "Créez un admin avec :"
echo "  cd ${APP_DIR} && php scripts/create-admin.php admin@symbioll.com 'VotreMotDePasse'"
