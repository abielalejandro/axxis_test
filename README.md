### Getting started


```bash
docker-compose up --build
```

To access directly from local host the PostgreSQL database container

```bash
psql postgresql://postgres:password@127.0.0.1:15432/app
```


### App running in port 8000

#### Examples

Create

```bash
curl --location 'http://localhost:8000/api/v1/products' \
--header 'Content-Type: application/json' \
--header 'Authorization: Basic YWRtaW46YWRtaW5wYXNz' \
--data '[
    {
        "name": "Prueba",
        "sku": "123456",
        "description": "Prueba"
    }
]'

```


Update

```bash
curl --location --request PUT 'http://localhost:8000/api/v1/products' \
--header 'Content-Type: application/json' \
--header 'Authorization: Basic YWRtaW46YWRtaW5wYXNz' \
--data '[
    {
        "name": "Prueba x",
        "sku": "123456",
        "description": "Prueba x"
    }
]'

```

List

```bash
curl --location --request GET 'http://localhost:8000/api/v1/products' \
--header 'Content-Type: application/json' \
--header 'Authorization: Basic YWRtaW46YWRtaW5wYXNz'

```


### User in memory (Basic authentication)
```
 admin/adminpass

 user/userpass
```
