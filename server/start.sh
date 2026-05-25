#!/bin/bash
# =============================================================
# ArgentinaCraft — Script de Inicio (Linux/Mac)
# =============================================================

PHP_BINARY=${PHP_BINARY:-"php"}
POCKETMINE="PocketMine-MP.phar"

echo ""
echo "  =========================================="
echo "   ArgentinaCraft - Servidor Bedrock"
echo "   ¡Explorá Argentina en Minecraft!"
echo "  =========================================="
echo ""

# Verificar PHP
if ! command -v $PHP_BINARY &> /dev/null; then
    echo "[ERROR] PHP no encontrado. Instalar con:"
    echo "        sudo apt install php8.2-cli php8.2-mbstring php8.2-gmp"
    exit 1
fi

# Verificar PocketMine
if [ ! -f "$POCKETMINE" ]; then
    echo "[ERROR] $POCKETMINE no encontrado."
    echo "        Descargar: wget https://github.com/pmmp/PocketMine-MP/releases/latest/download/PocketMine-MP.phar"
    exit 1
fi

echo "[INFO] PHP version: $($PHP_BINARY -r 'echo PHP_VERSION;')"
echo "[INFO] Iniciando servidor ArgentinaCraft..."
echo ""

# Iniciar servidor
$PHP_BINARY -dphar.readonly=0 \
            -dmemory_limit=512M \
            -dopcache.enable=1 \
            -dopcache.jit_buffer_size=64M \
            $POCKETMINE --no-wizard

echo ""
echo "[INFO] Servidor ArgentinaCraft detenido."
