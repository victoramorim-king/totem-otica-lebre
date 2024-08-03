Start-Process -FilePath "C:\xampp\apache_start.bat" -WindowStyle Hidden
Start-Process -FilePath "C:\xampp\mysql_start.bat" -WindowStyle Hidden
Start-Process -FilePath "C:\xampp\php\php.exe" -ArgumentList "artisan serve" -WorkingDirectory "C:\Users\supor\Projects\risetec\totem-otica-lebre" -WindowStyle Hidden
Start-Process -FilePath "C:\Program Files\Google\Chrome\Application\chrome.exe" -ArgumentList "--kiosk http://localhost:8000" -WindowStyle Hidden
