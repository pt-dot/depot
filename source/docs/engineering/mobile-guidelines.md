---
title: Panduan Mobile Engineering
description: Panduan Mobile Engineering
extends: _layouts.documentation
section: content
---

## Panduan Flutter 

Panduan ini merupakan sebuah standar bagi Mobile Engineer DOT Indonesia atau vendor yang menggunakan Flutter. Untuk panduan secara komprehensif dapat mengikuti panduan [Effective Dart](https://dart.dev/guides/language/effective-dart).

---

## 1. Coding Standard

a. Hal-hal berikut ini seharusnya dimasukkan ke dalam list `.gitignore` dan tidak boleh di push ke dalam repository:

+ direktori `build`
+ file upload dari user
+ Informasi credential penting atau krusial

b. Variable atau method menggunakan format `camelCase`

c. Penamaan file menggunakan `snake_case`

d. Penamaan class menggunakan `PascalCase`

e. Gunakan penamaan variable atau method yang singkat & jelas, serta tidak membingungkan.

f. Gunakan fitur static analysis untuk code standard. Static analysis dapat diaktifkan dengan cara menambahkan  file `analysis_options.yaml` di folder project. Rules yang ada dapat dikustomisasi sesuai kebutuhan. Untuk penjelasan lebih lengkapnya dapat diakses [di sini](https://dart.dev/guides/language/analysis-options)

g. Untuk pengguna IDE Visual Studio Code, aktifkan fitur prettier dari plugin Flutter.

h. Constant (on progress)

i. Helper (on progress)

j. Code Separation (on progress)

k. Folder Structure (on progress)



## 2. Package & Libraries

- [Cached Network Image](https://pub.dev/packages/cached_network_image) - Untuk Caching image dari network
- [Device Info](https://pub.dev/packages/device_info) - Untuk mendapatkan informasi detail terkait device
- [Dio](https://pub.dev/packages/dio) - network client service
- [Equatable](https://pub.dev/packages/equatable) - untuk komparasi class object
- [Flutter Bloc](https://pub.dev/packages/flutter_bloc) - state management Bloc
- [Hive](https://pub.dev/packages/hive) - database local
- [Sentry](https://pub.dev/packages/sentry) - error monitoring
