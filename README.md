# shopgasm
A content management system for online shopping website.


This website is made by @tsamridh86, @vatsal-sodha and @ShivangPrajapati.

Navigation:
1. Home Page.
2. Search Page.
3. Checkout Page.
4. Administrator Page.
5. Login / Logout System.
6. Filter
7. Cart
8. Database
9. Technology used
10. Setup Details

#1. Home Page
  The website begins with the home page, shows the user latest arrived items,the fast-selling item  and the most cost-effective items. The topmost navigation bar has the options to search, which will lead to the search page(Jump to topic 2 for search page), alongwith the options to login (Jump to topic 5 for login system) and to view cart(Jump to topic 7 for cart details).
  
#2. Search Page
  The search page can be reached by typing a query on the navigation bar on the home page. This page is very much similar to the home page, with the extra addition of an filter. (Jump to topic 6 for filter details.) Searching on this page causes it to redirect itself to this same page itself, with the new base query.
  
#3. Checkout Page
  The checkout page is reached after the user has clicked on "checkout" on the cart.(Jump to topic 7 for cart). The checkout page gets all the items on the cart, and then multiplies it with the quantity user wants, sums them up and displays to the user for final approval. The number of items purchased may not exceed 10 or the remaining quantity.
  The sum of total of items in the cart is calculated here by :
    For each item i:
      total = total + ( quantity(i) * price(i))

#4. Administrator Page
  This page can be exclusively reached by the admin only, to enter the admin page, one must provide:
  user name : admin 
  password : admin123
  during login. This redirects it to the admin page, where, the admin can, 
  (i). insert items into the database.
  (ii). update the items in the database.
  (iiI). delete the items in the database.
  (iv). view all the items in the database.
  (v). view all the orders placed on the database.
  (vi). view all the users registered in the website.
  
 #5. Login / Logout system.
    This menu can be accessed by clicking on the user icon available on the home page and the search page.
    There are 2 options in this menu, one is for sign up for new users and login for old user.
    Each new users must choose a unique username which is automatically checked by AJAX script working on the webpage, which shows a thumbs up if the user name is unique and thumbs down otherwise. The password that is entered by the user is kept secure by running an md5 cryptographic hashing function. 
    Old users simply have to enter thier old user name and passwords to get access to thier accounts.
    Specifically upon typing the user name as admin and the password as admin123, the user can gain access into the administrator account. (Jump to topic 4 for admin page).
    
    
#6. Filter
  The filter is only available in the search page. This feature can be accessed by clicking on the filter button on the navigation bar, this opens up a side navigation bar on the left of the page. This menu futher allows the user to sort and filter the products by :
(i) brand
(ii) price
(iii) category
The filtered results are temporarily saved and will be used again in the next search, however upon leaving the page, the search criterias are lost.

#7. Cart
  This feature is only accessible by the users that have been logged in, any unregistered user will be given the prompt to sign up to access this feature. This features allows the user to add items to thier shopping cart for a bulk purchase later. This feature is available on the home page and on the search page, and can be accessed by clicking on the shopping cart icon in the top navigation bar.
  
 #8. Database
    The database contains of 4 tables.
    (i) cart : which has the temporary data of the user saved.
    (ii) users: the table of users
    (iii) products : the table of all the products on the page.
    (iv) orders : the table of the all the orders that have been placed.
    
 #9. Techonology Used:
  i. HTML5
  ii. CSS3
  iii. materialize.css framework (CSS)
  iv. JavaScript
  v. jQuery
  vi. jQuery-ajax
  vii. PHP
  viii. MySQL (database).
  
#10. Setup Details
  This project requires the need of a web server and web browser.
  To setup on the server side :
  i.   install and run xampp server
  ii.  download the folder into xampp/htdocs
  iii. open localhost/phpmyadmin
  iv.  run query : create database shopgasm
  v.   import the database.
  vi.  add the items on the admin page, and you are ready to go.
  
  To run the webpage on the client side.
  i.   open the web browser
  ii.  localhost/shopgasm
  iii. hostedURL/shopgasm
