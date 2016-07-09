#set($P = '#')
#set($P2 = '##')
#set($P3 = '###')
The **${model_method_endpt_url_lowercase}** API is a method endpoint extending the [[${root_model_endpt_url_lowercase}|${Root_Model_Endpt_WikiFile_Name}]] resource.  As a method endpoint, this resource only realizes the POST action, all others are forbidden.  

${P2} POST
The `POST` action...

|  | **\<Short Description Title\>** |
| :---: | :--- |
| **URL**              | `{{rootURL}}/${model_method_endpt_url_lowercase}/` |
| **Method**           | GET |
| **Scope**            | [[${Scope}|Modules-Account-v1-Auth]] |
| **Request Headers**  | **Authorization:** \<valid token string\> <br> **Content-Type:** application/json |
| **Success Response** | {"model":${Root_Model_PHP_Class_Name}, "results":object} | 
| **Error Response**   | **Code:** 401<br>**Content:**`{"message": "401 Not Authorized","error": 1}`  |

If the method endpoint changes the model, it always returns the new model information as the "model" parameter.  The "results" parameter contains the results of method execution as a JSON object.

${P3} Example 1

*Request:*

    POST {{rootURL}}/${model_method_endpt_url_lowercase}/
    JSON body:
        {
            \<POST BODY\>
        }
        
*Response:*

    \<RESPONSE EXAMPLE\>