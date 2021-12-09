---
title: SOP Deployment Aplikasi
description: Standard Operating Procedure Deployment Aapplication
extends: _layouts.documentation
section: content
---

# SOP Deployment Aplikasi

Panduan ini merupakan prosedur operasi standar bagi tim DevOps Engineer DOT Indonesia, yang telah ditetapkan oleh tim DevOps.
<!-- devops mengikuti sop -->

---

## 1. Penulisan Environment Deployment

Untuk mempersingkat dan mempermudah penulisan environment deployment gunakan aturan penyingkatan berikut:

| Panjang  | Singkat  | Pendek |
| ------------- |---------------| -----|
| development   | develop       | dev  |
| staging       | staging       | stag |
| production    | product       | prod |

Untuk penulisan env dapat menggunakan yang **Pendek**, untuk penulisan nama branch dapat menggunakan **Singkat** atau sesuaikan dengan kebutuhan.

---

<!-- ## <a name="domain-deployment">2. Domain Deployment </a> -->
## 2. Domain Deployment

Gunakan aturan berikut untuk penamaan domain pada deployment aplikasi web:

- **namaproject**-**env**.dot.co.id (Untuk frontend)
- api.**namaproject**-**env**.dot.co.id (Untuk API)

Dengan value:

- **namaproject** adalah nama dari project yang deploy, misalkan pama, energas, sakoo, ayoomall
- **env** adalah environment deployment yang telah di sebutkan pada halaman Penulisan Environment Deployment 

---

## 3. Path Deployment

Pada sandbox DOT gunakan path berikut untuk deployment aplikasi: /var/www/project/**namadomain**
Gunakan **namadomain** yang telah diatur pada Domain Deployment
Jika terdapat permintaan khusus seperti deployment menggunakan user yang terpisah maka path deployment dapat disesuaikan dengan home dari user tersebut.

---

## 4. Lokasi Konfigurasi dan Script Deployment pada Repository

Gunakan directory **deploy** pada repository project untuk mengumpulkan script dan konfigurasi yang digunakan selama proses deployment seperti script ansible, Dockerfile, dsb.

![Contoh directory deploy](/assets/img/directory-deploy-1.png "Directory deploy")
![Contoh directory deploy 2](/assets/img/directory-deploy-2.png "Directory deploy")

---

## 5. Penamaan Ansible Playbook

Untuk menyimpan ansible playbook gunakan nama sesuai dengan environment dari deployment yang telah disebutkan pada Penulisan Environment Deployment.

![Format Ansible playbook](/assets/img/format-file-ansible-1.png "Format Ansible playbook")
![Format Ansible playbook](/assets/img/format-file-ansible-2.png "Format Ansible playbook")

---

## 6. Penamaan Konfigurasi VirtualHost

Untuk konfigurasi VirtualHost pada Web Server baik itu Nginx ataupun Apache gunakan **namadomain** sesuai dengan Domain Deployment sebagai nama dari file konfigurasi VirtualHost-nya.

![File konfigurasi VirtualHost](/assets/img/file-konfigurasi-virtualhost.png "File konfigurasi VirtualHost")

---

## 7. Penamaan Service dan Sejenis

Untuk penamaan service gunakan **namaproject**-**env** sebagai nama service tersebut. Contohnya untuk penamaan service di PM2, nama service di Docker, nama “program” di Supervisor, dsb.

---

## 8. Penamaan Job CI/CD

Untuk nama dari job pada CI/CD gunakan aturan berikut:

- **stage_env**:**job** (jika job dikhususkan pada environment tertentu)
- **stage**:**job** (jika job tidak dikhususkan pada environment tertentu)

![Penamaan job CI/CD](/assets/img/penamaan-job-cicd-1.png "Penamaan job CI/CD")
![Penamaan job CI/CD](/assets/img/penamaan-job-cicd-2.png "Penamaan job CI/CD")

---

## 9. Minimum Job pada CI/CD

Saat membuat CI/CD pastikan memiliki job minimal yaitu **deploy** job.

![Minimum job](/assets/img/minimum-job-1.png "Minimum job")
![Minimum job](/assets/img/minimum-job-2.png "Minimum job")

---

## 10. Nama User pada Server

Untuk penamaan user pada server sesuaikan saja dengan kebutuhan atau permintaan dari tim development maupun client. Misalkan pada project **PAMA** menggunakan user pama, project Taprose menggunakan user **taprose**.


---

## 11. Penamaan dan Grouping Git Repository

Untuk permintaan pembuatan repository project gunakan format **namaproject**-**peruntukan** (EWGP-frontend, EWGP-backend, nfs-frontend), atau sesuaikan dengan permintaan dari tim developer maupun client
Untuk grouping gunakan **namaproject** (pama, sakoo, energas).

---

## 12. Penamaan Docker Image

Untuk project yang menggunakan docker image gunakan aturan berikut sebagai nama dari docker image tersebut, **namarepo**:**env**. Jika docker image tersebut tidak spesifik digunakan pada project gunakan nama umum yang deskriptif seperti (ansible, php, flutter).

![Contoh penamaan Image](/assets/img/penamaan-image-1.png "Penamaan Image Docker")
![Contoh penamaan Image](/assets/img/penamaan-image-2.png "Penamaan Image Docker")

---

## 13. Password dan Kredensial

Untuk kebutuhan password dan kredensial utamakan **random** dan pastikan password tersebut tersimpan ditempat yang aman atau sesuai dengan kesepakatan pada project tersebut.

----

