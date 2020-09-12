#!/bin/bash

docker exec api composer run post-root-package-install
docker exec api php artisan key:generate
docker exec api php artisan jwt:secret
docker exec api php artisan migrate:fresh --seed
