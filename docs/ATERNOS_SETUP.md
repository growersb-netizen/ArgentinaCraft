# ☁️ ArgentinaCraft — Configuración en Aternos

> Hosting gratuito para la Fase 1 del proyecto

---

## ¿Qué es Aternos?

Aternos es un servicio de hosting gratuito para servidores de Minecraft.  
**Límite gratuito:** ~1-2 GB RAM | Máx ~10-15 jugadores simultáneos  
**URL:** https://aternos.org

---

## Paso 1 — Crear Cuenta y Servidor

1. Ir a **https://aternos.org**
2. Registrarse con email
3. Hacer clic en **"Crear servidor"**
4. Seleccionar tipo: **Bedrock**
5. Seleccionar software: **PocketMine-MP** (versión más reciente estable)
6. Nombre del servidor: `ArgentinaCraft`

---

## Paso 2 — Subir Archivos del Proyecto

### Via Panel de Aternos → Archivos:

```
Subir al directorio raíz del servidor:
├── server.properties           ← Configuración Bedrock
├── pocketmine.yml              ← Configuración PM-MP
│
└── plugins/
    └── ArgentinaCraft_Core/    ← Plugin completo
        ├── plugin.yml
        ├── config.yml
        └── src/
            └── ArgentinaCraft/
                └── Core/
                    └── Main.php
```

### Pasos en el panel:
1. **Archivos** → Subir `pocketmine.yml`
2. **Plugins** → Subir carpeta `ArgentinaCraft_Core` (comprimir como .zip primero)
3. **Archivos** → Subir `server.properties`

---

## Paso 3 — Configurar server.properties para Aternos

```properties
server-name=ArgentinaCraft | Explorá Argentina 🇦🇷
gamemode=adventure
difficulty=peaceful
max-players=10
view-distance=8
```

---

## Paso 4 — Ajustar para Performance en Aternos

Aternos tiene **recursos limitados**. Aplicar estas optimizaciones:

### En `pocketmine.yml`:
```yaml
max-players: 10
view-distance: 6
max-chunk-radius: 6
auto-save-ticks: 12000
```

### En `plugins/ArgentinaCraft_Core/config.yml`:
```yaml
performance:
  max-entities-per-chunk: 5
  ticking-radius: 2
```

---

## Paso 5 — Iniciar el Servidor

1. En el panel de Aternos: hacer clic en **"Iniciar"**
2. Esperar hasta que el estado sea **"Online"** (puede tardar 2-5 minutos)
3. Copiar la **dirección IP** del servidor (aparece en el panel)

---

## Paso 6 — Conectar desde Minecraft Bedrock

1. Abrir Minecraft
2. **Jugar** → **Servidores** → **Agregar servidor**
3. Pegar la IP de Aternos y usar puerto `19132`
4. ¡Conectar!

---

## Limitaciones de Aternos (Gratis)

| Limitación | Impacto | Solución |
|-----------|---------|---------|
| Servidor se apaga si nadie conecta | Jugadores deben "despertarlo" | Normal en free tier |
| RAM limitada (~1 GB) | Máx ~10 jugadores fluidos | Optimizar config |
| Sin dominio propio | IP con números | Aceptable para MVP |
| Sin acceso root | No se puede ejecutar scripts externos | Usar solo plugins |

---

## Mantener el Servidor Activo

Aternos apaga el servidor si no hay jugadores por ~5 minutos.

**Truco para el equipo de desarrollo:**
- Usar la extensión de Chrome "Aternos Auto-Start" durante pruebas
- Configurar un webhook de Discord para notificar cuando el servidor necesita ser iniciado

---

## Plan de Upgrade (Fase 2)

Cuando se supere la capacidad de Aternos:
→ Migrar a **Oracle Cloud Free Tier** (ver [ORACLE_DEPLOYMENT.md](ORACLE_DEPLOYMENT.md))

---

*Ver también: [INSTALLATION.md](INSTALLATION.md) | [MOBILE_CONNECTION_GUIDE.md](MOBILE_CONNECTION_GUIDE.md)*
