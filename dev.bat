@echo off
set "PATH=C:\Users\LENOVO\.config\herd-lite\bin;%PATH%"
cd /d "%~dp0pocketledger"
echo [PocketLedger] Starting development server with PHP 8.4...
composer run dev

