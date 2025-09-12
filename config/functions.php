<?php 

require_once __DIR__ . '/conn.php';

function insertNonPMA()
{
    global $conn;

    try {
        // Ambil semua data dari POST (bagian ini tidak berubah)
        $id_table_lembaga = intval($_POST['id_table_lembaga']);
        $no_akte = htmlspecialchars($_POST['no_akte']);
        $jenis_kegiatan = htmlspecialchars($_POST['jenis_kegiatan']);
        $kota_administrasi = htmlspecialchars($_POST['kota_administrasi']);

        // Data pimpinan lembaga
        $nama_pimpinan = htmlspecialchars($_POST['nama_pimpinan']);
        $pimpinan_ijazah = htmlspecialchars($_POST['ijazah']);
        $pimpinan_asal_pt = htmlspecialchars($_POST['asal_pt']);
        $pimpinan_jurusan = htmlspecialchars($_POST['pimpinan_jurusan']);
        $pimpinan_sk_lembaga = htmlspecialchars($_POST['pimpinan_sk_lembaga']);
        $pimpinan_sk_nomor = htmlspecialchars($_POST['pimpinan_sk_nomor']);
        $pimpinan_sk_tanggal = htmlspecialchars($_POST['pimpinan_sk_tanggal']);
        $pimpinan_pengalaman = htmlspecialchars($_POST['pimpinan_pengalaman']);

        // Data pendidik lembaga WNI
        $pendidik_wni_laki = intval($_POST['pendidik_wni_laki']);
        $pendidik_wni_perempuan = intval($_POST['pendidik_wni_perempuan']);
        $pendidik_wni_pendidikan_terakhir = htmlspecialchars($_POST['pendidik_wni_pendidikan_terakhir']);
        $pendidik_wni_sertifikat = htmlspecialchars($_POST['pendidik_wni_sertifikat']);

        // Data pendidik lembaga WNA
        $pendidik_wna_ijin_kerja = htmlspecialchars($_POST['pendidik_wna_ijin_kerja']);
        $pendidik_wna_laki = intval($_POST['pendidik_wna_laki']);
        $pendidik_wna_perempuan = intval($_POST['pendidik_wna_perempuan']);
        $pendidik_wna_pendidikan_terakhir = htmlspecialchars($_POST['pendidik_wna_pendidikan_terakhir']);
        $pendidik_wna_sertifikat = htmlspecialchars($_POST['pendidik_wna_sertifikat']);
        
        $jumlah_tendik = intval($_POST['jumlah_tendik']);
        $pendidikan_tendik = htmlspecialchars($_POST['pendidikan_tendik']);

        // Penghasilan pendidik
        $gaji_pendidik_wni_min = floatval($_POST['gaji_pendidik_wni_min']);
        $gaji_pendidik_wni_max = floatval($_POST['gaji_pendidik_wni_max']);
        $gaji_pendidik_wna_min = floatval($_POST['gaji_pendidik_wna_min']);
        $gaji_pendidik_wna_max = floatval($_POST['gaji_pendidik_wna_max']);

        // Data administrasi
        $ada_sop = htmlspecialchars($_POST['ada_sop']);
        $ada_buku_hadir_pendidik = htmlspecialchars($_POST['ada_buku_hadir_pendidik']);
        $ada_buku_hadir_siswa = htmlspecialchars($_POST['ada_buku_hadir_siswa']);
        $ada_buku_inventaris = htmlspecialchars($_POST['ada_buku_inventaris']);
        $ada_program_kerja_yayasan = htmlspecialchars($_POST['ada_program_kerja_yayasan']);
        $ada_program_kerja_pimpinan = htmlspecialchars($_POST['ada_program_kerja_pimpinan']);
        $ada_kalender_pendidikan = htmlspecialchars($_POST['ada_kalender_pendidikan']);
        $ada_buku_tamu = htmlspecialchars($_POST['ada_buku_tamu']);
        $ada_buku_induk = htmlspecialchars($_POST['ada_buku_induk']);
        $ada_buku_hasil_belajar = htmlspecialchars($_POST['ada_buku_hasil_belajar']);
        $ada_jadwal = htmlspecialchars($_POST['ada_jadwal']);
        $ada_tata_tertib = htmlspecialchars($_POST['ada_tata_tertib']);
        $ada_sertifikat_pendidikan = htmlspecialchars($_POST['ada_sertifikat_pendidikan']);
        $ada_struktur_organisasi = htmlspecialchars($_POST['ada_struktur_organisasi']);

        // Data dokumen
        $dokumen_kurikulum = htmlspecialchars($_POST['dokumen_kurikulum']);
        $dokumen_rencana_pengembangan = htmlspecialchars($_POST['dokumen_rencana_pengembangan']);
        $dokumen_rencana_tahunan = htmlspecialchars($_POST['dokumen_rencana_tahunan']);

        // Data sarana prasarana
        $luas_tanah = htmlspecialchars($_POST['luas_tanah']);
        $status_tanah = htmlspecialchars($_POST['status_tanah']);
        $peruntukan_tanah = htmlspecialchars($_POST['peruntukan_tanah']);
        $jumlah_ruang_belajar = intval($_POST['jumlah_ruang_belajar']);
        $ukuran_ruang_belajar = htmlspecialchars($_POST['ukuran_ruang_belajar']);
        $kondisi_gedung = htmlspecialchars($_POST['kondisi_gedung']);
        $status_gedung = htmlspecialchars($_POST['status_gedung']);
        $peruntukan_gedung = htmlspecialchars($_POST['peruntukan_gedung']);
        $jumlah_kamar_mandi = intval($_POST['jumlah_kamar_mandi']);
        $perawatan_kamar_kecil = htmlspecialchars($_POST['perawatan_kamar_kecil']);
        $persediaan_air_bersih = htmlspecialchars($_POST['persediaan_air_bersih']);
        $ruang_pimpinan = htmlspecialchars($_POST['ruang_pimpinan']);
        $ruang_tu = htmlspecialchars($_POST['ruang_tu']);
        $ruang_perpustakaan = htmlspecialchars($_POST['ruang_perpustakaan']);
        $ruang_lab = htmlspecialchars($_POST['ruang_lab']);
        $peralatan_laboratorium = htmlspecialchars($_POST['peralatan_laboratorium']);
        $kondisi_ruang_kelas = htmlspecialchars($_POST['kondisi_ruang_kelas']);
        $meja_kursi = htmlspecialchars($_POST['meja_kursi']);
        $papan_tulis = htmlspecialchars($_POST['papan_tulis']);
        $gudang = htmlspecialchars($_POST['gudang']);
        $alat_kebersihan = htmlspecialchars($_POST['alat_kebersihan']);

        // Peserta didik
        $nama_program = htmlspecialchars($_POST['nama_program']);
        $kelas_dan_level = htmlspecialchars($_POST['kelas_dan_level']);
        $jumlah_siswa_laki = intval($_POST['jumlah_siswa_laki']);
        $jumlah_siswa_perempuan = intval($_POST['jumlah_siswa_perempuan']);

        // Data visitasi
        $hasil_visitasi = htmlspecialchars($_POST['hasil_visitasi']);

        // ==================================================================
        // PENAMBAHAN: Variabel flag untuk menandai keberhasilan semua query
        // ==================================================================
        $semua_berhasil = true;

        // Query INSERT ke form_non_pma (tidak berubah)
        $placeholders = implode(', ', array_fill(0, 70, '?'));
        $sql = "INSERT INTO form_non_pma (
            `id_table_lembaga`, `no_akte`, `jenis_kegiatan`, `kota_administrasi`, 
            `pimpinan_nama`, `pimpinan_ijazah`, `pimpinan_asal_pt`, `pimpinan_jurusan`, 
            `pimpinan_sk_lembaga`, `pimpinan_sk_nomor`, `pimpinan_sk_tanggal`, `pimpinan_pengalaman`, 
            `pendidik_wni_laki`, `pendidik_wni_perempuan`, `pendidik_wni_pendidikan_terakhir`, `pendidik_wni_sertifikat`, 
            `pendidik_wna_ijin_kerja`, `pendidik_wna_laki`, `pendidik_wna_perempuan`, `pendidik_wna_pendidikan_terakhir`, `pendidik_wna_sertifikat`, 
            `jumlah_tendik`, `pendidikan_tendik`, 
            `gaji_pendidik_wni_min`, `gaji_pendidik_wni_max`, `gaji_pendidik_wna_min`, `gaji_pendidik_wna_max`, 
            `ada_sop`, `ada_buku_hadir_pendidik`, `ada_buku_hadir_siswa`, `ada_buku_inventaris`, 
            `ada_program_kerja_yayasan`, `ada_program_kerja_pimpinan`, `ada_kalender_pendidikan`, `ada_buku_tamu`, 
            `ada_buku_induk`, `ada_buku_hasil_belajar`, `ada_jadwal`, `ada_tata_tertib`, 
            `ada_sertifikat_pendidikan`, `ada_struktur_organisasi`, 
            `dokumen_kurikulum`, `dokumen_rencana_pengembangan`, `dokumen_rencana_tahunan`, 
            `luas_tanah`, `status_tanah`, `peruntukan_tanah`, `jumlah_ruang_belajar`, `ukuran_ruang_belajar`, 
            `kondisi_gedung`, `status_gedung`, `peruntukan_gedung`, `jumlah_kamar_mandi`, `perawatan_kamar_kecil`, 
            `persediaan_air_bersih`, `ruang_pimpinan`, `ruang_tu`, `ruang_perpustakaan`, `ruang_lab`, 
            `peralatan_laboratorium`, `kondisi_ruang_kelas`, `meja_kursi`, `papan_tulis`, `gudang`, `alat_kebersihan`, 
            `nama_program`, `kelas_dan_level`, `jumlah_siswa_laki`, `jumlah_siswa_perempuan`, 
            `hasil_visitasi`, `created_at`
        ) VALUES ($placeholders, CURRENT_TIMESTAMP())";

        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            die("FATAL ERROR: Gagal mempersiapkan statement. Cek kembali semua nama kolom di query SQL. Pesan error dari database: " . $conn->error);
        }

        $stmt->bind_param(
            "isssssssssssiisssiissisddddssssssssssssssssssssissssissssssssssssssiis",
            $id_table_lembaga, $no_akte, $jenis_kegiatan, $kota_administrasi,
            $nama_pimpinan, $pimpinan_ijazah, $pimpinan_asal_pt, $pimpinan_jurusan,
            $pimpinan_sk_lembaga, $pimpinan_sk_nomor, $pimpinan_sk_tanggal, $pimpinan_pengalaman,
            $pendidik_wni_laki, $pendidik_wni_perempuan, $pendidik_wni_pendidikan_terakhir, $pendidik_wni_sertifikat,
            $pendidik_wna_ijin_kerja, $pendidik_wna_laki, $pendidik_wna_perempuan, $pendidik_wna_pendidikan_terakhir, $pendidik_wna_sertifikat,
            $jumlah_tendik, $pendidikan_tendik,
            $gaji_pendidik_wni_min, $gaji_pendidik_wni_max, $gaji_pendidik_wna_min, $gaji_pendidik_wna_max,
            $ada_sop, $ada_buku_hadir_pendidik, $ada_buku_hadir_siswa, $ada_buku_inventaris,
            $ada_program_kerja_yayasan, $ada_program_kerja_pimpinan, $ada_kalender_pendidikan, $ada_buku_tamu,
            $ada_buku_induk, $ada_buku_hasil_belajar, $ada_jadwal, $ada_tata_tertib,
            $ada_sertifikat_pendidikan, $ada_struktur_organisasi,
            $dokumen_kurikulum, $dokumen_rencana_pengembangan, $dokumen_rencana_tahunan,
            $luas_tanah, $status_tanah, $peruntukan_tanah, $jumlah_ruang_belajar, $ukuran_ruang_belajar,
            $kondisi_gedung, $status_gedung, $peruntukan_gedung, $jumlah_kamar_mandi, $perawatan_kamar_kecil,
            $persediaan_air_bersih, $ruang_pimpinan, $ruang_tu, $ruang_perpustakaan, $ruang_lab,
            $peralatan_laboratorium, $kondisi_ruang_kelas, $meja_kursi, $papan_tulis, $gudang, $alat_kebersihan,
            $nama_program, $kelas_dan_level,
            $jumlah_siswa_laki, $jumlah_siswa_perempuan,
            $hasil_visitasi
        );

        if (!$stmt->execute()) {
            $semua_berhasil = false; // Jika gagal, set flag ke false
            die("FATAL ERROR: Gagal mengeksekusi statement. Cek tipe data atau constraint (foreign key). Pesan error dari database: " . $stmt->error);
        }

        // ==================================================================
        // BAGIAN BARU: UPDATE STATUS DI table_lembaga
        // Hanya jalankan blok kode ini jika proses INSERT di atas berhasil
        // ==================================================================
        if ($semua_berhasil) {
            $status_baru = "sudah mengisi";
            
            // Siapkan query UPDATE. Pastikan nama Primary Key 'id' sudah benar.
            $sql_update = "UPDATE table_lembaga SET status_pengisian_lkp = ? WHERE id = ?";
            
            $stmt_update = $conn->prepare($sql_update);
            if ($stmt_update === false) {
                // Jika prepare gagal, proses dihentikan agar tidak ada data parsial
                die("FATAL ERROR (UPDATE): Gagal mempersiapkan statement update. Error: " . $conn->error);
            }

            // Bind parameter: "s" untuk status (string), "i" untuk id (integer)
            $stmt_update->bind_param("si", $status_baru, $id_table_lembaga);

            if (!$stmt_update->execute()) {
                // Jika update gagal, set flag ke false dan tampilkan error
                $semua_berhasil = false; 
                return "ERROR (UPDATE): Gagal mengeksekusi update. " . $stmt_update->error;
            }
            $stmt_update->close(); // Tutup statement kedua
        }
        
        // ==================================================================
        // MODIFIKASI: Pesan sukses hanya ditampilkan jika semua proses berhasil
        // ==================================================================
        if ($semua_berhasil) {
            return "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
                <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Data berhasil dikirim dan status lembaga telah diperbarui!',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'pilih_jenis.php';
                    }
                });
                </script>";
        }

        $stmt->close();
        $conn->close();

    } catch (Exception $e) {
        error_log("Error in insertNonPMA(): " . $e->getMessage());
        // Mungkin tambahkan pesan error untuk user di sini jika perlu
        return false;
    }
}

function insertPMA()
{
    global $conn;

    try {
        // Cek koneksi, pastikan tidak ada masalah
        if ($conn->connect_error) {
            error_log("Database connection failed: " . $conn->connect_error);
            // Tampilkan pesan error jika koneksi gagal
            return "<script>
                    Swal.fire('Error!', 'Koneksi ke database gagal.', 'error');
                  </script>";
            return; // Hentikan eksekusi
        }

        // Flag untuk melacak status keseluruhan proses
        $semua_berhasil = true;

        // Ambil ID Lembaga dari POST
        $id_table_lembaga = intval($_POST['id_table_lembaga'] ?? 0);
        if ($id_table_lembaga <= 0) {
            error_log("Invalid id_table_lembaga provided.");
            $semua_berhasil = false;
        }

        // Ambil semua data dari POST dan gabungkan (kode kamu sebelumnya, tidak diubah)
        $form_pendaftaran_kelengkapan = htmlspecialchars($_POST['form_pendaftaran_kelengkapan'] ?? '');
        $form_pendaftaran_score = intval($_POST['form_pendaftaran_score'] ?? 0);
        $form_pendaftaran_keterangan = htmlspecialchars($_POST['form_pendaftaran_keterangan'] ?? '');
        $combined_pendaftaran = $form_pendaftaran_kelengkapan . "," . $form_pendaftaran_score . "," . $form_pendaftaran_keterangan;

        $surat_tugas_kelengkapan = htmlspecialchars($_POST['surat_tugas_kelengkapan'] ?? '');
        $surat_tugas_score = intval($_POST['surat_tugas_score'] ?? 0);
        $surat_tugas_keterangan = htmlspecialchars($_POST['surat_tugas_keterangan'] ?? '');
        $combined_surat_tugas = $surat_tugas_kelengkapan . "," . $surat_tugas_score . "," . $surat_tugas_keterangan;

        $ktp_pemohon_kelengkapan = htmlspecialchars($_POST['ktp_pemohon_kelengkapan'] ?? '');
        $ktp_pemohon_score = intval($_POST['ktp_pemohon_score'] ?? 0);
        $ktp_pemohon_keterangan = htmlspecialchars($_POST['ktp_pemohon_keterangan'] ?? '');
        $combined_ktp_pemohon = $ktp_pemohon_kelengkapan . "," . $ktp_pemohon_score . "," . $ktp_pemohon_keterangan;

        $surat_rekomendasi_kelengkapan = htmlspecialchars($_POST['surat_rekomendasi_kelengkapan'] ?? '');
        $surat_rekomendasi_score = intval($_POST['surat_rekomendasi_score'] ?? 0);
        $surat_rekomendasi_keterangan = htmlspecialchars($_POST['surat_rekomendasi_keterangan'] ?? '');
        $combined_surat_rekomendasi = $surat_rekomendasi_kelengkapan . "," . $surat_rekomendasi_score . "," . $surat_rekomendasi_keterangan;

        $sk_kemenhumkam_kelengkapan = htmlspecialchars($_POST['sk_kemenhumkam_kelengkapan'] ?? '');
        $sk_kemenhumkam_score = intval($_POST['sk_kemenhumkam_score'] ?? 0);
        $sk_kemenhumkam_keterangan = htmlspecialchars($_POST['sk_kemenhumkam_keterangan'] ?? '');
        $combined_sk_kemenhumkam = $sk_kemenhumkam_kelengkapan . "," . $sk_kemenhumkam_score . "," . $sk_kemenhumkam_keterangan;

        $nomor_induk_berusaha_kelengkapan = htmlspecialchars($_POST['nomor_induk_berusaha_kelengkapan'] ?? '');
        $nomor_induk_berusaha_score = intval($_POST['nomor_induk_berusaha_score'] ?? 0);
        $nomor_induk_berusaha_keterangan = htmlspecialchars($_POST['nomor_induk_berusaha_keterangan'] ?? '');
        $combined_nomor_induk_berusaha = $nomor_induk_berusaha_kelengkapan . "," . $nomor_induk_berusaha_score . "," . $nomor_induk_berusaha_keterangan;

        $kepemilikan_tanah_kelengkapan = htmlspecialchars($_POST['kepemilikan_tanah_kelengkapan'] ?? '');
        $kepemilikan_tanah_score = intval($_POST['kepemilikan_tanah_score'] ?? 0);
        $kepemilikan_tanah_keterangan = htmlspecialchars($_POST['kepemilikan_tanah_keterangan'] ?? '');
        $combined_kepemilikan_tanah = $kepemilikan_tanah_kelengkapan . "," . $kepemilikan_tanah_score . "," . $kepemilikan_tanah_keterangan;

        // RIPS untuk isi pendidikan
        $acuan_kurikulum_kelengkapan = htmlspecialchars($_POST['acuan_kurikulum_kelengkapan'] ?? '');
        $acuan_kurikulum_score = intval($_POST['acuan_kurikulum_score'] ?? 0);
        $acuan_kurikulum_keterangan = htmlspecialchars($_POST['acuan_kurikulum_keterangan'] ?? '');
        $combined_acuan_kurikulum = $acuan_kurikulum_kelengkapan . "," . $acuan_kurikulum_score . "," . $acuan_kurikulum_keterangan;

        $kurikulum_kelengkapan = htmlspecialchars($_POST['kurikulum_kelengkapan'] ?? '');
        $kurikulum_score = intval($_POST['kurikulum_score'] ?? 0);
        $kurikulum_keterangan = htmlspecialchars($_POST['kurikulum_keterangan'] ?? '');
        $combined_kurikulum = $kurikulum_kelengkapan . "," . $kurikulum_score . "," . $kurikulum_keterangan;

        $rpp_kelengkapan = htmlspecialchars($_POST['rpp_kelengkapan'] ?? '');
        $rpp_score = intval($_POST['rpp_score'] ?? 0);
        $rpp_keterangan = htmlspecialchars($_POST['rpp_keterangan'] ?? '');
        $combined_rpp = $rpp_kelengkapan . "," . $rpp_score . "," . $rpp_keterangan;

        $pendekatan_pembelajaran_kelengkapan = htmlspecialchars($_POST['pendekatan_pembelajaran_kelengkapan'] ?? '');
        $pendekatan_pembelajaran_score = intval($_POST['pendekatan_pembelajaran_score'] ?? 0);
        $pendekatan_pembelajaran_keterangan = htmlspecialchars($_POST['pendekatan_pembelajaran_keterangan'] ?? '');
        $combined_pendekatan_pembelajaran = $pendekatan_pembelajaran_kelengkapan . "," . $pendekatan_pembelajaran_score . "," . $pendekatan_pembelajaran_keterangan;

        //RIPS untuk tenaga kependidikan
        $nama_kelengkapan = htmlspecialchars($_POST['nama_kelengkapan'] ?? '');
        $nama_score = intval($_POST['nama_score'] ?? 0);
        $nama_keterangan = htmlspecialchars($_POST['nama_keterangan'] ?? '');
        $combined_nama = $nama_kelengkapan . "," . $nama_score . "," . $nama_keterangan;

        $jabatan_kelengkapan = htmlspecialchars($_POST['jabatan_kelengkapan'] ?? '');
        $jabatan_score = intval($_POST['jabatan_score'] ?? 0);
        $jabatan_keterangan = htmlspecialchars($_POST['jabatan_keterangan'] ?? '');
        $combined_jabatan = $jabatan_kelengkapan . "," . $jabatan_score . "," . $jabatan_keterangan;

        $kualifikasi_akademik_kelengkapan = htmlspecialchars($_POST['kualifikasi_akademik_kelengkapan'] ?? '');
        $kualifikasi_akademik_score = intval($_POST['kualifikasi_akademik_score'] ?? 0);
        $kualifikasi_akademik_keterangan = htmlspecialchars($_POST['kualifikasi_akademik_keterangan'] ?? '');
        $combined_kualifikasi_akademik = $kualifikasi_akademik_kelengkapan . "," . $kualifikasi_akademik_score . "," . $kualifikasi_akademik_keterangan;

        $sertifikat_kelengkapan = htmlspecialchars($_POST['sertifikat_kelengkapan'] ?? '');
        $sertifikat_score = intval($_POST['sertifikat_score'] ?? 0);
        $sertifikat_keterangan = htmlspecialchars($_POST['sertifikat_keterangan'] ?? '');
        $combined_sertifikat = $sertifikat_kelengkapan . "," . $sertifikat_score . "," . $sertifikat_keterangan;

        $pengalaman_kerja_kelengkapan = htmlspecialchars($_POST['pengalaman_kerja_kelengkapan'] ?? '');
        $pengalaman_kerja_score = intval($_POST['pengalaman_kerja_score'] ?? 0);
        $pengalaman_kerja_keterangan = htmlspecialchars($_POST['pengalaman_kerja_keterangan'] ?? '');
        $combined_pengalaman_kerja = $pengalaman_kerja_kelengkapan . "," . $pengalaman_kerja_score . "," . $pengalaman_kerja_keterangan;

        //RIPS untuk sarana prasarana
        $bangunan_kelengkapan = htmlspecialchars($_POST['bangunan_kelengkapan'] ?? '');
        $bangunan_score = intval($_POST['bangunan_score'] ?? 0);
        $bangunan_keterangan = htmlspecialchars($_POST['bangunan_keterangan'] ?? '');
        $combined_bangunan = $bangunan_kelengkapan . "," . $bangunan_score . "," . $bangunan_keterangan;

        $ruangan_kelengkapan = htmlspecialchars($_POST['ruangan_kelengkapan'] ?? '');
        $ruangan_score = intval($_POST['ruangan_score'] ?? 0);
        $ruangan_keterangan = htmlspecialchars($_POST['ruangan_keterangan'] ?? '');
        $combined_ruangan = $ruangan_kelengkapan . "," . $ruangan_score . "," . $ruangan_keterangan;

        $alat_kelengkapan = htmlspecialchars($_POST['alat_kelengkapan'] ?? '');
        $alat_score = intval($_POST['alat_score'] ?? 0);
        $alat_keterangan = htmlspecialchars($_POST['alat_keterangan'] ?? '');
        $combined_alat = $alat_kelengkapan . "," . $alat_score . "," . $alat_keterangan;

        $bahan_ajar_kelengkapan = htmlspecialchars($_POST['bahan_ajar_kelengkapan'] ?? '');
        $bahan_ajar_score = intval($_POST['bahan_ajar_score'] ?? 0);
        $bahan_ajar_keterangan = htmlspecialchars($_POST['bahan_ajar_keterangan'] ?? '');
        $combined_bahan_ajar = $bahan_ajar_kelengkapan . "," . $bahan_ajar_score . "," . $bahan_ajar_keterangan;

        $kepemilikan_gedung_kelengkapan = htmlspecialchars($_POST['kepemilikan_gedung_kelengkapan'] ?? '');
        $kepemilikan_gedung_score = intval($_POST['kepemilikan_gedung_score'] ?? 0);
        $kepemilikan_gedung_keterangan = htmlspecialchars($_POST['kepemilikan_gedung_keterangan'] ?? '');
        $combined_kepemilikan_gedung = $kepemilikan_gedung_kelengkapan . "," . $kepemilikan_gedung_score . "," . $kepemilikan_gedung_keterangan;

        //RIPS untuk pembiayaan pendidikan
        $rancangan_pembiayaan_kelengkapan = htmlspecialchars($_POST['rancangan_pembiayaan_kelengkapan'] ?? '');
        $rancangan_pembiayaan_score = intval($_POST['rancangan_pembiayaan_score'] ?? 0);
        $rancangan_pembiayaan_keterangan = htmlspecialchars($_POST['rancangan_pembiayaan_keterangan'] ?? '');
        $combined_rancangan_pembiayaan = $rancangan_pembiayaan_kelengkapan . "," . $rancangan_pembiayaan_score . "," . $rancangan_pembiayaan_keterangan;

        $sumber_pembiayaan_kelengkapan = htmlspecialchars($_POST['sumber_pembiayaan_kelengkapan'] ?? '');
        $sumber_pembiayaan_score = intval($_POST['sumber_pembiayaan_score'] ?? 0);
        $sumber_pembiayaan_keterangan = htmlspecialchars($_POST['sumber_pembiayaan_keterangan'] ?? '');
        $combined_sumber_pembiayaan = $sumber_pembiayaan_kelengkapan . "," . $sumber_pembiayaan_score . "," . $sumber_pembiayaan_keterangan;

        //RIPS untuk sistem evaluasi dan sertifikasi
        $sistem_sertifikasi_kelengkapan = htmlspecialchars($_POST['sistem_sertifikasi_kelengkapan'] ?? '');
        $sistem_sertifikasi_score = intval($_POST['sistem_sertifikasi_score'] ?? 0);
        $sistem_sertifikasi_keterangan = htmlspecialchars($_POST['sistem_sertifikasi_keterangan'] ?? '');
        $combined_sistem_sertifikasi = $sistem_sertifikasi_kelengkapan . "," . $sistem_sertifikasi_score . "," . $sistem_sertifikasi_keterangan;

        $orientasi_sertifikasi_kelengkapan = htmlspecialchars($_POST['orientasi_sertifikasi_kelengkapan'] ?? '');
        $orientasi_sertifikasi_score = intval($_POST['orientasi_sertifikasi_score'] ?? 0);
        $orientasi_sertifikasi_keterangan = htmlspecialchars($_POST['orientasi_sertifikasi_keterangan'] ?? '');
        $combined_orientasi_sertifikasi = $orientasi_sertifikasi_kelengkapan . "," . $orientasi_sertifikasi_score . "," . $orientasi_sertifikasi_keterangan;

        $pengembangan_evaluasi_kelengkapan = htmlspecialchars($_POST['pengembangan_evaluasi_kelengkapan'] ?? '');
        $pengembangan_evaluasi_score = intval($_POST['pengembangan_evaluasi_score'] ?? 0);
        $pengembangan_evaluasi_keterangan = htmlspecialchars($_POST['pengembangan_evaluasi_keterangan'] ?? '');
        $combined_pengembangan_evaluasi = $pengembangan_evaluasi_kelengkapan . "," . $pengembangan_evaluasi_score . "," . $pengembangan_evaluasi_keterangan;

        //RIPS untuk manajemen dan proses pendidikan
        $struktur_organisasi_kelengkapan = htmlspecialchars($_POST['struktur_organisasi_kelengkapan'] ?? '');
        $struktur_organisasi_score = intval($_POST['struktur_organisasi_score'] ?? 0);
        $struktur_organisasi_keterangan = htmlspecialchars($_POST['struktur_organisasi_keterangan'] ?? '');
        $combined_struktur_organisasi = $struktur_organisasi_kelengkapan . "," . $struktur_organisasi_score . "," . $struktur_organisasi_keterangan;

        $sop_kelengkapan = htmlspecialchars($_POST['sop_kelengkapan'] ?? '');
        $sop_score = intval($_POST['sop_score'] ?? 0);
        $sop_keterangan = htmlspecialchars($_POST['sop_keterangan'] ?? '');
        $combined_sop = $sop_kelengkapan . "," . $sop_score . "," . $sop_keterangan;

        $peserta_didik_kelengkapan = htmlspecialchars($_POST['peserta_didik_kelengkapan'] ?? '');
        $peserta_didik_score = intval($_POST['peserta_didik_score'] ?? 0);
        $peserta_didik_keterangan = htmlspecialchars($_POST['peserta_didik_keterangan'] ?? '');
        $combined_peserta_didik = $peserta_didik_kelengkapan . "," . $peserta_didik_score . "," . $peserta_didik_keterangan;

        $kalender_pembelajaran_kelengkapan = htmlspecialchars($_POST['kalender_pembelajaran_kelengkapan'] ?? '');
        $kalender_pembelajaran_score = intval($_POST['kalender_pembelajaran_score'] ?? 0);
        $kalender_pembelajaran_keterangan = htmlspecialchars($_POST['kalender_pembelajaran_keterangan'] ?? '');
        $combined_kalender_pembelajaran = $kalender_pembelajaran_kelengkapan . "," . $kalender_pembelajaran_score . "," . $kalender_pembelajaran_keterangan;

        $jadwal_ruangan_kelengkapan = htmlspecialchars($_POST['jadwal_ruangan_kelengkapan'] ?? '');
        $jadwal_ruangan_score = intval($_POST['jadwal_ruangan_score'] ?? 0);
        $jadwal_ruangan_keterangan = htmlspecialchars($_POST['jadwal_ruangan_keterangan'] ?? '');
        $combined_jadwal_ruangan = $jadwal_ruangan_kelengkapan . "," . $jadwal_ruangan_score . "," . $jadwal_ruangan_keterangan;
        
        // Hanya lanjutkan jika tidak ada error dari validasi awal
        if ($semua_berhasil) {
            // PROSES 1: INSERT DATA KE form_pma
            $sql_insert = "INSERT INTO form_pma (
                id_table_lembaga,
                form_pendaftaran, surat_tugas, ktp_pemohon, surat_rekomendasi, sk_kemenhumkam, nomor_induk_berusaha, kepemilikan_tanah,
                acuan_kurikulum, kurikulum, rpp, pendekatan_pembelajaran, 
                nama, jabatan, kualifikasi_akademik, sertifikat, pengalaman_kerja, 
                bangunan, ruangan, alat, bahan_ajar, kepemilikan_gedung,
                rancangan_pembiayaan, sumber_pembiayaan, 
                sistem_sertifikasi, orientasi_sertifikasi, pengembangan_evaluasi, 
                struktur_organisasi, sop, peserta_didik, kalender_pembelajaran, jadwal_ruangan
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            
            $stmt_insert = $conn->prepare($sql_insert);
            if ($stmt_insert === false) {
                error_log("Prepare statement INSERT gagal: " . $conn->error);
                $semua_berhasil = false;
            } else {
                $stmt_insert->bind_param(
                    "isssssssssssssssssssssssssssssss",
                    $id_table_lembaga, 
                    $combined_pendaftaran, $combined_surat_tugas, $combined_ktp_pemohon, $combined_surat_rekomendasi, $combined_sk_kemenhumkam, $combined_nomor_induk_berusaha, $combined_kepemilikan_tanah, 
                    $combined_acuan_kurikulum, $combined_kurikulum, $combined_rpp, $combined_pendekatan_pembelajaran, 
                    $combined_nama, $combined_jabatan, $combined_kualifikasi_akademik, $combined_sertifikat, $combined_pengalaman_kerja, 
                    $combined_bangunan, $combined_ruangan, $combined_alat, $combined_bahan_ajar, $combined_kepemilikan_gedung, 
                    $combined_rancangan_pembiayaan, $combined_sumber_pembiayaan, 
                    $combined_sistem_sertifikasi, $combined_orientasi_sertifikasi, $combined_pengembangan_evaluasi, 
                    $combined_struktur_organisasi, $combined_sop, $combined_peserta_didik, $combined_kalender_pembelajaran, $combined_jadwal_ruangan
                );

                if (!$stmt_insert->execute()) {
                    error_log("Eksekusi INSERT gagal: " . $stmt_insert->error);
                    $semua_berhasil = false;
                }
                $stmt_insert->close();
            }

            // PROSES 2: UPDATE STATUS DI table_lembaga (HANYA JIKA INSERT BERHASIL)
            if ($semua_berhasil) {
                $status_baru = "sudah mengisi";
                $sql_update = "UPDATE table_lembaga SET status_pengisian_lkp = ? WHERE id = ?";
                
                $stmt_update = $conn->prepare($sql_update);
                if ($stmt_update === false) {
                    error_log("Prepare statement UPDATE gagal: " . $conn->error);
                    $semua_berhasil = false;
                } else {
                    $stmt_update->bind_param("si", $status_baru, $id_table_lembaga);
                    if (!$stmt_update->execute()) {
                        error_log("Eksekusi UPDATE gagal: " . $stmt_update->error);
                        $semua_berhasil = false;
                    }
                    $stmt_update->close();
                }
            }
        }

        // PROSES 3: BERIKAN FEEDBACK KE USER BERDASARKAN HASIL AKHIR
        if ($semua_berhasil) {
            return "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
                  <script>
                  Swal.fire({
                      icon: 'success',
                      title: 'Berhasil!',
                      text: 'Data LKP PMA berhasil disimpan dan status lembaga telah diperbarui.',
                      confirmButtonText: 'OK'
                  }).then((result) => {
                      if (result.isConfirmed) {
                          window.location.href = 'index.php';
                      }
                  });
                  </script>";
        } else {
            return "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
                  <script>
                  Swal.fire({
                      icon: 'error',
                      title: 'Gagal!',
                      text: 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi.',
                      confirmButtonText: 'OK'
                  });
                  </script>";
        }
        
        $conn->close();

    } catch (Exception $e) {
        error_log("Exception di insertPMA(): " . $e->getMessage());
        return "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
              <script>
              Swal.fire('Error!', 'Terjadi kesalahan sistem yang tidak terduga.', 'error');
              </script>";
    }
}

function readNPSN() {
    global $conn;

    try {
        $sql = "SELECT * FROM table_lembaga";
        $result = $conn->query($sql);
        if ($result === false) {
            error_log("Query failed: " . $conn->error);
            return [];
        }

        $data = [];

        if($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data [] = $row;
            }
        }
        return $data;
    }
    catch (Exception $e) {
        error_log("Error in readLaporanPMA(): " . $e->getMessage());
        return [];
    }
}

function insertLembaga($data, $file)
{
    global $conn;

    // validasi status ENUM
    if (!in_array($data['status'], ['PMA', 'Non PMA'])) {
        return "Status tidak valid.";
    }

    // upload foto
    $fotoName = null;
    if ($file['foto_lembaga']['error'] == 0) {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
        if (!in_array($file['foto_lembaga']['type'], $allowedTypes)) {
            return "Format foto tidak diizinkan. Hanya JPG/PNG.";
        }

        $targetDir  = "uploads/";
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        // ambil ekstensi file
        $ext = pathinfo($file['foto_lembaga']['name'], PATHINFO_EXTENSION);

        // buat nama file baru dengan hash
        $fotoName = md5(uniqid(rand(), true)) . "." . strtolower($ext);
        $targetFile = $targetDir . $fotoName;

        if (!move_uploaded_file($file['foto_lembaga']['tmp_name'], $targetFile)) {
            return "Gagal upload foto.";
        }
    }

    $sql = "INSERT INTO table_lembaga 
            (npsn, nama_satuan_pendidikan, foto_lembaga, alamat, kecamatan, kelurahan, status, created_at) 
            VALUES (?, ?, ?, ?, ?, ?, ?, NOW())";

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        return "Prepare failed: " . $conn->error;
    }

    $stmt->bind_param(
        "sssssss",
        $data['npsn'],
        $data['nama_satuan_pendidikan'],
        $fotoName,
        $data['alamat'],
        $data['kecamatan'],
        $data['kelurahan'],
        $data['status']
    );

    $result = $stmt->execute();
    $error  = $stmt->error;
    $stmt->close();

    return $result ? true : "Execute failed: " . $error;
}

function searchNPSN($keyword) {
    global $conn;
    
    try {
        $sql = "SELECT * FROM table_lembaga WHERE npsn LIKE ? OR nama_satuan_pendidikan LIKE ?";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            error_log("Prepare failed: " . $conn->error);
            return [];
        }

        $likeKeyword = "%" . $keyword . "%";
        $stmt->bind_param("ss", $likeKeyword, $likeKeyword);

        if (!$stmt->execute()) {
            error_log("Execute failed: " . $stmt->error);
            $stmt->close();
            return [];
        }

        $result = $stmt->get_result();
        $data = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }

        $stmt->close();
        return $data;

    } catch (Exception $e) {
        error_log("Error in searchNPSN(): " . $e->getMessage());
        return [];
    }
}