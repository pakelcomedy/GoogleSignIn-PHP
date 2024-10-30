<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="container mx-auto mt-8 mb-16">
    <div class="flex flex-col lg:flex-row">
        <!-- Gambar Utama -->
        <div class="w-full lg:w-2/3 pr-4">
            <img src="https://via.placeholder.com/800x450" class="w-full h-auto object-cover rounded-lg mb-4">
            <h1 class="text-3xl font-bold mb-2">Tim Bridge Polije Raih Juara 2 SEABF Cup 2024</h1>
            <span class="text-gray-500 text-sm">27 Januari 2025, 13:00 WIB</span>
            <p class="mt-4 text-gray-700">Tim Bridge Polije berhasil meraih juara 2 dalam 7th South East Asia Bridge Federation (SEABF) Cup dan 40th ASEAN Bridge Club Championship...</p>
        </div>

        <!-- Baru Baru Ini -->
        <div class="w-full lg:w-1/3 pl-4 mt-8 lg:mt-0">
            <div class="mb-4">
                <span class="inline-block bg-[#FFC300] text-white px-6 py-1 rounded-t-md">Baru Baru Ini</span>
                <div class="border-b-4 border-[#FFC300] mt-0"></div>
            </div>
            <ul class="pl-4">
                <?php for ($i = 1; $i <= 6; $i++): ?>
                    <li class="mb-4">
                        <div class="flex items-center">
                            <span class="text-[#CAD2FF] font-semibold italic text-5xl mr-4"><?= $i ?></span>
                            <div>
                                <span class="text-gray-400 text-sm">2 jam yang lalu</span>
                                <h3 class="text-lg font-bold mt-1">Lorem Ipsum Dolor Sit Amet, Consectetur Adipiscing Elit <?= $i ?></h3>
                                <div class="border-b border-gray-300 mt-2"></div>
                            </div>
                        </div>
                    </li>
                <?php endfor; ?>
            </ul>
        </div>
    </div>

    <!-- Paragraf dan Label -->
    <div class="flex flex-col lg:flex-row mt-8">
        <!-- Paragraf -->
        <div class="w-full lg:w-2/3 pr-4">
            <p class="text-gray-700">
                KBRN,Jember: Tim Bridge Polije berhasil meraih Juara 2 dalam 7th South East Asia Bridge Federation (SEABF) Cup dan 40th ASEAN Bridge Club Championship, yang diselenggarakan oleh South East Asia Bridge Federation.
                <br><br>
                Kegiatan bergengsi ini berlangsung dari tanggal 25 hingga 29 September 2024 di The Margo Hotel Depok, Jawa Barat.
                <br><br>
                Tim Bridge Polije terdiri dari Muhammad Sulaiman, Muhammad Surul, Nurisnawati, dan Firdatus Sholehah. Atlet Bridge tersebut menunjukkan kualitas permainan yang sangat baik dan berhasil melewati berbagai tantangan di turnamen yang diikuti oleh tim-tim dari negara-negara ASEAN lainnya.
                <br><br>
                Muhammad Sulaiman menyampaikan Senin (30/9/2024) bahwa mereka mendominasi permainan dan mengalami dua kali kekalahan.
                <br><br>
                “Di babak penyisihan, kami mendominasi permainan dengan hanya mengalami dua kali kekalahan dari total pertandingan. Kami merasa percaya diri dan bersemangat untuk melanjutkan ke babak berikutnya,” ujar Sulaiman Senin (30/9/2024).
                <br><br>
                Ia juga menambahkan bahwa strategi dan kerjasama tim yang solid menjadi kunci sukses mereka selama babak penyisihan. Namun, babak final menjadi tantangan yang lebih berat.
                <br><br>
                Tim Polije harus berhadapan dengan Timnas Indonesia U-26, Metaforsa, yang dikenal sebagai salah satu tim terbaik di Asia Tenggara. Meskipun mengalami kekalahan yang cukup telak di final, Muhammad Sulaiman tetap merasa bangga dengan pencapaian timnya.
                <br><br>
                “Kami kalah dari tim yang sangat kuat, namun kami mampu menunjukkan performa terbaik kami dengan mengalahkan Tim Thailand A dengan skor 48-12 IMPs (17,59-2,41 VP)" lanjut Sulaiman.
                <br><br>
                Tanpa pendampingan dari pelatih, tim Bridge Polije berhasil memaksimalkan kemampuan masing-masing anggota. Hal ini menunjukkan dedikasi dan komitmen mereka untuk berprestasi.
                <br><br>
                “Kami belajar banyak dari pengalaman ini. Kemenangan melawan Tim Thailand A menjadi momen yang sangat membanggakan dan memberi kami motivasi lebih untuk terus berlatih,” ungkap Sulaiman.
                <br><br>
                Prestasi ini menjadi sorotan tidak hanya bagi Polije tetapi juga bagi dunia bridge di Indonesia. Muhammad Sulaiman berharap agar kampus dapat memberikan dukungan lebih untuk tim bridge Polije di kejuaraan-kejuaraan mendatang.
                <br><br>
                “Kami berharap Polije bisa memberikan lebih banyak dukungan, baik dalam hal fasilitas latihan maupun pendanaan untuk mengikuti kejuaraan nasional dan internasional lainnya" ujar Sulaiman.
                <br><br>
                Prestasi tim Bridge Polije dalam ajang internasional ini tidak hanya mengangkat nama kampus, tetapi juga menjadi inspirasi bagi mahasiswa lainnya untuk mengejar prestasi di berbagai bidang. Diharapkan, dengan semangat dan kerja keras, tim Bridge Polije dapat terus meraih prestasi di pentas internasional dan membanggakan nama Indonesia di dunia olahraga.
            </p>
        </div>

        <!-- Label Section -->
        <div class="w-full lg:w-1/3 mt-8 lg:mt-0">
            <span class="inline-block bg-green-500 text-white px-6 py-1 rounded-t-md">Label</span>
            <div class="border-b-4 border-green-500 mt-0 mb-4" style="width: 300px;"></div>
            <div class="flex flex-wrap gap-2" style="max-width: 300px;">
                <?php for ($i = 1; $i <= 5; $i++): ?>
                    <span class="inline-block bg-white text-black border border-blue-500 px-3 py-1 rounded-full">Tag <?= $i ?></span>
                <?php endfor; ?>
            </div>
        </div>
    </div>
</div>
</body>
</html>