@echo off
:: =============================================================
:: ArgentinaCraft — Script de Inicio (Windows)
:: =============================================================

title ArgentinaCraft Server

echo.
echo  ==========================================
echo   ArgentinaCraft - Servidor Bedrock
echo   Explorá Argentina en Minecraft!
echo  ==========================================
echo.

:: Verificar si PHP está instalado
where php >nul 2>nul
if %ERRORLEVEL% NEQ 0 (
    echo [ERROR] PHP no encontrado. Instala PHP 8.2+ antes de continuar.
    echo         Descargar en: https://windows.php.net/download/
    pause
    exit /b 1
)

:: Verificar si el archivo del servidor existe
if not exist "PocketMine-MP.phar" (
    echo [ERROR] PocketMine-MP.phar no encontrado.
    echo         Descargar en: https://github.com/pmmp/PocketMine-MP/releases
    pause
    exit /b 1
)

echo [INFO] Iniciando ArgentinaCraft...
echo [INFO] Para detener el servidor, escribir: stop
echo.

:: Iniciar el servidor con configuración optimizada
php -c php.ini PocketMine-MP.phar --no-wizard

echo.
echo [INFO] Servidor detenido.
pause
