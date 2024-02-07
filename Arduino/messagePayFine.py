from twilio.rest import Client
import os
import time
from dotenv import load_dotenv

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

# Define your variables
variable1 = "Hello"
variable2 = 42

# Main part
if recipient_phone_number:
    sms_message = f"You have succesfully paid the fine."
    send_sms(sms_message, recipient_phone_number)
else:
    print("Recipient phone number is not provided. SMS not sent.")
