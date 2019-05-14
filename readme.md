**Show Albums**
----
  Returns json data of 100 albums by default.

* **URL**

  /api/v1/albums/

* **Method:**

  `GET`
  
*  **URL Params**

   **Required:**
 
    None

* **Data Params**

  None

* **Success Response:**

  * **Code:** 200 <br />
    **Content:** `{
        "data": [
        {
            "itunes_id": 932648190,
            "name": "The Platinum Collection (Greatest Hits I, II & III)",
            "title": "The Platinum Collection (Greatest Hits I, II & III) - Queen",
            "artist_label": "Queen",
            "artist_href": "https://itunes.apple.com/us/artist/queen/3296287?uo=2",
            "item_count": 51,
            "price": "$6.99",
            "rights": "℗ 2014 Hollywood Records, Inc.",
            "link": "https://itunes.apple.com/us/album/the-platinum-collection-greatest-hits-i-ii-iii/932648190?uo=2"
        }
        ]`
 
* **Error Response:**

  * **Code:** 404 NOT FOUND <br />
    **Content:** `{ error : "" }`

 
* **Sample Call:**

  ```javascript
    $.ajax({
      url: "/api/v1/albums/",
      dataType: "json",
      type : "GET",
      success : function(r) {
        console.log(r);
      }
    });
  ```