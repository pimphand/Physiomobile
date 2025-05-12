# Patient Management System API

## API Documentation

### Authentication
All API endpoints require an API key to be included in the request headers. You can use any of the following API keys:
```
X-API-Key: key1
X-API-Key: key2
X-API-Key: key3
```

### Postman Collection
You can import the API collection using the following file:
[Physiomobile.postman_collection.json](Physiomobile.postman_collection.json)

### Endpoints

#### 1. Create Patient
- **URL**: `/api/patients`
- **Method**: `POST`
- **Headers**: 
  - `Content-Type: application/json`
  - `X-API-Key: your_api_key_here`
- **Body**:
```json
{
    "name": "John Doe",
    "id_type": "passport",
    "id_no": "AB123456",
    "gender": "male",
    "dob": "1990-01-01",
    "address": "123 Main St",
    "medium_acquisition": "website"
}
```

#### 2. Update Patient
- **URL**: `/api/patients/{id}`
- **Method**: `PUT`
- **Headers**: 
  - `Content-Type: application/json`
  - `X-API-Key: your_api_key_here`
- **Body**: Same as Create Patient

#### 3. Delete Patient
- **URL**: `/api/patients/{id}`
- **Method**: `DELETE`
- **Headers**: 
  - `X-API-Key: your_api_key_here`

#### 4. Get Patient List
- **URL**: `/api/patients`
- **Method**: `GET`
- **Headers**: 
  - `X-API-Key: your_api_key_here`

#### 5. Get Patient Detail
- **URL**: `/api/patients/{id}`
- **Method**: `GET`
- **Headers**: 
  - `X-API-Key: your_api_key_here`

### Response Format
All responses follow this format:
```json
{
    "data": {
        // Response data
    },
    "message": "Success message" // Optional
}
```

### Error Responses
Error responses follow this format:
```json
{
    "message": "Error message",
    "errors": {
        // Validation errors if any
    }
}
```

### Status Codes
- 200: Success
- 201: Created
- 400: Bad Request
- 401: Unauthorized
- 404: Not Found
- 422: Validation Error
- 500: Server Error
