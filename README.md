# Sentix: Aplikasi Analisis Sentimen Berbasis Web dengan Insight AI

By Faishal Anwar Hasyim

Sebuah aplikasi web intuitif untuk menganalisis sentimen dari data teks (seperti ulasan atau tweet) secara otomatis, mengubah data mentah menjadi visualisasi dan insight yang mudah dipahami.

![image](https://github.com/user-attachments/assets/2dc07f7d-1fe4-4e42-a563-ac1f32aaaad2)

---

## *Tentang Proyek Ini*

Analisis sentimen adalah proses yang krusial untuk memahami opini publik, namun seringkali memerlukan keahlian teknis dalam pemrograman dan machine learning. Prosesnya yang rumit, mulai dari pembersihan data hingga pembuatan model di Jupyter Notebook, menjadi penghalang bagi banyak orang.

*Sentix* dibangun untuk menjembatani jurang tersebut. Proyek ini menyediakan antarmuka yang ramah pengguna di mana siapa pun dapat mengunggah dataset mereka (dalam format CSV atau Excel) dan mendapatkan laporan analisis sentimen yang komprehensif hanya dengan beberapa klik. Aplikasi ini tidak hanya memberikan klasifikasi sentimen (Positif, Negatif, Netral), tetapi juga menyajikan visualisasi data interaktif dan insight yang dihasilkan oleh AI generatif untuk pemahaman yang lebih mendalam.

Proyek ini sepenuhnya siap untuk di-deploy menggunakan *Docker*, memastikan proses setup yang konsisten, portabel, dan skalabel.

## *Fitur Utama*

* *Upload Data Fleksibel:* Mendukung file .csv dan .xlsx sebagai sumber data.
* *Analisis Sentimen Otomatis:* Menggunakan model dari Hugging Face Transformers untuk mengklasifikasikan teks ke dalam kategori Positif, Negatif, dan Netral.
* *Visualisasi Interaktif:* Menghasilkan Pie Chart dan Bar Chart distribusi sentimen menggunakan Plotly.
* *Word Cloud Dinamis:* Menampilkan kata-kata kunci yang paling sering muncul untuk setiap kategori sentimen.
* *Insight Berbasis AI:* Menggunakan Google Gemini untuk memberikan ringkasan dan tema utama dari setiap sentimen, membantu pengguna memahami "mengapa" di balik data.
* *Siap Docker:* Dilengkapi dengan Dockerfile yang dioptimalkan untuk deployment yang mudah dan efisien.

## *Tumpukan Teknologi (Tech Stack)*

* *Backend:* Python, FastAPI, Uvicorn
* *AI & Machine Learning:* Transformers (Hugging Face), PyTorch, NLTK, Sastrawi
* *Generative AI:* Google Generative AI (Gemini)
* *Analisis & Visualisasi:* Pandas, Plotly, WordCloud
* *Frontend:* HTML5, Bootstrap 5, Jinja2 Templates
* *Deployment:* Docker

## *Cara Menjalankan Aplikasi*

Ada beberapa cara untuk menjalankan aplikasi ini, tergantung pada kebutuhan Anda.

### *Untuk Pengguna Akhir (Cara Cepat, Tanpa Source Code)*

Jika Anda hanya ingin menggunakan aplikasi ini tanpa perlu melihat atau mengubah kodenya, Anda bisa langsung menjalankan image yang sudah jadi dari Docker Hub.

*Prasyarat:*
* Docker sudah terinstall di sistem Anda.

*Langkah-langkah:*

1.  **Buat file .env:**
    Buat sebuah folder di komputer Anda. Di dalam folder tersebut, buat satu file bernama .env dan isi dengan kunci API Anda.
    
    GOOGLE_API_KEY="MASUKKAN_KUNCI_API_ANDA_DI_SINI"
    

2.  *Tarik (Pull) Image dari Docker Hub:*
    Buka terminal dan jalankan perintah berikut untuk mengunduh image aplikasi yang sudah jadi.
    bash
    docker pull faishalanwar/sentiment-app:1.0
    
    (Pastikan untuk menggunakan nama dan tag image yang benar jika ada versi yang lebih baru).

3.  *Jalankan Kontainer:*
    Setelah image berhasil diunduh, jalankan kontainer dari folder yang berisi file .env Anda.
    bash
    # Pastikan terminal Anda berada di folder yang sama dengan file .env
    docker run -d -p 8000:8000 --env-file .env faishalanwar/sentiment-app:2.0
    

4.  *Akses Aplikasi:*
    Buka browser Anda dan kunjungi **http://localhost:8000**.

---

### *Untuk Developer (Menggunakan Source Code)*

Jika Anda ingin mengembangkan, memodifikasi, atau melihat kode sumber aplikasi.

#### *Opsi A: Dengan Docker (Build dari Source Code)*

*Prasyarat:*
* Git terinstall.
* Docker terinstall.

*Langkah-langkah:*

1.  *Clone Repositori:*
    bash
    git clone [https://github.com/Faishal-Anwar/Sentix-Aplikasi-Analisis-Sentimen-Berbasis-Web-dengan-Insight-AI]
    cd sentix
    
    (Ganti dengan URL repositori Anda yang sebenarnya)

2.  **Buat file .env:**
    Buat file .env di dalam folder proyek dan tambahkan kunci API Anda.
    
    GOOGLE_API_KEY="MASUKKAN_KUNCI_API_ANDA_DI_SINI"
    

3.  *Bangun (Build) Image Docker:*
    bash
    docker build -t sentix .
    

4.  *Jalankan Kontainer Docker:*
    bash
    docker run -d -p 8000:8000 --env-file .env sentix
    
    
5.  *Akses Aplikasi:*
    Buka browser Anda dan kunjungi **http://localhost:8000**.

#### *Opsi B: Secara Lokal (Tanpa Docker)*

*Prasyarat:*
* Git terinstall.
* Python 3.8+ terinstall.

*Langkah-langkah:*

1.  *Clone Repositori:*
    bash
    git clone [https://github.com/Faishal-Anwar/Sentix-Aplikasi-Analisis-Sentimen-Berbasis-Web-dengan-Insight-AI]
    cd sentix
    

2.  *Buat dan Aktifkan Virtual Environment:*
    * *Windows:*
        bash
        python -m venv venv
        .\venv\Scripts\activate
        
    * *macOS / Linux:*
        bash
        python3 -m venv venv
        source venv/bin/activate
        

3.  *Install Semua Dependensi:*
    bash
    pip install -r requirements.txt
    

4.  **Buat file .env:**
    Sama seperti sebelumnya, buat file .env dan isi dengan kunci API Anda.

5.  *Jalankan Server Aplikasi:*
    bash
    uvicorn main:app --reload
    
    
6.  *Akses Aplikasi:*
    Buka browser Anda dan kunjungi **http://127.0.0.1:8000**.

---

## *Struktur Proyek*


SENTIMENT_APP/
├── Dockerfile
├── main.py
├── requirements.txt
├── .env
├── static/
│   └── (akan terisi otomatis, cukup sediakan foidernya saja)
└── templates/
    ├── index.html
    └── results.html
