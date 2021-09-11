<section class="mt-3 mb-3">
    <h4 class="text-center font-kg-happy">RASIONALISASI SNMPTN GRAND SIMULASI SBMPTN 2021</h4>
    <br />
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center text-white bg-info font-kg-happy"><h4>HALAMAN PERNYATAAN</h4></div>
                    <p id="csrf-hash" style="display: none"><?php echo $this->security->get_csrf_hash(); ?></p>
                    <div class="card-body">
                        <h4 class="text-center text-danger">INFORMASI PENTING!!!</h4>
                        <div class="text-paragraph text-justify">
                            Dengan mengikuti program kami, maka Peserta setuju untuk memberikan data pribadi peserta dan/atau data pribadi pihak manapun yang berhubungan dengan peserta yang dibutuhkan dalam pengisian formulir. Rasionalisasi ini kepada Grand Simulasi SBMPTN untuk prosedural Rasionalisasi. Grand Simulasi SBMPTN akan menjaga kerahasiaan data yang diberikan peserta pada formulir Rasionalisasi sesuai dengan prosedur dalam platform Grand Simulasi SBMPTN.
                        </div>
                        <div class="text-paragraph text-justify">
                            Peserta mengetahui dan menjamin bahwa pelaksanaan pengisian formulir ini sudah mendapatkan ijin dari orang tua dan/atau wali peserta dan membebaskan Grand Simulasi SBMPTN dari segala tanggung jawab atas segala hal yang dilakukan peserta terkait info dan/atau data pribadi yang diberikan peserta kepada pihak manapun.
                        </div>
                        <div class="text-paragraph text-justify">
                            Pengguna memahami bahwa hasil rasionalisasi bersifat prediksi dan bukan acuan utama, dan melepaskan Grand Simulasi SBMPTN dari segala tuntutan dan/atau tanggung jawab terkait perbedaan hasil Rasionalisasi SNMPTN Grand Simulasi SBMPTN dan hasil yang sesungguhnya.
                        </div>
                        <div class="text-paragraph text-justify">
                            Dengan memilih opsi <b>“Saya setuju”</b>, kamu telah <b>membaca dan memahami pernyataan di atas</b> dan kamu telah <b>menyetujui ketentuan tersebut</b>.
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="setuju" onclick="setuju()">
                            <label class="form-check-label" for="setuju">Saya Setuju</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="tidaksetuju" onclick="tidak_setuju()">
                            <label class="form-check-label" for="tidaksetuju">Saya Tidak Setuju</label>
                        </div>
                        <div class="text-paragraph text-justify">
                            Apabila setelah membaca pernyataan tersebut kamu memilih untuk tidak setuju maka kami berhak untuk mengkonfirmasi bahwa kamu tidak akan mendapatkan hasil Rasionalisasi SNMPTN, karena kamu tidak bersedia untuk memberikan data – data kamu dengan ketentuan yang telah kami berikan.
                        </div>
                        <div class="text-paragraph text-justify">
                            Kami ucapkan terima kasih karena telah meluangkan waktu untuk mengisi formulir ini.
                        </div>
                        <div id="btnstj" class="col-md-12 mt-2" style="display:none">
                            <button id="mulai" class="btn">
                                <span id="button-text" class="font-kg-happy">Yuk Lanjut!</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
