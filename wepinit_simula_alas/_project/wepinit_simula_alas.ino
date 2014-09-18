/*

  Codigo baseado no exemplo "Button State Change Detection (Edge Detection)"
  que pode ser encontrado no site oficial do Arduino: http://arduino.cc/en/Tutorial/ButtonStateChange
  e Lab de Garagem.

*/

#include <LiquidCrystal.h>

#define AMARELA  2
#define VERMELHA 3
#define AZUL     4
#define VERDE    5

const int aSize = 4; // tamanho do vetor
const int buttonPin[aSize] = {AMARELA, VERMELHA, AZUL, VERDE}; // vetor com os valores dos pinos dos botoes
//const int ledPin = 13;

LiquidCrystal lcd(12, 11, 10, 9, 8, 7);

int buttonState[aSize] = {0, 0}; // vetor contendo os estados dos botoes: 1 = ligado e 0 = desligado
int lastButtonState[aSize] = {0, 0};//
int alaAtual = AMARELA; // Ala ativada
int alaAnterior = AMARELA; // Ultima ala setada

void setup(){
  int i;
  
  // acende o texto do display
  pinMode(13, OUTPUT);
  
  lcd.begin(16, 2);
  lcd.setCursor(0, 0);
  lcd.print("Woodino-WePinIt!");
  lcd.setCursor(0, 1);
  lcd.println("Selecione a ala.");
  
  for(i=0; i < aSize; i++){
      // ativa cada botao presente no array
      pinMode(buttonPin[i], INPUT);
  }
  
  //pinMode(ledPin, OUTPUT);
  Serial.begin(9600);
}

void loop(){
  int i;
  
  for (i = 0; i < aSize; i++){
    //leitura do estado de cada botao
    buttonState[i] = digitalRead(buttonPin[i]);
    // compara cada botao com seu estado anterior
    if (buttonState[i] != lastButtonState[i]){
        alaAtual = buttonPin[i];
        //Serial.println("Estado do botao:");
        //Serial.println(i+1);  
        
        if (buttonState[i] == HIGH){
          //Serial.println("on");
          //Serial.println("------------------");
        }
     else{
          //Serial.println("off");
          //Serial.println("------------------");
     }
    }
    
    if (alaAnterior != alaAtual){
        alaAnterior = alaAtual;
        
        analogWrite(13, HIGH);
      
        lcd.clear();
        lcd.setCursor(0, 0);
        lcd.print("Woodino-WePinIt!");
       
        lcd.setCursor(0, 1);
        lcd.print("Ala:");
        lcd.setCursor(6, 1);
                
        switch(alaAtual){
          case AMARELA:
              lcd.print("Amarela");
              break;
          case VERMELHA:
              lcd.print("Vermelha");
              break;
          case AZUL:
              lcd.print("Azul");
              break;
          case VERDE:
              lcd.print("Verde");
              break;
        }
              
       Serial.println("Ala atual:");
       Serial.println(alaAtual);
    }
    
    lastButtonState[i] = buttonState[i];
  }
  
  delay(10);
}
