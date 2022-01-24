---
title: Panduan Frontend Engineering
description: Panduan Frontend Engineering
extends: _layouts.documentation
section: content
---

## Framework yang dipakai

Next js → react

Nuxt js → vue

## Code Standard

## eslint

gunakan eslint sebagai code standard. Menghindari conflict dan membuat seragam terkait code stylenya. Beberapa rules juga memberikan rule best practice code. Config yang bisa digunakan untuk eslint bisa menggunakan standard eslint, atau jika ingin lebih strict bisa menggunakan airbnb atau memberikan custom rules sesuai kebutuhan.

## prettier

Sedangkan untuk format code , gunakan prettier. 

perlu ditambahkan config eslint prettier agar prettier dan eslint tidak terjadi clash rule.

Ada beberapa opsi config

1. set prettier format ke eslint, sehingga format code masuk kedalam rule eslint. akan muncul error linter jika format tidak sesuai
2. Gunakan prettier untuk format code saja tanpa memasukan rule prettier ke eslint. opsi ini perlu menggunakan configurasi auto format untuk memudahkan proses format. Pada opsi ini berfokus pada experience code tanpa memikirkan formating code, lebih ringan karena linter tidak melakukan validasi terhadap format code. Untuk memastikan semua code sudah sesuai format, validasi format code bisa dieksekusi dengan `lint-staged`

Terkait support multuple platform, tambahkan rule `endofline auto` 

## husky

digunakan berdampingan dengan `lint-staged`

digunakan untuk mengeksekusi script di event yang didefine, pada umumnya didefine ketika commit, husky akan menjankan script pre-commit yang biasanya berisi command untuk menjalankan `lint-staged`

## Lint staged

lint staged digunakan untuk validate file , melakukan formating code pada code yang akan dicomit. Pada dasarnya di lint-staged akan mengeksekusi script dengan parameter file yang akan dicommit. contohnya eksekusi eslint terhadap file yang akan di commit, namun script yang dijalankan juga tidak harus memakai parameternya, misal melakukan type checking ke seluruh project ketika ada proses commit

## naming convention

camelCase

CONST_VALUE

_localVariable

## Error handling

ketika membuat error handler, pastikan definisi handler sesuai pada level nya.
misal level infrastructure maka handling di error di level infrastrucure saja , by pass error terkait business level dan sebalikanya. Hal seperti ini tujuannya agar masing masing error handler tidak saling memiliki coupling yang tinggi, karena error handlingnya diimplementasikan sesuai dengan level nya masing masing.

Misal: 

*infrastructure*

httpclient → axios

di level infra handling error 500 execute toast dengan message server error

di level domain, ketika terjadi error, sesuaikan dengan response yang diinginkan,

misal register

ketika error email sudah terdaftar , makan tampilkan pesan email sudah terdaftar, set focus ke email input, ketika error terlalu banyak percobaan login gagal, maka tampilkan message freeze account at x minutes

# React

Hook

untuk logic business suatu domain bisa dipisahkan/dibuatkan hook sendiri. Misal

useRegister

yang berisi segala flow dan effect terkait flow register

### hook for Fetching Data

beberapa hook yang tersedia di npm untuk urusan fetch data react-query atau swr.

untuk react query lebih lengkap, sedangakn swr lebih kecil dan ringkas.

# Vue

## Composition

sama seperti hook di react, kita bisa gunakan untuk memecah code program sesuai dengan level nya. pisah code yg berkaitan denga proses business , pisah menjadi helper/utilities

## basic UI state

Beberapa UI state yang perlu diperhatikan 

- default state
- empty state
- loading state
- error state

## validation

untuk validation schema bisa menggunakan yup.

tapi bukan berarti semua validation harus didefine menggunakan yup, terkadang perlu kita define sendiri diluar yup karena limitasi dari yup

# Auth

## React

Untuk auth bisa menggunakan next-auth, namun memerlukan server side untuk mengeksekusinya

Jika ingin full client side / ssg friendly maka gunakan hook untuk melakukan auth pada level client side

misal: useAuth

yang digunakan untuk cek apakah user memiliki authentication, jika tidak maka redirect ke login

## Vue

 Standard menggunakan lib seperti nuxt-auth