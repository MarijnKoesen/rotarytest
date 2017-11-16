// Pin definitions
const int pinA = 7;
const int pinB = 8;
char previousState[2] = "00";
char thisState[2] = "00";

void setup() {
  // set the two pins as inputs with internal pullups
  pinMode(pinA, INPUT_PULLUP);
  pinMode(pinB, INPUT_PULLUP);

  previousState[0] = digitalRead(pinA) ? '0' : '1';
  previousState[1] = digitalRead(pinB) ? '0' : '1';
  
  // Start the serial monitor for debugging
  Serial.begin(9600);
} 

int getDirection(char previousState[], char currentState[]) {
  if (previousState[0] == currentState[0] && previousState[1] == currentState[1]) {
    return 0;
  }
     
  if (previousState[0] == previousState[1]) {
    return previousState[0] == currentState[0] ? 1 : -1;
  }

  // In the otherc ase we check which way the last character moved
  return previousState[1] == currentState[0] ? 1 : -1;
}


void loop()
{
  thisState[0] = digitalRead(pinA) ? '0' : '1';
  thisState[1] = digitalRead(pinB) ? '0' : '1';

  int encoderDirection = getDirection(previousState, thisState);
  if (encoderDirection != 0) {
    Serial.println(encoderDirection == 1 ? "Clockwise" : "Counter clockwise");
  }

  previousState[0] = thisState[0];
  previousState[1] = thisState[1];
  
  delay(5);
}
