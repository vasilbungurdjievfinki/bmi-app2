#!/bin/sh
set -e

response=$(curl -s -X POST http://localhost:8081 \
  -H "Content-Type: application/json" \
  -d '{"units":"metric","weight":"70","height":"175","age":"23","gender":"f"}')

echo "$response"

echo "$response" | grep '"category"'
echo "$response" | grep '"bmi"'