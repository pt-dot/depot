---
title: RESTful API Standard
description: RESTful API Standard
extends: _layouts.documentation
section: content
---

## Overview

DOT Indonesia memiliki pedoman serta standardisasi dalam membuat RESTful API. Ini adalah tentang bagaimana merancang dan mengembangkan RESTful API untuk pengembang internal atau mitra vendor untuk memastikan bahwa API dikembangkan sesuai dengan standar.

## URL Design

URL harus mengandung sumber daya (kata benda), bukan tindakan atau kata kerja. Dan sumber daya harus selalu jamak di titik akhir API dan jika kita ingin mengakses satu instance dari sumber daya, kita selalu dapat melewatkan id di URL.

Contoh sebagai berikut:

- `/photos`
- `/products`
- `/categories`

Contoh berikut untuk detail *resource* beserta `HTTP Verbs`:

- GET `/photos`, mengembalikan seluruh *resource* `photo`
- GET `/photos/1`, mengembalikan detail *resource* `photo` dengan ID `1`
- POST `/photos`, membuat *resource* `photo` baru
- PUT / PATCH `/photos/1`, melakukan pembaruan *resource* `photo` dengan ID `1`
- DELETE `/photos/1`, menghapus *resource* `photo` dengan ID `1`

### URL Resource yang Berelasi

Disarankan bahwa URL *resource* yang berelasi dibentuk dengan menambahkan nama relasi ke URL *resource*.

Sebagai contoh, URL untuk `variants` pada suatu `product` adalah sebagai berikut:

```
/products/1/variants
```

Dan kumpulan `images` dari suatu `product` adalah:

```
/products/1/images
```


## Format Request

Secara default data yang dikembalikan melalui RESTful API adalah memiliki format `JSON` sehingga pada header suatu request haruslah memiliki attribute `Accept: application/json`. Pada umumnya format request menggunakan format `Content-type`: `application/json` untuk `POST / PUT / PATCH`, kecuali untuk data yang memiliki data binary (gambar, pdf, docx, dll) menggunakan format `form-data`.

Beberapa *endpoint* API dilindungi oleh sebuah *authorization* yang biasanya hanya bisa diakses menggunakan **token** (umumnnya menggunakan [JWT - JSON Web Token](https://jwt.io/) atau personal access token jika menggunakan [Laravel Sanctum](https://laravel.com/docs/7.x/sanctum)) pada header request.

```
Authorization: Bearer <token>
```

Untuk kasus tertentu kita terkadang membutuhkan **Custom Header** tertentu yang dapat digunakan menggunakan format `X-Custom-Header`.

```
X-Localization: id
X-Device-Id: xxx1234
```

## Response Format

DOT Indonesia menentukan `JSON` sebagai format response secara umum. Kecuali ada jenis integrasi yang membutuhkan format yang lain seperti `XML`.

*Response* dari sebuah `endpoint` API **HARUS** setidaknya berisi salah satu dari atribut `top-level` di bawah ini:

* `data`: merupakan bagian dari data utama baik berupa *single object* atau *collection of objects*
* `errors`: sebuah `array` dari kumpulan obyek *error*.
* `message`: Pesan berupa string sebagai informasi endpoint

### Success Response

Data utama **HARUS** berupa:

* Sebuah `message` untuk menampilkan pesan dari hasil suatu aksi pada endpoint
* Sebuah `resource object` atau `null`, untuk *request* yang membutuhkan satu `resource`
* Sebuah `array` dari banyak `resource object` atau `array` kosong (`[]`), untuk *request* yang membutuhkan lebih dari satu `resource.

Sebagai contoh , data utama berikut berupa sebuah `resource object`:

```json
{
    "message": "This is successful message",
    "data": {
        "id": 1,
        "type": "articles",
        "created_at": "2019-10-04 14:33"
    }
}
```

Format berikut ini berupa kumpulan banyak `resource object` yang ada dalam `array`:

```json
{
    "message": "This is successful message",
    "data": [
        {
            "id": 1,
            "type": "articles",
            "created_at": "2019-10-04 13:33"
        },
        {
            "id": 2,
            "type": "articles",
            "created_at": "2019-10-04 14:33"
        }
    ]
}
```

### Failed Response

Terkadang *server* terhenti karena mengalami masalah saat melakukan pemrosesan *request*, atau pemrosesan tetap berlanjut tapi menghasilkan beberapa permasalahan. Sebagai contoh, *server* melakukan pemrosesan beberapa `attribute` kemudian mengembalikan beberapa masalah validasi dalam sebuah *response*.

#### Response Guideline

Contoh berikut biasanya digunakan untuk *response* gagal dengan status `400`, `401`:

```json
{
    "message": "This is error message",
    "errors": [],
}
```

Sedangkan untuk *response* gagal untuk status `404`, `50x` terdapat attribute pendukung untuk keperluan stack trace.

```json
{
    "message": "Method Illuminate\\Http\\Request::svalidate does not exist.",
    "exception": "BadMethodCallException",
    "file": "/Users/dot/Didik/playground/project/vendor/laravel/framework/src/Illuminate/Support/Traits/Macroable.php",
    "line": 103,
    "trace": [
        {
            "file": "/Users/dot/Didik/playground/project/app/Http/Controllers/Api/V1/Auth/CustomerAuthenticationController.php",
            "line": 22,
            "function": "__call",
            "class": "Illuminate\\Http\\Request",
            "type": "->"
        },
        {
            "function": "__invoke",
            "class": "App\\Http\\Controllers\\Api\\V1\\Auth\\CustomerAuthenticationController",
            "type": "->"
        }
    ]
}

```

#### Contoh Response

+ `422 Unprocessable Entity`

```json
{
    "message": "The given data was invalid.",
    "errors": {
        "email": [
            "The email must be a valid email address."
        ],
        "device_name": [
            "The device name field is required."
        ]
    }
}
```

+ `401 Unauthenticate`

```json
{
    "message": "Unauthenticated user.",
    "errors": []
}
```

+ General Error Response

```json
{
    "message": "Method Illuminate\\Http\\Request::svalidate does not exist.",
    "exception": "BadMethodCallException",
    "file": "/Users/dot/Didik/playground/project/vendor/laravel/framework/src/Illuminate/Support/Traits/Macroable.php",
    "line": 103,
    "trace": [
        {
            "file": "/Users/dot/Didik/playground/project/app/Http/Controllers/Api/V1/Auth/CustomerAuthenticationController.php",
            "line": 22,
            "function": "__call",
            "class": "Illuminate\\Http\\Request",
            "type": "->"
        },
        {
            "function": "__invoke",
            "class": "App\\Http\\Controllers\\Api\\V1\\Auth\\CustomerAuthenticationController",
            "type": "->"
        }
    ]
}
```

> Failed Response di atas hampir seluruhnya sudah di handle oleh Laravel (Saat dokumentasi ini dibuat, menggunakan Laravel 7) sehingga output di atas juga merupakan output yang dihasilkan dari Laravel itu sendiri. Kecuali untuk Unauthenticated ada bagian yang di extend.

## HTTP Response Code

Kode status *HTTP Response* mengindikasikan apakah sebuah *HTTP Request* sudah berhasil diselesaikan. Pada umumnya ada 3 tipe kode status yang biasa digunakan:

* *Successful Response* (`2xx`)
* *Client errors* (`4xx`)
* *Server errors* (`5xx`)
* Lebih lengkapnya bisa dipelajari di [laman berikut](https://developer.mozilla.org/en-US/docs/Web/HTTP/Status).

### Successful Responses (2xx)

**200 OK**

*Request* berhasil dilakukan. Adapun makna dari berhasil tergantung pada `HTTP method`:

* `GET`: Sumber daya berhasil ditarik dan ditransmisikan di dalam *response*
* `PUT` atau `POST`: Sumber daya menggambarkan hasil dari sebuah aksi yang ditransmisikan di dalam *response*

**201 Created**

*Request* telah berhasil dan ada sumber daya baru telah dibuat sebagai hasilnya. Ini biasanya bentuk *response* dari *request* `POST` atau `PUT`.

### Client Errors (4xx)

**400 Bad Request**

*Server* tidak memahami format *request* karena ada *invalid syntax*.

**401 Unauthorized**

*Client* sebelumnya harus sudah terautentikasi sebelum boleh mengakses `endpoint` tertentu.

**403 Forbidden**

*Client* mungkin sudah terautentikasi namun tidak memiliki hak ases untuk mengakses `endpoint` tertentu.

**404 Not Found**

*Server* tidak berhasil menemukan sumber daya yang diminta. Ini bisa berarti `URL` atau data yang diminta tidak tersedia.

**405 Method Not Allowed**

*Client* mengirimkan *request* dengan `HTTP verb` yang dipahami oleh *server*, namun tidak dapat digunakan di `endpoint` tertentu.

> sebuah `endpoint` `/users/1` harus diakses menggunakan `GET`, akan tetapi diakses menggunakan `POST`

**422 Unprocessable Entity**

Terdapat permasalahan validasi terhadap atribut-atribut yang dikirimkan pada parameter *request*.

### Server Errors (5xx)

**500 Internal Server Error**

Kesalahan atau permasalahan terjadi dari *server* itu sendiri, biasanya berupa `syntax error`, kegagalan sistem, dll.

> Best practice yang digunakan, saat lingkungan production tidak boleh ada informasi server yang sensitif (debug info) muncul pada aplikasi. Maka harus disiapkan sebuah pesan error umum jika hal ini terjadi.

**502 Bad Gateway**

Sering terjadi karena *server* sedang tidak bisa diakses (*down*).
