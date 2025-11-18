# rfid-app
Sistema de Controle de Acesso RFID


---

## ⚠️ Segurança / Boas práticas (IMPORTANTE)
- **NUNCA** comite suas credenciais de banco (`config/db.php` com usuário/senha) em repositórios públicos.
- Use um arquivo `config/db.sample.php` ou `.env.example` no repo e configure `config/db.php` localmente (ou via variáveis de ambiente).
- Se precisar armazenar imagens pesadas ou binários, use **Git LFS**.

---

## ✅ Requisitos (ambiente de desenvolvimento)
- Ubuntu 24.04 (ou similar)
- Apache2, PHP (>=8.x), PHP mysqli extension
- MariaDB (server + client)
- Arduino IDE (ou PlatformIO) + suporte ESP32
- Bibliotecas Arduino: `MFRC522`, `SPI` (ESP32 boards)

---

## 🔧 Instalação (Servidor Linux — Ubuntu 24.04)
1. Atualizar e instalar pacotes:
```bash
sudo apt update
sudo apt install apache2 mariadb-server mariadb-client php libapache2-mod-php php-mysql unzip -y
