### Web and API nodes:
API's
-
* Users
    > ##### Users Sign In  
    - [X] <a>post</a>  /api/v1/users/signin
        * Request
            ```json
            {
                "email":"user@example.com",
                "password":"password"
            }
            ```
        * Response 
            ```json
            {
                "token": "__TOKEN__ IF SUCCESS",
                "msg": "__MESSAGE_TEXT__",
                "error": "___ERROR_VALUE__"
            }
            ```

            
   > ##### Users Sign Out  
   - [X] <a>get</a>  /api/v1/users/logout?token=TOKEN
        * Request
            - no data required
        * response
        ```json
            {
                "msg": "Successfully Logout",
                "error": "0"
            }
        ```
            


   > ##### New user Sign Up
   - [x] <a>post </a> /api/v1/users/signup
        * Request
        ```json
        {
            "name":"Moustafa elgammal",
            "username":"elgammalx",
            "email": "elgammal@me.me",
            "phone": "01204054219",
            "address": "Doki",
            "group": 1 -> admin; 2 ->  enginee; doctor -> 3; company -> 4;
            "password": "Notebook$3",
            "city": 1 for cairo  2 for alex
        }
        ```
        * Response
            ```json
            {
              "msg":"__MESSAGE__",
              "error":"__ERROR_VALUE__"
            }
            ```


   > ##### Add Credits to user
   - [x] <a>post </a> /api/v1/users/credits?token=TOKEN
        * Request
            ```json
            {
                "hash":"CARD-HASH"
            }
            ```
        * Response 
        
            ```json
            {
              "msg":"__MESSAGE_TEXT__",
              "credits":"__CURRENT_BALANCE_ IF OPERATION SUCCESSED",
              "error":0 
            }
            ```



   > ##### Get User Profile
   - [x] <a>get </a> /api/v1/users/profile?token=TOKEN
        * Request
            - Not data neaded.
        * Response
            ```json
            {
                "msg": "User Found",
                "data": {
                    "id": 54,
                    "name": "__NAME__",
                    "email": "__EMAIL",
                    "status": 0,
                    "group_id": 0,
                    "lat":"__lat___",
                    "lng":"__lng",
                    "balance": "__USER__CREDITS__",
                    "pics_uploaded": 1,
                    "phone": "__PHONE__",
                    "img": "__LINK__",
                    "created_at": "__TIME_STAMP__",
                    "updated_at": "__TIME_STAMP__"
                },
                "error": "0"
            }
            ```


   > ##### Update User basic info.
   - [x] <a>post </a> /api/v1/users/update?token=TOKEN
     * Request
        ```json
             {
              "email":"user@example.com",
              "name":"name",
              "phone":"phone",
               "lat": "__lat__",
               "lng": "__lng__"
            }
        ```
        * Response 
            ```json
            {
                "msg": "User Found",
                "data": {
                    "id": 1,
                    "name": "NAME",
                    "email": "USER@EXAMPLE.COM",
                    "status": 1,
                    "group_id": 1,
                    "balance": "USER-CREDITS",
                    "pics_uploaded": 1,
                    "phone": "PHONE",
                    "img": "LINK",
                    "created_at": "2017-10-17 14:53:17",
                    "updated_at": "2017-10-17 14:53:17"
                },
                "error": "0"
            }
            ```


   > ##### Update User password.
   - [x] <a>post </a> /api/v1/users/password?token=TOKEN
        * Request
             ```json
            {
              "password": "__VALUE",
              "password_confirm": "__THE_SAME_PASSWORD__"
            }
            ```
        * Response
            ```json
            {
              "msg": "__MESSAGE__TEXT__",
              "error": "__ERROR_VALUE__"
             }
            ```


   * Orders

   > ##### get engineers for orders

   - [x] <a href="#engineers">post </a> /api/v1/orders/engineers?city=__optoinal__&token=TOKEN

    *Response
```json
   {
    "msg": "Engineers",
    "engineers": {
        "1": {
            "id": 10,
            "name": "Moustafa elgammal",
            "username": "elga  'SELECT * FROME USERS'mmalx",
            "email": "elgamsdfmal@me.me",
            "phone": "01204054219",
            "address": "Doki",
            "group": 2,
            "token": null,
            "city": 1,
            "image": "",
            "status": 0,
            "deleted": 0,
            "created_at": "2018-04-29 06:46:50",
            "updated_at": "2018-04-29 06:46:50"
        },
        "3": {...}
    },
    "error": "0"
}
```

  >##### add order
    
- [X] <a>post</a>  api/v1/orders?token=__TOken__
  * Request
     ```json
        {
            "title": "test Order dkfjkf",
            "description": "sdkf sdklfjs dklfj sdklfj k",
            "engineer_id": "10"
        }
    ```

     * Response
    ```json
	    {
	    	"msg": "Order Has Been Created",
	    	"id": 28,
	    	"error": "0"
		}
	```
	
   > ##### Set order Image
  - [X] <a>post</a> /api/v1/orders/__id__/image?token=__TOKEN__


> ##### get order Info 
- [X] <a>get</a>  /api/v1/orders/__id__?token=__TOKEN__
  * reaponse 
  ```json 
     {
	    "msg": "Found",
	    "order": {
	        "id": 24,
	        "title": "test Order",
	        "description": "sdkf sdklfjs dklfj sdklfj k",
	        "image": "uploads/orders\\379d535db95673fe78236164ee0173152d6e470e.png",
	        "doctor_id": 11,
	        "engineer_id": 11,
	        "cost": null,
	        "cost_sender": null,
	        "cost_receiver": null,
	        "engineer_done": null,
	        "doctor_rate": null,
	        "engineer_rate": null,
	        "doctor_review": null,
	        "engineer_review": null,
	        "created_at": "2018-04-30 18:10:29",
	        "updated_at": "2018-04-30 18:30:40",
	        "deleted": 1
	    },
	    "error": "0"
	}
	```
	
    > ##### delete order

    - [X] <a>get</a>  /api/v1/orders/__id__/delete?token=__TOKEN__
    * response
    ```json
    {
    	"msg": "Order Has Been Deleted",
    	"error": "0"
	}
	```
* <a>Store</a>
     products
    
    > ##### add product
    - [X] <a>post</a>  api/v1/store/product?token=__token__
        * Request
            ```json
             {
             	"title": "new product",
             	"description": "desc of new product",
             	"price": 11.5,
             	"category_id":1,
             	"specialization_id":1
             }
            ```
         * Response
         ```json
         {
             "msg": "Product Has Been Created",
             "id": 15,
             "error": "0"
         }
         ```
    > ##### set product image 
     - [X] <a>post</a>  api/v1/store/product/__id__/image?token=__token__
    
    > ##### update product
     - [X] <a>post</a>  api/v1/store/product/15?token=__token__
         * Request
             ```json
              {
                "title": "update product",
                "description": "desc of new product",
                "price": 11.5,
                "category_id":1,
                "specialization_id":1
              }
             ```
          
          * Response
              ```json
              {
                  "msg": "Product Has Been Updated",
                  "error": "0"
              }
              ```
              
    > ##### delete product
     - [X] <a>delete</a>  api/v1/store/product/15?token=__token__
        * Response 
            ```json
    
               {
                   "msg": "Product Deleted",
                   "error": "0"
               }
             ```
             
     > ##### get a product by id 
     - [X] <a>get</a>  api/v1/store/product/13  
     
         * Response 
            ```json
           {
                 "msg": "products",
                 "product": {
                     "id": 13,
                     "title": "new product",
                     "description": "desc of new product",
                     "image": "image_route",
                     "owner_id": 10,
                     "specialization_id": 1,
                     "category_id": 1,
                     "created_at": "2018-05-10 20:27:45",
                     "updated_at": "2018-05-10 20:27:45",
                     "price": 11.5
                 },
                 "error": "0"
             }
            ```
     > ##### All products
     - [X] <a>get</a>  api/v1/store/product
     
         * Response 
            ```json
           {
                 "msg": "products",
                 "products": [
                         {
                             "id": 2,
                             "title": "product1",
                             "description": "sdfskdjfklsdfjsd",
                             "image": "dsfsdf",
                             "owner_id": 1,
                             "specialization_id": 1,
                             "category_id": 1,
                             "created_at": "2018-05-10 17:17:36",
                             "updated_at": "2018-05-10 17:17:36",
                             "price": 1.2,
                              "owner_name":"__Product_owner_name__"
                         },
                         {...},
                         {...},
                         {...},
                         {...},
                 "error": "0"
             }

            ```


* <a>Store</a>
     clinic
    
    > ##### add product
    - [X] <a>post</a>  api/v1/store/clinics?token=__token__
        * Request
            ```json
             {
             	"title": "new product",
             	"description": "desc of new product",
             	"image": "image_route",
             	"price": 11.5,
             	"category_id":1,
             	"specialization_id":1
             }
            ```
         * Response
         ```json
         {
             "msg": "Product Has Been Created",
             "id": 15,
             "error": "0"
         }
         ```
    > ##### set product image 
     - [X] <a>post</a>  api/v1/store/clinics/__id__/image?token=__token__
     
    > ##### update product
     - [X] <a>post</a>  api/v1/store/clinics/15?token=__token__
         * Request
             ```json
              {
                "title": "update product",
                "description": "desc of new product",
                "image": "image_route",
                "price": 11.5,
                "category_id":1,
                "specialization_id":1
              }
             ```
          
          * Response
              ```json
              {
                  "msg": "Product Has Been Updated",
                  "error": "0"
              }
              ```
              
    > ##### delete product
     - [X] <a>get</a>  api/v1/store/clinics/15/delete?token=__token__
        * Response 
            ```json
    
               {
                   "msg": "Product Deleted",
                   "error": "0"
               }
             ```
             
     > ##### get a product by id 
     - [X] <a>get</a>  api/v1/store/clinics/13  
     
         * Response 
            ```json
           {
                 "msg": "products",
                 "product": {
                     "id": 13,
                     "title": "new product",
                     "description": "desc of new product",
                     "image": "image_route",
                     "owner_id": 10,
                     "specialization_id": 1,
                     "category_id": 1,
                     "created_at": "2018-05-10 20:27:45",
                     "updated_at": "2018-05-10 20:27:45",
                     "price": 11.5
                 },
                 "error": "0"
             }
            ```
     > ##### All clinic parts
     - [X] <a>get</a>  api/v1/store/clinics
     
         * Response 
            ```json
           {
                 "msg": "products",
                 "products": [
                         {
                             "id": 2,
                             "title": "product1",
                             "description": "sdfskdjfklsdfjsd",
                             "image": "dsfsdf",
                             "owner_id": 1,
                             "specialization_id": 1,
                             "category_id": 1,
                             "created_at": "2018-05-10 17:17:36",
                             "updated_at": "2018-05-10 17:17:36",
                             "price": 1.2
                         },
                         {...},
                         {...},
                         {...},
                         {...},
                 "error": "0"
             }
            ```
      
    * <a>Jobs</a>
        > ##### add job
         - [X] <a>post</a>  api/v1/job?token=__TOKEN__
         
         * Request
         
         ```json
         {
            "title": "job title",
            "description": "job description",
            "category_id": 1
         }
         ```
         * Response
         ```json
          {
              "msg": "Job has been added",
              "id": _ID_,
              "error": "0"
          }
        ```
    
        > ##### get all
        - [X] <a>get</a>  api/v1/jobs?token=__TOKEN__
        
            *Response
            
            ```json
              {
                  "msg": "Jobs",
                  "jobs": [
                      {
                          "id": 3,
                          "title": "job title",
                          "description": "job description",
                          "owner_id": 1,
                          "category_id": 1,
                          "featured": 0,
                          "deleted": 0,
                          "created_at": "2018-05-14 14:22:04",
                          "updated_at": "2018-05-14 14:22:04"
                      },
                      {...},
                      {...}
                  ],
                  "error": "0"
              }
            ```
        
        > ##### get by id
        - [X] <a>get</a>  api/v1/jobs/7?token=__TOKEN__
        * Response
            ```json
              {
                  "msg": "Job Found",
                  "job": {
                      "id": 7,
                      "title": "job title",
                      "description": "job description",
                      "owner_id": 14,
                      "category_id": 1,
                      "featured": 0,
                      "deleted": 0,
                      "owner_name": "Moustafa elgammal",
                      "created_at": "2018-05-14 14:52:32",
                      "updated_at": "2018-05-14 14:52:32"
                  },
                  "error": "0"
              }
            ```
        > ##### delete job
        - [X] <a>get</a>  api/v1/job/7/delete?token=__TOKEN__
        * Response
        ```json
          {
              "msg": "Job has been deleted",
              "error": "0"
          }
        ```
                    
    * <a>Events</a>
        > ##### add event
         - [X] <a>post</a>  api/v1/events?token=__TOKEN__
         
         * Request
         ```json
        {
            "title": "Event is being Tested",
            "description": "Hola max",
            "date": "2019-09-11T05:05:05+00:00",
            "coordinated":"dfksdkjf sdkf jk",
            "price": "__PRICE__",
            "payed": 1
        }  
        ```
        * Response
        
        ```json
         {
             "msg": "Event has been creased",
             "id": 7,
             "error": "0"
         }
        ```
        
        > ##### set event Image
         - [X] <a>post</a>  api/v1/events/__ID__/image?token=__TOKEN__
        * Response
        
        ```json
        {
            "msg": "Image Uploaded",
            "error": "0"
        }
        ```
        
    > ##### get events
    - [X] <a>get</a>api/v1/events?token=__TOKEN__
    * Response
        
    ```json
    {
        "msg": "Events",
        "events": [
           {
            "id": 2,
             "title": "Event is being Tested",
             "description": "",
             "image": null,
             "date": "2019-09-11 05:05:05",
             "payed": 0,
             "owner_id": 10,
             "coordinated": "dfksdkjf sdkf jk",
             "deleted": 0,
             "featured": 0,
             "created_at": "2018-06-11 11:13:35",
             "updated_at": "2018-06-11 11:13:35",
             "owner_name": "Moustafa elgammal"
           },
           {},
           {} 
       ],
       "error": "0"
     }
     ```
    > ##### get event info
    - [X] <a>get</a>  /api/v1/events/__ID__?token=__TOKEN__
    * Response
    ```json
    {
        "msg": "Event",
        "event": {
            "id": 8,
            "title": "Event to image is being Tested",
            "description": "",
            "image": "uploads/events\\741d3be65cd790c5432915d8860cb06b73cdcd70.png",
            "date": "2019-09-11 05:05:05",
            "payed": 0,
            "owner_id": 1,
            "coordinated": "dfksdkjf sdkf jk",
            "deleted": 0,
            "featured": 0,
            "created_at": "2018-06-12 09:12:04",
            "updated_at": "2018-06-12 10:11:41",
            "owner_name": "Moustafa elgammal"
        },
        "error": "0"
    }
    ```
    > ##### delete event
    - [X] <a>get</a> /api/v1/events/__ID__/delete?token=__TOKEN__
    * Response
    ```json
      {
          "msg": "Event, deleted",
          "error": "0"
      }
    ```

    * <a>News Posts</a>
        > ##### add post
         - [X] <a>get</a>  api/v1/posts?token=__TOKEN__

        * Response
        
        ```json
         {
             "msg": "3 Posts",
             "posts": [
                 {
                     "id": 2,
                     "title": "fd",
                     "content": "desc of new product",
                     "image": "uploads\\News\\ba4390129afe7ddac1c91e64e00684a6e537f464.png",
                     "owner_id": 1,
                     "created_at": "2018-06-15 19:28:27",
                     "updated_at": "2018-06-15 19:41:09",
                     "name": "Moustafa elgammal"
                 },
                 {
                     "id": 3,
                     "title": "new product",
                     "content": "desc of new product",
                     "image": null,
                     "owner_id": 1,
                     "created_at": "2018-06-15 19:50:08",
                     "updated_at": "2018-06-15 19:50:08",
                     "name": "Moustafa elgammal"
                 },
                 {
                     "id": 5,
                     "title": "new product",
                     "content": "desc of new product",
                     "image": null,
                     "owner_id": 1,
                     "created_at": "2018-06-15 19:51:18",
                     "updated_at": "2018-06-15 19:51:18",
                     "name": "Moustafa elgammal"
                 }
             ],
             "error": 0
         }
        ```
        
        > ##### set event Image
         - [X] <a>get</a>  api/v1/posts/__ID__?token=__TOKEN__
        * Response
        
        ```json
        {
            "msg": "Posts",
            "post": {
                "id": 2,
                "title": "fd",
                "content": "desc of new product",
                "image": "uploads\\News\\ba4390129afe7ddac1c91e64e00684a6e537f464.png",
                "owner_id": 1,
                "created_at": "2018-06-15 19:28:27",
                "updated_at": "2018-06-15 19:41:09",
                "name": "Moustafa elgammal"
            },
            "error": 0
        }
        ```
        
    > ##### get posts
    - [X] <a>get</a>api/v1/posts/__ID__/delted?token=__TOKEN__
    * Response
        
    ```json
    {
        "msg": "Post deleted",
        "error": 0
    }
     ```
    > ##### new post
    - [X] <a>post</a>  /api/v1/posts?token=__TOKEN__
    * request
    ```json
    {
    	"title": "new product",
    	"content": "desc of new product"
    }
    ```
    > ##### set post image
    - [X] <a>post</a> /api/v1/posts/__ID__/image?token=__TOKEN__
            
            file Upload

        
        
        
    
    
    
> ###  <a>Admin Area</a>
    
   > #### Users
    
   > ##### get users 
    
   * get  api/v1/admin/users/__group_ID__?page=__pageNu__&token=__token
        
        ```json
        {
            "total": 4,
            "per_page": 10,
            "current_page": 1,
            "last_page": 1,
            "next_page_url": null,
            "prev_page_url": null,
            "from": 1,
            "to": 4,
            "data": [
                {
                    "id": 10,
                    "name": "Moustafa elgammal",
                    "username": "elga  'SELECT * FROME USERS'mmalx",
                    "email": "elgamsdfmal@me.me",
                    "phone": "01204054219",
                    "address": "Doki",
                    "group": 2,
                    "token": null,
                    "city": 1,
                    "image": "",
                    "created_at": "2018-04-29 04:46:50",
                    "updated_at": "2018-04-29 04:46:50",
                    "status": 1,
                    "deleted": 0
                },
                {}
            ]
        }
        ```
        
   > ##### delete users 
    
        * get  api/v1/admin/users/__id__/delete?token=__token
        
   > #####  deactivate users 
        * get  api/v1/admin/users/__id__/deactivate?token=__token
        
   > #####  activate users 
    
        * get  api/v1/admin/users/__id__/activate?token=__token
        

 #### Messages
> ##### Create Conversation
- [X] <a>post</a> /api/v1/messages/create?token=__TOKEN__
    * Request 
    ```json
        {
        	"title":"Unique title of any thing",
        	"receiver": __user id__ : company | adnin | engineer__
        }
    ```
    
    * Response
    ```json
        {
            "msg": "conversation created",
            "id": __conversation_id__,
            "error": 0
        }
    ```
 
> ##### Send Conversation Message 
- [X] <a>post</a> /api/v1/messages/__id__/send?token=__TOKEN__
    * Request 
    ```json
        {
        	"Message":"Hello "
        }
    ```
    
    * Response
    ```json
        {
            "msg": "message'd been sent",
            "error": 0 | 1
        }
    ```
> ##### get Conversation info 
- [X] <a>get</a> /api/v1/messages/__id_?token=__toke__
* Response 
```json
    {
        "msg": "Conversation Info",
        "conversation": {
            "id": 11,
            "title": "Hello",
            "user1": 1,
            "user2": 10,
            "created_at": "2018-08-01 14:37:15",
            "updated_at": "2018-08-01 14:37:15"
        },
        "error": 0
    }

```

> ##### get User Conversations 
- [X] <a>get</a> /api/v1/messages
* Response 
```json
{
    "msg": "Users Conversations",
    "conversation": [
        {
            "id": 11,
            "title": "Hello",
            "user1": 1, 
            "user2": 10,
            "created_at": "2018-08-01 14:37:15",
            "updated_at": "2018-08-01 14:37:15"
        },
        {
            "id": 12,
            "title": "Test",
            "user1": 10,
            "user2": 1,
            "created_at": null,
            "updated_at": null
        }
    ],
    "error": 0
}
```

> ##### get Conversation Messages 
- [X] <a>get</a> /api/v1/messages/__id__/messages?token=__TOKEN__
    * Response
    ```json
        {
            "msg": "Conversation Messages",
            "messages": [
                {
                    "id": 3,
                    "message": " كيف الحال",
                    "conversation_id": 11,
                    "sender_id": 10,
                    "created_at": "2018-08-01 14:38:17",
                    "updated_at": "2018-08-01 14:38:17"
                },
                {
                    "id": 4,
                    "message": "بخرا",
                    "conversation_id": 11,
                    "sender_id": 1,
                    "created_at": "2018-08-01 15:00:41",
                    "updated_at": "2018-08-01 15:00:41"
                }
            ],
            "error": 0
        }
    ```
    
