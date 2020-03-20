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

Pada umumnya format request menggunakan format `Content-type`: `application/json` untuk `POST / PUT / PATCH`, kecuali untuk data yang memiliki data binary (gambar, pdf, docx, dll) menggunakan format `form-data`.

Beberapa *endpoint* API dilindungi oleh sebuah *authorization* yang biasanya hanya bisa diakses menggunakan **token** (umumnnya menggunakan [JWT - JSON Web Token](https://jwt.io/)) pada header request.

```
Authorization: Bearer <token>
```

Untuk kasus tertentu kita terkadang membutuhkan **Custom Header** tertentu yang dapat digunakan menggunakan format `X-Custom-Header`.

```
X-Localization: id
X-Device-Id: xxx1234
```

## Response Format

### Success Response

### Failed Response

#### Error Objects

## HTTP Response Code