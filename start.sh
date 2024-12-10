#!/bin/bash

# Start Laravel's built-in PHP server (use the background option &)
php artisan serve --host=0.0.0.0 &

# Wait a little bit to make sure the server starts up
sleep 5

# Run npm run dev for the front-end
npm run dev &

# Keep the container running
tail -f /dev/null
