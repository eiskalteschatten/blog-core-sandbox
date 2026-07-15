#!/usr/bin/env bash
set -euo pipefail

ROOT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"

usage() {
  cat <<'EOF'
Usage:
  bin/build_process.sh [build/process flags]

Examples:
  bin/build_process.sh
  bin/build_process.sh -v

Notes:
  - Runs build index first, then processes images.
  - Any flags are passed to both commands.
EOF
}

if [[ "${1:-}" == "-h" || "${1:-}" == "--help" ]]; then
  usage
  exit 0
fi

php "$ROOT_DIR/bin/build_index.php" "$@"
php "$ROOT_DIR/bin/process_images.php" "$@"
