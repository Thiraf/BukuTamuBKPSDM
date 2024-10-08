$(document).ready(function() {
    const layananOptions = {
        PPK: [
            'Layanan Karis Karsu',
            'Layanan Konsultasi Presensi',
            'Layanan Konsultasi Cerai',
            'Layanan Konsultasi Cuti',
            'Layanan Konsultasi Satyalancana',
            'Layanan Konsultasi Hukuman Disiplin',
            'Layanan Konsultasi TPP',
            'Layanan Konsultasi Jaminan Kematian'
        ],
        PKD: [
            'Layanan Konsultasi Diklat',
            'Layanan Konsultasi Jabatan Fungsional',
            'Layanan Konsultasi Tugas Belajar/Pendidikan Lanjutan',
            'Layanan Konsultasi Assesment'
        ],
        MUTASI: [
            'Layanan Konsultasi Pengembangan Karir',
            'Layanan Konsultasi Mutasi Masuk',
            'Layanan Konsultasi Mutasi Keluar',
            'Layanan Konsultasi SK',
            'Layanan Konsultasi Kenaikan Pangkat',
            'Layanan Konsultasi Kenaikan Jenjang',
            'Layanan Konsultasi PUPNS',
            'Layanan Konsultasi SAPA ASN',
            'Layanan Konsultasi SIASN/MYASN',
            'Layanan Konsultasi Pendaftaran CASN/CPNS/PPPPK'
        ],
        SEKRETARIAT: [
            'Layanan Penawaran',
            'Layanan lain-lain'
        ]
    };

    // Fungsi untuk mengupdate opsi layanan berdasarkan bidang
    function updateLayananOptions(selectedBidang) {
        const layananDropdown = $('#layanan');
        layananDropdown.empty(); // Kosongkan dulu opsi yang ada

        layananOptions[selectedBidang].forEach(function(option) {
            layananDropdown.append(new Option(option, option));
        });
    }

    // Panggil fungsi update saat halaman dimuat
    const selectedBidang = $('#bidang').val();
    updateLayananOptions(selectedBidang);

    // Update layanan ketika bidang diubah
    $('#bidang').change(function() {
        const selectedBidang = $(this).val();
        updateLayananOptions(selectedBidang);
    });

    $(document).ready(function() {
        console.log('jQuery is working');
    });

});
