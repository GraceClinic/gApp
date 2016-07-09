#set($P = '#')
#set($P2 = '##')
#set($P3 = '###')
The **${module_endpt_url_lowercase}** API serves as a proxy for access to the [[${PHP_Model_and_WikiFile_Name}|${PHP_Model_and_WikiFile_Name}]].  Refer to this model for specification therein.

>1. [[INDEX|${NAME}${P}index]]
>  * **\<Short Description Title\>**
>1. [[GET|${NAME}${P}get]]
>  * **\<Short Description Title\>**
>1. [[POST|${NAME}${P}post]]
>  * **\<Short Description Title\>**
>1. [[PUT|${NAME}${P}put]]
>  * **\<Short Description Title\>**
>1. [[DELETE|${NAME}${P}delete]]
>  * **\<Short Description Title\>**

**Related Method Endpoints**
>* [[\<Method URL\>|\<Wiki file name reference\>]]
>* \<duplicate as required\>

${P2} INDEX
The `INDEX` action...

|  | **\<Short Description Title\>** |
| :---: | :--- |
| **URL**              | `{{rootURL}}/${module_endpt_url_lowercase}/` |
| **Method**           | GET |
| **Scope**            | [[${Scope}|Modules-Account-v1-Auth]] |
| **Request Headers**  | **Authorization:** \<valid token string\> <br> **Content-Type:** application/json |
| **Success Response** | [[Standard Model Response|Common-Conventions${P}standard-model-response]] containing JSON representation of [[${PHP_Model_and_WikiFile_Name}|${PHP_Model_and_WikiFile_Name}]] | 
| **Error Response**   | [[Common RESTful Error Responses|Common-RESTful-Responses${P}error-responses]] |
| **Example**          | [[INDEX Example|${NAME}${P}index-example-1]]

${P2} GET
The `GET` action...

|  | **\<Short Description Title\>** |
| :---: | :--- |
| **URL**              | `{{rootURL}}/${module_endpt_url_lowercase}/` |
| **Method**           | GET |
| **Scope**            | [[${Scope}|Modules-Account-v1-Auth]] |
| **Request Headers**  | **Authorization:** \<valid token string\> <br> **Content-Type:** application/json |
| **Success Response** | [[Standard Model Response|Common-Conventions${P}standard-model-response]] containing JSON representation of [[${PHP_Model_and_WikiFile_Name}|${PHP_Model_and_WikiFile_Name}]] | 
| **Error Response**   | [[Common RESTful Error Responses|Common-RESTful-Responses${P}error-responses]]  |
| **Example**          | [[GET Example|${NAME}${P}get-example-1]]

${P2} POST
The `POST` action...

|  | **\<Short Description Title\>** |
| :---: | :--- |
| **URL**              | `{{rootURL}}/${module_endpt_url_lowercase}/` |
| **Method**           | GET |
| **Scope**            | [[${Scope}|Modules-Account-v1-Auth]] |
| **Request Headers**  | **Authorization:** \<valid token string\> <br> **Content-Type:** application/json |
| **Success Response** | [[Standard Model Response|Common-Conventions${P}standard-model-response]] containing JSON representation of [[${PHP_Model_and_WikiFile_Name}|${PHP_Model_and_WikiFile_Name}]] | 
| **Error Response**   | [[Common RESTful Error Responses|Common-RESTful-Responses${P}error-responses]]  |
| **Example**          | [[POST Example|${NAME}${P}post-example-1]]
    
${P2} PUT
The `PUT` action...

|  | **\<Short Description Title\>** |
| :---: | :--- |
| **URL**              | `{{rootURL}}/${module_endpt_url_lowercase}/` |
| **Method**           | PUT |
| **Scope**            | [[${Scope}|Modules-Account-v1-Auth]] |
| **Request Headers**  | **Authorization:** \<valid token string\> <br> **Content-Type:** application/json |
| **Success Response** | [[Standard Model Response|Common-Conventions${P}standard-model-response]] containing JSON representation of [[${PHP_Model_and_WikiFile_Name}|${PHP_Model_and_WikiFile_Name}]] | 
| **Error Response**   | [[Common RESTful Error Responses|Common-RESTful-Responses${P}error-responses]]  |
| **Example**          | [[PUT Example|${NAME}${P}put-example-1]]
    
${P2} DELETE
The `DELETE` action...

|  | **\<Short Description Title\>** |
| :---: | :--- |
| **URL**              | `{{rootURL}}/${module_endpt_url_lowercase}/` |
| **Method**           | PUT |
| **Scope**            | [[${Scope}|Modules-Account-v1-Auth]] |
| **Request Headers**  | **Authorization:** \<valid token string\> <br> **Content-Type:** application/json |
| **Success Response** | [[Standard Model Response|Common-Conventions${P}standard-model-response]] containing JSON representation of [[${PHP_Model_and_WikiFile_Name}|${PHP_Model_and_WikiFile_Name}]] on failure otherwise empty| 
| **Error Response**   | [[Common RESTful Error Responses|Common-RESTful-Responses${P}error-responses]]  |
| **Example**          | [[DELETE Example|${NAME}${P}delete-example-1]]

***

${P2} Examples
${P3} INDEX Example 1
**INDEX Action from authenticated API consumer**

*Request:*

    GET {{rootURL}}/${module_endpt_url_lowercase}/
    
*Response:*

    \<RESPONSE EXAMPLE\>

${P3} GET Example 1

*Request:*

    GET {{rootURL}}/${module_endpt_url_lowercase}/

*Response:*

    \<RESPONSE EXAMPLE\>

${P3} POST Example 1

*Request:*

    POST {{rootURL}}/${module_endpt_url_lowercase}/
    JSON body:
        {
            \<POST BODY\>
        }
        
*Response:*

    \<RESPONSE EXAMPLE\>

${P3} PUT Example 1

*Request:*

    PUT {{rootURL}}/${module_endpt_url_lowercase}/
    JSON body:
        {
            \<POST BODY\>
        }

*Response:*

    \<RESPONSE EXAMPLE\>

${P3} DELETE Example 1

*Request:*

    DELETE {{rootURL}}/${module_endpt_url_lowercase}/

*Response:*

    \<RESPONSE EXAMPLE\>