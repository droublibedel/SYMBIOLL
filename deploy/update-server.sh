#!/usr/bin/env bash
set -euo pipefail

# Met à jour le site après un git push (à lancer sur le VPS en root)
#
# Usage :
#   bash /var/www/symbioll.com/deploy/update-server.sh

INSTALL_DIR="${INSTALL_DIR:-/var/www/symbioll.com}"
WEB_ROOT="${INSTALL_DIR}/symbioll"
BRANCH="${BRANCH:-main}"

echo "==> Mise à jour Symbioll..."

git -C "${INSTALL_DIR}" fetch origin
git -C "${INSTALL_DIR}" checkout "${BRANCH}"
git -C "${INSTALL_DIR}" pull origin "${BRANCH}"

chown -R www-data:www-data "${WEB_ROOT}"
chmod 640 "${WEB_ROOT}/config.php" 2>/dev/null || true

nginx -t
systemctl reload nginx

echo "==> Mise à jour terminée."
