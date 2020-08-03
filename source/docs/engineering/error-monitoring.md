---
title: Panduan Error Monitoring
description: Panduan Error Monitoring
extends: _layouts.documentation
section: content
---

## Overview

DOT Indonesia menggunakan layanan [Sentry.io](https://sentry.io/) untuk *error monitoring* dari aplikasi yang dihasilkan pada project. Error monitoring ini digunakan untuk membantu proses debugging dan tindak lanjut *critical issue* secara cepat. Secara umum integrasi Sentry di dalam project adalah sebagai berikut:

![Sentry Integration Overview](/assets/img/sentry-overview.png "Sentry Integration Overview")

1. Saat user menjalankan aplikasi kemudian terjadi error. Ada kalanya user tidak akan melihat error ini dan aplikasi nampak berjalan seperti biasa.
2. Aplikasi akan secara otomatis mengirimkan error log kepada Sentry.
3. Sentry akan mengirimkan notifikasi kepada email devops / tim developer / tim support. Ini sedang dalam proses transisi di mana event log dari Sentry akan dialihkan ke email dan channel Slack saja.
4. PIC Client / Product Owner dapat disambungkan dengan Sentry sehingga mereka dapat menerima notifikasi error saat level production.
5. Dari email dapat di-forward menjadi card pada trello. Ini sedang dalam proses transisi tidak dipakai kembali karena Trello sudah mulai ditinggalkan.

## Tujuan Umum

### Membantu tim developer meningkatkan kualitas software

* Memantau error yang terjadi
* Membantu reproduce error
* Debugging

### Meningkatkan pelayanan *after-live* project

* Menerima notifikasi error terlebih dahulu sebelum dilaporkan pengguna
* Mengetahui apa yang terjadi pada sisi pengguna

## Pengguna Sentry

* **Project Manager** (Mandatory): Monitoring kualitas project dari development sampai production
* **Dev Lead** (Mandatory): Monitoring + debugging dari development sampai production
* **Engineer** (Mandatory): Debugging dari development sampai production
* **Quality Assurance** (Mandatory): Monitoring + reproduce issue saat development & *pra-live*
* **Tim Support** (Mandatory): Monitoring + reproduce issue saat *after-live*
* **PIC Client** (Opsional): Urgensinya jika sudah masuk masa maintenance.

## Environment

Sentry **HANYA DIPASANG** pada environment berikut: **DEVELOPMENT**, **STAGING**, dan **PRODUCTION**

## Event yang Dikirim ke Sentry

Tidak semua exception log perlu dikirimkan ke Sentry. Yang dibutuhkan adalah Exception yang sifatnya *unhandled* oleh logic business atau application layer. Event tersebut dapat kita golongkan sebagai berikut:

* **NON HTTP EXCEPTION**: *Unhandled Exception* yang sifatnya sebagai defect program pada logic business atau application layer. Contoh: `Null Exception`, `Index of array exception`, dll.
* **INFRA ERROR**: *Unhandled Exception* pada level integrasi infrastructure. Contoh: `Database Exception`, `Disk Exception`, `Mailer Exception`, dll.
* **INTEGRATION ERROR**: Error yang terjadi pada proses integrasi dengan 3rd party service atau API. Misal: `SSO Exception`, `Qiscus API Error`, dll.

## Isu dan Penanganan

### Resolve

* Issue sudah diperbaiki oleh QA atau engineer dan sudah di-deploy ke environment-nya.
* Setelah QA memastikan memang issue tersebut sudah resolve, maka ganti status event menjadi **Resolve**.
* Sebagai catatan, event akan hilang dari sentry setelah di-resolve akan tetapi kembali muncul jika issue tersebut muncul kembali.

### Ignore

* Issue yang tidak perlu di monitor atau tidak bersifat essensial.
* QA mengganti status **Ignore** pada event yang dirasa sesuai dengan ketentuan di atas.
* Jika event ini dirasa tidak perlu dikirimkan ke Sentry, hubungi engineer untuk melakukan exclude exception tersebut.

### Manajemen Event pada Issue List

* Pastikan yang tampil pada issue adalah event yang sesuai.
* Jika ada yang tidak sesuai, segera ambil tindakan (Ignore / Anything)
* **TIDAK BOLEH** ada issue yang **DIBIARKAN** dengan alasan apapun. Jika memang error, hubungi engineer. Jika tidak butuh dikerjakan tandai dengan **Ignore**. Jika memang tidak perlu dikerjakan sekarang, lakukan sesuatu agar bisa dikerjakan ke depannya.
* **JANGAN BIASAKAN** mata kita melihat event yang memang kita biarkan. Hal ini dapat **mengurangi awareness** terhadap real event yang muncul.

![Sentry Issue List](/assets/img/sentry-issue-list.png "Sentry Issue List")

* Untuk memprioritaskan sebuah issue dapat diperhatikan 4 hal: **jumlah total event**, **Jumlah User**, **Frekuensi kemunculan**, **Waktu event terjadi**. 4 Hal tersebut bisa kita dapatkan melalui menu **Stats** pada Sentry.

![Sentry Issue Stats](/assets/img/sentry-stat.png "Sentry Issue Stats")

## Debugging Melalui Sentry

* Masuk ke detail sebuah event untuk melihat segala informasi dan data error log aplikasi.
* Perhatikan pesan exception yang ada lalu perhatikan baris ke berapa error terjadi. Ini membantu engineer melakukan perbaikan tanpa melihat log nya di environment local.

![Exception Log](/assets/img/sentry-exception-log.png "Sentry Exception Log")

* Periksa *Data* atau *Header request* untuk membantu reproduce issue.

![Header & Request Log](/assets/img/sentry-header-log.png "Header & request Log")

* Periksa *Client Environment* untuk membantu reproduce issue.

![Client Environment](/assets/img/sentry-client-env.png "Client Environment")

## Referensi Teknis

* [Integrasi Laravel](https://docs.sentry.io/platforms/php/laravel/)
* [Integrasi .NET](https://docs.sentry.io/platforms/dotnet/)
* [Integrasi Node.js](https://docs.sentry.io/platforms/node/)
* [Integrasi Javascript](https://docs.sentry.io/platforms/javascript/)
* [Integrasi Android](https://docs.sentry.io/platforms/android/)
* [Integrasi Flutter](https://docs.sentry.io/platforms/flutter/)
* Atau dokumen yang lebih lengkap bisa mengunjungi [Dokumentasi Resmi Sentry](https://docs.sentry.io/)
