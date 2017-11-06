#!/usr/bin/env bash
set -e

mkdir -p var/cache var/logs
chmod 777 -R var/cache var/logs

exec "apache2-foreground"
