---
title: Panduan Quality Assurance
description: Panduan Quality Assurance
extends: _layouts.documentation
section: content
---

## Panduan Quality Assurance - Manual

<div style="text-align: justify"> 
    SQA bertugas menjamin kualitas dari sistem perangkat lunak yang mana kualitas dapat dipahami sebagai persyaratan yang sudah didefinisikan oleh bisnis atau klien, baik secara fungsionalitas, UI/UX, maupun performansi sistem.
</div>

<div style="text-align: justify"> 
    Oleh sebab itu, dokumentasi menjadi hal yang penting sebagai acuan bersama dengan developer dalam membangun sistem untuk menyamakan pemahaman mengenai sistem yang akan dibangun.
</div>

Berikut detail dari deliverable dokumen yang dibutuhkan dan kegunaannya di beberapa kategori proyek.

| Tipe                         | Test Plan | User Story | Test Scenario | Test Case | Test Report | Test Data |
| ---------------------------- | :----:| :----: | :----: | :----: | :----: | :----: |
| Waterfall + Corporate Client | 0         | v          | v             | p         | v           | v         |
| Sprint                       | 0         | -          | -             | v         | v           | v         |
| Blockchain                   | 0         | -          | -             | b         | v           | v         |

Penjelasan: 
<ul>
<li>0 : disesuaikan dengan tim, apabila ada lebih dari 1 QA maka lebih baik menggunakan</li>
<li>v : mandatory</li>
<li>p : opsional, jika ada lebih bagus</li>
<li>b : disesuaikan dengan fungsional transaksi blockchain</li>
<li>- : biasanya tidak diperlukan</li>
</ul>

<details>
    <summary><strong>Test Plan</strong></summary>
    <div style="text-align: justify"> 
        Test plan berfungsi untuk merencanakan pengujian yang akan dilakukan dalam satu iterasi atau satu proyek. Tim QA dapat mengacu pada dokumen ini untuk membagi tugas maupun merencanakan keseluruhan pengujian.</div>
    <br>
    <div>
        Terdapat beberapa komponen yang didetailkan pada dokumen, sebagai berikut.
    </div>
    <dl style="text-align: justify">
        <dt><strong>1. Lingkup</strong></dt>
        <dd>Daftar fitur, platform, dan metode pengujian</dd>
        <dt><strong>2. Peran dan tanggung jawab</strong></dt>
        <dd>Daftar anggota tim QA, peran dan tanggung jawab masing-masing anggota</dd>
        <dt><strong>3. Kakas</strong></dt>
        <dd>Daftar seluruh kakas yang digunakan dalam pengujian</dd>
        <dt><strong>4. Jadwal</strong></dt>
        <dd>Jadwal detail fase STLC yang dilakukan tim QA. Jadwal disesuaikan dengan timeline proyek yang sudah disepakati oleh PM dan klien</dd>
        <dt><strong>5. Manajemen Risiko</strong></dt>
        <dd>Daftar risiko yang mungkin ditemui oleh tim QA ketika melakukan pengujian dan rencana penanganannya</dd>
    </dl>
    <br>
    <div><strong>Referensi dokumen: <a href="https://docs.google.com/spreadsheets/d/1f304uWKep8fkcG0bO45yKf1PTsgDPRKWZ95flL5kRSo/edit?usp=sharing">Test Plan</a></strong></div>
</details>

<details>
    <summary><strong>User Story</strong></summary>
    <div style="text-align: justify"> 
        Dokumen user story digunakan untuk mendefinisikan apa yang user inginkan dari sebuah sistem beserta definisi dari kondisi ‘done’ atau tercapainya kebutuhan user terhadap sistem tersebut. Kondisi itu dikenal dengan <strong>acceptance criteria</strong>.
    </div>
    <br>
    <div>Berikut komponen penting dan standarnya.
    </div>
    <dl style="text-align: justify">
        <dt><strong>1. Epic</strong></dt>
        <dd>Pengelompokkan fitur berdasarkan modulnya, semisal Authorization, Produk, Pesanan, dll sesuai dengan kebutuhan bisnis</dd>
        <dt><strong>2. User story</strong></dt>
        <dd>Definisi dari apa yang user ingin lakukan ketika mengakses suatu sistem</dd>
        <dd>Standar: <strong>Sebagai {tipe user}, saya ingin {user ingin melakukan apa}, sehingga {motivasi user}</strong></dd>
        <dd>Jumlah user story per epic disesuaikan dengan jumlah fitur yang akan dibangun di setiap modul</dd>
        <dt><strong>3. Acceptance criteria</strong></dt>
        <dd>Bagian yang mendefinisikan kondisi ‘done’ atau selesai dari pengerjaan suatu fitur. Format penulisan yang digunakan adalah rule-oriented dengan bentuk daftar. Bagian ini juga mendefinisikan kebutuhan fungsional maupun non-fungsional (jika ada) dan kriteria harus dapat diuji, jelas kondisi passed/failed-nya.</dd>
    </dl>
    <br>
    <div><strong>Referensi dokumen: <a href="https://docs.google.com/spreadsheets/d/1e5dtW94bSKQb1eQYwJCId_sN95bCo0VoSe9EZ4uKs0A/edit?usp=sharing">User Story</a></strong></div>
</details>

<details>
    <summary><strong>Test Scenario</strong></summary>
    <div style="text-align: justify"> 
        Dokumen ini berisi daftar skenario pengujian yang akan dilakukan oleh tim QA dan biasanya digunakan sebagai bahan untuk UAT dengan klien. Skenario pengujian diturunkan dari acceptance criteria.</div>
    <br>
    <div>Berikut beberapa komponen penting.</div>
    <dl style="text-align: justify">
        <dt><strong>1. Story/Features</strong></dt>
        <dt><strong>2. Test scenario</strong></dt>
        <dt><strong>3. Test step</strong></dt>
        <dt><strong>4. Expected result</strong></dt>
        <dd>Hasil yang diharapkan dari setiap langkah pengujian, bisa lebih dari satu apabila hasil yang seharusnya muncul lebih dari satu</dd>
        <dt><strong>5. Status</strong></dt>
        <dd>Passed atau failed, sesuai dengan hasil pengujian, baik ketika sedang dalam masa development dan testing oleh QA maupun masa UAT dengan klien</dd>
    </dl>
    <br>
    <div><strong>Referensi dokumen: <a href="https://docs.google.com/spreadsheets/d/1YkB4-EtpmscBq3bfRX8onYRa1IeiglNTd4-lBxosnf0/edit?usp=sharing">Test Scenario</a></strong></div>
</details>

<details>
    <summary><strong>Test Case</strong></summary>
    <div style="text-align: justify"> 
        Dokumen ini berisi daftar test case yang dikonversi dari acceptance criteria pada user story. Biasanya diperlukan untuk menangani masalah kebutuhan kecepatan dalam development atau perlunya detailing pada fitur-fitur tertentu.</div>
    <br>
    <div>Berikut beberapa komponen penting.
    </div>
    <dl style="text-align: justify">
        <dt><strong>1. Story/Features</strong></dt>
        <dt><strong>2. Test case</strong></dt>
        <dt><strong>3. Expected result</strong></dt>
        <dd>Hasil yang diharapkan dari setiap test case</dd>
        <dt><strong>5. Status</strong></dt>
        <dd>Passed atau failed, sesuai dengan hasil pengujian, baik ketika sedang dalam masa development dan testing oleh QA maupun masa UAT dengan klien</dd>
    </dl>
    <br>
    <div style="text-align: justify"> 
        Untuk proyek yang bertipe scrum, diharapkan untuk selalu mengupdate dokumen ini dan dikelompokkan berdasarkan story atau feature, sehingga keseluruhan requirement dan test case yang ada selalu update dan dapat menjadi acuan yang benar untuk personil lainnya.
    </div>
    <div style="text-align: justify"> 
        Selain itu, untuk scrum, penulisan test case bisa menggunakan format Gherkin, Given/When/Then yang dapat menggambarkan langsung pre-condition, input dan expected result yang seharusnya didapatkan.
    </div>
    <div><strong>Referensi dokumen: <a href="https://docs.google.com/spreadsheets/d/1DjeR8Kebq4dzUbJQhzOzE7Kclp1Mhck1iG-YKVHkaF8/edit?usp=sharing">Test Case</a></strong></div>
</details>

<details>
    <summary><strong>Test Report</strong></summary>
    <div style="text-align: justify"> 
        Dokumen ini digunakan untuk melacak pelaporan bug yang ditemukan, baik di environment testing maupun production ketika sudah masuk masa maintenance. </div>
    <br>
    <div>Berikut beberapa komponen penting.
    </div>
    <dl style="text-align: justify">
        <dt><strong>1. Modul / Epic</strong></dt>
        <dt><strong>2. Bug</strong></dt>
        <dd>Summary dari bug atau issue yang ditemukan</dd>
        <dt><strong>3. Step</strong></dt>
        <dd>Langkah-langkah untuk reproduce issue atau link report pada tracking tools yang digunakan</dd>
        <dt><strong>4. Priority</strong></dt>
        <dd>Prioritas dari bug, biasanya ditentukan oleh klien atau PM (dapat didiskusikan)</dd>
        <dt><strong>5. Severity</strong></dt>
        <dd>Pengelompokkan bug berdasarkan tingkat keparahan dari sisi fungsionalitas dan ditentukan oleh QA. Pengelompokkan ini dapat digunakan untuk penentuan prioritas bug bersama PM atau klien.</dd>
        <dt><strong>6. PIC</strong></dt>
        <dd>Developer yang bertugas untuk menyelesaikan issue, perlu dianalisis apakah dari developer FE/BE/Mobile/Blockchain</dd>
        <dt><strong>7. Status</strong></dt>
        <dd>Status terkini bug, apakah `OPEN`, `FIXING`, `RE-TEST` atau `DONE`</dd>
    </dl>
    <br>
    <div>Komponen yang opsional ada, disesuaikan dengan kebutuhan.
    </div>
    <dl style="text-align: justify">
        <dt><strong>1. Platform</strong></dt>
        <dt><strong>2. Reporter</strong></dt>
        <dt><strong>3. Report date</strong></dt>
        <dt><strong>4. Close date</strong></dt>
        <dt><strong>5. Note</strong></dt>
        <dt><strong>6. Environment</strong></dt>
    </dl>
    <br>
    <div><strong>Referensi dokumen: <a href="https://docs.google.com/spreadsheets/d/1ev0VFsTHyDfJ3PdM20SRkA08ylzsJhcY54SnS2woTpo/edit?usp=sharing">Test Report</a></strong></div>
</details>

<details>
    <summary><strong>Test Data</strong></summary>
    <div style="text-align: justify"> 
        Dokumen test data berisikan daftar data kredensial atau data lainnya yang digunakan untuk pengujian, dibedakan berdasarkan environmentnya. Selain itu, QA juga dapat meletakkan link-link penting yang akan menjadi acuan bersama pada dokumen ini, seperti link desain, flow, atau yang lainnya.</div>
    <br>
    <div><strong>Referensi dokumen: <a href="https://docs.google.com/spreadsheets/d/1FbsiqPMSp3DJ2Ljh9RGdX_srNJBkyrQfRdwvE1_DR2M/edit?usp=sharing">Test Data</a></strong></div>
</details>

## Panduan Quality Assurance - Automation

<div style="text-align: justify"> 
    Dalam membuat script automation, QA Engineer perlu untuk memutuskan tools apa yang akan digunakan untuk membangunnya. Berikut beberapa daftar tools / framework yang dapat digunakan:
</div>

1. [Appium](https://appium.io/)
2. [Selenium](https://www.selenium.dev/)
3. [Katalon Studio](https://katalon.com/) (Groovy)
4. [Cypress](https://www.cypress.io/) (Javascript)
5. [Mocha](https://mochajs.org/) (Javascript)
6. [Rest-Assured](https://rest-assured.io/) (Java)
7. [Serenity BDD](https://serenity-bdd.info/) (Java)
8. [Robot Framework](https://robotframework.org/) (Python)
9. [Cucumber](https://cucumber.io/) (Gherkin)
10. [Postman](https://www.postman.com/automated-testing/)

<details>
    <summary><strong>Preparation</strong></summary>
    <div style="text-align: justify"> 
        Sebelum membuat script automation, seorang QA Engineers dapat mempertimbangkan hal berikut:
    </div>
    <div style="text-align: justify"> 
        <ol>
            <li>Jika <code>tipe proyek == waterfall atau tipe proyek == sprint</code> dan QA yang bertanggung jawab sudah memiliki load yang cukup untuk testing secara manual, maka manual testing lebih diprioritaskan untuk dilakukan karena <strong>exploratory testing</strong> lebih unggul dibanding scripted-test.</li>
            <li>Untuk melakukan regression testing dengan kasus di atas, dapat menggunakan <strong>runner Postman</strong> untuk menguji fungsionalitas kritikal bisnis dari suatu API. Validasi yang harus dilakukan hanya status code dengan scenario test positif.
            Beberapa komponen Postman yang bisa digunakan.
                <ul>
                    <li><code>environment</code>: buat environment khusus untuk run automation. digunakan untuk menyimpan data ekstraksi response yang akan digunakan untuk request lainnya atau data yang secara general akan digunakan di semua request.</li>
                    <li><code>collection</code>: kumpulan endpoint yang akan di-run secara otomatis dan divaidasi status code-nya</li>
                    <li><code>tests</code>: bagian untuk membuat script automation, baik validasi status code atau mengambil response data untuk disimpan ke global environment</li>
                    <li><code>variable</code>: untuk parsing data dari environment ke request</li>
                </ul>
            </li>
            <li>Apabila proyek tersebut sangat mungkin untuk membangun automation dengan kriteria:
                <ul>
                    <li>ada QA khusus automation atau ada QA manual dengan load task yang sedikit</li>
                    <li>tidak ada framework khusus yang ditentukan klien</li>
                    <li>proyek berkepanjangan</li>
                </ul>
                maka ada beberapa pertimbangan yang dapat digunakan.
                <ol>
                    <li>Pilih tools automation dengan bahasa pemrograman yang paling familiar digunakan, seperti Javascript, Java, Python, dll. Apabila belum ada, tools tanpa coding seperti Katalon Studio dapat menjadi alternatif, namun dengan beberapa kekurangannya.
                    Pilih test case dengan kriteria berikut.
                        <ul>
                            <li>repetitif</li>
                            <li>termasuk fungsional kritikal</li>
                            <li>banyak data yang digunakan untuk melakukan pengujian, gunakan mekanisme <strong>Data-Driven Testing</strong> untuk ini</li>
                            <li>bukan test case yang berkaitan dengan UI/UX</li>
                            <li>mencakup seluruh test case, baik positif maupun negatif</li>
                        </ul>
                    </li>
                    <li>Automation yang dibuat sebaiknya dapat menghasilkan report atau setidaknya kita dapat melihat log dari hasil run automation agar dapat mengetahui hasil dari run tersebut.</li>
                </ol>
            </li>
        </ol>
    </div>
</details>

<details>
    <summary><strong>Test Script - UI</strong></summary>
    <div style="text-align: justify"> 
        Standarisasi untuk elemen pada automation UI website / mobile:
    </div>
    <div style="text-align: justify"> 
        <ol>
            <li>Untuk tools atau framework yang menyediakan mekanisme <strong>Object Repository</strong>, kelola seluruh elemen yang ada di page tertentu dalam satu file page. Contohnya, elemen-elemen yang ada di halaman Login akan disimpan dalam file Login. Ini untuk meningkatkan keterbacaan dan pemeliharaan kode. Nantinya, elemen tersebut dapat digunakan pada step test lain yang membutuhkan.</li>
            <li>Penamaan elemen dapat mengikuti standar berikut.
                <ul>
                    <li><code>(konteks)Btn</code>, untuk elemen bertipe tombol</li>
                    <li><code>(konteks)Field</code>, untuk elemen bertipe field</li>
                    <li><code>(konteks)Text</code>, untuk elemen bertipe teks</li>
                    <li>atau secara general, di bagian depan akan menjelaskan konteks dari elemen dan kemudian diikuti dengan tipe dari elemen tersebut</li>
                </ul>
            </li>
            <li>Untuk pemilihan elemen, dapat menggunakan <strong>attribute yang paling unik</strong>, biasanya adalah id. Namun, apabila tidak ada <strong>id</strong>, QA engineer dapat menggunakan attribute, seperti name, class, tag name, accessibility id, atau attribute unik lainnya yang dimiliki oleh elemen.
            </li>
            <li>Jika tetap tidak ada, maka pakai <strong>xpath</strong> dengan ketentuan:
                <ul>
                    <li>apabila elemen memiliki teks, pakai xpath dengan text</li>
                    <li>apabila elemen tidak memiliki teks, pakai relative xpath namun cari yang paling ringkas atau pendek</li>
                </ul>
                Penggunaan xpath bisa dibilang sangat tidak stabil karena mungkin dapat berubah apabila bahasa diubah atau letak dari elemen berubah, sehingga QA engineer perlu memperhatikan lebih pada bagian ini.
            </li>
            <li>Untuk memudahkan keseluruhan pembuatan, sangat disarankan untuk meminta penambahan id atau identifier unik lainnya ke developer FE atau Mobile. Id atau identifier elemen tersebut ditambahkan ke elemen yang akan digunakan untuk pembuatan script automation.
            </li>
        </ol>
    </div>
</details>

<details>
    <summary><strong>Test Script - API</strong></summary>
    <div style="text-align: justify"> 
        Standarisasi untuk elemen pada automation API:
    </div>
    <div style="text-align: justify"> 
        <ol>
            <li>Kelompokkan setiap file test menurut modul atau fitur yang dimiliki oleh service.</li>
            <li>Beberapa validasi yang perlu dilakukan ketika membangun script automation API.
                <ul>
                    <li>status code</li>
                    <li>perubahan data yang berkaitan</li>
                    <li>json schema</li>
                </ul>
            </li>
            <li>Apabila dalam satu request membutuhkan data yang bisa didapat dari request sebelumnya, sangat disarankan untuk melakukan parsing dan mengambil data tersebut untuk digunakan di request selanjutnya.
            </li>
        </ol>
    </div>
</details>