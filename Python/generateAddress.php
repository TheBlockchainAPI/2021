# Importing the requests library 
import requests 
  
# Api-endpoint 
URL = "https://blockchainapi.org/api/btc?method=create"
  
# Parameters 
myAddress = "1LisLsZd3bx8U1NYzpNHqpo8Q6UCXKMJ4z"
mySecret = "7j0ap91o99cxj8k9"
myCallback = "http://example.com/callback?invoice_id=1234&secret=" + mySecret
  
# Defining a params dict for the parameters to be sent to the API 
PARAMS = {'address':myAddress, 'callback':myCallback} 
  
# Sending get request and saving the response as response object 
r = requests.get(url = URL, params = PARAMS) 
  
# Extracting data in json format 
data = r.json() 
  
# Extracting input_address & estimated_transaction_fee
input_address = data['success']['input_address']
estimatedFee = data['success']['estimated_transaction_fee']
  
# Printing the output 
print("Please pay to the following address: %s\nThe estimated fee in BTC is: %s"
      %(input_address, estimatedFee)) 
