#!/usr/bin/env bash
set -euo pipefail

# Lance l'installation à distance via SSH (clone git sur le VPS)
#
# Usage :
#   bash deploy/deploy.sh

REMOTE="${REMOTE:-root@144.91.78.84}"
INSTALL_DIR="/var/www/symbioll.com"
REPO_URL="https://github.com/droublibedel/SYMBIOLL.git"

echo "==> Installation Symbioll sur ${REMOTE}"

ssh "${REMOTE}" "bash -s" <<EOF
set -euo pipefail

if [ ! -d "${INSTALL_DIR}/.git" ]; then
    apt-get update -qq
    apt-get install -y -qq git
    git clone ${REPO_URL} ${INSTALL_DIR}
fi

bash ${INSTALL_DIR}/deploy/install-server.sh
EOF

echo "==> Déploiement terminé : https://symbioll.com"
