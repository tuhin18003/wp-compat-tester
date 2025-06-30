#!/bin/bash

# Usage:
# bash git-push.sh --m "commit message" --release "1.0.0"

while [[ "$#" -gt 0 ]]; do
    case $1 in
        --m) commit_msg="$2"; shift ;;
        --release) version="$2"; shift ;;
        *) echo "Unknown parameter passed: $1"; exit 1 ;;
    esac
    shift
done

if [ -z "$commit_msg" ]; then
    echo "❌ Commit message (--m) is required."
    exit 1
fi

echo "📦 Committing with message: $commit_msg"
git add .
git commit -m "$commit_msg"
git push

if [ -n "$version" ]; then
    echo "🏷️  Tagging release: v$version"
    git tag -a "v$version" -m "Release v$version"
    git push origin "v$version"
    echo "✅ Tag pushed. If Packagist is set up, it will now auto-update."
else
    echo "✅ Code pushed. No version tag added."
fi
