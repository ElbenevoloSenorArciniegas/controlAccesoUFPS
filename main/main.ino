#include <ESP8266WiFi.h>

// ################################### Connect to wifi ###########################################################################

const char* ssid = "Movistar_75820536";
const char* password = "paguenwifiratas";

int WiFiCon() {
    // Check if we have a WiFi connection, if we don't, connect.
  int xCnt = 0;

  if (WiFi.status() != WL_CONNECTED){

        Serial.println();
        Serial.println();
        Serial.print("Connecting to ");
        Serial.println(ssid);

        WiFi.mode(WIFI_STA);
        
        WiFi.begin(ssid, password);
        
        while (WiFi.status() != WL_CONNECTED  && xCnt < 50) {
          delay(500);
          Serial.print(".");
          xCnt ++;
        }

        if (WiFi.status() != WL_CONNECTED){
          Serial.println("WiFiCon=0");
          manageResponse(-3);
          return 0; //never connected          
        } else {
          Serial.println("WiFiCon=1");
          Serial.println("");
          Serial.println("WiFi connected");  
          Serial.println("IP address: ");
          Serial.println(WiFi.localIP());
          return 1; //1 is initial connection
        }

  } else {
//    Serial.println("WiFiCon=2");
    return 2; //2 is already connected
  
  }
}

// ################################### Read RFID TAG ###########################################################################

#include <SPI.h>
#include <MFRC522.h>
#define SS_PIN D2
#define RST_PIN D1

MFRC522 mfrc522(SS_PIN, RST_PIN); // Instance of the class

void leer(){
  if ( mfrc522.PICC_IsNewCardPresent())
    {
        if ( mfrc522.PICC_ReadCardSerial())
        {          
           Serial.print("Tag UID: ");
           String tag = "";           
           for (byte i = 0; i < mfrc522.uid.size; i++) {
                  //tag += mfrc522.uid.uidByte[i] < 0x10 ? " 0" : "-";
                  tag += String(mfrc522.uid.uidByte[i], HEX);                  
                  //Serial.print(mfrc522.uid.uidByte[i] < 0x10 ? " 0" : "-");
                  //Serial.print(mfrc522.uid.uidByte[i], HEX);
            }
            delay(250);
            Serial.println(tag);
            postData(tag);
            Serial.println();
            mfrc522.PICC_HaltA();
        }
}
}


// ################################### Send data by Get ###########################################################################

//IP or name of address root: ie: google.com
//NOT google.com/nothing/after/the/dotcom.html
const char* hostGet = "controlaccesoufps.000webhostapp.com"; 


void postData(String rfid) {

   WiFiClient clientGet;
   const int httpGetPort = 80;

   //the path and file to send the data to:
   String urlGet = "/ControlAccesoUFPS/collector.php";

 
  // We now create and add parameters:  
  String entrada = "TE000";

  urlGet += "?rfid=" + rfid + "&entrada=" + entrada;
   
      Serial.print(">>> Connecting to host: ");      
      Serial.println(hostGet);
      delay(1000);
       if (!clientGet.connect(hostGet, httpGetPort)) {
        Serial.print("Connection failed: ");
        Serial.println(hostGet);
        manageResponse(-2);
      } else {          
          clientGet.println("GET " + urlGet + " HTTP/1.1");
          clientGet.print("Host: ");
          clientGet.println(hostGet);
          clientGet.println("User-Agent: ESP8266/1.0");
          clientGet.println("Connection: close\r\n\r\n");
          
          unsigned long timeoutP = millis();
          while (clientGet.available() == 0) {
            if (millis() - timeoutP > 10000) {
              Serial.print(">>> Client Timeout: ");
              Serial.println(hostGet);
              clientGet.stop();
              return;
            }
          }

          //just checks the 1st line of the server response. Could be expanded if needed.
          Serial.println("Response:");          
          while(clientGet.available()){
            String retLine = clientGet.readStringUntil('\n');
            int i = retLine.lastIndexOf("respuesta");
            if(i>-1){
              int rta= retLine.substring(i+9).toInt();
              Serial.println(rta);
              manageResponse(rta);
              break;
            }      
          }
      } //end client connection if else
                        
      Serial.print(">>> Closing host: ");
      Serial.println(hostGet);
          
      clientGet.stop();

}

// ################################### Managing response ########################################################################

#define LED_BUILTIN 2
//Aparentemente el high y el low están al revés, se supone que si r>0 ? HIGH : LOW pero está funcionando al revés. Voy a cambiarlos.
void manageResponse(int r){

int READY = 2;
int AUTHORIZED = 1;
int UNAUTHORIZED = 0;
int SERVER_EXCEPTION = -1;
int SERVER_CONNECTION_FAILED = -2;
int WIFI_CONNECTION_FAILED = -3;

  if(r == READY){
    for(byte i = 0; i < 2; i++){      
      delay(1000);
      digitalWrite(LED_BUILTIN, LOW);
      delay(1000);
      digitalWrite(LED_BUILTIN, HIGH);
    }
  }else if(r == AUTHORIZED){
    
    digitalWrite(LED_BUILTIN, LOW);
    delay(1000);
    digitalWrite(LED_BUILTIN, HIGH);

  digitalWrite(1, HIGH);
  delay(3000);
  digitalWrite(1, LOW);
    
  }else if (r == UNAUTHORIZED){
    
    digitalWrite(LED_BUILTIN, HIGH); //Lo sé, es redundante, pero shhhhh
    
  }else if (r == SERVER_EXCEPTION){
    for(byte i = 0; i < 3; i++){
      digitalWrite(LED_BUILTIN, LOW);
      delay(500);
      digitalWrite(LED_BUILTIN, HIGH);
    }
  }
  else if (r == SERVER_CONNECTION_FAILED){
    for(byte i = 0; i < 5; i++){
      delay(200);
      digitalWrite(LED_BUILTIN, LOW);
      delay(200);
      digitalWrite(LED_BUILTIN, HIGH);
    }
  }
  else if (r == WIFI_CONNECTION_FAILED){
    for(byte i = 0; i < 10; i++){
      delay(100);
      digitalWrite(LED_BUILTIN, LOW);
      delay(100);
      digitalWrite(LED_BUILTIN, HIGH);
    }
  }
}


// ################################### Setup and loop ###########################################################################

void setup() {
  
   pinMode(LED_BUILTIN, OUTPUT);
   pinMode(1, OUTPUT);
   digitalWrite(LED_BUILTIN, HIGH);
  
  Serial.begin(9600);
  WiFiCon();
  
  SPI.begin();       // Init SPI bus
   mfrc522.PCD_Init(); // Init MFRC522
   delay(25);
   Serial.println("RFID reading UID");   
   manageResponse(2);
}

void loop() {

  if (WiFiCon() > 0) {
    leer();
  }
//Serial.println("Loop");
  delay(5000); 
}
