<?php

/*
 * =============================================================
 * ArgentinaCraft Core — Plugin Principal
 * Sistema de turismo interactivo para Minecraft Bedrock
 * =============================================================
 *
 * Módulos:
 *   - HUB Manager       → gestión de zona central
 *   - Province Manager  → provincias y portales
 *   - NPC Manager       → NPCs turísticos
 *   - Passport System   → sistema de sellos
 *   - Economy           → monedas turísticas
 *   - Quest System      → misiones de exploración
 *   - Achievement System→ logros y rangos
 *   - Teleport System   → teletransporte seguro
 * =============================================================
 */

declare(strict_types=1);

namespace ArgentinaCraft\Core;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat as TF;
use pocketmine\world\Position;

class Main extends PluginBase implements Listener {

    /** @var array<string, array> Datos de jugadores */
    private array $playerData = [];

    /** @var array<string, array> Provincias registradas */
    private array $provinces = [];

    /** @var array<string, array> Landmarks registrados */
    private array $landmarks = [];

    /** @var array<string, array> Posiciones de portales */
    private array $portals = [];

    // Spawns de provincias (coordenadas del HUB flat)
    private const HUB_SPAWN = [0, 64, 0];

    // Provincias disponibles
    private const PROVINCE_DATA = [
        "buenos_aires" => [
            "nombre"    => "Buenos Aires",
            "emoji"     => "🏙️",
            "color"     => TF::GOLD,
            "spawn"     => [0, 65, 0],
            "desc"      => "La capital de Argentina. Ciudad vibrante de cultura y tango.",
        ],
        "cordoba" => [
            "nombre"    => "Córdoba",
            "emoji"     => "🏔️",
            "color"     => TF::GREEN,
            "spawn"     => [0, 65, 0],
            "desc"      => "Sierras, lagos y la docta ciudad universitaria.",
        ],
        "misiones" => [
            "nombre"    => "Misiones",
            "emoji"     => "🌿",
            "color"     => TF::DARK_GREEN,
            "spawn"     => [0, 65, 0],
            "desc"      => "Selva subtropical y las majestuosas Cataratas del Iguazú.",
        ],
        "mendoza" => [
            "nombre"    => "Mendoza",
            "emoji"     => "🍇",
            "color"     => TF::DARK_PURPLE,
            "spawn"     => [0, 65, 0],
            "desc"      => "Viñedos infinitos al pie de los Andes.",
        ],
    ];

    // Landmarks de Buenos Aires
    private const LANDMARK_DATA = [
        "obelisco" => [
            "nombre"    => "Obelisco",
            "provincia" => "buenos_aires",
            "emoji"     => "🗽",
            "spawn"     => [100, 65, 0],
            "desc"      => "El símbolo más icónico de Buenos Aires.",
            "reward"    => 50,
        ],
        "caminito" => [
            "nombre"    => "Caminito",
            "provincia" => "buenos_aires",
            "emoji"     => "🎨",
            "spawn"     => [200, 65, 0],
            "desc"      => "El colorido barrio de La Boca.",
            "reward"    => 40,
        ],
        "la_bombonera" => [
            "nombre"    => "La Bombonera",
            "provincia" => "buenos_aires",
            "emoji"     => "⚽",
            "spawn"     => [300, 65, 0],
            "desc"      => "El estadio legendario del Club Atlético Boca Juniors.",
            "reward"    => 45,
        ],
        "iguazu" => [
            "nombre"    => "Cataratas del Iguazú",
            "provincia" => "misiones",
            "emoji"     => "💧",
            "spawn"     => [0, 65, 100],
            "desc"      => "Una de las maravillas naturales del mundo.",
            "reward"    => 100,
        ],
    ];

    public function onEnable(): void {
        // Registrar listeners
        $this->getServer()->getPluginManager()->registerEvents($this, $this);

        // Cargar datos de provincias y landmarks
        $this->loadProvinceData();
        $this->loadLandmarkData();

        // Guardar config por defecto
        $this->saveDefaultConfig();

        $this->getLogger()->info(TF::GREEN . "╔══════════════════════════════════╗");
        $this->getLogger()->info(TF::GREEN . "║  ArgentinaCraft Core v1.0.0      ║");
        $this->getLogger()->info(TF::GREEN . "║  ¡Bienvenido a ArgentinaCraft!   ║");
        $this->getLogger()->info(TF::GREEN . "║  Provincias: " . count(self::PROVINCE_DATA) . " | Landmarks: " . count(self::LANDMARK_DATA) . "     ║");
        $this->getLogger()->info(TF::GREEN . "╚══════════════════════════════════╝");
    }

    public function onDisable(): void {
        // Guardar datos de jugadores al cerrar
        $this->saveAllPlayerData();
        $this->getLogger()->info(TF::YELLOW . "[ArgentinaCraft] Datos guardados correctamente.");
    }

    // =========================================================
    // EVENT HANDLERS
    // =========================================================

    /**
     * Evento: jugador se une al servidor
     */
    public function onPlayerJoin(PlayerJoinEvent $event): void {
        $player = $event->getPlayer();
        $name   = $player->getName();

        // Cargar o crear datos del jugador
        $this->loadPlayerData($name);

        // Mensaje de bienvenida
        $this->sendWelcomeMessage($player);

        // Teleport al HUB en el join
        $this->teleportToHub($player);

        // Mensaje global
        $event->setJoinMessage(
            TF::GOLD . "✈ " . TF::YELLOW . $name .
            TF::GOLD . " llegó a ArgentinaCraft! " .
            TF::GRAY . "(Jugadores: " . count($this->getServer()->getOnlinePlayers()) . ")"
        );
    }

    /**
     * Evento: jugador sale del servidor
     */
    public function onPlayerQuit(PlayerQuitEvent $event): void {
        $player = $event->getPlayer();
        $name   = $player->getName();

        // Guardar datos
        $this->savePlayerData($name);

        $event->setQuitMessage(
            TF::GRAY . "✈ " . $name . " dejó ArgentinaCraft."
        );
    }

    /**
     * Evento: jugador se mueve (detección de zonas/portales)
     */
    public function onPlayerMove(PlayerMoveEvent $event): void {
        $player = $event->getPlayer();
        $pos    = $player->getPosition();

        // Chequear si el jugador entró a un portal
        $this->checkPortalEntry($player, $pos);
    }

    /**
     * Evento: jugador interactúa con bloque/NPC
     */
    public function onPlayerInteract(PlayerInteractEvent $event): void {
        $player = $event->getPlayer();
        $block  = $event->getBlock();

        // Chequear si es un cartel de teleporte
        $this->checkTeleportSign($player, $block);
    }

    // =========================================================
    // COMMANDS
    // =========================================================

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool {
        if (!($sender instanceof Player)) {
            $sender->sendMessage(TF::RED . "Este comando solo puede usarse en el juego.");
            return true;
        }

        $player = $sender;

        switch ($command->getName()) {
            case "hub":
                $this->teleportToHub($player);
                return true;

            case "provincia":
                if (empty($args[0])) {
                    $this->showProvinceMenu($player);
                    return true;
                }
                $this->teleportToProvince($player, strtolower($args[0]));
                return true;

            case "landmark":
                if (empty($args[0])) {
                    $this->showLandmarkMenu($player);
                    return true;
                }
                $this->teleportToLandmark($player, strtolower(str_replace(" ", "_", $args[0])));
                return true;

            case "pasaporte":
                $this->showPassport($player);
                return true;

            case "monedas":
                $this->showCoins($player);
                return true;

            case "logros":
                $this->showAchievements($player);
                return true;

            case "acinfo":
                $this->showServerInfo($player);
                return true;
        }

        return false;
    }

    // =========================================================
    // TELEPORT SYSTEM
    // =========================================================

    /**
     * Teletransporta al jugador al HUB principal
     */
    public function teleportToHub(Player $player): void {
        $world = $this->getServer()->getWorldManager()->getWorldByName("hub");

        if ($world === null) {
            $player->sendMessage(TF::RED . "❌ El mundo HUB no está disponible ahora mismo.");
            return;
        }

        $spawn = $world->getSpawnLocation();
        $player->teleport($spawn);
        $player->sendMessage(
            TF::GOLD . "╔══════════════════════════════╗\n" .
            TF::GOLD . "║  " . TF::YELLOW . "🏛️  Bienvenido al HUB" . TF::GOLD . "        ║\n" .
            TF::GOLD . "║  " . TF::WHITE . "ArgentinaCraft Plaza" . TF::GOLD . "       ║\n" .
            TF::GOLD . "╚══════════════════════════════╝"
        );
    }

    /**
     * Teletransporta al jugador a una provincia
     */
    public function teleportToProvince(Player $player, string $province): void {
        $province = strtolower(str_replace(" ", "_", $province));

        // Mapeo de nombres comunes
        $aliases = [
            "ba"            => "buenos_aires",
            "bsas"          => "buenos_aires",
            "bs"            => "buenos_aires",
            "cba"           => "cordoba",
            "córdoba"       => "cordoba",
            "mza"           => "mendoza",
            "mendoz"        => "mendoza",
            "misiones"      => "misiones",
            "iguazu"        => "misiones",
            "iguazú"        => "misiones",
        ];

        if (isset($aliases[$province])) {
            $province = $aliases[$province];
        }

        if (!isset(self::PROVINCE_DATA[$province])) {
            $player->sendMessage(TF::RED . "❌ Provincia desconocida: " . $province);
            $player->sendMessage(TF::YELLOW . "Provincias disponibles: " . implode(", ", array_keys(self::PROVINCE_DATA)));
            return;
        }

        $data  = self::PROVINCE_DATA[$province];
        $world = $this->getServer()->getWorldManager()->getWorldByName($province);

        if ($world === null) {
            $player->sendMessage(TF::RED . "❌ La provincia " . $data["nombre"] . " no está disponible aún.");
            return;
        }

        $spawn = $world->getSpawnLocation();
        $player->teleport($spawn);

        // Registrar visita en pasaporte
        $this->stampPassport($player->getName(), $province);

        $player->sendMessage(
            $data["color"] . "╔══════════════════════════════╗\n" .
            $data["color"] . "║  " . $data["emoji"] . " " . TF::WHITE . $data["nombre"] . $data["color"] . str_repeat(" ", max(0, 18 - strlen($data["nombre"]))) . "║\n" .
            $data["color"] . "║  " . TF::GRAY . $data["desc"] . "\n" .
            $data["color"] . "╚══════════════════════════════╝"
        );

        // Dar monedas por visitar provincia nueva
        $this->addCoins($player->getName(), 25);
    }

    /**
     * Teletransporta al jugador a un landmark
     */
    public function teleportToLandmark(Player $player, string $landmark): void {
        if (!isset(self::LANDMARK_DATA[$landmark])) {
            $player->sendMessage(TF::RED . "❌ Landmark desconocido: " . $landmark);
            $player->sendMessage(TF::YELLOW . "Usa /landmark sin argumentos para ver la lista.");
            return;
        }

        $data     = self::LANDMARK_DATA[$landmark];
        $province = $data["provincia"];
        $world    = $this->getServer()->getWorldManager()->getWorldByName($province);

        if ($world === null) {
            $player->sendMessage(TF::RED . "❌ El mundo de esta provincia no está disponible.");
            return;
        }

        [$x, $y, $z] = $data["spawn"];
        $player->teleport(new Position($x, $y, $z, $world));

        // Recompensa
        $this->addCoins($player->getName(), $data["reward"]);

        $player->sendMessage(
            TF::AQUA . "╔══════════════════════════════╗\n" .
            TF::AQUA . "║ " . $data["emoji"] . " " . TF::WHITE . $data["nombre"] . TF::AQUA . str_repeat(" ", max(0, 20 - strlen($data["nombre"]))) . "║\n" .
            TF::AQUA . "║ " . TF::GRAY . $data["desc"] . "\n" .
            TF::AQUA . "║ " . TF::YELLOW . "+" . $data["reward"] . " monedas turísticas 🪙" . TF::AQUA . "  ║\n" .
            TF::AQUA . "╚══════════════════════════════╝"
        );
    }

    // =========================================================
    // PROVINCE & LANDMARK MENUS
    // =========================================================

    private function showProvinceMenu(Player $player): void {
        $player->sendMessage(TF::GOLD . "╔══════════════════════════════════════╗");
        $player->sendMessage(TF::GOLD . "║  🗺️  " . TF::YELLOW . "Provincias de ArgentinaCraft" . TF::GOLD . "    ║");
        $player->sendMessage(TF::GOLD . "╠══════════════════════════════════════╣");

        foreach (self::PROVINCE_DATA as $key => $data) {
            $player->sendMessage(
                TF::GOLD . "║  " . $data["emoji"] . " " . $data["color"] . $data["nombre"] .
                TF::GRAY . " — /provincia " . $key . str_repeat(" ", max(0, 10 - strlen($key))) . TF::GOLD . "║"
            );
        }

        $player->sendMessage(TF::GOLD . "╚══════════════════════════════════════╝");
    }

    private function showLandmarkMenu(Player $player): void {
        $player->sendMessage(TF::AQUA . "╔══════════════════════════════════════╗");
        $player->sendMessage(TF::AQUA . "║  🏛️  " . TF::WHITE . "Landmarks Disponibles" . TF::AQUA . "           ║");
        $player->sendMessage(TF::AQUA . "╠══════════════════════════════════════╣");

        foreach (self::LANDMARK_DATA as $key => $data) {
            $province = self::PROVINCE_DATA[$data["provincia"]]["nombre"] ?? $data["provincia"];
            $player->sendMessage(
                TF::AQUA . "║  " . $data["emoji"] . " " . TF::WHITE . $data["nombre"] .
                TF::GRAY . " (" . $province . ")" . TF::AQUA . "║"
            );
            $player->sendMessage(TF::AQUA . "║     " . TF::GRAY . "/landmark " . $key . TF::AQUA . "║");
        }

        $player->sendMessage(TF::AQUA . "╚══════════════════════════════════════╝");
    }

    // =========================================================
    // PASSPORT SYSTEM
    // =========================================================

    private function stampPassport(string $playerName, string $province): void {
        if (!isset($this->playerData[$playerName])) {
            $this->loadPlayerData($playerName);
        }

        if (!in_array($province, $this->playerData[$playerName]["stamps"] ?? [], true)) {
            $this->playerData[$playerName]["stamps"][] = $province;
        }
    }

    private function showPassport(Player $player): void {
        $name   = $player->getName();
        $data   = $this->playerData[$name] ?? [];
        $stamps = $data["stamps"] ?? [];
        $rank   = $this->getTouristRank(count($stamps));

        $player->sendMessage(TF::YELLOW . "╔══════════════════════════════════════╗");
        $player->sendMessage(TF::YELLOW . "║  📖 " . TF::WHITE . "Pasaporte Argentino" . TF::YELLOW . "              ║");
        $player->sendMessage(TF::YELLOW . "║  👤 " . TF::AQUA . $name . TF::YELLOW . "                        ║");
        $player->sendMessage(TF::YELLOW . "║  🏆 " . TF::GOLD . $rank . TF::YELLOW . "                    ║");
        $player->sendMessage(TF::YELLOW . "╠══════════════════════════════════════╣");
        $player->sendMessage(TF::YELLOW . "║  " . TF::WHITE . "Sellos de provincia:" . TF::YELLOW . "                ║");

        foreach (self::PROVINCE_DATA as $key => $pdata) {
            $visited = in_array($key, $stamps, true);
            $icon    = $visited ? TF::GREEN . "✅" : TF::GRAY . "⬜";
            $player->sendMessage(TF::YELLOW . "║    " . $icon . " " . $pdata["emoji"] . " " . $pdata["nombre"] . TF::YELLOW . "         ║");
        }

        $player->sendMessage(TF::YELLOW . "╠══════════════════════════════════════╣");
        $player->sendMessage(TF::YELLOW . "║  🪙 Monedas: " . TF::GOLD . ($data["coins"] ?? 0) . TF::YELLOW . "                   ║");
        $player->sendMessage(TF::YELLOW . "╚══════════════════════════════════════╝");
    }

    private function getTouristRank(int $stamps): string {
        return match(true) {
            $stamps >= 4  => TF::GOLD    . "🌟 Gran Explorador",
            $stamps >= 3  => TF::AQUA    . "🗺️  Viajero Experto",
            $stamps >= 2  => TF::GREEN   . "✈️  Turista Activo",
            $stamps >= 1  => TF::WHITE   . "🎒 Explorador Novato",
            default       => TF::GRAY    . "🚶 Visitante",
        };
    }

    // =========================================================
    // ECONOMY SYSTEM
    // =========================================================

    private function addCoins(string $playerName, int $amount): void {
        if (!isset($this->playerData[$playerName])) {
            $this->loadPlayerData($playerName);
        }
        $this->playerData[$playerName]["coins"] = ($this->playerData[$playerName]["coins"] ?? 0) + $amount;
    }

    private function showCoins(Player $player): void {
        $coins = $this->playerData[$player->getName()]["coins"] ?? 0;
        $player->sendMessage(
            TF::GOLD . "🪙 Tus monedas turísticas: " . TF::YELLOW . $coins .
            TF::GRAY . " (Explorá landmarks para ganar más!)"
        );
    }

    // =========================================================
    // ACHIEVEMENTS
    // =========================================================

    private function showAchievements(Player $player): void {
        $name   = $player->getName();
        $data   = $this->playerData[$name] ?? [];
        $stamps = count($data["stamps"] ?? []);
        $coins  = $data["coins"] ?? 0;

        $player->sendMessage(TF::GOLD . "╔══════════════════════════════════════╗");
        $player->sendMessage(TF::GOLD . "║  🏆 " . TF::WHITE . "Tus Logros" . TF::GOLD . "                       ║");
        $player->sendMessage(TF::GOLD . "╠══════════════════════════════════════╣");

        $achievements = [
            ["🗺️  Primer Sello",     $stamps >= 1,  "Visitá una provincia"],
            ["✈️  Viajero",          $stamps >= 2,  "Visitá 2 provincias"],
            ["🌍 Gran Explorador",   $stamps >= 4,  "Visitá todas las provincias"],
            ["🪙 Rico Turístico",    $coins >= 100, "Acumulá 100 monedas"],
            ["💰 Millonario",        $coins >= 500, "Acumulá 500 monedas"],
        ];

        foreach ($achievements as [$title, $unlocked, $hint]) {
            $icon = $unlocked ? TF::GREEN . "✅" : TF::GRAY . "🔒";
            $color = $unlocked ? TF::WHITE : TF::DARK_GRAY;
            $player->sendMessage(TF::GOLD . "║  " . $icon . " " . $color . $title . TF::GOLD . "║");
            if (!$unlocked) {
                $player->sendMessage(TF::GOLD . "║       " . TF::GRAY . $hint . TF::GOLD . "       ║");
            }
        }

        $player->sendMessage(TF::GOLD . "╚══════════════════════════════════════╝");
    }

    // =========================================================
    // WELCOME MESSAGE
    // =========================================================

    private function sendWelcomeMessage(Player $player): void {
        $this->getScheduler()->scheduleDelayedTask(new class($player) extends \pocketmine\scheduler\Task {
            public function __construct(private Player $player) {}
            public function onRun(): void {
                if (!$this->player->isConnected()) return;
                $this->player->sendMessage("");
                $this->player->sendMessage(TF::GOLD . "    ╔══════════════════════════════════╗");
                $this->player->sendMessage(TF::GOLD . "    ║  " . TF::YELLOW . "🇦🇷 ¡Bienvenido a ArgentinaCraft!" . TF::GOLD . " ║");
                $this->player->sendMessage(TF::GOLD . "    ║  " . TF::WHITE . "Explorá las provincias de Argentina" . TF::GOLD . "║");
                $this->player->sendMessage(TF::GOLD . "    ║  " . TF::AQUA . "Usá /provincia para empezar" . TF::GOLD . "       ║");
                $this->player->sendMessage(TF::GOLD . "    ║  " . TF::GRAY . "/hub  /pasaporte  /logros" . TF::GOLD . "         ║");
                $this->player->sendMessage(TF::GOLD . "    ╚══════════════════════════════════╝");
                $this->player->sendMessage("");
            }
        }, 40); // 2 segundos delay
    }

    // =========================================================
    // SERVER INFO
    // =========================================================

    private function showServerInfo(Player $player): void {
        $online = count($this->getServer()->getOnlinePlayers());
        $player->sendMessage(TF::GOLD . "╔════════════════════════════════════════╗");
        $player->sendMessage(TF::GOLD . "║  🇦🇷 " . TF::YELLOW . "ArgentinaCraft" . TF::GOLD . " — Turismo Virtual    ║");
        $player->sendMessage(TF::GOLD . "╠════════════════════════════════════════╣");
        $player->sendMessage(TF::GOLD . "║  📌 " . TF::WHITE . "Version: 1.0.0 MVP" . TF::GOLD . "                  ║");
        $player->sendMessage(TF::GOLD . "║  👥 " . TF::WHITE . "Jugadores online: " . $online . TF::GOLD . "             ║");
        $player->sendMessage(TF::GOLD . "║  🗺️  " . TF::WHITE . "Provincias: 4" . TF::GOLD . "                       ║");
        $player->sendMessage(TF::GOLD . "║  🏛️  " . TF::WHITE . "Landmarks: " . count(self::LANDMARK_DATA) . TF::GOLD . "                        ║");
        $player->sendMessage(TF::GOLD . "╠════════════════════════════════════════╣");
        $player->sendMessage(TF::GOLD . "║  " . TF::GRAY . "Comandos: /hub /provincia /pasaporte" . TF::GOLD . "   ║");
        $player->sendMessage(TF::GOLD . "║           " . TF::GRAY . "/landmark /monedas /logros" . TF::GOLD . "     ║");
        $player->sendMessage(TF::GOLD . "╚════════════════════════════════════════╝");
    }

    // =========================================================
    // PORTAL DETECTION
    // =========================================================

    private function checkPortalEntry(Player $player, Position $pos): void {
        // Implementación futura: detectar bloques de portal personalizados
        // y teletransportar al jugador automáticamente
    }

    private function checkTeleportSign(Player $player, \pocketmine\block\Block $block): void {
        // Implementación futura: carteles de teleporte interactivos
    }

    // =========================================================
    // DATA MANAGEMENT
    // =========================================================

    private function loadProvinceData(): void {
        foreach (self::PROVINCE_DATA as $key => $data) {
            $this->provinces[$key] = $data;
        }
        $this->getLogger()->info("Provincias cargadas: " . count($this->provinces));
    }

    private function loadLandmarkData(): void {
        foreach (self::LANDMARK_DATA as $key => $data) {
            $this->landmarks[$key] = $data;
        }
        $this->getLogger()->info("Landmarks cargados: " . count($this->landmarks));
    }

    private function loadPlayerData(string $name): void {
        $file = $this->getDataFolder() . "players/" . strtolower($name) . ".json";

        if (file_exists($file)) {
            $json = file_get_contents($file);
            $data = json_decode($json, true);
            if (is_array($data)) {
                $this->playerData[$name] = $data;
                return;
            }
        }

        // Datos por defecto para jugador nuevo
        $this->playerData[$name] = [
            "name"          => $name,
            "coins"         => 0,
            "stamps"        => [],
            "achievements"  => [],
            "quests"        => [],
            "first_join"    => date("Y-m-d H:i:s"),
            "last_join"     => date("Y-m-d H:i:s"),
            "rank"          => "visitor",
        ];
    }

    private function savePlayerData(string $name): void {
        if (!isset($this->playerData[$name])) return;

        $dir = $this->getDataFolder() . "players/";
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        $this->playerData[$name]["last_join"] = date("Y-m-d H:i:s");
        $file = $dir . strtolower($name) . ".json";
        file_put_contents($file, json_encode($this->playerData[$name], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }

    private function saveAllPlayerData(): void {
        foreach (array_keys($this->playerData) as $name) {
            $this->savePlayerData($name);
        }
    }
}
