#!/usr/bin/env bash
set -euo pipefail

repo_root="$(git rev-parse --show-toplevel 2>/dev/null || true)"

if [[ -z "$repo_root" ]]; then
  echo "Error: not inside a git repository." >&2
  exit 1
fi

cd "$repo_root"

changed_files=()
while IFS= read -r line; do
  [[ -n "$line" ]] && changed_files+=("$line")
done < <(
  {
    git diff --name-only -- ':(glob)posts/**/comments.json'
    git diff --cached --name-only -- ':(glob)posts/**/comments.json'
    git ls-files --others --exclude-standard -- 'posts/**/comments.json'
  } | sort -u
)

if [[ ${#changed_files[@]} -eq 0 ]]; then
  echo "No comment snapshot changes found under posts/**/comments.json"
  exit 0
fi

echo "Comment files to snapshot:"
for f in "${changed_files[@]}"; do
  echo "  - $f"
done

echo
echo "Diff summary:"
git --no-pager diff --stat -- "${changed_files[@]}" || true

echo
read -r -p "Create commit with only these files? [y/N] " confirm

if [[ "${confirm:-}" != "y" && "${confirm:-}" != "Y" ]]; then
  echo "Aborted. No commit created."
  exit 0
fi

commit_message="${1:-comments snapshot $(date '+%Y-%m-%d %H:%M:%S %Z')}"

git add -- "${changed_files[@]}"

if git diff --cached --quiet -- "${changed_files[@]}"; then
  echo "Nothing staged for selected comment files."
  exit 0
fi

git commit -m "$commit_message" -- "${changed_files[@]}"
echo "Snapshot commit created."
