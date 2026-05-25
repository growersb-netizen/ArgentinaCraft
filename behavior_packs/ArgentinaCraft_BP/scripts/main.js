/**
 * ArgentinaCraft — Behavior Pack Scripts
 * Sistema de comportamientos client-side para Bedrock
 *
 * Módulos:
 *   - Portal detection
 *   - NPC interaction
 *   - Quest UI
 *   - Passport display
 */

import { world, system, Player, EntityTypes } from "@minecraft/server";
import { ActionFormData, MessageFormData, ModalFormData } from "@minecraft/server-ui";

// =============================================================
// CONSTANTES
// =============================================================

const ARGENTINACRAFT_VERSION = "1.0.0";

const PROVINCES = {
    "buenos_aires": {
        name: "Buenos Aires",
        emoji: "🏙️",
        color: "§6",
        description: "La capital de Argentina. Ciudad de tango y cultura."
    },
    "cordoba": {
        name: "Córdoba",
        emoji: "🏔️",
        color: "§a",
        description: "Sierras, lagos y la ciudad universitaria."
    },
    "misiones": {
        name: "Misiones",
        emoji: "🌿",
        color: "§2",
        description: "Selva subtropical y las Cataratas del Iguazú."
    },
    "mendoza": {
        name: "Mendoza",
        emoji: "🍇",
        color: "§5",
        description: "Viñedos infinitos al pie de los Andes."
    }
};

// =============================================================
// INICIALIZACIÓN
// =============================================================

system.runTimeout(() => {
    console.log(`[ArgentinaCraft] v${ARGENTINACRAFT_VERSION} cargado ✅`);
    console.log(`[ArgentinaCraft] Provincias: ${Object.keys(PROVINCES).length}`);
}, 20);

// =============================================================
// EVENTO: JUGADOR SE UNE
// =============================================================

world.afterEvents.playerSpawn.subscribe((event) => {
    const player = event.player;

    if (event.initialSpawn) {
        // Pequeño delay para que el mundo cargue
        system.runTimeout(() => {
            showWelcomeTitle(player);
        }, 60);
    }
});

/**
 * Mostrar título de bienvenida
 */
function showWelcomeTitle(player) {
    player.onScreenDisplay.setTitle("§6ArgentinaCraft", {
        subtitle: "§f🇦🇷 Explorá Argentina",
        fadeInDuration: 20,
        stayDuration: 60,
        fadeOutDuration: 20
    });
}

// =============================================================
// EVENTO: INTERACCIÓN CON BLOQUES (Portales/Carteles)
// =============================================================

world.afterEvents.playerInteractWithBlock.subscribe((event) => {
    const player = event.player;
    const block = event.block;

    // Detectar carteles de teleporte
    if (block.typeId.includes("sign")) {
        const signText = getSignText(block);
        if (signText) {
            handleSignInteraction(player, signText);
        }
    }
});

/**
 * Manejar interacción con cartel de teleporte
 */
function handleSignInteraction(player, text) {
    const lowerText = text.toLowerCase().replace(/\s+/g, "_");

    if (PROVINCES[lowerText]) {
        showProvinceConfirmation(player, lowerText);
    }
}

/**
 * Mostrar confirmación antes de teleportar a provincia
 */
async function showProvinceConfirmation(player, provinceId) {
    const province = PROVINCES[provinceId];

    const form = new MessageFormData()
        .title(`${province.emoji} ${province.name}`)
        .body(`${province.color}${province.description}\n\n§f¿Querés viajar a §e${province.name}§f?`)
        .button1("§a✈ ¡Vamos!")
        .button2("§c✖ Cancelar");

    const response = await form.show(player);

    if (response.selection === 0) {
        player.runCommandAsync(`/provincia ${provinceId}`);
    }
}

// =============================================================
// MENÚ PRINCIPAL DE PROVINCIAS
// =============================================================

/**
 * Mostrar menú principal de provincias como UI
 */
async function showProvinceMenu(player) {
    const form = new ActionFormData()
        .title("§6🇦🇷 Provincias de Argentina")
        .body("§fElegí una provincia para explorar:");

    for (const [id, data] of Object.entries(PROVINCES)) {
        form.button(`${data.emoji} ${data.color}${data.name}`, "textures/ui/province_icon");
    }

    form.button("§7✖ Cerrar");

    const response = await form.show(player);

    if (response.canceled || response.selection === Object.keys(PROVINCES).length) {
        return;
    }

    const provinceIds = Object.keys(PROVINCES);
    const selectedProvince = provinceIds[response.selection];

    if (selectedProvince) {
        player.runCommandAsync(`/provincia ${selectedProvince}`);
    }
}

// =============================================================
// HELPER: Leer texto de cartel
// =============================================================

function getSignText(block) {
    try {
        const component = block.getComponent("minecraft:sign");
        if (component) {
            return component.getText().trim();
        }
    } catch {
        // Block no tiene componente de cartel
    }
    return null;
}

// =============================================================
// ACTIONBAR: Mostrar info de la provincia actual
// =============================================================

system.runInterval(() => {
    for (const player of world.getAllPlayers()) {
        const dimensionId = player.dimension.id;
        const currentProvince = getProvinceFromDimension(dimensionId);

        if (currentProvince) {
            const data = PROVINCES[currentProvince];
            player.onScreenDisplay.setActionBar(
                `${data.emoji} §f${data.name} §8| §7/hub para volver al HUB`
            );
        }
    }
}, 100); // Cada 5 segundos

function getProvinceFromDimension(dimensionId) {
    const clean = dimensionId.replace("minecraft:", "");
    return PROVINCES[clean] ? clean : null;
}
