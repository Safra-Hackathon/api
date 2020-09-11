#!/bin/bash

docker exec api composer run post-root-package-install && \
php artisan key:generate && \
php artisan jwt:secret && \
php artisan migrate:fresh --seed
