# Michael BE Test

## Table of Contents

-   [Requirements](#Requirements)
-   [Installation](#Installation)
-   [GettingStarted](#GettingStarted)
-   [Endpoints](#Endpoints)
-   [Testing](#Testing)

## Requirements

-   Laravel 8
-   PHP8
-   Mongodb 4.2

## Installation

1. Clone the repository:

    - git clone https://github.com/michaelpoernomo/michael-be-test.git

2. Install dependencies:

    - composer install

3. Copy the env file

4. Generate the application key:

    - php artisan key:generate

5. Set up your database:

    - Update the .env and .env.testing file

6. Run seed the database:
    - php artisan db:seed

## GettingStarted

To start the local development server, run:

```
php artisan serve
```

Default laravel page will be accessible at http://localhost:8000.

Version detail page: http://localhost:8000/version

## Endpoints

### Authentication

-   **Get Token**

    -   **Endpoint:** `POST /api/get_token`
    -   **Request Body:**
        ```
        {
           "email": required|string,
           "password": required|string
        }
        ```
    -   **Default:**
        ```
        curl --location '127.0.0.1:8000/api/get_token' \
        --form 'email="admin@mail.com"' \
        --form 'password="admin"'
        ```
    -   **Success Response:**
        -   **Code:** 200
            ```
            {
               "success": true,
               "user_id": string,
               "token": string
            }
            ```
    -   **Failed Response:**
        -   **Code:** 401 Unauthorized
            ```
            {
                "success": false,
                "message": string,
            }
            ```

-   **Invalidate Token**
    -   **Endpoint:** `POST /api/invalidate_token`
    -   **Header:**
        -   **Authorization:** `Bearer {token}`
    -   **Success Response:**
        -   **Code:** 200
            ```
            {
               "success": true,
                "message": string,
            }
            ```

### Kendaraan Endpoints

-   **Get All Kendaraan Tersedia**

    -   **Description:** Lihat stok kendaraan
    -   **Endpoint:** `GET /api/kendaraan/tersedia`
    -   **Header:**
        -   **Authorization:** `Bearer {token}`
    -   **Success Response:**
        -   **Code:** 200
        -   **Body:** [Kendaraan Collection](#KendaraanCollection)

-   **Get All Kendaraan Terjual**

    -   **Description:** Penjualan kendaraan
    -   **Endpoint:** `GET /api/kendaraan/terjual`
    -   **Header:**
        -   **Authorization:** `Bearer {token}`
    -   **Success Response:**
        -   **Code:** 200
        -   **Body:** [Kendaraan Collection](#KendaraanCollection)

-   **Get Per Kendaraan Terjual**

    -   **Description:** Laporan penjualan per kendaraan
    -   **Endpoint:** `GET /api/penjualan/{jenis_kendaraan}`
        -   **jenis_kendaraan:** `mobil|motor`
    -   **Header:**
        -   **Authorization:** `Bearer {token}`
    -   **Success Response:**
        -   **Code:** 200
        -   **Body:** [Mobil Collection](#MobilCollection) | [Motor Collection](#MotorCollection)

-   **Add Kendaraan**

    -   **Description:** Menambahkan kendaraan
    -   **Endpoint:** `POST /api/kendaraan/tambah`
    -   **Header:**
        -   **Authorization:** `Bearer {token}`
    -   **Params:** [Mobil Fields](#MobilFields) | [Motor Fields](#MotorFields)
    -   **Success Response:**
        -   **Code:** 201
        -   **Body:** Object of [Mobil Collection](#MobilCollection) | [Motor Collection](#MotorCollection)

-   **Delete All Kendaraan**
    -   **Description:** Menghapus semua data kendaraan
    -   **Endpoint:** `POST /api/kendaraan/hapus/semua`
    -   **Header:**
        -   **Authorization:** `Bearer {token}`
    -   **Success Response:**
        -   **Code:** 202

### Kendaraan Fields

-   #### MobilFields

    ```
    jenis: required|string|in:mobil|motor
    tahun_keluaran: required|int
    warna: required|string
    harga: required|int
    status: required|string|in:sold|inStock
    mesin: required|string
    kapasitas_penumpang: required|int
    tipe: required|string
    ```

-   #### MotorFields
    ```
    jenis: required|string|in:mobil|motor
    tahun_keluaran: required|int
    warna: required|string
    harga: required|int
    status: required|string|in:sold|inStock
    mesin: required|string
    tipe_suspensi: required|string
    tipe_transmisi: required|string
    ```

### Kendaraan Response

-   #### MobilCollection

    ```
    [
        {
            "_id": "66f4472b16c43bd56a078b52",
            "jenis": "mobil",
            "tahun_keluaran": 2024,
            "warna": "hitam",
            "harga": 20000,
            "status": "sold",
            "mesin": "mesin 1",
            "kapasitas_penumpang": 6,
            "tipe": "tipe mobil 1"
        },
    ]
    ```

-   #### MotorCollection

    ```
    [
        {
            "_id": "66f4472b16c43bd56a078b54",
            "jenis": "motor",
            "tahun_keluaran": 1998,
            "warna": "hijau",
            "harga": 10000,
            "status": "sold",
            "mesin": "mesin 3",
            "tipe_suspensi": "suspensi motor 1",
            "tipe_transmisi": "suspensi motor 1"
        },
    ]
    ```

-   #### KendaraanCollection
    ```
    [
        {
            "_id": "66f4472b16c43bd56a078b53",
            "jenis": "mobil",
            "tahun_keluaran": 2022,
            "warna": "putih",
            "harga": 15000,
            "status": "inStock",
            "mesin": "mesin 2",
            "kapasitas_penumpang": 4,
            "tipe": "tipe mobil 2"
        },
        {
            "_id": "66f447605ec1b512800ec995",
            "jenis": "motor",
            "tahun_keluaran": 1995,
            "warna": "kuning",
            "harga": 5000,
            "status": "inStock",
            "mesin": "mesin 4",
            "tipe_suspensi": "suspensi motor 2",
            "tipe_transmisi": "suspensi motor 2"
        }
    ]
    ```

## Testing

To run the tests, use the following command:

```
php artisan test
```
