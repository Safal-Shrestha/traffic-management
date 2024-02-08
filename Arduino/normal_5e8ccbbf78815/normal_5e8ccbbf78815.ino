const int trigPin = 8;
const int echoPin = 10;
int distance_prev = 0;
int sp = 0;
float duration, distance, time_difference;

void setup() {
  pinMode(trigPin, OUTPUT);
  pinMode(echoPin, INPUT);
  Serial.begin(9600);
}

void loop() {
  digitalWrite(trigPin, LOW);
  delayMicroseconds(2);
  digitalWrite(trigPin, HIGH);
  delayMicroseconds(10);
  digitalWrite(trigPin, LOW);
  duration = pulseIn(echoPin, HIGH);
  distance = (duration * 0.0343) / 2;
  
  time_difference = 1.0;// set your desired time difference in seconds
  sp = (distance_prev - distance) / time_difference;

  //Serial.print("Speed: ");
  Serial.println(sp);

  delay(1000);
  distance_prev = distance;
}
