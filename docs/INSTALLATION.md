# 📦 ArgentinaCraft — Guía de Instalación

> **Versión:** 1.0.0 MVP | **Plataforma:** Minecraft Bedrock Edition

---

## Requisitos del Sistema

| Componente | Mínimo | Recomendado |
|-----------|--------|-------------|
| RAM | 512 MB | 1 GB |
| CPU | 1 núcleo | 2 núcleos |
| Disco | 1 GB | 5 GB |
| Java | No requerido | — |
| PHP | 8.1+ | 8.2+ |
| OS | Linux/Windows | Ubuntu 22.04 LTS |

---

## Paso 1 — Descargar PocketMine-MP

### Opción A: Instalador Automático (Linux/Mac)
```bash
curl -sL https://get.pmmp.io | bash -s -
```

### Opción B: Descarga Manual
1. Ir a: https://github.com/pmmp/PocketMine-MP/releases
2. Descargar `PocketMine-MP.phar` (última versión estable)
3. Descargar `start.sh` o `start.cmd`

---

## Paso 2 — Estructura de Archivos

Colocar los archivos así:
```
ArgentinaCraft/
├── server/
│   ├── PocketMine-MP.phar      ← Archivo del servidor
│   ├── start.sh                ← Script de inicio (Linux)
│   ├── start.cmd               ← Script de inicio (Windows)
│   ├── pocketmine.yml          ← Configuración principal
│   └── server.properties       ← Propiedades del servidor
├── plugins/
│   └── ArgentinaCraft_Core/    ← Plugin principal
├── worlds/                     ← Mundos del servidor
└── ...
```

---

## Paso 3 — Instalar el Plugin Principal

1. Copiar la carpeta `plugins/ArgentinaCraft_Core/` al directorio `plugins/` del servidor
2. El plugin se cargará automáticamente al iniciar

---

## Paso 4 — Configurar los Mundos

Los mundos se generan automáticamente al primer inicio. Para mundos custom:

```bash
# Copiar mundos pre-generados
cp -r worlds/hub    /servidor/worlds/hub
cp -r worlds/buenos_aires /servidor/worlds/buenos_aires
# ... etc
```

---

## Paso 5 — Primer Inicio

### Windows:
```cmd
cd ArgentinaCraft\server
start.cmd
```

### Linux:
```bash
cd ArgentinaCraft/server
chmod +x start.sh
./start.sh
```

---

## Paso 6 — Verificación

Cuando el servidor esté corriendo deberías ver:
```
[INFO] ArgentinaCraft Core v1.0.0
[INFO] Provincias cargadas: 4
[INFO] Landmarks cargados: 4
[INFO] ¡Bienvenido a ArgentinaCraft!
[INFO] Done (X.Xs)! For help, type "help"
```

---

## Conexión desde Minecraft Bedrock

1. Abrir Minecraft Bedrock Edition
2. Ir a **Jugar** → **Servidores** → **Añadir Servidor**
3. Ingresar:
   - **Nombre:** ArgentinaCraft
   - **Dirección:** `tu_ip_aqui`
   - **Puerto:** `19132`
4. Conectar

---

## Solución de Problemas Comunes

### Error: "Failed to load plugin"
- Verificar que PHP 8.1+ esté instalado
- Verificar estructura de carpetas del plugin

### Error: "World not found"
- Verificar que los mundos estén en la carpeta `/worlds/`
- Usar `/mkworld <nombre>` en la consola del servidor

### Jugadores no pueden conectar
- Verificar que el puerto 19132 UDP esté abierto en el firewall
- Verificar la IP del servidor

---

*Ver también: [SERVER_SETUP.md](SERVER_SETUP.md) | [ATERNOS_SETUP.md](ATERNOS_SETUP.md)*
