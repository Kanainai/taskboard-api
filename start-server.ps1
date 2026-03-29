# Task Manager API - Start Server Script
Write-Host "Starting Task Manager API..." -ForegroundColor Green

# Refresh PATH environment variable
$env:Path = [System.Environment]::GetEnvironmentVariable("Path","Machine") + ";" + [System.Environment]::GetEnvironmentVariable("Path","User")

# Check PHP
Write-Host "Checking PHP..." -ForegroundColor Yellow
php --version

# Start Laravel server
Write-Host "`nStarting Laravel server on http://localhost:8000..." -ForegroundColor Green
php artisan serve
