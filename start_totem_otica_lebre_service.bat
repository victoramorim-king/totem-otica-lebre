@echo off
:: start /min "" "C:\xampp\apache_start.bat" >nul 2>&1
start /min "" "C:\xampp\mysql_start.bat" >nul 2>&1
start /min "" "C:\xampp\php\php.exe" artisan serve >nul 2>&1
start /min "" "C:\Program Files\Google\Chrome\Application\chrome.exe" --kiosk http://localhost:8000

:: Coletar o PID do processo PHP e salvar no arquivo php.pid
tasklist /fi "imagename eq php.exe" /fo csv > php_pids.csv
for /f "tokens=2 delims=," %%a in (php_pids.csv) do (
    echo %%~a > php.pid
)
del php_pids.csv

exit
