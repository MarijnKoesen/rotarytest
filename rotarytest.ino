#include "RotarySwitch.h"
RotarySwitch rotarySwitch(7, 8);

void setup() {
  // Start the serial monitor for debugging
  Serial.begin(9600);
} 

void loop()
{
  rotarySwitch.update();
  if (rotarySwitch.hasBeenTurned()) {
    Serial.println(rotarySwitch.getDirection() == 1 ? "Clockwise" : "Counter clockwise");
  }
  
  delay(5);
}
