#!/usr/bin/env bash
set -euo pipefail

ROOT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"

usage() {
	cat <<'EOF'
Usage:
	bin/process_rsync_images.sh --originals <user@host:/path/to/media-originals/posts/> --processed <user@host:/path/to/public/images/posts/> [--apply] [--skip-process]

Examples:
	bin/process_rsync_images.sh \
		--originals deploy@example.com:/var/www/blog/media-originals/posts/ \
		--processed deploy@example.com:/var/www/blog/public/images/posts/

	bin/process_rsync_images.sh \
		--originals deploy@example.com:/var/www/blog/media-originals/posts/ \
		--processed deploy@example.com:/var/www/blog/public/images/posts/ \
		--apply

Notes:
	- Dry-run by default. Add --apply to perform transfers.
	- Runs image processing first unless --skip-process is passed.
EOF
}

ORIGINALS_DEST=""
PROCESSED_DEST=""
APPLY="false"
SKIP_PROCESS="false"

while [[ $# -gt 0 ]]; do
	case "$1" in
		--originals)
			ORIGINALS_DEST="${2:-}"
			shift 2
			;;
		--processed)
			PROCESSED_DEST="${2:-}"
			shift 2
			;;
		--apply)
			APPLY="true"
			shift
			;;
		--skip-process)
			SKIP_PROCESS="true"
			shift
			;;
		-h|--help)
			usage
			exit 0
			;;
		*)
			echo "Unknown argument: $1" >&2
			usage
			exit 1
			;;
	esac
done

if [[ -z "$ORIGINALS_DEST" || -z "$PROCESSED_DEST" ]]; then
	usage
	exit 1
fi

if [[ "$SKIP_PROCESS" != "true" ]]; then
	php "$ROOT_DIR/bin/process_images.php"
fi

if [[ "$APPLY" == "true" ]]; then
	"$ROOT_DIR/bin/rsync_media_originals.sh" "$ORIGINALS_DEST" --apply
	"$ROOT_DIR/bin/rsync_processed_images.sh" "$PROCESSED_DEST" --apply
else
	"$ROOT_DIR/bin/rsync_media_originals.sh" "$ORIGINALS_DEST"
	"$ROOT_DIR/bin/rsync_processed_images.sh" "$PROCESSED_DEST"
fi
