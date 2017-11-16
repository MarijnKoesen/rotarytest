#include "RotarySwitch.h"
#include <Arduino.h>

RotarySwitch::RotarySwitch(int pinA, int pinB)
{
  this->pinA = pinA;
  this->pinB = pinB;

  pinMode(pinA, INPUT_PULLUP);
  pinMode(pinB, INPUT_PULLUP);

  // Update twice so we have sane values in both states
  update();
  update();
}

void RotarySwitch::update()
{
  previousState[0] = currentState[0];
  previousState[1] = currentState[1];
  
  currentState[0] = digitalRead(pinA) ? '0' : '1';
  currentState[1] = digitalRead(pinB) ? '0' : '1';
}

bool RotarySwitch::hasBeenTurned()
{
  return currentState[0] != previousState[0] || currentState[1] != previousState[1];
}


int RotarySwitch::getDirection()
{
  if (!hasBeenTurned()) {
    return NOT_TURNED;
  }
     
  if (previousState[0] == previousState[1]) {
    return previousState[0] == currentState[0] ? CLOCKWISE : COUNTER_CLOCKWISE;
  }

  // In the otherc ase we check which way the last character moved
  return previousState[1] == currentState[0] ? CLOCKWISE : COUNTER_CLOCKWISE;
}
