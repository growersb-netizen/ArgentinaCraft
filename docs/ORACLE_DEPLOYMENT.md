# ☁️ ArgentinaCraft — Deploy en Oracle Cloud Free Tier

> **Fase 2** — Hosting permanente, gratuito, sin apagado automático

---

## ¿Por qué Oracle Cloud?

| Feature | Aternos (Gratis) | Oracle Free Tier |
|---------|-----------------|-----------------|
| RAM | ~1 GB | 1-4 GB ARM |
| CPU | Compartida | 4 OCPUs ARM |
| Disponibilidad | Se apaga sin jugadores | 24/7 |
| IP | Dinámica | IP pública fija |
| Almacenamiento | ~5 GB | 200 GB |
| Costo | Gratis | **Gratis para siempre** |

---

## Paso 1 — Crear Cuenta Oracle Cloud

1. Ir a: https://cloud.oracle.com/free
2. Registrarse (requiere tarjeta de crédito para verificación, **NO se cobra**)
3. Seleccionar región: **São Paulo (sa-saopaulo-1)** — más cercana a Argentina

---

## Paso 2 — Crear VM (Instancia)

1. **Compute** → **Instances** → **Create Instance**
2. Configuración:
   - **Shape:** `VM.Standard.A1.Flex` (ARM, GRATIS)
   - **OCPUs:** 2
   - **RAM:** 2 GB (máx gratis: 4 GB si no tenés otras VMs)
   - **OS:** Ubuntu 22.04 LTS
3. Descargar el par de llaves SSH (guardar `private_key.pem`)

---

## Paso 3 — Configurar Firewall

### En Oracle Console:
1. **Networking** → **Virtual Cloud Networks** → tu VCN
2. **Security Lists** → **Default Security List**
3. Agregar **Ingress Rule**:
   - **Source:** `0.0.0.0/0`
   - **Protocol:** UDP
   - **Port Range:** `19132`

### En la VM (ufw):
```bash
sudo ufw allow 19132/udp
sudo ufw allow 22/tcp
sudo ufw enable
```

---

## Paso 4 — Instalar PHP y PocketMine

```bash
# Conectar a la VM
ssh -i private_key.pem ubuntu@TU_IP_PUBLICA

# Actualizar sistema
sudo apt update && sudo apt upgrade -y

# Instalar PHP 8.2
sudo apt install software-properties-common -y
sudo add-apt-repository ppa:ondrej/php -y
sudo apt update
sudo apt install php8.2-cli php8.2-curl php8.2-mbstring \
                 php8.2-zip php8.2-xml php8.2-gmp -y

# Crear directorio del servidor
mkdir -p ~/argentinacraft
cd ~/argentinacraft

# Descargar PocketMine-MP
wget https://github.com/pmmp/PocketMine-MP/releases/latest/download/PocketMine-MP.phar
wget https://raw.githubusercontent.com/pmmp/PocketMine-MP/stable/start.sh
chmod +x start.sh
```

---

## Paso 5 — Subir Archivos del Proyecto

```bash
# Desde tu computadora local (PowerShell)
scp -i private_key.pem -r "C:\Users\PC\Universo Noah\ArgentinaCraft\*" ubuntu@TU_IP:~/argentinacraft/
```

---

## Paso 6 — Configurar Servicio Systemd (Auto-Inicio)

```bash
sudo nano /etc/systemd/system/argentinacraft.service
```

Contenido:
```ini
[Unit]
Description=ArgentinaCraft Minecraft Bedrock Server
After=network.target

[Service]
User=ubuntu
WorkingDirectory=/home/ubuntu/argentinacraft/server
ExecStart=/usr/bin/php8.2 PocketMine-MP.phar --no-wizard
Restart=on-failure
RestartSec=10
StandardOutput=journal
StandardError=journal

[Install]
WantedBy=multi-user.target
```

```bash
sudo systemctl enable argentinacraft
sudo systemctl start argentinacraft
sudo systemctl status argentinacraft
```

---

## Paso 7 — Ver Logs

```bash
# Ver logs en tiempo real
sudo journalctl -u argentinacraft -f

# Ver últimas 100 líneas
sudo journalctl -u argentinacraft -n 100
```

---

## Backup Automático

```bash
# Agregar a crontab
crontab -e

# Backup diario a las 3 AM
0 3 * * * tar -czf /home/ubuntu/backups/ac-$(date +\%Y\%m\%d).tar.gz /home/ubuntu/argentinacraft/worlds /home/ubuntu/argentinacraft/plugins/ArgentinaCraft_Core/players/
```

---

## Migración desde Aternos → Oracle

1. En Aternos: descargar backup completo del servidor
2. En Oracle: subir los mundos (`worlds/`) y datos de jugadores
3. Actualizar DNS/IP en Discord y redes sociales
4. Notificar a jugadores el cambio de IP

---

*Ver también: [BACKUP_SYSTEM.md](BACKUP_SYSTEM.md) | [PERFORMANCE_OPTIMIZATION.md](PERFORMANCE_OPTIMIZATION.md)*
