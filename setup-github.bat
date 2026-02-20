@echo off
echo Setting up Git repository for Takahashi project...
echo.

REM Check if git is installed
git --version >nul 2>&1
if errorlevel 1 (
    echo Git is not installed or not in PATH
    pause
    exit /b 1
)

echo Current Git configuration:
git config user.name
git config user.email
echo.

echo Please follow these steps:
echo.
echo 1. Go to https://github.com/Rajendra371
echo 2. Click "New repository" button
echo 3. Repository name: takahashi
echo 4. Description: Laravel Japanese Language Institute Website
echo 5. Make it Public or Private (your choice)
echo 6. DO NOT initialize with README, .gitignore, or license
echo 7. Click "Create repository"
echo.
echo After creating the repository, press any key to continue...
pause >nul

echo.
echo Pushing to GitHub...
git push -u origin main

if errorlevel 1 (
    echo.
    echo Push failed. Please check:
    echo - Repository exists on GitHub
    echo - You have proper access rights
    echo - Your GitHub credentials are correct
    echo.
    echo You may need to authenticate with GitHub.
    echo Try: git push -u origin main
) else (
    echo.
    echo Success! Your project is now on GitHub.
    echo Repository URL: https://github.com/Rajendra371/takahashi
)

echo.
pause