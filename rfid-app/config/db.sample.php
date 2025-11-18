mkdir -p src/config
cat > src/config/db.sample.php << 'EOF'
<?php
// Exemplo de configuração.
$host = "localhost";
$user = "root";
$pass = "";
$conn_students = new mysqli($host, $user, $pass, "rfid_students");
$conn_tags = new mysqli($host, $user, $pass, "rfid_tags");
EOF
