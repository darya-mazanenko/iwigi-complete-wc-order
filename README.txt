## IWIGI Complete WC Order

**Description** 

This plugin is a custom solution for a client request to complete orders from direct form the New Order email notification.

It allows to change an order status from 'Processing' to 'Completed' by clicking 'Complete This Order' link that placed before Order Details Table in the email notification. 

When the order is completed the message 'Order is completed' is displayed with a link to a website home page.


**A bit more information about the plugin** 

The website orders are sync with the Click & Drop app from Royal Mail. 

When an order is shipped by Royal Mail the order status is changed to Completed on the website by Click & Drop automatically. 

The issue is if an order is shipped by another courier (i.e. DPD or Hermes), the order doesn't receive this update and its status remains *Processing*. 

As Click & Drop sync orders on a website every 15-30min, all *Processing* orders go there. So *our order* that has been shipped with another courier already appears again and again on the system.

The only way to stop it from appearing is to change this order status to *Completed* on the website manually. And the most convenient way for my client is to do it from the email and without logging the website.

**How it works**

1. 'Complete This Order' link contains the order number and a security token which stores as a post meta of the order
2. The link opens a page on the website that checks if the token in the link is the same as the post meta value
3. The order status is changed to Completed and meta key is deleted to prevent an attempt to competed the same order again.




