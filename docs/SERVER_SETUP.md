# 🖥️ ArgentinaCraft — Configuración del Servidor

---

## Configuración Básica (`pocketmine.yml`)

### Ajustes Recomendados para el MVP:

```yaml
# Número de jugadores simultáneos
max-players: 20

# Dificultad: 0=Pacífico (recomendado para turismo)
difficulty: 0

# Modo de juego: 2=Aventura (no pueden romper bloques)
gamemode: 2
force-gamemode: true

# Zona de spawn protegida (radio en bloques)
spawn-protection: 32

# View distance (menor = mejor performance)
view-distance: 8
```

---

## Configuración de Mundos

### Orden de Carga de Mundos

El servidor carga el mundo `hub` como mundo principal. Los demás mundos
se cargan cuando un jugador los visita por primera vez.

### Spawns de Provincia

Cada provincia tiene su propio mundo. Los spawns se configuran en:
`teleport_system/teleport_config.json`

---

## Performance para Hosting Gratuito (Aternos/Oracle Free)

### Configuraciones críticas para bajo RAM:

```yaml
# pocketmine.yml
max-players: 10          # Reducir en hosting gratuito
view-distance: 6         # Menos chunks = menos RAM
auto-save-ticks: 12000  # Guardar cada 10 minutos

# Limitar uso de recursos
network:
  compression-threshold: 512
  async-compression: true
```

### Optimizaciones Adicionales:

1. **No usar redstone** en construcciones del HUB
2. **Limitar NPCs** a máximo 20 por mundo
3. **No usar spawners** de mobs
4. **Usar modo flat** para el HUB (menos cálculos de terreno)

---

## Scripts de Inicio

### start.sh (Linux — Recomendado)
```bash
#!/bin/bash
# ArgentinaCraft — Script de inicio optimizado

PHP_BINARY="php"
POCKETMINE="PocketMine-MP.phar"

# Configuración de memoria
PHP_MEMORY="-c php.ini"

echo "==================================="
echo "  ArgentinaCraft — Iniciando..."
echo "==================================="

$PHP_BINARY $PHP_MEMORY $POCKETMINE --no-wizard
```

### php.ini (Optimizado para bajo RAM)
```ini
; ArgentinaCraft PHP Config
memory_limit=256M
phar.readonly=0
zend.assertions=-1
opcache.enable=1
opcache.memory_consumption=64
opcache.jit_buffer_size=32M
```

---

## Comandos de Administración

```
/op <jugador>               — Dar permisos de operador
/deop <jugador>             — Quitar permisos
/kick <jugador> [razón]     — Expulsar jugador
/ban <jugador>              — Banear jugador
/pardon <jugador>           — Desbanear
/whitelist add <jugador>    — Agregar a whitelist
/save-all                   — Guardar todos los mundos
/stop                       — Detener el servidor
/tp <jugador> <x> <y> <z>  — Teletransportar
/gamemode <modo> <jugador>  — Cambiar modo de juego
```

---

## Monitoreo del Servidor

### Ver TPS (Ticks por Segundo):
```
/tps
```
> ✅ 20 TPS = Perfecto  
> ⚠️ 15-19 TPS = Aceptable  
> ❌ <15 TPS = Lag — investigar causas

### Ver uso de memoria:
```
/gc
```

---

*Ver también: [ATERNOS_SETUP.md](ATERNOS_SETUP.md) | [PERFORMANCE_OPTIMIZATION.md](PERFORMANCE_OPTIMIZATION.md)*
