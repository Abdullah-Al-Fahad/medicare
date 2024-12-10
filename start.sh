#!/bin/bash

# Start Apache in the background
apache2-foreground &

# Run npm run dev after Apache starts
npm run dev
