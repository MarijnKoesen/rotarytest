#ifndef ROTARY_SWITCH_H
#define ROTARY_SWITCH_H

class RotarySwitch
{
	public:
		RotarySwitch(int pinA, int pinB);
		void update();
		bool hasBeenTurned();
		int getDirection();

	private:
    int pinA;
    int pinB;
		char previousState[2];
		char currentState[2];
};

#endif
