@echo off
echo 🚀 Vérification des dépendances Laravel + Vite...

REM Vérifier Composer
where composer >nul 2>nul
IF ERRORLEVEL 1 (
    echo ❌ Composer n'est pas installé ou pas dans le PATH.
    pause
    exit /b
)

REM Vérifier Node.js
where node >nul 2>nul
IF ERRORLEVEL 1 (
    echo ❌ Node.js n'est pas installé ou pas dans le PATH.
    pause
    exit /b
)

REM Vérifier npm
where npm >nul 2>nul
IF ERRORLEVEL 1 (
    echo ❌ npm n'est pas installé ou pas dans le PATH.
    pause
    exit /b
)

REM Vérifier les dépendances PHP
IF NOT EXIST "vendor" (
    echo 📦 Installation des dépendances PHP...
    composer install
)

REM Vérifier les dépendances Node
IF NOT EXIST "node_modules" (
    echo 📦 Installation des dépendances Node...
    npm install
)

echo ✅ Tout est prêt, lancement des serveurs...

REM Ouvrir Laravel
start cmd /k "php artisan serve"

REM Ouvrir Vite
start cmd /k "npm run dev"

echo 🚀 Les serveurs Laravel et Vite sont lancés !
pause
