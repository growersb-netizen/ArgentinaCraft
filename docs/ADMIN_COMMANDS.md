# ⚙️ ArgentinaCraft — Comandos de Administrador

---

## Comandos del Plugin ArgentinaCraft

| Comando | Descripción | Permiso |
|---------|-------------|---------|
| `/hub` | Teletransporte al HUB | Todos |
| `/provincia <nombre>` | Ir a una provincia | Todos |
| `/landmark <nombre>` | Ir a un landmark | Todos |
| `/pasaporte` | Ver pasaporte propio | Todos |
| `/monedas` | Ver monedas turísticas | Todos |
| `/logros` | Ver logros | Todos |
| `/acinfo` | Info del servidor | Todos |

---

## Comandos PocketMine (OP requerido)

### Gestión de Jugadores
```
/op <jugador>                   Dar permisos de operador
/deop <jugador>                 Quitar permisos de operador
/kick <jugador> [razón]         Expulsar jugador
/ban <jugador> [razón]          Banear jugador
/ban-ip <ip> [razón]           Banear IP
/pardon <jugador>               Desbanear jugador
/pardon-ip <ip>                 Desbanear IP
/banlist                        Ver lista de baneados
/whitelist add <jugador>        Agregar a whitelist
/whitelist remove <jugador>     Quitar de whitelist
/whitelist on|off               Activar/desactivar whitelist
```

### Teletransporte
```
/tp <jugador> <x> <y> <z>       Teleport a coordenadas
/tp <jugador1> <jugador2>       Teleport jugador a jugador
/tphere <jugador>               Traer jugador a tu posición
/spawn                          Ir al spawn del mundo
```

### Gestión de Mundos
```
/world <nombre>                 Ir a un mundo
/mkworld <nombre>               Crear nuevo mundo
/worlds                         Listar mundos cargados
/save-all                       Guardar todos los mundos
```

### Gestión del Servidor
```
/stop                           Detener el servidor
/restart                        Reiniciar el servidor
/reload                         Recargar plugins
/plugins                        Listar plugins cargados
/status                         Ver estado del servidor
/gc                             Ejecutar recolector de basura
/timings on|off|paste           Analizar performance
```

### Gamemode y Efectos
```
/gamemode survival <jugador>    Modo Supervivencia
/gamemode creative <jugador>    Modo Creativo
/gamemode adventure <jugador>   Modo Aventura
/gamemode spectator <jugador>   Modo Espectador
/effect <jugador> <efecto>      Dar efecto
/kill <jugador>                 Matar jugador
/clear <jugador>                Limpiar inventario
```

### Items y Inventario
```
/give <jugador> <item> [cantidad]   Dar item
/xp <cantidad> <jugador>           Dar experiencia
/enchant <encantamiento> [nivel]   Encantar item en mano
```

### Clima y Tiempo
```
/weather clear|rain|thunder     Cambiar clima
/time set <valor>               Cambiar hora (0=amanecer, 6000=mediodía)
/time add <valor>               Avanzar tiempo
```

---

## Comandos de Construcción del HUB

Para construir el HUB manualmente (modo creativo):

```bash
# Dar modo creativo al admin
/gamemode creative TuNombre

# Crear región del HUB plana (si no existe)
/fill -64 63 -64 64 63 64 grass_block

# Proteger spawn
/spawnprotect 32

# Ir al mundo hub
/world hub
```

---

## Configuración de Permisos (Grupos)

Usando plugin de permisos (LuckPerms o similar):
```
# Grupo jugador estándar
/lp group default permission set argentinacraft.teleport.hub true
/lp group default permission set argentinacraft.passport true
/lp group default permission set argentinacraft.economy true

# Grupo admin
/lp group admin permission set argentinacraft.admin true
/lp group admin parent add default
```

---

## Panel de Monitoreo

### Ver TPS en tiempo real:
```
/tps
```

### Ver jugadores online:
```
/list
```

### Ver info del sistema:
```
/status
```

---

*Ver también: [SERVER_SETUP.md](SERVER_SETUP.md) | [PERFORMANCE_OPTIMIZATION.md](PERFORMANCE_OPTIMIZATION.md)*
