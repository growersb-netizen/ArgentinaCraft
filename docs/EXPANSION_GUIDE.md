# 🚀 ArgentinaCraft — Guía de Expansión

> Cómo agregar nuevas provincias, landmarks, NPCs y quests al servidor

---

## Filosofía del Sistema Modular

ArgentinaCraft está diseñado para expandirse sin tocar el código base.  
Cada provincia es completamente independiente y sigue una plantilla.

```
Nueva Provincia = Nuevo Mundo + Nuevas Quests + Nuevos NPCs + Nuevos Landmarks
```

---

## 📦 Agregar una Nueva Provincia

### Paso 1: Crear el archivo de quests

Copiar la plantilla en `quests/NUEVA_PROVINCIA/quests.json`:

```json
{
  "_comment": "ArgentinaCraft — Misiones de NUEVA_PROVINCIA",
  "_version": "1.0.0",
  "province": "nueva_provincia",
  "quests": [
    {
      "id": "np_welcome",
      "name": "§6Bienvenido a Nueva Provincia",
      "description": "Descripción de la bienvenida",
      "category": "intro",
      "steps": [
        {
          "id": "arrive",
          "type": "arrive_in_world",
          "world": "nueva_provincia",
          "description": "Llegar a Nueva Provincia"
        }
      ],
      "rewards": {"coins": 25}
    }
  ]
}
```

### Paso 2: Registrar en el plugin (config.yml)

Agregar en `plugins/ArgentinaCraft_Core/config.yml`:
```yaml
provinces:
  - id: nueva_provincia
    name: "Nueva Provincia"
    emoji: "🗺️"
    color: "YELLOW"
```

### Paso 3: Crear el mundo en el servidor

```bash
# En la consola del servidor
mkworld nueva_provincia normal <seed>
```

### Paso 4: Agregar portal en el HUB

Editar `teleport_system/teleport_config.json` y agregar:
```json
"nueva_provincia": {
  "name": "Nueva Provincia",
  "world": "nueva_provincia",
  "spawn": {"x": 0, "y": 65, "z": 0},
  "portal_location": {"x": 60, "y": 65, "z": 0, "world": "hub"},
  "portal_color": "yellow"
}
```

---

## 🏛️ Agregar un Nuevo Landmark

### En `teleport_system/teleport_config.json`:
```json
"nuevo_landmark": {
  "name": "Nombre del Landmark",
  "province": "nombre_provincia",
  "coords": {"x": 0, "y": 65, "z": 0}
}
```

### En el plugin PHP (Main.php — constante LANDMARK_DATA):
```php
"nuevo_landmark" => [
    "nombre"    => "Nombre del Landmark",
    "provincia" => "nombre_provincia",
    "emoji"     => "🏛️",
    "spawn"     => [0, 65, 0],
    "desc"      => "Descripción del landmark.",
    "reward"    => 50,
],
```

---

## 👤 Agregar un Nuevo NPC

### Crear archivo en `npc/dialogues/PROVINCIA_npcs.json`:

```json
{
  "npcs": [
    {
      "id": "nuevo_npc",
      "name": "§6§lNombre del NPC",
      "position": {"x": 0, "y": 65, "z": 0, "world": "provincia"},
      "dialogues": [
        {
          "id": "greeting",
          "text": "§f¡Hola! Soy el NPC de esta zona.",
          "options": [
            {"text": "§7Gracias", "next": "close"}
          ]
        },
        {
          "id": "close",
          "text": "§e¡Hasta luego!",
          "options": []
        }
      ]
    }
  ]
}
```

---

## 🏆 Agregar un Nuevo Logro

### En `achievements/achievements.json`:

```json
{
  "id": "nuevo_logro",
  "name": "§eNombre del Logro",
  "description": "Descripción de cómo se desbloquea",
  "category": "exploration",
  "icon": "🏆",
  "hidden": false,
  "reward_coins": 50,
  "reward_title": null
}
```

---

## 🗺️ Provincias Futuras (Roadmap)

### Corto Plazo (Semana 3)
- ✅ Buenos Aires (MVP)
- ✅ Córdoba
- ✅ Misiones
- ✅ Mendoza

### Mediano Plazo
- 🔄 Patagonia (Bariloche, glaciares)
- 🔄 Salta y Jujuy (Quebrada de Humahuaca)
- 🔄 Tierra del Fuego (El fin del mundo)

### Largo Plazo
- 📋 Las 23 provincias completas
- 📋 Mar del Plata
- 📋 Rosario
- 📋 Córdoba ciudad completa
- 📋 Estancias y campo

---

## 🤖 Pipeline de Expansión con IA

El sistema está diseñado para que futuras IA generen contenido:

1. **Template de Provincia** → Claude genera quests.json y npcs.json
2. **Template de Landmark** → Claude genera descripción y coordenadas
3. **Template de NPC** → Claude genera diálogos histórico-turísticos
4. **Template de Quest** → Claude genera misiones de exploración

### Ejemplo de prompt para IA:
```
Genera el archivo quests.json para la provincia de Salta, Argentina.
Incluir 3 quests de exploración sobre:
- Quebrada de Humahuaca
- Ciudad de Salta
- Tren a las Nubes
Usar el formato del archivo template en quests/template.json
```

---

*Ver también: [FUTURE_PROVINCES.md](FUTURE_PROVINCES.md) | [INSTALLATION.md](INSTALLATION.md)*
