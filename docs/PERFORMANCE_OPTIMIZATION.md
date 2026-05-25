# ⚡ ArgentinaCraft — Guía de Optimización de Performance

---

## Métricas Objetivo

| Métrica | Objetivo | Crítico |
|---------|----------|---------|
| TPS | 18-20 | <15 |
| RAM usada | <512 MB | >900 MB |
| Ping jugadores | <150ms | >500ms |
| Chunks cargados | <200 | >400 |

---

## Configuración del Servidor

### `pocketmine.yml` — Settings optimizados:

```yaml
# Menor view distance = menos chunks = menos RAM
view-distance: 8           # Máximo recomendado
max-chunk-radius: 8

# Guardar menos frecuentemente
auto-save-ticks: 6000      # 5 minutos (default: 900 ticks = 45s)

# Network compression
network:
  compression-threshold: 256
  async-compression: true
```

---

## Optimizaciones de Construcción

### ❌ Evitar (causa lag):
- Redstone complex (relojes, piston contraptions)
- Más de 50 entidades en un chunk
- Fuego propagante
- TNT encadenada
- Spawners de mobs
- Agua/lava fluyendo constantemente
- Árboles enormes de follaje pesado

### ✅ Usar (óptimo para mobile):
- Construcciones sólidas (sin caves innecesarias)
- Iluminación con antorchas o lámparas de piedra de luz
- NPCs estáticos (sin pathfinding)
- Decoración con bloques simples
- Portales pequeños (4x5 bloques)
- Árboles con forma compacta

---

## Optimización del HUB

El HUB es el área con más tráfico. Reglas especiales:

1. **Máximo 20 NPCs** en toda el área del HUB
2. **No usar animales** decorativos (usar armorstand con heads)
3. **Límite de 500 bloques** de radio activo
4. **Fountain effect** → usar particle effects con timer, no entidades
5. **No usar redstone** para iluminación automática
6. **Chunkloading estático** solo en spawn point (-1,0 a 1,0 en chunks)

---

## Optimización de Mundos de Provincias

Cada provincia debe:
- Tener spawn en un área plana/limpia
- Mantener los builds dentro de 300 bloques del spawn
- Usar `difficulty: peaceful` (sin spawning de mobs)
- Tener `mob-spawning: false` en la config

---

## Monitoreo en Tiempo Real

### Comandos de diagnóstico:
```bash
# En la consola del servidor:
timings on              # Iniciar análisis
# (esperar 1-2 minutos)
timings paste           # Subir reporte a timings.pmmp.io
timings off             # Detener análisis

gc                      # Limpiar memoria manual
status                  # Ver estado general
```

### Interpretación de Timings:
- **Full Server Tick > 50ms** → Hay lag real
- **Chunk Generation** alto → Mucha generación de terreno (normal al inicio)
- **Entity Tick** alto → Demasiadas entidades ticking
- **Plugin handlers** alto → Un plugin está dando problemas

---

## Configuración PHP para Performance

### `php.ini` optimizado:
```ini
; Memoria
memory_limit=512M

; OPcache (compilar PHP en caché)
opcache.enable=1
opcache.memory_consumption=128
opcache.jit=1255
opcache.jit_buffer_size=64M

; Deshabilitar assertions en producción
zend.assertions=-1

; Timezone Argentina
date.timezone=America/Argentina/Buenos_Aires
```

---

## Optimización para Jugadores Mobile

### Configurar el servidor para mobile:
```yaml
# En pocketmine.yml
network:
  compression-threshold: 128    # Comprimir más datos para mobile
```

### Recomendación al jugador:
Enviar al chat cuando se unan:
```
§7💡 TIP: Si el juego va lento, bajá la distancia de renderizado 
a 6 chunks en Configuración → Video
```

---

## Señales de Alerta

### 🔴 Crítico — Actuar inmediatamente:
- TPS < 12 por más de 1 minuto
- RAM > 90% del límite
- Jugadores reportan desconexión masiva

### 🟡 Advertencia — Monitorear:
- TPS 12-16 intermitente
- RAM > 70%
- Lag spikes ocasionales

### 🟢 Normal:
- TPS 18-20
- RAM 40-60%
- Sin quejas de jugadores

---

*Ver también: [SERVER_SETUP.md](SERVER_SETUP.md) | [BACKUP_SYSTEM.md](BACKUP_SYSTEM.md)*
