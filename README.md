# 🇦🇷 ArgentinaCraft

> **Explorá Argentina en Minecraft Bedrock Edition**

Un servidor Minecraft Bedrock multiplayer que recrea Argentina como una experiencia interactiva de turismo y exploración. Visitá provincias, descubrí landmarks históricos, completá misiones y coleccioná sellos en tu pasaporte de explorador.

---

## 🎮 ¿Qué es ArgentinaCraft?

ArgentinaCraft es un servidor de turismo virtual donde los jugadores pueden:

- 🗺️ **Explorar** 4 provincias argentinas (y más en el futuro)
- 🏛️ **Visitar** landmarks famosos como el Obelisco, Caminito, La Bombonera y las Cataratas del Iguazú
- 📖 **Coleccionar** sellos en su Pasaporte Argentino
- 🎯 **Completar** misiones de exploración y turismo
- 🪙 **Ganar** Monedas Turísticas
- 🏆 **Desbloquear** logros y rangos de explorador
- 🗣️ **Aprender** historia y cultura argentina a través de NPCs

---

## 🗺️ Provincias Disponibles (v1.0)

| Provincia | Landmarks | Estado |
|-----------|-----------|--------|
| 🏙️ Buenos Aires | Obelisco, Caminito, La Bombonera | ✅ Lista |
| 🏔️ Córdoba | Sierras, Villa Carlos Paz, Lagos | ✅ Estructurada |
| 🌿 Misiones | Cataratas del Iguazú, Selva | ✅ Estructurada |
| 🍇 Mendoza | Viñedos, Andes, Aconcagua | ✅ Estructurada |

---

## 🚀 Inicio Rápido

### Para Jugadores:
```
1. Abrir Minecraft Bedrock Edition
2. Jugar → Servidores → Agregar Servidor
3. IP: [VER DISCORD/ANUNCIO]
4. Puerto: 19132
5. ¡Conectar!
```

### Para Administradores:
```bash
# Ver documentación completa
docs/INSTALLATION.md      ← Instalación
docs/SERVER_SETUP.md      ← Configuración
docs/ATERNOS_SETUP.md     ← Deploy en Aternos (Fase 1)
docs/ORACLE_DEPLOYMENT.md ← Deploy en Oracle (Fase 2)
```

---

## ⌨️ Comandos del Juego

| Comando | Descripción |
|---------|-------------|
| `/hub` | Volver al HUB principal |
| `/provincia <nombre>` | Ir a una provincia |
| `/landmark <nombre>` | Ir a un landmark |
| `/pasaporte` | Ver tu pasaporte de explorador |
| `/monedas` | Ver tus monedas turísticas |
| `/logros` | Ver tus logros |
| `/acinfo` | Info del servidor |

**Provincias:** `buenos_aires` | `cordoba` | `misiones` | `mendoza`

---

## 📁 Estructura del Proyecto

```
ArgentinaCraft/
├── server/                     ← Configuración del servidor
├── worlds/                     ← Mundos Minecraft
│   ├── hub/                    ← HUB principal (ArgentinaCraft Plaza)
│   ├── buenos_aires/           ← Provincia Buenos Aires
│   ├── cordoba/                ← Provincia Córdoba
│   ├── misiones/               ← Provincia Misiones
│   └── mendoza/                ← Provincia Mendoza
├── plugins/
│   └── ArgentinaCraft_Core/    ← Plugin principal (PHP)
├── behavior_packs/             ← Addons Bedrock (JS)
├── resource_packs/             ← Texturas y UI
├── npc/dialogues/              ← Diálogos de NPCs
├── quests/                     ← Sistema de misiones
├── achievements/               ← Sistema de logros
├── economy/                    ← Sistema de economía
├── teleport_system/            ← Configuración de teletransportes
├── docs/                       ← Documentación completa
├── deployment/                 ← Scripts de deploy
└── backups/                    ← Carpeta de backups
```

---

## 🛠️ Stack Tecnológico

| Componente | Tecnología |
|-----------|-----------|
| Servidor | PocketMine-MP 5.x |
| Plataforma | Minecraft Bedrock Edition |
| Lenguaje (Server) | PHP 8.2 |
| Lenguaje (Addon) | JavaScript (GameTest API) |
| Hosting Fase 1 | Aternos (Gratis) |
| Hosting Fase 2 | Oracle Cloud Free Tier |
| Compatibilidad | Android, iOS, Windows, Tablets |

---

## 🗓️ Roadmap

### ✅ Semana 1 — MVP Foundation
- [x] Servidor Bedrock funcional
- [x] Plugin principal (ArgentinaCraft_Core)
- [x] Sistema de provincias y teleporte
- [x] Sistema de pasaporte
- [x] NPCs turísticos con diálogos
- [x] Sistema de economía (monedas)
- [x] Sistema de logros
- [x] Documentación completa

### 🔄 Semana 2 — Gameplay Systems
- [ ] Construir HUB físico (ArgentinaCraft Plaza)
- [ ] Construir Buenos Aires con landmarks
- [ ] Sistema de quests activo
- [ ] Portales funcionales en HUB
- [ ] Música ambiental por provincia

### 📋 Semana 3 — Expansión
- [ ] Construir Córdoba
- [ ] Construir Misiones con Cataratas
- [ ] Construir Mendoza
- [ ] Sistema de transporte

### 📋 Semana 4 — Advanced Systems
- [ ] Tienda cosmética
- [ ] Mapa interactivo
- [ ] Sistema de misiones diarias
- [ ] Pipeline de expansión con IA

---

## 📄 Documentación

| Archivo | Descripción |
|---------|-------------|
| [INSTALLATION.md](docs/INSTALLATION.md) | Instalación del servidor |
| [SERVER_SETUP.md](docs/SERVER_SETUP.md) | Configuración del servidor |
| [ATERNOS_SETUP.md](docs/ATERNOS_SETUP.md) | Deploy en Aternos |
| [ORACLE_DEPLOYMENT.md](docs/ORACLE_DEPLOYMENT.md) | Deploy en Oracle Cloud |
| [MOBILE_CONNECTION_GUIDE.md](docs/MOBILE_CONNECTION_GUIDE.md) | Guía para mobile |
| [ADMIN_COMMANDS.md](docs/ADMIN_COMMANDS.md) | Comandos de admin |
| [EXPANSION_GUIDE.md](docs/EXPANSION_GUIDE.md) | Guía de expansión |
| [BACKUP_SYSTEM.md](docs/BACKUP_SYSTEM.md) | Sistema de backups |
| [PERFORMANCE_OPTIMIZATION.md](docs/PERFORMANCE_OPTIMIZATION.md) | Optimización |
| [FUTURE_PROVINCES.md](docs/FUTURE_PROVINCES.md) | Provincias futuras |

---

## 🎨 Filosofía de Diseño

- **Aventurero** — El jugador siempre tiene algo nuevo que descubrir
- **Educativo** — Los NPCs enseñan historia y geografía argentina real
- **Optimizado** — Funciona bien en phones/tablets de gama media
- **Modular** — Agregar provincias sin romper lo que ya existe
- **Mobile-First** — Diseñado para jugadores en dispositivos móviles

---

*Hecho con ❤️ para Argentina 🇦🇷*
