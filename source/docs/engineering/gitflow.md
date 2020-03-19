---
title: Penggunaan Git
description: Penggunaan Git
extends: _layouts.documentation
section: content
---

## Panduan Penggunaan Git

Semua source code project harus dikelola melalui repository perusahaan di [Gitlab](https://gitlab.com/). Perusahaan memiliki 2 group repository yang memiliki tujuan masing-masing yaitu:
    
1. [DOT Internal](https://gitlab.com/pt-dot-internal) untuk pengelolaan project perusahaan
2. [DOT Playground](https://gitlab.com/pt-dot-playground) untuk kebutuhan riset, latihan atau project internal

Setiap engineer berhak untuk menjadi member group repository dengan default role `developer` untuk group `DOT Internal` dan `developer` untuk group `DOT Playground`. Engineer senior atau dengan izin atasan dapat diberikan akses `maintainer` pada group `DOT Internal`. Silahkan menghubungi VP atau DevOps untuk melakukan invitasi user ke dalam Gitlab.

Untuk user yang sifatnya `guest` hanya boleh di-invite ke masing-masing repository dengan level maksimal sebagai `developer`. Jika harus upgrade menjadi `maintainer`, maka harus dengan sepengetahuan VP atau Squad Leader.


### Perintah Dasar

Disarankan untuk membiasakan diri menggunakan CLI untuk lebih menghapal command dan biasanya CLI membuat operasi lebih cepat. Untuk latihan perintah dasar silahkan mempelajari beberapa resource berikut:

1. [try.github.io](https://try.github.io/)
2. [Getting git right](https://www.atlassian.com/git)
3. [Learning git branching](https://learngitbranching.js.org/)
4. [Dokumentasi resmi](https://git-scm.com/doc)
5. [Gitlab University](https://docs.gitlab.com/ee/university/README.html)

Jika memang GUI lebih mudah, maka disarankan untuk memakai Git Client yang sudah umum seperti berikut:

1. [SourceTree](https://www.sourcetreeapp.com/)
2. [Gitkraken](https://www.gitkraken.com/)
3. [dan banyak lagi](https://git-scm.com/downloads/guis)

### Aturan Umum

Pada dasarnya kami mengacu pada Git Flow dari [Nvie - A successfull git branching model](https://nvie.com/posts/a-successful-git-branching-model/) karena dengan tim yang tidak begitu besar dan model project yang dikerjakan, branching model ini sesuai dengan kebutuhan. Silahkan dipahami dan dipelajari penggunaannya.

Beberapa aturan umum yang diberlakukan untuk penggunaan dan pengelolaan repository di setiap project adalah sebagai berikut:

* Setiap project minimal memiliki 1 repository dan boleh terdiri dari banyak repository jika dibutuhkan
* Gunakan `commit message` yang mudah dimengerti dan relevan dengan apa yang di commit. Usahakan commit file sesuai dengan konteks commit.

```bash
>>> bad
$ git commit -m "fix"

>>> good
$ git commit -m "fix failed upload file in resource post"
```

* **Selalu push progress** ke Gitlab sebelum mengakhiri jam kantor, jika memungkinkan untuk `merge` bisa mengirimkan `Merge Request`. Jika tidak bisa maka di `push` di branch masing-masing.
* Jika terjadi `conflict`, hubungi engineer atau anggota tim yang mengerjakan file tersebut untuk di-resolve sebelum dilakukan `merge`. [Referensi](https://about.gitlab.com/blog/2016/09/06/resolving-merge-conflicts-from-the-gitlab-ui/)

### Aturan Branching & Merge Request

* Branch `master`: untuk production
* Branch `staging`: untuk kebutuhan staging / client demo (jika dibutuhkan)
* Branch `develop`: untuk daily development & testing QA
* Branch `feature/[feature-name]`: untuk development fitur
* Branch `fix/[fix-what]`: untuk bug fix fitur tertentu di branch `develop` atau `staging`
* Branch: `hotfix/[hotfix-what]`: untuk hotfix bug di branch `master` atau production
* Branch `refactor/[refactor-what]`: branch support untuk refactor code
* Branch `enhancement/[enhancement-what]`: untuk enhancement minor pada suatu fitur.
* Selalu gunakan `Merge Request` pada Gitlab untuk proses merge antar branch.
* Manfaatkan branch secara **spesifik untuk satu topik**, hindari mengerjakan sesuatu di luar konteks branch aktif yang sedang dikerjakan.
* Selalu **delete** branch (terutama branch support) yang sudah di `merge` atau sudah tidak digunakan. Baik di local atau di repository Gitlab.

### Version Tagging

Version tagging bersifat opsional tapi bisa berguna untuk menandai rilis suatu aplikasi dan memastikan deployment sudah berada pada versi yang sesuai.

*Best practice* yang diterapkan, version tagging hanya dilakukan pada saat **merge ke branch master** sebagai penanda rilis. Tidak menutup kemungkinan tagging juga dilakukan di branch `staging` jika diperlukan.

Adapun format tagging untuk `master` adalah `Major.Minor.Fix`, dengan contoh `1.0.3`. Penjelasannya:

* `Major` iterasi rilis major yang bersifat *breaking change* atau rewrite lebih dari 50% source code awal.
* `Minor` iterasi rilis penambahan fitur major yang tidak bersifat *breaking change* atau penambahan fitur yang `minor`.
* `fix` iterasi perbaikan bug.

Format tagging untuk non `master` bisa ditambahkan dengan prefix tertentu misalkan `alpha-Major.Minor.Fix`, `beta-Major.Minor.Fix`.

Jangan lupa sertakan `Release Notes` pada masing-masing versi tag melalui fitur yang sudah tersedia di Gitlab. [Referensi](https://stackoverflow.com/questions/29520905/how-to-create-releases-in-gitlab)