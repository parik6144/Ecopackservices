# EcoPack Services Repository Setup Script
Write-Host "Setting up EcoPack Services Repository..." -ForegroundColor Green

# Set Git configuration
Write-Host "Setting Git configuration..." -ForegroundColor Yellow
git config --global user.name "ecopackservices"
git config --global user.email "ecopackservices@example.com"

# Initialize Git repository
Write-Host "Initializing Git repository..." -ForegroundColor Yellow
git init

# Add remote origin
Write-Host "Adding remote origin..." -ForegroundColor Yellow
git remote add origin https://github.com/parik6144/Ecopackservices.git

# Add all files
Write-Host "Adding all files to Git..." -ForegroundColor Yellow
git add .

# Create initial commit
Write-Host "Creating initial commit..." -ForegroundColor Yellow
git commit -m "Initial commit: EcoPack Services Project"

# Set main branch
Write-Host "Setting main branch..." -ForegroundColor Yellow
git branch -M main

# Push to GitHub
Write-Host "Pushing to GitHub..." -ForegroundColor Yellow
git push -u origin main

Write-Host "Repository setup completed!" -ForegroundColor Green
Write-Host "Your code is now available at: https://github.com/parik6144/Ecopackservices.git" -ForegroundColor Cyan
