#!/usr/bin/python
# Import required
from flask import Flask, make_response, request
import sys

# Change your secret below
myAddress = "1LisLsZd3bx8U1NYzpNHqpo8Q6UCXKMJ4z"
mySecret = "7j0ap91o99cxj8k9"
callbackPage = "callback?secret=" + mySecret

# Define our app with Flask
app = Flask(__name__)

POST={}

# The page we should check callbacks
@app.route(callbackPage, methods=['POST'])
def checkCallback():
    return 'Home page'


@app.route(callbackPage, methods=['GET', 'POST'])
def result():

	if request.method == 'GET':
		# Get requests
		# Get the secret from the url
		secretFromClient = request.args.get('secret')
		# Make sure our secrets match
		if secretFromClient != mySecret
			sys.exit() # Exit here at the secre was not correct

	else:
		# Post requests
		postInvoiceId = request.form['invoice_id']
		postInputAddress = request.form['input_address']
		postInputHash = request.form['input_transaction_hash']
		postTransactionHash = request.form['transaction_hash']
		postValue = request.form['value']
		postConfirms = request.form['confirmations']

		# Now do your database insertion or however you would like to handle this data above
