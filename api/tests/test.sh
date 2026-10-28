#!/bin/sh
set -eu

response=$(curl --fail --silent --show-error \
  -X POST http://localhost:8091 \
  -H "Content-Type: application/json" \
  -d '{"units":"metric","weight":"70","height":"175","age":"23","gender":"f"}')

echo "$response"

echo "$response" | grep -q '"bmi":"22.86"'
echo "$response" | grep -q '"category":"Normal"'

echo "API test passed successfully!"