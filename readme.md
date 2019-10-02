
# GraphQL + Eloquent

Direto ao ponto!

---

Resources:
- https://graphql.org
- https://www.howtographql.com
- https://webonyx.github.io/graphql-php

---

Queries to support

```graphql
# List users
{
    users {
        name
        address { 
            city 
        }
        posts { 
            id
            title
            comments {
                content 
            } 
        }
    }
}
```

```graphql
# Get single user
{
    user(id: 5) {
        name
        address { 
            city 
        }
        posts { 
            id
            title
            comments {
                content 
            } 
        }
    }
}
```

```graphql
# Create user
mutation ($user: UserInput) {
    createUser(user: $user){
        id
    }
}
```
```json
{
	"user": {
		"name": "Doug",
		"email": "doug@testing.com",
		"birthday":"1988-05-17",
		"address":{
			"street": "",
			"city": "Floripa",
			"state": "SC"
		}
	}
}
```

