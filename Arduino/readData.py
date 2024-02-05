import serial
import time
from datetime import datetime

# Replace 'COM3' with your Arduino's port
ser = serial.Serial('COM3', 9600, timeout=1)

try:
    while True:
        if ser.in_waiting > 0:
            # Read one line from the Serial output
            line = ser.readline().decode('utf-8').strip()
            dte = datetime.now()
            id = 81818
            
            # Print the received line
            # if int(line) < 10:
            print(line)
            print(dte)

        time.sleep(1)

except KeyboardInterrupt:
    ser.close()
    print("Serial connection closed.")
