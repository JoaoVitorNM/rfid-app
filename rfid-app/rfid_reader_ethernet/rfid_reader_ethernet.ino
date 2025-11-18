#include <SPI.h>
#include <MFRC522.h>
#include <Ethernet.h>

#define SS_PIN 10
#define RST_PIN 9
MFRC522 rfid(SS_PIN, RST_PIN);

byte mac[] = { 0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED };
IPAddress ip(192, 168, 0, 177);
IPAddress server(192, 168, 0, 100);

EthernetClient client;

void setup() {
  Serial.begin(9600);
  SPI.begin();
  rfid.PCD_Init();
  Ethernet.begin(mac, ip);

  Serial.println("RFID Reader Iniciado");
}

void loop() {
  if (!rfid.PICC_IsNewCardPresent()) return;
  if (!rfid.PICC_ReadCardSerial()) return;

  String uid = "";
  for (byte i = 0; i < rfid.uid.size; i++)
    uid += String(rfid.uid.uidByte[i], HEX);

  uid.toUpperCase();
  Serial.println("UID: " + uid);

  if (client.connect(server, 80)) {
    client.print("GET /rfid-app/public/api_log.php?uid=" + uid +
                 "&location=Entrada HTTP/1.1\r\nHost: ");
    client.print(server);
    client.print("\r\nConnection: close\r\n\r\n");
    client.stop();
  }

  delay(1500);
}
