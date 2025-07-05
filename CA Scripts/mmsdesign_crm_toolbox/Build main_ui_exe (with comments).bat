REM Build-EXE_with_icon.bat
REM --------------------------------------------
REM Converts main_ui.py into a standalone GUI EXE
REM and embeds the MMS‑CRM favicon as the app icon.
REM Requires:  (1) Python in PATH  (2) PyInstaller →  pip install pyinstaller

@echo off
REM Disable command echoing for a tidy output

REM ── Change to the folder where this BAT lives ──
cd /d %~dp0

REM ── Path to icon (relative to project root) ──
set "ICON_PATH="C:\xampp\htdocs\mms-crm-core\public\favicon.ico"

if not exist "%ICON_PATH%" (
    echo Icon file not found at:
    echo   %ICON_PATH%
    echo.
    echo Build aborted.
    pause
    exit /b 1
)

REM ── Clean previous build artefacts ──
if exist dist        rmdir /s /q dist
if exist build       rmdir /s /q build
if exist main_ui.spec del   main_ui.spec

REM ── Build the EXE ──
REM --noconsole : hide console window
REM --onefile   : bundle everything into one EXE
REM --icon      : embed custom icon
pyinstaller --noconsole --onefile --icon="%ICON_PATH%" main_ui.py
if errorlevel 1 (
    echo PyInstaller reported an error. Build failed.
    pause
    exit /b 1
)

REM ── Move the finished EXE to project root ──
if exist dist\main_ui.exe move /Y dist\main_ui.exe . > nul

REM ── Success message ──
echo.
echo EXE built successfully: main_ui.exe
pause
