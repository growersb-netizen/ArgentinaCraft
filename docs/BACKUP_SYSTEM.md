# 💾 ArgentinaCraft — Sistema de Backups

---

## ¿Qué Hacer Backup?

| Directorio | Importancia | Frecuencia |
|-----------|-------------|-----------|
| `worlds/` | 🔴 Crítico | Diario |
| `plugins/ArgentinaCraft_Core/players/` | 🔴 Crítico | Diario |
| `plugins/ArgentinaCraft_Core/config.yml` | 🟡 Importante | Semanal |
| `server/pocketmine.yml` | 🟡 Importante | Ante cambios |
| `plugins/` completo | 🟢 Útil | Semanal |

---

## Script de Backup (Linux/Oracle)

Guardar como `deployment/backup.sh`:

```bash
#!/bin/bash
# =============================================================
# ArgentinaCraft — Script de Backup Automático
# =============================================================

SERVER_DIR="/home/ubuntu/argentinacraft"
BACKUP_DIR="/home/ubuntu/backups/argentinacraft"
DATE=$(date +%Y-%m-%d_%H-%M)
BACKUP_NAME="ac_backup_$DATE.tar.gz"

# Crear directorio de backups si no existe
mkdir -p "$BACKUP_DIR"

echo "🔄 Iniciando backup: $BACKUP_NAME"

# Crear archivo de backup
tar -czf "$BACKUP_DIR/$BACKUP_NAME" \
    "$SERVER_DIR/worlds/" \
    "$SERVER_DIR/plugins/ArgentinaCraft_Core/players/" \
    "$SERVER_DIR/plugins/ArgentinaCraft_Core/config.yml" \
    "$SERVER_DIR/server/pocketmine.yml"

if [ $? -eq 0 ]; then
    echo "✅ Backup creado: $BACKUP_DIR/$BACKUP_NAME"
    
    # Eliminar backups más antiguos de 7 días
    find "$BACKUP_DIR" -name "ac_backup_*.tar.gz" -mtime +7 -delete
    echo "🧹 Backups antiguos eliminados"
else
    echo "❌ Error al crear backup"
    exit 1
fi

# Mostrar tamaño del backup
SIZE=$(du -sh "$BACKUP_DIR/$BACKUP_NAME" | cut -f1)
echo "📦 Tamaño: $SIZE"
```

---

## Programar Backup Automático

```bash
# Abrir crontab
crontab -e

# Backup diario a las 3:00 AM
0 3 * * * /home/ubuntu/argentinacraft/deployment/backup.sh >> /home/ubuntu/backups/backup.log 2>&1

# Backup antes de reiniciar (semanal, domingo 2 AM)
0 2 * * 0 /home/ubuntu/argentinacraft/deployment/backup.sh
```

---

## Restaurar desde Backup

```bash
# 1. Detener el servidor
sudo systemctl stop argentinacraft

# 2. Extraer backup
tar -xzf /home/ubuntu/backups/ac_backup_FECHA.tar.gz -C /

# 3. Reiniciar servidor
sudo systemctl start argentinacraft

echo "✅ Restauración completa"
```

---

## Backup Manual (Windows/Aternos)

### Para Aternos:
1. En el panel → hacer clic en **"Backup"** (botón de descarga)
2. Descargar el `.zip` completo
3. Guardar con nombre: `ac_backup_YYYY-MM-DD.zip`

### Para Windows (PowerShell):
```powershell
# Crear backup en Windows
$date = Get-Date -Format "yyyy-MM-dd"
$source = "C:\Users\PC\Universo Noah\ArgentinaCraft"
$dest = "C:\Users\PC\Universo Noah\Backups\ac_backup_$date.zip"

Compress-Archive -Path "$source\worlds", "$source\plugins\ArgentinaCraft_Core\players" `
                 -DestinationPath $dest

Write-Host "✅ Backup guardado en: $dest"
```

---

## Política de Retención

| Tipo | Cuántos guardar |
|------|----------------|
| Backups diarios | 7 días |
| Backups semanales | 4 semanas |
| Backups mensuales | 3 meses |
| Antes de updates | Siempre |

---

*Ver también: [ORACLE_DEPLOYMENT.md](ORACLE_DEPLOYMENT.md) | [SERVER_SETUP.md](SERVER_SETUP.md)*
