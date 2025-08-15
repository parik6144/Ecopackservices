@echo off
echo Installing Git for Windows...
echo Please wait while Git is being installed...
"%TEMP%\GitInstaller.exe" /VERYSILENT /NORESTART /CLOSEAPPLICATIONS
echo.
echo Git installation completed!
echo.
echo Setting up repository...
echo.
powershell -ExecutionPolicy Bypass -File "setup_repository.ps1"
echo.
echo Setup completed! Press any key to exit.
pause
