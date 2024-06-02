# Base URL
http://localhost:8080/api


# Headers



Accept : application/json



# API 



| Route                           | Request Method | Parameters                                           | Response  |
| -----------                     | -----------    |-----------                                           |---------- |
|/worker/clock-in                 | POST           |  [Posting Worker Parameters](#PostWorkerRequest)     |[Response](#Response)|
|/worker/clock-ins                | GET            |  [Getting Worker Parameters](#GetWorkerRequest)      |[Response](#GetResponse)|






# <a name="PostWorkerRequest"> </a> Posting Worker's location 

```json
{
    "arrival_time" : "timestamp",
    "latitude" : "decimal",
    "longitude" : "decimal"
} 
```




# <a name="Response"> </a> Responses 

## Validation error 
__*Response code : 401*__

```json 
{
    "success": false,
    "Message": [],
    "data": "null",
}
```
## Success  
__*Response code : 201*__
```json 
{
  "data": {
      "id": "int",
      "arrival_time": "string",
      "latitude": "decimal",
      "longitude": "decimal"
  }
 "success": true
 "message":  "null"
}
```

`Note` status code will 201 if the Request is POST




# <a name="GetWorkerRequest"> </a> Worker's Clock-ins Request parameter 

```json
{
    "id" : "int",
} 
```



# <a name="GetResponse"> </a> Get Worker's Clocks-in 




## Employee Not Found 
__*Response code : 404*__

```json 
{
  "message": "Employee not found"
}
```



## Success  
__*Response code : 200*__
```json
{
  "data": {
      "id": "int",
      "arrival_time": "string",
      "latitude": "decimal",
      "longitude": "decimal"
  }
 "success": true
 "errors":  null
}
```
