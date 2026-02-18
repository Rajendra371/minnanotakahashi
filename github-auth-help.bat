@echo off
echo GitHub Authentication Required
echo ================================
echo.
echo You need to authenticate with GitHub. Choose one option:
echo.
echo OPTION 1: Use Personal Access Token (Recommended)
echo 1. Go to https://github.com/settings/tokens
echo 2. Click "Generate new token" -^> "Generate new token (classic)"
echo 3. Give it a name like "Takahashi Project"
echo 4. Select scopes: repo (full control)
echo 5. Click "Generate token"
echo 6. Copy the token
echo 7. Run: git push -u origin main
echo 8. Username: Rajendra371
echo 9. Password: [paste your token]
echo.
echo OPTION 2: Use GitHub CLI
echo 1. Install GitHub CLI from https://cli.github.com/
echo 2. Run: gh auth login
echo 3. Follow the prompts
echo 4. Then run: git push -u origin main
echo.
echo OPTION 3: Use SSH (Advanced)
echo 1. Generate SSH key: ssh-keygen -t ed25519 -C "your-email@example.com"
echo 2. Add to GitHub: https://github.com/settings/keys
echo 3. Change remote: git remote set-url origin git@github.com:Rajendra371/minnanotakahashi.git
echo 4. Push: git push -u origin main
echo.
echo After authentication, your project will sync automatically!
echo.
pause