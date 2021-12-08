---
title: Permintaan Deploy Aplikasi
description: Permintaan Deploy Aplikasi
extends: _layouts.documentation
section: content
---

# Permintaan Deploy Aplikasi

Panduan ini merupakan sebuah standar bagi backend engineer DOT Indonesia atau vendor yang menggunakan PHP atau framework PHP sebagai server side programming.

Kunjungi [Development Stack & Tools](stack-tools) untuk melihat daftar aplikasi dan perangkat development yang dibutuhkan

---

## 1. Wajib Menyertakan

Saat request untuk melakukan deployment ke server developer wajib telah menyediakan beberapa poin berikut:

- Stack/Requirement aplikasi yang hendak di deploy↩
- Langkah deployment dari aplikasi yang hendak di deploy↩
- Menyebutkan apakah CI/CD perlu diaktifkan↩
- Menyebutkan developer yang bisa dihubungi jika terdapat kendala saat proses deployment↩

---

## 2. Boleh Menyertakan

Saat request untuk melakukan deployment ke server developer dapat menyertakan beberapa request tambahan diluar kewajiban yang telah disebutkan. Seperti request untuk menambahkan job test di CI/CD atau request untuk alamat domain aplikasi.

---

## 3. Stack/Requirement Aplikasi

Tuliskan apa saja stack/requirement dari aplikasi yang hendak deploy. Mulai dari versi dari bahasa pemrograman yang digunakan, engine dan versi dari database yang digunakan, dan lainnya. Hal ini dapat dituliskan pada file README repository aplikasi.

![Penulisan Stack/Requirement APP](/assets/img/penulisan-requirement-1.png "Penulisan Stack/Requirement APP")
![Penulisan Stack/Requirement APP](/assets/img/penulisan-requirement-2.png "Penulisan Stack/Requirement APP")

---

## 4. Langkah Deployment Aplikasi

Tuliskan langkah deployment yang harus dilakukan pada aplikasi. Tuliskan langkah-langkah yang ada sedetail dan sejelas mungkin untuk menghindari gagal deploy ataupun kesalahan deployment yang berakibat aplikasi tidak berjalan. Gunakan README pada repository untuk menuliskan langkah deployment aplikasi.

![Langkah Deployment APP](/assets/img/langkah-deployment.png "Langkah Deployment APP")

---

## 5. Penamaan Ansible Playbook 

Untuk mempermudah dan mempercepat proses development, developer dapat melakukan permintaan untuk menambahkan CI/CD.
- Apabila permintaan deployment tidak menyebutkan CI/CD diaktifkan atau tidak maka CI/CD tidak akan diaktifkan.
- Apabila permintaan CI/CD tidak disertai dengan job apa saja yang dijalankan maka CI/CD akan dibuat hanya untuk mendeploy aplikasi ke server.

---

## 6. Menyebutkan Developer yang Bertanggung Jawab 

Walaupun langkah deployment sudah ditulis dengan lengkap tidak menutup kemungkinan deployment mengalami masalah atau kegagalan, sehingga diwajibkan untuk menyertakan nama developer yang akan tersedia untuk mengonfirmasi hal-hal yang terjadi pada saat deployment. Apabila tidak disertakan maka yang mengajukan deployment akan dianggap sebagai penanggung jawab apabila terdapat kegagalan deployment.

---

