---
title: API Reference

language_tabs:
- bash
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.
[Get Postman Collection](http://localhost/docs/collection.json)

<!-- END_INFO -->

#TaskCRUD


task的所有操作
<!-- START_96431051513da723c0741b326fe7719c -->
## showAllTasks API
Display a listing of the resource.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/task" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/task"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`GET api/task`


<!-- END_96431051513da723c0741b326fe7719c -->

<!-- START_3514f7637d559421c22e182cb0b4ba17 -->
## showOneUsersTask
Display the specified resource.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/task/1?id=dolore" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/task/1"
);

let params = {
    "id": "dolore",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
[
    {
        "id": 1,
        "user_id": 1,
        "content": "123123",
        "done": 0,
        "created_at": "2020-07-22T17:49:53.000000Z",
        "updated_at": null
    },
    {
        "id": 4,
        "user_id": 1,
        "content": "aasdsadsad",
        "done": 0,
        "created_at": "2020-07-23T09:54:35.000000Z",
        "updated_at": null
    }
]
```

### HTTP Request
`GET api/task/{id}`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `id` |  required  | 已存在的user id.

<!-- END_3514f7637d559421c22e182cb0b4ba17 -->

<!-- START_bb92a432ca8bb8f24cd8a0baf9beee3f -->
## AddNewTask API
Store a newly created resource in storage.

> Example request:

```bash
curl -X POST \
    "http://localhost/api/task" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"user_id":9,"content":"test123"}'

```

```javascript
const url = new URL(
    "http://localhost/api/task"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "user_id": 9,
    "content": "test123"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "message": "AddNewTask success"
}
```
> Example response (400):

```json
{
    "message": "AddNewTask error with reason "
}
```

### HTTP Request
`POST api/task`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `user_id` | integer |  required  | The id of the user .
        `content` | string |  required  | task 內容 .
    
<!-- END_bb92a432ca8bb8f24cd8a0baf9beee3f -->

<!-- START_6d932da29b609bf5748d517fb79181dd -->
## updateTask API
Update the specified resource in storage

> Example request:

```bash
curl -X PUT \
    "http://localhost/api/task/1?id=amet" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/task/1"
);

let params = {
    "id": "amet",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "message": "update task success"
}
```
> Example response (404):

```json
{
    "message": "updateTask id error"
}
```

### HTTP Request
`PUT api/task/{tasks}`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `id` |  required  | 已存在的task id.

<!-- END_6d932da29b609bf5748d517fb79181dd -->

<!-- START_25a8fb2e78fed99d60643f791e3631b2 -->
## deleteTask API
Remove the specified resource from storage.

> Example request:

```bash
curl -X DELETE \
    "http://localhost/api/task/et" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/task/et"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "message": "delete task id success"
}
```
> Example response (404):

```json
{
    "message": "delete task id error"
}
```

### HTTP Request
`DELETE api/task/{id}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `id` |  required  | 已存在的task id.

<!-- END_25a8fb2e78fed99d60643f791e3631b2 -->

#general


<!-- START_d7b7952e7fdddc07c978c9bdaf757acf -->
## Create a new user instance after a valid registration.

> Example request:

```bash
curl -X POST \
    "http://localhost/api/register" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/register"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/register`


<!-- END_d7b7952e7fdddc07c978c9bdaf757acf -->

<!-- START_816ea41c5f160527eabf0bcdebcaf494 -->
## todolist
> Example request:

```bash
curl -X GET \
    -G "http://localhost/todolist" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/todolist"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
null
```

### HTTP Request
`GET todolist`


<!-- END_816ea41c5f160527eabf0bcdebcaf494 -->

<!-- START_262673707ef75b04982d9dabc4def6a9 -->
## todolistLogin
> Example request:

```bash
curl -X POST \
    "http://localhost/todolistLogin" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/todolistLogin"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST todolistLogin`


<!-- END_262673707ef75b04982d9dabc4def6a9 -->

<!-- START_c49c4c5411f67cce660680397b00394a -->
## todolistAddTask
> Example request:

```bash
curl -X POST \
    "http://localhost/todolistAddTask" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/todolistAddTask"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST todolistAddTask`


<!-- END_c49c4c5411f67cce660680397b00394a -->

<!-- START_d6bb975b42f49935c9a6fc5b746df89f -->
## readTask/{id}
> Example request:

```bash
curl -X POST \
    "http://localhost/readTask/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/readTask/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST readTask/{id}`


<!-- END_d6bb975b42f49935c9a6fc5b746df89f -->

<!-- START_6b79c143fdc881781e61eb5e4d90a933 -->
## updateTask
> Example request:

```bash
curl -X POST \
    "http://localhost/updateTask" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/updateTask"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST updateTask`


<!-- END_6b79c143fdc881781e61eb5e4d90a933 -->

<!-- START_67ddb64fcc1692106969f28eb4bfec34 -->
## deleteTask
> Example request:

```bash
curl -X POST \
    "http://localhost/deleteTask" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/deleteTask"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST deleteTask`


<!-- END_67ddb64fcc1692106969f28eb4bfec34 -->

<!-- START_cb859c8e84c35d7133b6a6c8eac253f8 -->
## Show the application dashboard.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/home" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/home"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET home`


<!-- END_cb859c8e84c35d7133b6a6c8eac253f8 -->

#user Login 


auth的所有操作
<!-- START_c3fa189a6c95ca36ad6ac4791a873d23 -->
## login API
登入.

> Example request:

```bash
curl -X POST \
    "http://localhost/api/login" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"name":"molestias","password":"earum"}'

```

```javascript
const url = new URL(
    "http://localhost/api/login"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "molestias",
    "password": "earum"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/login`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `name` | string |  optional  | required.
        `password` | string |  optional  | required.
    
<!-- END_c3fa189a6c95ca36ad6ac4791a873d23 -->

<!-- START_38bd0a8481ac8ed56bfad04acf450c57 -->
## show API
顯示個人資料.

> Example request:

```bash
curl -X POST \
    "http://localhost/api/user/me" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"remember_token":"nihil"}'

```

```javascript
const url = new URL(
    "http://localhost/api/user/me"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "remember_token": "nihil"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/user/me`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `remember_token` | string |  optional  | required.
    
<!-- END_38bd0a8481ac8ed56bfad04acf450c57 -->

<!-- START_5a5b59444cee7eb79d151113de4eec9c -->
## resetPassword API
重設密碼.

> Example request:

```bash
curl -X POST \
    "http://localhost/api/user/reset" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"reset_password":"qui","remember_token":"aperiam"}'

```

```javascript
const url = new URL(
    "http://localhost/api/user/reset"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "reset_password": "qui",
    "remember_token": "aperiam"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/user/reset`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `reset_password` | string |  optional  | required.
        `remember_token` | string |  optional  | required.
    
<!-- END_5a5b59444cee7eb79d151113de4eec9c -->


