@echo off
echo Downloading Git for Windows...
powershell -Command "Invoke-WebRequest -Uri 'https://github.com/git-for-windows/git/releases/download/v2.44.0.windows.1/Git-2.44.0-64-bit.exe' -OutFile '%TEMP%\GitInstaller.exe'"
echo Installing Git...
"%TEMP%\GitInstaller.exe" /VERYSILENT /NORESTART
echo Git installation completed!
echo Please restart your terminal and run the git commands.
pause
