# 5203-Paypal-API
[Paypal API](https://developer.paypal.com/docs/api/overview/) using [sandbox account](https://developer.paypal.com/docs/api-basics/sandbox/) to authorize the payment for an arbitrary product, and then show confirmation to the buyer.

- [x] First the user is shown the link for the payment along with the order number. The user clicks that link, and is then asked to enter his username and password, and then authorize the payment. 
- [x] Once the payment has been authorized, the user is then shown payment confirmation message. The Order ID in the confirmation message is fetched from the URL query string.

**Client URL (Curl)** is used to send the requests. Curl is a library, which enables the API to make connections using HTTPS, and is used for sending and retrieving files using URL syntax.

Users needs to gets the client_id and client_secret values (line 11-12 of the index.php file) themselves from their the Paypal API account.

## Screenshots

![indexPage](https://user-images.githubusercontent.com/58306478/119242800-09f76f80-bb2f-11eb-9ae1-32fa8aed92e0.jpg)

![paymentConfirmation](https://user-images.githubusercontent.com/58306478/119242802-0bc13300-bb2f-11eb-99ab-79d83fa414e8.jpg)

![thankyouMsg](https://user-images.githubusercontent.com/58306478/119242803-0cf26000-bb2f-11eb-90a4-744f801ebdd2.jpg)
