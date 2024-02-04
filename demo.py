import serial
import time

# Replace 'COM3' with your Arduino's port
ser = serial.Serial('COM6', 9600, timeout=1)

try:
    while True:
        if ser.in_waiting > 0:
            # Read one line from the Serial output
            line = ser.readline().decode('utf-8').strip()
            
            # Print the received line
            print(line)

        time.sleep(1)

except KeyboardInterrupt:
    ser.close()
    print("Serial connection closed.")
