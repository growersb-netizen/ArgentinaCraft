# ✅ Checklist de Deploy en Oracle Cloud

## Pre-Deploy
- [ ] Cuenta Oracle Cloud creada
- [ ] Verificación de tarjeta de crédito completada (no se cobra)
- [ ] Seleccionar región: São Paulo (sa-saopaulo-1)

## Infraestructura
- [ ] VM creada (VM.Standard.A1.Flex, 2 OCPUs, 2 GB RAM)
- [ ] Clave SSH descargada y guardada
- [ ] IP pública anotada
- [ ] Regla de seguridad UDP 19132 abierta

## Software
- [ ] Ubuntu 22.04 actualizado
- [ ] PHP 8.2 instalado con extensiones
- [ ] PocketMine-MP.phar descargado
- [ ] Script start.sh configurado

## ArgentinaCraft
- [ ] Archivos subidos via SCP
- [ ] Plugin instalado
- [ ] Configuración ajustada para producción
- [ ] Systemd service configurado
- [ ] Servidor arranca automáticamente

## Seguridad
- [ ] UFW configurado (solo 22/tcp y 19132/udp abiertos)
- [ ] SSH con llave (no contraseña)
- [ ] Fail2ban instalado

## Backup
- [ ] Script backup.sh configurado
- [ ] Crontab configurado (backup diario 3 AM)
- [ ] Primer backup manual creado

## Testing
- [ ] Conectar desde múltiples dispositivos
- [ ] Mobile Android + iOS + Windows
- [ ] Verificar latencia desde Argentina
- [ ] Load test con varios jugadores simultáneos
