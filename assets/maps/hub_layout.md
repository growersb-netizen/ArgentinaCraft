# 🏛️ ArgentinaCraft Plaza — Layout del HUB

## Vista Cenital (Top-Down)

```
                     NORTE
                       ↑
    ┌──────────────────────────────────────────┐
    │          [Forestas / Árboles]            │
    │   [NPC        │    │        NPC Info]    │
    │  Histor.]   PLAZA   [Guide]              │
    │              ████                        │
    │           ████████                       │
    │         ████SPAWN████                    │
    │           ████████                       │
    │              ████                        │
    │                                          │
    │  ┌──────────────────────────────────┐   │
    │  │      ZONA DE PORTALES            │   │
    │  │ [BA] [CBA] [MIS] [MZA] [ ] [ ]  │   │
    │  └──────────────────────────────────┘   │
    │                                          │
    │   [Info         [Fuente]    [Pasaporte]  │
    │    Board]                   NPC]         │
    └──────────────────────────────────────────┘

LEYENDA:
████ = Plataforma central elevada (spawn)
[BA] = Portal Buenos Aires (vidrio azul)
[CBA]= Portal Córdoba (vidrio verde)
[MIS]= Portal Misiones (vidrio verde oscuro)
[MZA]= Portal Mendoza (vidrio morado)
[ ]  = Portales futuros
```

## Dimensiones del HUB
- **Área total:** 128 × 128 bloques
- **Plaza central:** 32 × 32 bloques
- **Zona de portales:** 80 × 20 bloques (al sur)
- **Altura base:** Y=64

## Materiales Recomendados

### Plaza Central:
- Piso: `smooth_stone_slab` + `stone_bricks`
- Bordes: `cobblestone_wall`
- Centro: `gold_block` con estrella de `terracotta` celeste y blanca

### Portales de Provincia:
- Marco: `stone_brick_wall` (5 bloques alto × 4 ancho)
- Interior: `glass` coloreado según provincia
- Plataforma: `polished_stone`
- Cartel en top: nombre de la provincia

### Vegetación:
- Árboles de `oak` compactos (corona 3×3)
- Flores de colores nacionales: azul, celeste, blanco
- Bancos con `oak_stairs`

### Fuente Central:
- Base circular de `stone_bricks` (radio 5)
- Agua en el centro
- `sea_lantern` en el fondo para iluminación
- No usar water flow → caída de performance

## Sign de Teleporte (Formato)
```
Línea 1: [Teleport]
Línea 2: buenos_aires
Línea 3: (vacía)
Línea 4: Ir a BA
```

## NPCs y Posiciones
| NPC | Coordenadas | Función |
|-----|-------------|---------|
| Guía Principal | (10, 65, 0) | Info general y menú |
| Historiador | (-10, 65, 5) | Historia Argentina |
| Encargado Pasaporte | (0, 65, -15) | Gestión de pasaporte |
| Vendedor | (15, 65, -10) | Tienda cosmética |

## Señalización
- Carteles grandes con nombre de la provincia en cada portal
- Flechas en el piso indicando la zona de portales
- Banner argentino en el centro del HUB (azul-blanco-azul)
- Letras "ARGENTINA" en `banner` de lana blanca con letras

## Iluminación
- `glowstone` empotrado en el piso (patrón de 4×4)
- `sea_lantern` en bordes de la plaza
- `lantern` en postes decorativos
- Sin redstone → usar bloques de luz directa
