$env:Path = "C:\Users\LENOVO\.config\herd-lite\bin;" + $env:Path
Write-Host "[PocketLedger] Starting development server with PHP 8.4..." -ForegroundColor Green
composer run dev

