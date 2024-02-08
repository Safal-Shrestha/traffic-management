import serial
import mysql.connector
import time
from datetime import datetime
# For twilio
from twilio.rest import Client
import os
from dotenv import load_dotenv

# Replace 'COM3' with your Arduino's port
ser = serial.Serial('COM3', 9600, timeout=1)

#MySQL server details
host = "localhost"
user = "root"
password = ""
database = "kist_fest"

# Establish a connection to the MySQL server
connection = mysql.connector.connect(
    host=host,
    user=user,
    password=password,
    database=database
)

# Replace "your_table" with the actual table name where you want to insert data
table_name = "traffic_fine"

# Create a cursor object to interact with the database
cursor = connection.cursor()

# Load environment variables from .env file
dotenv_path = os.path.join(os.path.dirname(__file__), 'creds.env')
load_dotenv(dotenv_path)

# Twilio credentials
account_sid = os.getenv('TWILIO_ACCOUNT_SID')
auth_token = os.getenv('TWILIO_AUTH_TOKEN')
twilio_phone_number = os.getenv('TWILIO_PHONE_NUMBER')
recipient_phone_number = os.getenv('RECIPIENT_PHONE_NUMBER')

# Function to send SMS using Twilio
def send_sms(message, to_phone_number):
    client = Client(account_sid, auth_token)
    
    message = client.messages.create(
        body=message,
        from_=twilio_phone_number,
        to=to_phone_number
    )

    print(f"SMS sent successfully. SID: {message.sid}")

try:
    while True:
        if ser.in_waiting > 0:
            # Read one line from the Serial output
            line = ser.readline().decode('utf-8').strip()
            dte = datetime.now()
            id = 81818
            fine = 100
            
            # Print the received line
            if int(line) > 100:
                # Example data from your Arduino
                arduino_data = {
                    'id': 2,
                    'speed': line,
                    'time' : dte,
                    'fine' : fine
                }

                # Construct the SQL query
                insert_query = f"INSERT INTO {table_name} (id, speed, time, fine) VALUES (%s, %s, %s, %s)"

                # Execute the query with the data from the Arduino
                cursor.execute(insert_query, (arduino_data['id'], arduino_data['speed'], arduino_data['time'], arduino_data['fine']))

                # Commit the changes to the database
                connection.commit()
                # Main part
                if recipient_phone_number:
                    sms_message = f"You broke the speed limit on {dte}. Your speed was {line}. You are requested to go to visit the website to pay Rs. {fine}"
                    send_sms(sms_message, recipient_phone_number)
                else:
                    print("Recipient phone number is not provided. SMS not sent.")
                
                


        time.sleep(1)

except KeyboardInterrupt:
    ser.close()
    print("Serial connection closed.")
