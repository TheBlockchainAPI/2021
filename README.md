# BlockchainAPI.org [2021]
Our brand new API is now out, introduced in 2021!
Our system has had a complete re-write, introducing new features, faster servers, better methods, brand new design and much more!

BlockchainAPI.org allows you to sell your goods through our automated payment API.
Simply go to our API endpoint, enter your address you'd like the funds to go to along with your callback url and you'll be able to generate an address for your customers to pay to.

Any payments will then be forwarded to your Bitcoin address you entered first, once our system has made the correct checks and sent requests to your callback url.
Our system will only count the callback url request as a success when your code returns a HTTP status code of 200.
If your callback url is not valid and returns anything other than a 200 response, your callbacks amount will add up inside the bad_callbacks.
If your bad_callbacks hits 6, our system will not longer send requests to your url.
The same applies for when a payment has had 6 confirmations or more... we will stop sending at 6 confirms.

For a full guide, check out https://blockchainapi.org/guide.

To read our BTC documentation, go to https://blockchainapi.org/docs/btc.

 
