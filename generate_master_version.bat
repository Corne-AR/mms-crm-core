@echo off
REM ==================================================================================
REM MMS CRM - GENERATE MASTER VERSION SNAPSHOT
REM
REM Runs build_master_v4.py to create master_version_vX.txt
REM This is your "full stocktake" snapshot for project archiving & review.
REM
REM Usage: just double-click this .bat
REM ==================================================================================

cd /d C:\xampp\htdocs\mms-crm-core

echo.
echo 🚀 Running build_master_v4.py ...
echo.

python build_master_v4.py

echo.
echo ✅ DONE! Check: master_version_vX.txt
echo.
pause
