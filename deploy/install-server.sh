#!/usr/bin/env bash
set -euo pipefail

# Installation complète sur le VPS Ubuntu 24 (root@144.91.78.84)
#
# Usage (sur le serveur, en root) :
#   curl -fsSL https://raw.githubusercontent.com/droublibedel/SYMBIOLL/main/deploy/install-server.sh | bash
#   — ou —
#   bash deploy/install-server.sh
#
# Prérequis : Nginx, PHP-FPM, MySQL déjà installés sur le VPS.

REPO_URL="${REPO_URL:-https://github.com/droublibedel/SYMBIOLL.git}"
INSTALL_DIR="${INSTALL_DIR:-/var/www/symbioll.com}"
WEB_ROOT="${INSTALL_DIR}/symbioll"
DOMAIN="${DOMAIN:-symbioll.com}"
BRANCH="${BRANCH:-main}"

echo "==> Symbioll — installation sur ${DOMAIN}"
echo "==> Dépôt : ${REPO_URL}"
echo "==> Dossier : ${INSTALL_DIR}"

if ! command -v git >/dev/null; then
    apt-get update
    apt-get install -y git
fi

if [ -d "${INSTALL_DIR}/.git" ]; then
    echo "==> Dépôt déjà présent, mise à jour..."
    git -C "${INSTALL_DIR}" fetch origin
    git -C "${INSTALL_DIR}" checkout "${BRANCH}"
    git -C "${INSTALL_DIR}" pull origin "${BRANCH}"
else
    echo "==> Clone du dépôt..."
    mkdir -p "$(dirname "${INSTALL_DIR}")"
    git clone --branch "${BRANCH}" "${REPO_URL}" "${INSTALL_DIR}"
fi

echo "==> Configuration MySQL + config.php..."
bash "${INSTALL_DIR}/deploy/setup-vps.sh" "${DOMAIN}" "${WEB_ROOT}"

PHP_SOCK="$(ls /run/php/php*-fpm.sock 2>/dev/null | sort -V | tail -1)"
if [ -z "${PHP_SOCK}" ]; then
    echo "Erreur : aucun socket PHP-FPM trouvé dans /run/php/"
    exit 1
fi

echo "==> PHP-FPM détecté : ${PHP_SOCK}"

NGINX_CONF="/etc/nginx/sites-available/symbioll.com"
sed "s|unix:/run/php/php8.3-fpm.sock|unix:${PHP_SOCK}|" \
    "${INSTALL_DIR}/deploy/nginx.conf" > "${NGINX_CONF}"

if [ ! -L "/etc/nginx/sites-enabled/symbioll.com" ]; then
    ln -s "${NGINX_CONF}" /etc/nginx/sites-enabled/symbioll.com
fi

nginx -t
systemctl reload nginx

echo ""
echo "=== Installation terminée ==="
echo "Site      : http://${DOMAIN}"
echo "Web root  : ${WEB_ROOT}"
echo ""
echo "Prochaines étapes :"
echo "  1. DNS : A symbioll.com → 144.91.78.84"
echo "  2. HTTPS : certbot --nginx -d symbioll.com -d www.symbioll.com"
echo "  3. Admin : cd ${WEB_ROOT} && php scripts/create-admin.php admin@symbioll.com 'VotreMotDePasse'"
