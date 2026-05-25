# 🏙️ Buenos Aires — Layout del Mundo

## Mapa de Landmarks

```
                        NORTE
                          ↑
    ┌─────────────────────────────────────────────┐
    │                                             │
    │  [SPAWN]                                    │
    │  Bienvenida BA                              │
    │     ↓                                       │
    │                                             │
    │   ←←←← AVENIDA 9 DE JULIO ←←←←            │
    │                                             │
    │              [OBELISCO]                     │
    │              X:100 Z:0                      │
    │              (67m de altura)                │
    │                                             │
    │   ←←←← CALLE CORRIENTES ←←←←              │
    │                                             │
    │                        [LA BOCA]            │
    │                        [CAMINITO]           │
    │                        X:200 Z:0            │
    │                                             │
    │                        [LA BOMBONERA]       │
    │                        X:300 Z:0            │
    │                        (estadio)            │
    │                                             │
    │   [SECRETO]                                 │
    │   Estatua Mate                              │
    │   (escondida)                               │
    └─────────────────────────────────────────────┘
```

## El Obelisco — Guía de Construcción

```
Vista lateral del Obelisco (simplificado):
        
        █           ← Punta (1 bloque)
       ███          ← Sección superior
      █████         ← Cuerpo central
     ███████        ← Cuerpo
    █████████       ← Cuerpo
   ███████████      ← Base
  █████████████     ← Base
 ███████████████    ← Plataforma

Altura total: 20 bloques (representa 67m reales)
Ancho base: 7 bloques
Material: quartz_block + quartz_pillar
Plataforma: smooth_quartz_slab (5×5)
```

## Caminito — Guía de Construcción

```
Vista lateral Caminito (casas coloridas):

[ROJO] [AMARILLO] [AZUL] [VERDE] [NARANJA]
  ██      ██        ██     ██       ██
  ██  🚪  ██  🚪   ██  🚪  ██  🚪   ██
  ██      ██        ██     ██       ██
══════════════════════════════════════
              CAMINO (adoquines)

Materiales por casa:
- Casa 1: red_wool + spruce_trapdoor
- Casa 2: yellow_wool + oak_door
- Casa 3: blue_wool + oak_trapdoor  
- Casa 4: green_wool + spruce_door
- Casa 5: orange_wool + dark_oak_door

Calle: stone_bricks (adoquín effect)
Ancho de calle: 5 bloques
Largo: 30 bloques
```

## La Bombonera — Guía de Construcción

```
Vista top-down estadio (simplificado):

    ████████████████████████████
    █                          █
    █    ┌──────────────┐      █
    █    │   ⬜⬜⬜⬜  │      █    ← Cancha (verde)
    █    │  ⬜⚽⬜⬜  │      █
    █    │   ⬜⬜⬜⬜  │      █
    █    └──────────────┘      █
    █                          █
    ████████████████████████████

Exterior: blue_concrete + yellow_concrete_powder (colores Boca)
Tribunas: stone_brick_stairs en ángulo
Cancha: green_concrete + white_concrete (líneas)
Techo: iron_trapdoor (efecto de metal)
Dimensiones exteriores: 40×50 bloques
```

## Materiales de Buenos Aires

### Suelos:
- Calles: `gray_concrete` + `cobblestone`
- Veredas: `smooth_stone`
- Parques: `grass_block` + `dirt_path`

### Edificios Genéricos (fondo):
- `stone_bricks` para fachadas clásicas
- `white_concrete` para modernos
- `glass_pane` para ventanas
- `oak_trapdoor` para shutters/persianas

### Vegetación:
- `oak_tree` podados en la Avenida 9 de Julio
- `rose_bush` en Caminito

### Iluminación de Calle:
- Postes con `iron_bars` + `lantern` en el top
- Cada 8 bloques a lo largo de las calles
