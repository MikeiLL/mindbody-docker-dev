#!/bin/bash
docker-compose -f docker-compose.phpunit.yml down --remove-orphans
docker image prune -af
docker-compose -f docker-compose.phpunit.yml up -d
