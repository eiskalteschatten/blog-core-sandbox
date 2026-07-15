#!/usr/bin/env bash
set -euo pipefail

ROOT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
SRC_DIR="$ROOT_DIR/public/images/posts/"

usage() {
  cat <<'EOF'
Usage:
  bin/rsync_processed_images.sh <user@host:/absolute/path/to/public/images/posts/> [--apply]

Examples:
  bin/rsync_processed_images.sh deploy@example.com:/var/www/blog/public/images/posts/
  bin/rsync_processed_images.sh deploy@example.com:/var/www/blog/public/images/posts/ --apply

Notes:
  - Default mode is dry-run so you can verify changes first.
  - Pass --apply to execute the transfer.
  - This sync mirrors local -> remote and uses --delete.
EOF
}

if [[ $# -lt 1 || $# -gt 2 ]]; then
  usage
  exit 1
fi

DEST="$1"
APPLY="false"
if [[ ${2:-} == "--apply" ]]; then
  APPLY="true"
elif [[ $# -eq 2 ]]; then
  usage
  exit 1
fi

if [[ ! -d "$SRC_DIR" ]]; then
  echo "Source directory not found: $SRC_DIR" >&2
  exit 1
fi

RSYNC_ARGS=(
  -az
  --delete
  --human-readable
  --itemize-changes
)

if [[ "$APPLY" != "true" ]]; then
  RSYNC_ARGS+=(--dry-run)
  echo "Running in dry-run mode. Add --apply to perform the sync."
fi

echo "Syncing: $SRC_DIR -> $DEST"
rsync "${RSYNC_ARGS[@]}" "$SRC_DIR" "$DEST"

echo "Done."
