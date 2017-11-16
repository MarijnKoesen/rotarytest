#ifndef ROTARY_SWITCH_H
#define ROTARY_SWITCH_H

class RotarySwitch
{
	public:
		RotarySwitch(int pinA, int pinB);
		void update();
		bool hasBeenTurned();
		int getDirection();

    static const int COUNTER_CLOCKWISE = -1;
    static const int NOT_TURNED = 0;
    static const int CLOCKWISE = 1;

	private:
    int pinA;
    int pinB;
		char previousState[2];
		char currentState[2];
};

#endif
