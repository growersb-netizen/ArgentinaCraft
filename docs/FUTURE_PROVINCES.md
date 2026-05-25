# 🗺️ ArgentinaCraft — Provincias Futuras

> Roadmap completo para las 23 provincias de Argentina

---

## Estado Actual (MVP v1.0)

| Provincia | Estado | Landmarks |
|-----------|--------|-----------|
| 🏙️ Buenos Aires | ✅ Lanzada | Obelisco, Caminito, La Bombonera |
| 🏔️ Córdoba | ✅ Estructurada | Sierras, Villa Carlos Paz, Lagos |
| 🌿 Misiones | ✅ Estructurada | Cataratas del Iguazú, Selva |
| 🍇 Mendoza | ✅ Estructurada | Viñedos, Andes, Aconcagua |

---

## Fase 2 — Próximas Provincias

### 🌅 Salta y Jujuy
**Prioridad:** Alta — gran atractivo turístico
- Quebrada de Humahuaca (Patrimonio UNESCO)
- Cerro de los Siete Colores (Purmamarca)
- Tren a las Nubes
- Salinas Grandes
- Ciudad de Salta (Cabildo)

### 🐳 Patagonia (Río Negro + Neuquén)
**Prioridad:** Alta — destino internacional
- San Carlos de Bariloche y el lago Nahuel Huapi
- Volcán Lanín
- Bosque de arrayanes
- Villa La Angostura

### 🐧 Santa Cruz
**Prioridad:** Media
- Glaciar Perito Moreno (IMPRESCINDIBLE)
- El Calafate
- El Chaltén y el Fitz Roy
- Parque Nacional Los Glaciares

### 🌊 Mar del Plata (Buenos Aires Costa)
**Prioridad:** Media — turismo masivo
- Rambla Bristol
- Puerto de Mar del Plata
- Playa Grande
- Acuario

---

## Fase 3 — Argentina Completa

| # | Provincia | Landmark Principal |
|---|-----------|-------------------|
| 5 | Chubut | Ballenas Península Valdés |
| 6 | Tierra del Fuego | Ushuaia (fin del mundo) |
| 7 | Entre Ríos | Termas de Federación, Gualeguaychú |
| 8 | La Pampa | Lagunas y Reserva Parque Luro |
| 9 | Chaco | Parque Nacional Chaco |
| 10 | Corrientes | Esteros del Iberá (yacarés) |
| 11 | Formosa | Bañados del Río Pilcomayo |
| 12 | Santiago del Estero | Termas de Río Hondo |
| 13 | Tucumán | Casa Histórica de la Independencia |
| 14 | Catamarca | Campo del Cielo (meteorito) |
| 15 | La Rioja | Talampaya (dinosaurios) |
| 16 | San Juan | Valle de la Luna (Ischigualasto) |
| 17 | San Luis | Merlo, Sierra de los Comechingones |
| 18 | Santa Fe | Rosario, Delta del Paraná |
| 19 | CABA | Retiro, Recoleta, Puerto Madero |
| 20 | Río Negro | Puerto Madryn, Viedma |
| 21 | La Pampa | Santa Rosa |
| 22 | Neuquén (ciudad) | Parque Jurásico real (dinosaurios) |
| 23 | Misiones Interior | Ruinas Jesuíticas San Ignacio |

---

## Criterios de Priorización

Para elegir qué provincia agregar next:

1. **Interés turístico global** (UNESCO, maravillas naturales)
2. **Cantidad de jugadores** que piden la provincia
3. **Complejidad de construcción** (terreno simple = más rápido)
4. **Contenido educativo** disponible

---

## Template para Nueva Provincia

Al agregar una provincia, seguir el checklist:

- [ ] Crear `worlds/<nombre>/` 
- [ ] Crear `quests/<nombre>/quests.json`
- [ ] Crear `npc/dialogues/<nombre>_npcs.json`
- [ ] Agregar a `teleport_system/teleport_config.json`
- [ ] Agregar logros en `achievements/achievements.json`
- [ ] Construir portal en HUB
- [ ] Documentar en `docs/EXPANSION_GUIDE.md`
- [ ] Actualizar este archivo

---

*El objetivo final es tener las 23 provincias argentinas exploradas interactivamente.*  
*¡Argentina entera en Minecraft Bedrock!* 🇦🇷
