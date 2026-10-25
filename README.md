# Section 1: Project Metadata

- **Project Title:** Vehicle REST API (Laravel 11 + Sanctum)
- **Partner Names:** _Partner 1 Name_, _Partner 2 Name_
- **Section:** _Your Section_
- **Selected Resource:** Vehicle (`make`, `model`, `year`, `price`)

---

# Section 2: Setup Instructions

1. **Clone the repository**
   ```bash
   git clone <your-repo-url> vehicle-api
   cd vehicle-api
   ```
2. **Install dependencies**
   ```bash
   composer install
   ```
3. **Set up the environment file**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   Configure the database in `.env` (the default SQLite works out of the box:
   `DB_CONNECTION=sqlite`; create it with `touch database/database.sqlite`).
4. **Migrate and seed**
   ```bash
   php artisan migrate --seed
   ```
5. **Run the server**
   ```bash
   php artisan serve
   ```
   The API is available at `http://127.0.0.1:8000/api`.

> Starting from a brand-new Laravel 11 project? Run `php artisan install:api`
> first to install Sanctum and create `routes/api.php`, and make sure the
> `User` model uses `Laravel\Sanctum\HasApiTokens`.

---

# Section 3: Route Table

| Verb   | Path                  | Description                                   | Authentication Required |
|--------|-----------------------|-----------------------------------------------|-------------------------|
| POST   | `/api/register`       | Register a user and receive a token           | No                      |
| POST   | `/api/login`          | Log in and receive a token                    | No                      |
| POST   | `/api/logout`         | Revoke the current access token               | Yes                     |
| GET    | `/api/me`             | Get the authenticated user                    | Yes                     |
| GET    | `/api/vehicles`       | List vehicles (filter by `make`, `model`, `year`) | Yes                 |
| POST   | `/api/vehicles`       | Create a vehicle                              | Yes                     |
| GET    | `/api/vehicles/{id}`  | Show a single vehicle                         | Yes                     |
| PUT    | `/api/vehicles/{id}`  | Update a vehicle                              | Yes                     |
| DELETE | `/api/vehicles/{id}`  | Delete a vehicle (204 No Content)             | Yes                     |

Protected routes need the header `Authorization: Bearer <token>` and `Accept: application/json`.

---

# Section 4: Test Proof / Screenshot Placeholders

1. **Register user** — `POST /api/register` → 201 + token
   ![Test 1](screenshots/01-register.png)
2. **Login** — `POST /api/login` → 200 + token
   ![Test 2](screenshots/02-login.png)
3. **Get authenticated user** — `GET /api/me` → 200
   ![Test 3](screenshots/03-me.png)
4. **List all vehicles** — `GET /api/vehicles` → 200
   ![Test 4](screenshots/04-index.png)
5. **Filter vehicles** — `GET /api/vehicles?make=Mitsubishi&year=1999` → 200
   ![Test 5](screenshots/05-filter.png)
6. **Create vehicle** — `POST /api/vehicles` → 201
   ![Test 6](screenshots/06-store.png)
7. **Show vehicle** — `GET /api/vehicles/1` → 200
   ![Test 7](screenshots/07-show.png)
8. **Update vehicle** — `PUT /api/vehicles/1` → 200
   ![Test 8](screenshots/08-update.png)
9. **Delete vehicle** — `DELETE /api/vehicles/1` → 204
   ![Test 9](screenshots/09-destroy.png)
10. **Logout** — `POST /api/logout` → 200
    ![Test 10](screenshots/10-logout.png)

---

# Section 5: Short Answer Response

**Why does DELETE return 204 and not 200?**

A successful DELETE removes the resource, so there is nothing left to represent in a response body. HTTP 204 No Content tells the client the request succeeded and that no body is being sent, while 200 OK implies a body describing something. Using 204 avoids sending an empty or meaningless payload and gives clients an unambiguous signal that the deletion completed. It also matches REST conventions, where the status code alone communicates the outcome.
