@echo off

if exist php.pid (
    set /p PHP_PID=<php.pid
    taskkill /pid %PHP_PID% /f >nul 2>&1
    del php.pid
)

taskkill /im httpd.exe /f >nul 2>&1
taskkill /im mysqld.exe /f >nul 2>&1



:: Fechar o Chrome iniciado pelo script anterior
taskkill /fi "imagename eq chrome.exe" /f >nul 2>&1

echo "Apache, MySQL, Laravel e Chrome foram encerrados."
exit
